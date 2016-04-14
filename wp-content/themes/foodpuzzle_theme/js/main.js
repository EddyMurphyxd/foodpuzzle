;(function($) {
  $(function() {
    var _win = $(window),
        _winHeight = _win.innerHeight(),
        _winWidth = _win.width();

    setCarouselHeight();
    customizeCarousel();

    _win.load(function() {
      $('.filter-wrapper').pandaFilter({
        sorting: false
      });
    });

    function setCarouselHeight() {
      $('.owl-carousel, .owl-carousel .item img').height(_winHeight);
    }

    function customizeCarousel() {
      var owl = $('.owl-carousel');

      var activeItem = owl.find('.owl-item.active');

      activeItem.addClass('scale').find('.owl-carousel-item-imgoverlay span').addClass('animated fadeInLeft');

      owl.on('changed.owl.carousel', function(event) {
        var items   = owl.find('.owl-item'),
            teasers = items.find('.owl-carousel-item-imgoverlay span');
        
        setTimeout(function() {
          var activeItemChanged = owl.find('.owl-item.active'),
              teasersChanged    = activeItemChanged.find('.owl-carousel-item-imgoverlay span');

          items.removeClass('scale');
          teasers.removeClass('animated fadeInLeft');

          activeItemChanged.addClass('scale');
          teasersChanged.addClass('animated fadeInLeft');
        }, 100);
      });
    }
  });
})(jQuery);