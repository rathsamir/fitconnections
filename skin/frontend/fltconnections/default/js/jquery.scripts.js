jQuery.noConflict();

	jQuery(document).ready(function() {
	jQuery(document).on('click','.icon-search', function(){
		jQuery('#header-search').toggleClass( "highlight" );
		console.log("a");
		return false;
	})
	try {
    	jQuery('.gallery-popup').magnificPopup({
		  delegate: 'a',
		  type: 'image',
		  closeOnContentClick: false,
		  fixedContentPos: false,
		  closeBtnInside: false,
		  mainClass: 'mfp-with-zoom mfp-img-mobile',
		  gallery: {
			  enabled: true
		  },
		  zoom: {
			  enabled: true,
			  duration: 300, // don't foget to change the duration also in CSS
			  opener: function(element) {
				  return element.find('img');
			  }
		  }
		  
	  });
	}
	catch(err) {
	    console.log(err);
	}
	/*OWL CAROUSEL*/
	try{
		
		jQuery('.featured-product').owlCarousel({
		    loop:true,
		    margin:10,
		    nav:true,
		    navText: ["<i class='fa fa-long-arrow-left fa-2x'></i>","<i class='fa fa-long-arrow-right fa-2x'></i>"],
		    responsive:{
		        0:{
		            items:1
		        },
		        600:{
		            items:3
		        },
		        1000:{
		            items:5
		        }
		    }
		})
	}
	catch(err){
		//console.log("Owl Carousel")
	}
	/*jQuery('.manual2').magnificPopup({
      type: 'image',
      closeOnContentClick: true,
      mainClass: 'mfp-img-mobile',
      image: {
        verticalFit: true
      }
      
    });*/	

});