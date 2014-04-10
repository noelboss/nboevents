/*
 * © 2014 by Noël Bossart – noelboss.ch
 */
;
(function($){
	$(document).ready(function(){
		var $mod = $('.tx-nboevents');

		if($mod.length < 1){
			return;
		}

		var $templ = $('.template', $mod);
		$('.data-pool [id]').each(function(){
			var $t = $(this).detach();
			$templ.find('.data-'+this.id).html($t.clone());
		});

		$('.print:not(.ajax)', $mod).click(function(e){
			window.print();
		});

		$('.btn.ajax', $mod).click(function(e){

			if($(this).hasClass('print')){
				window.print();
			}
			$.ajax({
				url: this.href,
				success: function(data){
					$.fancybox.open({
						content:  $(data).find('.tx-nboevents').html()
					});
				}
			});
			e.preventDefault();
		});


		$('body').on('click', '.btn.close-fb', function(e){
			$.fancybox.close();
		});

		$templ.before($('.data-pool .header'));
		$templ.after($('.data-pool .footer'));
		$templ.before($('.data-pool .tx-nboevents'));


		$('[contenteditable="true"]').blur(function(){
			var html = this.innerHTML;
			$('.data-'+this.id+' [contenteditable="true"]').html(html);
		});

		$('tr[data-href]', $mod).click(function(){
			window.location = $(this).attr('data-href');
		});

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
