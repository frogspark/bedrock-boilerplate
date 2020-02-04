import $ from 'jquery';
window.jQuery = $;
require('popper.js');
require('bootstrap');
var _ = require('lodash');
import slick from 'slick-carousel';
import AOS from 'aos';

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
  // Burger menu.
  function openMenu(open) { $('#burger').toggleClass('open', open); $('#navigation-mobile ul').toggleClass('open', open); }
  var open = false;
  $('#burger').click(function() { open = !open; openMenu(open); });

  // Active class.
  $('header .nav [href]').each(function() { if (this.href == window.location.href) { $(this).addClass('active'); } });

  // AOS.
  AOS.init();
});

// Google Maps.
(function($) {
  function new_map($el) {
    let $markers = $el.find('.marker');
    let args = {
      center: new google.maps.LatLng(0, 0),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      styles: [{"featureType":"administrative.land_parcel","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]}],
      zoom: 16,
    };
    let map = new google.maps.Map($el[0], args);
    map.markers = [];
    $markers.each(function(){
      add_marker($(this), map);
    });
    center_map(map);
    return map;
  }

  function add_marker($marker, map) {
    let latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));
    let icon = {url: ''+$marker.attr('data-icon')+'', scaledSize: new google.maps.Size(48, 48)};
    let marker = new google.maps.Marker({
      icon: icon,
      map: map,
      position: latlng,
    });
    map.markers.push(marker);
    if($marker.html()){
      let infowindow = new google.maps.InfoWindow({
        content: $marker.html()
      });
      google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map, marker);
      });
    }
  }

  function center_map(map) {
    let bounds = new google.maps.LatLngBounds();
    $.each( map.markers, function(i, marker){
      let latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
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
})($);s