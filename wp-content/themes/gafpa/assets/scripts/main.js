$(function() {

   // Navbar dropdown hover on desktop, click on mobile
   if ($(window).width() < 989) {
      var nb = {
         menu : $('.navbar .menu-item.menu-item-has-children > a'),
           init : function() {
               this.menu.on('click', this.clickHandler);
           },
           clickHandler : function(e) {
             console.log('here');
               e.preventDefault();
               var me = $(e.target),
                   child = me.parent().find('.dropdown-menu'),
               wasOpen = child.hasClass('mobile-visible');
            nb.closeMenus();
            if(wasOpen === false) {
                  child.addClass('mobile-visible');
            }
           },
           closeMenus : function() {
               this.menu.each(function() {
                   var me = $(this).parent();
                   me.find('.dropdown-menu').removeClass('mobile-visible');
                   //me.removeClass('current-page-parent');
               });
           }
       };
       nb.init();
    }

   //Smooth scroll click handler
   $('a[href*=\\#]').on('click', function(event){
       event.preventDefault();
       $('html,body').animate({scrollTop:($(this.hash).offset().top - 70)}, 1000);
   });

   // Hero image horizontal positioning
   $('.fc-hero').each(function() {
      var focalPoint = $(this).attr('image-x');
      $(this).css('background-position', focalPoint + '% 50%');
   });

   // Hero content horizontal and vertical positioning
   $(window).resize(function() {
      $('.fc-hero .arrow-down').each(function() {
         var heroHeight = $(this).parent().height();
         $(this).css('top', (heroHeight - 100) + 'px');
      });

      var heroHeight = $('.fc-hero').first().height();
      if (heroHeight > 747) {
         $('.menu, .contact').css('height', heroHeight + 'px');
      }

      $('.hero-content').each(function() {
         var leftPercentage;
         var topPercentage;
         $(this).removeClass("heading-style-1 heading-style-2 heading-style-3 heading-style-4");
         if ($(window).width() < 767) {
            leftPercentage = $(this).attr('phone-x');
            topPercentage = $(this).attr('phone-y');
            $(this).addClass($(this).attr('phone-style'));
         } else if ($(window).width() < 989) {
            leftPercentage = $(this).attr('tablet-x');
            topPercentage = $(this).attr('tablet-y');
            $(this).addClass($(this).attr('tablet-style'));
         } else if ($(window).width() < 1200) {
            leftPercentage = $(this).attr('desktop-x');
            topPercentage = $(this).attr('desktop-y');
            $(this).addClass($(this).attr('desktop-style'));
         } else {
            leftPercentage = $(this).attr('large-x');
            topPercentage = $(this).attr('large-y');
            $(this).addClass($(this).attr('large-style'));
         }

         var contentHeight = $(this).height();
         var contentWidth = $(this).width();
         var heroHeight = $(this).parent().height();
         var heroWidth = $(this).parent().width();
         var left = (heroWidth * (leftPercentage / 100.0)) - (contentWidth / 2);
         var top = (heroHeight * (topPercentage / 100.0)) - (contentHeight / 2);

         (left > heroWidth - contentWidth) && (left = heroWidth - contentWidth);
         (left < 0) && (left = 0);
         (top > heroHeight - contentHeight) && (top = heroHeight - contentHeight);
         (top < 0) && (top = 0);

         $(this).css({'top': top + 'px', 'left': left + 'px'});
         $(this).fadeIn();
      });
   });
   $(window).resize();

   // Slick slider
   $('.slick-slider').each(function() {
      var centerMode = $(this).attr('alignment') === "true";
      var infinite = $(this).attr('infinite') === "true";
      $(this).slick({
         prevArrow: '<img class="slick-prev-arrow" src="/wp-content/themes/gafpa/assets/images/arrow-left.svg">',
         nextArrow: '<img class="slick-next-arrow" src="/wp-content/themes/gafpa/assets/images/arrow-right.svg">',
         infinite: infinite,
         speed: 1000,
         easing: 'easeinout',
         slidesToShow: 1,
         centerMode: centerMode,
         variableWidth: true
      });
   });

   $('.color-style-dropdown').change(function() {
      $(this).parent().removeClass(function(index, classes) {
         var expression = new RegExp('(^|\\s)' + 'color-style' + '-\\S+', 'g');
         return (classes.match(expression) || []).join(' ');
      });
      $(this).parent().addClass('color-style-' + $(this).val());
   });

   //toggle color style dropdowns on ctrl+;
   $(document).keypress(function(event) {
      if ((event.which == 58 || event.which == 59) && (event.ctrlKey||event.metaKey)|| (event.which == 19)) {
         event.preventDefault();
         $('.color-style-dropdown').toggle();
         return false;
      }
      return true;
   });

   //scroll arrows
   $('.arrow-up').on('click', function() {
      $("html, body").animate({ scrollTop: 0 }, "slow");
   });

   $('.arrow-down').on('click', function() {
      $("html, body").animate({ scrollTop: 500 }, 1000);
   });

   //menu open/close
   $('.menu-button').on('click', function() {
      var mobile = $('.menu').css('top') == '-25px';
      $('.menu').animate({left: "0", opacity: '1'}, 'fast');
      $('.menu-button, .logo').animate({left: "-280px", opacity: '0'}, 'slow');
      if (mobile) {
         $('body, html').css('overflow', 'hidden');
      }
   });
   $('.menu .close-button').on('click', function() {
      var mobile = $('.menu').css('top') == '-25px';
      mobile ? $('.menu').animate({left: "-767px", opacity: '0'}) : $('.menu').animate({left: "-380px", opacity: '0'});
      $('.menu-button').animate({left: "0px", opacity: '1'});
      $('.logo').animate({left: "100px", opacity: '1'});
      $('body, html').css('overflow', 'initial');
   });

   //contact open/close
   $('.contact-button').on('click', function() {
      $('.contact').animate({right: "0", opacity: '1'}, 'slow');
      $('.contact-button').animate({right: "-380px", opacity: '0'});
   });
   $('.contact .close-button').on('click', function() {
      var mobile = $('.menu').css('top') == '-25px';
      mobile ? $('.contact').animate({right: "-767px", opacity: '0'}) : $('.contact').animate({right: "-380px", opacity: '0'});
      $('.contact-button').animate({right: "0px", opacity: '1'});
   });

   if ($('.validation_error').length) {
      $('.contact').animate({right: "0", opacity: '1'});
      $('.contact-button').animate({right: "-380px", opacity: '0'});
   }

   if ($('.gform_confirmation_message_5').length) {
      $('.contact').animate({right: "0", opacity: '1'});
      $('.contact-button').animate({right: "-380px", opacity: '0'});
      $('.contact h3, .contact p').animate({opacity: '0'});
   }

   $('#menu-item-1687').on('click', function(e) {
      e.preventDefault();
      if ($('.contact-button').css('opacity') == 0) {
         $('.contact .close-button').click();
      }
      $('.contact-button').click();
      $('.menu .close-button').click();
   });
});