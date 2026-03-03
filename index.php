<?php
/**
 * index.php — Required WordPress fallback (redirects to front-page)
 */
get_header();
if (have_posts()):
    while (have_posts()):
        the_post();
        echo '<div class="container" style="padding:80px 24px;">';
        the_title('<h1>', '</h1>');
        echo '<div style="margin-top:24px;">';
        the_content();
        echo '</div></div>';
    endwhile;
endif;
get_footer();
