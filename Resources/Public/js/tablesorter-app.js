/*
 * © 2014 by Noël Bossart – noelboss.ch
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

	});
})(jQuery);
