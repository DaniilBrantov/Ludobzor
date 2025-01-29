document.addEventListener('DOMContentLoaded', function () {
    let isSubmitting = false;

    document.body.addEventListener('submit', function (e) {
        if (e.target.id === 'chili_page_review_form') {
            e.preventDefault();

            if (isSubmitting) return;

            isSubmitting = true;

            const fio = document.querySelector('input[name="author"]').value;
            const rating = document.querySelector('input[name="rating"]').value;
            const post_id = document.querySelector('input[name="post_id"]').value;
            const review = document.querySelector('textarea[name="review_content"]').value;

            const fioRegex = /^[A-Za-zА-Яа-яЁё\s]+$/;
            if (!fioRegex.test(fio)) {
                document.querySelector('.error-message').innerHTML =
                    '<p style="color: red;">Пожалуйста, введите корректное имя (только буквы и пробелы).</p>';
                isSubmitting = false;
                return;
            }

            const formData = new FormData();
            formData.append('action', 'handle_review_form');
            formData.append('nonce', reviewForm.nonce);
            formData.append('fio', fio);
            formData.append('rating', rating);
            formData.append('post_id', post_id);
            formData.append('review', review);

            fetch(reviewForm.ajax_url, {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelector('.error-message').innerHTML =
                            `<p style="color: green;">${data.data.message}</p>`;
                        document.querySelector('#chili_page_review_form').reset();
                        console.log(data.data.message);
                    } else {
                        document.querySelector('.error-message').innerHTML =
                            `<p style="color: red;">${data.data.message}</p>`;
                        console.log(data.data.message);
                    }
                    isSubmitting = false;
                })
                .catch(error => {
                    document.querySelector('.error-message').innerHTML =
                        '<p style="color: red;">Произошла ошибка. Попробуйте позже.</p>';
                    isSubmitting = false;
                    console.log('Произошла ошибка. Попробуйте позже.');
                    console.log(error); // Add error details in the console
                });
        }
    });
});
