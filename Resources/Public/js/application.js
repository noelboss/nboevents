/*
 * © 2012 by Noël Bossart – sagenja.ch
 */
;
(function($){
	$(document).ready(function(){
		var $mod = $('.tx-nboevents');
		
		if($mod.length < 1){
			return;
		}
		
		// toggle checkbox
		$('[data-toggle]',$mod).click(function(e){
			var $t = $($(this).attr('data-toggle'));
			if($t.is(':visible')){
				$t.slideUp(150);
			}else{
				$t.slideDown(100).find('input').val('');
			} 
		});
		
		// focus error on load
		$('.error input:eq(0)',$mod),$mod.focus();

		// Gallery
		$('.nivoSlider',$mod).nivoSlider();
		
		// google maps
		$('.gmap',$mod).each(function(){
			var that = this;
			var $t = $(this);

			var myOptions = {
				zoom: 6,
				center: new google.maps.LatLng(47.3686498, 8.539182500000038), // zurich
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}

			var search = {
				'address': $t.attr('data-address'),
				region: 'sgg'
			};
			var address = $t.html();
			var map = new google.maps.Map(that, myOptions);
			var gc  = geocoder = new google.maps.Geocoder();
			var infowindow = new google.maps.InfoWindow();
			var marker;

			gc.geocode( search , function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					marker = new google.maps.Marker({
						map: map,
						position: results[0].geometry.location
					});
					map.setZoom($t.attr('data-zoom')*1);
					map.setCenter(results[0].geometry.location);
					if($t.attr('data-infowindow')){
						infowindow.setContent(address);
						infowindow.open(map, marker);
					}
				} else {
					//console.log([results,status]);
				}
			});
		});
	});
})(jQuery);
