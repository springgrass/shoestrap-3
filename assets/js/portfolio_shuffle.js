
var Exports = {
  Modules : {}
};

Exports.Modules.PortfolioGallery = (function($, undefined) {
  var $grid,
  $sizer,

  // Using shuffle with specific column widths
  columnWidths = {
    1170: 70,
    940: 60,
    724: 42
  },
  gutterWidths = {
    1170: 30,
    940: 20,
    724: 20
  },

  init = function() {
    setVars();
    initFilters();
    initShuffle();
  },

  setVars = function() {
    $grid = $('.portfolio-grid');
    $filterOptions = $('.portfolio-category-controls');
	//$sizer = $('.portfolio-item');
  },

  initShuffle = function() {
    // instantiate the plugin
    $grid.shuffle({
      speed : 250,
      easing : 'cubic-bezier(0.165, 0.840, 0.440, 1.000)', // easeOutQuart
	 sizer: $sizer
     /*   columnWidth: function( containerWidth ) {
        var colW = columnWidths[ containerWidth ];

        // Default to container width
        if ( colW === undefined ) {
          colW = containerWidth;
        }
		console.log('colW:' . colW);
        return colW;
      },
      gutterWidth: function( containerWidth ) {
        var gutter = gutterWidths[ containerWidth ];

        // Default to zero
        if ( gutter === undefined ) {
          gutter = 0;
        }
        return gutter;
      }*/
	  
    });
  },

    // Set up button clicks
  initFilters = function() {
    var $btns = $filterOptions.children();
    $btns.on('click', function() {
      var $this = $(this),
          isActive = $this.hasClass( 'active' ),
          group = isActive ? 'all' : $this.data('group');

      // Hide current label, show current label in title
      if ( !isActive ) {
        $filterOptions.find('.active').removeClass('active');
      }

      $this.toggleClass('active');

      // Filter elements
      $grid.shuffle( 'shuffle', group );
    });
	

    $btns = null;
  },
  
  // Re layout shuffle when images load. This is only needed
  // below 768 pixels because the .picture-item height is auto and therefore
  // the height of the picture-item is dependent on the image
  // I recommend using imagesloaded to determine when an image is loaded
  // but that doesn't support IE7
  listen = function() {
    var debouncedLayout = $.throttle( 300, function() {
      $grid.shuffle('update');
    });

    // Get all images inside shuffle
    $grid.find('img').each(function() {
      var proxyImage;

      // Image already loaded
      if ( this.complete && this.naturalWidth !== undefined ) {
        return;
      }

      // If none of the checks above matched, simulate loading on detached element.
      proxyImage = new Image();
      $( proxyImage ).on('load', function() {
        $(this).off('load');
        debouncedLayout();
      });

      proxyImage.src = this.src;
    });

    // Because this method doesn't seem to be perfect.
    setTimeout(function() {
      debouncedLayout();
    }, 500);
  };

  // arrayContainsArray = function(arrToTest, requiredArr) {
  //   var i = 0,
  //   dictionary = {},
  //   j;

  //   // Convert groups into object which we can test the keys
  //   for (j = 0; j < arrToTest.length; j++) {
  //     dictionary[ arrToTest[j] ] = true;
  //   }

  //   // Loop through selected shapes, if that feature is not in this elements groups, return false
  //   for (; i < requiredArr.length; i++) {
  //     if ( dictionary[ requiredArr[i] ] === undefined ) {
  //       return false;
  //     }
  //   }
  //   return true;
  // };

  return {
    init: init
  };
}(jQuery));



$(document).ready(function() {
  Exports.Modules.PortfolioGallery.init();
});
