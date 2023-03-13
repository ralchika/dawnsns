$(function () {

  $('.menu-trigger').click(function () {
    console.log(1 + 1);
    $(this).toggleClass('active');
    $('.g-navi').slideToggle();
    // if ($(this).hasClass('active')) {
    //   $('.g-navi').slideUp();
    // } else {
    //   $('.g-navi').slideDown();
    // }
  });
});


$(function () {
  $('.edit-btn').each(function () {
    $(this).on('click', function () {
      var target = $(this).data('target');
      var container = $('.post-edit');
      var modal = document.getElementById(target);
      $(modal).fadeIn();
      return false;
    });
    $(document).on('click', function (e) {
      if (!$(e.target).closest('.edit-form').length) {
        $('.post-edit').fadeOut();
      }
    });
  });

});
