  </main>

  <footer class="site-footer section--bg-gradient" role="contentinfo">
    <div class="container">
      <div class="footer-inner-wrapper">
        <div class="footer-inner">
          <?php
          global $contacts;
          $contacts = get_posts( array(
              'numberposts' => 1,
              'category'    => 0,
              'orderby'     => 'date',
              'order'       => 'DESC',
              'include'     => array(),
              'exclude'     => array(),
              'meta_key'    => '',
              'meta_value'  =>'',
              'post_type'   => 'contacts',
              'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
            ) );
            if ( $contacts ) {
              $contact = $contacts[0];
              setup_postdata( $contact );
              ?>
  
                <div class="footer__brand-info brand-info">
                  <div class="brand-info__wrapper">
                    <?php if ( get_theme_mod('secondary_logo') ) : ?>
                      <a class="custom-logo--secondary brand-info__logo" href="<?php echo esc_url( home_url('/') ); ?>">
                        <?php the_custom_logo_secondary(); ?>
                      </a>
                    <?php else : ?>
                      <a class="site-title brand-info__title" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                    <?php endif; ?>
        
                    <div class="brand-info__description">
                      <?php echo get_field( 'contacts-brand-description', $contact->ID ); ?>
                    </div>
                  </div>
  
                  <a href="/privacy-policy" class="brand-info__link">Политика конфиденциальности</a>
  
                </div>
                <div class="footer__menu">
                  <?php
                    wp_nav_menu( array(
                      'theme_location' => 'primary',
                      'container' => false,
                      'menu_id' => 'primary-menu',
                    ) );
                  ?>
                </div>
                <div class="footer__contacts">
                    <div class="contacts-item">
                      <div class="contacts-item__icon">
                        <?php echo get_field( 'contacts-phone-icon', $contact->ID ); ?>
                      </div>
                      <p class="contacts-item__text"><a href="tel:<?php echo esc_attr( get_field( 'contacts-phone', $contact->ID ) ); ?>"><?php echo esc_html( get_field( 'contacts-phone', $contact->ID ) ); ?></a></p>
                    </div>
                    <?php if ( get_field( 'contacts-email', $contact->ID ) ) : ?>
                      <div class="contacts-item">
                        <div class="contacts-item__icon">
                          <?php echo get_field( 'contacts-email-icon', $contact->ID ); ?>
                        </div>
                        <p class="contacts-item__text"><a href="mailto:<?php echo esc_attr( get_field( 'contacts-email', $contact->ID ) ); ?>"><?php echo esc_html( get_field( 'contacts-email', $contact->ID ) ); ?></a></p>
                      </div>
                    <?php endif; ?>
                    <div class="contacts-item">
                        <div class="contacts-item__icon">
                          <?php echo get_field( 'contacts-messenger-icon', $contact->ID ); ?>
                        </div>
                        <p class="contacts-item__text"><a href="<?php echo esc_attr( get_field( 'contacts-messenger-url', $contact->ID ) ); ?>" target="_blank"><?php echo esc_html( get_field( 'contacts-messenger-address', $contact->ID ) ); ?></a></p>
                      </div>
                      <?php if ( get_field( 'contacts-address', $contact->ID ) ) : ?>
                        <div class="contacts-item">
                          <div class="contacts-item__icon">
                            <?php echo get_field( 'contacts-address-icon', $contact->ID ); ?>
                          </div>
                          <p class="contacts-item__text">
                            <a href="<?php echo esc_attr( get_field( 'contacts-address-link', $contact->ID ) ); ?>" target="_blank"><?php echo esc_html( get_field( 'contacts-address', $contact->ID ) ); ?></a>
                          </p>
                        </div>
                      <?php endif; ?>
  
                </div>
                  <?php
                  wp_reset_postdata();
                }
                ?>
  
          </div>
          <p class="footer__copyright">&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?></p>
      </div>
    </div>  
  </footer>

  <?php wp_footer(); ?>
  <!-- Cookie consent banner -->
  <!-- <div id="cookie-banner" class="cookie-banner" role="dialog" aria-live="polite" aria-label="Cookie consent" aria-hidden="true">
    <div class="container">
      <div class="cookie-banner__inner">
        <p class="cookie-banner__text">Мы используем cookie для улучшения работы сайта. Продолжая пользоваться сайтом, вы соглашаетесь на использование cookie.</p>
        <div class="cookie-banner__actions">
          <button id="cookie-accept" class="button button--small">Принять</button>
        </div>
      </div>
    </div>
  </div> -->

</body>
</html>
