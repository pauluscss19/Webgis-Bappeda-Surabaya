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
    wheelPxPerZoomLevel: 120,      // Zoom lebih santai
    zoomSnap: 0.25,                 // Zoom bertahap lebih halus
    zoomDelta: 0.5,                 // Delta zoom lebih kecil
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

// Export PDF Button (hanya muncul saat fullscreen, di bawah button fullscreen)
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

// --- LEGEND STATISTIK ---
const infoLegend = L.control({ position: 'bottomleft' });
infoLegend.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info-legend');
    this.update();
    return this._div;
};
infoLegend.update = function () {
    let html = '<h4>Statistik Data</h4>';
    let hasActiveLayer = false;
    Object.keys(layerConfig).forEach(key => {
        const config = layerConfig[key];
        const layer = mapLayers[key];

        if (config.isBoundary) return;

        if (layer && map.hasLayer(layer)) {
            hasActiveLayer = true;
            const count = layer.getLayers().length;
            html += `
                <div class="legend-item">
                    <div style="display:flex; align-items:center;">
                        <span class="layer-color" style="background:${config.color}; width:10px; height:10px; margin-right:5px;"></span>
                        ${config.label}
                    </div>
                    <span><b>${count}</b></span>
                </div>`;
        }
    });

    if (mapLayers['ANALYSIS_RESULT']) {
        html += `<div style="margin-top:5px; border-top:1px solid #eee; padding-top:5px;"><strong>Hasil Analisis:</strong></div>`;
        html += `<div class="legend-item"><div style="display:flex;align-items:center;"><span style="display:inline-block; width:12px; height:12px; background:#ef4444; border:2px solid white; border-radius:50%; margin-right:5px; box-shadow:0 0 4px black;"></span>Rekomendasi</div></div>`;
    }

    if (!hasActiveLayer && !mapLayers['ANALYSIS_RESULT']) html += '<div style="color:#777; font-size:11px;">Tidak ada layer aktif</div>';
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

// Export Map to PDF Function - PANGGIL window.printMap() dari pdf-export.js
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
        // Fullscreen ON
        if (exportControl) exportControl.style.display = 'block';
        if (printSection) printSection.style.display = 'none';
        if (icon) icon.className = 'bi bi-fullscreen-exit';

        // Set map height ke 100vh untuk fullscreen
        if (mapElement) {
            mapElement.style.height = '100vh';
        }

        // Resize map setelah delay untuk animasi fullscreen selesai
        setTimeout(function() {
            if (window.map) {
                window.map.invalidateSize();
            }
        }, 100);

    } else {
        // Fullscreen OFF
        if (exportControl) exportControl.style.display = 'none';
        if (printSection) printSection.style.display = 'block';
        if (icon) icon.className = 'bi bi-arrows-fullscreen';

        // Kembalikan map height ke default
        if (mapElement) {
            mapElement.style.height = '';
        }

        // Resize map kembali
        setTimeout(function() {
            if (window.map) {
                window.map.invalidateSize();
            }
        }, 100);
    }
}

document.addEventListener('fullscreenchange', handleFullscreenChange);
document.addEventListener('webkitfullscreenchange', handleFullscreenChange);
document.addEventListener('mozfullscreenchange', handleFullscreenChange);
document.addEventListener('MSFullscreenChange', handleFullscreenChange);