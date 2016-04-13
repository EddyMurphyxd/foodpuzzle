;(function($) {
  $(function() {
    var _win = $(window),
        _winHeight = _win.innerHeight(),
        _winWidth = _win.width();

    setCarouselHeight();
    customizeCarousel();

    function setCarouselHeight() {
      $('.owl-carousel, .owl-carousel .item img').height(_winHeight);
    }

    function customizeCarousel() {
      var owl = $('.owl-carousel');

      var activeItem = owl.find('.owl-item.active');

      activeItem.addClass('scale');

      owl.on('changed.owl.carousel', function(event) {
        var items = owl.find('.owl-item');
        
        setTimeout(function() {
          var activeItemChanged = owl.find('.owl-item.active');

          items.removeClass('scale');
          activeItemChanged.addClass('scale');
        }, 100);
      });
    }
  });
})(jQuery);