// ============================================================
// EVENT-HANDLERS.JS
// On-demand: fetch terjadi saat checkbox dicentang, bukan saat init.
// Checkbox dinonaktifkan sementara & tampil spinner saat loading.
// ============================================================

function initEventListeners() {

    // 1. Layer toggle (checkbox utama)
    document.querySelectorAll('.layer-toggle').forEach(checkbox => {
        checkbox.addEventListener('change', async (e) => {
            const layerKey = e.target.dataset.layer;

            if (e.target.checked) {
                // Jika data belum ada → fetch sekarang
                if (!geoJsonStore[layerKey]) {
                    _setCheckboxLoading(e.target, true);
                    try {
                        await loadLayer(layerKey);
                    } catch (err) {
                        console.error(`Gagal memuat ${layerKey}`, err);
                        e.target.checked = false;
                        _setCheckboxLoading(e.target, false);
                        return;
                    }
                    _setCheckboxLoading(e.target, false);
                }
                toggleLayer(layerKey, true);
            } else {
                toggleLayer(layerKey, false);
            }
        });
    });

    // 2. Masking Surabaya
    const surabayaMaskToggle = document.getElementById('surabaya-mask-toggle');
    if (surabayaMaskToggle) {
        surabayaMaskToggle.addEventListener('change', (e) => {
            toggleSurabayaMask(e.target.checked);
        });
    }

    // 3. Label toggle
    document.querySelectorAll('.layer-label-toggle').forEach(checkbox => {
        checkbox.addEventListener('change', async (e) => {
            const layerKey = e.target.dataset.layer;

            // Jika label dinyalakan tapi data belum ada → fetch dulu
            if (e.target.checked && !geoJsonStore[layerKey]) {
                _setCheckboxLoading(e.target, true);
                try {
                    await loadLayer(layerKey);
                } catch (err) {
                    console.error(`Gagal memuat ${layerKey}`, err);
                    e.target.checked = false;
                    _setCheckboxLoading(e.target, false);
                    return;
                }
                _setCheckboxLoading(e.target, false);
            }

            toggleLabel(layerKey, e.target.checked);
        });
    });
}

// ─── Tampilkan/sembunyikan spinner di sebelah checkbox ────────
function _setCheckboxLoading(checkbox, isLoading) {
    checkbox.disabled = isLoading;
    const label = checkbox.closest('label');
    if (!label) return;

    if (isLoading) {
        // Tambahkan spinner kecil
        if (!label.querySelector('.cb-spinner')) {
            const sp = document.createElement('span');
            sp.className  = 'cb-spinner';
            sp.style.cssText = [
                'display:inline-block', 'width:10px', 'height:10px',
                'border:2px solid #cbd5e1', 'border-top-color:#3b82f6',
                'border-radius:50%', 'animation:_cbspin .6s linear infinite',
                'margin-left:4px', 'vertical-align:middle', 'flex-shrink:0'
            ].join(';');
            label.appendChild(sp);

            // Tambahkan keyframes sekali saja
            if (!document.getElementById('_cbspin-style')) {
                const s = document.createElement('style');
                s.id = '_cbspin-style';
                s.textContent = '@keyframes _cbspin{to{transform:rotate(360deg)}}';
                document.head.appendChild(s);
            }
        }
    } else {
        const sp = label.querySelector('.cb-spinner');
        if (sp) sp.remove();
        checkbox.disabled = false;
    }
}

// ─── Show/Hide layer ─────────────────────────────────────────
function toggleLayer(layerKey, isChecked) {
    if (!mapLayers[layerKey]) {
        console.warn(`toggleLayer: Data ${layerKey} belum siap.`);
        return;
    }

    const layer  = mapLayers[layerKey];
    const config = layerConfig[layerKey];

    if (isChecked) {
        if (!map.hasLayer(layer)) map.addLayer(layer);
        if (config.isBoundary) resetBoundaryStyle(layer, config);
        setTimeout(reorderLayers, 100);
    } else {
        if (map.hasLayer(layer)) map.removeLayer(layer);
    }

    if (typeof infoLegend !== 'undefined') infoLegend.update();
}

// ─── Reset style boundary ────────────────────────────────────
function resetBoundaryStyle(layer, config) {
    if (!layer || !config) return;
    layer.setStyle({
        color: config.color, weight: 2, opacity: 0.8,
        fillOpacity: 0.1, fillColor: config.color, dashArray: '5, 5'
    });
}

// ─── Reorder layer z-index ───────────────────────────────────
function reorderLayers() {
    if (mapLayers['SURABAYA_MASK'] && map.hasLayer(mapLayers['SURABAYA_MASK']))
        mapLayers['SURABAYA_MASK'].bringToBack();

    ['KEPADATAN_PENDUDUK', 'POMPA_AIR_7_RAYON', 'AREA_RAYON', 'MAKAM'].forEach(key => {
        if (mapLayers[key] && map.hasLayer(mapLayers[key])) mapLayers[key].bringToFront();
    });

    if (mapLayers['HEATMAP_LAYER'] && map.hasLayer(mapLayers['HEATMAP_LAYER']))
        mapLayers['HEATMAP_LAYER'].bringToFront();

    ['BATAS_KOTA', 'KECAMATAN', 'KELURAHAN', 'BATAS_RW'].forEach(key => {
        if (mapLayers[key] && map.hasLayer(mapLayers[key])) mapLayers[key].bringToFront();
    });

    ['JARINGAN_PIPA_SALURAN', 'SALURAN_AIR', 'RUTE_SAMPAH', 'FIBEROPTIK'].forEach(key => {
        if (mapLayers[key] && map.hasLayer(mapLayers[key])) mapLayers[key].bringToFront();
    });

    [
        'POINT_RUTE_SAMPAH', 'CCTV_EKSISTING', 'CCTV_RENCANA',
        'TITIK_SAMPAH', 'TITIK_SAMPAH_RENCANA', 'TPS', 'TPS3R',
        'DAMKAR', 'PAUD', 'SD_MI', 'SMP_MTS', 'RUKOM',
        'DEKORASI_KOTA', 'TITIK_POMPA_AIR',
        'ANALYSIS_RESULT', 'CLUSTER_BOUNDARIES'
    ].forEach(key => {
        if (mapLayers[key] && map.hasLayer(mapLayers[key])) mapLayers[key].bringToFront();
    });
}

// ─── Toggle label ────────────────────────────────────────────
function toggleLabel(layerKey, isChecked) {
    if (!mapLayers[layerKey]) return;

    const boundaryCheckbox = document.querySelector(`input.layer-toggle[data-layer="${layerKey}"]`);
    const config = layerConfig[layerKey];

    if (isChecked && !map.hasLayer(mapLayers[layerKey])) {
        map.addLayer(mapLayers[layerKey]);
        setTimeout(reorderLayers, 100);
    }

    if (config.isBoundary) {
        mapLayers[layerKey].setStyle((feature) => {
            if (boundaryCheckbox && boundaryCheckbox.checked) {
                return { color: config.color, weight: 2, opacity: 0.8, fillOpacity: 0.1, fillColor: config.color, dashArray: '5, 5' };
            } else if (isChecked) {
                return { color: config.color, weight: 0, opacity: 0, fillOpacity: 0, fillColor: 'transparent' };
            }
            return { color: config.color, weight: 2 };
        });
    }

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

    if (!isChecked && boundaryCheckbox && !boundaryCheckbox.checked) {
        map.removeLayer(mapLayers[layerKey]);
    }
}

// ─── Reset Peta ──────────────────────────────────────────────
async function resetMap() {
    const resetOverlay = document.getElementById('reset-overlay');
    try {
        if (resetOverlay) resetOverlay.style.display = 'flex';

        map.setView(centerPoint, 12, { animate: true, duration: 0.5 });

        // Hapus layer analisis
        ['ANALYSIS_RESULT', 'CLUSTER_BOUNDARIES', 'HEATMAP_LAYER'].forEach(key => {
            if (mapLayers[key]) {
                if (map.hasLayer(mapLayers[key])) map.removeLayer(mapLayers[key]);
                delete mapLayers[key];
            }
        });

        // Bersihkan UI analisis
        const heatmapLegend = document.getElementById('heatmap-legend');
        if (heatmapLegend) heatmapLegend.style.display = 'none';

        const analysisResult = document.getElementById('analysis-result');
        if (analysisResult) { analysisResult.style.display = 'none'; analysisResult.innerHTML = ''; }

        document.querySelectorAll('.analysis-source').forEach(cb => cb.checked = false);
        if (typeof populateAnalysisSources === 'function') populateAnalysisSources();

        // Uncheck semua checkbox
        document.querySelectorAll('.layer-toggle').forEach(cb => cb.checked = false);
        document.querySelectorAll('.layer-label-toggle').forEach(cb => cb.checked = false);

        // Hapus semua layer dari peta (kecuali mask)
        Object.keys(mapLayers).forEach(key => {
            if (key !== 'SURABAYA_MASK' && mapLayers[key]) {
                if (map.hasLayer(mapLayers[key])) map.removeLayer(mapLayers[key]);
            }
        });

        if (typeof infoLegend !== 'undefined' && infoLegend.update) infoLegend.update();

        // Pastikan base layer aktif
        if (!map.hasLayer(defaultLayer)) map.addLayer(defaultLayer);

        const maskCheckbox = document.getElementById('surabaya-mask-toggle');
        if (maskCheckbox) {
            maskCheckbox.checked = true;
            toggleSurabayaMask(true);
        }

        await new Promise(resolve => setTimeout(resolve, 200));
        map.invalidateSize();

    } catch (error) {
        console.error('Error saat reset peta:', error);
        alert('Terjadi kesalahan saat reset peta. Silakan refresh halaman.');
    } finally {
        if (resetOverlay) resetOverlay.style.display = 'none';
    }
}

// ─── Toggle Label RW ─────────────────────────────────────────
function toggleRWLabels(show) {
    if (!mapLayers['BATAS_RW']) return;
    mapLayers['BATAS_RW'].eachLayer(function(layer) {
        const rwName = layer.feature.properties.RW || 'RW';
        if (show) {
            if (!layer.getTooltip()) {
                layer.bindTooltip(rwName, { permanent: true, direction: 'center', className: 'rw-label', sticky: false });
            }
            layer.openTooltip();
        } else {
            if (layer.getTooltip()) layer.closeTooltip();
        }
    });
}