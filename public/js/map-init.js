// ============================================================
// MAP-INIT.JS - Inisialisasi Peta dan Kontrol
//
// FIX yang diterapkan:
// 1. Semua inline style di control div DIHAPUS — styling 100% via peta.css
// 2. toggleFullscreen() SATU definisi di sini (pakai Fullscreen API browser)
//    — definisi lama di ui.js sudah dihapus agar tidak konflik
// 3. Tambah Export Excel control (topright, muncul saat fullscreen)
// 4. handleFullscreenChange() mengatur PDF + Excel control via CSS class
//    — tidak pakai style.display langsung agar tidak bentrok dengan CSS
// 5. .leaflet-control-container z-index diatur via peta.css agar tombol
//    selalu di atas peta (z-index peta = 1)
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

// ── Zoom Control ──────────────────────────────────────────────
L.control.zoom({ position: 'topright' }).addTo(map);

// ── Fullscreen Button ─────────────────────────────────────────
// FIX: Tidak ada inline style — semua styling dari peta.css
const fullscreenControl = L.control({ position: 'topright' });
fullscreenControl.onAdd = function(map) {
    const div = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
    div.innerHTML = `<button id="fullscreen-btn" onclick="toggleFullscreen()" title="Toggle Fullscreen">
        <i class="bi bi-arrows-fullscreen" id="fullscreen-icon"></i>
    </button>`;
    L.DomEvent.disableClickPropagation(div);
    return div;
};
fullscreenControl.addTo(map);

// ── Export PDF Button (hanya tampil saat fullscreen) ──────────
// FIX: Tidak ada inline style, tidak ada display:none manual
//      Visibility diatur via class 'ctrl-hidden' di peta.css
const exportPdfControl = L.control({ position: 'topright' });
exportPdfControl.onAdd = function(map) {
    const div = L.DomUtil.create('div', 'leaflet-bar leaflet-control ctrl-hidden');
    div.id = 'export-pdf-control';
    div.innerHTML = `<button id="export-pdf-btn-fs" onclick="exportMapToPdf()" title="Export ke PDF">
        <i class="bi bi-file-earmark-pdf-fill"></i>
    </button>`;
    L.DomEvent.disableClickPropagation(div);
    return div;
};
exportPdfControl.addTo(map);

// ── Export Excel Button (hanya tampil saat fullscreen) ────────
// BARU: tombol export Excel khusus mode fullscreen
const exportExcelControl = L.control({ position: 'topright' });
exportExcelControl.onAdd = function(map) {
    const div = L.DomUtil.create('div', 'leaflet-bar leaflet-control ctrl-hidden');
    div.id = 'export-excel-control';
    div.innerHTML = `<button id="export-excel-btn-fs" onclick="exportMapDataToExcel()" title="Export ke Excel">
        <i class="bi bi-file-earmark-excel-fill"></i>
    </button>`;
    L.DomEvent.disableClickPropagation(div);
    return div;
};
exportExcelControl.addTo(map);

// ── Layer Switcher ────────────────────────────────────────────
L.control.layers({
    "Peta Default":  defaultLayer,
    "Satelit":       satelliteLayer,
    "OpenStreetMap": osmLayer,
    "Dark Mode":     darkLayer,
    "Topografi":     topoLayer,
    "Humanitarian":  streetLayer
}, null, { position: 'topright' }).addTo(map);


// ============================================================
// LEGEND STATISTIK (bottomright)
// ============================================================

function _getLegendCount(key) {
    if (geoJsonStore[key] && geoJsonStore[key].features) {
        return geoJsonStore[key].features.length;
    }
    if (mapLayers[key] && typeof mapLayers[key].getLayers === 'function') {
        return mapLayers[key].getLayers().length;
    }
    return 0;
}

const infoLegend = L.control({ position: 'bottomright' });
infoLegend.onAdd = function(map) {
    this._div = L.DomUtil.create('div', 'info-legend');
    this._div.title = 'Klik untuk melihat jumlah titik per layer';
    this._div.style.cursor = 'pointer';
    this._div.addEventListener('click', function() {
        if (typeof infoLegend !== 'undefined' && infoLegend.update) infoLegend.update();
    });
    this.update();
    return this._div;
};

infoLegend.update = function() {
    let html = '<h4>Statistik Data</h4>';
    let hasActiveLayer = false;

    Object.keys(layerConfig).forEach(key => {
        const config = layerConfig[key];
        const layer  = mapLayers[key];
        if (config.isBoundary) return;
        if (layer && map.hasLayer(layer)) {
            hasActiveLayer = true;
            const count = _getLegendCount(key);
            html += `
                <div class="legend-item">
                    <div style="display:flex;align-items:center;flex:1;min-width:0;">
                        <span style="background:${config.color};width:10px;height:10px;
                            border-radius:50%;flex-shrink:0;margin-right:6px;
                            display:inline-block;"></span>
                        <span style="overflow:hidden;text-overflow:ellipsis;
                            white-space:nowrap;font-size:11px;">${config.label}</span>
                    </div>
                    <span style="font-weight:700;color:#1e293b;font-size:11px;
                        margin-left:8px;flex-shrink:0;">${count}</span>
                </div>`;
        }
    });

    if (mapLayers['ANALYSIS_RESULT'] && map.hasLayer(mapLayers['ANALYSIS_RESULT'])) {
        hasActiveLayer = true;
        html += `<div style="margin-top:6px;padding-top:6px;border-top:1px solid #e2e8f0;">
            <div class="legend-item">
                <div style="display:flex;align-items:center;flex:1;min-width:0;">
                    <span style="display:inline-block;width:10px;height:10px;
                        background:#ef4444;border:2px solid white;border-radius:50%;
                        flex-shrink:0;margin-right:6px;
                        box-shadow:0 0 3px rgba(0,0,0,0.3);"></span>
                    <span style="font-size:11px;">Rekomendasi</span>
                </div>
            </div>
        </div>`;
    }

    if (!hasActiveLayer) {
        html += '<div style="color:#94a3b8;font-size:11px;padding:4px 0;">Tidak ada layer aktif</div>';
    }

    html += '<div style="margin-top:6px;font-size:10px;color:#94a3b8;text-align:right;">Klik untuk refresh</div>';
    this._div.innerHTML = html;
};

infoLegend.addTo(map);


// ============================================================
// FULLSCREEN HANDLER
// FIX: Satu-satunya definisi toggleFullscreen() — menggunakan
//      Fullscreen API browser (bukan CSS class).
//      Definisi lama di ui.js sudah dihapus.
// ============================================================

window.toggleFullscreen = function() {
    const mapContainer = document.querySelector('.peta-card');

    const isFs = !!(document.fullscreenElement       ||
                    document.webkitFullscreenElement  ||
                    document.mozFullScreenElement     ||
                    document.msFullscreenElement);

    if (!isFs) {
        if (mapContainer.requestFullscreen)            mapContainer.requestFullscreen();
        else if (mapContainer.webkitRequestFullscreen) mapContainer.webkitRequestFullscreen();
        else if (mapContainer.mozRequestFullScreen)    mapContainer.mozRequestFullScreen();
        else if (mapContainer.msRequestFullscreen)     mapContainer.msRequestFullscreen();
    } else {
        if (document.exitFullscreen)            document.exitFullscreen();
        else if (document.webkitExitFullscreen) document.webkitExitFullscreen();
        else if (document.mozCancelFullScreen)  document.mozCancelFullScreen();
        else if (document.msExitFullscreen)     document.msExitFullscreen();
    }
};

window.exportMapToPdf = function() {
    if (typeof window.printMap === 'function') {
        window.printMap();
    } else {
        alert('Fungsi export PDF belum siap. Pastikan file pdf-export.js sudah dimuat.');
    }
};

// ── handleFullscreenChange ────────────────────────────────────
// FIX: Gunakan class 'ctrl-hidden' untuk show/hide PDF & Excel control
//      agar tidak bentrok dengan CSS. Tidak pakai style.display langsung.
function handleFullscreenChange() {
    const exportPdfCtrl   = document.getElementById('export-pdf-control');
    const exportExcelCtrl = document.getElementById('export-excel-control');
    const printSection    = document.querySelector('.print-section');
    const icon            = document.getElementById('fullscreen-icon');
    const mapElement      = document.getElementById('map');

    const isFs = !!(document.fullscreenElement       ||
                    document.webkitFullscreenElement  ||
                    document.mozFullScreenElement     ||
                    document.msFullscreenElement);

    if (isFs) {
        // Tampilkan tombol PDF & Excel di atas peta
        if (exportPdfCtrl)   exportPdfCtrl.classList.remove('ctrl-hidden');
        if (exportExcelCtrl) exportExcelCtrl.classList.remove('ctrl-hidden');
        // Sembunyikan section print di bawah peta
        if (printSection) printSection.style.display = 'none';
        // Update icon
        if (icon) icon.className = 'bi bi-fullscreen-exit';
        // Map isi penuh viewport
        if (mapElement) mapElement.style.height = '100vh';
    } else {
        // Sembunyikan tombol PDF & Excel
        if (exportPdfCtrl)   exportPdfCtrl.classList.add('ctrl-hidden');
        if (exportExcelCtrl) exportExcelCtrl.classList.add('ctrl-hidden');
        // Tampilkan kembali section print
        if (printSection) printSection.style.display = '';
        // Kembalikan icon
        if (icon) icon.className = 'bi bi-arrows-fullscreen';
        // Reset tinggi map ke CSS default
        if (mapElement) mapElement.style.height = '';
    }

    // Paksa Leaflet recalculate ukuran peta
    setTimeout(function() {
        if (window.map) window.map.invalidateSize();
    }, 100);
}

document.addEventListener('fullscreenchange',       handleFullscreenChange);
document.addEventListener('webkitfullscreenchange', handleFullscreenChange);
document.addEventListener('mozfullscreenchange',    handleFullscreenChange);
document.addEventListener('MSFullscreenChange',     handleFullscreenChange);