import $ from 'jquery';
import AOS from 'aos';

require('popper.js');
require('bootstrap');
require('lodash');

require('./modules/nav');
require('./modules/containers');
require('./modules/maps');
require('./modules/slick-sliders');

window.jQuery = $;

(function($) {
  $.fn.isInViewport = function() {
    let elementTop = $(this).offset().top;
    let elementBottom = elementTop + $(this).outerHeight();
    let viewportTop = $(window).scrollTop();
    let viewportBottom = viewportTop + $(window).height();
    return elementBottom > viewportTop && elementTop < viewportBottom;
  };
});

$(document).ready(function(){
  // AOS.
  AOS.init();
  
});