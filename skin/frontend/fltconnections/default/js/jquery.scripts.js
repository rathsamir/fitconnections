jQuery.noConflict();

jQuery(document).ready(function() {
	jQuery(document).on('click','.icon-search', function(){
		jQuery('#header-search').toggleClass( "highlight" );
		console.log("a");
		return false;
	})
});