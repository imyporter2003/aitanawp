<?php
/**
 * 404.php — Custom error page
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header(); ?>

<section class="page-hero">
  <div class="container">
    <div class="page-hero-breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> / Page Not Found</div>
    <h1>Oops! We can't find that page.</h1>
    <p>It looks like nothing was found at this location. Perhaps try one of the links below or chat with A.D.A.M for help.</p>
  </div>
</section>

<section class="section">
  <div class="container" style="text-align:center; max-width: 600px;">
    <div style="font-size: 5rem; color: var(--border); margin-bottom: 24px;">404</div>
    <p style="font-size: 1.1rem; color: var(--text-light); margin-bottom: 32px;">The page you're looking for might have been moved, renamed, or is temporarily unavailable.</p>
    
    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 16px;">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">Go to Homepage</a>
        <button class="btn btn-outline adam-trigger">Ask A.D.A.M</button>
    </div>

    <div style="margin-top: 48px;">
        <h3>Looking for something specific?</h3>
        <ul style="list-style: none; padding: 0; display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-top: 24px; text-align: left;">
            <li><a href="<?php echo esc_url(aitana_page_url('mortgages')); ?>">🏠 Mortgages</a></li>
            <li><a href="<?php echo esc_url(aitana_page_url('financial-planning')); ?>">💰 Financial Planning</a></li>
            <li><a href="<?php echo esc_url(aitana_page_url('self-employed-pensions')); ?>">🏖️ Pensions</a></li>
            <li><a href="<?php echo esc_url(aitana_page_url('investment-principles')); ?>">📈 Investments</a></li>
            <li><a href="<?php echo esc_url(aitana_page_url('protection')); ?>">🛡️ Protection</a></li>
            <li><a href="<?php echo esc_url(aitana_page_url('contact')); ?>">📞 Contact Us</a></li>
        </ul>
    </div>
  </div>
</section>

<?php get_footer(); ?>
