$(document).load(function () {
  /**
   * @description function for fixing floating elements or page width elements with 
   * content to the conventional container sizes
   */
  function containerFix() {
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

  containerFix();
  $(window).on('resize', function () {
    containerFix();
  });

});