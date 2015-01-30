function LatLngOverlay() {
    this.numlatlines = typeof (latlines) === 'number' ? latlines : 4;
    this.numlnglines = typeof (lnglines) === 'number' ? lnglines : 6;
    this.minzoom = typeof (minzoom) === 'number' ? minzoom : 0;
    this.dms = $('#overlayTypeDMS').prop('checked');
    this.map = DMT.gmaps.map;
    this.divs = [];
    this.setMap(this.map);
    this.hidden = true;
}
LatLngOverlay.prototype = new google.maps.OverlayView();
LatLngOverlay.prototype.initialize = function () {
    this.map = DMT.gmaps.map;
    this.divs = [];
};
LatLngOverlay.prototype.remove = function () {
    var overlayShawdowPane = this.getPanes().overlayShadow;
    for (var i = 0; i < this.divs.length; i++) {
        overlayShawdowPane.removeChild(this.divs[i]);
    }
};
LatLngOverlay.prototype.copy = function () {
    return new LatLngOverlay();
};
LatLngOverlay.prototype.redraw = function (force) {
    this.draw();
};
LatLngOverlay.prototype.draw = function (force) {
    if (this.hidden) {
        return;
    }
    this.remove();
    this.divs = [];
    if (this.map.getZoom() < this.minzoom) {
        return;
    }
    var bnds = this.map.getBounds();
    var prj = this.getProjection();
    var topRight = prj.fromLatLngToDivPixel(bnds.getNorthEast());
    var bottomLeft = prj.fromLatLngToDivPixel(bnds.getSouthWest());
    var mapHeight = $('#map').height();
    var mapWidth = $('#map').width();
    var latSpacing = Math.floor(mapHeight / (this.numlatlines + 1));
    var lngSpacing = Math.floor(mapWidth / (this.numlnglines + 1));
    var overlayShawdowPane = this.getPanes().overlayShadow;
    this.color = (DMT.gmaps.isDarkMapType()) ? '#FFFFFF' : '#000000';
    var line, text, label, latlng;
    for (var i = 1; i <= this.numlatlines; i++) {
        var lineY = (latSpacing * i) + topRight.y;
        latlng = prj.fromDivPixelToLatLng(new google.maps.Point(mapWidth, lineY));
        line = this.createLine(bottomLeft.x, lineY, mapWidth, 1);
        text = '';
        if (this.dms) {
            text = convertDecToDMS(latlng.lat(), 'lat', true);
        } else {
            text = latlng.lat().toFixed(4);
        }
        label = this.createLabel(topRight.x - 60, lineY - 12, text);
        this.divs.push(line);
        this.divs.push(label);
        overlayShawdowPane.appendChild(line);
        overlayShawdowPane.appendChild(label);
    }
    for (var j = 1; j <= this.numlnglines; j++) {
        var lineX = (lngSpacing * j) + bottomLeft.x;
        latlng = prj.fromDivPixelToLatLng(new google.maps.Point(lineX, mapHeight));
        line = this.createLine(lineX, topRight.y, 1, mapHeight);
        text = '';
        if (this.dms) {
            text = convertDecToDMS(latlng.lng(), 'lng', true);
        } else {
            text = latlng.lng().toFixed(4);
        }
        label = this.createLabel(lineX + 2, bottomLeft.y - 47, text);
        this.divs.push(line);
        this.divs.push(label);
        overlayShawdowPane.appendChild(line);
        overlayShawdowPane.appendChild(label);
    }
};
LatLngOverlay.prototype.createLine = function (left, top, width, height) {
    var div = document.createElement("div");
    div.style.position = "absolute";
    div.style.overflow = "hidden";
    div.style.backgroundColor = this.color;
    div.style.left = left + "px";
    div.style.top = top + "px";
    div.style.width = width + "px";
    div.style.height = height + "px";
    return div;
};
LatLngOverlay.prototype.createLabel = function (x, y, text) {
    var div = document.createElement("div");
    div.style.position = "absolute";
    div.style.overflow = "hidden";
    div.style.color = this.color;
    div.style.fontFamily = "Arial";
    div.style.fontSize = "10px";
    div.style.left = x + "px";
    div.style.top = y + "px";
    div.style.width = "65px";
    div.innerHTML = text;
    return div;
};
LatLngOverlay.prototype.show = function (dms) {
    for (var i = 0; i < this.divs.length; i++) {
        this.divs[i].style.display = 'block';
    }
    if (dms !== undefined) {
        this.dms = dms;
    }
    this.hidden = false;
    this.redraw();
};
LatLngOverlay.prototype.hide = function () {
    for (var i = 0; i < this.divs.length; i++) {
        this.divs[i].style.display = 'none';
    }
    this.hidden = true;
};
LatLngOverlay.prototype.setDMS = function (dms) {
    this.dms = dms;
    this.redraw();
}; 