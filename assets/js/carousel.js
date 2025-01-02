jQuery(document).ready(function ($) {
  $('.owl-carousel').owlCarousel({
    items: 6,
    loop: true, 
    margin: 10, 
    nav: true,
    dots: false,
    autoplay: true, 
    autoplayTimeout: 3000,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 6,
      },
    },
  });
});
