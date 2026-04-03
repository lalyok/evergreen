<?php
/**
 * Main index file for Evergreen theme.
 * Minimal template so WordPress can activate the theme.
 */

get_header();
?>

  <section class="site-content">
    <div class="container">
      <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <div class="entry-content">
              <?php the_content(); ?>
            </div>
          </article>
        <?php endwhile; ?>
      <?php else : ?>
        <p><?php esc_html_e( 'Записей не найдено.', 'evergreen' ); ?></p>
      <?php endif; ?>
    </div>
  </section>

<?php
get_footer();
