(function() {
	function getJQuery(callback) {
		if (typeof jQuery === "undefined") {
			var scriptTag = document.createElement('script');
			scriptTag.setAttribute("type", "text/javascript");
			scriptTag.setAttribute("src", "http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js");
			scriptTag.onload = function() {
				jQuery.noConflict();
				callback(jQuery);
			};
			scriptTag.onreadystatechange = function() {
				if (this.readyState == 'complete' || this.readyState == 'loaded') {
					jQuery.noConflict();
					callback(jQuery);
				}
			};
			
			document.getElementsByTagName("head")[0].appendChild(scriptTag);
		} else {
			callback(jQuery);
		}
	}
	
	getJQuery(function($) {
		$(document).ready(function() {
			$('.balloz-toolbar a').click(function() {
				$($(this).attr('href')).toggle();
			});
		});
	});
}());
