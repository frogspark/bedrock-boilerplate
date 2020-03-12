import $ from 'jquery';

$(document).load(function () {
  var open = false;

  /**
   * @description handles opening and closing of the mobile menu on the site
   * 
   * @param {*} open flag indicating whether or not the menu is in an open state
   */
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