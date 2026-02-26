// ============================================================
// EXCEL-EXPORT.JS - Export data layer aktif ke Excel (Premium)
// ============================================================

// ── Palet warna per grup layer ───────────────────────────────
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

function _f(opts) {
    return Object.assign({ name: 'Arial' }, opts || {});
}

function _fill(rgb) {
    return { fgColor: { rgb: rgb }, patternType: 'solid' };
}

function _border(style, rgb) {
    return { style: style, color: { rgb: rgb } };
}

function _allBorder(style, rgb) {
    const b = _border(style, rgb);
    return { top: b, bottom: b, left: b, right: b };
}

function _thickBorder(outerStyle, outerRgb, innerStyle, innerRgb) {
    return {
        top:    _border(outerStyle, outerRgb),
        bottom: _border(outerStyle, outerRgb),
        left:   _border(outerStyle, outerRgb),
        right:  _border(innerStyle, innerRgb)
    };
}

function _cell(v, t, font, fill, align, border) {
    return { t: t || 's', v: v, s: { font: font, fill: fill, alignment: align, border: border } };
}

// ── Sheet RINGKASAN ───────────────────────────────────────────

function _buildSummarySheet(layerGroups, filterLabel) {
    const ws = {};
    const total = layerGroups.reduce(function(a, g) { return a + g.rows.length; }, 0);
    const dateStr = new Date().toLocaleDateString('id-ID', { weekday: 'long', day: '2-digit', month: 'long', year: 'numeric' });
    const numCols = 5;

    // ── Baris 1: Judul utama – gradient gelap ──
    for (let c = 1; c <= numCols; c++) {
        ws[colLetter(c) + '1'] = {
            t: 's', v: c === 1 ? '🗺  REKAP DATA PETA KOTA SURABAYA' : '',
            s: {
                font: _f({ bold: true, sz: 22, color: { rgb: 'FFFFFF' } }),
                fill: _fill('050E1D'),
                alignment: { horizontal: 'center', vertical: 'center' },
                border: { bottom: _border('thick', '1D4ED8') }
            }
        };
    }

    // ── Baris 2: Sub judul ──
    for (let c = 1; c <= numCols; c++) {
        ws[colLetter(c) + '2'] = {
            t: 's', v: c === 1 ? 'SISTEM INFORMASI DATA PETA SURABAYA  ( S I D A P E T A )' : '',
            s: {
                font: _f({ sz: 12, bold: true, color: { rgb: 'BFDBFE' }, italic: true }),
                fill: _fill('0D2451'),
                alignment: { horizontal: 'center', vertical: 'center' }
            }
        };
    }

    // ── Baris 3: Tanggal ──
    for (let c = 1; c <= numCols; c++) {
        ws[colLetter(c) + '3'] = {
            t: 's', v: c === 1 ? '📅  Diekspor pada: ' + dateStr : '',
            s: {
                font: _f({ sz: 9, color: { rgb: '94A3B8' }, italic: true }),
                fill: _fill('0F172A'),
                alignment: { horizontal: 'center', vertical: 'center' }
            }
        };
    }

    // ── Baris 3b (dinamis): Info filter wilayah jika aktif ──
    // Geser baris berikutnya berdasarkan apakah ada filter atau tidak
    const filterOffset = filterLabel ? 1 : 0;
    if (filterLabel) {
        for (let c = 1; c <= numCols; c++) {
            ws[colLetter(c) + '4'] = {
                t: 's', v: c === 1 ? '\uD83D\uDCCD  Filter Wilayah: ' + filterLabel : '',
                s: {
                    font: _f({ bold: true, sz: 10, color: { rgb: 'FEF08A' } }),
                    fill: _fill('713F12'),
                    alignment: { horizontal: 'center', vertical: 'center' }
                }
            };
        }
    }

    // ── Baris aksen (4 atau 5 tergantung filter) ──
    const accentRow = 4 + filterOffset;
    const accentColors = ['1D4ED8', '2563EB', '3B82F6', '2563EB', '1D4ED8'];
    for (let c = 1; c <= numCols; c++) {
        ws[colLetter(c) + accentRow] = { t: 's', v: '', s: { fill: _fill(accentColors[c - 1]), border: _allBorder('thick', accentColors[c - 1]) } };
    }

    // ── Baris kosong (5 atau 6) ──
    const emptyRow1 = 5 + filterOffset;
    for (let c = 1; c <= numCols; c++) {
        ws[colLetter(c) + emptyRow1] = { t: 's', v: '', s: { fill: _fill('EFF6FF') } };
    }

    // ── Baris 6–7 (atau 7–8): Kartu statistik ──
    const cardRow1 = 6 + filterOffset;
    const cardRow2 = 7 + filterOffset;
    // Kartu kiri: Total Layer (biru gelap)
    ws['A' + cardRow1] = { t: 's', v: '▣  TOTAL LAYER AKTIF', s: { font: _f({ bold: true, sz: 10, color: { rgb: 'DBEAFE' } }), fill: _fill('1E3A8A'), alignment: { horizontal: 'center', vertical: 'center' }, border: _allBorder('medium', '1D4ED8') } };
    ws['B' + cardRow1] = { t: 's', v: '', s: { fill: _fill('1E3A8A'), border: _allBorder('medium', '1D4ED8') } };
    ws['A' + cardRow2] = { t: 'n', v: layerGroups.length, s: { font: _f({ bold: true, sz: 32, color: { rgb: 'FFFFFF' } }), fill: _fill('1D4ED8'), alignment: { horizontal: 'center', vertical: 'center' }, border: { top: _border('thin', '3B82F6'), bottom: _border('thick', '93C5FD'), left: _border('medium', '1D4ED8'), right: _border('medium', '1D4ED8') } } };
    ws['B' + cardRow2] = { t: 's', v: 'LAYER', s: { font: _f({ bold: true, sz: 14, color: { rgb: '93C5FD' } }), fill: _fill('1D4ED8'), alignment: { horizontal: 'left', vertical: 'center' }, border: { top: _border('thin', '3B82F6'), bottom: _border('thick', '93C5FD'), left: _border('thin', '3B82F6'), right: _border('medium', '1D4ED8') } } };

    // Kolom C: spacer
    ws['C' + cardRow1] = { t: 's', v: '', s: { fill: _fill('EFF6FF') } };
    ws['C' + cardRow2] = { t: 's', v: '', s: { fill: _fill('EFF6FF') } };

    // Kartu kanan: Total Data (hijau teal)
    ws['D' + cardRow1] = { t: 's', v: '◉  TOTAL KESELURUHAN DATA', s: { font: _f({ bold: true, sz: 10, color: { rgb: 'CCFBF1' } }), fill: _fill('0F766E'), alignment: { horizontal: 'center', vertical: 'center' }, border: _allBorder('medium', '0D9488') } };
    ws['E' + cardRow1] = { t: 's', v: '', s: { fill: _fill('0F766E'), border: _allBorder('medium', '0D9488') } };
    ws['D' + cardRow2] = { t: 'n', v: total, s: { font: _f({ bold: true, sz: 32, color: { rgb: 'FFFFFF' } }), fill: _fill('0D9488'), alignment: { horizontal: 'center', vertical: 'center' }, border: { top: _border('thin', '14B8A6'), bottom: _border('thick', '5EEAD4'), left: _border('medium', '0D9488'), right: _border('thin', '14B8A6') } } };
    ws['E' + cardRow2] = { t: 's', v: 'DATA', s: { font: _f({ bold: true, sz: 14, color: { rgb: '5EEAD4' } }), fill: _fill('0D9488'), alignment: { horizontal: 'left', vertical: 'center' }, border: { top: _border('thin', '14B8A6'), bottom: _border('thick', '5EEAD4'), left: _border('thin', '14B8A6'), right: _border('medium', '0D9488') } } };

    // ── Baris kosong ke-2 ──
    const emptyRow2 = 8 + filterOffset;
    for (let c = 1; c <= numCols; c++) {
        ws[colLetter(c) + emptyRow2] = { t: 's', v: '', s: { fill: _fill('F8FAFC') } };
    }

    // ── Baris header tabel ──
    const headerRow = 9 + filterOffset;
    const hdCols  = ['No', 'Nama Layer', 'Kategori', 'Jumlah Data', 'Persentase'];
    const hdFills = ['050E1D', '0D2451', '1D4ED8', '0D2451', '050E1D'];
    hdCols.forEach(function(h, ci) {
        ws[colLetter(ci + 1) + headerRow] = {
            t: 's', v: h,
            s: {
                font: _f({ bold: true, sz: 11, color: { rgb: 'FFFFFF' } }),
                fill: _fill(hdFills[ci]),
                alignment: { horizontal: 'center', vertical: 'center' },
                border: {
                    top:    _border('thick',  '000000'),
                    bottom: _border('thick',  '3B82F6'),
                    left:   _border('medium', '1D4ED8'),
                    right:  _border('medium', '1D4ED8')
                }
            }
        };
    });

    // ── Baris data ringkasan ──
    layerGroups.forEach(function(group, idx) {
        const r = idx + headerRow + 1;
        const isOdd = idx % 2 === 0;
        // Ambil warna dari palette layer masing-masing untuk zebra stripe
        const p = _pal(group.key);
        const bg1 = isOdd ? p.r1  : 'FFFFFF';
        const bg2 = isOdd ? p.stripe : p.r2;

        const cfg = (typeof layerConfig !== 'undefined') ? layerConfig[group.key] : null;
        const grpRaw = cfg ? (cfg.group || '–') : '–';
        const grpMap = { infrastruktur:'Infrastruktur', pendidikan:'Pendidikan', persampahan:'Persampahan', fasilitas:'Fasilitas Umum', demografi:'Demografi', pompa_saluran:'Pompa & Saluran Air', batas:'Batas Wilayah' };
        const grpDisplay = grpMap[grpRaw] || grpRaw;
        const pct = total > 0 ? group.rows.length / total : 0;

        const brdOuter = { top: _border('thin', 'CBD5E1'), bottom: _border('thin', 'CBD5E1'), left: _border('medium', p.h2), right: _border('thin', 'CBD5E1') };
        const brdInner = _allBorder('thin', 'CBD5E1');

        ws['A' + r] = { t: 'n', v: idx + 1,         s: { font: _f({ bold: true, sz: 11, color: { rgb: 'FFFFFF' } }),        fill: _fill(p.badge), alignment: { horizontal: 'center', vertical: 'center' }, border: brdOuter } };
        ws['B' + r] = { t: 's', v: group.label,       s: { font: _f({ bold: true, sz: 10, color: { rgb: p.h1 } }),            fill: _fill(bg1),     alignment: { horizontal: 'left',   vertical: 'center' }, border: brdInner } };
        ws['C' + r] = { t: 's', v: grpDisplay,        s: { font: _f({ sz: 10, italic: true, color: { rgb: '475569' } }),      fill: _fill(bg2),     alignment: { horizontal: 'center', vertical: 'center' }, border: brdInner } };
        ws['D' + r] = { t: 'n', v: group.rows.length, s: { font: _f({ bold: true, sz: 11, color: { rgb: p.badge } }),         fill: _fill(bg1),     alignment: { horizontal: 'center', vertical: 'center' }, border: brdInner } };
        ws['E' + r] = { t: 'n', v: pct,               s: { font: _f({ bold: true, sz: 10, color: { rgb: '0F766E' } }),        fill: _fill(bg2),     alignment: { horizontal: 'center', vertical: 'center' }, border: brdInner, numFmt: '0.0%' }, z: '0.0%' };
    });

    // ── Baris total ──
    const totR = layerGroups.length + headerRow + 1;
    const totS = { font: _f({ bold: true, sz: 12, color: { rgb: 'FFFFFF' } }), fill: _fill('050E1D'), alignment: { horizontal: 'center', vertical: 'center' }, border: _allBorder('thick', '1D4ED8') };
    ws['A' + totR] = { t: 's', v: '\u2211',      s: totS };
    ws['B' + totR] = { t: 's', v: 'TOTAL KESELURUHAN', s: Object.assign({}, totS, { alignment: { horizontal: 'left', vertical: 'center' } }) };
    ws['C' + totR] = { t: 's', v: '',       s: totS };
    ws['D' + totR] = { t: 'n', v: total,    s: Object.assign({}, totS, { font: _f({ bold: true, sz: 14, color: { rgb: '7DD3FC' } }) }) };
    ws['E' + totR] = { t: 'n', v: 1,        s: Object.assign({}, totS, { font: _f({ bold: true, sz: 11, color: { rgb: '5EEAD4' } }) }), z: '0%' };

    ws['!ref'] = 'A1:E' + totR;

    // Merges — sesuaikan dengan filterOffset
    const merges = [
        { s:{r:0,c:0}, e:{r:0,c:4} },
        { s:{r:1,c:0}, e:{r:1,c:4} },
        { s:{r:2,c:0}, e:{r:2,c:4} },
    ];
    if (filterLabel) {
        merges.push({ s:{r:3,c:0}, e:{r:3,c:4} }); // baris filter wilayah
    }
    merges.push({ s:{r:3+filterOffset,c:0}, e:{r:3+filterOffset,c:4} }); // accent
    merges.push({ s:{r:4+filterOffset,c:0}, e:{r:4+filterOffset,c:4} }); // empty
    merges.push({ s:{r:5+filterOffset,c:0}, e:{r:5+filterOffset,c:1} }); // card kiri top
    merges.push({ s:{r:6+filterOffset,c:0}, e:{r:6+filterOffset,c:1} }); // card kiri bot
    merges.push({ s:{r:5+filterOffset,c:3}, e:{r:5+filterOffset,c:4} }); // card kanan top
    merges.push({ s:{r:6+filterOffset,c:3}, e:{r:6+filterOffset,c:4} }); // card kanan bot
    merges.push({ s:{r:7+filterOffset,c:0}, e:{r:7+filterOffset,c:4} }); // empty2

    ws['!merges'] = merges;
    ws['!cols'] = [{ wch: 7 }, { wch: 36 }, { wch: 24 }, { wch: 16 }, { wch: 14 }];
    ws['!rows'] = [{ hpt: 52 }, { hpt: 28 }, { hpt: 18 }, { hpt: 6 }, { hpt: 12 }, { hpt: 24 }, { hpt: 48 }, { hpt: 12 }, { hpt: 30 }];

    return ws;
}

// ── Sheet per Layer ───────────────────────────────────────────

function _buildLayerSheet(group, filterLabel) {
    const ws = {};
    const p = _pal(group.key);
    const cfg = (typeof layerConfig !== 'undefined') ? layerConfig[group.key] : null;
    const grpRaw = cfg ? (cfg.group || '_default') : '_default';
    const grpMap = { infrastruktur:'Infrastruktur', pendidikan:'Pendidikan', persampahan:'Persampahan & Lingkungan', fasilitas:'Fasilitas Umum', demografi:'Demografi', pompa_saluran:'Pompa & Saluran Air', batas:'Batas Wilayah' };
    const grpDisplay = grpMap[grpRaw] || grpRaw;
    const dateStr = new Date().toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });

    const allKeys = ['No', 'Nama', 'Latitude', 'Longitude'];
    group.rows.forEach(function(row) {
        Object.keys(row).forEach(function(k) { if (!allKeys.includes(k)) allKeys.push(k); });
    });
    const numCols = allKeys.length;
    const lastCol = colLetter(numCols);

    // ── Baris 1: Banner utama ──
    for (let c = 1; c <= numCols; c++) {
        ws[colLetter(c) + '1'] = {
            t: 's', v: c === 1 ? group.label.toUpperCase() : '',
            s: {
                font: _f({ bold: true, sz: 20, color: { rgb: 'FFFFFF' } }),
                fill: _fill(p.h1),
                alignment: { horizontal: 'center', vertical: 'center' },
                border: { bottom: _border('thick', p.h3) }
            }
        };
    }

    // ── Baris 2: Strip info ──
    for (let c = 1; c <= numCols; c++) {
        const isLast = c === numCols;
        const isFirst = c === 1;
        ws[colLetter(c) + '2'] = {
            t: 's',
            v: isFirst ? '  \uD83D\uDCC2 Kategori: ' + grpDisplay : isLast ? 'Diekspor: ' + dateStr + '  ' : '',
            s: {
                font: _f({ sz: 10, bold: isFirst, color: { rgb: 'E0F2FE' }, italic: !isFirst }),
                fill: _fill(p.h2),
                alignment: { horizontal: isFirst ? 'left' : isLast ? 'right' : 'center', vertical: 'center' }
            }
        };
    }

    // ── Baris 2b (opsional): Info filter wilayah ──
    const filterOffset = filterLabel ? 1 : 0;
    if (filterLabel) {
        for (let c = 1; c <= numCols; c++) {
            ws[colLetter(c) + '3'] = {
                t: 's', v: c === 1 ? '\uD83D\uDCCD  Filter Wilayah: ' + filterLabel : '',
                s: {
                    font: _f({ bold: true, sz: 10, color: { rgb: 'FEF08A' } }),
                    fill: _fill('713F12'),
                    alignment: { horizontal: 'center', vertical: 'center' }
                }
            };
        }
    }

    // ── Baris aksen triple ──
    const accentLineRow = 3 + filterOffset;
    for (let c = 1; c <= numCols; c++) {
        const shade = (c % 3 === 0) ? p.h3 : (c % 3 === 1) ? p.h2 : p.accent;
        ws[colLetter(c) + accentLineRow] = { t: 's', v: '', s: { fill: _fill(shade), border: _allBorder('thick', shade) } };
    }

    // ── Baris statistik ringkas ──
    const statsRow = 4 + filterOffset;
    const mid = Math.ceil(numCols / 2);
    for (let c = 1; c <= numCols; c++) {
        const isLabel = c === mid - 1;
        const isValue = c === mid;
        ws[colLetter(c) + statsRow] = {
            t: isValue ? 'n' : 's',
            v: isValue ? group.rows.length : (isLabel ? '  \uD83D\uDCCA JUMLAH DATA:' : ''),
            s: {
                font: _f({ bold: true, sz: isValue ? 16 : 11, color: { rgb: isValue ? 'FFFFFF' : (isLabel ? p.h3 : '94A3B8') } }),
                fill: _fill(isValue ? p.badge : (isLabel ? p.h1 : p.r1)),
                alignment: { horizontal: isValue ? 'center' : (isLabel ? 'right' : 'center'), vertical: 'center' },
                border: isValue
                    ? _allBorder('thick', p.accent)
                    : (isLabel ? { right: _border('medium', p.accent), bottom: _border('thin', p.stripe) }
                               : { bottom: _border('thin', p.stripe) })
            }
        };
    }

    // ── Baris kosong ──
    const emptyRow = 5 + filterOffset;
    for (let c = 1; c <= numCols; c++) {
        ws[colLetter(c) + emptyRow] = { t: 's', v: '', s: { fill: _fill('F8FAFC'), border: { bottom: _border('thin', p.stripe) } } };
    }

    // ── Baris header kolom ──
    const headerColRow = 6 + filterOffset;
    allKeys.forEach(function(key, ci) {
        const isFixed = ['No','Nama','Latitude','Longitude'].includes(key);
        ws[colLetter(ci + 1) + headerColRow] = {
            t: 's', v: key,
            s: {
                font: _f({ bold: true, sz: 11, color: { rgb: 'FFFFFF' } }),
                fill: _fill(isFixed ? p.h1 : p.h2),
                alignment: { horizontal: 'center', vertical: 'center', wrapText: true },
                border: {
                    top:    _border('thick',  p.h1),
                    bottom: _border('thick',  p.h3),
                    left:   _border('medium', p.badge),
                    right:  _border('medium', p.badge)
                }
            }
        };
    });

    // ── Baris data ──
    group.rows.forEach(function(row, ri) {
        const excelRow = ri + 7 + filterOffset;
        const isOdd = ri % 2 === 0;
        const bg = isOdd ? p.r1 : p.r2;
        const stripeBg = isOdd ? p.stripe : p.r1;

        allKeys.forEach(function(key, ci) {
            const val = row[key] !== undefined ? row[key] : '';
            const isNum = typeof val === 'number';
            const isCenter = (key === 'No' || key === 'Latitude' || key === 'Longitude');
            const isNama  = key === 'Nama';
            const colRef  = colLetter(ci + 1) + excelRow;
            const isNoCol = key === 'No';

            ws[colRef] = {
                t: isNum ? 'n' : 's', v: val,
                s: {
                    font: _f({
                        sz: 10,
                        bold: isNama || isNoCol,
                        color: { rgb: isNoCol ? 'FFFFFF' : (isNama ? p.h1 : '1E293B') }
                    }),
                    fill: _fill(isNoCol ? (isOdd ? p.badge : p.h2) : (isNama ? stripeBg : bg)),
                    alignment: { horizontal: isCenter ? 'center' : 'left', vertical: 'center' },
                    border: {
                        top:    _border('thin', p.stripe),
                        bottom: _border('thin', p.stripe),
                        left:   _border(isNoCol ? 'thick' : 'thin',  isNoCol ? p.h1   : 'D1D5DB'),
                        right:  _border(isNoCol ? 'medium' : 'thin', isNoCol ? p.badge : 'D1D5DB')
                    }
                }
            };
        });
    });

    // ── Baris footer ──
    const footerRow = group.rows.length + 7 + filterOffset;
    for (let c = 1; c <= numCols; c++) {
        const isLabel = c === 2;
        ws[colLetter(c) + footerRow] = {
            t: 's',
            v: isLabel ? '  \u2714 TOTAL: ' + group.rows.length + ' record data' + (filterLabel ? ' (Filter: ' + filterLabel + ')' : '') : '',
            s: {
                font: _f({ bold: true, sz: 11, color: { rgb: isLabel ? p.accent : 'FFFFFF' } }),
                fill: _fill(p.h1),
                alignment: { horizontal: isLabel ? 'left' : 'center', vertical: 'center' },
                border: {
                    top:    _border('thick',  p.h3),
                    bottom: _border('medium', p.h1),
                    left:   _border('medium', p.badge),
                    right:  _border('thin',   p.h2)
                }
            }
        };
    }

    const lastRow = footerRow;
    ws['!ref'] = 'A1:' + lastCol + lastRow;

    // Merges — sesuaikan dengan filterOffset
    const layerMerges = [
        { s:{r:0,c:0}, e:{r:0,c:numCols-1} }, // banner
        { s:{r:1,c:0}, e:{r:1,c:numCols-1} }, // strip info
    ];
    if (filterLabel) {
        layerMerges.push({ s:{r:2,c:0}, e:{r:2,c:numCols-1} }); // filter label row
    }
    layerMerges.push({ s:{r:2+filterOffset,c:0}, e:{r:2+filterOffset,c:numCols-1} }); // accent
    layerMerges.push({ s:{r:3+filterOffset,c:0}, e:{r:3+filterOffset,c:numCols-1} }); // stats
    layerMerges.push({ s:{r:4+filterOffset,c:0}, e:{r:4+filterOffset,c:numCols-1} }); // kosong
    layerMerges.push({ s:{r:lastRow-1,c:1},      e:{r:lastRow-1,c:numCols-1} }); // footer

    ws['!merges'] = layerMerges;

    ws['!cols'] = allKeys.map(function(k) {
        if (k === 'No') return { wch: 6 };
        if (k === 'Nama') return { wch: 36 };
        if (k === 'Latitude' || k === 'Longitude') return { wch: 16 };
        const maxLen = Math.max(k.length, ...group.rows.map(function(r) { return String(r[k] !== undefined ? r[k] : '').length; }));
        return { wch: Math.min(Math.max(maxLen + 3, 13), 40) };
    });

    const rowHeights = [
        { hpt: 50 }, // Banner
        { hpt: 22 }, // Strip info
    ];
    if (filterLabel) rowHeights.push({ hpt: 20 }); // Filter label
    rowHeights.push({ hpt: 6  }); // Garis triple
    rowHeights.push({ hpt: 32 }); // Statistik
    rowHeights.push({ hpt: 10 }); // Kosong
    rowHeights.push({ hpt: 30 }); // Header
    ws['!rows'] = rowHeights;

    return ws;
}

// ── Fungsi Utama ──────────────────────────────────────────────

window.exportMapDataToExcel = function() {
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

    // ── Cek apakah filter wilayah sedang aktif ──────────────────
    const filterActive = (typeof FilterWilayah !== 'undefined') && FilterWilayah.isFilterActive();
    const activeFeature = filterActive ? FilterWilayah.getActiveFeature() : null;
    const filterLabel   = filterActive ? FilterWilayah.getFilterLabel()   : null;

    /**
     * Helper: cek apakah sebuah GeoJSON feature ada di dalam wilayah aktif.
     * Menggunakan centroid/titik representatif feature vs polygon wilayah.
     */
    function _featureInsideRegion(feature) {
        if (!activeFeature || !feature || !feature.geometry) return true; // jika tidak ada filter, semua masuk
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
                // Polygon / MultiPolygon: gunakan centroid
                point = turf.centroid(feature);
            }

            let poly;
            if (activeFeature.geometry.type === 'Polygon') {
                poly = turf.polygon(activeFeature.geometry.coordinates);
            } else if (activeFeature.geometry.type === 'MultiPolygon') {
                poly = turf.multiPolygon(activeFeature.geometry.coordinates);
            } else {
                return true; // geometri wilayah tidak dikenal, loloskan semua
            }
            return turf.booleanPointInPolygon(point, poly);
        } catch (e) {
            return true; // jika error turf, loloskan agar tidak kehilangan data
        }
    }

    const layerGroups = [];
    checked.forEach(function(checkbox) {
        const layerKey = checkbox.getAttribute('data-layer');
        const layer  = mapLayers[layerKey];
        const config = (typeof layerConfig !== 'undefined') ? layerConfig[layerKey] : null;
        if (!layer || !map.hasLayer(layer)) return;

        // Skip layer batas wilayah — tidak relevan untuk export tabel
        if (config && config.isBoundary) return;

        const rows = [];
        const data = geoJsonStore[layerKey];

        if (data && data.features && data.features.length) {
            data.features.forEach(function(feature, i) {
                if (filterActive && !_featureInsideRegion(feature)) return; // ← filter wilayah
                rows.push(featureToRow(layerKey, feature, rows.length, config));
            });
        } else {
            layer.eachLayer(function(l) {
                const feature = l.feature;
                if (!feature) return;
                if (filterActive && !_featureInsideRegion(feature)) return; // ← filter wilayah
                rows.push(featureToRow(layerKey, feature, rows.length, config));
            });
        }

        if (rows.length > 0) {
            layerGroups.push({ key: layerKey, label: config ? config.label : layerKey, rows: rows });
        }
    });

    if (layerGroups.length === 0) {
        alert('Tidak ada data yang bisa diekspor' + (filterActive ? ' dalam wilayah filter "' + filterLabel + '".' : '.'));
        return;
    }

    const wb = XLSX.utils.book_new();

    // Kirim info filter ke sheet ringkasan
    XLSX.utils.book_append_sheet(wb, _buildSummarySheet(layerGroups, filterLabel), 'Ringkasan');

    layerGroups.forEach(function(group) {
        const ws = _buildLayerSheet(group, filterLabel);
        const sheetName = group.label.replace(/[:\\\/\?\*\[\]]/g, '').substring(0, 31);
        XLSX.utils.book_append_sheet(wb, ws, sheetName);
    });

    const dateStr = new Date().toISOString().slice(0, 10);
    const suffix  = filterActive ? '_' + filterLabel.replace(/[\s›<>:"\/\\|?*]/g, '_') : '';
    XLSX.writeFile(wb, 'Data_Peta_Surabaya' + suffix + '_' + dateStr + '.xlsx', { cellStyles: true });
};