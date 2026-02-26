// ============================================================
// EVENT-HANDLERS.JS - FIXED (Reset Bug + Clean Legend)
// ============================================================

// Function to initialize event listeners
function initEventListeners() {
    // 1. Event listeners untuk layer toggle (Checkbox Utama)
    document.querySelectorAll('.layer-toggle').forEach(checkbox => {
        checkbox.addEventListener('change', (e) => {
            const layerKey = e.target.dataset.layer;
            
            // Jika user mencentang manual dan data belum ada
            if (e.target.checked && !mapLayers[layerKey]) {
                console.log(`User mengaktifkan ${layerKey}, data belum ada. Loading...`);
                loadLayer(layerKey).then(() => {
                    toggleLayer(layerKey, true);
                }).catch(err => {
                    console.error(`Gagal memuat ${layerKey}`, err);
                    e.target.checked = false; 
                });
            } else {
                toggleLayer(layerKey, e.target.checked);
            }
        });
    });

    // 2. Event Listener Masking Surabaya
    const surabayaMaskToggle = document.getElementById('surabaya-mask-toggle');
    if (surabayaMaskToggle) {
        surabayaMaskToggle.addEventListener('change', (e) => {
            toggleSurabayaMask(e.target.checked);
        });
    }

    // 3. Event Listener Label Toggle
    document.querySelectorAll('.layer-label-toggle').forEach(checkbox => {
        checkbox.addEventListener('change', (e) => {
            const layerKey = e.target.dataset.layer;
            toggleLabel(layerKey, e.target.checked);
        });
    });
}

/**
 * Helper: Mengembalikan Style Asli Layer Boundary
 */
function resetBoundaryStyle(layer, config) {
    if (!layer || !config) return;
    
    // Style standar untuk batas wilayah (garis putus-putus)
    const normalStyle = {
        color: config.color, 
        weight: 2, 
        opacity: 0.8,
        fillOpacity: 0.1, 
        fillColor: config.color, 
        dashArray: '5, 5'
    };

    layer.setStyle(normalStyle);
}

/**
 * Helper: Mengatur Logika Show/Hide Layer (VISUAL & ORDERING)
 */
function toggleLayer(layerKey, isChecked) {
    if (!mapLayers[layerKey]) {
        console.warn(`toggleLayer: Data ${layerKey} belum siap.`);
        return;
    }

    const layer = mapLayers[layerKey];
    const config = layerConfig[layerKey];

    if (isChecked) {
        if (!map.hasLayer(layer)) {
            map.addLayer(layer);
        }

        // Reset style untuk boundary layers
        if (config.isBoundary) {
            resetBoundaryStyle(layer, config);
        }

        // Delay reorder untuk memastikan render selesai
        setTimeout(() => {
            reorderLayers();
        }, 100);

    } else {
        if (map.hasLayer(layer)) {
            map.removeLayer(layer);
        }
    }
    
    if (typeof infoLegend !== 'undefined') infoLegend.update();
}

/**
 * Helper: Fungsi Khusus untuk Menata Ulang Urutan Layer
 * Urutan dari bawah ke atas:
 *   1. SURABAYA_MASK         (paling bawah)
 *   2. Polygon data          (kepadatan, area rayon, dll)
 *   3. Heatmap               (di atas polygon data)
 *   4. Batas wilayah         (di atas semua polygon, garis terlihat jelas)
 *   5. Garis rute            (di atas batas)
 *   6. Marker titik          (paling atas)
 */
function reorderLayers() {
    // 1. SURABAYA_MASK — paling bawah
    if (mapLayers['SURABAYA_MASK'] && map.hasLayer(mapLayers['SURABAYA_MASK'])) {
        mapLayers['SURABAYA_MASK'].bringToBack();
    }

    // 2. Polygon data besar — di atas mask
    const polygonLayers = ['KEPADATAN_PENDUDUK', 'POMPA_AIR_7_RAYON', 'AREA_RAYON', 'MAKAM', 'BADAN_AIR'];
    polygonLayers.forEach(key => {
        if (mapLayers[key] && map.hasLayer(mapLayers[key])) {
            mapLayers[key].bringToFront();
        }
    });

    // 3. Heatmap — di atas polygon data
    if (mapLayers['HEATMAP_LAYER'] && map.hasLayer(mapLayers['HEATMAP_LAYER'])) {
        mapLayers['HEATMAP_LAYER'].bringToFront();
    }

    // 4. Batas wilayah — di atas semua polygon agar garisnya terlihat
    const boundaryLayers = ['BATAS_KOTA', 'KECAMATAN', 'KELURAHAN', 'BATAS_RW'];
    boundaryLayers.forEach(key => {
        if (mapLayers[key] && map.hasLayer(mapLayers[key])) {
            mapLayers[key].bringToFront();
        }
    });

    // 5. Garis rute — di atas batas wilayah
    const lineLayers = ['JARINGAN_PIPA_SALURAN', 'SALURAN_AIR', 'RUTE_SAMPAH'];
    lineLayers.forEach(key => {
        if (mapLayers[key] && map.hasLayer(mapLayers[key])) {
            mapLayers[key].bringToFront();
        }
    });

    // 6. Marker titik — paling atas
    const markerLayers = [
        'POINT_RUTE_SAMPAH', 'CCTV_EKSISTING', 'CCTV_RENCANA',
        'TITIK_SAMPAH', 'TITIK_SAMPAH_RENCANA', 'TPS', 'TPS3R',
        'DAMKAR', 'PAUD', 'SD_MI', 'SMP_MTS', 'RUKOM',
        'DEKORASI_KOTA', 'TITIK_POMPA_AIR',
        'ANALYSIS_RESULT', 'CLUSTER_BOUNDARIES'
    ];
    markerLayers.forEach(key => {
        if (mapLayers[key] && map.hasLayer(mapLayers[key])) {
            mapLayers[key].bringToFront();
        }
    });
}

/**
 * Helper: Mengatur Logika Label
 */
function toggleLabel(layerKey, isChecked) {
    if (!mapLayers[layerKey]) return;

    const boundaryCheckbox = document.querySelector(`input.layer-toggle[data-layer="${layerKey}"]`);
    const config = layerConfig[layerKey];

    // Jika label dinyalakan tapi layer utama mati, nyalakan layer
    if (isChecked && !map.hasLayer(mapLayers[layerKey])) {
        map.addLayer(mapLayers[layerKey]);
        // Pastikan urutan benar
        setTimeout(() => reorderLayers(), 100);
    }

    if (config.isBoundary) {
        mapLayers[layerKey].setStyle((feature) => {
            if (boundaryCheckbox && boundaryCheckbox.checked) {
                // Style Normal (Garis terlihat)
                return {
                    color: config.color, weight: 2, opacity: 0.8,
                    fillOpacity: 0.1, fillColor: config.color, dashArray: '5, 5'
                };
            } else if (isChecked) {
                // Style Transparan (Hanya label)
                return {
                    color: config.color, weight: 0, opacity: 0,
                    fillOpacity: 0, fillColor: 'transparent'
                };
            }
            // Fallback
            return { color: config.color, weight: 2 };
        });
    }

    // Atur Tooltip/Label
    mapLayers[layerKey].eachLayer(function(layer) {
        if (layer.getTooltip()) {
            const content = layer.getTooltip().getContent();
            layer.unbindTooltip();
            layer.bindTooltip(content, {
                permanent: isChecked,
                direction: 'center',
                className: layerKey === 'KECAMATAN' ? 'kecamatan-label' : 'kelurahan-label',
                sticky: false
            });
            if (isChecked) layer.openTooltip();
            else layer.closeTooltip();
        }
    });

    // Jika Label dimatikan DAN Layer Utama juga mati, baru remove layer dari peta
    if (!isChecked && boundaryCheckbox && !boundaryCheckbox.checked) {
        map.removeLayer(mapLayers[layerKey]);
    }
}

/**
 * FUNGSI RESET PETA - FIXED (Menghapus Semua Layer & Legenda)
 */
async function resetMap() {
    const resetOverlay = document.getElementById('reset-overlay');
    
    try {
        if (resetOverlay) resetOverlay.style.display = 'flex';

        console.log("🔄 === MEMULAI RESET PETA ===");

        // 1. RESET VIEW KE KOORDINAT SURABAYA
        console.log("📍 Reset view ke koordinat Surabaya...");
        map.setView(centerPoint, 12, { animate: true, duration: 0.5 });

        // 2. HAPUS SEMUA LAYER ANALISIS
        console.log("🗑️ Menghapus layer analisis...");
        const analysisLayers = ['ANALYSIS_RESULT', 'CLUSTER_BOUNDARIES', 'HEATMAP_LAYER'];
        analysisLayers.forEach(layerKey => {
            if (mapLayers[layerKey]) { 
                if (map.hasLayer(mapLayers[layerKey])) {
                    map.removeLayer(mapLayers[layerKey]); 
                }
                delete mapLayers[layerKey]; 
            }
        });
        
        // 3. HAPUS SEMUA ELEMEN UI ANALISIS
        console.log("🧹 Membersihkan UI...");
        const heatmapLegend = document.getElementById('heatmap-legend');
        if (heatmapLegend) heatmapLegend.style.display = 'none';
        
        const analysisResult = document.getElementById('analysis-result');
        if (analysisResult) { 
            analysisResult.style.display = 'none'; 
            analysisResult.innerHTML = ''; 
        }
        
        // Uncheck analysis sources
        document.querySelectorAll('.analysis-source').forEach(cb => cb.checked = false);
        
        // Refresh daftar sumber data analisis
        if (typeof populateAnalysisSources === 'function') {
            populateAnalysisSources();
        }
        
        // 4. MATIKAN SEMUA LAYER DAN UNCHECK CHECKBOX
        console.log("❌ Mematikan semua layer...");
        
        // Matikan semua checkbox layer
        document.querySelectorAll('.layer-toggle').forEach(cb => {
            cb.checked = false;
        });
        
        // Matikan semua checkbox label
        document.querySelectorAll('.layer-label-toggle').forEach(cb => {
            cb.checked = false;
        });
        
        // Remove semua layer dari peta
        Object.keys(mapLayers).forEach(key => {
            // Skip mask dan base layer
            if (key !== 'SURABAYA_MASK' && mapLayers[key]) {
                if (map.hasLayer(mapLayers[key])) {
                    map.removeLayer(mapLayers[key]);
                }
            }
        });

        // 5. BERSIHKAN LEGENDA
        console.log("🧼 Membersihkan legenda...");
        if (typeof infoLegend !== 'undefined' && infoLegend.update) {
            infoLegend.update();
        }
        
        // Atau hapus legenda secara manual
        const legendDiv = document.querySelector('.info.legend');
        if (legendDiv) {
            legendDiv.innerHTML = '<h4>Legenda</h4><div style="padding:8px; color:#64748b; font-size:12px;">Tidak ada layer aktif</div>';
        }

        // 6. PASTIKAN BASE LAYER DAN MASK AKTIF
        console.log("✅ Mengaktifkan base layer & mask...");
        if (!map.hasLayer(defaultLayer)) {
            map.addLayer(defaultLayer);
        }
        
        const maskCheckbox = document.getElementById('surabaya-mask-toggle');
        if (maskCheckbox) {
            maskCheckbox.checked = true;
            toggleSurabayaMask(true);
        }

        // 7. REFRESH PETA
        await new Promise(resolve => setTimeout(resolve, 200));
        map.invalidateSize();
        
        console.log("✅ === RESET SELESAI ===");
        console.log("📊 Status:");
        console.log("   - View: Kembali ke Surabaya");
        console.log("   - Layer aktif: 0");
        console.log("   - Legenda: Bersih");
        
    } catch (error) {
        console.error("Error saat reset peta:", error);
        alert("Terjadi kesalahan saat reset peta. Silakan refresh halaman.");
    } finally {
        if (resetOverlay) resetOverlay.style.display = 'none';
    }
}

/**
 * FUNGSI UNTUK MENAMPILKAN LABEL RW
 */
function toggleRWLabels(show) {
    if (!mapLayers['BATAS_RW']) {
        console.warn('Layer BATAS_RW belum dimuat');
        return;
    }
    
    mapLayers['BATAS_RW'].eachLayer(function(layer) {
        const rwName = layer.feature.properties.RW || 'RW';
        
        if (show) {
            // Tampilkan label
            if (!layer.getTooltip()) {
                layer.bindTooltip(rwName, {
                    permanent: true,
                    direction: 'center',
                    className: 'rw-label',
                    sticky: false
                });
            }
            layer.openTooltip();
        } else {
            // Sembunyikan label
            if (layer.getTooltip()) {
                layer.closeTooltip();
            }
        }
    });
}