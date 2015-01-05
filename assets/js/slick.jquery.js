(function($) {
  Drupal.behaviors.slickSlideshows = {
    attach: function(context, settings) {
      $('.slick-slider').slick();
    }
  };
})(jQuery);