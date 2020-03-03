// Google Maps.
(function ($) {
  /**
   * @description creates a new map at the location of the jQuery element passed in
   * 
   * @param {*} $el the jQuery element to create a map aroudn 
   */
  function new_map($el) {
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
      zoom: 16,
    };
    let map = new google.maps.Map($el[0], args);
    map.markers = [];
    $markers.each(function () {
      add_marker($(this), map);
    });
    center_map(map);
    return map;
  }

  /**
   * @description adds a new marker to the map being created
   * 
   * @param {*} $marker the jQuery HTML marker to be added
   * @param {*} map the JSON map object to be operated on
   */
  function add_marker($marker, map) {
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
   * @description centers the map on the current marker or in the center of all markers present
   * 
   * @param {*} map the JSON map object being worked on
   */
  function center_map(map) {
    let bounds = new google.maps.LatLngBounds();
    $.each(map.markers, function (i, marker) {
      let latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
      bounds.extend(latlng);
    });
    if (map.markers.length == 1) {
      map.setCenter(bounds.getCenter());
      map.setZoom(16);
    } else {
      map.fitBounds(bounds);
    }
  }

  var map = null;
  $(document).ready(function () {
    $('.map').each(function () {
      map = new_map($(this));
    });
  });
})($);