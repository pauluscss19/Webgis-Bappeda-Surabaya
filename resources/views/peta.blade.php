<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>WebGIS Viewer</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <style>#map{height: 600px;}</style>
</head>
<body>
  <h3>Peta Sederhana</h3>
  <div id="map"></div>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script>
    const map = L.map('map').setView([-7.2575, 112.7521], 11);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 })
      .addTo(map);

    L.tileLayer.wms('http://localhost:8080/geoserver/pemda/wms', {
      layers: 'pemda:titik_demo',
      format: 'image/png',
      transparent: true
    }).addTo(map);
  </script>
</body>
</html>
