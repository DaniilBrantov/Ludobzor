jQuery(document).ready(function ($) {
  let isSubmitting = false;

  $('body').on('submit', '#commentform', function (e) {
    e.preventDefault();

    if (isSubmitting) return;

    isSubmitting = true;

    const fio = $('input[name="fio"]').val();
    const email = $('input[name="email"]').val();
    const comment = $('textarea[name="comment"]').val();

    const fioRegex = /^[A-Za-zА-Яа-яЁё\s]+$/;
    if (!fioRegex.test(fio)) {
      $('.errrrr').html(
        '<p style="color: red;">Пожалуйста, введите корректное имя (только буквы и пробелы).</p>'
      );
      isSubmitting = false;
      return;
    }

    const formData = {
      action: 'handle_feedback_form',
      nonce: feedbackForm.nonce,
      fio: fio,
      email: email,
      comment: comment,
    };

    $.ajax({
      url: feedbackForm.ajax_url,
      type: 'POST',
      data: formData,
      success: function (response) {
        if (response.success) {
          $('.errrrr').html(
            `<p style="color: green;">${response.data.message}</p>`
          );
          $('#commentform')[0].reset();
        } else {
          $('.errrrr').html(
            `<p style="color: red;">${response.data.message}</p>`
          );
        }
        isSubmitting = false;
      },
      error: function () {
        $('.errrrr').html(
          '<p style="color: red;">Произошла ошибка. Попробуйте позже.</p>'
        );
        isSubmitting = false;
      },
    });
  });
});
