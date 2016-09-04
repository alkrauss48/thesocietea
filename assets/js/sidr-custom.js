$(document).ready( function()	{

  $('#responsive-menu-icon').sidr({
    name: 'sidr-main',
    source: '#navigation',
    side: 'right',
    onOpen:   function() { $('#responsive-menu-icon').addClass('is-active'); },
    onClose:  function() { $('#responsive-menu-icon').removeClass('is-active'); }
  });

  $('body').on('click', function(event){
    if($('body').hasClass('sidr-open') && $(event.target).parents('#sidr-main').length == 0){
      $.sidr('close', 'sidr-main');
    }
  });

});

var closeSidr = function() {
  if($('body').hasClass('sidr-open')){
    $.sidr('close', 'sidr-main');
  }
};

$(window).touchwipe({
  wipeRight: closeSidr,
  preventDefaultEvents: false
});

$(window).resize(closeSidr);
