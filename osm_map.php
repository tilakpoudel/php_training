<!DOCTYPE html>
<html>
  <head>
    <title>OpenMapTiles</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.12.1/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.12.1/mapbox-gl.css' rel='stylesheet' />
    <style>
      html, body, #map {width:100%; height:100%; margin:0; padding:0;}
      body {background: #fff;}
      #map {position:absolute;top:0;left:0;right:200px;bottom:0;}
      #layerList {position:absolute;top:5px;right:0;bottom:50%;width:190px;overflow:auto;}
      #layerList div {color:#333;}
      #layerList div div {width:15px;height:15px;display:inline-block;}
      #propertyList {position:absolute;top:50%;bottom:0;right:0;width:190px;overflow:auto;color:#000;}
      .mapboxgl-control-container div {z-index: 100;}
    </style>
  </head>
  <body>
    <div id="map"></div>
    <div id="layerList"></div>
    <pre id="propertyList"></pre>
  <script>

mapboxgl.accessToken = 'NOT-REQUIRED-WITH-YOUR-VECTOR-TILES-DATA';
var map = new mapboxgl.Map({
  container: 'map'
});
map.addControl(new mapboxgl.Navigation());

function generateColor(str) {
  var rgb = [0, 0, 0];
  for (var i = 0; i < str.length; i++) {
      var v = str.charCodeAt(i);
      rgb[v % 3] = (rgb[i % 3] + (13*(v%13))) % 12;
  }
  var r = 4 + rgb[0];
  var g = 4 + rgb[1];
  var b = 4 + rgb[2];
  r = (r * 16) + r;
  g = (g * 16) + g;
  b = (b * 16) + b;
  return [r,g,b,1];
};
function initLayer(data) {
  var layer;
  var layerList = document.getElementById('layerList');
  var layers_ = [];
  data['vector_layers'].forEach(function(el) {
    var color = generateColor(el['id']);
    var colorText = 'rgba(' + color[0] + ',' + color[1] + ',' + color[2] + ',' + color[3] + ')';
    layers_.push({
      id: el['id'] + Math.random(),
      source: 'vector_layer_',
      'source-layer': el['id'],
      interactive: true,
      type: 'line',
      paint: {'line-color': colorText}
    });
    var item = document.createElement('div');
    item.innerHTML = '<div style="' +
      'background:rgba(' + color[0] + ',' + color[1] + ',' + color[2] + ',1);' +
      '"></div> ' + el['id'];
    layerList.appendChild(item);
  });
  var center = data['center'];
  if (typeof center == 'string') {
    center = center.split(',');
  }
  map.setStyle({
    version: 8,
    center: [parseFloat(center[0]), parseFloat(center[1])],
    zoom: parseInt(center[2], 10),
    sources: {
      'vector_layer_': {
        type: 'vector',
        tiles: data['tiles'],
        minzoom: data['minzoom'],
        maxzoom: data['maxzoom']
      }
    },
    layers: layers_
  });
  return layer;
}

var propertyList = document.getElementById('propertyList');
map.on('mousemove', function(e) {
  propertyList.innerHTML = '';
  map.featuresAt(e.point, {radius: 3}, function(err, features) {
    if (err) throw err;
    if (features[0]) {
      propertyList.innerHTML = JSON.stringify(features[0].properties, null, 2);
    }
  });
});

var tileJSON = {"attribution":"<a href=\\\"http://www.openmaptiles.org/\\\" target=\\\"_blank\\\">&copy; OpenMapTiles</a> <a href=\\\"http://www.openstreetmap.org/about/\\\" target=\\\"_blank\\\">&copy; OpenStreetMap contributors</a>","center":[84.124675,28.39864,14],"description":"Extract from https://openmaptiles.org","maxzoom":14,"minzoom":0,"name":"OpenMapTiles","pixel_scale":"256","mtime":"1499626373833","format":"pbf","id":"openmaptiles","version":"3.6.1","maskLevel":"5","bounds":[80.02361,26.31982,88.22574,30.47746],"planettime":"1499040000000","basename":"2017-07-03_asia_nepal","profile":"mercator","scale":1,"tiles":["http://localhost/tileserver-php-master/2017-07-03_asia_nepal/{z}/{x}/{y}.pbf"],"tilejson":"2.0.0","scheme":"xyz","grids":["http://localhost/tileserver-php-master/2017-07-03_asia_nepal/{z}/{x}/{y}.grid.json"],"vector_layers":[{"maxzoom":14,"fields":{"class":"String"},"minzoom":0,"id":"water","description":""},{"maxzoom":14,"fields":{"name:mt":"String","name:pt":"String","name:az":"String","name:ka":"String","name:rm":"String","name:ko":"String","name:kn":"String","name:ar":"String","name:cs":"String","name_de":"String","name:ro":"String","name:it":"String","name_int":"String","name:ru":"String","name:pl":"String","name:ca":"String","name:lv":"String","name:bg":"String","name:cy":"String","name:fi":"String","name:he":"String","name:da":"String","name:de":"String","name:tr":"String","name:fr":"String","name:mk":"String","name:nonlatin":"String","name:fy":"String","name:be":"String","name:zh":"String","name:sr":"String","name:sl":"String","name:nl":"String","name:ja":"String","name:lt":"String","name:no":"String","name:kk":"String","name:ko_rm":"String","name:ja_rm":"String","name:br":"String","name:bs":"String","name:lb":"String","name:la":"String","name:sk":"String","name:uk":"String","name:hy":"String","name:sv":"String","name_en":"String","name:hu":"String","name:hr":"String","class":"String","name:sq":"String","name:el":"String","name:ga":"String","name:en":"String","name":"String","name:gd":"String","name:ja_kana":"String","name:is":"String","name:th":"String","name:latin":"String","name:sr-Latn":"String","name:et":"String","name:es":"String"},"minzoom":0,"id":"waterway","description":""},{"maxzoom":14,"fields":{"class":"String","subclass":"String"},"minzoom":0,"id":"landcover","description":""},{"maxzoom":14,"fields":{"class":"String"},"minzoom":0,"id":"landuse","description":""},{"maxzoom":14,"fields":{"name:mt":"String","name:pt":"String","name:az":"String","name:ka":"String","name:rm":"String","name:ko":"String","name:kn":"String","name:ar":"String","name:cs":"String","rank":"Number","name_de":"String","name:ro":"String","name:it":"String","name_int":"String","name:lv":"String","name:pl":"String","name:de":"String","name:ca":"String","name:bg":"String","name:cy":"String","name:fi":"String","name:he":"String","name:da":"String","ele":"Number","name:tr":"String","name:fr":"String","name:mk":"String","name:nonlatin":"String","name:fy":"String","name:be":"String","name:zh":"String","name:sl":"String","name:nl":"String","name:ja":"String","name:lt":"String","name:no":"String","name:kk":"String","name:ko_rm":"String","name:ja_rm":"String","name:br":"String","name:bs":"String","name:lb":"String","name:la":"String","name:sk":"String","name:uk":"String","name:hy":"String","name:ru":"String","name:sv":"String","name_en":"String","name:hu":"String","name:hr":"String","name:sr":"String","name:sq":"String","name:el":"String","name:ga":"String","name:en":"String","name":"String","name:gd":"String","ele_ft":"Number","name:ja_kana":"String","name:is":"String","osm_id":"Number","name:th":"String","name:latin":"String","name:sr-Latn":"String","name:et":"String","name:es":"String"},"minzoom":0,"id":"mountain_peak","description":""},{"maxzoom":14,"fields":{"class":"String"},"minzoom":0,"id":"park","description":""},{"maxzoom":14,"fields":{"admin_level":"Number","disputed":"Number","maritime":"Number"},"minzoom":0,"id":"boundary","description":""},{"maxzoom":14,"fields":{"class":"String"},"minzoom":0,"id":"aeroway","description":""},{"maxzoom":14,"fields":{"brunnel":"String","ramp":"Number","class":"String","service":"String","oneway":"Number"},"minzoom":0,"id":"transportation","description":""},{"maxzoom":14,"fields":{"render_min_height":"Number","render_height":"Number"},"minzoom":0,"id":"building","description":""},{"maxzoom":14,"fields":{"name:mt":"String","name:pt":"String","name:az":"String","name:ka":"String","name:rm":"String","name:ko":"String","name:kn":"String","name:ar":"String","name:cs":"String","name_de":"String","name:ro":"String","name:it":"String","name_int":"String","name:ru":"String","name:pl":"String","name:ca":"String","name:lv":"String","name:bg":"String","name:cy":"String","name:fi":"String","name:he":"String","name:da":"String","name:de":"String","name:tr":"String","name:fr":"String","name:mk":"String","name:nonlatin":"String","name:fy":"String","name:be":"String","name:zh":"String","name:sr":"String","name:sl":"String","name:nl":"String","name:ja":"String","name:lt":"String","name:no":"String","name:kk":"String","name:ko_rm":"String","name:ja_rm":"String","name:br":"String","name:bs":"String","name:lb":"String","name:la":"String","name:sk":"String","name:uk":"String","name:hy":"String","name:sv":"String","name_en":"String","name:hu":"String","name:hr":"String","class":"String","name:sq":"String","name:el":"String","name:ga":"String","name:en":"String","name":"String","name:gd":"String","name:ja_kana":"String","name:is":"String","name:th":"String","name:latin":"String","name:sr-Latn":"String","name:et":"String","name:es":"String"},"minzoom":0,"id":"water_name","description":""},{"maxzoom":14,"fields":{"name:mt":"String","name:pt":"String","name:az":"String","name:ka":"String","name:rm":"String","name:ko":"String","name:kn":"String","name:ar":"String","name:cs":"String","name_de":"String","name:ro":"String","name:it":"String","name_int":"String","name:ru":"String","name:pl":"String","name:ca":"String","name:lv":"String","name:bg":"String","name:cy":"String","name:fi":"String","name:he":"String","name:da":"String","name:de":"String","name:tr":"String","name:fr":"String","name:mk":"String","name:nonlatin":"String","name:fy":"String","name:be":"String","name:zh":"String","name:sr":"String","name:sl":"String","name:nl":"String","name:ja":"String","name:lt":"String","name:no":"String","name:kk":"String","name:ko_rm":"String","name:ja_rm":"String","name:br":"String","name:bs":"String","name:lb":"String","name:la":"String","name:sk":"String","name:uk":"String","name:hy":"String","name:sv":"String","name_en":"String","name:hu":"String","name:hr":"String","class":"String","name:sq":"String","network":"String","name:el":"String","name:ga":"String","name:en":"String","name":"String","name:gd":"String","ref":"String","name:ja_kana":"String","ref_length":"Number","name:is":"String","name:th":"String","name:latin":"String","name:sr-Latn":"String","name:et":"String","name:es":"String"},"minzoom":0,"id":"transportation_name","description":""},{"maxzoom":14,"fields":{"name:mt":"String","name:pt":"String","name:az":"String","name:ka":"String","name:rm":"String","name:ko":"String","name:kn":"String","name:ar":"String","name:cs":"String","rank":"Number","name_de":"String","name:ro":"String","name:it":"String","name_int":"String","name:ru":"String","name:pl":"String","name:ca":"String","name:lv":"String","name:bg":"String","name:cy":"String","name:hr":"String","name:fi":"String","name:he":"String","name:da":"String","name:de":"String","name:tr":"String","name:fr":"String","name:mk":"String","name:nonlatin":"String","name:fy":"String","name:be":"String","name:zh":"String","name:sr":"String","name:sl":"String","name:nl":"String","name:ja":"String","name:ko_rm":"String","name:no":"String","name:kk":"String","capital":"Number","name:ja_rm":"String","name:br":"String","name:bs":"String","name:lb":"String","name:la":"String","name:sk":"String","name:uk":"String","name:hy":"String","name:sv":"String","name_en":"String","name:hu":"String","name:lt":"String","class":"String","name:sq":"String","name:el":"String","name:ga":"String","name:en":"String","name":"String","name:gd":"String","name:ja_kana":"String","name:is":"String","name:th":"String","name:latin":"String","name:sr-Latn":"String","name:et":"String","name:es":"String"},"minzoom":0,"id":"place","description":""},{"maxzoom":14,"fields":{"housenumber":"String"},"minzoom":0,"id":"housenumber","description":""},{"maxzoom":14,"fields":{"name:mt":"String","name:pt":"String","name:az":"String","name:ka":"String","name:rm":"String","name:ko":"String","name:kn":"String","name:ar":"String","name:cs":"String","rank":"Number","name_de":"String","name:ro":"String","name:it":"String","name_int":"String","name:ru":"String","name:pl":"String","name:ca":"String","name:lv":"String","name:bg":"String","name:cy":"String","name:fi":"String","name:he":"String","name:da":"String","subclass":"String","name:de":"String","name:tr":"String","name:fr":"String","name:mk":"String","name:nonlatin":"String","name:fy":"String","name:be":"String","name:zh":"String","name:sr":"String","name:sl":"String","name:nl":"String","name:ja":"String","name:lt":"String","name:no":"String","name:kk":"String","name:ko_rm":"String","name:ja_rm":"String","name:br":"String","name:bs":"String","name:lb":"String","name:la":"String","name:sk":"String","name:uk":"String","name:hy":"String","name:sv":"String","name_en":"String","name:hu":"String","name:hr":"String","class":"String","name:sq":"String","name:el":"String","name:ga":"String","name:en":"String","name":"String","name:gd":"String","name:ja_kana":"String","name:is":"String","name:th":"String","name:latin":"String","name:sr-Latn":"String","name:et":"String","name:es":"String"},"minzoom":0,"id":"poi","description":""}],"zoom":7,"tileUrl":"http://localhost/tileserver-php-master/2017-07-03_asia_nepal/14/12020/6843.pbf"};
initLayer(tileJSON);

    </script>
  </body>
</html>
Welcome to Maps hosted with TileServer-php v2.0
This server distributes maps to desktop, web, and mobile applications.

The mapping data are available as OpenGIS Web Map Tiling Service (OGC WMTS), OSGEO Tile Map Service (TMS), and popular XYZ urls described with TileJSON metadata.

OpenMapTiles