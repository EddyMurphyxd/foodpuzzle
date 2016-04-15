;(function($) {
  $(function() {
    var _win = $(window),
        _winHeight = _win.innerHeight(),
        _winWidth = _win.width();

    setCarouselHeight();
    customizeCarousel();
    preventNegative();
    inputNumberArrows();

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

    function preventNegative() {
      var inputNumber = $('input[type="number"]');

      inputNumber
        .keydown(function(e) {
          if(!((e.keyCode > 95 && e.keyCode < 106)
            || (e.keyCode > 47 && e.keyCode < 58) 
            || e.keyCode == 8)) {
              return false;
          }
        })
        .blur(function() {
          var self = $(this),
              value = self.val();

          if (value <= 0) {
            self.val(1);
          }
        });
    }

    function inputNumberArrows() {
      $('.product-quantity').each(function() {
        var wrapper = $(this),
            input   = wrapper.find('input.qty');

        wrapper.find('.minus').click(function() {
          var currentVal = parseInt(input.val());

          if (currentVal > 1) {
            input.val(currentVal - 1);
          }
        });

        wrapper.find('.plus').click(function() {
          var currentVal = parseInt(input.val());

          input.val(currentVal + 1);
        });
      });
    }
  });
})(jQuery);