// ============================================================
// ANALYSIS.JS - Fungsi Analisis (Clustering & Heatmap)
// ============================================================

// ── Cache data demografi dari database ──────────────────────
let _demografiCache = null; // { data: [...], kelurahanMap: { 'KEL_NAME': {total_kk, total_jiwa, kecamatan} } }

/**
 * Memuat data demografi per kelurahan dari API /api/demografi.
 * Dipanggil saat checkbox 'mce-demografi' dicentang.
 */
async function loadDemografiData(isChecked) {
    if (!isChecked) return;
    if (_demografiCache) return; // Sudah di-cache

    const statusDiv = document.getElementById('mce-status');
    const infoDiv = document.getElementById('mce-demografi-info');
    if (statusDiv) statusDiv.style.display = 'block';

    try {
        const response = await fetch('/api/demografi');
        if (!response.ok) throw new Error('HTTP ' + response.status);
        const json = await response.json();

        // Bangun lookup map berdasarkan nama kelurahan (uppercase)
        const kelurahanMap = {};
        (json.data || []).forEach(function(row) {
            const key = (row.kelurahan || '').toUpperCase().trim();
            kelurahanMap[key] = {
                kecamatan: (row.kecamatan || '').toUpperCase().trim(),
                total_kk: parseInt(row.total_kk) || 0,
                total_jiwa: parseInt(row.total_jiwa) || 0,
                jumlah_rw: parseInt(row.jumlah_rw) || 0
            };
        });

        _demografiCache = { data: json.data, kelurahanMap: kelurahanMap };

        if (infoDiv) {
            document.getElementById('mce-demografi-count').textContent = Object.keys(kelurahanMap).length;
            infoDiv.style.display = 'block';
        }

        console.log('📊 Data demografi dimuat:', Object.keys(kelurahanMap).length, 'kelurahan');

        // Juga muat layer KELURAHAN jika belum (untuk spatial matching)
        if (!geoJsonStore['KELURAHAN']) {
            await loadLayer('KELURAHAN');
        }

    } catch (e) {
        console.error('Gagal memuat data demografi:', e);
        alert('Gagal memuat data demografi dari server.');
    } finally {
        if (statusDiv) statusDiv.style.display = 'none';
    }
}

/**
 * Cari data demografi untuk sebuah titik berdasarkan kelurahan polygon.
 * Returns { kelurahan, kecamatan, total_kk, total_jiwa } atau null.
 */
function getDemografiForPoint(pt) {
    if (!_demografiCache || !_demografiCache.kelurahanMap) return null;
    const kelLayer = geoJsonStore['KELURAHAN'];
    if (!kelLayer || !kelLayer.features) return null;

    for (let feat of kelLayer.features) {
        try {
            if (turf.booleanPointInPolygon(pt, feat)) {
                // Ambil nama kelurahan dari properties
                const props = feat.properties || {};
                const kelName = (props.K || props.KELURAHAN || props.Name || props.name || '').toUpperCase().trim();
                const match = _demografiCache.kelurahanMap[kelName];
                if (match) {
                    return {
                        kelurahan: kelName,
                        kecamatan: match.kecamatan,
                        total_kk: match.total_kk,
                        total_jiwa: match.total_jiwa,
                        jumlah_rw: match.jumlah_rw
                    };
                }
                return null;
            }
        } catch(e) {}
    }
    return null;
}

// ============================================================
// POPULATE SUMBER DATA ANALISIS SECARA DINAMIS
// Membaca layerConfig dan mengisi checkbox analisis otomatis
// ============================================================

/**
 * Render ulang daftar checkbox sumber data analisis dari layerConfig.
 * Layer yang masuk: point/circle (bukan isBoundary, bukan isPolygon-only, bukan isLine-only).
 * Dipanggil saat panel analisis dibuka atau setelah data selesai dimuat.
 */
function populateAnalysisSources() {
    const container = document.getElementById('analysis-sources-container');
    if (!container) return;

    // Layer yang dikecualikan dari analisis (non-point atau khusus)
    const EXCLUDED_KEYS = [
        'KEPADATAN_PENDUDUK', 'SURABAYA_MASK', 'HEATMAP_LAYER',
        'ANALYSIS_RESULT', 'CLUSTER_BOUNDARIES',
        'KECAMATAN', 'KELURAHAN', 'BATAS_RW',
        'RUTE_SAMPAH', 'AREA_RAYON', 'POMPA_AIR_7_RAYON',
        'JARINGAN_PIPA_SALURAN', 'SALURAN_AIR', 
        'JARINGAN_JALAN'
    ];

    const GROUP_OVERRIDE = { 'RUKOM': 'persampahan', 'TITIK_SAMPAH': 'persampahan', 'TITIK_SAMPAH_RENCANA': 'persampahan' };

    // Label & icon grup — urutan & nama sama dengan layer data di blade
    const GROUP_LABELS = {
        infrastruktur: 'Infrastruktur',
        pendidikan:    'Pendidikan',
        persampahan:   'Persampahan & Lingkungan',
        fasilitas:     'Fasilitas Umum',
        demografi:     'Demografi',
        pompa_saluran: 'Pompa & Saluran Air',
        custom:        'Custom Layers',
        lainnya:       'Lainnya'
    };

    const GROUP_ICONS = {
        infrastruktur: 'bi-broadcast-pin',
        pendidikan:    'bi-mortarboard-fill',
        persampahan:   'bi-recycle',
        fasilitas:     'bi-buildings-fill',
        demografi:     'bi-people-fill',
        pompa_saluran: 'bi-droplet-fill',
        custom:        'bi-layers-fill',
        lainnya:       'bi-folder-fill'
    };

    // Kumpulkan layer per grup
    const grouped = {};
    Object.keys(layerConfig).forEach(function(key) {
        const cfg = layerConfig[key];
        if (EXCLUDED_KEYS.includes(key)) return;
        if (cfg.isBoundary) return;
        if (cfg.isLine && !cfg.isPolygon) return; // Point dan Polygon yang masuk
        const grp = GROUP_OVERRIDE[key] || cfg.group || 'lainnya';
        if (!grouped[grp]) grouped[grp] = [];
        grouped[grp].push({ key: key, cfg: cfg });
    });

    container.innerHTML = '';

    // Urutan grup sama dengan urutan di layer data blade
    const groupOrder = ['infrastruktur', 'pendidikan', 'persampahan', 'fasilitas', 'demografi', 'pompa_saluran', 'custom', 'lainnya'];

    // Pastikan grup yang tidak ada di groupOrder (seperti grup custom yang aneh) juga dimuat di akhir
    Object.keys(grouped).forEach(grp => {
        if (!groupOrder.includes(grp)) groupOrder.push(grp);
    });

    groupOrder.forEach(function(grp) {
        if (!grouped[grp] || grouped[grp].length === 0) return;

        // Header grup — UI lama (flat label abu-abu)
        const grpLabel = document.createElement('div');
        grpLabel.style.cssText = [
            'font-size:10px', 'font-weight:700', 'color:#64748b',
            'text-transform:uppercase', 'letter-spacing:0.5px',
            'margin:10px 0 4px 0', 'padding-bottom:4px',
            'border-bottom:1px solid #e2e8f0', 'display:flex',
            'align-items:center', 'gap:5px'
        ].join(';');
        const icon  = GROUP_ICONS[grp] || 'bi-pin-map-fill';
        const label = GROUP_LABELS[grp] || (grp.charAt(0).toUpperCase() + grp.slice(1));
        grpLabel.innerHTML = '<i class="bi ' + icon + '" style="font-size:11px;"></i><span>' + label + '</span>';
        container.appendChild(grpLabel);

        // Checkbox tiap layer — UI lama
        grouped[grp].forEach(function(item) {
            const key = item.key;
            const cfg = item.cfg;
            const count = (geoJsonStore[key] && geoJsonStore[key].features)
                ? geoJsonStore[key].features.length : 0;

            const wrapper = document.createElement('label');
            wrapper.style.cssText = [
                'display:flex', 'align-items:center', 'gap:7px',
                'padding:4px 6px', 'border-radius:5px', 'cursor:pointer',
                'font-size:12px', 'color:#334155', 'transition:background 0.15s',
                'user-select:none'
            ].join(';');
            wrapper.addEventListener('mouseenter', function() { wrapper.style.background = '#f1f5f9'; });
            wrapper.addEventListener('mouseleave', function() { wrapper.style.background = ''; });

            const cb = document.createElement('input');
            cb.type      = 'checkbox';
            cb.className = 'analysis-source';
            cb.value     = key;
            cb.disabled  = (count === 0);
            cb.title     = count === 0 ? 'Data belum dimuat' : '';
            cb.style.cssText = 'width:14px;height:14px;cursor:pointer;flex-shrink:0;';

            const dot = document.createElement('span');
            dot.style.cssText = [
                'width:9px', 'height:9px', 'border-radius:50%',
                'background:' + cfg.color, 'flex-shrink:0', 'display:inline-block'
            ].join(';');

            const text = document.createElement('span');
            text.style.cssText = 'flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;';
            text.textContent = cfg.label;

            wrapper.appendChild(cb);
            wrapper.appendChild(dot);
            wrapper.appendChild(text);
            container.appendChild(wrapper);
        });
    });
}

/**
 * Pilih semua / hapus semua checkbox analisis yang aktif
 */
function toggleAllAnalysisSources(checked) {
    document.querySelectorAll('.analysis-source:not(:disabled)').forEach(function(cb) {
        cb.checked = checked;
    });
}

/**
 * Memuat data spasial ke memori (Background) khusus untuk AI Analisis 
 * tanpa me-render visual layer tersebut ke dalam peta agar browser tidak berat.
 */
async function silentLoadData(layerKey, isChecked) {
    if (!isChecked) return; // Jika dimatikan, biarkan data tetap di cache memori
    
    if (geoJsonStore[layerKey]) return; // Jika sudah ada, langsung selesai
    
    const statusDiv = document.getElementById('mce-status');
    if (statusDiv) statusDiv.style.display = 'block';
    
    try {
        await loadLayer(layerKey);
    } catch (e) {
        console.error(`Gagal silent-load ${layerKey}:`, e);
        alert(`Gagal memuat data ${layerKey} untuk analisis.`);
    } finally {
        if (statusDiv) statusDiv.style.display = 'none';
    }
}

/**
 * Dipanggil setelah semua layer selesai dimuat — refresh badge count di analisis
 */
function refreshAnalysisSourceCounts() {
    const container = document.getElementById('analysis-sources-container');
    if (!container) return;
    // Jika belum pernah di-render, render sekarang
    if (container.children.length === 0) {
        populateAnalysisSources();
        return;
    }
    // Update badge count yang sudah ada
    container.querySelectorAll('.analysis-source').forEach(function(cb) {
        const key = cb.value;
        const count = (geoJsonStore[key] && geoJsonStore[key].features)
            ? geoJsonStore[key].features.length : 0;
        cb.disabled = (count === 0);
    });
}

// ============================================================
// FITUR ANALISIS KLUSTERING
// ============================================================
function runClustering() {
    const statusDiv = document.getElementById('analysis-result');
    const k = parseInt(document.getElementById('cluster-count').value) || 3;
    
    const selectedCheckboxes = document.querySelectorAll('.analysis-source:checked');
    if (selectedCheckboxes.length === 0) {
        alert("Pilih minimal satu sumber data untuk dianalisis.");
        return;
    }

    statusDiv.style.display = 'block';
    statusDiv.innerHTML = 'Menggabungkan data & menghitung...';

    if (mapLayers['ANALYSIS_RESULT']) {
        map.removeLayer(mapLayers['ANALYSIS_RESULT']);
        delete mapLayers['ANALYSIS_RESULT'];
    }
    
    if (mapLayers['CLUSTER_BOUNDARIES']) {
        map.removeLayer(mapLayers['CLUSTER_BOUNDARIES']);
        delete mapLayers['CLUSTER_BOUNDARIES'];
    }

    setTimeout(() => {
        try {
            let allFeatures = [];
            
            // Cek apakah ada filter wilayah yang aktif
            const activeRegion = (window.FilterWilayah && window.FilterWilayah.isFilterActive()) 
                ? window.FilterWilayah.getActiveFeature() 
                : null;
            
            // Konversi region ke polygon turf jika ada
            let regionPoly = null;
            if (activeRegion) {
                try {
                    if (activeRegion.geometry.type === 'Polygon') {
                        regionPoly = turf.polygon(activeRegion.geometry.coordinates);
                    } else if (activeRegion.geometry.type === 'MultiPolygon') {
                        regionPoly = turf.multiPolygon(activeRegion.geometry.coordinates);
                    }
                } catch(e) { console.warn("Invalid active region geometry", e); }
            }
            
            selectedCheckboxes.forEach(cb => {
                const key = cb.value;
                if (geoJsonStore[key] && geoJsonStore[key].features) {
                    let pointFeatures = geoJsonStore[key].features.filter(f => 
                        f.geometry.type === 'Point'
                    );
                    
                    // Filter berdasarkan wilayah aktif jika ada
                    if (regionPoly) {
                        pointFeatures = pointFeatures.filter(f => {
                            try {
                                const pt = turf.point(f.geometry.coordinates);
                                return turf.booleanPointInPolygon(pt, regionPoly);
                            } catch(e) { return false; }
                        });
                    }
                    
                    allFeatures = allFeatures.concat(pointFeatures);
                }
            });

            if (allFeatures.length === 0) {
                throw new Error("Data sumber kosong atau belum dimuat.");
            }

            const combinedPoints = turf.featureCollection(allFeatures);

            // ==========================================
            // LOGIKA BARU: BLANK SPOT / SUITABILITY ANALYSIS
            // Mencari lokasi yang paling jauh dari fasilitas eksisting
            // ==========================================
            
            // 1. Tentukan area pencarian (Bbox dari Region atau seluruh Surabaya)
            let searchBounds;
            let maskPolygons = [];
            
            if (regionPoly) {
                searchBounds = turf.bbox(regionPoly);
                maskPolygons.push(regionPoly);
            } else if (geoJsonStore['KECAMATAN'] && geoJsonStore['KECAMATAN'].features) {
                // Jika tidak difilter, batasi hanya di wilayah Surabaya (berdasarkan layer Kecamatan)
                searchBounds = turf.bbox(geoJsonStore['KECAMATAN']);
                geoJsonStore['KECAMATAN'].features.forEach(f => {
                    try {
                        if (f.geometry.type === 'Polygon') maskPolygons.push(turf.polygon(f.geometry.coordinates));
                        else if (f.geometry.type === 'MultiPolygon') maskPolygons.push(turf.multiPolygon(f.geometry.coordinates));
                    } catch(e) {}
                });
            } else {
                searchBounds = turf.bbox(combinedPoints);
            }
            // 2. Buat titik-titik kandidat (Gunakan Jaringan Jalan jika tersedia agar pasti ada akses!)
            const widthKm = turf.distance(turf.point([searchBounds[0], searchBounds[1]]), turf.point([searchBounds[2], searchBounds[1]]));
            const heightKm = turf.distance(turf.point([searchBounds[0], searchBounds[1]]), turf.point([searchBounds[0], searchBounds[3]]));
            const cellSize = Math.max(0.3, Math.sqrt((widthKm * heightKm) / 800)); // Sekitar 800 titik grid
            
            const useJalan = document.getElementById('mce-jalan') && document.getElementById('mce-jalan').checked;
            const jalanLayer = useJalan ? geoJsonStore['JARINGAN_JALAN'] : null;
            let grid;
            if (jalanLayer && jalanLayer.features) {
                // Ekstrak titik-titik tengah dari ruas jalan yang ada di dalam area pencarian
                const searchPoly = turf.bboxPolygon(searchBounds);
                const roadCandidates = [];
                
                jalanLayer.features.forEach(feat => {
                    try {
                        if (feat.geometry && (feat.geometry.type === 'LineString' || feat.geometry.type === 'MultiLineString')) {
                            // Cek apakah ruas jalan ini masuk di area pencarian
                            if (turf.booleanIntersects(searchPoly, feat)) {
                                const midPt = turf.center(feat);
                                midPt.properties.sourceRoad = feat; // Simpan ruas jalannya sekalian
                                roadCandidates.push(midPt);
                            }
                        }
                    } catch(e) {}
                });
                
                // Ambil sampel maksimal ~800 titik agar browser tidak hang
                const step = Math.max(1, Math.floor(roadCandidates.length / 800));
                const sampledGrid = [];
                for (let i = 0; i < roadCandidates.length; i += step) {
                    sampledGrid.push(roadCandidates[i]);
                }
                grid = turf.featureCollection(sampledGrid);
                
            } else {
                // Fallback ke Grid Biasa jika layer jalan tidak dimuat
                grid = turf.pointGrid(searchBounds, cellSize, {units: 'kilometers'});
    
                // Hapus titik grid yang jatuh di luar daratan/batas Surabaya
                if (maskPolygons.length > 0) {
                    const filteredGrid = [];
                    turf.featureEach(grid, function(pt) {
                        let inside = false;
                        for (let poly of maskPolygons) {
                            if (turf.booleanPointInPolygon(pt, poly)) {
                                inside = true; break;
                            }
                        }
                        if (inside) filteredGrid.push(pt);
                    });
                    if (filteredGrid.length > 0) {
                        grid = turf.featureCollection(filteredGrid);
                    }
                }
            }

            // 3. Persiapkan layer penimbang (Kepadatan Penduduk)
            const useKepadatan = document.getElementById('mce-kepadatan') && document.getElementById('mce-kepadatan').checked;
            const popLayer = useKepadatan ? geoJsonStore['KEPADATAN_PENDUDUK'] : null;
            let maxDensity = 1;
            if (popLayer && popLayer.features) {
                maxDensity = Math.max(...popLayer.features.map(f => f.properties.DENSITY || 1));
            }

            // 3b. Persiapkan data demografi RW (dari database)
            const useDemografi = document.getElementById('mce-demografi') && document.getElementById('mce-demografi').checked;
            const demografiAvailable = useDemografi && _demografiCache && _demografiCache.kelurahanMap;
            let maxJiwa = 1;
            if (demografiAvailable) {
                const allJiwa = Object.values(_demografiCache.kelurahanMap).map(d => d.total_jiwa);
                maxJiwa = Math.max(...allJiwa, 1);
            }
            
            // Hitung pusat peradaban (pusat geometri dari semua fasilitas eksisting)
            const centerOfMass = turf.center(combinedPoints);

            // 4. Hitung skor gabungan tiap titik kandidat
            let candidates = [];
            turf.featureEach(grid, function(pt) {
                const nearest = turf.nearestPoint(pt, combinedPoints);
                const distance = turf.distance(pt, nearest, {units: 'kilometers'});
                pt.properties.nearestDist = distance;
                
                // Hitung jarak ke pusat kota/peradaban
                const distToCenter = turf.distance(pt, centerOfMass, {units: 'kilometers'});
                
                let densityScore = 0.5; // Skor standar jika data penduduk tidak di-load
                let actualDensity = 0;
                
                if (popLayer && popLayer.features) {
                    for (let poly of popLayer.features) {
                        try {
                            if (turf.booleanPointInPolygon(pt, poly)) {
                                actualDensity = poly.properties.DENSITY || 0;
                                densityScore = (actualDensity / maxDensity) || 0;
                                break;
                            }
                        } catch(e) {}
                    }
                }
                
                pt.properties.density = actualDensity;

                // 4b. Lookup data demografi RW untuk titik ini
                let demografiScore = 0.5;
                let demografiData = null;
                if (demografiAvailable) {
                    demografiData = getDemografiForPoint(pt);
                    if (demografiData) {
                        demografiScore = (demografiData.total_jiwa / maxJiwa) || 0;
                        pt.properties.demografi = demografiData;
                    }
                }
                
                // MCE (Multi-Criteria Evaluation): 
                // 1. Kekosongan (Jarak terjauh dari fasilitas terdekat) = Positif
                // 2. Pusat Kota (Jarak ke tengah-tengah kota) = Negatif (Pinalti agar tidak di ujung laut/tambak)
                // 3. Kepadatan Penduduk = Positif (Pengali)
                // 4. Data Demografi RW (Jumlah KK & Jiwa) = Positif (Pengali tambahan)
                
                let baseScore = distance - (distToCenter * 0.15); // Pinalti ringan untuk pinggiran
                baseScore = Math.max(0, baseScore); // Pastikan tidak negatif
                
                // Hitung pengali populasi (gabungan kepadatan + demografi jika keduanya aktif)
                let populationMultiplier = 1.0;
                let hasAnyPopData = false;
                
                if (popLayer) {
                    populationMultiplier = 0.3 + (densityScore * 0.7);
                    hasAnyPopData = true;
                }
                
                if (demografiAvailable && demografiData) {
                    const demoMultiplier = 0.3 + (demografiScore * 0.7);
                    if (hasAnyPopData) {
                        // Gabungkan kedua skor (rata-rata tertimbang)
                        populationMultiplier = (populationMultiplier * 0.5) + (demoMultiplier * 0.5);
                    } else {
                        populationMultiplier = demoMultiplier;
                        hasAnyPopData = true;
                    }
                }
                
                if (hasAnyPopData) {
                    pt.properties.finalScore = baseScore * populationMultiplier;
                } else {
                    // Jika tidak ada data penduduk, berikan pinalti pinggiran lebih berat (0.3) agar aman
                    pt.properties.finalScore = Math.max(0, distance - (distToCenter * 0.3));
                }
                
                candidates.push(pt);
            });

            // 5. Urutkan dari Skor Kesesuaian Lahan tertinggi
            candidates.sort((a, b) => b.properties.finalScore - a.properties.finalScore);

            // 6. Ambil Top K titik rekomendasi yang tidak saling berdekatan
            const minSpacing = cellSize * 2.5; 
            const topSpots = [];
            for (let i = 0; i < candidates.length && topSpots.length < k; i++) {
                const cand = candidates[i];
                let tooClose = false;
                for (let j = 0; j < topSpots.length; j++) {
                    if (turf.distance(cand, topSpots[j], {units: 'kilometers'}) < minSpacing) {
                        tooClose = true; break;
                    }
                }
                if (!tooClose) topSpots.push(cand);
            }

            // 7. Snap titik rekomendasi ke Jaringan Jalan terdekat (Jika Layer Jalan Dimuat)
            let snappedToRoad = false;
            
            if (jalanLayer && jalanLayer.features) {
                snappedToRoad = true;
                topSpots.forEach((spot) => {
                    const searchBuffer = turf.buffer(spot, 1.5, {units: 'kilometers'});
                    const nearbyLines = [];
                    
                    // Filter ruas jalan yang ada di sekitar radius rekomendasi
                    jalanLayer.features.forEach(feat => {
                        try {
                            if (feat.geometry && (feat.geometry.type === 'LineString' || feat.geometry.type === 'MultiLineString')) {
                                if (turf.booleanIntersects(searchBuffer, feat)) {
                                    nearbyLines.push(feat);
                                }
                            }
                        } catch(e) {}
                    });
                    
                    if (nearbyLines.length > 0) {
                        const localLines = turf.featureCollection(nearbyLines);
                        try {
                            // Cari titik koordinat paling presisi yang menempel di ruas jalan
                            const snapped = turf.nearestPointOnLine(localLines, spot, {units: 'kilometers'});
                            if (snapped) {
                                spot.geometry = snapped.geometry; // Pindahkan titik pusat rekomendasi persis ke jalan
                                spot.properties.roadSegment = nearbyLines[snapped.properties.index]; // Simpan ruas jalannya
                            }
                        } catch(e) {}
                    }
                });
            }

            // 8. Format ke struktur yang siap di-render
            const clusterScores = [];
            const maxScore = topSpots.length > 0 ? topSpots[0].properties.finalScore : 1;
            
            topSpots.forEach((spot, idx) => {
                const searchRadius = spot.properties.nearestDist * 1.8;
                const nearbyPoints = allFeatures.filter(f => turf.distance(spot, f, {units: 'kilometers'}) <= searchRadius);
                nearbyPoints.sort((a, b) => turf.distance(spot, a) - turf.distance(spot, b));
                const spiderPoints = nearbyPoints.slice(0, 5);
                
                const score = (spot.properties.finalScore / maxScore) * 100;

                clusterScores.push({
                    rank: idx + 1,
                    center: spot,
                    points: spiderPoints,
                    nearestDist: spot.properties.nearestDist,
                    density: spot.properties.density,
                    hasDensity: !!popLayer,
                    demografi: spot.properties.demografi || null,
                    hasDemografi: demografiAvailable,
                    roadSegment: spot.properties.roadSegment,
                    isRoadSnapped: snappedToRoad,
                    score: score
                });
            });

            const recommendations = L.featureGroup();
            const boundaries = L.featureGroup();

            clusterScores.forEach((cluster) => {
                const rank = cluster.rank;
                const coord = cluster.center.geometry.coordinates;
                
                let rankBadgeClass = 'rank-other';
                let rankIcon = `${rank}`;
                let rankLabel = '';
                
                if (rank === 1) { rankBadgeClass = 'rank-1'; rankIcon = 'Prioritas Utama'; rankLabel = '(Ranking 1)'; }
                else if (rank === 2) { rankBadgeClass = 'rank-2'; rankIcon = 'Prioritas Kedua'; rankLabel = '(Ranking 2)'; }
                else if (rank === 3) { rankBadgeClass = 'rank-3'; rankIcon = 'Prioritas Ketiga'; rankLabel = '(Ranking 3)'; }
                else { rankLabel = `Ranking ${rank}`; }

                const popupContent = `
                    <div style="min-width: 250px; font-family: sans-serif;">
                        <div style="text-align: center; margin-bottom: 12px;">
                            <span class="${rankBadgeClass} rank-badge">
                                ${rankIcon} ${rankLabel}
                            </span>
                        </div>
                        
                        <div style="border:1px solid #e2e8f0; padding:10px; border-radius:6px; margin-bottom:10px;">
                            <div style="font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px;">
                                Skor Kesesuaian Lahan (MCE)
                            </div>
                            <div style="font-size:16px; font-weight:700; color:#1e293b; text-align:center; margin-bottom:4px;">
                                ${cluster.score.toFixed(1)} / 100
                            </div>
                            <div class="score-bar">
                                <div class="score-fill" style="width: ${cluster.score}%;"></div>
                            </div>
                        </div>

                        <div style="border:1px solid #e2e8f0; padding:10px; border-radius:6px; margin-bottom:10px;">
                            <div style="font-size:11px; font-weight:600; color:#64748b; margin-bottom:8px;">
                                Faktor Penentu (Kriteria)
                            </div>
                            
                            <div class="metric-item">
                                <span class="metric-label">Kekosongan (Blank Spot)</span>
                                <span class="metric-value">${(cluster.nearestDist * 1000).toFixed(0)} meter</span>
                            </div>
                            
                            ${cluster.hasDensity ? `
                            <div class="metric-item">
                                <span class="metric-label">Kepadatan Penduduk</span>
                                <span class="metric-value">${cluster.density.toLocaleString('id-ID')} jiwa/km²</span>
                            </div>
                            ` : `
                            <div class="metric-item">
                                <span class="metric-label">Kepadatan Penduduk</span>
                                <span class="metric-value" style="color:#ef4444;font-size:10px;">Data tidak dimuat</span>
                            </div>
                            `}
                            
                            ${cluster.hasDemografi ? (cluster.demografi ? `
                            <div class="metric-item" style="margin-top:6px; border-top:1px dashed #cbd5e1; padding-top:6px;">
                                <span class="metric-label" style="color:#7c3aed"><i class="bi bi-people-fill"></i> Kelurahan</span>
                                <span class="metric-value" style="color:#7c3aed; font-size:10px;">${cluster.demografi.kelurahan}</span>
                            </div>
                            <div class="metric-item">
                                <span class="metric-label">Jumlah KK</span>
                                <span class="metric-value">${cluster.demografi.total_kk.toLocaleString('id-ID')} KK</span>
                            </div>
                            <div class="metric-item">
                                <span class="metric-label">Jumlah Jiwa</span>
                                <span class="metric-value">${cluster.demografi.total_jiwa.toLocaleString('id-ID')} jiwa</span>
                            </div>
                            ` : `
                            <div class="metric-item" style="margin-top:6px; border-top:1px dashed #cbd5e1; padding-top:6px;">
                                <span class="metric-label" style="color:#94a3b8"><i class="bi bi-people"></i> Demografi</span>
                                <span class="metric-value" style="color:#94a3b8; font-size:10px;">Tidak dalam area kelurahan</span>
                            </div>
                            `) : ''}

                            ${cluster.isRoadSnapped ? `
                            <div class="metric-item" style="margin-top:6px; border-top:1px dashed #cbd5e1; padding-top:6px;">
                                <span class="metric-label" style="color:#059669"><i class="bi bi-signpost-split-fill"></i> Aksesibilitas</span>
                                <span class="metric-value" style="color:#059669; font-size:10px;">Tepat di pinggir jalan</span>
                            </div>
                            ` : `
                            <div class="metric-item" style="margin-top:6px; border-top:1px dashed #cbd5e1; padding-top:6px;">
                                <span class="metric-label" style="color:#94a3b8"><i class="bi bi-signpost-split"></i> Aksesibilitas</span>
                                <span class="metric-value" style="color:#94a3b8; font-size:10px;">Data jalan tidak dimuat</span>
                            </div>
                            `}
                        </div>

                        <div style="background:#f8fafc; padding:8px; border-radius:4px; margin-bottom:10px;">
                            <div style="font-size:11px; color:#475569; line-height:1.4;">
                                ${rank === 1 ? 'Sangat strategis: area kekosongan paling besar ' + (cluster.hasDensity ? 'dengan potensi demand (penduduk) yang tinggi' : '') + (cluster.isRoadSnapped ? ', dan langsung terhubung dengan akses jalan utama.' : '.') : 
                                  rank === 2 ? 'Prioritas kedua: keseimbangan yang baik antara jarak fasilitas dan kebutuhan.' :
                                  'Titik alternatif pemerataan infrastruktur.'}
                            </div>
                        </div>

                        <a href="http://maps.google.com/maps?q=${coord[1]},${coord[0]}" target="_blank" 
                           style="display:block; text-align:center; background:#334155; color:white; padding:8px; 
                                  border-radius:4px; text-decoration:none; font-weight:600; font-size:12px;">
                           Buka di Google Maps
                        </a>
                    </div>
                `;

                const markerSize = rank === 1 ? 16 : rank === 2 ? 14 : 12;
                const markerColor = rank === 1 ? '#ffd700' : rank === 2 ? '#c0c0c0' : rank === 3 ? '#cd7f32' : '#ef4444';
                
                const marker = L.circleMarker([coord[1], coord[0]], {
                    radius: markerSize, 
                    fillColor: markerColor,
                    color: '#fff', 
                    weight: 3, 
                    fillOpacity: 0.95
                }).bindPopup(popupContent, { maxWidth: 320 });
                
                marker.addTo(recommendations);

                // Garis spider web ke fasilitas terdekat yang ada di sekitarnya
                if (cluster.points && cluster.points.length > 0) {
                    cluster.points.forEach(point => {
                        const pointCoord = point.geometry.coordinates;
                        L.polyline([
                            [coord[1], coord[0]],          
                            [pointCoord[1], pointCoord[0]] 
                        ], {
                            color: markerColor,
                            weight: 1.5,
                            opacity: 0.6,
                            dashArray: '4, 5'
                        }).addTo(boundaries);
                    });
                }
                
                // Gambar ruas jalan terdekat (Jika tersedia dari snapping)
                if (cluster.roadSegment) {
                    L.geoJSON(cluster.roadSegment, {
                        style: {
                            color: markerColor, // Warnai sesuai ranking
                            weight: 6,          // Buat tebal agar jelas terlihat
                            opacity: 0.8
                        }
                    }).addTo(boundaries);
                }
                
                // Gambar lingkaran radius jangkauan "Blank Spot"
                L.circle([coord[1], coord[0]], {
                    radius: cluster.nearestDist * 1000, // meter
                    color: markerColor,
                    weight: 2,
                    dashArray: '5, 5',
                    fillOpacity: 0.08,
                    fillColor: markerColor
                }).addTo(boundaries);
            });

            mapLayers['ANALYSIS_RESULT'] = recommendations;
            mapLayers['CLUSTER_BOUNDARIES'] = boundaries;
            
            map.addLayer(boundaries);
            boundaries.bringToBack();
            map.addLayer(recommendations);
            map.fitBounds(recommendations.getBounds(), { padding: [50, 50] });

            statusDiv.innerHTML = `Selesai! ${k} titik rekomendasi dengan ranking.`;
            infoLegend.update();

        } catch (error) {
            console.error(error);
            statusDiv.innerHTML = `<span style="color:#ef4444;">Gagal: ${error.message}</span>`;
        }
    }, 100);
}

// ============================================================
// FITUR ANALISIS HEATMAP
// ============================================================
function runHeatmapAnalysis() {
    const statusDiv = document.getElementById('analysis-result');
    const selectedCheckboxes = document.querySelectorAll('.analysis-source:checked');
    
    if (selectedCheckboxes.length === 0) {
        alert("Pilih minimal satu sumber data untuk dianalisis.");
        return;
    }

    statusDiv.style.display = 'block';
    statusDiv.innerHTML = 'Menghitung intensitas per kelurahan...';

    if (mapLayers['HEATMAP_LAYER']) {
        map.removeLayer(mapLayers['HEATMAP_LAYER']);
        delete mapLayers['HEATMAP_LAYER'];
    }
    window._heatmapMeta = null;

    if (mapLayers['ANALYSIS_RESULT']) {
        map.removeLayer(mapLayers['ANALYSIS_RESULT']);
        delete mapLayers['ANALYSIS_RESULT'];
    }
    
    if (mapLayers['CLUSTER_BOUNDARIES']) {
        map.removeLayer(mapLayers['CLUSTER_BOUNDARIES']);
        delete mapLayers['CLUSTER_BOUNDARIES'];
    }

    setTimeout(() => {
        try {
            let allPoints = [];
            
            selectedCheckboxes.forEach(cb => {
                const key = cb.value;
                if (geoJsonStore[key] && geoJsonStore[key].features) {
                    const pointFeatures = geoJsonStore[key].features.filter(f => 
                        f.geometry && f.geometry.type === 'Point'
                    );
                    allPoints = allPoints.concat(pointFeatures);
                }
            });

            if (allPoints.length === 0) {
                throw new Error("Data sumber kosong atau belum dimuat.");
            }

            if (!geoJsonStore['KELURAHAN'] || !geoJsonStore['KELURAHAN'].features) {
                throw new Error("Data kelurahan belum dimuat. Silakan muat data kelurahan terlebih dahulu.");
            }

            const kelurahanData = geoJsonStore['KELURAHAN'].features.map(kelFeature => {
                let pointCount = 0;
                
                try {
                    if (!kelFeature.geometry || !kelFeature.geometry.coordinates) {
                        console.warn("Invalid kelurahan geometry:", kelFeature.properties);
                        return {
                            feature: kelFeature,
                            count: 0,
                            name: kelFeature.properties.K || kelFeature.properties.KELURAHAN || kelFeature.properties.DESA || kelFeature.properties.name || 'Tidak Diketahui'
                        };
                    }

                    const coords = kelFeature.geometry.coordinates;
                    let isValid = false;

                    const isValidRing = (ring) => {
                        return Array.isArray(ring) && ring.length >= 4;
                    };

                    if (kelFeature.geometry.type === 'Polygon') {
                        isValid = coords.length > 0 && isValidRing(coords[0]);
                    } else if (kelFeature.geometry.type === 'MultiPolygon') {
                        isValid = coords.length > 0 && 
                                 coords[0].length > 0 && 
                                 isValidRing(coords[0][0]);
                    }

                    if (!isValid) {
                        console.warn("Invalid polygon coordinates:", kelFeature.properties);
                        return {
                            feature: kelFeature,
                            count: 0,
                            name: kelFeature.properties.K || kelFeature.properties.KELURAHAN || kelFeature.properties.DESA || kelFeature.properties.name || 'Tidak Diketahui'
                        };
                    }

                    let allRingsValid = true;
                    if (kelFeature.geometry.type === 'Polygon') {
                        allRingsValid = coords.every(ring => isValidRing(ring));
                    } else if (kelFeature.geometry.type === 'MultiPolygon') {
                        allRingsValid = coords.every(polygon => 
                            polygon.every(ring => isValidRing(ring))
                        );
                    }

                    if (!allRingsValid) {
                        console.warn("Some rings invalid in polygon:", kelFeature.properties);
                        return {
                            feature: kelFeature,
                            count: 0,
                            name: kelFeature.properties.K || kelFeature.properties.KELURAHAN || kelFeature.properties.DESA || kelFeature.properties.name || 'Tidak Diketahui'
                        };
                    }

                    let kelPoly;
                    if (kelFeature.geometry.type === 'Polygon') {
                        kelPoly = turf.polygon(coords);
                    } else if (kelFeature.geometry.type === 'MultiPolygon') {
                        kelPoly = turf.multiPolygon(coords);
                    } else {
                        throw new Error('Unsupported geometry type: ' + kelFeature.geometry.type);
                    }
                    
                    allPoints.forEach(point => {
                        try {
                            if (turf.booleanPointInPolygon(point, kelPoly)) {
                                pointCount++;
                            }
                        } catch (e) {
                            // Abaikan
                        }
                    });
                } catch (e) {
                    console.warn("Error processing kelurahan polygon:", e, kelFeature.properties);
                }
                
                return {
                    feature: kelFeature,
                    count: pointCount,
                    name: kelFeature.properties.K || kelFeature.properties.KELURAHAN || kelFeature.properties.DESA || kelFeature.properties.name || 'Tidak Diketahui'
                };
            });

            const counts = kelurahanData.map(d => d.count);
            const minCount = Math.min(...counts);
            const maxCount = Math.max(...counts);

            function getColor(count) {
                if (maxCount === minCount) {
                    return '#ff6666';
                }
                
                const normalized = (count - minCount) / (maxCount - minCount);
                
                const r = Math.round(255 - (127 * normalized));
                const g = Math.round(224 * (1 - normalized));
                const b = Math.round(224 * (1 - normalized));
                
                return `rgb(${r}, ${g}, ${b})`;
            }

            // Simpan info heatmap ke global agar PDF export bisa membacanya
            window._heatmapMeta = {
                minCount: minCount,
                maxCount: maxCount,
                getColor: getColor,
                // Breakpoints representatif untuk legenda PDF (5 tingkatan)
                steps: (function() {
                    const steps = [];
                    const labels = ['Sangat Rendah', 'Rendah', 'Sedang', 'Tinggi', 'Sangat Tinggi'];
                    for (let i = 0; i < 5; i++) {
                        const ratio = i / 4;
                        const count = Math.round(minCount + ratio * (maxCount - minCount));
                        steps.push({ count: count, color: getColor(count), label: labels[i] });
                    }
                    return steps;
                })()
            };

            const heatmapLayer = L.geoJSON(geoJsonStore['KELURAHAN'], {
                style: (feature) => {
                    const data = kelurahanData.find(d => d.feature === feature);
                    const count = data ? data.count : 0;
                    
                    return {
                        fillColor: getColor(count),
                        weight: 1.5,
                        opacity: 1,
                        color: 'white',
                        fillOpacity: 0.75
                    };
                },
                onEachFeature: (feature, layer) => {
                    const data = kelurahanData.find(d => d.feature === feature);
                    const count = data ? data.count : 0;
                    const name = data ? data.name : 'Tidak Diketahui';
                    
                    const percentage = maxCount > 0 ? ((count / maxCount) * 100).toFixed(1) : 0;
                    
                    const popupContent = `
                        <div style="min-width: 200px; font-family: sans-serif;">
                            <div style="font-weight: 700; font-size: 14px; color: #1e293b; margin-bottom: 10px; padding-bottom: 8px; border-bottom: 2px solid #e2e8f0;">
                                ${name}
                            </div>
                            
                            <div style="border:1px solid #e2e8f0; padding:10px; border-radius:6px; margin-bottom:10px; background: #f8fafc;">
                                <div style="font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px;">
                                    Jumlah Objek
                                </div>
                                <div style="font-size:24px; font-weight:700; color:#1e293b; text-align:center; margin-bottom:8px;">
                                    ${count}
                                </div>
                                <div style="height: 10px; background: #e2e8f0; border-radius: 5px; overflow: hidden; margin-bottom: 6px;">
                                    <div style="height: 100%; background: ${getColor(count)}; width: ${percentage}%; transition: width 0.3s;"></div>
                                </div>
                                <div style="font-size:11px; color:#64748b; text-align:center;">
                                    ${percentage}% dari maksimal (${maxCount} titik)
                                </div>
                            </div>

                            <div style="background: linear-gradient(#3A9AFF); padding:10px; border-radius:6px; font-size:11px; color:white; line-height:1.4; text-align: center; font-weight: 600;">
                                ${count === maxCount ? 'Objek Pada Area ini (Tinggi Sekali)' : 
                                  count === minCount ? 'Objek Pada Area ini (Tidak Ada)' :
                                  count > (maxCount * 0.7) ? 'Objek Pada Area ini (Tinggi)' :
                                  count > (maxCount * 0.4) ? 'Objek Pada Area ini (Sedang)' :
                                  'Objek Pada Area ini (Rendah)'}
                            </div>
                        </div>
                    `;
                    
                    layer.bindPopup(popupContent);
                    
                    layer.on('mouseover', function() {
                        this.setStyle({
                            weight: 3,
                            fillOpacity: 0.9
                        });
                        if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                            this.bringToFront();
                        }
                    });
                    
                    layer.on('mouseout', function() {
                        heatmapLayer.resetStyle(this);
                    });
                }
            });

            mapLayers['HEATMAP_LAYER'] = heatmapLayer;
            heatmapLayer.addTo(map);
            
            heatmapLayer.bringToBack();
            
            Object.keys(mapLayers).forEach(key => {
                if (key !== 'HEATMAP_LAYER' && 
                    key !== 'KECAMATAN' && 
                    key !== 'KELURAHAN' && 
                    key !== 'SURABAYA_MASK' &&
                    mapLayers[key] && 
                    map.hasLayer(mapLayers[key])) {
                    mapLayers[key].bringToFront();
                }
            });
            
            if (mapLayers['CLUSTER_BOUNDARIES'] && map.hasLayer(mapLayers['CLUSTER_BOUNDARIES'])) {
                mapLayers['CLUSTER_BOUNDARIES'].bringToFront();
            }
            if (mapLayers['ANALYSIS_RESULT'] && map.hasLayer(mapLayers['ANALYSIS_RESULT'])) {
                mapLayers['ANALYSIS_RESULT'].bringToFront();
            }

            // FIX untuk Heatmap Legend Display
            const legendDiv = infoLegend._heatmapDiv; // Ambil dari container legend

            if (legendDiv) {
                legendDiv.style.display = 'block';
                
                // Update content heatmap legend
                legendDiv.innerHTML = `
                    <div class="legend-title">
                        <i class="bi bi-thermometer-half"></i> Intensitas Nilai
                    </div>
                    <div id="legend-gradient"></div>
                    <div style="display:flex; justify-content:space-between; font-size:11px; color:#64748b;">
                        <span>Rendah</span>
                        <span>Sedang</span>
                        <span>Tinggi</span>
                    </div>
                    <div id="legend-values">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                            <span>Min:</span>
                            <span style="font-weight: 600;">${minCount} titik</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>Max:</span>
                            <span style="font-weight: 600;">${maxCount} titik</span>
                        </div>
                    </div>
                `;
            }

            statusDiv.innerHTML = `
                Analisis selesai! ${kelurahanData.length} kelurahan dianalisis. 
                Total ${allPoints.length} titik data.
            `;

            infoLegend.update();

        } catch (error) {
            console.error('Error in heatmap analysis:', error);
            statusDiv.innerHTML = `Error: ${error.message}`;
        }
    }, 100);
}
// ============================================================
// AUTO-INIT: Populate checkbox setelah DOM + data siap
// ============================================================
(function() {
    function _tryInit() {
        if (typeof layerConfig === 'undefined' || typeof geoJsonStore === 'undefined') {
            setTimeout(_tryInit, 400);
            return;
        }
        // Tunggu container tersedia
        const container = document.getElementById('analysis-sources-container');
        if (!container) {
            setTimeout(_tryInit, 400);
            return;
        }
        populateAnalysisSources();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() { setTimeout(_tryInit, 800); });
    } else {
        setTimeout(_tryInit, 800);
    }
})();