<section class="section partners" aria-label="Партнеры и клиенты">
  <div class="container">
    <h2 class="section__title">Клиенты и партнеры</h2>
  </div>
    <div class="partners__row">
      <div class="partners__track">
      <?php
      $clients = get_posts( array(
            'numberposts' => -1,
            'category'    => 0,
            'orderby'     => 'date',
            'order'       => 'ASC',
            'include'     => array(),
            'exclude'     => array(),
            'meta_key'    => '',
            'meta_value'  =>'',
            'post_type'   => 'client-or-partner',
            'suppress_filters' => true,
          ) );

          $items = array();
          if ( $clients ) {
            foreach( $clients as $client ){
              setup_postdata( $client );
              $img = esc_url( get_the_post_thumbnail_url( $client->ID ) );
              $alt = esc_attr( get_the_title( $client->ID ) );
              $title = esc_html( get_the_title( $client->ID ) );
              $items[] = '<div class="partner-card"><img class="partner-card__logo" src="' . $img . '" alt="' . $alt . '" title="' . $title . '"></div>';
            }
            // output items twice to create seamless infinite marquee
            echo implode( "\n", $items );
            echo implode( "\n", $items );
          }

          wp_reset_postdata();
      ?>
      </div>
    </div>
</section>
