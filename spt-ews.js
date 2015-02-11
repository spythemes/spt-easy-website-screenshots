function sptAjax(sUrl, sNonce, sSite, sCache, sQuality, sStyle, sLoader) {

	var spt_thumb_box = '#spt-ews-thumb-box-num-' + sLoader;
	var spt_thumb_box_loader = '#spt-ews-thumb-loader-num-' + sLoader;
	
	function spt_change_view(spt_box,spt_load,spt_style) {
		jQuery(spt_box).addClass(spt_style);
		jQuery(spt_load).fadeIn("slow");
	}
	
	jQuery.ajax({
			type: "post",
			url: sUrl,
			data: { action: 'gettheshots', _ajax_nonce: sNonce, au: sSite, ac: sCache, aq: sQuality},
			beforeSend: spt_change_view(spt_thumb_box,spt_thumb_box_loader,sStyle)
		})
		.done(function(data) { 
			jQuery(spt_thumb_box_loader).fadeOut("slow");
			jQuery(spt_thumb_box).html(data); 
			jQuery(spt_thumb_box).fadeIn("slow"); 
		})
		.fail(function() {
			jQuery(spt_thumb_box_loader).fadeOut("slow");
			jQuery(spt_thumb_box).hide(); 
			if ( console && console.log ) {console.log( "SpyThemes Easy Website Plugin Screenshots: AJAX FETCH ERROR" )};
	}); 

}