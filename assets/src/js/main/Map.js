import "./Leaflet";
//import "leaflet";
import "leaflet.markercluster";

export default class Map {

    constructor(data) {
        let self = this;
        self.element = 'smartrecruiters__map';
        self.place = document.querySelector(`.${self.element}`);
        self.confirm = true;
        if(self.check()) {
            self.idElement = 'smartrecruiters-map';
            self.alert();
            if (self.confirm) {
                self.initMap();
                self.setCopyright();
                self.initMarkerClusters();
                self.addMarkerClusters(self.addMarkers(data.items));
            }
        }
    }

    check() {
        let self = this;
        return self.place !== null;
    }

    alert() {
        let self = this;
        let parts = document.cookie.split(`${self.idElement}=`);
        if (typeof parts[1] === 'undefined' || typeof parts[1][0] === 'undefined') {
            if(confirm(smartrecruitersConfigMap.alert)) {
                document.cookie = `${self.idElement}=1; expires=01 Dec 3000 12:00:00 UTC`;
            } else {
                self.confirm = false;
            }
        }
    }

    initMap() {
        let self = this;
        self.map = L.map(self.idElement);
    }

    setCopyright() {
        let self = this;
        L.tileLayer( smartrecruitersConfigMap.style.provider, {
            attribution: smartrecruitersConfigMap.style.attribution,
            subdomains: smartrecruitersConfigMap.style.subdomains
        }).addTo(self.map);
    }

    initMarkerClusters() {
        let self = this
        self.markerClusters = L.markerClusterGroup({
            showCoverageOnHover: false,
            iconCreateFunction: function(cluster) {
                let markers = cluster.getAllChildMarkers();
                let count = 0;
                if (markers.length) {
                    for(let marker of markers) {
                        count += marker.options.icon.options.items;
                    }
                }
                return L.divIcon({
                    className: 'marker-cluster',
                    iconSize: L.point(40, 40),
                    html: `<div><span>${count}</span></div>`
                });
            }
        });
    }

    addMarkers(items) {
        let self = this;
        let markers = {};
        let key;
        let lat;
        let lon;
        if (Object.keys(items).length) {
            for (let i in items) {
                if (typeof(smartrecruitersConfigMap.markers[i]) !== 'undefined') {
                    //console.log(items[i]);
                    //console.log(smartrecruitersConfigMap.markers[i]);
                    lat = smartrecruitersConfigMap.markers[i].lat;
                    lon = smartrecruitersConfigMap.markers[i].lon;
                    /*
                    lat = 52.520008;
                    lon = 13.404954;
                    */
                    key = lat + ' ' + lon;
                    if (typeof(markers[key]) === 'undefined') {
                        markers[key] = {
                            'lat': lat,
                            'lon': lon,
                            'count': 0,
                            'html': ''
                        }
                    }
                    markers[key].count =  markers[key].count + 1;
                    markers[key].html = markers[key].html +
                        `<div class="${self.element}-marker-item"><a href="${items[i].link}" target="_blank">${items[i].name}</a></div>`;
                }
            }
        }

        return markers;
    }

    setIcon(data = 0) {
        let self = this;
        let text = (data === 1) ? smartrecruitersConfigMap.markerText.single : smartrecruitersConfigMap.markerText.many;
        return L.divIcon({
            className: `${self.element}-marker`,
            html: `<div class="${self.element}-marker-icon"></div><div class="${self.element}-marker-data">${data} ${text}</div>`,
            iconSize: [100, 32],
            iconAnchor: [11, 32],
            popupAnchor: [0, -20],
            items: data
        });
    }

    addMarkerClusters(markers) {
        let self = this;
        let coords = [];
        for (let i in markers) {
            coords.push([markers[i].lat, markers[i].lon]);
            self.markerClusters.addLayer(
                L.marker(
                    [markers[i].lat, markers[i].lon],
                    {icon: self.setIcon(markers[i].count)}
                ).bindPopup(markers[i].html)
            );
        }
        self.map.fitBounds(coords);
        self.map.addLayer(self.markerClusters);
    }

}