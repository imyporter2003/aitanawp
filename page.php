<?php
/**
 * page.php — Generic page template for standard WordPress pages
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header(); ?>

<section class="page-hero">
  <div class="container">
    <div class="page-hero-breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> / <?php the_title(); ?></div>
    <h1><?php the_title(); ?></h1>
  </div>
</section>

<div class="container">
  <div class="section">
    <?php
if (have_posts()):
    while (have_posts()):
        the_post();
        the_content();
    endwhile;
endif;
?>
  </div>
</div>

<?php get_footer(); ?>
