import $ from 'jquery';
window.jQuery = $;
require('bootstrap');
var _ = require('lodash');
import slick from 'slick-carousel';
import AOS from 'aos';

$(document).ready(function(){
  // Burger menu.
  function openMenu(open) { $('#burger').toggleClass('open', open); $('#navigation-mobile ul').toggleClass('open', open); }
  var open = false;
  $('#burger').on('click', function() { open = !open; openMenu(open); });

  // Submenu toggle.
  $('#navigation-mobile .submenu-toggle').on('click', function(){ 
    var item = $(this);
    item.next('.submenu').slideToggle();
    item.next('.submenu').toggleClass('open');
    item.toggleClass('open');
  });

  // Active class.
  // $('#header .nav > li > a[href]').each(function() { if (this.href == window.location.href) { $(this).addClass('active'); } });

  // Base carousel.
  $('.carousel-base').slick({
    infinite: false,
    mobileFirst: true,
    nextArrow: '<button class="slick-arrow slick-next"><i class="far fa-chevron-right"></i></button>',
    prevArrow: '<button class="slick-arrow slick-prev"><i class="far fa-chevron-left"></i></button>',
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        }
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 3,
        }
      },
      {
        breakpoint: 1199,
        settings: {
          slidesToShow: 4,
        }
      },
    ],
  });

  // AOS.
  AOS.init();
  setTimeout(function(){ AOS.init(); }, 500);
});

// Google Maps.
(function($) {
  function new_map($el) {
    var $markers = $el.find('.marker');
    var args = {
      center: new google.maps.LatLng(0, 0),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      styles: [{"featureType":"administrative.land_parcel","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]}],
      zoom: 16,
    };
    var map = new google.maps.Map($el[0], args);
    map.markers = [];
    $markers.each(function(){
      add_marker($(this), map);
    });
    center_map(map);
    return map;
  }

  function add_marker($marker, map) {
    var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));
    var icon = {url: ''+$marker.attr('data-icon')+'', scaledSize: new google.maps.Size(48, 48)};
    var marker = new google.maps.Marker({
      icon: icon,
      map: map,
      position: latlng,
    });
    map.markers.push(marker);
    if($marker.html()){
      var infowindow = new google.maps.InfoWindow({
        content: $marker.html()
      });
      google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map, marker);
      });
    }
  }

  function center_map(map) {
    var bounds = new google.maps.LatLngBounds();
    $.each( map.markers, function(i, marker){
      var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
      bounds.extend(latlng);
    });
    if( map.markers.length == 1 ) {
      map.setCenter(bounds.getCenter());
      map.setZoom(16);
    } else {
      map.fitBounds(bounds);
    }
  }

  var map = null;
  $(document).ready(function(){
    $('.map').each(function(){
      map = new_map($(this));
    });
  });
})($);