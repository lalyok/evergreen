<?php
/**
 * Contact form block — simple form markup
 */
?>
<section class="contact-form" id="contact" aria-label="Получить консультацию">
  <div class="container">
    <h2>Получить консультацию</h2>
    <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" class="consult-form">
      <input type="hidden" name="action" value="evergreen_contact">
      <div class="form-grid">
        <label>
          <span>Как вас зовут?</span>
          <input type="text" name="name" required>
        </label>
        <label>
          <span>Номер телефона</span>
          <input type="tel" name="phone" required>
        </label>
        <label>
          <span>Email</span>
          <input type="email" name="email">
        </label>
      </div>
      <label class="consent">
        <input type="checkbox" name="consent" required> Согласен на обработку персональных данных
      </label>
      <button type="submit" class="contact-button">Отправить</button>
    </form>
  </div>
</section>
