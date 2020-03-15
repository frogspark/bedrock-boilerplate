import $ from 'jquery';
window.jQuery = $;
import 'slick-carousel';

export let sliders = () => {
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
 * @description EXPERIMENTAL FEATURE 
 * - generates sldiers based on the classes dictated in the HTML dom of the page
 * 
 */
export let generateSliders = async () => {
  let sliders = $('.slider');
  if(sliders.length) {
    sliders.forEach(element => {
      console.log(element);
      let settings = {
        dots: false,
        arrows: false,
        autoplay: false,
        autoplaySpeed: 5000, 
        slidesToScroll: 1, 
        slidesToShow: 1
      };

      let classes = $(element).classList;
      let classes = Array.from(classes);
      console.log(classes)
      await classes.forEach(domClass => {
        console.log(domClass)
        switch(domClass) {
          case "dots": 
            settings.dots = true;
            break;
          case "arrows":
            settings.arrows = true;
            break;
          case "autoplay":
            settings.autoplay = true;
        }
      })

      if($(element).data('speed') && settings.autoplay) {
        settings.autoplaySpeed = $(element).data('speed')
      }

      if($(element).data('slides')) {
        settings.slidesToShow = $(element).data('slides');
      }

      console.log(settings);

      $(element).slick(settings);
    })
  }
}

