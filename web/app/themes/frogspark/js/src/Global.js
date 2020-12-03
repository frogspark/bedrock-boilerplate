import $ from 'jquery';
window.jQuery = $;
import AOS from 'aos';
import 'popper.js';
import 'bootstrap';
import _ from 'lodash';
import slick from 'slick-carousel';

/**
 * @description new prototype function for checking if an element is within the viewport
 * 
 * @param {*} $ jQuery object for the window
 */
(function ($) {
  $.fn.isInViewport = function () {
    let elementTop = $(this).offset().top;
    let elementBottom = elementTop + $(this).outerHeight();
    let viewportTop = $(window).scrollTop();
    let viewportBottom = viewportTop + $(window).height();
    return elementBottom > viewportTop && elementTop < viewportBottom;
  };
});

$(document).ready(function () {
  // AOS.
  setTimeout(() => {
    $('body').addClass('loaded');
    setTimeout(() => {
      AOS.init();
    }, 500);
  }, 1000)
  // AOS.init();

  scrollWatcher();
  containerFix();
  sliders();
  runMaps();

  $(window).resize(() => {
    containerFix();
    runMaps();
  });

  $(window).scroll(() => {
    scrollWatcher();
  })

  // Smooth scroll.
  $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function (event) {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      var offset = $('header').outerHeight();
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top - offset
        }, 1000);
      }
    }
  });

  // Burger click
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

  // Scroll.
  var $circle = $('.scroll-cursor'),
    $wrapper = $('.scroll');
x
  function moveCircle(e) {
    TweenLite.to($circle, 0.3, {
      css: {
        left: e.pageX,
        top: e.pageY
      }
    });
  }
  var flag = false;
  $($wrapper).mouseover(function () {
    flag = true;
    TweenLite.to($circle, .4, {
      scale: 1,
      autoAlpha: 1
    })
    $($wrapper).on('mousemove', moveCircle);
  });
  $($wrapper).mouseout(function () {
    flag = false;
    TweenLite.to($circle, .4, {
      scale: .1,
      autoAlpha: 0
    })
  });

  // In-view.
  function isScrolledIntoView(elem) {
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();
    var elemTop = $(elem).offset().top;
    return ((elemTop <= docViewBottom) && (elemTop >= docViewTop));
  }
  $(window).on('scroll', function () {
    $('.uncover').each(function () {
      if (isScrolledIntoView(this) === true) {
        $(this).addClass('show');
      }
    });
  });

  // Scroll fix.
  function scrollFix() {
    var headerHeight = $('#header').outerHeight();
    var dropdown = $('.submenu');
    var scroll = $(document).scrollTop();
    if (scroll == 0) {
      dropdown.css('top', headerHeight + 'px');
    } else if (scroll < topstripHeight) {
      dropdown.css('top', scroll + headerHeight + 'px');
    } else {
      dropdown.css('top', headerHeight + 'px');
    }
  }
});


/**
 * @description run on scroll event to add classs to header on scroll
 */
let scrollWatcher = () => {
  let scroll = $(window).scrollTop();
  if (scroll > 0) {
    $('header').addClass('scroll');
  } else {
    $('header').removeClass('scroll');
  }
}

/**
 * @description function for fixing floating elements or page width elements with content to the conventional container sizes
 */
let containerFix = () => {
  if ($('.container-fix').length) {
    var windowWidth = $(window).width();
    var containerWidth = ($('.container').width() + 32);
    var padding = ((windowWidth - containerWidth) / 2) + 16;
    if (windowWidth >= 992) {
      $('.container-fix').each(function () {
        if ($(this).hasClass('odd')) {
          $(this).css('padding-right', padding + 'px');
        } else if ($(this).hasClass('even')) {
          $(this).css('padding-left', padding + 'px');
        }
      });
    } else if (windowWidth >= 576 && windowWidth <= 991) {
      $('.container-fix').each(function () {
        $(this).css('padding-left', padding + 'px');
        $(this).css('padding-right', padding + 'px');
      });
    } else {
      $('.container-fix').each(function () {
        $(this).css('padding-left', '16px');
        $(this).css('padding-right', '16px');
      });
    }
  }
}

/**
 * @description initialise the slick sliders for the page
 */
let sliders = () => {
  // generic slider example
  // go to - https://kenwheeler.github.io/slick/ - for documentation
  $('.slider').slick({
    dots: false,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 4000,
    slidesToScroll: 1,
    slidesToShow: 1
  });

  // slider arrow functionality
  $('.slick-slider.slick-prev').click(function () {
    $('.slider').slick('slickPrev');
  });
  $('.slick-slider.slick-next').click(function () {
    $('.slider').slick('slickNext');
  });
}

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

/**
 * @description centers the map on the current marker or in the center of all markers present
 * 
 * @param {*} map the JSON map object being worked on
 */
let centerMap = (map) => {
  let bounds = new google.maps.LatLngBounds();
  $.each(map.markers, function (i, marker) {
    let latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
    bounds.extend(latlng);
  });
  if (map.markers.length == 1) {
    map.setCenter(bounds.getCenter());
    map.setZoom(map.zoom);
  } else {
    map.fitBounds(bounds);
  }
}

/**
 * @description adds a new marker to the map being created
 * 
 * @param {*} $marker the jQuery HTML marker to be added
 * @param {*} map the JSON map object to be operated on
 */
let addMarker = ($marker, map) => {
  let latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));
  let icon = {
    url: '' + $marker.attr('data-icon') + '',
    scaledSize: new google.maps.Size(48, 48)
  };
  let marker = new google.maps.Marker({
    icon: icon,
    map: map,
    position: latlng,
  });
  map.markers.push(marker);
  if ($marker.html()) {
    let infowindow = new google.maps.InfoWindow({
      content: $marker.html()
    });
    google.maps.event.addListener(marker, 'click', function () {
      infowindow.open(map, marker);
    });
  }
}

/**
 * @description creates a new map at the location of the jQuery element passed in
 * 
 * @param {*} $el the jQuery element to create a map aroudn 
 */
let newMap = ($el) => {
  let $markers = $el.find('.marker');
  let args = {
    center: new google.maps.LatLng(0, 0),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    styles: [{
      "featureType": "administrative.land_parcel",
      "elementType": "labels",
      "stylers": [{
        "visibility": "off"
      }]
    }, {
      "featureType": "poi",
      "elementType": "labels.text",
      "stylers": [{
        "visibility": "off"
      }]
    }, {
      "featureType": "poi.business",
      "stylers": [{
        "visibility": "off"
      }]
    }, {
      "featureType": "road",
      "elementType": "labels.icon",
      "stylers": [{
        "visibility": "off"
      }]
    }, {
      "featureType": "road.local",
      "elementType": "labels",
      "stylers": [{
        "visibility": "off"
      }]
    }, {
      "featureType": "transit",
      "stylers": [{
        "visibility": "off"
      }]
    }],
    zoom: 12,
  };
  let map = new google.maps.Map($el[0], args);
  map.markers = [];
  $markers.each(function () {
    addMarker($(this), map);
  });
  centerMap(map);
  return map;
}

/**
 * @description convenience function for running all code required to generate a single (or multiple) maps on a page
 */
let runMaps = () => {
  $('.map').each(function() {
    newMap($(this));
  });
}