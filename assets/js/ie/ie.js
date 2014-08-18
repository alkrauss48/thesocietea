$(document).ready(function(){
  alert('hello first');
  if($('#about').length != 0){
    alert('hello again');
    $('#about').hide();
    $('#about-responsive').show();
  }
});
