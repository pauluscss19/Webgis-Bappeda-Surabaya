// ============================================================
// MAP-INIT.JS - Inisialisasi Peta dan Kontrol
// ============================================================

window.map = L.map('map', {
    center: centerPoint, 
    zoom: 12, 
    minZoom: 2,
    maxZoom: 18,
    layers: [defaultLayer], 
    zoomControl: false,
    wheelPxPerZoomLevel: 120,
    zoomSnap: 0.25,
    zoomDelta: 0.5,
    worldCopyJump: true
});

L.control.zoom({ position: 'topright' }).addTo(map);

// Fullscreen Button
const fullscreenControl = L.control({ position: 'topright' });
fullscreenControl.onAdd = function(map) {
    const div = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
    div.innerHTML = '<button id="fullscreen-btn" onclick="toggleFullscreen()" title="Toggle Fullscreen" style="background: white; color: #334155; border: none; border-radius: 4px; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 18px; box-shadow: 0 2px 4px rgba(0,0,0,0.2);"><i class="bi bi-arrows-fullscreen" id="fullscreen-icon"></i></button>';
    L.DomEvent.disableClickPropagation(div);
    return div;
};
fullscreenControl.addTo(map);

// Export PDF Button (hanya muncul saat fullscreen)
const exportPdfControl = L.control({ position: 'topright' });
exportPdfControl.onAdd = function(map) {
    const div = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
    div.id = 'export-pdf-control';
    div.style.marginTop = '10px';
    div.style.display = 'none';
    div.innerHTML = `
        <button id="export-pdf-btn-fs" 
                onclick="exportMapToPdf()" 
                title="Export ke PDF" 
                style="background: white; color: #334155; border: none; border-radius: 4px; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 18px; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
            <i class="bi bi-file-earmark-pdf-fill"></i>
        </button>
    `;
    L.DomEvent.disableClickPropagation(div);
    return div;
};
exportPdfControl.addTo(map);

L.control.layers({ 
    "Peta Default": defaultLayer, 
    "Satelit": satelliteLayer,
    "OpenStreetMap": osmLayer,
    "Dark Mode": darkLayer,
    "Topografi": topoLayer,
    "Humanitarian": streetLayer
}, null, { position: 'topright' }).addTo(map);

// ============================================================
// FIX #2 & #3: LEGEND STATISTIK - Konsisten & Hitungan Benar
// ============================================================

// Helper: ambil jumlah data dari geoJsonStore (akurat) atau fallback ke layer
function _getLegendCount(key) {
    // Prioritaskan geoJsonStore karena menyimpan semua fitur
    if (geoJsonStore[key] && geoJsonStore[key].features) {
        return geoJsonStore[key].features.length;
    }
    // Fallback ke jumlah sub-layer di Leaflet layer
    if (mapLayers[key] && typeof mapLayers[key].getLayers === 'function') {
        return mapLayers[key].getLayers().length;
    }
    return 0;
}

const infoLegend = L.control({ position: 'bottomright' });
infoLegend.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info-legend info-legend-bottomright');
    this._div.title = 'Klik untuk melihat jumlah titik per layer';
    this._div.style.cursor = 'pointer';
    this._div.addEventListener('click', function () {
        if (typeof infoLegend !== 'undefined' && infoLegend.update) infoLegend.update();
    });
    this.update();
    return this._div;
};

infoLegend.update = function () {
    let html = '<h4>Statistik Data</h4>';
    let hasActiveLayer = false;

    Object.keys(layerConfig).forEach(key => {
        const config = layerConfig[key];
        const layer = mapLayers[key];

        // Skip batas wilayah di legenda utama
        if (config.isBoundary) return;

        if (layer && map.hasLayer(layer)) {
            hasActiveLayer = true;

            // FIX #2: Gunakan helper yang baca dari geoJsonStore
            const count = _getLegendCount(key);

            // FIX #3: Format konsisten — simbol warna + nama + jumlah sejajar kanan
            html += `
                <div class="legend-item">
                    <div style="display:flex; align-items:center; flex:1; min-width:0;">
                        <span class="layer-color" style="
                            background:${config.color}; 
                            width:10px; height:10px; 
                            border-radius:50%; 
                            flex-shrink:0;
                            margin-right:6px;
                            display:inline-block;
                        "></span>
                        <span style="
                            overflow:hidden; 
                            text-overflow:ellipsis; 
                            white-space:nowrap; 
                            font-size:11px;
                        ">${config.label}</span>
                    </div>
                    <span style="
                        font-weight:700; 
                        color:#1e293b; 
                        font-size:11px; 
                        margin-left:8px; 
                        flex-shrink:0;
                    ">${count}</span>
                </div>`;
        }
    });

    // Tampilkan hasil analisis jika ada
    if (mapLayers['ANALYSIS_RESULT'] && map.hasLayer(mapLayers['ANALYSIS_RESULT'])) {
        hasActiveLayer = true;
        html += `<div style="margin-top:6px; padding-top:6px; border-top:1px solid #e2e8f0;">`;
        html += `
            <div class="legend-item">
                <div style="display:flex; align-items:center; flex:1; min-width:0;">
                    <span style="
                        display:inline-block; 
                        width:10px; height:10px; 
                        background:#ef4444; 
                        border:2px solid white; 
                        border-radius:50%; 
                        flex-shrink:0;
                        margin-right:6px;
                        box-shadow:0 0 3px rgba(0,0,0,0.3);
                    "></span>
                    <span style="font-size:11px;">Rekomendasi</span>
                </div>
            </div>`;
        html += `</div>`;
    }

    if (!hasActiveLayer) {
        html += '<div style="color:#94a3b8; font-size:11px; padding:4px 0;">Tidak ada layer aktif</div>';
    }

    html += '<div style="margin-top:6px; font-size:10px; color:#94a3b8; text-align:right;">Klik untuk refresh</div>';
    this._div.innerHTML = html;
};
infoLegend.addTo(map);

// ============================================================
// FULLSCREEN & EXPORT PDF HANDLER
// ============================================================

window.toggleFullscreen = function() {
    const mapContainer = document.querySelector('.peta-card');
    const icon = document.getElementById('fullscreen-icon');

    if (!document.fullscreenElement && !document.webkitFullscreenElement && 
        !document.mozFullScreenElement && !document.msFullscreenElement) {
        if (mapContainer.requestFullscreen) {
            mapContainer.requestFullscreen();
        } else if (mapContainer.webkitRequestFullscreen) {
            mapContainer.webkitRequestFullscreen();
        } else if (mapContainer.mozRequestFullScreen) {
            mapContainer.mozRequestFullScreen();
        } else if (mapContainer.msRequestFullscreen) {
            mapContainer.msRequestFullscreen();
        }
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    }
};

window.exportMapToPdf = function() {
    if (typeof window.printMap === 'function') {
        window.printMap();
    } else {
        alert('Fungsi export PDF belum siap. Pastikan file pdf-export.js sudah dimuat.');
    }
};

function handleFullscreenChange() {
    const exportControl = document.getElementById('export-pdf-control');
    const printSection = document.querySelector('.print-section');
    const icon = document.getElementById('fullscreen-icon');
    const mapElement = document.getElementById('map');

    const isFullscreen = !!(document.fullscreenElement || 
                           document.webkitFullscreenElement || 
                           document.mozFullScreenElement || 
                           document.msFullscreenElement);

    if (isFullscreen) {
        if (exportControl) exportControl.style.display = 'block';
        if (printSection) printSection.style.display = 'none';
        if (icon) icon.className = 'bi bi-fullscreen-exit';
        if (mapElement) mapElement.style.height = '100vh';
        setTimeout(function() {
            if (window.map) window.map.invalidateSize();
        }, 100);
    } else {
        if (exportControl) exportControl.style.display = 'none';
        if (printSection) printSection.style.display = 'block';
        if (icon) icon.className = 'bi bi-arrows-fullscreen';
        if (mapElement) mapElement.style.height = '';
        setTimeout(function() {
            if (window.map) window.map.invalidateSize();
        }, 100);
    }
}

document.addEventListener('fullscreenchange', handleFullscreenChange);
document.addEventListener('webkitfullscreenchange', handleFullscreenChange);
document.addEventListener('mozfullscreenchange', handleFullscreenChange);
document.addEventListener('MSFullscreenChange', handleFullscreenChange);