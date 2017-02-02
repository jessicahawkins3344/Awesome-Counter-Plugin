/**
 * ACP Main Js
 *
 */

( function( $ ) {

	function counterInit() {
		$(".counter").countimator({
		   	duration: 2400
		});
	}

	$(document).ready(counterInit);

} )( jQuery );