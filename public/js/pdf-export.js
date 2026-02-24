// ============================================================
// PDF-EXPORT.JS - Versi HD dengan Legend Kepadatan Penduduk
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
    'CCTV_EKSISTING': { label: 'CCTV Eksisting', color: '#9333ea', type: 'circle', isBoundary: false },
    'TITIK_SAMPAH': { label: 'Titik Sampah', color: '#facc15', type: 'circle', isBoundary: false },
    'CCTV_RENCANA': { label: 'CCTV Rencana', color: '#f97316', type: 'circle', isBoundary: false },
    'TITIK_SAMPAH_RENCANA': { label: 'Sampah Rencana', color: '#22c55e', type: 'circle', isBoundary: false },
    'DAMKAR': { label: 'Pos Damkar', color: '#dc2626', type: 'circle', isBoundary: false },
    'MAKAM': { label: 'Makam', color: '#475569', type: 'circle', isBoundary: false },
    'PAUD': { label: 'PAUD/TK', color: '#ec4899', type: 'circle', isBoundary: false },
    'SD_MI': { label: 'SD/MI', color: '#8b5cf6', type: 'circle', isBoundary: false },
    'SMP_MTS': { label: 'SMP/MTS', color: '#06b6d4', type: 'circle', isBoundary: false },
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
    'AREA_RAYON': { label: 'Area Rayon', color: '#0d9488', type: 'polygon', isBoundary: false },
    'POMPA_AIR_7_RAYON': { label: 'Area Pompa Air 7 Rayon', color: '#0891b2', type: 'polygon', isBoundary: false },
    'JARINGAN_PIPA_SALURAN': { label: 'Jaringan Pipa & Saluran Air', color: '#0284c7', type: 'line', isBoundary: false },
    'TITIK_POMPA_AIR': { label: 'Titik Lokasi Pompa Air', color: '#0369a1', type: 'circle', isBoundary: false },
    'SALURAN_AIR': { label: 'Saluran Air', color: '#0e7490', type: 'circle', isBoundary: false }
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
  const tempDiv = document.createElement('div');
  tempDiv.style.width = '340px';
  tempDiv.style.height = '240px';
  tempDiv.style.position = 'fixed';
  tempDiv.style.top = '0';
  tempDiv.style.left = '0';
  tempDiv.style.zIndex = '99999';
  tempDiv.style.background = '#fff';
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
    overviewMap.setView([-7.5, 112.7], 8);
    
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
    
    L.circleMarker([-7.2575, 112.7400], {
      radius: 10,
      fillColor: '#ef4444',
      color: '#000',
      weight: 2,
      opacity: 1,
      fillOpacity: 0.9
    }).addTo(overviewMap);
    
    await new Promise(resolve => setTimeout(resolve, 1000));
    
    if (typeof html2canvas !== 'undefined') {
      const canvas = await html2canvas(tempDiv, {
        width: 340, height: 240, scale: 2,
        useCORS: true, allowTaint: true, backgroundColor: '#ffffff'
      });
      const dataUrl = canvas.toDataURL('image/png');
      const img = await loadImage(dataUrl);
      overviewMap.remove();
      document.body.removeChild(tempDiv);
      return img;
    } else {
      const dataUrl = await domtoimage.toPng(tempDiv, {
        width: 340, height: 240, quality: 1.0, cacheBust: true,
        style: { transform: 'scale(1)', transformOrigin: 'top left' }
      });
      const img = await loadImage(dataUrl);
      overviewMap.remove();
      document.body.removeChild(tempDiv);
      return img;
    }
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
    const indent = legIndent || (x + 30 * scale);
    const symbolStartX = x + 35 * scale;
    const textStartX = x + 55 * scale;
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
        ctx.font = `${9 * scale}px Arial`;
        ctx.textAlign = 'left';
        ctx.fillText(level.label + ' (' + level.range + ' jiwa/km²)', textStartX, curY + 3 * scale);
        curY += 16 * scale;
    });

    ctx.fillStyle = '#64748b';
    ctx.font = `italic ${7 * scale}px Arial`;
    ctx.textAlign = 'left';
    ctx.fillText("* Sumber: Data BPS Kota Surabaya", textStartX, curY);

    return curY + 5 * scale;
}

// ============================================================
// FIX #3: drawSidebar - Legenda konsisten dengan simbol bulat
// untuk titik dan garis untuk rute/batas
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
  
  // B. JUDUL PETA
  ctx.font = `bold ${14 * scale}px Arial`;
  ctx.fillText("PETA KELENGKAPAN KOTA SURABAYA", centerX, curY);
  curY += 30 * scale;
  
  ctx.beginPath();
  ctx.moveTo(x + 15 * scale, curY);
  ctx.lineTo(x + w - 15 * scale, curY);
  ctx.lineWidth = 1 * scale;
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
  
  // G. KETERANGAN/LEGENDA
  const legLeft   = x + 20 * scale;
  const legIndent = x + 30 * scale;
  // FIX #3: posisi simbol dan teks konsisten untuk semua item
  const LEG_SYMBOL_CX = x + 42 * scale;   // center-x simbol (bulat/garis)
  const LEG_SYMBOL_W  = 14 * scale;        // lebar area simbol garis
  const LEG_TEXT_X    = x + 55 * scale;    // awal teks label (sama untuk semua)
  const LEG_ROW_H     = 16 * scale;        // tinggi tiap baris legenda
  const LEG_SYMBOL_R  = 5 * scale;         // radius simbol bulat

  ctx.textAlign = 'left';
  ctx.fillStyle = 'black';
  ctx.font = `bold ${11 * scale}px Arial`;
  ctx.fillText("KETERANGAN :", legLeft, curY);
  curY += 20 * scale;
  
  const activeCheckboxes = document.querySelectorAll('.layer-toggle:checked');
  
  let hasKepadatanPenduduk = false;
  activeCheckboxes.forEach(checkbox => {
    if (checkbox.getAttribute('data-layer') === 'KEPADATAN_PENDUDUK') {
      hasKepadatanPenduduk = true;
    }
  });
  
  if (activeCheckboxes.length > 0) {
    // Sub-header: Administrasi & Batas Wilayah
    ctx.font = `bold ${10 * scale}px Arial`;
    ctx.fillStyle = '#334155';
    ctx.fillText("Administrasi & Batas Wilayah", legIndent, curY);
    curY += 15 * scale;

    // FIX #3: Garis batas semua pakai pola garis putus-putus dengan posisi KONSISTEN
    const boundaryItems = [
      { color: '#6366f1', label: 'Batas Kecamatan', dash: [4, 2] },
      { color: '#f59e0b', label: 'Batas Kelurahan',  dash: [2, 2] },
      { color: '#14b8a6', label: 'Batas RW',          dash: [4, 2] }
    ];
    boundaryItems.forEach(item => {
      ctx.beginPath();
      ctx.strokeStyle = item.color;
      ctx.lineWidth = 2 * scale;
      ctx.setLineDash(item.dash.map(v => v * scale));
      ctx.moveTo(LEG_SYMBOL_CX - LEG_SYMBOL_W / 2, curY);
      ctx.lineTo(LEG_SYMBOL_CX + LEG_SYMBOL_W / 2, curY);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.fillStyle = 'black';
      ctx.font = `${9 * scale}px Arial`;
      ctx.fillText(item.label, LEG_TEXT_X, curY + 3 * scale);
      curY += LEG_ROW_H;
    });

    curY += 4 * scale;
    
    // Kepadatan Penduduk (jika aktif)
    if (hasKepadatanPenduduk) {
      curY = drawPopulationDensityLegend(ctx, x, curY, w, scale, legIndent);
      curY += 20 * scale;
    }
    
    // Sub-header: Lokasi & Fasilitas
    ctx.font = `bold ${10 * scale}px Arial`;
    ctx.fillStyle = '#334155';
    ctx.fillText("Lokasi & Fasilitas", legIndent, curY);
    curY += 15 * scale;
    
    activeCheckboxes.forEach(checkbox => {
      const layerKey = checkbox.getAttribute('data-layer');
      const config = PDF_CONFIG.layerConfig[layerKey];
      
      if (config && !config.isBoundary && layerKey !== 'KEPADATAN_PENDUDUK') {

        // FIX #2: Gunakan helper yang baca dari geoJsonStore
        const markerCount = _getPdfMarkerCount(layerKey);

        if (config.type === 'line') {
          // Simbol garis (rute)
          ctx.beginPath();
          ctx.strokeStyle = config.color;
          ctx.lineWidth = 2.5 * scale;
          ctx.setLineDash([]);
          ctx.moveTo(LEG_SYMBOL_CX - LEG_SYMBOL_W / 2, curY);
          ctx.lineTo(LEG_SYMBOL_CX + LEG_SYMBOL_W / 2, curY);
          ctx.stroke();
        } else if (config.type === 'polygon') {
          // Simbol kotak untuk polygon/area
          const boxSz = 10 * scale;
          ctx.fillStyle = config.color + '88'; // semi-transparan
          ctx.fillRect(LEG_SYMBOL_CX - boxSz / 2, curY - boxSz / 2, boxSz, boxSz);
          ctx.strokeStyle = config.color;
          ctx.lineWidth = 1.5 * scale;
          ctx.setLineDash([]);
          ctx.strokeRect(LEG_SYMBOL_CX - boxSz / 2, curY - boxSz / 2, boxSz, boxSz);
        } else {
          // FIX #3: Simbol bulat — posisi center konsisten di LEG_SYMBOL_CX
          ctx.beginPath();
          ctx.fillStyle = config.color;
          ctx.arc(LEG_SYMBOL_CX, curY, LEG_SYMBOL_R, 0, 2 * Math.PI);
          ctx.fill();
          ctx.strokeStyle = '#ffffff';
          ctx.lineWidth = 1 * scale;
          ctx.stroke();
          // Ring luar tipis agar terlihat di background putih
          ctx.beginPath();
          ctx.strokeStyle = config.color + 'aa';
          ctx.lineWidth = 0.5 * scale;
          ctx.arc(LEG_SYMBOL_CX, curY, LEG_SYMBOL_R + 1.5 * scale, 0, 2 * Math.PI);
          ctx.stroke();
        }
        
        // FIX #3: Teks label + jumlah, semua mulai di LEG_TEXT_X yang sama
        ctx.fillStyle = 'black';
        ctx.font = `${9 * scale}px Arial`;
        ctx.textAlign = 'left';

        // Tulis label
        ctx.fillText(config.label, LEG_TEXT_X, curY + 3 * scale);

        // FIX #2: Tulis jumlah dengan warna dan posisi konsisten
        const countStr = '(' + markerCount + ')';
        const labelWidth = ctx.measureText(config.label).width;
        ctx.fillStyle = '#0369a1';
        ctx.font = `bold ${9 * scale}px Arial`;
        ctx.fillText(countStr, LEG_TEXT_X + labelWidth + 4 * scale, curY + 3 * scale);
        ctx.font = `${9 * scale}px Arial`;

        curY += LEG_ROW_H;
      }
    });
    
    curY += 8 * scale;
  }
  
  // Heatmap layer
  if (mapLayers['HEATMAP_LAYER'] && map.hasLayer(mapLayers['HEATMAP_LAYER'])) {
    ctx.font = `bold ${10 * scale}px Arial`;
    ctx.fillStyle = '#334155';
    ctx.fillText("Analisis Heatmap", legIndent, curY);
    curY += 15 * scale;
    
    const heatItems = [
      { color: '#7f1d1d', label: 'Jumlah Tempat Banyak' },
      { color: '#f87171', label: 'Jumlah Tempat Sedang' },
      { color: '#fee2e2', label: 'Jumlah Tempat Sedikit' }
    ];
    heatItems.forEach(item => {
      const boxSz = 10 * scale;
      ctx.fillStyle = item.color;
      ctx.fillRect(LEG_SYMBOL_CX - boxSz / 2, curY - boxSz / 2, boxSz, boxSz);
      ctx.strokeStyle = '#000';
      ctx.lineWidth = 0.5 * scale;
      ctx.strokeRect(LEG_SYMBOL_CX - boxSz / 2, curY - boxSz / 2, boxSz, boxSz);
      ctx.fillStyle = 'black';
      ctx.font = `${9 * scale}px Arial`;
      ctx.fillText(item.label, LEG_TEXT_X, curY + 3 * scale);
      curY += LEG_ROW_H;
    });
    curY += 8 * scale;
  }
  
  // Analisis clustering
  if (mapLayers['ANALYSIS_RESULT'] && map.hasLayer(mapLayers['ANALYSIS_RESULT'])) {
    ctx.font = `bold ${10 * scale}px Arial`;
    ctx.fillStyle = '#334155';
    ctx.fillText("Hasil Analisis Prioritas", legIndent, curY);
    curY += 15 * scale;
    
    const analysisItems = [
      { color: '#ffd700', label: 'Prioritas Utama (Ranking 1)', r: 6 },
      { color: '#c0c0c0', label: 'Prioritas Menengah (Ranking 2)', r: 5 },
      { color: '#cd7f32', label: 'Prioritas Rendah (Ranking 3)', r: 5 }
    ];
    analysisItems.forEach(item => {
      ctx.beginPath();
      ctx.fillStyle = item.color;
      ctx.arc(LEG_SYMBOL_CX, curY, item.r * scale, 0, 2 * Math.PI);
      ctx.fill();
      ctx.strokeStyle = '#000';
      ctx.lineWidth = 1 * scale;
      ctx.stroke();
      ctx.fillStyle = 'black';
      ctx.font = `${9 * scale}px Arial`;
      ctx.fillText(item.label, LEG_TEXT_X, curY + 3 * scale);
      curY += LEG_ROW_H;
    });
    curY += 8 * scale;
  }
  
  // Fitur alam
  ctx.font = `bold ${10 * scale}px Arial`;
  ctx.fillStyle = '#334155';
  ctx.fillText("Fitur Alam & Perairan", legIndent, curY);
  curY += 15 * scale;
  
  const boxSz = 10 * scale;
  ctx.fillStyle = '#93c5fd';
  ctx.fillRect(LEG_SYMBOL_CX - boxSz / 2, curY - boxSz / 2, boxSz, boxSz);
  ctx.strokeStyle = '#000';
  ctx.lineWidth = 0.5 * scale;
  ctx.strokeRect(LEG_SYMBOL_CX - boxSz / 2, curY - boxSz / 2, boxSz, boxSz);
  ctx.fillStyle = 'black';
  ctx.font = `${9 * scale}px Arial`;
  ctx.fillText("Badan Air / Sungai", LEG_TEXT_X, curY + 3 * scale);
  curY += 25 * scale;
  
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
  
  const restoreMapState = () => {
    try {
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
    
    mapDiv.style.width = (mapAreaWidth / HD_SCALE) + 'px';
    mapDiv.style.height = (mapAreaHeight / HD_SCALE) + 'px';
    mapDiv.style.position = 'relative';
    mapDiv.style.zIndex = '1';
    window.map.invalidateSize();
    
    const SURABAYA_CENTER = [-7.2575, 112.7200];
    window.map.setView(SURABAYA_CENTER, PDF_ZOOM_SCALE_150000, { animate: false });
    
    if (loadingOverlay) {
      updateProgress(50, "Merender peta dalam resolusi tinggi...", "Memuat tile peta HD", 3);
    }
    
    await new Promise(r => setTimeout(r, 8000));
    
    let dataUrl;
    try {
      await domtoimage.toPng(mapDiv, {
        width: mapAreaWidth / HD_SCALE,
        height: mapAreaHeight / HD_SCALE,
        quality: 1.0,
        pixelRatio: HD_SCALE,
        filter: function (node) {
          if (node.classList && (
            node.classList.contains('leaflet-control-container') ||
            node.classList.contains('leaflet-control')
          )) return false;
          return true;
        }
      });

      await new Promise(r => setTimeout(r, 2000));

      dataUrl = await domtoimage.toPng(mapDiv, {
        width: mapAreaWidth / HD_SCALE,
        height: mapAreaHeight / HD_SCALE,
        quality: 1.0,
        pixelRatio: HD_SCALE,
        cacheBust: true,
        style: {
          transform: 'scale(1)',
          transformOrigin: 'top left',
          imageRendering: 'pixelated'
        },
        filter: function (node) {
          if (node.classList && (
            node.classList.contains('leaflet-control-container') ||
            node.classList.contains('leaflet-control')
          )) return false;
          return true;
        }
      });
    } catch (captureError) {
      console.error("Error saat capture peta:", captureError);
      throw new Error("Gagal mengcapture peta: " + captureError.message);
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
    const pdf = new jsPDF({
      orientation: 'landscape',
      unit: 'px',
      format: [baseWidth, baseHeight],
      compress: false
    });
    
    pdf.addImage(pdfData, 'PNG', 0, 0, baseWidth, baseHeight, undefined, 'FAST');
    
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