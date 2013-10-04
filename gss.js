jQuery(window).load(function () {
	jQuery('.gss-container').each(function() {
		jQuery('.gss-long-cap', this).show();
		var long_cap_height = (jQuery('.gss-long-cap', this).height())+1;
		jQuery('.gss-long-cap', this).hide();
		jQuery('.gss-captions', this).css('min-height', long_cap_height);
	});
});