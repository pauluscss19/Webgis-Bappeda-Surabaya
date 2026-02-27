// ============================================================
// ANALYSIS.JS - Fungsi Analisis (Clustering & Heatmap)
// ============================================================

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
        'RUTE_SAMPAH',
        'AREA_RAYON',
        'POMPA_AIR_7_RAYON',
        'JARINGAN_PIPA_SALURAN',
        'MAKAM',
        'SALURAN_AIR'
    ];

    // Override grup untuk layer yang berbeda dari config.js
    const GROUP_OVERRIDE = {
        'RUKOM': 'persampahan'
    };

    // Label grup untuk pengelompokan visual
    const GROUP_LABELS = {
        infrastruktur: 'Infrastruktur',
        pendidikan:    'Pendidikan',
        persampahan:   'Persampahan & Lingkungan',
        fasilitas:     'Fasilitas Umum',
        pompa_saluran: 'Pompa & Saluran Air'
    };

    const GROUP_ICONS = {
        infrastruktur: 'bi-broadcast-pin',
        pendidikan:    'bi-mortarboard-fill',
        persampahan:   'bi-recycle',
        fasilitas:     'bi-buildings-fill',
        pompa_saluran: 'bi-droplet-fill'
    };

    // Kumpulkan layer per grup
    const grouped = {};
    Object.keys(layerConfig).forEach(function(key) {
        const cfg = layerConfig[key];
        if (EXCLUDED_KEYS.includes(key)) return;
        if (cfg.isBoundary) return;
        if (cfg.isLine && !cfg.isPolygon) return;
        const grp = GROUP_OVERRIDE[key] || cfg.group || 'lainnya';
        if (!grouped[grp]) grouped[grp] = [];
        grouped[grp].push({ key: key, cfg: cfg });
    });

    container.innerHTML = '';

    const groupOrder = ['infrastruktur', 'pendidikan', 'persampahan', 'fasilitas', 'pompa_saluran', 'lainnya'];

    groupOrder.forEach(function(grp) {
        if (!grouped[grp] || grouped[grp].length === 0) return;

        // Header grup
        const grpLabel = document.createElement('div');
        grpLabel.style.cssText = [
            'font-size:10px', 'font-weight:700', 'color:#64748b',
            'text-transform:uppercase', 'letter-spacing:0.5px',
            'margin:10px 0 4px 0', 'padding-bottom:4px',
            'border-bottom:1px solid #e2e8f0', 'display:flex',
            'align-items:center', 'gap:5px'
        ].join(';');
        const icon = GROUP_ICONS[grp] || 'bi-pin-map-fill';
        const label = GROUP_LABELS[grp] || (grp.charAt(0).toUpperCase() + grp.slice(1));
        grpLabel.innerHTML = '<i class="bi ' + icon + '" style="font-size:11px;"></i><span>' + label + '</span>';
        container.appendChild(grpLabel);

        // Checkbox tiap layer
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
            wrapper.addEventListener('mouseenter', function() {
                wrapper.style.background = '#f1f5f9';
            });
            wrapper.addEventListener('mouseleave', function() {
                wrapper.style.background = '';
            });

            const cb = document.createElement('input');
            cb.type = 'checkbox';
            cb.className = 'analysis-source';
            cb.value = key;
            cb.disabled = (count === 0);
            cb.title = count === 0 ? 'Data belum dimuat' : '';
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
            
            selectedCheckboxes.forEach(cb => {
                const key = cb.value;
                if (geoJsonStore[key] && geoJsonStore[key].features) {
                    const pointFeatures = geoJsonStore[key].features.filter(f => 
                        f.geometry.type === 'Point'
                    );
                    allFeatures = allFeatures.concat(pointFeatures);
                }
            });

            if (allFeatures.length === 0) {
                throw new Error("Data sumber kosong atau belum dimuat.");
            }

            const combinedPoints = turf.featureCollection(allFeatures);
            const clustered = turf.clustersKmeans(combinedPoints, { numberOfClusters: k });

            const clusterGroups = {};
            turf.featureEach(clustered, (feature) => {
                const clusterId = feature.properties.cluster;
                if (!clusterGroups[clusterId]) clusterGroups[clusterId] = [];
                clusterGroups[clusterId].push(feature);
            });

            const clusterScores = [];
            Object.keys(clusterGroups).forEach(clusterId => {
                const clusterFeatures = turf.featureCollection(clusterGroups[clusterId]);
                const center = turf.center(clusterFeatures);
                const points = clusterGroups[clusterId];
                
                const pointCount = points.length;
                
                let totalDistance = 0;
                points.forEach(point => {
                    const distance = turf.distance(center, point, { units: 'kilometers' });
                    totalDistance += distance;
                });
                const avgDistance = totalDistance / pointCount;
                
                const hull = turf.convex(clusterFeatures);
                const area = hull ? turf.area(hull) / 1000000 : 0;
                
                const density = area > 0 ? pointCount / area : pointCount;
                
                const maxPoints = Math.max(...Object.keys(clusterGroups).map(id => clusterGroups[id].length));
                const maxDensity = Math.max(...Object.keys(clusterGroups).map(id => {
                    const cf = turf.featureCollection(clusterGroups[id]);
                    const h = turf.convex(cf);
                    const a = h ? turf.area(h) / 1000000 : 0;
                    return a > 0 ? clusterGroups[id].length / a : clusterGroups[id].length;
                }));
                
                const pointScore = (pointCount / maxPoints) * 40;
                const distanceScore = (1 / (1 + avgDistance)) * 30;
                const densityScore = (density / maxDensity) * 30;
                
                const totalScore = pointScore + distanceScore + densityScore;
                
                clusterScores.push({
                    clusterId: clusterId,
                    center: center,
                    points: points,
                    pointCount: pointCount,
                    avgDistance: avgDistance,
                    area: area,
                    density: density,
                    score: totalScore,
                    hull: hull
                });
            });

            clusterScores.sort((a, b) => b.score - a.score);

            const recommendations = L.featureGroup();
            const boundaries = L.featureGroup();

            clusterScores.forEach((cluster, index) => {
                const rank = index + 1;
                const coord = cluster.center.geometry.coordinates;
                
                let rankBadgeClass = 'rank-other';
                let rankIcon = `${rank}`;
                let rankLabel = '';
                
                if (rank === 1) {
                    rankBadgeClass = 'rank-1';
                    rankIcon = 'Prioritas Utama';
                    rankLabel = '(Ranking 1)';
                } else if (rank === 2) {
                    rankBadgeClass = 'rank-2';
                    rankIcon = 'Prioritas Kedua';
                    rankLabel = '(Ranking 2)';
                } else if (rank === 3) {
                    rankBadgeClass = 'rank-3';
                    rankIcon = 'Prioritas Ketiga';
                    rankLabel = '(Ranking 3)';
                } else {
                    rankLabel = `Ranking ${rank}`;
                }

                const popupContent = `
                    <div style="min-width: 240px; font-family: sans-serif;">
                        <div style="text-align: center; margin-bottom: 12px;">
                            <span class="${rankBadgeClass} rank-badge">
                                ${rankIcon} ${rankLabel}
                            </span>
                        </div>
                        
                        <div style="border:1px solid #e2e8f0; padding:10px; border-radius:6px; margin-bottom:10px;">
                            <div style="font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px;">
                                Skor Kelayakan
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
                                Data Analisis
                            </div>
                            
                            <div class="metric-item">
                                <span class="metric-label">Jumlah Objek</span>
                                <span class="metric-value">${cluster.pointCount} titik</span>
                            </div>
                            
                            <div class="metric-item">
                                <span class="metric-label">Jarak Rata-rata</span>
                                <span class="metric-value">${cluster.avgDistance.toFixed(2)} km</span>
                            </div>
                            
                            <div class="metric-item">
                                <span class="metric-label">Cakupan Area</span>
                                <span class="metric-value">${cluster.area.toFixed(3)} km²</span>
                            </div>
                            
                            <div class="metric-item">
                                <span class="metric-label">Kepadatan</span>
                                <span class="metric-value">${cluster.density.toFixed(1)} titik/km²</span>
                            </div>
                        </div>

                        <div style="background:#f8fafc; padding:8px; border-radius:4px; margin-bottom:10px;">
                            <div style="font-size:11px; color:#475569; line-height:1.4;">
                                ${rank === 1 ? 'Prioritas utama dengan skor tertinggi.' : 
                                  rank === 2 ? 'Prioritas kedua dengan potensi strategis baik.' :
                                  rank === 3 ? 'Alternatif ketiga yang layak dipertimbangkan.' :
                                  'Potensi lebih rendah dari alternatif lain.'}
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

                if(cluster.hull) {
                    L.geoJSON(cluster.hull, {
                        style: { 
                            color: markerColor,
                            weight: 2, 
                            dashArray: '5, 5', 
                            fillOpacity: 0.15,
                            fillColor: markerColor
                        }
                    }).addTo(boundaries);
                }
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