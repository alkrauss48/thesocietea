/* Fake placeholder support in browsers that do not support the HTML input placeholder attribute. Ideally this would be paired with a javascript function that prevents form submit if the a given input's value is equivalent to the placeholder attribute. */
/*
function initPlaceholderSupport() {
    if( ! Modernizr.input.placeholder ) {
        $('[placeholder]').focus(function() {
          var input = $(this);
          if (input.val() == input.attr('placeholder')) {
            input.val('');
            input.removeClass('placeholder');
          }
        }).blur(function() {
          var input = $(this);
          if (input.val() == '' || input.val() == input.attr('placeholder')) {
            input.addClass('placeholder');
            input.val(input.attr('placeholder'));
          }
        }).blur();
    }
}

initPlaceholderSupport();
*/

/* smooth scroll */
/*
$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1500);
        return false;
      }
    }
  });
});
*/

$(document).ready( function()	{
  if(Modernizr.mq('screen and (min-width: 876px)')){
    var s = skrollr.init();
  }

  if($('.header-content-wrapper').length > 0){
    if(Modernizr.mq('screen and (min-width: 876px)')){
      $(window).on('scroll', function(){
        if(window.pageYOffset + 70 > parseInt($('.header-content-wrapper').css('height'))){
          $('.sticky').addClass('affixed');
        }else{
          $('.sticky').removeClass('affixed');
        }

        if(window.pageYOffset + 50 > parseInt($('.header-content-wrapper').css('height'))){
          $('.sticky').addClass('mini');
        }else{
          $('.sticky').removeClass('mini');
        }
      });

      $('.home-offerings').find('a').hover(function(){
        $(this).closest('div').find('i').css('top', '-20px');
      },function(){
        $(this).closest('div').find('i').css('top', '0px');
      });

      $('a.project-hover').hover(function(){
        $(this).closest('div').find('a.site-title').css('bottom', '-3.5em');
      },function(){
        $(this).closest('div').find('a.site-title').css('bottom', '0em');
      });
    }else{
      $('.sticky').addClass('affixed');
      $('.sticky').addClass('mini');
    }

    $(".typed .light-orange").typed({
      strings: ["Tea Enthusiast", "Dog Lover", "Developer"],
      typeSpeed: 30,
    });
  }else{
    $('.sticky').addClass('affixed');
    $('.sticky').addClass('mini');
  }

  if($('.project-screenshot')){
    $('.project-screenshot').magnificPopup({
      delegate: 'a', // child items selector, by clicking on it popup will open
      type: 'image',
      // other options
      gallery: {
        enabled: true
      }
    });
  }
});
