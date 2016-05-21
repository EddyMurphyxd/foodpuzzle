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
    $('.single-product .quantity input').val(1);

    if (!$('body').hasClass('home-page')) stickyHeader();

    $('.wc-tab#tab-description').show();
    $('.description_tab').addClass('active');

    $('.concept-image-teaser .text *').addClass('animated fadeInLeft');

    $('nav.categories-list').mmenu({
      // options
    }, {
      // configuration
      offCanvas: {
        pageSelector: "#wrapper"
      }
    });

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

    (function() {
      $('.text-center > ul > li').click(function() {
        var self = $(this);

        self.toggleClass('active');
      });
    })();

    (function() {
      var modal = $('.modal-popup');

      modal.addClass('loaded');
      
      modal.find('.close').click(function() {
        modal.removeClass('loaded');
      });

      modal.find('form').submit(function(event) {
        event.preventDefault();

        var formData = {
          email: $('input[name="potential-customer"]').val()
        };

        var url = $(this).attr('action');

        $.ajax({
          url: url,
          type: 'post',
          dataType: 'json',
          data: formData,
          error: function(error) {
            console.log(error);
          },
          success: function(data) {
            modal.find('p').remove();
            modal.find('input').remove();
            modal.find('h3').text('Дякуємо!');
            
            setTimeout(function() {
              modal.removeClass('loaded');
            }, 600);
          }
        });
      });
    })();

    function setItemsHeight() {
      $('.owl-carousel, .owl-carousel .item').height(_winHeight);
      $('.single-product .images').height(_winHeight);
      $('.concept-image-teaser').height(_winHeight);
      $('.single-product .summary').css('margin-top',  _winHeight - 40);
      $('.concept-image-teaser + .container .additional-content').css('margin-top',  _winHeight - 40);
    }

    function customizeCarousel() {
      var owl = $('.owl-carousel');
      var owlHome = $('.home-page .owl-carousel');

      var activeItem = owlHome.find('.owl-item.active');

      activeItem.addClass('scale').find('.owl-carousel-item-imgoverlay span').addClass('animated fadeIn');

      owlHome.on('changed.owl.carousel', function(event) {
        var items   = owlHome.find('.owl-item'),
            teasers = items.find('.owl-carousel-item-imgoverlay span');
        
        setTimeout(function() {
          var activeItemChanged = owlHome.find('.owl-item.active'),
              teasersChanged    = activeItemChanged.find('.owl-carousel-item-imgoverlay span');

          items.removeClass('scale');
          teasers.removeClass('animated fadeIn');

          activeItemChanged.addClass('scale');
          teasersChanged.addClass('animated fadeIn');
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
            priceWrap = wrapper.parents('.summary').find('div[itemprop="offers"] ins'),
            regWrap   = wrapper.parents('.summary').find('div[itemprop="offers"] del .amount'),
            regPrice  = regWrap,
            price     = priceWrap;

        var currentVal = 1;

        var priceArr    = price.text(),
            priceStr    = priceArr.slice(priceArr.length - 2, priceArr.length),
            priceInt    = parseInt($('p.price').data('price')),
            regPriceInt = parseInt($('p.price').data('regular-price'));

        function updateValues() {
          var newPrice    = priceInt * currentVal,
              newRegPrice = regPriceInt * currentVal;

          price.text(newPrice + '' + priceStr);
          regPrice.text(newRegPrice + '' + priceStr);
        }

        wrapper.find('.minus').click(function() {
          currentVal = parseInt(input.val());

          if (currentVal > 1) {
            currentVal--;

            input.val(currentVal);

            updateValues();
          }
        });

        wrapper.find('.plus').click(function() {
          currentVal = parseInt(input.val());

          currentVal++;

          input.val(currentVal);
          
          updateValues();
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