// ============================================================
// MAP-INIT.JS - Inisialisasi Peta dan Kontrol (FIXED)
//
// FIXES:
// 1. Heatmap legend sekarang di dalam container legend (di atas statistik)
// 2. Layer switcher dengan dropdown permanen
// 3. Fullscreen API tetap pakai browser native
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
    worldCopyJump: true,
    preferCanvas: true // Render semua garis vektor menggunakan HTML5 Canvas, bukan SVG DOM. Mengatasi freeze di layer 96MB!
});

// ── Zoom Control ──────────────────────────────────────────────
L.control.zoom({ position: 'topright' }).addTo(map);

// ── Fullscreen Button ─────────────────────────────────────────
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

// ── FIX #2: Layer Switcher dengan Dropdown Permanen ────────────
const layerControl = L.control({ position: 'topright' });
layerControl.onAdd = function(map) {
    const div = L.DomUtil.create('div', 'leaflet-control leaflet-control-layers-custom');
    
    // Button toggle dengan icon layers/map
    const toggleBtn = L.DomUtil.create('button', 'layer-switcher-toggle', div);
    toggleBtn.innerHTML = '<i class="bi bi-map"></i>';
    toggleBtn.title = 'Pilih Base Map';
    
    // Dropdown panel
    const panel = L.DomUtil.create('div', 'layer-switcher-panel', div);
    panel.style.display = 'none';
    
    const baseMaps = {
        "Peta Default":  defaultLayer,
        "Satelit":       satelliteLayer,
        "OpenStreetMap": osmLayer,
        "Dark Mode":     darkLayer,
        "Topografi":     topoLayer,
        "Humanitarian":  streetLayer
    };
    
    Object.keys(baseMaps).forEach(name => {
        const label = L.DomUtil.create('label', 'layer-option', panel);
        const radio = L.DomUtil.create('input', '', label);
        radio.type = 'radio';
        radio.name = 'baseLayer';
        radio.value = name;
        if (name === "Peta Default") radio.checked = true;
        
        radio.addEventListener('change', function() {
            Object.values(baseMaps).forEach(layer => map.removeLayer(layer));
            map.addLayer(baseMaps[name]);
        });
        
        const span = L.DomUtil.create('span', '', label);
        span.textContent = name;
        
        label.appendChild(radio);
        label.appendChild(span);
    });
    
    // Toggle visibility
    toggleBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        const isVisible = panel.style.display === 'block';
        panel.style.display = isVisible ? 'none' : 'block';
        toggleBtn.classList.toggle('active', !isVisible);
    });
    
    // Close on click outside
    document.addEventListener('click', function(e) {
        if (!div.contains(e.target)) {
            panel.style.display = 'none';
            toggleBtn.classList.remove('active');
        }
    });
    
    L.DomEvent.disableClickPropagation(div);
    return div;
};
layerControl.addTo(map);


// ============================================================
// FIX #1: LEGEND dengan Heatmap di Atas Statistik
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
    // Container utama
    this._div = L.DomUtil.create('div', 'legend-container');
    
    // Container untuk heatmap legend (di atas)
    this._heatmapDiv = L.DomUtil.create('div', '', this._div);
    this._heatmapDiv.id = 'heatmap-legend';
    this._heatmapDiv.style.display = 'none';
    
    // Container untuk statistik legend (di bawah)
    this._statsDiv = L.DomUtil.create('div', 'info-legend', this._div);
    this._statsDiv.title = 'Klik untuk refresh';
    this._statsDiv.style.cursor = 'pointer';
    
    // Click handler hanya untuk statistik legend
    this._statsDiv.addEventListener('click', function() {
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
    this._statsDiv.innerHTML = html;
};

infoLegend.addTo(map);


// ============================================================
// FULLSCREEN HANDLER
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
        if (exportPdfCtrl)   exportPdfCtrl.classList.remove('ctrl-hidden');
        if (exportExcelCtrl) exportExcelCtrl.classList.remove('ctrl-hidden');
        if (printSection) printSection.style.display = 'none';
        if (icon) icon.className = 'bi bi-fullscreen-exit';
        if (mapElement) mapElement.style.height = '100vh';
    } else {
        if (exportPdfCtrl)   exportPdfCtrl.classList.add('ctrl-hidden');
        if (exportExcelCtrl) exportExcelCtrl.classList.add('ctrl-hidden');
        if (printSection) printSection.style.display = '';
        if (icon) icon.className = 'bi bi-arrows-fullscreen';
        if (mapElement) mapElement.style.height = '';
    }
    
    setTimeout(function() {
        if (window.map) window.map.invalidateSize();
    }, 100);
}

document.addEventListener('fullscreenchange',       handleFullscreenChange);
document.addEventListener('webkitfullscreenchange', handleFullscreenChange);
document.addEventListener('mozfullscreenchange',    handleFullscreenChange);
document.addEventListener('MSFullscreenChange',     handleFullscreenChange);