jQuery(document).ready( function($) {
	$('.jltma-master-addons-tabs-navbar a:not(.jltma-upgrade-pro)').click(function(event){
		event.preventDefault();
		
		// Limit effect to the container element.
		var context = $(this).closest('.jltma-master-addons-tabs-navbar').parent();
		$('.jltma-master-addons-tabs-navbar li', context).removeClass('jltma-admin-tab-active');
		$(this).closest('li').addClass('jltma-admin-tab-active');
		$('.jltma-master-addons-tab-contents .jltma-master-addons-tab-panel', context).hide();
		$( $(this).attr('href'), context ).show();
	});

	// Make setting jltma-admin-tab-active optional.
	$('.jltma-master-addons-tabs-navbar').each(function(){
		if ( $('.jltma-admin-tab-active', this).length )
			$('.jltma-admin-tab-active', this).click();
		else
			$('a', this).first().click();
	});
});