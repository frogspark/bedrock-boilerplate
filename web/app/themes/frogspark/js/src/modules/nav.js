$(document).load(function () {
  // Burger menu.
  var open = false;

  function openMenu(open) {
    $('#burger').toggleClass('open', open);
    $('#navigation-mobile ul').toggleClass('open', open);
  }
  $('#burger').click(function () {
    open = !open;
    openMenu(open);
  });

  // Active class.
  $('header .nav [href]').each(function () {
    if (this.href == window.location.href) {
      $(this).addClass('active');
    }
  });
});