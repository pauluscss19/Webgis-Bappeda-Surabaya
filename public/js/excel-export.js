// ============================================================
// EXCEL-EXPORT.JS - Export data layer aktif ke Excel (Styled)
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

// Warna per layer group (cycling palette profesional)
const GROUP_COLORS = [
    { header: '1F3864', subheader: '2E75B6', row1: 'D6E4F0', row2: 'EBF4FA' },
    { header: '375623', subheader: '538135', row1: 'D9EAD3', row2: 'EEF7EB' },
    { header: '7B2D00', subheader: 'C55A11', row1: 'FCE4D6', row2: 'FEF2EB' },
    { header: '4B1C82', subheader: '7030A0', row1: 'E8D5F5', row2: 'F5EAF9' },
    { header: '1C3A5F', subheader: '2471A3', row1: 'D4E6F1', row2: 'EBF5FB' },
    { header: '7D6608', subheader: 'B7950B', row1: 'FEF9E7', row2: 'FFFDE7' },
];

function setCellStyle(ws, cellRef, style) {
    if (!ws[cellRef]) ws[cellRef] = { t: 's', v: '' };
    ws[cellRef].s = style;
}

function applyStyle(ws, cellRef, value, type, style) {
    ws[cellRef] = { t: type || 's', v: value, s: style };
}

function colLetter(n) {
    let s = '';
    while (n > 0) {
        n--;
        s = String.fromCharCode(65 + (n % 26)) + s;
        n = Math.floor(n / 26);
    }
    return s;
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
    if (checked.length === 0) {
        alert('Aktifkan minimal satu layer data lalu coba lagi.');
        return;
    }

    // Kumpulkan data per layer
    const layerGroups = [];
    checked.forEach(function (checkbox) {
        const layerKey = checkbox.getAttribute('data-layer');
        const layer = mapLayers[layerKey];
        const config = typeof layerConfig !== 'undefined' ? layerConfig[layerKey] : null;
        if (!layer || !map.hasLayer(layer)) return;

        const rows = [];
        const data = geoJsonStore[layerKey];
        if (data && data.features && data.features.length) {
            data.features.forEach(function (feature, i) {
                rows.push(featureToRow(layerKey, feature, i, config));
            });
        } else {
            layer.eachLayer(function (l) {
                const feature = l.feature;
                if (feature) rows.push(featureToRow(layerKey, feature, rows.length, config));
            });
        }

        if (rows.length > 0) {
            layerGroups.push({
                key: layerKey,
                label: config ? config.label : layerKey,
                rows: rows
            });
        }
    });

    if (layerGroups.length === 0) {
        alert('Tidak ada data yang bisa diekspor.');
        return;
    }

    // ── Buat workbook ──────────────────────────────────────────
    const wb = XLSX.utils.book_new();

    // ── Sheet RINGKASAN ────────────────────────────────────────
    const summaryWs = {};
    const summaryData = [
        ['REKAP DATA PETA KOTA SURABAYA'],
        ['Tanggal Export: ' + new Date().toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })],
        [''],
        ['No', 'Nama Layer', 'Jumlah Data']
    ];

    const titleStyle = {
        font: { bold: true, sz: 16, color: { rgb: 'FFFFFF' }, name: 'Arial' },
        fill: { fgColor: { rgb: '1F3864' }, patternType: 'solid' },
        alignment: { horizontal: 'center', vertical: 'center' }
    };
    const subTitleStyle = {
        font: { sz: 11, color: { rgb: 'FFFFFF' }, name: 'Arial' },
        fill: { fgColor: { rgb: '2E75B6' }, patternType: 'solid' },
        alignment: { horizontal: 'center', vertical: 'center' }
    };
    const summaryHeaderStyle = {
        font: { bold: true, sz: 11, color: { rgb: 'FFFFFF' }, name: 'Arial' },
        fill: { fgColor: { rgb: '1F3864' }, patternType: 'solid' },
        alignment: { horizontal: 'center', vertical: 'center' },
        border: {
            top: { style: 'thin', color: { rgb: '000000' } },
            bottom: { style: 'thin', color: { rgb: '000000' } },
            left: { style: 'thin', color: { rgb: '000000' } },
            right: { style: 'thin', color: { rgb: '000000' } }
        }
    };
    const summaryRowStyle1 = {
        font: { sz: 10, name: 'Arial' },
        fill: { fgColor: { rgb: 'D6E4F0' }, patternType: 'solid' },
        alignment: { horizontal: 'center', vertical: 'center' },
        border: {
            top: { style: 'thin', color: { rgb: 'B0C4D8' } },
            bottom: { style: 'thin', color: { rgb: 'B0C4D8' } },
            left: { style: 'thin', color: { rgb: 'B0C4D8' } },
            right: { style: 'thin', color: { rgb: 'B0C4D8' } }
        }
    };
    const summaryRowStyle2 = {
        font: { sz: 10, name: 'Arial' },
        fill: { fgColor: { rgb: 'EBF4FA' }, patternType: 'solid' },
        alignment: { horizontal: 'center', vertical: 'center' },
        border: {
            top: { style: 'thin', color: { rgb: 'B0C4D8' } },
            bottom: { style: 'thin', color: { rgb: 'B0C4D8' } },
            left: { style: 'thin', color: { rgb: 'B0C4D8' } },
            right: { style: 'thin', color: { rgb: 'B0C4D8' } }
        }
    };
    const summaryNameStyle1 = Object.assign({}, summaryRowStyle1, { alignment: { horizontal: 'left', vertical: 'center' } });
    const summaryNameStyle2 = Object.assign({}, summaryRowStyle2, { alignment: { horizontal: 'left', vertical: 'center' } });

    // Row 1: Judul
    summaryWs['A1'] = { t: 's', v: 'REKAP DATA PETA KOTA SURABAYA', s: titleStyle };
    summaryWs['A2'] = { t: 's', v: 'Tanggal Export: ' + new Date().toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' }), s: subTitleStyle };
    summaryWs['A3'] = { t: 's', v: '', s: {} };

    // Header tabel ringkasan
    summaryWs['A4'] = { t: 's', v: 'No', s: summaryHeaderStyle };
    summaryWs['B4'] = { t: 's', v: 'Nama Layer', s: summaryHeaderStyle };
    summaryWs['C4'] = { t: 's', v: 'Jumlah Data', s: summaryHeaderStyle };

    layerGroups.forEach(function (group, idx) {
        const r = idx + 5;
        const isOdd = idx % 2 === 0;
        const noStyle = isOdd ? summaryRowStyle1 : summaryRowStyle2;
        const nameStyle = isOdd ? summaryNameStyle1 : summaryNameStyle2;
        summaryWs['A' + r] = { t: 'n', v: idx + 1, s: noStyle };
        summaryWs['B' + r] = { t: 's', v: group.label, s: nameStyle };
        summaryWs['C' + r] = { t: 'n', v: group.rows.length, s: noStyle };
    });

    // Total row
    const totalRow = layerGroups.length + 5;
    const totalStyle = {
        font: { bold: true, sz: 11, color: { rgb: 'FFFFFF' }, name: 'Arial' },
        fill: { fgColor: { rgb: '1F3864' }, patternType: 'solid' },
        alignment: { horizontal: 'center', vertical: 'center' },
        border: {
            top: { style: 'medium', color: { rgb: '000000' } },
            bottom: { style: 'medium', color: { rgb: '000000' } },
            left: { style: 'medium', color: { rgb: '000000' } },
            right: { style: 'medium', color: { rgb: '000000' } }
        }
    };
    const totalNameStyle = Object.assign({}, totalStyle, { alignment: { horizontal: 'left', vertical: 'center' } });
    summaryWs['A' + totalRow] = { t: 's', v: '', s: totalStyle };
    summaryWs['B' + totalRow] = { t: 's', v: 'TOTAL', s: totalNameStyle };
    summaryWs['C' + totalRow] = { t: 'n', v: layerGroups.reduce(function(a, g) { return a + g.rows.length; }, 0), s: totalStyle };

    const summaryRange = 'A1:C' + totalRow;
    summaryWs['!ref'] = summaryRange;
    summaryWs['!merges'] = [
        { s: { r: 0, c: 0 }, e: { r: 0, c: 2 } },
        { s: { r: 1, c: 0 }, e: { r: 1, c: 2 } },
        { s: { r: 2, c: 0 }, e: { r: 2, c: 2 } }
    ];
    summaryWs['!cols'] = [{ wch: 8 }, { wch: 35 }, { wch: 15 }];
    summaryWs['!rows'] = [{ hpt: 36 }, { hpt: 22 }, { hpt: 10 }];

    XLSX.utils.book_append_sheet(wb, summaryWs, 'Ringkasan');

    // ── Sheet per Layer ────────────────────────────────────────
    layerGroups.forEach(function (group, groupIdx) {
        const palette = GROUP_COLORS[groupIdx % GROUP_COLORS.length];
        const ws = {};

        // Kumpulkan semua kolom unik
        const allKeys = ['No', 'Nama', 'Latitude', 'Longitude'];
        group.rows.forEach(function (row) {
            Object.keys(row).forEach(function (k) {
                if (!allKeys.includes(k)) allKeys.push(k);
            });
        });

        const numCols = allKeys.length;
        const lastCol = colLetter(numCols);

        // Style
        const headerGroupStyle = {
            font: { bold: true, sz: 13, color: { rgb: 'FFFFFF' }, name: 'Arial' },
            fill: { fgColor: { rgb: palette.header }, patternType: 'solid' },
            alignment: { horizontal: 'center', vertical: 'center' }
        };
        const subHeaderStyle = {
            font: { sz: 10, color: { rgb: 'FFFFFF' }, name: 'Arial' },
            fill: { fgColor: { rgb: palette.subheader }, patternType: 'solid' },
            alignment: { horizontal: 'center', vertical: 'center' }
        };
        const colHeaderStyle = {
            font: { bold: true, sz: 10, color: { rgb: 'FFFFFF' }, name: 'Arial' },
            fill: { fgColor: { rgb: palette.header }, patternType: 'solid' },
            alignment: { horizontal: 'center', vertical: 'center', wrapText: true },
            border: {
                top: { style: 'medium', color: { rgb: '000000' } },
                bottom: { style: 'medium', color: { rgb: '000000' } },
                left: { style: 'thin', color: { rgb: '000000' } },
                right: { style: 'thin', color: { rgb: '000000' } }
            }
        };
        const makeRowStyle = function(isOdd, isCenter) {
            return {
                font: { sz: 10, name: 'Arial' },
                fill: { fgColor: { rgb: isOdd ? palette.row1 : palette.row2 }, patternType: 'solid' },
                alignment: { horizontal: isCenter ? 'center' : 'left', vertical: 'center' },
                border: {
                    top: { style: 'thin', color: { rgb: 'CCCCCC' } },
                    bottom: { style: 'thin', color: { rgb: 'CCCCCC' } },
                    left: { style: 'thin', color: { rgb: 'CCCCCC' } },
                    right: { style: 'thin', color: { rgb: 'CCCCCC' } }
                }
            };
        };

        // Baris 1: Judul layer (merge semua kolom)
        for (let c = 1; c <= numCols; c++) {
            ws[colLetter(c) + '1'] = { t: 's', v: c === 1 ? group.label.toUpperCase() : '', s: headerGroupStyle };
        }
        // Baris 2: Info jumlah data
        for (let c = 1; c <= numCols; c++) {
            ws[colLetter(c) + '2'] = { t: 's', v: c === 1 ? 'Jumlah Data: ' + group.rows.length + ' record' : '', s: subHeaderStyle };
        }
        // Baris 3: Kosong / separator
        for (let c = 1; c <= numCols; c++) {
            ws[colLetter(c) + '3'] = { t: 's', v: '', s: { fill: { fgColor: { rgb: palette.header }, patternType: 'solid' } } };
        }
        // Baris 4: Header kolom
        allKeys.forEach(function (key, ci) {
            ws[colLetter(ci + 1) + '4'] = { t: 's', v: key, s: colHeaderStyle };
        });

        // Baris data
        group.rows.forEach(function (row, ri) {
            const excelRow = ri + 5;
            const isOdd = ri % 2 === 0;
            allKeys.forEach(function (key, ci) {
                const val = row[key] !== undefined ? row[key] : '';
                const isCenter = (key === 'No' || key === 'Latitude' || key === 'Longitude');
                const cellStyle = makeRowStyle(isOdd, isCenter);
                const cellType = (typeof val === 'number') ? 'n' : 's';
                ws[colLetter(ci + 1) + excelRow] = { t: cellType, v: val, s: cellStyle };
            });
        });

        // Range & merge
        const lastRow = group.rows.length + 4;
        ws['!ref'] = 'A1:' + lastCol + lastRow;
        ws['!merges'] = [
            { s: { r: 0, c: 0 }, e: { r: 0, c: numCols - 1 } },
            { s: { r: 1, c: 0 }, e: { r: 1, c: numCols - 1 } },
            { s: { r: 2, c: 0 }, e: { r: 2, c: numCols - 1 } }
        ];

        // Lebar kolom
        const colWidths = allKeys.map(function (k) {
            if (k === 'No') return { wch: 6 };
            if (k === 'Nama') return { wch: 30 };
            if (k === 'Latitude' || k === 'Longitude') return { wch: 16 };
            return { wch: 20 };
        });
        ws['!cols'] = colWidths;
        ws['!rows'] = [{ hpt: 34 }, { hpt: 20 }, { hpt: 6 }, { hpt: 22 }];

        // Nama sheet (max 31 karakter, tanpa karakter khusus)
        let sheetName = group.label.replace(/[:\\\/\?\*\[\]]/g, '').substring(0, 31);
        XLSX.utils.book_append_sheet(wb, ws, sheetName);
    });

    // ── Simpan file ────────────────────────────────────────────
    const dateStr = new Date().toISOString().slice(0, 10);
    XLSX.writeFile(wb, 'Data_Peta_Surabaya_' + dateStr + '.xlsx', { cellStyles: true });
};