document.addEventListener('DOMContentLoaded', function () {
  let isSubmitting = false;

  const commentForm = document.getElementById('commentform');
  if (commentForm) {
    commentForm.addEventListener('submit', function (e) {
      e.preventDefault();

      if (isSubmitting) return;

      isSubmitting = true;

      const fio = document.querySelector('input[name="fio"]').value;
      const email = document.querySelector('input[name="email"]').value;
      const comment = document.querySelector('textarea[name="comment"]').value;

      const fioRegex = /^[A-Za-zА-Яа-яЁё\s]+$/;
      const errorContainer = document.querySelector('.errrrr');
      
      if (!fioRegex.test(fio)) {
        errorContainer.innerHTML = '<p style="color: red;">Пожалуйста, введите корректное имя (только буквы и пробелы).</p>';
        isSubmitting = false;
        return;
      }

      const formData = new FormData();
      formData.append('action', 'handle_feedback_form');
      formData.append('nonce', feedbackForm.nonce);
      formData.append('fio', fio);
      formData.append('email', email);
      formData.append('comment', comment);

      fetch(feedbackForm.ajax_url, {
        method: 'POST',
        body: formData,
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          errorContainer.innerHTML = `<p style="color: green;">${data.data.message}</p>`;
          commentForm.reset();
        } else {
          errorContainer.innerHTML = `<p style="color: red;">${data.data.message}</p>`;
        }
        isSubmitting = false;
      })
      .catch(() => {
        errorContainer.innerHTML = '<p style="color: red;">Произошла ошибка. Попробуйте позже.</p>';
        isSubmitting = false;
      });
    });
  }
});
