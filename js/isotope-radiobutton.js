//ISOTOPE SETTINGS for furniture page

jQuery(function ($) {

	// var $container = $('#isotope-container');

	var $isotopeposts = $('#isotope-container').isotope({ 
		itemSelector : '.item', 
  		layoutMode : 'masonry',
  		masonry: {
          //columnWidth: 300, //each column is 300px wide
          gutter: 20, //10px space between each column
          fitWidth: true  //center the isotope container in the browser
        }
	});

	// layout Isotope again after all images have loaded to avoid image overlaps
    $isotopeposts.imagesLoaded( function() {
        $isotopeposts.isotope('layout');
    });


// store filter for each group
var filters = {};

$('.isotope-navigation').on( 'click', '.button', function() {
  var $this = $(this);
  // get group key
  var $buttonGroup = $this.parents('.button-group');
  var filterGroup = $buttonGroup.attr('data-filter-group');
  // set filter for group
  filters[ filterGroup ] = $this.attr('data-filter');
  // combine filters
  var filterValue = concatValues( filters );
  // set filter for Isotope
  $isotopeposts.isotope({ filter: filterValue });
});

// flatten object by concatting values
function concatValues( obj ) {
  var value = '';
  for ( var prop in obj ) {
    value += obj[ prop ];
  }
  return value;
}

// Clear all selections
// $('.sort-clear .clear-all').on('click', function() {
// 	$isotopeposts.isotope({ filter: '*' });
// });

// change .checked class on buttons
$('.button-group').each( function( i, buttonGroup ) {

	var $buttonGroup = $( buttonGroup );

	// look for the button that is clicked and add a .checked class
	$buttonGroup.on( 'click', 'button', function() {
	$buttonGroup.find('.checked').removeClass('checked');
	$( this ).addClass('checked');
	});

	// when "Clear all" button is clicked, clear all the .checked class
	// $('.sort-clear .clear-all').on('click', function() {
	// 	$buttonGroup.find('.checked').removeClass('checked');
	// });

});

});