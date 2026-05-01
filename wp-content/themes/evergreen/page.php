<?php
get_header();

?>
<section class="section">
    <div class="container">
        <div class="section__title-wrapper">
            <h1 class="section__title section__title--huge"><?php the_title(); ?></h2>
        </div>
        <?php the_content(); ?>
    </div>
</section>

<?php

get_footer();
?>