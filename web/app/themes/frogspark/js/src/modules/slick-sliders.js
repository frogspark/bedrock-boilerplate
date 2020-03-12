import $ from 'jquery';
window.jQuery = $;
import 'slick-carousel';

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
  $('.slick-slider.slick-prev').click(function () { $('.slider').slick('slickPrev'); });
  $('.slick-slider.slick-next').click(function () { $('.slider').slick('slickNext'); });
}

/**
 * we can do some clever auto generation of sliders here for sure
 * -- generic settings that are used on most sliders
 */
var sliderObjs = [];
function generateSliders(sliders) {}

exports.runSliders = sliders;