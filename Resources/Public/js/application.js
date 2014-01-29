/*
 * © 2012 by Noël Bossart – noelboss.ch
 */
;
(function($){
	$(document).ready(function(){

		$(".print").click(function(){
			window.print();
		});

		$(".singletable").tablesorter({
			sortList: [[0,0]]
		});

		$(".listtable").tablesorter({
			sortList: [[2,0]]
		});

		// google maps
		$('.gmap',$mod).each(function(){
			var that = this;
			var $t = $(this);

			var myOptions = {
				zoom: 6,
				center: new google.maps.LatLng(47.478232, 9.047241), // Bissfest
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}

			var search = {
				'address': $t.attr('data-address').replace(/\r?\n|\r/g, ", "),
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

		// toggle checkbox
		$('.expand',$mod).click(function(e){
			$(this).hide().next('.expanded').slideDown(300);
		});

		// toggle checkbox
		$('.info',$mod).fancybox({
			type: 'ajax',
			height: '70%',
			width: '70%',
			maxWidth: '800'
		});



		// focus error on load
		$('.error input:eq(0)',$mod),$mod.focus();

		// Gallery
		$('.nivoSlider',$mod).nivoSlider({
			effect: 'fade' // Specify sets like: 'fold,fade,sliceDown'
		});
	});
})(jQuery);
