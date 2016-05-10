;(function($) {
  new WOW().init();

  $(function() {
    var _win = $(window),
        _winHeight = _win.innerHeight(),
        _winWidth = _win.width();

    setItemsHeight();
    customizeCarousel();
    preventNegative();
    inputNumberArrows();
    setFullWidth($('.ingridients-image-wrapper'));

    $('.single-product .quantity').addClass('wow slideInRight');

    if (!$('body').hasClass('home-page')) stickyHeader();

    $('.wc-tab#tab-description').show();
    $('.description_tab').addClass('active');

    $('.concept-image-teaser .text *').addClass('animated fadeInLeft');

    $('nav.categories-list').mmenu();

    _win.load(function() {
      $('body.shop').addClass('loaded').pandaFilter({
        sorting: false,
        rowItems: false,
        fancyRowItems: true,
        singleCategory: true
      });

      setTimeout(function() {
        $('.preloader-wrapper').remove();
      }, 700);
    });

    function setItemsHeight() {
      $('.owl-carousel, .owl-carousel .item img').height(_winHeight);
      $('.single-product .images').height(_winHeight);
      $('.concept-image-teaser').height(_winHeight);
      $('.single-product .summary').css('margin-top',  _winHeight - 40);
      $('.concept-image-teaser + .container .additional-content').css('margin-top',  _winHeight - 40);
    }

    function customizeCarousel() {
      var owl = $('.owl-carousel');
      var owlHome = $('.home-page .owl-carousel');

      var activeItem = owlHome.find('.owl-item.active');

      activeItem.addClass('scale').find('.owl-carousel-item-imgoverlay span').addClass('animated fadeInLeft');

      owlHome.on('changed.owl.carousel', function(event) {
        var items   = owlHome.find('.owl-item'),
            teasers = items.find('.owl-carousel-item-imgoverlay span');
        
        setTimeout(function() {
          var activeItemChanged = owlHome.find('.owl-item.active'),
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
      $('.quantity').each(function() {
        var wrapper   = $(this),
            input     = wrapper.find('input.qty'),
            miniPrice = wrapper.parents('.summary').find('div[itemprop="offers"] .amount');

        var priceArr = miniPrice.text(),
            priceStr = priceArr.slice(priceArr.length - 2, priceArr.length),
            priceInt = parseInt(priceArr.slice(0, priceArr.length - 2)),
            tempPrice = priceInt;

        function refreshValues() {
          priceArr = miniPrice.text(),
          priceStr = priceArr.slice(priceArr.length - 2, priceArr.length),
          priceInt = parseInt(priceArr.slice(0, priceArr.length - 2));
        }

        wrapper.find('.minus').click(function() {
          var currentVal = parseInt(input.val());

          if (currentVal > 1) {
            input.val(currentVal - 1);

            var newPriceInt = Math.abs(tempPrice - priceInt);

            miniPrice.text(newPriceInt + ' ' + priceStr);

            refreshValues();
          }
        });

        wrapper.find('.plus').click(function() {
          var currentVal = parseInt(input.val());

          input.val(currentVal + 1);

          var newPriceInt = tempPrice + priceInt;

          miniPrice.text(newPriceInt + ' ' + priceStr);

          refreshValues();
        });
      });
    }

    function stickyHeader() {
      var lastScrollTop = 0,
          header        = $('.main-header'),
          main          = $('main'),
          navigation    = $('.main-navigation'),
          headerHeight  = navigation.outerHeight();

      _win.scroll(function() {
        var scrollTop = $(this).scrollTop();
        
        if (scrollTop > lastScrollTop) {
          if (scrollTop > headerHeight) {
            header.addClass('hidden-header');
            main.addClass('hidden-header');
          }
        } else {
          if (scrollTop <= headerHeight) {
            header.removeClass('hidden-header');
            main.removeClass('hidden-header');
          }
        }

        lastScrollTop = scrollTop;
      });
    }

    function setFullWidth(element) {
      var _winWidth = _win.width(),
          containerWidth = $('.container').width(),
          marg  = (_winWidth - containerWidth) / 2;

      element.css({
        "margin-left": -marg,
        "margin-right": -marg
      });
    }
  });
})(jQuery);