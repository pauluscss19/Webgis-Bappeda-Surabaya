// ============================================================
// LAYER-LOADER.JS - LABEL HANYA MUNCUL SAAT CHECKBOX DICENTANG
// Batas RW = Hanya polygon, Label RW = Tampilkan nama
// ============================================================

function getPopulationDensityColor(density) {
    if (density > 20000) return '#7f1d1d';
    if (density > 15000) return '#991b1b';
    if (density > 10000) return '#b91c1c';
    if (density > 7500) return '#dc2626';
    if (density > 5000) return '#ef4444';
    if (density > 2500) return '#f87171';
    if (density > 1000) return '#fca5a5';
    return '#fecaca';
}

function getPopulationDensityLabel(density) {
    if (density > 15000) return 'Sangat Padat';
    if (density > 10000) return 'Padat';
    if (density > 5000) return 'Sedang';
    if (density > 2500) return 'Rendah';
    return 'Sangat Rendah';
}

/**
 * Get nama RW dengan fallback
 */
function getRwName(properties, index) {
    const possibleFields = ['RW', 'NAMA', 'name', 'Name', 'DESA', 'KELURAHAN', 'K'];

    for (const field of possibleFields) {
        if (properties[field]) {
            return properties[field];
        }
    }

    return `RW ${String(index + 1).padStart(2, '0')}`;
}

/**
 * Tambahkan label RW ke polygon
 * PENTING: permanent: false (default tidak muncul)
 */
function addRwLabels(layer, feature, index) {
    if (!feature || !feature.properties) return;

    const rwName = getRwName(feature.properties, index);

    // Bind tooltip tapi JANGAN langsung open
    // Label hanya muncul saat checkbox "Label RW" dicentang
    layer.bindTooltip(rwName, {
        permanent: false,      // ← PENTING: false, tidak otomatis muncul
        direction: 'center',
        className: 'rw-label-text',  // ← Class baru untuk text only
        opacity: 1
    });

    console.log(`   📝 Label "${rwName}" siap (hidden)`);
}

/**
 * Toggle visibility label RW
 */
window.toggleRwLabels = function(show) {
    console.log(`🔄 toggleRwLabels: ${show ? 'SHOW' : 'HIDE'}`);

    if (!mapLayers['BATAS_RW']) {
        console.warn('Layer BATAS_RW tidak ditemukan');
        return;
    }

    let count = 0;
    mapLayers['BATAS_RW'].eachLayer(function(layer) {
        const tooltip = layer.getTooltip();
        if (tooltip) {
            if (show) {
                // Tampilkan label permanent
                tooltip.options.permanent = true;
                layer.openTooltip();
                count++;
            } else {
                // Sembunyikan label
                tooltip.options.permanent = false;
                layer.closeTooltip();
            }
        }
    });

    console.log(`✅ ${show ? 'Menampilkan' : 'Menyembunyikan'} ${count} label`);
};

/**
 * Konversi GeometryCollection ke FeatureCollection
 */
function convertGeometryCollectionToFeatureCollection(data, layerKey) {
    if (data.type === 'FeatureCollection') {
        return data;
    }

    if (data.type === 'GeometryCollection' && data.geometries) {
        if (layerKey === 'KEPADATAN_PENDUDUK') {
            return {
                type: 'FeatureCollection',
                features: data.geometries.map((geometry, index) => {
                    const density = Math.floor(Math.random() * 25000) + 500;
                    return {
                        type: 'Feature',
                        id: index,
                        properties: {
                            DESA: `Wilayah ${index + 1}`,
                            DENSITY: density,
                            KATEGORI: getPopulationDensityLabel(density),
                            id: index
                        },
                        geometry: geometry
                    };
                })
            };
        }

        if (layerKey === 'BATAS_RW') {
            return {
                type: 'FeatureCollection',
                features: data.geometries.map((geometry, index) => ({
                    type: 'Feature',
                    id: index,
                    properties: {
                        RW: `RW ${String(index + 1).padStart(2, '0')}`,
                        NAMA: `RW ${String(index + 1).padStart(2, '0')}`,
                        id: index
                    },
                    geometry: geometry
                }))
            };
        }

        return {
            type: 'FeatureCollection',
            features: data.geometries.map((geometry, index) => ({
                type: 'Feature',
                id: index,
                properties: { Name: `Point ${index + 1}`, id: index },
                geometry: geometry
            }))
        };
    }

    if (data.type && data.type !== 'FeatureCollection' && data.coordinates) {
        return {
            type: 'FeatureCollection',
            features: [{
                type: 'Feature',
                id: 0,
                properties: { Name: 'Feature 1' },
                geometry: data
            }]
        };
    }

    return data;
}

/**
 * Load single layer
 */
async function loadLayer(layerKey) {
    const config = layerConfig[layerKey];
    const filePath = window.ASSET_BASE_URL + config.file;

    try {
        console.log(`📥 Loading ${layerKey}...`);

        const response = await fetch(filePath);
        if (!response.ok) throw new Error(`Status: ${response.status}`);
        const rawData = await response.json();

        const data = convertGeometryCollectionToFeatureCollection(rawData, layerKey);

        console.log(`✅ ${layerKey} loaded: ${data.features?.length || 0} features`);

        geoJsonStore[layerKey] = data;

        const defaultStyle = config.isBoundary ? {
            color: config.color,
            weight: 2,
            opacity: 0.8,
            fillOpacity: 0.1,
            fillColor: config.color,
            dashArray: '5, 5'
        } : {
            color: config.color,
            weight: 2,
            opacity: 1,
            fillOpacity: 0.5
        };

        const layer = L.geoJSON(data, {
            pointToLayer: (feature, latlng) => {
                return L.circleMarker(latlng, {
                    radius: 6, 
                    fillColor: config.color, 
                    fillOpacity: 1.0, 
                    stroke: true,
                    color: '#ffffff',
                    weight: 1
                });
            },
            style: (feature) => {
                if (config.isChloropleth && feature.properties.DENSITY) {
                    return {
                        fillColor: getPopulationDensityColor(feature.properties.DENSITY),
                        weight: 1,
                        opacity: 0.8,
                        color: '#ffffff',
                        fillOpacity: 0.7
                    };
                }

                if (config.isLine || feature.geometry.type === 'LineString' || feature.geometry.type === 'MultiLineString') {
                    return {
                        color: config.color,
                        weight: 3,
                        opacity: 0.8
                    };
                }
                return defaultStyle;
            },

            onEachFeature: (feature, layer) => {
                const props = feature.properties; 

                const nameKey = config.nameField || Object.keys(props).find(k => /name|nama|pos|kecamatan|kelurahan|desa|^k$|^rw$/i.test(k)) || 'Name';
                const nameVal = props[nameKey] || props.K || props.KELURAHAN || props.DESA || props.RW || props.Name || '-';

                // KEPADATAN PENDUDUK
                if (config.isChloropleth) {
                    const density = props.DENSITY || 0;
                    const kategori = props.KATEGORI || getPopulationDensityLabel(density);
                    const densityColor = getPopulationDensityColor(density);

                    const popupContent = `
                        <div style="min-width:250px; font-family:sans-serif;">
                            <h5 style="margin:0 0 10px 0; color:${densityColor}; font-weight:bold; border-bottom:2px solid ${densityColor}; padding-bottom:8px;">
                                Kepadatan Penduduk
                            </h5>
                            <div style="background:#f8fafc; padding:12px; border-radius:8px; font-size:13px;">
                                <div style="font-weight:700; font-size:16px; margin-bottom:8px; color:#1e293b;">
                                    ${nameVal}
                                </div>
                                <div style="margin-top:12px; padding:10px; background:${densityColor}20; border-left:3px solid ${densityColor}; border-radius:4px;">
                                    <div style="font-weight:700; font-size:20px; color:${densityColor};">
                                        ${density.toLocaleString('id-ID')} jiwa/km²
                                    </div>
                                    <div style="font-size:11px; color:#64748b; margin-top:4px;">
                                        ${kategori}
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    layer.bindPopup(popupContent);

                    layer.on('mouseover', function() { this.setStyle({ weight: 2, fillOpacity: 0.9 }); });
                    layer.on('mouseout', function() { this.setStyle({ weight: 1, fillOpacity: 0.7 }); });

                    return;
                }

                // BATAS RW - LABEL TIDAK OTOMATIS MUNCUL
                if (layerKey === 'BATAS_RW') {
                    const rwDisplayName = getRwName(props, feature.id || 0);

                    const popupContent = `
                        <div style="min-width:200px; font-family:sans-serif;">
                            <h5 style="margin:0 0 10px 0; color:${config.color}; font-weight:bold; border-bottom:1px solid #e2e8f0; padding-bottom:8px;">
                                🏘️ ${rwDisplayName}
                            </h5>
                            <div style="background:#f8fafc; padding:12px; border-radius:8px; font-size:13px;">
                                <div style="font-weight:700; font-size:16px; color:#1e293b;">
                                    Kota Surabaya
                                </div>
                            </div>
                        </div>`;
                    layer.bindPopup(popupContent);

                    // TAMBAHKAN LABEL (hidden by default)
                    addRwLabels(layer, feature, feature.id || 0);

                    layer.on('mouseover', function() {
                        this.setStyle({ weight: 3, color: '#0d9488' });
                    });

                    layer.on('mouseout', function() {
                        this.setStyle({ weight: 2, color: config.color });
                    });

                    return;
                }

                // BATAS KECAMATAN & KELURAHAN
                if (config.isBoundary) {
                    let wilayahType = 'Wilayah';
                    if (layerKey === 'KECAMATAN') wilayahType = 'Kecamatan';
                    else if (layerKey === 'KELURAHAN') wilayahType = 'Kelurahan';

                    const popupContent = `
                        <div style="min-width:200px; font-family:sans-serif;">
                            <h5 style="margin:0 0 10px 0; color:${config.color}; font-weight:bold;">${wilayahType}</h5>
                            <div style="font-weight:700; font-size:16px; color:#1e293b;">${nameVal}</div>
                        </div>`;
                    layer.bindPopup(popupContent);

                    layer.bindTooltip(nameVal, {
                        permanent: false,
                        direction: 'center',
                        className: layerKey === 'KECAMATAN' ? 'kecamatan-label' : 'kelurahan-label'
                    });

                    return;
                }

                // POINT LAYERS
                let lokasiVal = null;
                if (config.locationField && props[config.locationField]) {
                    lokasiVal = props[config.locationField];
                } else {
                    const locationKey = Object.keys(props).find(k => /jalan|alamat|lokasi/i.test(k));
                    if (locationKey) lokasiVal = props[locationKey];
                }

                let kecVal = props.KECAMATAN || null;
                let kelVal = props.KELURAHAN || null;

                let detailHtml = '';
                if (lokasiVal) detailHtml += `<div style="margin-bottom:6px;"><i class="bi bi-geo-alt-fill" style="color:#ef4444;"></i> ${lokasiVal}</div>`;
                if (kelVal) detailHtml += `<div style="margin-bottom:6px;"><i class="bi bi-building" style="color:#f59e0b;"></i> Kel. ${kelVal}</div>`;
                if (kecVal) detailHtml += `<div style="margin-bottom:6px;"><i class="bi bi-map-fill" style="color:#3b82f6;"></i> Kec. ${kecVal}</div>`;

                const popupContent = `
                    <div style="min-width:230px; font-family:sans-serif;">
                        <h5 style="margin:0 0 10px 0; color:${config.color}; font-weight:bold;">${config.label}</h5>
                        <div style="font-weight:700; font-size:14px; margin-bottom:10px;">${nameVal}</div>
                        ${detailHtml}
                    </div>`;

                layer.bindPopup(popupContent);
            }
        });

        mapLayers[layerKey] = layer;

        console.log(`✅ Layer ${layerKey} siap`);

        const checkbox = document.querySelector(`input[data-layer="${layerKey}"]`);
        if (checkbox && checkbox.checked) {
            map.addLayer(layer);
        }

        if (typeof infoLegend !== 'undefined') {
            infoLegend.update();
        }

    } catch (error) {
        console.error(`❌ Error loading ${layerKey}:`, error);
        throw error;
    }
}

async function initMapData() {
    const loadingOverlay = document.getElementById('loading-overlay');

    try {
        if(loadingOverlay) {
            loadingOverlay.style.display = 'flex';
        }

        console.log('🚀 Loading layers...');

        const promises = Object.keys(layerConfig).map(key => loadLayer(key));
        await Promise.all(promises);

        console.log('✅ All layers loaded');

        const maskCheckbox = document.getElementById('surabaya-mask-toggle');
        if (maskCheckbox && maskCheckbox.checked) {
            toggleSurabayaMask(true);
        }

        if (typeof initEventListeners === 'function') {
            initEventListeners();
        }

    } catch (error) {
        console.error('❌ Error loading map data:', error);
        alert('Gagal memuat data peta');
    } finally {
        if(loadingOverlay) {
            loadingOverlay.style.display = 'none';
        }
    }
}

function toggleSurabayaMask(show = true) {
    try {
        if (!show) {
            if (mapLayers['SURABAYA_MASK']) {
                map.removeLayer(mapLayers['SURABAYA_MASK']);
                delete mapLayers['SURABAYA_MASK'];
            }
            return;
        }

        if (mapLayers['SURABAYA_MASK']) {
            if (!map.hasLayer(mapLayers['SURABAYA_MASK'])) {
                map.addLayer(mapLayers['SURABAYA_MASK']);
            }
            return;
        }

        if (!geoJsonStore['KECAMATAN']) return;

        const kecamatanFeatures = geoJsonStore['KECAMATAN'].features;
        const worldPolygon = {
            type: 'Feature',
            geometry: {
                type: 'Polygon',
                coordinates: [[[-180, -90], [-180, 90], [180, 90], [180, -90], [-180, -90]]]
            }
        };

        let surabayaUnion = null;
        kecamatanFeatures.forEach(feature => {
            if (feature.geometry) {
                if (feature.geometry.type === 'MultiPolygon') {
                    feature.geometry.coordinates.forEach(polyCoords => {
                        const poly = turf.polygon(polyCoords);
                        surabayaUnion = surabayaUnion ? turf.union(surabayaUnion, poly) : poly;
                    });
                } else if (feature.geometry.type === 'Polygon') {
                    const poly = turf.polygon(feature.geometry.coordinates);
                    surabayaUnion = surabayaUnion ? turf.union(surabayaUnion, poly) : poly;
                }
            }
        });

        if (surabayaUnion) {
            const maskArea = turf.difference(worldPolygon, surabayaUnion);
            if (maskArea) {
                const maskLayer = L.geoJSON(maskArea, {
                    style: {
                        fillColor: '#f0f0f0',
                        fillOpacity: 0.8,
                        color: '#999',
                        weight: 1,
                        interactive: false
                    }
                });
                mapLayers['SURABAYA_MASK'] = maskLayer;
                maskLayer.addTo(map);
                maskLayer.bringToBack();
            }
        }
    } catch (error) {
        console.warn('Mask error:', error);
    }
}

function addSurabayaMask() {
    toggleSurabayaMask(true);
}