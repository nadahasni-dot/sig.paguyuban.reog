let map;
const options = {
	jember: {
		lat: -8.168885,
		lng: 113.702228,
		zoom: 12,
	},
	jti: {
		lat: -8.157628,
		lng: 113.722688,
		zoom: 18,
	},
};
const TOKEN =
	"pk.eyJ1IjoibmFkYWhhc25pbSIsImEiOiJja3A2NnAwaWEwbnFzMnBxdGlxNmtuaWUzIn0.oU7Cg2023mBLDxWn3AOqhg";

function initMap() {
	map = L.map("map", {
		center: [options.jember.lat, options.jember.lng],
		zoom: options.jember.zoom,
	});

	// L.tileLayer(
	// 	`https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}`,
	// 	{
	// 		attribution:
	// 			'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
	// 		maxZoom: 18,
	// 		id: "mapbox/streets-v11",
	// 		tileSize: 512,
	// 		zoomOffset: -1,
	// 		accessToken: TOKEN,
	// 	}
	// ).addTo(map);

	L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
		attribution:
			'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
	}).addTo(map);

	map.invalidateSize();
}

function initMapContact() {
	map = L.map("mapContact", {
		center: [options.jti.lat, options.jti.lng],
		zoom: options.jti.zoom,
	});	

    L.tileLayer(
		`https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}`,
		{
			attribution:
				'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
			maxZoom: 18,
			id: "mapbox/streets-v11",
			tileSize: 512,
			zoomOffset: -1,
			accessToken: TOKEN,
		}
	).addTo(map);    

    var jtiMarker = L.marker([options.jti.lat, options.jti.lng]).addTo(map);
    jtiMarker.bindPopup("<b>Jurusan Teknologi Informasi</b><br>POLITKENIK NEGERI JEMBER.").openPopup();
}

function onMapClick(e) {
	alert("You clicked the map at " + e.latlng);
}
