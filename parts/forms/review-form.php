
<div class="js-chili-modals-container">
    <div class="js-chili-modal chili-review-form js-chili-review-modal" style="margin-top: 50px">
        <div class="reviews-iu1"></div>
        <div class="red-modality">
            <div class="header-line">
                <div class="red-modality-title" style="text-align: center; margin-left: 50px">
                    <text class="innerH1pp-review">Оставить отзыв</text>
                </div>
            </div>
            <form method="post" action="" id="chili_page_review_form">
                <div class="red-text-name red-item-width">ВАШЕ ИМЯ</div>
                <div class="line name-line">
                    <div class="red-modality-left form-field red-item-width">
                        <input type="text" name="author" class="text modality-name" placeholder="Введите имя">
                    </div>
                    <div class="red-item-width red-modality-right form-field">
                        <div class="red-modality-notice">Оценка:</div>
                        <div class="red-rating-stars">
                            <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                            <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                            <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                            <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                            <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                        </div>
                    </div>
                    <input type="hidden" name="post_id" value="<?php echo $post->ID; ?>">
                </div>
                <div class="red-text red-item-width">ВАШ ОТЗЫВ</div>
                <div class="line text-review form-field red-item-width">
                    <textarea id="booking-modal-notes" placeholder="Введите ваше сообщение" name="review_content"></textarea>
                </div>
                <div id="review-btn" class="line">
                    <button class="button submit js-submit-btn" type="submit">ОТПРАВИТЬ</button>
                </div>
                <div class="error-message" ></div>

            </form>
            <div class="reviews-iu2"></div>
        </div>

    </div>
</div>

