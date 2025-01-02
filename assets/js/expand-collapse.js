jQuery(document).ready(function ($) {
  $('.moremore').on('click', function () {
    const $button = $(this); 
    const $fullText = $('.fullTextt');

    $fullText.stop().slideToggle(500, function () {
      $button.text($fullText.is(':visible') ? 'Свернуть' : 'Развернуть');
    });
  });

  $('.perecluchatel').on('click', function () {
    const $this = $(this);
    const $submenu = $this.closest('li').find('.footer__submenu');

    $submenu.stop().slideToggle(300, function () {
      $this.text($submenu.is(':visible') ? '-' : '+');
    });
  });
});
