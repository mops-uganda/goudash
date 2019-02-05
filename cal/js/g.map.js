function google_maps(element, lat, long)
{	
	var position = [lat, long]
	
	function showGoogleMaps() 
	{ 	
		var latLng = new google.maps.LatLng(position[0], position[1]);
	
		var mapOptions = {
			zoom: 16, 
			streetViewControl: false,
			scaleControl: true, 
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			center: latLng
		};
	 
		map = new google.maps.Map(element, mapOptions);
	 
		marker = new google.maps.Marker({
			position: latLng,
			map: map,
			draggable: false,
			animation: google.maps.Animation.DROP
		});
	}
	
	showGoogleMaps();
}