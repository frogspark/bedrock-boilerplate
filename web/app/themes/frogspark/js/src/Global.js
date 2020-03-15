import $ from 'jquery';
window.jQuery = $;
import AOS from 'aos';
import 'popper.js';
import 'bootstrap';
import _ from 'lodash';

import * as nav from './modules/nav';
// import * as containers from './modules/containers';
import * as maps from './modules/maps';
import * as slicks from './modules/slick-sliders';

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
  nav.listeners();
  maps.runMaps();
  slicks.sliders();
  // slicks.autoGenerateSliders();
  
  // AOS.
  AOS.init();
});