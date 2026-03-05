<?php
/**
 * archive.php — Template for category, tag, and date-based archives
 */

if (!defined('ABSPATH')) {
  exit;
}

get_header(); ?>

<section class="page-hero">
  <div class="container">
    <div class="page-hero-breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> / Archive</div>
    <h1><?php the_archive_title(); ?></h1>
    <div class="archive-description"><?php the_archive_description(); ?></div>
  </div>
</section>

<div class="container">
  <div class="section">
    <?php
if (have_posts()):
  while (have_posts()):
    the_post();
?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('archive-post'); ?> style="margin-bottom: 48px; border-bottom: 1px solid var(--border); padding-bottom: 32px;">
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>" style="color: var(--navy); text-decoration: none;"><?php the_title(); ?></a></h2>
                <div class="entry-meta" style="font-size: 0.85rem; color: var(--text-light); margin-bottom: 16px;">
                    <?php echo get_the_date(); ?> · By <?php the_author(); ?>
                </div>
                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="btn btn-outline" style="margin-top: 16px;">Read More</a>
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
        <p>No posts found in this archive.</p>
        <?php
endif;
?>
  </div>
</div>

<?php get_footer(); ?>
