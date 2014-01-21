jQuery(document).ready(function() {
	// set caption area height
	jQuery('.gss-long-cap').each(function() {
		jQuery(this).show();
		var long_cap_height = (jQuery(this).height())+1;
		jQuery(this).hide();
		jQuery(this).next('.gss-captions').css('min-height', long_cap_height);
	});
});

jQuery(window).load(function () {
	// full width for 90%+ images; reset horz centering margins on window load
	jQuery('.cycle-slideshow').each(function() {
			var ssw = jQuery(this).width();	
			var centering = jQuery(this).data('cycle-center-horz');	
			jQuery('img', this).each(function() {
				imgw = jQuery(this).width();
				if(centering == true){
					margin = (ssw - imgw)/2;
					jQuery(this).css('margin-left', margin);
				}
				if(imgw != ssw && imgw > (ssw*0.9)){
					jQuery(this).css('margin-left', '');
					jQuery(this).css('width', '100%');
				}
				// img_margin = jQuery(this)[0].style.marginLeft;
			});
	});
});

/* jQuery( document ).on( 'cycle-before', function(e, opts, osEl, isEl, ff) {
	console.log(opts);
    var w = jQuery(isEl).outerWidth();
    jQuery(isEl).css({ marginLeft: (604 - w) / 2 });
}); */