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


function show_site_title(){
  $(this).closest('div').find('p.site-title').css('bottom', '-3.5em');
}
function hide_site_title(){
  $(this).closest('div').find('p.site-title').css('bottom', '0em');
}

function activate_home_offering(){
  $(this).closest('div').find('i').css('top', '-20px');
}

function deactivate_home_offering(){
  $(this).closest('div').find('i').css('top', '0px');
}

$(document).ready( function()	{
  // $('#main').smoothState();
  if(!navigator.userAgent.match(/MSIE 8/)){
    var $body = $('html, body'),
    content = $('#main').smoothState({
      // Runs when a link has been activated
      prefetch: true,
      blacklist: ".project-screenshot a, a.blog-link",
      onStart: {
        duration: 250, // Duration of our animation
        render: function (url, $container) {
          // toggleAnimationClass() is a public method for restarting css animations with a class
          content.toggleAnimationClass('is-exiting');
          // Scroll user to the top
          $body.animate({ scrollTop: 0 });
        }
      }
    }).data('smoothState');
    //.data('smoothState') makes public methods available

    $(".typed .light-orange").empty();
    $(".typed .light-orange").typed({
      strings: ["Tea Enthusiast", "Dog Lover", "Developer"],
      typeSpeed: 30,
    });
  }

  if(Modernizr.mq('screen and (min-width: 876px)') && !navigator.userAgent.match(/MSIE 8/)){
    var s = skrollr.init();
  }

  if($('.header-content-wrapper').length > 0){
    if($('html').hasClass('lt-ie9') || Modernizr.mq('screen and (min-width: 876px)')){
      $('.sticky').removeClass('affixed');
      $('.sticky').removeClass('mini');

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

      $('.home-offerings').find('a').hover(activate_home_offering, deactivate_home_offering);
      $('.home-offerings').find('a').focus(activate_home_offering);
      $('.home-offerings').find('a').blur(deactivate_home_offering);

      $('a.project-hover').hover(show_site_title, hide_site_title);
      $('a.project-hover').focus(show_site_title);
      $('a.project-hover').blur(hide_site_title);

    }else{
      $('.sticky').addClass('affixed');
      $('.sticky').addClass('mini');
    }
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
