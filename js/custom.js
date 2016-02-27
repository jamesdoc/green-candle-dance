
/*	Mav - Custom.js
------------------------------------------------------------------------------- */

jQuery.noConflict();

jQuery(document).ready(function($) {


/*	Portfolio item overlay effect
------------------------------------------------------------------------------- */

	function thumbnail_overlay() {

		jQuery('.portfolio-thumbnail a, .related-thumb a, .latest-thumb-home a, .portfolio-thumbnail-no-lightbox a').hover(function () {	// .custom-content-widget a
				jQuery(this).find('.overlay').stop().animate({ opacity : 1 }, 300);	// mav
//				$(this).find('.overlay').fadeIn('normal');	// original script - ajaxdump
//				jQuery(this).find('.overlay').stop().fadeTo('normal', 1);	// ajaxdump
			},
			function () {
				jQuery(this).find('.overlay').stop().animate({ opacity : 0 }, 300);
//				$(this).find('.overlay').fadeOut('normal');
//				jQuery(this).find('.overlay').stop().fadeTo('normal', 0);
			}
		);
	}

	thumbnail_overlay();



/*	Superfish
------------------------------------------------------------------------------- */

//	$('#access ul').superfish();		// Call superfish() on the containing ul element

	$('#access ul').superfish({
		delay: 100,						// one second delay on mouseout
    	animation: {opacity:'show'},	// an object equivalent to first parameter of jQuery’s .animate() method
		speed: 'fast',					// faster animation speed
		dropShadows: false,				// completely disable drop shadows by setting this to false
		autoArrows: true				// if true, arrow mark-up generated automatically = cleaner source code at expense of initialisation performance
	}); 



/*	Contact Form validation
------------------------------------------------------------------------------- */

	$("#contactForm").validate();



/*	PrettyPhoto - http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/
------------------------------------------------------------------------------- */

	function prettyphoto_function() {

//		$(document).ready(function(){
			$("a[data-rel^='prettyPhoto']").prettyPhoto({
				theme: 'pp_default',
				opacity: 0.90, /* Value between 0 and 1 */
				show_title: false, /* true/false */
				social_tools: false, /* html or false to disable */
				default_width: 700,
				default_height: 400
			});
//		});
	}

	prettyphoto_function();



/*	Portfolio filter
------------------------------------------------------------------------------- */

	$clientsHolder = $('ul.portfolio-list'); // get original list
	$clientsClone = $clientsHolder.clone(); // clone it so it can be reverted back to
	
	$('.portfolio-filter a').click(function(e) {
		e.preventDefault(); // stop anchor tags from doing anything
		//alert($(this).attr('href'));

		$filterClass = $(this).attr('class'); // gets class from clicked anchor
		
		$('.portfolio-filter li').removeClass('active'); // remove active class from all filter links
		$(this).parent().addClass('active'); // add active class to clicked link
		
		if($filterClass == 'all'){
			$filters = $clientsClone.find('li'); // get all li's from original cloned list and assign them to variable
		} else {
			$filters = $clientsClone.find('li[data-type~='+ $filterClass +']'); // get li's from ul.source with data-type containing $filterclass
		}

		$clientsHolder.quicksand($filters, {
			duration: 800,
			adjustHeight: 'dynamic',
			enhancement: function() { // callback function
				thumbnail_overlay();
				prettyphoto_function();
			}
		}

		); // initiate quicksand fn

	});



/*	Slider
------------------------------------------------------------------------------- 

	$(window).load(function() {
		$('#slider').nivoSlider({
			effect: 'random', // Specify sets like: ' fold, fade, sliceDown, etc..'
        	slices:15, // For slice animations
        	boxCols: 8, // For box animations
        	boxRows: 4, // For box animations
        	animSpeed:500, // Slide transition speed
        	pauseTime:3000, // How long each slide will show
        	startSlide:0, // Set starting Slide (0 index)
        	directionNav:true, // Next & Prev navigation
        	directionNavHide:true, // Only show on hover
        	controlNav:true, // 1,2,3... navigation
        	controlNavThumbs:false, // Use thumbnails for Control Nav
        	controlNavThumbsFromRel:false, // Use image rel for thumbs
        	controlNavThumbsSearch: '.jpg', // Replace this with...
        	controlNavThumbsReplace: '_thumb.jpg', // ...this in thumb Image src
        	keyboardNav:true, // Use left & right arrows
        	pauseOnHover:true, // Stop animation while hovering
        	manualAdvance:false, // Force manual transitions
        	captionOpacity:0.8, // Universal caption opacity
        	prevText: 'Prev', // Prev directionNav text
        	nextText: 'Next', // Next directionNav text
        	beforeChange: function(){}, // Triggers before a slide transition
        	afterChange: function(){}, // Triggers after a slide transition
        	slideshowEnd: function(){}, // Triggers after all slides have been shown
        	lastSlide: function(){}, // Triggers when last slide is shown
        	afterLoad: function(){} // Triggers when slider has loaded
		});
	});
*/


/*	w3c 'rel' attribute
------------------------------------------------------------------------------- */
	
	jQuery('a[data-rel]').each(function() {
		jQuery(this).attr('rel', jQuery(this).data('rel'));
	});



/*	SHORTCODES - TABS
------------------------------------------------------------------------------- */

	$(".tab_content").hide();
	$("ul.tabs li:first").addClass("active").show();
	$(".tab_content:first").show();
	
	$("ul.tabs li").click(function() {
	
		$("ul.tabs li").removeClass("active");
		$(".tab_content").hide();
		$(this).addClass("active");
		var tabNum = ($(this).find("a").attr("href")).replace('#tab', '');
		$(this).parent().next().find("div:nth-child(" + tabNum + ")").fadeIn();

		return false;
	});




/*	SHORTCODES - TOGGLE
------------------------------------------------------------------------------- */

	$("h3.toggle").click(function() {
		$(this).toggleClass("active").next(".toggle_container").slideToggle("fast");
	});





/* ------------------------------------------------------------------------------- */


});






