<div class="modal feedback-form-modal" id="contact-modal" aria-hidden="true">
  <div class="modal__content">
    <div class="modal__close">
      <button class="modal__close-button" type="button"></button>
    </div>
    <h2 class="section__title modal__title">Получить консультацию</h2>
    <form class="contact-form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
      <input type="hidden" name="action" value="evergreen_contact">
      <div class="contact-form__inputs">
        <label>
        <span class="visually-hidden">Имя</span>
        <input class="contact-form__input" type="text" name="name" placeholder="Как вас зовут?" required>
        </label>
        <label>
        <span class="visually-hidden">Номер телефона</span>
        <input class="contact-form__input" type="tel" name="phone" placeholder="Номер телефона" required>
        </label>
        <label>
        <span class="visually-hidden">Email</span>
        <input class="contact-form__input" type="email" name="email" placeholder="Email">
        </label>
      </div>
      <label class="contact-form__consent">
        <input class="contact-form__consent-checkbox visually-hidden" type="checkbox" name="consent" required> 
        <span class="contact-form__consent-checkmark"></span>
        <p class="contact-form__consent-text">
        Я согласен (-а) с <a href="/privacy-policy" target="_blank">политикой конфиденциальности</a> в отношении пользовательских данных и даю свое согласие на обработку персональных данных.
        </p>
      </label>
      <button class="button" type="submit">Отправить</button>
    </form>
  </div>
</div>

<div class="modal modal-feedback-success" id="feedback-success-modal" aria-hidden="true">
  <div class="modal__content">
    <div class="modal__close">
      <button class="modal__close-button" type="button"></button>
    </div>
    <h2 class="section__title modal__title modal__title--small-margin">Заявка отправлена!</h2>
    <p class="modal__message">Мы свяжемся с вами в ближайшее время.</p>
  </div>
</div>