<?php
/**
 * search.php — Template for search results
 */

if (!defined('ABSPATH')) {
  exit;
}

get_header(); ?>

<section class="page-hero">
  <div class="container">
    <div class="page-hero-breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> / Search Results</div>
    <h1>Search results for: <?php echo get_search_query(); ?></h1>
  </div>
</section>

<div class="container">
  <div class="section">
    <?php
if (have_posts()):
  while (have_posts()):
    the_post();
?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('search-item'); ?> style="margin-bottom: 32px; border-bottom: 1px solid var(--border); padding-bottom: 24px;">
                <h3 class="entry-title"><a href="<?php the_permalink(); ?>" style="color: var(--navy); text-decoration: none;"><?php the_title(); ?></a></h3>
                <div class="entry-summary" style="font-size: 0.9rem; color: var(--text-light); margin-top: 8px;">
                    <?php the_excerpt(); ?>
                </div>
            </article>
            <?php
  endwhile;

  the_posts_pagination(array(
    'mid_size' => 2,
    'prev_text' => __('&laquo; Previous', 'aitana'),
    'next_text' => __('Next &raquo;', 'aitana'),
  ));
else:
?>
        <div style="text-align: center; padding: 48px 0;">
            <p style="font-size: 1.1rem; color: var(--text-light); margin-bottom: 32px;">Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>
            <?php get_search_form(); ?>
        </div>
        <?php
endif;
?>
  </div>
</div>

<?php get_footer(); ?>
