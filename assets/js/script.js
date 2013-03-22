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