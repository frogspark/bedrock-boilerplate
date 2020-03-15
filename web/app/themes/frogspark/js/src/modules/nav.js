import $ from 'jquery';
window.jQuery = $;

/**
 * @description handles opening and closing of the mobile menu on the site
 * 
 * @param {*} open flag indicating whether or not the menu is in an open state
 */
var open = false;
let toggleMenu = (open) => {
  $('#burger').toggleClass('open', open);
  $('#navigation-mobile ul').toggleClass('open', open);
}

let listeners = () => {
  $('#burger').click(function () {
    open = !open;
    toggleMenu(open);
  });

  // Active class.
  $('header .nav [href]').each(function () {
    if (this.href == window.location.href) {
      $(this).addClass('active');
    }
  });
}

exports.listeners = listeners;