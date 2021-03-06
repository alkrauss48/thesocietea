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
var skrollrInstance;

var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};

function bindLightbox(){
  if($('.project-screenshot')){
    $('.project-screenshot').magnificPopup({
      delegate: 'a', // child items selector, by clicking on it popup will open
      type: 'image',
      gallery: {
        enabled: true
      }
    });
  }
}

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

function bindFocusToSubmenu(){
  $(this).closest('.sub-menu').addClass('is-active');
}

function bindBlurToSubmenu(){
  $(this).closest('.sub-menu').removeClass('is-active');
}

function isotopeLogic(){
  $('.blog-list').isotope({
    itemSelector: '.blog-item',
    layoutMode: 'fitRows'
  });
}

function filterBlogs(event) {
  event.preventDefault();

  $('.blog-list').isotope({ filter: $(this).data('filter') })
  $('.blog-filter__list-item').removeClass('blog-filter__list-item--is-active');
  $(this).addClass('blog-filter__list-item--is-active');
  if(skrollrInstance) {
    skrollrInstance.refresh()
  }
}

function setUpInfiniteScroll() {
  $('.blog-list').infinitescroll({
    navSelector  : ".post-navigation",
    nextSelector : ".post-navigation .next",
    itemSelector : ".blog-item",
    loading: {
      finishedMsg: "That's it!",
      img: "/assets/images/dist/loading-squares.gif",
      msgText: ""
    }
  }, function(newElements) {
    var $newElems = $(newElements);
    // var $newElems = $(newElements).hide();
    // $newElems.fadeIn();
    $('.blog-list').isotope('appended', $newElems);
    if(skrollrInstance) {
      skrollrInstance.refresh()
    }
  });
}

$(document).ready( function()	{
  // $('#main').smoothState();
  if(!navigator.userAgent.match(/MSIE 8/)){
    var $body = $('html, body'),
    content = $('#main').smoothState({
      // Runs when a link has been activated
      prefetch: true,
      pageCacheSize: 5,
      blacklist: ".project-screenshot a, a.blog-item, .entry-content a",
      onStart: {
        duration: 250, // Duration of our animation
        render: function (url, $container) {
          // toggleAnimationClass() is a public method for restarting css animations with a class
          content.toggleAnimationClass('is-exiting');
          // Scroll user to the top
          $body.animate({ scrollTop: 0 });
        }
      },
      callback : function(url, $container, $content) {
        bindLightbox();
      }
    }).data('smoothState');
    //.data('smoothState') makes public methods available

    $(".typed span").empty();
    $(".typed span").typed({
      strings: [
        "Tea Enthusiast",
        "Longboarder",
        "Blogger",
        "Developer"
      ],
      contentType: 'html',
      typeSpeed: 30,
    });
  }

  $('.sub-menu').on('focus', 'a', bindFocusToSubmenu);
  $('.sub-menu').on('blur', 'a', bindBlurToSubmenu);

  if(!isMobile.any() && !navigator.userAgent.match(/MSIE 8/)){
    skrollrInstance = skrollr.init();
  }else{
    if($('#about').length != 0){
      $('#about').hide();
      $('#about-responsive').show();
    }
  }

  if($('.header-content-wrapper').length > 0){
    if($('html').hasClass('ie8') || Modernizr.mq('screen and (min-width: 876px)')){
      $('.sticky').removeClass('affixed');
      $('.sticky').removeClass('mini');

      $(window).on('scroll', function(){
        if(window.pageYOffset + 55 > parseInt($('.header-content-wrapper').css('height'))){
          $('.sticky').addClass('affixed');
        }else{
          $('.sticky').removeClass('affixed');
        }

        if(window.pageYOffset + 30 > parseInt($('.header-content-wrapper').css('height'))){
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

  bindLightbox();
  isotopeLogic();

  $('.blog-filter__list-item').click(filterBlogs);

  setUpInfiniteScroll();
});
