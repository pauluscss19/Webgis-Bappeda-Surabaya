// ============================================================
// PDF-EXPORT.JS - Versi HD dengan Legend Kepadatan Penduduk + Multi-Column Legend
// ============================================================

const PDF_CONFIG = {
  logoKiri: (window.ASSET_BASE_URL || '/') + 'images/logo-1.png',
  logoKanan: (window.ASSET_BASE_URL || '/') + 'images/logo-2.png',
  sources: [
    "1. Citra Satelit SPOT 6/7 & Peta Dasar Kota Surabaya",
    "2. Data Dinas Lingkungan Hidup (DLH)",
    "3. Data Dinas Perhubungan (Dishub) Surabaya",
    "4. Badan Perencanaan Pembangunan Daerah (BAPPEDA)",
    "5. Badan Pusat Statistik (BPS) Kota Surabaya"
  ],
  layerConfig: {
    'TITIK_SAMPAH': { label: 'Titik Sampah', color: '#facc15', type: 'circle', isBoundary: false },
    'TITIK_SAMPAH_RENCANA': { label: 'Sampah Rencana', color: '#22c55e', type: 'circle', isBoundary: false },
    'TPS3R': { label: 'TPS3R', color: '#10b981', type: 'circle', isBoundary: false },
    'TPS': { label: 'TPS', color: '#f59e0b', type: 'circle', isBoundary: false },
    'RUTE_SAMPAH': { label: 'Rute Pengangkutan Sampah', color: '#a855f7', type: 'line', isBoundary: false },
    'POINT_RUTE_SAMPAH': { label: 'Titik Rute Sampah', color: '#f43f5e', type: 'circle', isBoundary: false },
    'RUKOM': { label: 'Rumah Kompos', color: '#0ea5e9', type: 'circle', isBoundary: false },
    'DEKORASI_KOTA': { label: 'Dekorasi Kota', color: '#fb923c', type: 'circle', isBoundary: false },
    'KEPADATAN_PENDUDUK': { label: 'Kepadatan Penduduk', color: '#ef4444', type: 'polygon', isBoundary: false },
    'KECAMATAN': { label: 'Batas Kecamatan', color: '#6366f1', type: 'line', isBoundary: true },
    'KELURAHAN': { label: 'Batas Kelurahan', color: '#eab308', type: 'line', isBoundary: true },
    'BATAS_RW': { label: 'Batas RW', color: '#14b8a6', type: 'line', isBoundary: true },
    'JARINGAN_JALAN': { label: 'Jaringan Jalan', color: '#f44444', type: 'line', isBoundary: false },
  }
};

const PDF_ZOOM_SCALE_150000 = 12.8;
const HD_SCALE = 4;

// ============================================================
// FIX #2: Helper hitungan marker yang konsisten
// Prioritas: FilterWilayah (jika aktif) → geoJsonStore → layer.getLayers()
// ============================================================
function _getPdfMarkerCount(layerKey) {
    // Jika filter wilayah aktif, gunakan jumlah inside
    if (window.FilterWilayah &&
        typeof window.FilterWilayah.isFilterActive === 'function' &&
        window.FilterWilayah.isFilterActive() &&
        typeof window.FilterWilayah.getInsideCount === 'function') {
        const insideCount = window.FilterWilayah.getInsideCount();
        if (insideCount[layerKey] !== undefined) {
            return insideCount[layerKey];
        }
    }

    // Normal mode: gunakan geoJsonStore (paling akurat)
    if (typeof geoJsonStore !== 'undefined' &&
        geoJsonStore[layerKey] &&
        geoJsonStore[layerKey].features) {
        return geoJsonStore[layerKey].features.length;
    }

    // Fallback: Leaflet layer getLayers
    if (window.mapLayers && window.mapLayers[layerKey] &&
        typeof window.mapLayers[layerKey].getLayers === 'function') {
        return window.mapLayers[layerKey].getLayers().length;
    }

    return 0;
}

function loadImage(src) {
  return new Promise((resolve) => {
    const img = new Image();
    img.crossOrigin = "Anonymous";
    img.src = src;
    img.onload = () => resolve(img);
    img.onerror = () => {
      console.warn("Gagal load image:", src);
      resolve(null);
    };
  });
}

async function captureLocationDiagram(targetBounds) {
  const DIV_W = 340;
  const DIV_H = 240;
  
  // Gunakan center dari bounds area yang diexport, fallback ke pusat Surabaya
  let MARKER_LAT = -7.267;
  let MARKER_LNG = 112.717;
  if (targetBounds && typeof targetBounds.getCenter === 'function') {
      const center = targetBounds.getCenter();
      MARKER_LAT = center.lat;
      MARKER_LNG = center.lng;
  }
  
  const MAP_ZOOM = 10;

  const tempDiv = document.createElement('div');
  tempDiv.style.width = DIV_W + 'px';
  tempDiv.style.height = DIV_H + 'px';
  tempDiv.style.position = 'fixed';
  tempDiv.style.top = '0';
  tempDiv.style.left = '0';
  tempDiv.style.zIndex = '1';
  tempDiv.style.background = '#fff';
  tempDiv.style.pointerEvents = 'none';
  document.body.appendChild(tempDiv);

  try {
    const overviewMap = L.map(tempDiv, {
      zoomControl: false,
      attributionControl: false,
      dragging: false,
      scrollWheelZoom: false,
      doubleClickZoom: false,
      boxZoom: false,
      keyboard: false
    });

    const overviewLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
      attribution: '',
      subdomains: 'abcd',
      maxZoom: 20
    });
    overviewLayer.addTo(overviewMap);
    overviewMap.setView([MARKER_LAT, MARKER_LNG], MAP_ZOOM);

    await new Promise((resolve) => {
      let tilesLoading = 0;
      let tilesLoaded = 0;
      overviewLayer.on('tileloadstart', () => { tilesLoading++; });
      overviewLayer.on('tileload', () => {
        tilesLoaded++;
        if (tilesLoaded >= tilesLoading && tilesLoading > 0) setTimeout(resolve, 500);
      });
      overviewLayer.on('tileerror', () => {
        tilesLoaded++;
        if (tilesLoaded >= tilesLoading && tilesLoading > 0) setTimeout(resolve, 500);
      });
      setTimeout(resolve, 5000);
    });

    // Hitung posisi pixel marker SEBELUM capture, menggunakan Leaflet projection
    // latLngToContainerPoint sudah memperhitungkan tile offset & zoom secara akurat
    const markerContainerPt = overviewMap.latLngToContainerPoint([MARKER_LAT, MARKER_LNG]);

    await new Promise(resolve => setTimeout(resolve, 800));

    let mapDataUrl;
    if (typeof html2canvas !== 'undefined') {
      const canvas = await html2canvas(tempDiv, {
        width: DIV_W, height: DIV_H, scale: 2,
        useCORS: true, allowTaint: true, backgroundColor: '#ffffff'
      });
      mapDataUrl = canvas.toDataURL('image/png');
    } else {
      mapDataUrl = await domtoimage.toPng(tempDiv, {
        width: DIV_W, height: DIV_H, quality: 1.0, cacheBust: true,
        style: { transform: 'scale(1)', transformOrigin: 'top left' }
      });
    }

    overviewMap.remove();
    document.body.removeChild(tempDiv);

    // Gambar titik merah langsung di canvas — BUKAN melalui DOM Leaflet
    // sehingga posisi selalu akurat sesuai konversi lat/lng ke pixel
    const mapImg = await loadImage(mapDataUrl);
    if (!mapImg) return null;

    const outCanvas = document.createElement('canvas');
    const SCALE = 2; // sesuai scale html2canvas / domtoimage
    outCanvas.width  = DIV_W * SCALE;
    outCanvas.height = DIV_H * SCALE;
    const octx = outCanvas.getContext('2d');

    // Gambar tile peta terlebih dahulu
    octx.drawImage(mapImg, 0, 0, outCanvas.width, outCanvas.height);

    // Konversi posisi container point ke koordinat canvas (perkalikan SCALE)
    const cx = markerContainerPt.x * SCALE;
    const cy = markerContainerPt.y * SCALE;
    const r  = 10 * SCALE;

    // Lingkaran merah
    octx.beginPath();
    octx.arc(cx, cy, r, 0, Math.PI * 2);
    octx.fillStyle = '#ef4444';
    octx.globalAlpha = 0.9;
    octx.fill();
    octx.globalAlpha = 1.0;
    octx.strokeStyle = '#000000';
    octx.lineWidth = 2 * SCALE;
    octx.stroke();

    const finalDataUrl = outCanvas.toDataURL('image/png');
    return await loadImage(finalDataUrl);

  } catch (error) {
    console.error("Error capturing diagram:", error);
    if (document.body.contains(tempDiv)) document.body.removeChild(tempDiv);
    return null;
  }
}

function drawGridAndFrame(ctx, rect, bounds, scale = 1) {
  const latInterval = 0.025;
  const lngInterval = 0.025;
  const south = bounds.getSouth();
  const north = bounds.getNorth();
  const west = bounds.getWest();
  const east = bounds.getEast();
  
  ctx.save();
  ctx.beginPath();
  ctx.rect(rect.x, rect.y, rect.width, rect.height);
  ctx.clip();
  
  ctx.strokeStyle = '#d1d5db';
  ctx.lineWidth = 0.3 * scale;
  ctx.font = `italic ${7 * scale}px Arial`;
  ctx.fillStyle = '#4b5563';
  
  for (let lng = Math.floor(west/lngInterval)*lngInterval; lng <= Math.ceil(east/lngInterval)*lngInterval; lng += lngInterval) {
    let x = rect.x + ((lng - west) / (east - west)) * rect.width;
    if(x > rect.x && x < rect.x + rect.width){
      ctx.beginPath(); 
      ctx.moveTo(x, rect.y); 
      ctx.lineTo(x, rect.y + rect.height); 
      ctx.stroke();
      ctx.fillText(lng.toFixed(3) + " E", x - 15 * scale, rect.y + 10 * scale);
      ctx.fillText(lng.toFixed(3) + " E", x - 15 * scale, rect.y + rect.height - 4 * scale);
    }
  }
  
  for (let lat = Math.floor(south/latInterval)*latInterval; lat <= Math.ceil(north/latInterval)*latInterval; lat += latInterval) {
    let y = rect.y + ((north - lat) / (north - south)) * rect.height;
    if(y > rect.y && y < rect.y + rect.height){
      ctx.beginPath(); 
      ctx.moveTo(rect.x, y); 
      ctx.lineTo(rect.x + rect.width, y); 
      ctx.stroke();
      ctx.fillText(Math.abs(lat).toFixed(3) + " S", rect.x + 4 * scale, y - 2 * scale);
      ctx.fillText(Math.abs(lat).toFixed(3) + " S", rect.x + rect.width - 38 * scale, y - 2 * scale);
    }
  }
  
  ctx.restore();
  ctx.strokeStyle = '#000000';
  ctx.lineWidth = 1.5 * scale;
  ctx.strokeRect(rect.x, rect.y, rect.width, rect.height);
}

function drawPopulationDensityLegend(ctx, x, y, width, scale = 1, legIndent = null) {
    // Indent untuk header
    const indent = legIndent || (x + 10 * scale);
    // Kotak simbol sejajar dengan indent (tidak menjorok ke kanan)
    const symbolStartX = indent;
    const textStartX = indent + 20 * scale;
    let curY = y;

    ctx.font = `bold ${10 * scale}px Arial`;
    ctx.fillStyle = '#000000';
    ctx.textAlign = 'left';
    ctx.fillText("Kepadatan Penduduk", indent, curY);
    curY += 15 * scale;

    const densityLevels = [
        { label: 'Sangat Padat', range: '> 20.000', color: '#7f1d1d' },
        { label: 'Sangat Padat', range: '15.001 - 20.000', color: '#991b1b' },
        { label: 'Padat Sekali', range: '10.001 - 15.000', color: '#b91c1c' },
        { label: 'Padat', range: '7.501 - 10.000', color: '#dc2626' },
        { label: 'Padat', range: '5.001 - 7.500', color: '#ef4444' },
        { label: 'Sedang', range: '3.001 - 5.000', color: '#f87171' },
        { label: 'Sedang', range: '2.001 - 3.000', color: '#fca5a5' },
        { label: 'Jarang', range: '1.001 - 2.000', color: '#fecaca' },
        { label: 'Jarang', range: '501 - 1.000', color: '#fee2e2' },
        { label: 'Sangat Jarang', range: '< 500', color: '#fef2f2' }
    ];

    const boxHeight = 10 * scale;
    const boxWidth = 12 * scale;

    densityLevels.forEach((level) => {
        ctx.fillStyle = level.color;
        ctx.fillRect(symbolStartX, curY - 6 * scale, boxWidth, boxHeight);
        ctx.strokeStyle = '#000000';
        ctx.lineWidth = 0.5 * scale;
        ctx.strokeRect(symbolStartX, curY - 6 * scale, boxWidth, boxHeight);
        ctx.fillStyle = '#000000';
        ctx.font = `${8.5 * scale}px Arial`;
        ctx.textAlign = 'left';
        ctx.fillText(level.label + ' (' + level.range + ' jiwa/km²)', textStartX, curY + 3 * scale);
        curY += 15 * scale;
    });

    ctx.fillStyle = '#64748b';
    ctx.font = `italic ${7 * scale}px Arial`;
    ctx.textAlign = 'left';
    ctx.fillText("* Sumber: Data BPS Kota Surabaya", textStartX, curY);

    return curY + 5 * scale;
}

// ============================================================
// FIX #4: drawSidebar - Legenda dengan Multi-Kolom
// ============================================================
function drawSidebar(ctx, x, y, w, h, logos, bounds, pixelHeight, diagramImage, scale = 1) {
  const centerX = x + (w / 2);
  let curY = y + 20 * scale;
  
  // A. LOGO & HEADER
  if (logos.kiri) ctx.drawImage(logos.kiri, x + 20 * scale, curY, 55 * scale, 65 * scale);
  if (logos.kanan) ctx.drawImage(logos.kanan, x + w - 75 * scale, curY, 55 * scale, 65 * scale);
  
  ctx.fillStyle = '#000000';
  ctx.textAlign = 'center';
  ctx.font = `bold ${12 * scale}px Arial`;
  ctx.fillText("PEMERINTAH KOTA SURABAYA", centerX, curY + 18 * scale);
  ctx.font = `bold ${10 * scale}px Arial`;
  ctx.fillText("BADAN PERENCANAAN PEMBANGUNAN DAERAH,", centerX, curY + 34 * scale);
  ctx.fillText("PENELITIAN, DAN PENGEMBANGAN", centerX, curY + 48 * scale);
  curY += 78 * scale;
  
  ctx.beginPath();
  ctx.moveTo(x + 15 * scale, curY);
  ctx.lineTo(x + w - 15 * scale, curY);
  ctx.lineWidth = 1.5 * scale;
  ctx.stroke();
  curY += 25 * scale;
  
  // B. JUDUL PETA - satu baris nyambung: PETA KELENGKAPAN [DATA] KOTA SURABAYA
  ctx.fillStyle = '#000000';
  ctx.textAlign = 'center';
  ctx.font = `bold ${14 * scale}px Arial`;

  const activeLayerNames = [];
  document.querySelectorAll('.layer-toggle:checked').forEach(cb => {
    const key = cb.getAttribute('data-layer');
    const cfg = PDF_CONFIG.layerConfig[key] || layerConfig[key];
    if (cfg && !cfg.isBoundary && key !== 'KEPADATAN_PENDUDUK') {
      activeLayerNames.push(cfg.label.toUpperCase());
    }
  });

  const maxTextWidth = w - 30 * scale;

  function wrapText(text, maxWidth) {
    const words = text.split(' ');
    const lines = [];
    let current = '';
    words.forEach((word) => {
      const test = current ? current + ' ' + word : word;
      if (ctx.measureText(test).width > maxWidth && current) {
        lines.push(current);
        current = word;
      } else {
        current = test;
      }
    });
    if (current) lines.push(current);
    return lines;
  }

  // Gabung jadi satu string judul penuh tanpa spasi antar bagian
  let dataPart = '';
  if (activeLayerNames.length === 1) {
    dataPart = activeLayerNames[0];
  } else if (activeLayerNames.length === 2) {
    dataPart = activeLayerNames[0] + ' DAN ' + activeLayerNames[1];
  } else if (activeLayerNames.length > 2) {
    const allButLast = activeLayerNames.slice(0, -1).join(', ');
    dataPart = allButLast + ', DAN ' + activeLayerNames[activeLayerNames.length - 1];
  }
  const fullTitle = dataPart
    ? `PETA KELENGKAPAN ${dataPart} KOTA SURABAYA`
    : 'PETA KELENGKAPAN KOTA SURABAYA';

  const titleLines = wrapText(fullTitle, maxTextWidth);
  const lineH = 18 * scale;
  titleLines.forEach(line => {
    ctx.fillText(line, centerX, curY);
    curY += lineH;
  });
  curY += 4 * scale;

  ctx.beginPath();
  ctx.moveTo(x + 15 * scale, curY);
  ctx.lineTo(x + w - 15 * scale, curY);
  ctx.lineWidth = 1 * scale;
  ctx.strokeStyle = '#000000';
  ctx.stroke();
  curY += 20 * scale;
  
  // F. ARAH MATA ANGIN
  ctx.fillStyle = 'black';
  ctx.textAlign = 'center';
  ctx.font = `bold ${16 * scale}px Arial`;
  ctx.fillText("U", centerX, curY);
  ctx.beginPath();
  ctx.moveTo(centerX, curY + 5 * scale);
  ctx.lineTo(centerX - 6 * scale, curY + 32 * scale);
  ctx.lineTo(centerX, curY + 28 * scale);
  ctx.lineTo(centerX + 6 * scale, curY + 32 * scale);
  ctx.fill();
  curY += 45 * scale;
  
  // C. SKALA PETA
  ctx.textAlign = 'center';
  ctx.font = `bold ${11 * scale}px Arial`;
  ctx.fillStyle = '#000000';
  ctx.fillText("SKALA : 1 : 50.000", centerX, curY);
  curY += 14 * scale;
  
  const scaleBarTotalKm = 5;
  const scaleBarSegments = 4;
  const scaleBarWidth = 200 * scale;
  const segmentWidth = scaleBarWidth / scaleBarSegments;
  const barHeight = 6 * scale;
  const barX = centerX - (scaleBarWidth / 2);
  const barY = curY;
  
  ctx.strokeStyle = '#000000';
  ctx.lineWidth = 1 * scale;
  for (let i = 0; i < scaleBarSegments; i++) {
    const segX = barX + i * segmentWidth;
    if (i === 0 || i === 2) ctx.fillStyle = '#000000';
    else ctx.fillStyle = '#ffffff';
    ctx.fillRect(segX, barY, segmentWidth, barHeight);
    ctx.strokeRect(segX, barY, segmentWidth, barHeight);
  }
  ctx.strokeRect(barX, barY, scaleBarWidth, barHeight);
  
  ctx.font = `${9 * scale}px Arial`;
  ctx.fillStyle = '#000000';
  const labels = ['0', '1.25', '2.5', '5 Km'];
  const labelPositions = [0, 0.25, 0.5, 1];
  labels.forEach(function (label, i) {
    const lx = barX + labelPositions[i] * scaleBarWidth;
    if (i === 0) ctx.textAlign = 'left';
    else if (i === labels.length - 1) ctx.textAlign = 'right';
    else ctx.textAlign = 'center';
    ctx.fillText(label, lx, barY + barHeight + 14 * scale);
  });
  ctx.textAlign = 'center';
  curY += 36 * scale;
  
  ctx.beginPath();
  ctx.moveTo(x + 15 * scale, curY);
  ctx.lineTo(x + w - 15 * scale, curY);
  ctx.lineWidth = 1 * scale;
  ctx.stroke();
  curY += 20 * scale;
  
  // D. INFORMASI TEKNIS
  ctx.textAlign = 'left';
  ctx.font = `${9 * scale}px Arial`;
  ctx.fillStyle = '#000000';
  const leftPadding = x + 20 * scale;
  
  ctx.fillText("Proyeksi", leftPadding, curY);
  ctx.fillText(": Universal Transverse Mercator", leftPadding + 110 * scale, curY);
  curY += 14 * scale;
  ctx.fillText("Sistem Grid", leftPadding, curY);
  ctx.fillText(": Grid Geografis dan Grid UTM Zona 49 S", leftPadding + 110 * scale, curY);
  curY += 14 * scale;
  ctx.fillText("Datum Horizontal", leftPadding, curY);
  ctx.fillText(": Datum WGS 1984", leftPadding + 110 * scale, curY);
  curY += 14 * scale;
  ctx.fillText("Datum Vertikal", leftPadding, curY);
  ctx.fillText(": Geoid EGM 2008", leftPadding + 110 * scale, curY);
  curY += 25 * scale;
  
  ctx.beginPath();
  ctx.moveTo(x + 15 * scale, curY);
  ctx.lineTo(x + w - 15 * scale, curY);
  ctx.lineWidth = 1 * scale;
  ctx.stroke();
  curY += 20 * scale;
  
  // E. DIAGRAM LOKASI
  ctx.textAlign = 'center';
  ctx.font = `bold ${10 * scale}px Arial`;
  ctx.fillText("DIAGRAM LOKASI", centerX, curY);
  curY += 8 * scale;
  
  const diagramX = centerX - 85 * scale;
  const diagramY = curY;
  const diagramW = 170 * scale;
  const diagramH = 120 * scale;
  
  if (diagramImage && diagramImage.complete) {
    ctx.save();
    ctx.drawImage(diagramImage, diagramX, diagramY, diagramW, diagramH);
    ctx.restore();
    ctx.strokeStyle = '#000000';
    ctx.lineWidth = 2 * scale;
    ctx.strokeRect(diagramX, diagramY, diagramW, diagramH);
  } else {
    ctx.fillStyle = '#dbeafe';
    ctx.fillRect(diagramX, diagramY, diagramW, diagramH);
    ctx.strokeStyle = '#000000';
    ctx.lineWidth = 1.5 * scale;
    ctx.strokeRect(diagramX, diagramY, diagramW, diagramH);
    ctx.font = `${9 * scale}px Arial`;
    ctx.fillStyle = '#64748b';
    ctx.fillText("Diagram tidak tersedia", centerX, diagramY + diagramH / 2);
  }
  
  curY = diagramY + diagramH + 20 * scale;
  
  // G. KETERANGAN/LEGENDA dengan MULTI-KOLOM
  const legLeft   = x + 20 * scale;
  const legIndent = x + 30 * scale;
  
  // Konfigurasi kolom
  const COL_1_X = x + 15 * scale;          // Kolom kiri (lebih ke pinggir)
  const COL_2_X = x + w/2 + 5 * scale;    // Kolom kanan (mulai dari tengah+sedikit)
  const MAX_HEIGHT_PER_COL = 370 * scale;  // Tinggi maksimal per kolom sebelum pindah ke kanan
  
  const LEG_SYMBOL_W  = 16 * scale;        // lebar area simbol garis
  const LEG_ROW_H     = 17 * scale;        // tinggi tiap baris legenda (sedikit lebih lebar)
  const LEG_SYMBOL_R  = 5 * scale;         // radius simbol bulat

  ctx.textAlign = 'left';
  ctx.fillStyle = 'black';
  ctx.font = `bold ${11 * scale}px Arial`;
  ctx.fillText("KETERANGAN :", legLeft, curY);
  curY += 20 * scale;
  
  const keteranganStartY = curY;
  
  const activeCheckboxes = document.querySelectorAll('.layer-toggle:checked');
  
  let hasKepadatanPenduduk = false;
  activeCheckboxes.forEach(checkbox => {
    if (checkbox.getAttribute('data-layer') === 'KEPADATAN_PENDUDUK') {
      hasKepadatanPenduduk = true;
    }
  });
  
  if (activeCheckboxes.length > 0) {
    // Variabel untuk tracking kolom
    let currentColX = COL_1_X;
    let currentY = keteranganStartY;
    let isSecondColumn = false;
    
    // Fungsi helper untuk cek apakah perlu pindah kolom
    function checkColumnSwitch(requiredHeight) {
      if (!isSecondColumn && (currentY - keteranganStartY + requiredHeight) > MAX_HEIGHT_PER_COL) {
        currentColX = COL_2_X;
        currentY = keteranganStartY;
        isSecondColumn = true;
      }
    }
    
    // Fungsi helper untuk mendapatkan posisi simbol dan teks berdasarkan kolom
    function getColumnPositions() {
      const legIndentCol = currentColX + 10 * scale;
      const legSymbolCX = currentColX + 20 * scale;
      const legTextX = currentColX + 34 * scale;
      return { legIndentCol, legSymbolCX, legTextX };
    }
    
    // Sub-header: Filter Wilayah (jika aktif)
    const _filterActive = window.FilterWilayah
      && typeof window.FilterWilayah.isFilterActive === 'function'
      && window.FilterWilayah.isFilterActive();
    const _filterLabel = _filterActive
      && typeof window.FilterWilayah.getFilterLabel === 'function'
      ? window.FilterWilayah.getFilterLabel() : null;

    if (_filterActive && _filterLabel) {
      checkColumnSwitch(30 * scale);
      const posF = getColumnPositions();
      ctx.font = `bold ${10 * scale}px Arial`;
      ctx.fillStyle = '#000000';
      ctx.fillText("Filter Wilayah", posF.legIndentCol, currentY);
      currentY += 15 * scale;

      const posF2 = getColumnPositions();
      ctx.font = `${9 * scale}px Arial`;
      ctx.fillStyle = '#000000';
      ctx.fillText(_filterLabel, posF2.legTextX, currentY + 3 * scale);
      currentY += LEG_ROW_H + 4 * scale;
    }

    // Sub-header: Administrasi & Batas Wilayah
    checkColumnSwitch(100 * scale);
    const pos1 = getColumnPositions();
    ctx.font = `bold ${10 * scale}px Arial`;
    ctx.fillStyle = '#000000';
    ctx.fillText("Administrasi & Batas Wilayah", pos1.legIndentCol, currentY);
    currentY += 15 * scale;

    const boundaryItems = [
      { color: '#808080', label: 'Batas Kota',          dash: [4, 2] },
      { color: '#6366f1', label: 'Batas Kecamatan', dash: [4, 2] },
      { color: '#f59e0b', label: 'Batas Kelurahan',  dash: [4, 2] },
      { color: '#14b8a6', label: 'Batas RW',          dash: [4, 2] }
    ];
    boundaryItems.forEach(item => {
      const pos = getColumnPositions();
      ctx.beginPath();
      ctx.strokeStyle = item.color;
      ctx.lineWidth = 2 * scale;
      ctx.setLineDash(item.dash.map(v => v * scale));
      ctx.moveTo(pos.legSymbolCX - LEG_SYMBOL_W / 2, currentY);
      ctx.lineTo(pos.legSymbolCX + LEG_SYMBOL_W / 2, currentY);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.fillStyle = 'black';
      ctx.font = `${9 * scale}px Arial`;
      ctx.fillText(item.label, pos.legTextX, currentY + 3 * scale);
      currentY += LEG_ROW_H;
    });

    currentY += 4 * scale;
    
    // Kepadatan Penduduk (jika aktif)
    if (hasKepadatanPenduduk) {
      checkColumnSwitch(180 * scale);
      const pos = getColumnPositions();
      currentY = drawPopulationDensityLegend(ctx, currentColX, currentY, w/2, scale, pos.legIndentCol);
      currentY += 20 * scale;
    }
    
    // Sub-header: Lokasi & Fasilitas
    checkColumnSwitch(200 * scale);
    
    const pos2 = getColumnPositions();
    ctx.font = `bold ${10 * scale}px Arial`;
    ctx.fillStyle = '#000000';
    ctx.fillText("Lokasi & Fasilitas", pos2.legIndentCol, currentY);
    currentY += 15 * scale;
    
    activeCheckboxes.forEach(checkbox => {
      const layerKey = checkbox.getAttribute('data-layer');
      const config = PDF_CONFIG.layerConfig[layerKey] || layerConfig[layerKey];
      
      if (config && !config.isBoundary && layerKey !== 'KEPADATAN_PENDUDUK') {
        checkColumnSwitch(LEG_ROW_H + 2 * scale);
        const pos = getColumnPositions();

        const markerCount = _getPdfMarkerCount(layerKey);

        const isLine = config.type === 'line' || config.isLine;
        const isPolygon = config.type === 'polygon' || config.isPolygon;

        if (isLine) {
          ctx.beginPath();
          ctx.strokeStyle = config.color;
          ctx.lineWidth = 2.5 * scale;
          ctx.setLineDash([]);
          ctx.moveTo(pos.legSymbolCX - LEG_SYMBOL_W / 2, currentY);
          ctx.lineTo(pos.legSymbolCX + LEG_SYMBOL_W / 2, currentY);
          ctx.stroke();
        } else if (isPolygon) {
          const boxSz = 10 * scale;
          ctx.fillStyle = config.color + '88';
          ctx.fillRect(pos.legSymbolCX - boxSz / 2, currentY - boxSz / 2, boxSz, boxSz);
          ctx.strokeStyle = config.color;
          ctx.lineWidth = 1.5 * scale;
          ctx.setLineDash([]);
          ctx.strokeRect(pos.legSymbolCX - boxSz / 2, currentY - boxSz / 2, boxSz, boxSz);
        } else {
          ctx.beginPath();
          ctx.fillStyle = config.color;
          ctx.arc(pos.legSymbolCX, currentY, LEG_SYMBOL_R, 0, 2 * Math.PI);
          ctx.fill();
          ctx.strokeStyle = '#ffffff';
          ctx.lineWidth = 1 * scale;
          ctx.stroke();
          ctx.beginPath();
          ctx.strokeStyle = config.color + 'aa';
          ctx.lineWidth = 0.5 * scale;
          ctx.arc(pos.legSymbolCX, currentY, LEG_SYMBOL_R + 1.5 * scale, 0, 2 * Math.PI);
          ctx.stroke();
        }
        
        ctx.fillStyle = 'black';
        ctx.font = `${9 * scale}px Arial`;
        ctx.textAlign = 'left';
        ctx.fillText(config.label, pos.legTextX, currentY + 3 * scale);

        const countStr = '(' + markerCount + ')';
        const labelWidth = ctx.measureText(config.label).width;
        ctx.fillStyle = '#0369a1';
        ctx.font = `bold ${9 * scale}px Arial`;
        ctx.fillText(countStr, pos.legTextX + labelWidth + 4 * scale, currentY + 3 * scale);
        ctx.font = `${9 * scale}px Arial`;

        currentY += LEG_ROW_H;
      }
    });
    
    currentY += 8 * scale;
    
    // Heatmap layer (dalam multi-kolom) - menggunakan warna & nilai aktual dari analisis
    if (mapLayers['HEATMAP_LAYER'] && map.hasLayer(mapLayers['HEATMAP_LAYER'])) {
      const meta = window._heatmapMeta;
      
      // Tinggi total: header + bar gradien + label + 5 step + min/max = ~110px
      checkColumnSwitch(115 * scale);
      const posHm = getColumnPositions();

      ctx.font = `bold ${10 * scale}px Arial`;
      ctx.fillStyle = '#000000';
      ctx.fillText("Analisis Heatmap", posHm.legIndentCol, currentY);
      currentY += 14 * scale;

      if (meta && meta.steps && meta.steps.length > 0) {
        // ── Gradien bar horizontal (lebar penuh kolom dikurangi padding) ──
        const barX      = posHm.legSymbolCX - LEG_SYMBOL_W / 2;
        const barWidth  = 110 * scale;
        const barHeight = 10 * scale;
        const barY      = currentY - 6 * scale;

        // Buat gradien kiri (tinggi/gelap) → kanan (rendah/terang)
        const grad = ctx.createLinearGradient(barX, 0, barX + barWidth, 0);
        // Warna paling terang (minCount) di kiri, paling gelap (maxCount) di kanan
        const colorAtMin = meta.getColor(meta.minCount); // rgb terang
        const colorAtMax = meta.getColor(meta.maxCount); // rgb gelap
        grad.addColorStop(0, colorAtMin);
        grad.addColorStop(1, colorAtMax);

        ctx.fillStyle = grad;
        ctx.fillRect(barX, barY, barWidth, barHeight);
        ctx.strokeStyle = '#555';
        ctx.lineWidth = 0.5 * scale;
        ctx.strokeRect(barX, barY, barWidth, barHeight);

        // Label bawah bar: nilai min & max
        ctx.fillStyle = '#000000';
        ctx.font = `${8 * scale}px Arial`;
        ctx.textAlign = 'left';
        ctx.fillText(`${meta.minCount} titik`, barX, currentY + 8 * scale);
        ctx.textAlign = 'right';
        ctx.fillText(`${meta.maxCount} titik`, barX + barWidth, currentY + 8 * scale);
        ctx.textAlign = 'left';
        currentY += 18 * scale;

        // ── 5 baris step warna + label ──
        meta.steps.forEach(step => {
          checkColumnSwitch(LEG_ROW_H);
          const posH = getColumnPositions();
          const boxSz = 10 * scale;

          // Kotak warna — gunakan warna aktual dari getColor()
          ctx.fillStyle = step.color;
          ctx.fillRect(posH.legSymbolCX - boxSz / 2, currentY - boxSz / 2, boxSz, boxSz);
          ctx.strokeStyle = '#555';
          ctx.lineWidth = 0.5 * scale;
          ctx.strokeRect(posH.legSymbolCX - boxSz / 2, currentY - boxSz / 2, boxSz, boxSz);

          // Teks: "Sangat Tinggi (42 titik)"
          ctx.fillStyle = 'black';
          ctx.font = `${9 * scale}px Arial`;
          ctx.textAlign = 'left';
          ctx.fillText(`${step.label} (${step.count} titik)`, posH.legTextX, currentY + 3 * scale);
          currentY += LEG_ROW_H;
        });

      } else {
        // Fallback jika meta belum tersedia
        const fallbackItems = [
          { color: 'rgb(128,0,0)',   label: 'Sangat Tinggi' },
          { color: 'rgb(192,64,64)', label: 'Tinggi' },
          { color: 'rgb(224,112,112)', label: 'Sedang' },
          { color: 'rgb(240,176,176)', label: 'Rendah' },
          { color: 'rgb(255,224,224)', label: 'Sangat Rendah' }
        ];
        fallbackItems.forEach(item => {
          checkColumnSwitch(LEG_ROW_H);
          const posH = getColumnPositions();
          const boxSz = 10 * scale;
          ctx.fillStyle = item.color;
          ctx.fillRect(posH.legSymbolCX - boxSz / 2, currentY - boxSz / 2, boxSz, boxSz);
          ctx.strokeStyle = '#555';
          ctx.lineWidth = 0.5 * scale;
          ctx.strokeRect(posH.legSymbolCX - boxSz / 2, currentY - boxSz / 2, boxSz, boxSz);
          ctx.fillStyle = 'black';
          ctx.font = `${9 * scale}px Arial`;
          ctx.fillText(item.label, posH.legTextX, currentY + 3 * scale);
          currentY += LEG_ROW_H;
        });
      }
      currentY += 6 * scale;
    }
    
    // Analisis clustering (dalam multi-kolom)
    if (mapLayers['ANALYSIS_RESULT'] && map.hasLayer(mapLayers['ANALYSIS_RESULT'])) {
      checkColumnSwitch(80 * scale);
      const posAn = getColumnPositions();
      ctx.font = `bold ${10 * scale}px Arial`;
      ctx.fillStyle = '#000000';
      ctx.fillText("Hasil Analisis Prioritas", posAn.legIndentCol, currentY);
      currentY += 15 * scale;
      
      const analysisItems = [
        { color: '#ffd700', label: 'Prioritas Utama (Ranking 1)', r: 6 },
        { color: '#c0c0c0', label: 'Prioritas Menengah (Ranking 2)', r: 5 },
        { color: '#cd7f32', label: 'Prioritas Rendah (Ranking 3)', r: 5 }
      ];
      analysisItems.forEach(item => {
        checkColumnSwitch(LEG_ROW_H);
        const posA = getColumnPositions();
        ctx.beginPath();
        ctx.fillStyle = item.color;
        ctx.arc(posA.legSymbolCX, currentY, item.r * scale, 0, 2 * Math.PI);
        ctx.fill();
        ctx.strokeStyle = '#000';
        ctx.lineWidth = 1 * scale;
        ctx.stroke();
        ctx.fillStyle = 'black';
        ctx.font = `${9 * scale}px Arial`;
        ctx.fillText(item.label, posA.legTextX, currentY + 3 * scale);
        currentY += LEG_ROW_H;
      });
      currentY += 6 * scale;
    }
    
    // Fitur Alam & Perairan (dalam multi-kolom)
    checkColumnSwitch(50 * scale);
    const posNat = getColumnPositions();
    ctx.font = `bold ${10 * scale}px Arial`;
    ctx.fillStyle = '#000000';
    ctx.fillText("Fitur Alam & Perairan", posNat.legIndentCol, currentY);
    currentY += 15 * scale;
    {
      const boxSz = 10 * scale;
      ctx.fillStyle = '#93c5fd';
      ctx.fillRect(posNat.legSymbolCX - boxSz / 2, currentY - boxSz / 2, boxSz, boxSz);
      ctx.strokeStyle = '#000';
      ctx.lineWidth = 0.5 * scale;
      ctx.strokeRect(posNat.legSymbolCX - boxSz / 2, currentY - boxSz / 2, boxSz, boxSz);
      ctx.fillStyle = 'black';
      ctx.font = `${9 * scale}px Arial`;
      ctx.fillText("Badan Air / Sungai", posNat.legTextX, currentY + 3 * scale);
      currentY += LEG_ROW_H;
    }
    
    // Update curY untuk section berikutnya
    curY = Math.max(currentY, keteranganStartY + 50 * scale);
  }
  
  // (Heatmap, Analisis, Fitur Alam sudah dimasukkan ke dalam blok multi-kolom di atas)
  
  // H. SUMBER DATA
  const srcLineHeight = 12 * scale;
  const srcHeaderHeight = 14 * scale;
  const totalSrcHeight = (PDF_CONFIG.sources.length * srcLineHeight) + srcHeaderHeight;
  const bottomMargin = 25 * scale;
  curY = (y + h) - totalSrcHeight - bottomMargin;
  
  ctx.beginPath();
  ctx.moveTo(x + 15 * scale, curY - 10 * scale);
  ctx.lineTo(x + w - 15 * scale, curY - 10 * scale);
  ctx.lineWidth = 1 * scale;
  ctx.strokeStyle = '#000000';
  ctx.stroke();
  
  ctx.textAlign = 'left';
  ctx.fillStyle = 'black';
  ctx.font = `bold ${10 * scale}px Arial`;
  ctx.fillText("SUMBER DATA :", x + 20 * scale, curY);
  curY += srcHeaderHeight;
  
  ctx.font = `${8 * scale}px Arial`;
  PDF_CONFIG.sources.forEach(src => {
    ctx.fillText(src, x + 20 * scale, curY);
    curY += srcLineHeight;
  });
}

window.printMap = async function() {
  const loadingOverlay = document.getElementById('pdf-overlay');
  const mapDiv = document.getElementById('map');

  function updateProgress(percent, mainText, subText, stepIndex) {
    const bar = document.getElementById('pdf-progress-bar');
    const txt = document.getElementById('pdf-loading-text');
    const sub = document.getElementById('pdf-loading-sub');
    if (bar) bar.style.width = percent + '%';
    if (txt) { txt.style.opacity = '0'; setTimeout(() => { txt.innerText = mainText; txt.style.opacity = '1'; }, 150); }
    if (sub && subText !== undefined) sub.innerText = subText;
    for (let i = 1; i <= 4; i++) {
      const dot = document.getElementById('pdf-step-' + i);
      if (!dot) continue;
      if (i < stepIndex) { dot.style.background = '#1e3a8a'; dot.style.width = '5px'; dot.style.height = '5px'; }
      else if (i === stepIndex) { dot.style.background = '#1e3a8a'; dot.style.width = '7px'; dot.style.height = '7px'; }
      else { dot.style.background = '#e2e8f0'; dot.style.width = '5px'; dot.style.height = '5px'; }
    }
  }
  
  if (!window.map || typeof window.map.invalidateSize !== 'function') {
    alert("Error: Peta belum siap.");
    return;
  }
  
  const baseWidth = 1754;
  const baseHeight = 1240;
  const baseMargin = 40;
  const baseSidebarWidth = 400;
  
  const width = baseWidth * HD_SCALE;
  const height = baseHeight * HD_SCALE;
  const margin = baseMargin * HD_SCALE;
  const sidebarWidth = baseSidebarWidth * HD_SCALE;
  
  const originalView = map.getCenter();
  const originalZoom = map.getZoom();
  const originalStyle = {
    width: mapDiv.style.width,
    height: mapDiv.style.height,
    position: mapDiv.style.position,
    zIndex: mapDiv.style.zIndex,
    top: mapDiv.style.top,
    left: mapDiv.style.left
  };
  
  const originalWeights = [];
  
  const restoreMapState = () => {
    try {
      // Kembalikan ketebalan garis asli dari semua layer
      originalWeights.forEach(({ layer, weight }) => {
        if (layer && typeof layer.setStyle === 'function') {
          layer.setStyle({ weight: weight });
        }
      });
      
      mapDiv.style.width = originalStyle.width;
      mapDiv.style.height = originalStyle.height;
      mapDiv.style.position = originalStyle.position;
      mapDiv.style.top = originalStyle.top;
      mapDiv.style.left = originalStyle.left;
      mapDiv.style.zIndex = originalStyle.zIndex;
      if (window.map) {
        window.map.invalidateSize();
        window.map.setView(originalView, originalZoom);
      }
    } catch (e) {
      console.error("Error saat restore map:", e);
    }
  };
  
  try {
    if (loadingOverlay) {
      loadingOverlay.style.display = 'flex';
      updateProgress(10, "Mempersiapkan aset dokumen...", "Memuat logo dan konfigurasi", 1);
    }
    
    const [logo1, logo2] = await Promise.all([
      loadImage(PDF_CONFIG.logoKiri),
      loadImage(PDF_CONFIG.logoKanan)
    ]);
    
    if (loadingOverlay) {
      updateProgress(25, "Membuat diagram lokasi peta...", "Merender peta mini Jawa Timur", 2);
    }
    
    const currentBounds = map.getBounds();
    const diagramImage = await captureLocationDiagram(currentBounds);
    
    const mapAreaWidth = width - sidebarWidth - (margin * 2);
    const mapAreaHeight = height - (margin * 2);

    // Div dikembalikan ke ukuran CSS normal agar zoom peta tidak berubah
    mapDiv.style.width    = (mapAreaWidth / HD_SCALE) + 'px';
    mapDiv.style.height   = (mapAreaHeight / HD_SCALE) + 'px';
    mapDiv.style.position = 'relative';
    mapDiv.style.zIndex   = '1';
    window.map.invalidateSize();

    const SURABAYA_CENTER = [-7.2575, 112.7200];
    
    // Zoom ke kecamatan/kelurahan jika filter aktif
    if (window.FilterWilayah && window.FilterWilayah.isFilterActive()) {
        const activeFeature = window.FilterWilayah.getActiveFeature();
        if (activeFeature && typeof turf !== 'undefined') {
            try {
                const bbox = turf.bbox(activeFeature);
                window.map.fitBounds([[bbox[1], bbox[0]], [bbox[3], bbox[2]]], { animate: false, padding: [50, 50] });
            } catch (e) {
                console.warn("Gagal set bounds dari filter wilayah:", e);
                window.map.setView(SURABAYA_CENTER, PDF_ZOOM_SCALE_150000, { animate: false });
            }
        } else {
            window.map.setView(SURABAYA_CENTER, PDF_ZOOM_SCALE_150000, { animate: false });
        }
    } else {
        window.map.setView(SURABAYA_CENTER, PDF_ZOOM_SCALE_150000, { animate: false });
    }

    // Set ketebalan garis lebih tipis untuk export PDF agar tidak terlalu tebal pada resolusi tinggi
    if (window.map) {
        window.map.eachLayer(layer => {
            if (layer instanceof L.Path && typeof layer.setStyle === 'function' && layer.options && layer.options.weight !== undefined) {
                const w = layer.options.weight;
                originalWeights.push({ layer, weight: w });
                
                // Kurangi ketebalan garis secara proporsional (skala 0.35x, minimal 0.4px)
                let newWeight = w * 0.35;
                if (newWeight < 0.4) newWeight = 0.4;
                layer.setStyle({ weight: newWeight });
            }
        });
    }

    if (loadingOverlay) {
      updateProgress(50, "Merender peta dalam resolusi tinggi...", "Memuat tile peta HD", 3);
    }

    // Tunggu tile selesai dimuat
    await new Promise(r => setTimeout(r, 8000));

    let dataUrl;
    try {
      // ── HD CAPTURE: stitch tile canvas Leaflet secara langsung ──────────
      // Cara ini mengambil pixel langsung dari tile <canvas> / <img> yang
      // sudah dimuat browser — tidak melalui DOM serialization domtoimage —
      // sehingga hasilnya tajam tanpa blur.
      const mapW = Math.round(mapAreaWidth / HD_SCALE);
      const mapH = Math.round(mapAreaHeight / HD_SCALE);

      // 1. Buat canvas output berukuran HD penuh
      const hdCanvas = document.createElement('canvas');
      hdCanvas.width  = mapAreaWidth;   // ukuran HD fisik
      hdCanvas.height = mapAreaHeight;
      const hdCtx = hdCanvas.getContext('2d');
      hdCtx.imageSmoothingEnabled = true;
      hdCtx.imageSmoothingQuality = 'high';

      // 2. Kumpulkan semua tile yang ada di mapDiv (img & canvas)
      const tileContainer = mapDiv.querySelector('.leaflet-tile-pane');
      const tileImgs = tileContainer
        ? tileContainer.querySelectorAll('img.leaflet-tile, canvas.leaflet-tile')
        : mapDiv.querySelectorAll('img.leaflet-tile, canvas.leaflet-tile');

      // 3. Ambil offset transform pane (Leaflet menerapkan CSS transform ke pane)
      function getPaneOffset(el) {
        let tx = 0, ty = 0;
        let node = el;
        while (node && node !== mapDiv) {
          const st = window.getComputedStyle(node);
          const tr = st.transform || st.webkitTransform || '';
          if (tr && tr !== 'none') {
            const m = tr.match(/matrix\(([^)]+)\)/);
            if (m) {
              const parts = m[1].split(',').map(Number);
              tx += parts[4] || 0;
              ty += parts[5] || 0;
            }
          }
          node = node.parentElement;
        }
        return { tx, ty };
      }

      // 4. Gambar setiap tile ke hdCanvas dengan scaling HD_SCALE
      // Baca posisi dari style.left/top tile + CSS transform pane (akurat)
      function getPaneTranslate(pane) {
        if (!pane) return { x: 0, y: 0 };
        const tr = pane.style.transform || pane.style.webkitTransform || '';
        const m = tr.match(/translate3d\(([^,]+)px,\s*([^,]+)px/) ||
                  tr.match(/translate\(([^,]+)px,\s*([^,]+)px/);
        return m ? { x: parseFloat(m[1]), y: parseFloat(m[2]) } : { x: 0, y: 0 };
      }

      const tilePaneOffset = getPaneTranslate(tileContainer);

      const drawPromises = Array.from(tileImgs).map(tile => {
        return new Promise(resolve => {
          // Posisi tile dalam CSS px, relatif terhadap tile pane
          const tileX = parseFloat(tile.style.left  || 0) + tilePaneOffset.x;
          const tileY = parseFloat(tile.style.top   || 0) + tilePaneOffset.y;
          const tileW = parseFloat(tile.style.width || tile.width  || 256);
          const tileH = parseFloat(tile.style.height|| tile.height || 256);

          const dstX = tileX * HD_SCALE;
          const dstY = tileY * HD_SCALE;
          const dstW = tileW * HD_SCALE;
          const dstH = tileH * HD_SCALE;

          if (tile.tagName === 'CANVAS') {
            hdCtx.drawImage(tile, dstX, dstY, dstW, dstH);
            resolve();
          } else {
            if (tile.complete && tile.naturalWidth > 0) {
              hdCtx.drawImage(tile, dstX, dstY, dstW, dstH);
              resolve();
            } else {
              tile.onload  = () => { hdCtx.drawImage(tile, dstX, dstY, dstW, dstH); resolve(); };
              tile.onerror = () => resolve();
            }
          }
        });
      });
      await Promise.all(drawPromises);

      // 5. Gambar layer SVG (marker, polyline, polygon) di atas tile
      const svgEls = mapDiv.querySelectorAll('.leaflet-overlay-pane svg, .leaflet-marker-pane');
      for (const svgEl of svgEls) {
        try {
          const svgDataUrl = await domtoimage.toPng(svgEl, {
            width: mapW, height: mapH,
            pixelRatio: HD_SCALE,
            cacheBust: true,
            style: { overflow: 'visible' }
          });
          const svgImg = await loadImage(svgDataUrl);
          if (svgImg) hdCtx.drawImage(svgImg, 0, 0, mapAreaWidth, mapAreaHeight);
        } catch (_) { /* skip jika gagal */ }
      }

      dataUrl = hdCanvas.toDataURL('image/png', 1.0);

    } catch (captureError) {
      console.error("Error saat capture peta HD, fallback ke domtoimage:", captureError);
      // Fallback ke domtoimage jika canvas stitching gagal
      try {
        dataUrl = await domtoimage.toPng(mapDiv, {
          width: mapAreaWidth / HD_SCALE,
          height: mapAreaHeight / HD_SCALE,
          quality: 1.0,
          pixelRatio: HD_SCALE,
          cacheBust: true,
          filter: function (node) {
            if (node.classList && (
              node.classList.contains('leaflet-control-container') ||
              node.classList.contains('leaflet-control')
            )) return false;
            return true;
          }
        });
      } catch (fallbackError) {
        throw new Error("Gagal mengcapture peta: " + fallbackError.message);
      }
    }
    
    const mapImage = await loadImage(dataUrl);
    if (!mapImage) throw new Error("Gambar peta gagal dimuat");
    
    restoreMapState();
    
    const canvas = document.createElement('canvas');
    canvas.width = width;
    canvas.height = height;
    const ctx = canvas.getContext('2d');
    
    ctx.imageSmoothingEnabled = true;
    ctx.imageSmoothingQuality = 'high';
    
    ctx.fillStyle = '#FFFFFF';
    ctx.fillRect(0, 0, width, height);
    
    ctx.strokeStyle = '#000000';
    ctx.lineWidth = 2 * HD_SCALE;
    ctx.strokeRect(margin, margin, width - (margin*2), height - (margin*2));
    
    const mapX = margin;
    const mapY = margin;
    
    if (mapImage && mapImage.complete) {
      ctx.drawImage(mapImage, mapX, mapY, mapAreaWidth, mapAreaHeight);
    } else {
      throw new Error("Gambar peta tidak valid untuk digambar");
    }
    
    if(window.map && window.map.getBounds) {
      drawGridAndFrame(ctx, {
        x: mapX, y: mapY, width: mapAreaWidth, height: mapAreaHeight
      }, window.map.getBounds(), HD_SCALE);
    }
    
    const sidebarX = mapX + mapAreaWidth;
    ctx.beginPath();
    ctx.moveTo(sidebarX, margin);
    ctx.lineTo(sidebarX, height - margin);
    ctx.lineWidth = 1.5 * HD_SCALE;
    ctx.stroke();
    
    if(window.map && window.map.getBounds) {
      drawSidebar(
        ctx, sidebarX, margin, sidebarWidth, height - (margin*2),
        { kiri: logo1, kanan: logo2 },
        window.map.getBounds(),
        mapAreaHeight / HD_SCALE,
        diagramImage,
        HD_SCALE
      );
    }
    
    if (loadingOverlay) {
      updateProgress(85, "Menyusun dokumen PDF...", "Menggabungkan elemen peta, legenda & sidebar", 4);
    }
    
    const pdfData = canvas.toDataURL('image/png', 1.0);
    
    const { jsPDF } = window.jspdf;
    // Buat PDF seukuran canvas HD penuh agar tidak ada downscale/recompress
    const pdf = new jsPDF({
      orientation: 'landscape',
      unit: 'px',
      format: [width, height],
      hotfixes: ['px_scaling'],
      compress: false
    });
    
    // addImage dengan ukuran sama persis canvas → pixel 1:1, tidak ada kompresi ulang
    pdf.addImage(pdfData, 'PNG', 0, 0, width, height, undefined, 'NONE');
    
    const dateStr = new Date().toISOString().slice(0,10);
    pdf.save(`Peta_Surabaya_HD_${dateStr}.pdf`);
    
    if (loadingOverlay) {
      updateProgress(100, "✓ Dokumen PDF berhasil dibuat!", "File sedang diunduh...", 5);
      setTimeout(() => {
        if(loadingOverlay) loadingOverlay.style.display = 'none';
      }, 1500);
    }
    
  } catch (e) {
    console.error("Export PDF Error:", e);
    alert("Gagal Export PDF: " + e.message);
    restoreMapState();  
  } finally {
    setTimeout(() => {
      if (loadingOverlay) loadingOverlay.style.display = 'none';
    }, 2000);
  }
};