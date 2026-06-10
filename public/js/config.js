// ============================================================
// CONFIG.JS - Konfigurasi Peta dan Layer (Updated)
// ============================================================

// KONFIGURASI PETA
const surabayaBounds = [
    [-7.3500, 112.6500],
    [-7.1800, 112.8500]
];
const centerPoint = [-7.2575, 112.7400];

const defaultLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; CARTO', subdomains: 'abcd', maxZoom: 20
});
const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles &copy; Esri', maxZoom: 19
});
const osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors', maxZoom: 19
});
const darkLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; CARTO', subdomains: 'abcd', maxZoom: 20
});
const topoLayer = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenTopoMap contributors', maxZoom: 17
});
const streetLayer = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors', maxZoom: 19
});

// KONFIGURASI DATA
const geoJsonStore = {};
const layerConfig = {
    // PERSAMPAHAN & LINGKUNGAN
    'TPS3R': { 
        file: 'TPS3R_12.json', 
        color: '#10b981',
        label: 'TPS3R', 
        nameField: 'name', 
        group: 'persampahan' 
    },
    'TPS': { 
        file: 'TPS_191.json', 
        color: '#f59e0b',
        label: 'TPS', 
        nameField: 'name', 
        group: 'persampahan' 
    },
    'RUTE_SAMPAH': { 
        file: 'RUTE_PENGANGKUTAN_SAMPAH_HAMDALAH_SUJUD_SYUKUR.geojson', 
        color: '#a855f7',
        label: 'Rute Pengangkutan Sampah', 
        isLine: true, 
        group: 'persampahan' 
    },
    'POINT_RUTE_SAMPAH': { 
        file: 'POINT_RUTE_PENGANGKUTAN_SAMPAH_HAMDALAH_SUJUD_SYUKUR.json', 
        color: '#f43f5e',
        label: 'Titik Rute Sampah', 
        nameField: 'Name', 
        group: 'persampahan' 
    },
    'TITIK_SAMPAH': { 
        file: 'TITIK_SAMPAH.geojson', 
        color: '#facc15',
        label: 'Titik Sampah', 
        group: 'persampahan' 
    },
    'TITIK_SAMPAH_RENCANA': { 
        file: 'TITIK_SAMPAH_RENCANA.geojson', 
        color: '#22c55e',
        label: 'Sampah Rencana', 
        group: 'persampahan' 
    },
    'RUKOM': { 
        file: 'Rukom_27.json', 
        color: '#0ea5e9',
        label: 'Rumah Kompos', 
        nameField: 'Name', 
        group: 'persampahan' 
    },
    
    // FASILITAS UMUM
    'DEKORASI_KOTA': { 
        file: 'DekorasiKota.json', 
        color: '#fb923c',
        label: 'Dekorasi Kota', 
        nameField: 'Name', 
        group: 'fasilitas' 
    },
    
    // DEMOGRAFI
    'KEPADATAN_PENDUDUK': { 
        file: 'Kepadatan_Penduduk.json', 
        color: '#ef4444',
        label: 'Kepadatan Penduduk', 
        isPolygon: true,
        isChloropleth: true,
        nameField: 'DESA', 
        group: 'demografi' 
    },

    // INTERNAL/BACKGROUND LAYERS (TIDAK DITAMPILKAN DI SIDEBAR)
    'JARINGAN_JALAN': { 
        file: 'jaringan_jalan.geojson',   
        color: '#f44444',             
        label: 'Jaringan Jalan', 
        isLine: true, 
        nameField: 'name',             
        group: 'internal'         
    },
    'KECAMATAN': { 
        file: 'Kecamatan.geojson', 
        color: '#6366f1',
        label: 'Batas Kecamatan', 
        nameField: 'Name', 
        isPolygon: true, 
        isBoundary: true, 
        group: 'batas' 
    },
    'KELURAHAN': { 
        file: 'kelurahan.geojson', 
        color: '#eab308',
        label: 'Batas Kelurahan', 
        nameField: 'K', 
        isPolygon: true, 
        isBoundary: true, 
        group: 'batas' 
    },
    'BATAS_RW': { 
        file: '13102025-BATAS_RW.json', 
        color: '#14b8a6',
        label: 'Batas RW', 
        nameField: 'RW', 
        isPolygon: true, 
        isBoundary: true, 
        showRWName: true,
        group: 'batas' 
    }
};

const mapLayers = {};

// Fungsi untuk mendapatkan warna berdasarkan kepadatan
function getPopulationDensityColor(density) {
    if (density > 20000) return '#7f1d1d';
    if (density > 15000) return '#991b1b';
    if (density > 10000) return '#b91c1c';
    if (density > 7500)  return '#dc2626';
    if (density > 5000)  return '#ef4444';
    if (density > 3000)  return '#f87171';
    if (density > 2000)  return '#fca5a5';
    if (density > 1000)  return '#fecaca';
    if (density > 500)   return '#fee2e2';
    return '#fef2f2';
}

// Fungsi untuk mendapatkan label kategori kepadatan
function getPopulationDensityLabel(density) {
    if (density > 15000) return 'Sangat Padat';
    if (density > 10000) return 'Padat Sekali';
    if (density > 5000)  return 'Padat';
    if (density > 2000)  return 'Sedang';
    if (density > 1000)  return 'Jarang';
    return 'Sangat Jarang';
}