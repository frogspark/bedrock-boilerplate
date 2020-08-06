var $ = require("jquery");
window.jQuery = $;
require("bootstrap");
var _ = require("lodash");
var slick = require("slick-carousel");
var AOS = require("aos");
var magnific = require('magnific-popup');
var hamburger = require('hamburgers');

$(document).ready(function() {

	// $(window).scroll(function () {
	// 	var scroll = $(window).scrollTop();

	// 	if (scroll >= 50) {
  //     $(".navbar-custom.main-nav").addClass("scroll");
  //     $(".floating-btn").addClass("active");
	// 	} else {
  //     $(".navbar-custom.main-nav").removeClass("scroll");
  //     $(".floating-btn").removeClass("active");
	// 	}
	// });

  // $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
  //   // disableOn: 700,
  //   type: 'iframe',
  //   mainClass: 'mfp-fade',
  //   removalDelay: 160,
  //   preloader: false,
  //   fixedContentPos: false,
  // });

  // $(".service-block").click(function(){
  //   $('#popup').addClass("active");
  // });

  // $('.responsive').slick({
  //   dots: true,
  //   infinite: false,
  //   speed: 300,
  //   slidesToShow: 4,
  //   slidesToScroll: 4,
  //   responsive: [
  //     {
  //       breakpoint: 1024,
  //       settings: {
  //         slidesToShow: 3,
  //         slidesToScroll: 3,
  //         infinite: true,
  //         dots: true
  //       }
  //     },
  //     {
  //       breakpoint: 600,
  //       settings: {
  //         slidesToShow: 2,
  //         slidesToScroll: 2
  //       }
  //     },
  //     {
  //       breakpoint: 480,
  //       settings: {
  //         slidesToShow: 1,
  //         slidesToScroll: 1
  //       }
  //     }
  //     // You can unslick at a given breakpoint now by adding:
  //     // settings: "unslick"
  //     // instead of a settings object
  //   ]
  // });

  // AOS.
  AOS.init();
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