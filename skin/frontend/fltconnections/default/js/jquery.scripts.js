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
			lazyLoad:true,
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
	try{
		
		jQuery('.latest-product').owlCarousel({
			lazyLoad:true,
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
	//jQuery('[data-toggle="tooltip"]').tooltip()
	jQuery('[data-toggle="tooltip"]').tooltip();          
    jQuery('[data-toggle="tooltip"]').on("hidden.bs.tooltip", 
     function() { 
       jQuery(this).css("display", "");
     });
	/*Layer Nav*/	
	jQuery('.layer-filter-icon, .close-mobile-layer, .close-layer').click(function(event) { 
        if(!jQuery('body').hasClass('mobile-layer-shown')) {
            jQuery('body').addClass('mobile-layer-shown', function() { 
                setTimeout(function(){
                    jQuery(document).one("click",function(e) {
                        var target = e.target;
                        if (!jQuery(target).is('.block-main-layer .block') && !jQuery(target).parents().is('.block-main-layer .block')) {
                                    jQuery('body').removeClass('mobile-layer-shown');
                        }
                    });  
                }, 111);
            });
        } else{
            jQuery('body').removeClass('mobile-layer-shown');
        }
    });
    /*Layer Nav Accordian*/
    jQuery(".block-layered-nav dt").click(function(){
        if(jQuery(this).next("dd").css("display") == "none"){
            jQuery(this).next("dd").slideDown(200);
            jQuery(this).removeClass("closed");
        } else {
            jQuery(this).next("dd").slideUp(200);
            jQuery(this).addClass("closed");
        }
    });     

});