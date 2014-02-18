/*
 * © 2014 by Noël Bossart – noelboss.ch
 */
;
(function($){
	$(document).ready(function(){

		$(".tablesorter").each(function(){
			var $t = $(this),
				sort = $t.attr('data-sort');

			if(typeof eval(sort) === 'object'){
				$t.tablesorter({
					sortList: eval(sort),
					cssChildRow: "childrow"
				});
			} else {
				$t.tablesorter({
					cssChildRow: "childrow"
				});
			}

		});

	});
})(jQuery);
