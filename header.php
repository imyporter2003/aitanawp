<?php
/**
 * The header — nav displayed on every page
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ─── Navigation ────────────────────────────────────────── -->
<nav class="site-nav" id="main-nav">
  <div class="container nav-inner">

    <?php if (has_custom_logo()): ?>
      <!-- Custom logo set via Appearance → Customize → Site Identity → Logo -->
      <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo nav-logo--img">
        <?php the_custom_logo(); ?>
      </a>
    <?php
else: ?>
      <!-- Fallback text + icon logo -->
      <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo">
        <div class="nav-logo-mark">A</div>
        <div class="nav-logo-text">
          <span class="nav-logo-name">Aitana Financial Services</span>
          <span class="nav-logo-tag">Authorised &amp; Regulated by the FCA</span>
        </div>
      </a>
    <?php
endif; ?>

    <div class="nav-links">
      <a href="<?php echo esc_url(aitana_page_url('mortgages')); ?>" <?php if (is_page('mortgages'))
  echo 'class="current-menu-item"'; ?>>Mortgages</a>
      <a href="<?php echo esc_url(aitana_page_url('financial-planning')); ?>" <?php if (is_page('financial-planning'))
  echo 'class="current-menu-item"'; ?>>Financial Planning</a>
      <a href="<?php echo esc_url(aitana_page_url('self-employed-pensions')); ?>" <?php if (is_page('self-employed-pensions'))
  echo 'class="current-menu-item"'; ?>>Pensions</a>
      <a href="<?php echo esc_url(aitana_page_url('investment-principles')); ?>" <?php if (is_page('investment-principles'))
  echo 'class="current-menu-item"'; ?>>Investments</a>
      <a href="<?php echo esc_url(aitana_page_url('protection')); ?>" <?php if (is_page('protection'))
  echo 'class="current-menu-item"'; ?>>Protection</a>
      <a href="<?php echo esc_url(aitana_page_url('about')); ?>" <?php if (is_page('about'))
  echo 'class="current-menu-item"'; ?>>About Us</a>
      <a href="<?php echo esc_url(aitana_page_url('contact')); ?>" <?php if (is_page('contact'))
  echo 'class="current-menu-item"'; ?>>Contact</a>
    </div>

    <div class="nav-cta">
      <a href="tel:01795435094" class="nav-phone">📞 01795 435094</a>
      <a href="<?php echo esc_url(aitana_page_url('contact')); ?>" class="btn btn-primary btn-nav">Get In Touch</a>
    </div>

    <button class="nav-toggle" id="nav-toggle" aria-label="Open menu">
      <span></span><span></span><span></span>
    </button>
  </div>

  <!-- Mobile nav -->
  <div class="mobile-nav" id="mobile-nav">
    <a href="<?php echo esc_url(aitana_page_url('mortgages')); ?>">Mortgages</a>
    <a href="<?php echo esc_url(aitana_page_url('financial-planning')); ?>">Financial Planning</a>
    <a href="<?php echo esc_url(aitana_page_url('self-employed-pensions')); ?>">Pensions</a>
    <a href="<?php echo esc_url(aitana_page_url('investment-principles')); ?>">Investments</a>
    <a href="<?php echo esc_url(aitana_page_url('protection')); ?>">Protection</a>
    <a href="<?php echo esc_url(aitana_page_url('about')); ?>">About Us</a>
    <a href="<?php echo esc_url(aitana_page_url('contact')); ?>">Contact</a>
    <a href="tel:01795435094">📞 01795 435094</a>
  </div>
</nav>
