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
    // INFRASTRUKTUR
    'CCTV_EKSISTING': { 
        file: 'CCTV_EKSISTING.geojson', 
        color: '#9333ea',
        label: 'CCTV Eksisting', 
        group: 'infrastruktur' 
    },
    'TITIK_SAMPAH': { 
        file: 'TITIK_SAMPAH.geojson', 
        color: '#facc15',
        label: 'Titik Sampah', 
        group: 'infrastruktur' 
    },
    'CCTV_RENCANA': { 
        file: 'CCTV_RENCANA.geojson', 
        color: '#f97316',
        label: 'CCTV Rencana', 
        group: 'infrastruktur' 
    },
    'TITIK_SAMPAH_RENCANA': { 
        file: 'TITIK_SAMPAH_RENCANA.geojson', 
        color: '#22c55e',
        label: 'Sampah Rencana', 
        group: 'infrastruktur' 
    },
    'DAMKAR': { 
        file: 'Damkar.geojson', 
        color: '#dc2626',
        label: 'Pos Damkar', 
        nameField: 'Pos_Ekst', 
        group: 'infrastruktur' 
    },
    'MAKAM': { 
        file: 'MAKAM.geojson', 
        color: '#475569',
        label: 'Makam', 
        nameField: 'Nama_Lokas', 
        isPolygon: true, 
        group: 'infrastruktur' 
    },
    'FIBEROPTIK': { 
        file: 'FiberOptic.json',   
        color: '#ff1493',             
        label: 'Jaringan Fiberoptik', 
        isLine: true, 
        nameField: 'name',             
        group: 'infrastruktur'         
    },
    'JARINGAN_JALAN': { 
        file: 'jaringan_jalan.geojson',   
        color: '#f44444',             
        label: 'Jaringan Jalan', 
        isLine: true, 
        nameField: 'name',             
        group: 'infrastruktur'         
    },
    
    // PENDIDIKAN
    'PAUD': { 
        file: 'paud.geojson', 
        color: '#ec4899',
        label: 'PAUD/TK', 
        nameField: 'NAMA SEKOL', 
        locationField: 'ALAMAT SEK', 
        group: 'pendidikan' 
    },
    'SD_MI': { 
        file: 'sd-mi.geojson', 
        color: '#8b5cf6',
        label: 'SD/MI', 
        nameField: 'NAMA SEKOL', 
        locationField: 'ALAMAT SEK', 
        group: 'pendidikan' 
    },
    'SMP_MTS': { 
        file: 'smp-mts.geojson', 
        color: '#06b6d4',
        label: 'SMP/MTS', 
        nameField: 'NAMA SEKOL', 
        locationField: 'ALAMAT SEK', 
        group: 'pendidikan' 
    },
    
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
    'RUKOM': { 
        file: 'Rukom_27.json', 
        color: '#0ea5e9',
        label: 'Rumah Kompos', 
        nameField: 'Name', 
        group: 'fasilitas' 
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

    // POMPA & SALURAN AIR
    'AREA_RAYON': { 
        file: 'Area_Rayon.json', 
        color: '#0d9488',
        label: 'Area Rayon', 
        isPolygon: true,
        nameField: 'name',
        group: 'pompa_saluran' 
    },
    'POMPA_AIR_7_RAYON': { 
        file: 'Layer area Pompa Air 7 Rayon.json', 
        color: '#0891b2',
        label: 'Area Pompa Air 7 Rayon', 
        isPolygon: true,
        nameField: 'name',
        group: 'pompa_saluran' 
    },
    'JARINGAN_PIPA_SALURAN': { 
        file: 'Layer garis jaringan pipa & saluran air.json', 
        color: '#0284c7',
        label: 'Jaringan Pipa & Saluran Air', 
        isLine: true,
        nameField: 'name',
        group: 'pompa_saluran' 
    },
    'TITIK_POMPA_AIR': { 
        file: 'Layer titik lokasi pompa air.json', 
        color: '#0369a1',
        label: 'Titik Lokasi Pompa Air', 
        nameField: 'name',
        group: 'pompa_saluran' 
    },
    'SALURAN_AIR': { 
        file: 'Saluran_Air.json', 
        color: '#0e7490',
        label: 'Saluran Air', 
        nameField: 'name',
        group: 'pompa_saluran' 
    },
    
    // BATAS WILAYAH
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