//Artwork Page
jQuery(function ($) {

	$('.gallery').isotope({
	  // options
	  itemSelector: '.art',
	  layoutMode: 'masonry',
	  masonry: {
          columnWidth: 300,
          gutter: 20,
          fitWidth: true
        }
	});
});