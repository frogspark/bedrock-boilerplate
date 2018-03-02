import $ from 'jquery';
import slick from 'slick-carousel';

$('document').ready(() => {
  $('.hamburger').click((e) => {
    e.currentTarget.classList.toggle('is-active');
    $('#navbar').toggleClass('is-active');
  });
});
