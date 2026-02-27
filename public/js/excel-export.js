// ============================================================
// EXCEL-EXPORT.JS - Export Data Layer Aktif ke Excel
// Desain: Formal, profesional, bersih tanpa ikon dekoratif
// ============================================================

// ── Palet warna per grup layer ────────────────────────────────
const GROUP_PALETTES = {
    infrastruktur: { h1: '0D2137', h2: '1A56DB', h3: '3F83F8', r1: 'DBEAFE', r2: 'EFF6FF', accent: '60A5FA', stripe: 'BFDBFE', badge: '1E40AF' },
    pendidikan:    { h1: '064E3B', h2: '059669', h3: '10B981', r1: 'D1FAE5', r2: 'ECFDF5', accent: '34D399', stripe: 'A7F3D0', badge: '065F46' },
    persampahan:   { h1: '14532D', h2: '16A34A', h3: '4ADE80', r1: 'DCFCE7', r2: 'F0FDF4', accent: '86EFAC', stripe: 'BBF7D0', badge: '166534' },
    fasilitas:     { h1: '2E1065', h2: '7C3AED', h3: 'A78BFA', r1: 'EDE9FE', r2: 'F5F3FF', accent: 'C4B5FD', stripe: 'DDD6FE', badge: '4C1D95' },
    demografi:     { h1: '450A0A', h2: 'DC2626', h3: 'F87171', r1: 'FEE2E2', r2: 'FFF1F2', accent: 'FCA5A5', stripe: 'FECACA', badge: '7F1D1D' },
    pompa_saluran: { h1: '0C2A4A', h2: '0284C7', h3: '38BDF8', r1: 'E0F2FE', r2: 'F0F9FF', accent: '7DD3FC', stripe: 'BAE6FD', badge: '075985' },
    batas:         { h1: '0F172A', h2: '334155', h3: '64748B', r1: 'F1F5F9', r2: 'F8FAFC', accent: 'CBD5E1', stripe: 'E2E8F0', badge: '1E293B' },
    _default:      { h1: '111827', h2: '374151', h3: '6B7280', r1: 'F3F4F6', r2: 'F9FAFB', accent: 'D1D5DB', stripe: 'E5E7EB', badge: '1F2937' }
};

function _pal(layerKey) {
    const cfg = (typeof layerConfig !== 'undefined') ? layerConfig[layerKey] : null;
    const grp = cfg ? (cfg.group || '_default') : '_default';
    return GROUP_PALETTES[grp] || GROUP_PALETTES._default;
}

// ── Utilitas dasar ────────────────────────────────────────────

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
        'Latitude':  center ? parseFloat(center[1].toFixed(6)) : '',
        'Longitude': center ? parseFloat(center[0].toFixed(6)) : ''
    };
    Object.keys(props).forEach(function(k) {
        if (k !== nameKey && k !== 'Name' && k !== 'NAMA') row[k] = props[k];
    });
    return row;
}

function colLetter(n) {
    let s = '';
    while (n > 0) { n--; s = String.fromCharCode(65 + (n % 26)) + s; n = Math.floor(n / 26); }
    return s;
}

// ── Style helpers ─────────────────────────────────────────────

function _f(opts) { return Object.assign({ name: 'Arial' }, opts || {}); }
function _fill(rgb) { return { fgColor: { rgb: rgb }, patternType: 'solid' }; }
function _border(style, rgb) { return { style: style, color: { rgb: rgb } }; }
function _allBorder(style, rgb) { const b = _border(style, rgb); return { top: b, bottom: b, left: b, right: b }; }

// ── Label grup ────────────────────────────────────────────────

const GRP_MAP = {
    infrastruktur: 'Infrastruktur',
    pendidikan:    'Pendidikan',
    persampahan:   'Persampahan & Lingkungan',
    fasilitas:     'Fasilitas Umum',
    demografi:     'Demografi',
    pompa_saluran: 'Pompa & Saluran Air',
    batas:         'Batas Wilayah'
};

// ── Helper: jumlah marker konsisten ──────────────────────────

function _getMarkerCount(layerKey) {
    if (window.FilterWilayah &&
        typeof window.FilterWilayah.isFilterActive === 'function' &&
        window.FilterWilayah.isFilterActive() &&
        typeof window.FilterWilayah.getInsideCount === 'function') {
        const insideCount = window.FilterWilayah.getInsideCount();
        if (insideCount[layerKey] !== undefined) return insideCount[layerKey];
    }
    if (typeof geoJsonStore !== 'undefined' && geoJsonStore[layerKey] && geoJsonStore[layerKey].features) {
        return geoJsonStore[layerKey].features.length;
    }
    if (window.mapLayers && window.mapLayers[layerKey] && typeof window.mapLayers[layerKey].getLayers === 'function') {
        return window.mapLayers[layerKey].getLayers().length;
    }
    return 0;
}

// ============================================================
// SHEET: RINGKASAN
// ============================================================

function _buildSummarySheet(layerGroups, filterLabel, filterDetails) {
    const ws = {};
    const total    = layerGroups.reduce(function(a, g) { return a + g.rows.length; }, 0);
    const numCols  = 5;
    const dateStr  = new Date().toLocaleDateString('id-ID', { weekday: 'long', day: '2-digit', month: 'long', year: 'numeric' });
    const exportedAt = 'Diekspor pada: ' + dateStr;

    // ── Header Instansi ────────────────────────────────────────
    // Baris 1: Nama instansi / sistem
    for (let c = 1; c <= numCols; c++) {
        ws[colLetter(c) + '1'] = {
            t: 's', v: c === 1 ? 'PEMERINTAH KOTA SURABAYA' : '',
            s: {
                font: _f({ bold: true, sz: 11, color: { rgb: 'FFFFFF' } }),
                fill: _fill('0D2137'),
                alignment: { horizontal: 'center', vertical: 'center' },
            }
        };
    }

    // Baris 2: Judul laporan
    for (let c = 1; c <= numCols; c++) {
        ws[colLetter(c) + '2'] = {
            t: 's', v: c === 1 ? 'REKAP DATA PETA KOTA SURABAYA' : '',
            s: {
                font: _f({ bold: true, sz: 20, color: { rgb: 'FFFFFF' } }),
                fill: _fill('152B52'),
                alignment: { horizontal: 'center', vertical: 'center' },
                border: { bottom: _border('medium', '3B82F6') }
            }
        };
    }

    // Baris 3: Sub judul sistem
    for (let c = 1; c <= numCols; c++) {
        ws[colLetter(c) + '3'] = {
            t: 's', v: c === 1 ? 'Sistem Informasi Data Peta Surabaya (SIDAPETA)' : '',
            s: {
                font: _f({ sz: 10, italic: true, color: { rgb: 'BFDBFE' } }),
                fill: _fill('0F2040'),
                alignment: { horizontal: 'center', vertical: 'center' }
            }
        };
    }

    // Baris 4: Tanggal ekspor
    for (let c = 1; c <= numCols; c++) {
        ws[colLetter(c) + '4'] = {
            t: 's', v: c === 1 ? exportedAt : '',
            s: {
                font: _f({ sz: 9, color: { rgb: '94A3B8' } }),
                fill: _fill('0B1A2E'),
                alignment: { horizontal: 'center', vertical: 'center' }
            }
        };
    }

    // Baris 5: Filter wilayah (kondisional)
    const filterOffset = filterLabel ? 1 : 0;
    if (filterLabel) {
        let filterText = 'Filter Wilayah: ';
        if (filterDetails && filterDetails.kelurahan) {
            filterText += 'Kelurahan ' + filterDetails.kelurahan;
            if (filterDetails.kecamatan) filterText += ', Kecamatan ' + filterDetails.kecamatan;
        } else if (filterDetails && filterDetails.kecamatan) {
            filterText += 'Kecamatan ' + filterDetails.kecamatan;
        } else {
            filterText += filterLabel;
        }

        for (let c = 1; c <= numCols; c++) {
            ws[colLetter(c) + '5'] = {
                t: 's', v: c === 1 ? filterText : '',
                s: {
                    font: _f({ bold: true, sz: 10, color: { rgb: '1E3A5F' } }),
                    fill: _fill('DBEAFE'),
                    alignment: { horizontal: 'center', vertical: 'center' },
                    border: { top: _border('thin', '93C5FD'), bottom: _border('thin', '93C5FD') }
                }
            };
        }
    }

    // Baris pembatas (garis tipis biru)
    const sepRow = 5 + filterOffset;
    for (let c = 1; c <= numCols; c++) {
        ws[colLetter(c) + sepRow] = {
            t: 's', v: '',
            s: { fill: _fill('1D4ED8'), border: _allBorder('thin', '1D4ED8') }
        };
    }

    // ── Kartu Statistik ──────────────────────────────────────
    const cardRow1 = 6 + filterOffset;
    const cardRow2 = 7 + filterOffset;

    // Kartu kiri: Total Layer
    ws['A' + cardRow1] = { t: 's', v: 'TOTAL LAYER AKTIF', s: { font: _f({ bold: true, sz: 9, color: { rgb: 'BFDBFE' } }), fill: _fill('1E3A8A'), alignment: { horizontal: 'center', vertical: 'center' }, border: { top: _border('medium', '1D4ED8'), left: _border('medium', '1D4ED8'), right: _border('thin', '3B82F6') } } };
    ws['B' + cardRow1] = { t: 's', v: '', s: { fill: _fill('1E3A8A'), border: { top: _border('medium', '1D4ED8'), right: _border('medium', '1D4ED8') } } };
    ws['A' + cardRow2] = { t: 'n', v: layerGroups.length, s: { font: _f({ bold: true, sz: 28, color: { rgb: 'FFFFFF' } }), fill: _fill('1D4ED8'), alignment: { horizontal: 'center', vertical: 'center' }, border: { bottom: _border('medium', '1D4ED8'), left: _border('medium', '1D4ED8'), right: _border('thin', '3B82F6') } } };
    ws['B' + cardRow2] = { t: 's', v: 'Layer', s: { font: _f({ bold: true, sz: 12, color: { rgb: '93C5FD' } }), fill: _fill('1D4ED8'), alignment: { horizontal: 'left', vertical: 'center' }, border: { bottom: _border('medium', '1D4ED8'), right: _border('medium', '1D4ED8') } } };

    // Spacer kolom C
    ws['C' + cardRow1] = { t: 's', v: '', s: { fill: _fill('F8FAFC') } };
    ws['C' + cardRow2] = { t: 's', v: '', s: { fill: _fill('F8FAFC') } };

    // Kartu kanan: Total Data
    ws['D' + cardRow1] = { t: 's', v: 'TOTAL KESELURUHAN DATA', s: { font: _f({ bold: true, sz: 9, color: { rgb: 'CCFBF1' } }), fill: _fill('0F766E'), alignment: { horizontal: 'center', vertical: 'center' }, border: { top: _border('medium', '0D9488'), left: _border('medium', '0D9488'), right: _border('thin', '14B8A6') } } };
    ws['E' + cardRow1] = { t: 's', v: '', s: { fill: _fill('0F766E'), border: { top: _border('medium', '0D9488'), right: _border('medium', '0D9488') } } };
    ws['D' + cardRow2] = { t: 'n', v: total, s: { font: _f({ bold: true, sz: 28, color: { rgb: 'FFFFFF' } }), fill: _fill('0D9488'), alignment: { horizontal: 'center', vertical: 'center' }, border: { bottom: _border('medium', '0D9488'), left: _border('medium', '0D9488'), right: _border('thin', '14B8A6') } } };
    ws['E' + cardRow2] = { t: 's', v: 'Data', s: { font: _f({ bold: true, sz: 12, color: { rgb: '5EEAD4' } }), fill: _fill('0D9488'), alignment: { horizontal: 'left', vertical: 'center' }, border: { bottom: _border('medium', '0D9488'), right: _border('medium', '0D9488') } } };

    // Baris kosong sebelum tabel
    const emptyRow = 8 + filterOffset;
    for (let c = 1; c <= numCols; c++) {
        ws[colLetter(c) + emptyRow] = { t: 's', v: '', s: { fill: _fill('F8FAFC') } };
    }

    // ── Header Tabel ──────────────────────────────────────────
    const headerRow = 9 + filterOffset;
    const hdCols    = ['No', 'Nama Layer', 'Kategori', 'Jumlah Data', 'Persentase'];
    hdCols.forEach(function(h, ci) {
        ws[colLetter(ci + 1) + headerRow] = {
            t: 's', v: h,
            s: {
                font: _f({ bold: true, sz: 10, color: { rgb: 'FFFFFF' } }),
                fill: _fill('0F2040'),
                alignment: { horizontal: 'center', vertical: 'center' },
                border: {
                    top:    _border('medium', '1D4ED8'),
                    bottom: _border('medium', '3B82F6'),
                    left:   _border('thin',   '1D4ED8'),
                    right:  _border('thin',   '1D4ED8')
                }
            }
        };
    });

    // ── Baris Data Ringkasan ──────────────────────────────────
    layerGroups.forEach(function(group, idx) {
        const r      = idx + headerRow + 1;
        const isOdd  = idx % 2 === 0;
        const p      = _pal(group.key);
        const bg     = isOdd ? p.r1 : 'FFFFFF';
        const bgAlt  = isOdd ? p.stripe : p.r2;

        const cfg        = (typeof layerConfig !== 'undefined') ? layerConfig[group.key] : null;
        const grpDisplay = GRP_MAP[cfg ? (cfg.group || '_default') : '_default'] || '-';
        const pct        = total > 0 ? group.rows.length / total : 0;

        const brd = {
            top:   _border('thin', 'D1D5DB'),
            bottom:_border('thin', 'D1D5DB'),
            left:  _border('thin', 'CBD5E1'),
            right: _border('thin', 'CBD5E1')
        };
        const brdLeft = Object.assign({}, brd, { left: _border('medium', p.h2) });

        ws['A' + r] = { t: 'n', v: idx + 1,         s: { font: _f({ bold: true, sz: 10, color: { rgb: 'FFFFFF' } }), fill: _fill(p.badge), alignment: { horizontal: 'center', vertical: 'center' }, border: brdLeft } };
        ws['B' + r] = { t: 's', v: group.label,       s: { font: _f({ bold: true, sz: 10, color: { rgb: p.h1 } }),    fill: _fill(bg),      alignment: { horizontal: 'left',   vertical: 'center' }, border: brd } };
        ws['C' + r] = { t: 's', v: grpDisplay,        s: { font: _f({ sz: 9,  italic: true, color: { rgb: '64748B' } }), fill: _fill(bgAlt), alignment: { horizontal: 'center', vertical: 'center' }, border: brd } };
        ws['D' + r] = { t: 'n', v: group.rows.length, s: { font: _f({ bold: true, sz: 11, color: { rgb: p.badge } }),  fill: _fill(bg),     alignment: { horizontal: 'center', vertical: 'center' }, border: brd } };
        ws['E' + r] = { t: 'n', v: pct,               s: { font: _f({ sz: 10, color: { rgb: '0F766E' } }),             fill: _fill(bgAlt),  alignment: { horizontal: 'center', vertical: 'center' }, border: brd }, z: '0.0%' };
    });

    // ── Baris Total ───────────────────────────────────────────
    const totR = layerGroups.length + headerRow + 1;
    const totS = { font: _f({ bold: true, sz: 11, color: { rgb: 'FFFFFF' } }), fill: _fill('0F2040'), alignment: { horizontal: 'center', vertical: 'center' }, border: _allBorder('medium', '1D4ED8') };
    ws['A' + totR] = { t: 's', v: '',                    s: totS };
    ws['B' + totR] = { t: 's', v: 'TOTAL KESELURUHAN',   s: Object.assign({}, totS, { alignment: { horizontal: 'left', vertical: 'center' } }) };
    ws['C' + totR] = { t: 's', v: '',                    s: totS };
    ws['D' + totR] = { t: 'n', v: total,                 s: Object.assign({}, totS, { font: _f({ bold: true, sz: 14, color: { rgb: '7DD3FC' } }) }) };
    ws['E' + totR] = { t: 'n', v: 1,                     s: Object.assign({}, totS, { font: _f({ bold: true, sz: 10, color: { rgb: '5EEAD4' } }) }), z: '0%' };

    // ── Baris Catatan Kaki ────────────────────────────────────
    const noteRow = totR + 1;
    for (let c = 1; c <= numCols; c++) {
        ws[colLetter(c) + noteRow] = {
            t: 's',
            v: c === 1 ? 'Catatan: Data dihitung berdasarkan layer yang aktif pada saat ekspor dilakukan.' : '',
            s: {
                font: _f({ sz: 8, italic: true, color: { rgb: '94A3B8' } }),
                fill: _fill('F8FAFC'),
                alignment: { horizontal: 'left', vertical: 'center' }
            }
        };
    }

    ws['!ref'] = 'A1:E' + noteRow;

    // ── Merges ───────────────────────────────────────────────
    const merges = [
        { s:{r:0,c:0}, e:{r:0,c:4} }, // instansi
        { s:{r:1,c:0}, e:{r:1,c:4} }, // judul
        { s:{r:2,c:0}, e:{r:2,c:4} }, // sub judul
        { s:{r:3,c:0}, e:{r:3,c:4} }, // tanggal
    ];
    if (filterLabel) {
        merges.push({ s:{r:4,c:0}, e:{r:4,c:4} }); // filter baris
    }
    merges.push({ s:{r:4+filterOffset,c:0}, e:{r:4+filterOffset,c:4} }); // garis biru
    merges.push({ s:{r:5+filterOffset,c:0}, e:{r:5+filterOffset,c:1} }); // kartu kiri atas
    merges.push({ s:{r:6+filterOffset,c:0}, e:{r:6+filterOffset,c:1} }); // kartu kiri bawah
    merges.push({ s:{r:5+filterOffset,c:3}, e:{r:5+filterOffset,c:4} }); // kartu kanan atas
    merges.push({ s:{r:6+filterOffset,c:3}, e:{r:6+filterOffset,c:4} }); // kartu kanan bawah
    merges.push({ s:{r:7+filterOffset,c:0}, e:{r:7+filterOffset,c:4} }); // baris kosong
    merges.push({ s:{r:noteRow-1,c:0},      e:{r:noteRow-1,c:4} });       // catatan kaki

    ws['!merges'] = merges;
    ws['!cols']   = [{ wch: 7 }, { wch: 38 }, { wch: 26 }, { wch: 16 }, { wch: 13 }];
    ws['!rows']   = [
        { hpt: 22 }, // instansi
        { hpt: 46 }, // judul
        { hpt: 18 }, // sub judul
        { hpt: 16 }, // tanggal
        ...(filterLabel ? [{ hpt: 18 }] : []),
        { hpt: 5  }, // garis biru
        { hpt: 20 }, // kartu atas
        { hpt: 40 }, // kartu bawah
        { hpt: 10 }, // kosong
        { hpt: 28 }, // header tabel
    ];

    return ws;
}

// ============================================================
// SHEET: PER LAYER
// ============================================================

function _buildLayerSheet(group, filterLabel, filterDetails) {
    const ws      = {};
    const p       = _pal(group.key);
    const cfg     = (typeof layerConfig !== 'undefined') ? layerConfig[group.key] : null;
    const grpRaw  = cfg ? (cfg.group || '_default') : '_default';
    const grpDisplay = GRP_MAP[grpRaw] || grpRaw;
    const dateStr = new Date().toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });

    const allKeys = ['No', 'Nama', 'Latitude', 'Longitude'];
    group.rows.forEach(function(row) {
        Object.keys(row).forEach(function(k) { if (!allKeys.includes(k)) allKeys.push(k); });
    });
    const numCols = allKeys.length;
    const lastCol = colLetter(numCols);

    // ── Baris 1: Nama Instansi ────────────────────────────────
    for (let c = 1; c <= numCols; c++) {
        ws[colLetter(c) + '1'] = {
            t: 's', v: c === 1 ? 'PEMERINTAH KOTA SURABAYA' : '',
            s: {
                font: _f({ bold: true, sz: 9, color: { rgb: 'BFDBFE' } }),
                fill: _fill(p.h1),
                alignment: { horizontal: 'center', vertical: 'center' }
            }
        };
    }

    // ── Baris 2: Nama Layer (Judul Sheet) ────────────────────
    for (let c = 1; c <= numCols; c++) {
        ws[colLetter(c) + '2'] = {
            t: 's', v: c === 1 ? group.label.toUpperCase() : '',
            s: {
                font: _f({ bold: true, sz: 18, color: { rgb: 'FFFFFF' } }),
                fill: _fill(p.h2),
                alignment: { horizontal: 'center', vertical: 'center' },
                border: { bottom: _border('medium', p.h3) }
            }
        };
    }

    // ── Baris 3: Kategori & Tanggal ──────────────────────────
    for (let c = 1; c <= numCols; c++) {
        const isFirst = c === 1;
        const isLast  = c === numCols;
        ws[colLetter(c) + '3'] = {
            t: 's',
            v: isFirst ? 'Kategori: ' + grpDisplay : isLast ? 'Tanggal Ekspor: ' + dateStr : '',
            s: {
                font: _f({ sz: 9, bold: isFirst, italic: isLast, color: { rgb: 'E0F2FE' } }),
                fill: _fill(p.h1),
                alignment: { horizontal: isFirst ? 'left' : isLast ? 'right' : 'center', vertical: 'center' }
            }
        };
    }

    // ── Baris 4 (kondisional): Filter Wilayah ────────────────
    const filterOffset = filterLabel ? 1 : 0;
    if (filterLabel) {
        let filterText = 'Filter Wilayah: ';
        if (filterDetails && filterDetails.kelurahan) {
            filterText += 'Kelurahan ' + filterDetails.kelurahan;
            if (filterDetails.kecamatan) filterText += ', Kecamatan ' + filterDetails.kecamatan;
        } else if (filterDetails && filterDetails.kecamatan) {
            filterText += 'Kecamatan ' + filterDetails.kecamatan;
        } else {
            filterText += filterLabel;
        }

        for (let c = 1; c <= numCols; c++) {
            ws[colLetter(c) + '4'] = {
                t: 's', v: c === 1 ? filterText : '',
                s: {
                    font: _f({ bold: true, sz: 9, color: { rgb: '1E3A5F' } }),
                    fill: _fill('DBEAFE'),
                    alignment: { horizontal: 'center', vertical: 'center' },
                    border: { top: _border('thin', '93C5FD'), bottom: _border('thin', '93C5FD') }
                }
            };
        }
    }

    // ── Baris info jumlah data ────────────────────────────────
    const infoRow = 4 + filterOffset;
    for (let c = 1; c <= numCols; c++) {
        const isLabel = c === 1;
        const isVal   = c === 2;
        ws[colLetter(c) + infoRow] = {
            t: isVal ? 'n' : 's',
            v: isVal ? group.rows.length : (isLabel ? 'Jumlah Data' : ''),
            s: {
                font: _f({ bold: true, sz: isVal ? 14 : 10, color: { rgb: isVal ? 'FFFFFF' : (isLabel ? p.h3 : '94A3B8') } }),
                fill: _fill(isVal ? p.badge : (isLabel ? p.h1 : p.r1)),
                alignment: { horizontal: isVal ? 'center' : (isLabel ? 'right' : 'center'), vertical: 'center' },
                border: isVal ? _allBorder('medium', p.accent) : { bottom: _border('thin', p.stripe) }
            }
        };
    }

    // ── Baris kosong pemisah ──────────────────────────────────
    const emptyRow = 5 + filterOffset;
    for (let c = 1; c <= numCols; c++) {
        ws[colLetter(c) + emptyRow] = { t: 's', v: '', s: { fill: _fill('F8FAFC'), border: { bottom: _border('thin', p.stripe) } } };
    }

    // ── Header Kolom ──────────────────────────────────────────
    const headerRow = 6 + filterOffset;
    allKeys.forEach(function(key, ci) {
        const isFixed = ['No', 'Nama', 'Latitude', 'Longitude'].includes(key);
        ws[colLetter(ci + 1) + headerRow] = {
            t: 's', v: key,
            s: {
                font: _f({ bold: true, sz: 10, color: { rgb: 'FFFFFF' } }),
                fill: _fill(isFixed ? p.h1 : p.h2),
                alignment: { horizontal: 'center', vertical: 'center', wrapText: true },
                border: {
                    top:    _border('medium', p.h1),
                    bottom: _border('medium', p.h3),
                    left:   _border('thin',   p.badge),
                    right:  _border('thin',   p.badge)
                }
            }
        };
    });

    // ── Baris Data ────────────────────────────────────────────
    group.rows.forEach(function(row, ri) {
        const excelRow = ri + 7 + filterOffset;
        const isOdd    = ri % 2 === 0;
        const bg       = isOdd ? p.r1 : 'FFFFFF';
        const bgStripe = isOdd ? p.stripe : p.r2;

        allKeys.forEach(function(key, ci) {
            const val      = row[key] !== undefined ? row[key] : '';
            const isNum    = typeof val === 'number';
            const isNo     = key === 'No';
            const isNama   = key === 'Nama';
            const isCenter = isNo || key === 'Latitude' || key === 'Longitude';
            const colRef   = colLetter(ci + 1) + excelRow;

            ws[colRef] = {
                t: isNum ? 'n' : 's', v: val,
                s: {
                    font: _f({
                        sz: 10,
                        bold: isNo || isNama,
                        color: { rgb: isNo ? 'FFFFFF' : (isNama ? p.h1 : '1E293B') }
                    }),
                    fill: _fill(isNo ? (isOdd ? p.badge : p.h2) : (isNama ? bgStripe : bg)),
                    alignment: { horizontal: isCenter ? 'center' : 'left', vertical: 'center' },
                    border: {
                        top:    _border('thin', p.r1),
                        bottom: _border('thin', p.r1),
                        left:   _border(isNo ? 'medium' : 'thin', isNo ? p.h1 : 'D1D5DB'),
                        right:  _border(isNo ? 'thin'   : 'thin', isNo ? p.badge : 'D1D5DB')
                    }
                }
            };
        });
    });

    // ── Baris Footer ─────────────────────────────────────────
    const footerRow = group.rows.length + 7 + filterOffset;
    for (let c = 1; c <= numCols; c++) {
        let footerText = '';
        if (c === 1) {
            footerText = 'Total: ' + group.rows.length + ' record';
            if (filterLabel) {
                if (filterDetails && filterDetails.kelurahan) {
                    footerText += ' - Filter: Kel. ' + filterDetails.kelurahan;
                    if (filterDetails.kecamatan) footerText += ', Kec. ' + filterDetails.kecamatan;
                } else if (filterDetails && filterDetails.kecamatan) {
                    footerText += ' - Filter: Kec. ' + filterDetails.kecamatan;
                }
            }
        }

        ws[colLetter(c) + footerRow] = {
            t: 's', v: footerText,
            s: {
                font: _f({ bold: true, sz: 10, color: { rgb: c === 1 ? p.accent : 'FFFFFF' } }),
                fill: _fill(p.h1),
                alignment: { horizontal: c === 1 ? 'left' : 'center', vertical: 'center' },
                border: {
                    top:    _border('medium', p.h3),
                    bottom: _border('thin',   p.h1),
                    left:   _border('thin',   p.badge),
                    right:  _border('thin',   p.h2)
                }
            }
        };
    }

    // ── Baris Catatan Sumber Data ─────────────────────────────
    const sourceRow = footerRow + 1;
    for (let c = 1; c <= numCols; c++) {
        ws[colLetter(c) + sourceRow] = {
            t: 's',
            v: c === 1 ? 'Sumber: Sistem Informasi Data Peta Surabaya (SIDAPETA). Koordinat dalam format desimal (WGS 84).' : '',
            s: {
                font: _f({ sz: 8, italic: true, color: { rgb: '94A3B8' } }),
                fill: _fill('F8FAFC'),
                alignment: { horizontal: 'left', vertical: 'center' }
            }
        };
    }

    ws['!ref'] = 'A1:' + lastCol + sourceRow;

    // ── Merges ───────────────────────────────────────────────
    const merges = [
        { s:{r:0,c:0}, e:{r:0,c:numCols-1} }, // instansi
        { s:{r:1,c:0}, e:{r:1,c:numCols-1} }, // judul layer
        { s:{r:2,c:0}, e:{r:2,c:numCols-2} }, // kategori (kiri)
        // kolom terakhir baris 3 (tanggal) tidak di-merge agar rata kanan bisa benar
    ];
    if (filterLabel) {
        merges.push({ s:{r:3,c:0}, e:{r:3,c:numCols-1} }); // filter
    }
    merges.push({ s:{r:footerRow-1,c:0},  e:{r:footerRow-1,c:numCols-1} }); // footer
    merges.push({ s:{r:sourceRow-1,c:0},  e:{r:sourceRow-1,c:numCols-1} }); // catatan sumber

    ws['!merges'] = merges;

    ws['!cols'] = allKeys.map(function(k) {
        if (k === 'No')        return { wch: 6 };
        if (k === 'Nama')      return { wch: 38 };
        if (k === 'Latitude' || k === 'Longitude') return { wch: 16 };
        const maxLen = Math.max(k.length, ...group.rows.map(function(r) { return String(r[k] !== undefined ? r[k] : '').length; }));
        return { wch: Math.min(Math.max(maxLen + 4, 14), 42) };
    });

    ws['!rows'] = [
        { hpt: 18 }, // instansi
        { hpt: 40 }, // judul
        { hpt: 18 }, // kategori & tanggal
        ...(filterLabel ? [{ hpt: 16 }] : []),
        { hpt: 28 }, // info jumlah
        { hpt: 8  }, // kosong
        { hpt: 26 }, // header kolom
    ];

    return ws;
}

// ============================================================
// FUNGSI UTAMA EKSPOR
// ============================================================

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

    // Cek filter wilayah
    const filterActive  = (typeof FilterWilayah !== 'undefined') && FilterWilayah.isFilterActive();
    const activeFeature = filterActive ? FilterWilayah.getActiveFeature() : null;
    const filterLabel   = filterActive ? FilterWilayah.getFilterLabel()   : null;
    const filterDetails = filterActive ? {
        kecamatan: (document.getElementById('fw-kecamatan') || {}).value || null,
        kelurahan: (document.getElementById('fw-kelurahan') || {}).value || null
    } : null;

    // Helper: apakah feature ada di dalam wilayah filter
    function _featureInsideRegion(feature) {
        if (!activeFeature || !feature || !feature.geometry) return true;
        try {
            const g = feature.geometry;
            let point;
            if (g.type === 'Point') {
                point = turf.point(g.coordinates);
            } else if (g.type === 'MultiPoint' && g.coordinates.length) {
                point = turf.point(g.coordinates[0]);
            } else if (g.type === 'LineString' && g.coordinates.length) {
                point = turf.point(g.coordinates[Math.floor(g.coordinates.length / 2)]);
            } else if (g.type === 'MultiLineString' && g.coordinates.length) {
                const seg = g.coordinates[0];
                point = turf.point(seg[Math.floor(seg.length / 2)]);
            } else {
                point = turf.centroid(feature);
            }
            let poly;
            if (activeFeature.geometry.type === 'Polygon') {
                poly = turf.polygon(activeFeature.geometry.coordinates);
            } else if (activeFeature.geometry.type === 'MultiPolygon') {
                poly = turf.multiPolygon(activeFeature.geometry.coordinates);
            } else {
                return true;
            }
            return turf.booleanPointInPolygon(point, poly);
        } catch (e) {
            return true;
        }
    }

    // Kumpulkan data tiap layer
    const layerGroups = [];
    checked.forEach(function(checkbox) {
        const layerKey = checkbox.getAttribute('data-layer');
        const layer    = mapLayers[layerKey];
        const config   = (typeof layerConfig !== 'undefined') ? layerConfig[layerKey] : null;
        if (!layer || !map.hasLayer(layer)) return;
        if (config && config.isBoundary) return;

        const rows = [];
        const data = geoJsonStore[layerKey];

        if (data && data.features && data.features.length) {
            data.features.forEach(function(feature) {
                if (filterActive && !_featureInsideRegion(feature)) return;
                rows.push(featureToRow(layerKey, feature, rows.length, config));
            });
        } else {
            layer.eachLayer(function(l) {
                const feature = l.feature;
                if (!feature) return;
                if (filterActive && !_featureInsideRegion(feature)) return;
                rows.push(featureToRow(layerKey, feature, rows.length, config));
            });
        }

        if (rows.length > 0) {
            layerGroups.push({ key: layerKey, label: config ? config.label : layerKey, rows: rows });
        }
    });

    if (layerGroups.length === 0) {
        alert('Tidak ada data yang dapat diekspor' + (filterActive ? ' dalam wilayah "' + filterLabel + '".' : '.'));
        return;
    }

    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, _buildSummarySheet(layerGroups, filterLabel, filterDetails), 'Ringkasan');
    layerGroups.forEach(function(group) {
        const ws        = _buildLayerSheet(group, filterLabel, filterDetails);
        const sheetName = group.label.replace(/[:\\\/\?\*\[\]]/g, '').substring(0, 31);
        XLSX.utils.book_append_sheet(wb, ws, sheetName);
    });

    const dateStr = new Date().toISOString().slice(0, 10);
    const suffix  = filterActive ? '_' + filterLabel.replace(/[\s›<>:"\/\\|?*]/g, '_') : '';
    XLSX.writeFile(wb, 'Data_Peta_Surabaya' + suffix + '_' + dateStr + '.xlsx', { cellStyles: true });
};