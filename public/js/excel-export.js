// ============================================================
// EXCEL-EXPORT.JS - Export data layer aktif ke Excel
// ============================================================

function getFeatureCenter(feature) {
    if (!feature || !feature.geometry) return null;
    const g = feature.geometry;
    if (g.type === 'Point') return g.coordinates;
    if (g.type === 'LineString' && g.coordinates && g.coordinates.length) return g.coordinates[0];
    if (g.type === 'Polygon' && g.coordinates && g.coordinates[0] && g.coordinates[0].length) return g.coordinates[0][0];
    if (g.type === 'MultiPoint' && g.coordinates && g.coordinates.length) return g.coordinates[0];
    if (g.type === 'MultiLineString' && g.coordinates && g.coordinates[0] && g.coordinates[0].length) return g.coordinates[0][0];
    if (g.type === 'MultiPolygon' && g.coordinates && g.coordinates[0] && g.coordinates[0][0] && g.coordinates[0][0].length) return g.coordinates[0][0][0];
    return null;
}

function featureToRow(layerKey, feature, index, config) {
    const nameKey = (config && config.nameField) ? config.nameField : 'Name';
    const props = feature.properties || {};
    const nameVal = props[nameKey] || props.Name || props.NAMA || props.K || props.RW || props.DESA || '-';
    const center = getFeatureCenter(feature);
    const row = {
        'Layer': config ? config.label : layerKey,
        'No': index + 1,
        'Nama': nameVal,
        'Latitude': center ? center[1] : '',
        'Longitude': center ? center[0] : ''
    };
    Object.keys(props).forEach(function (k) {
        if (k !== nameKey && k !== 'Name' && k !== 'NAMA') row[k] = props[k];
    });
    return row;
}

window.exportMapDataToExcel = function () {
    if (typeof XLSX === 'undefined') {
        alert('Library Excel belum dimuat. Pastikan SheetJS (xlsx) sudah di-include.');
        return;
    }
    if (typeof mapLayers === 'undefined' || typeof map === 'undefined') {
        alert('Peta belum siap.');
        return;
    }

    const checked = document.querySelectorAll('.layer-toggle:checked');
    const rows = [];
    let sheetName = 'Data Peta';

    checked.forEach(function (checkbox) {
        const layerKey = checkbox.getAttribute('data-layer');
        const layer = mapLayers[layerKey];
        const config = typeof layerConfig !== 'undefined' ? layerConfig[layerKey] : null;
        if (!layer || !map.hasLayer(layer)) return;

        const data = geoJsonStore[layerKey];
        if (data && data.features && data.features.length) {
            data.features.forEach(function (feature, i) {
                rows.push(featureToRow(layerKey, feature, rows.length, config));
            });
        } else {
            layer.eachLayer(function (l) {
                const feature = l.feature;
                if (feature) rows.push(featureToRow(layerKey, feature, rows.length, config));
            });
        }
    });

    if (rows.length === 0) {
        alert('Aktifkan minimal satu layer data lalu coba lagi.');
        return;
    }

    const ws = XLSX.utils.json_to_sheet(rows);
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, sheetName);
    const dateStr = new Date().toISOString().slice(0, 10);
    XLSX.writeFile(wb, 'Data_Peta_Surabaya_' + dateStr + '.xlsx');
};
