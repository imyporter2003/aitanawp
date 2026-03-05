<?php
/**
 * Front Page template — Homepage
 */
if (!defined('ABSPATH')) {
  exit;
}
get_header();
?>

<!-- ─── Hero ────────────────────────────────────────────────── -->
<section class="hero">
  <div class="hero-shape"></div>
  <div class="container hero-inner">
    <div class="hero-content">
      <div class="hero-badge">
        <span class="hero-badge-dot"></span>
        FCA Regulated · Est. 1993
      </div>
      <h1>Experts in <span>Mortgages</span> Investments Pensions &amp; Insurance</h1>
      <p class="hero-desc">Expert financial advisers based in Kent and Taunton, giving you the best personalised advice for your circumstances. We've grown through recommendations from happy clients for over 30 years.</p>
      <div class="hero-actions">
        <a href="<?php echo esc_url(aitana_page_url('contact')); ?>" class="btn btn-primary">Get Free Advice</a>
        <button class="btn btn-white adam-trigger">Chat with A.D.A.M</button>
        <a href="tel:01795435094" class="btn btn-outline" style="color:#fff;border-color:#fff;">Call 01795 435094</a>
      </div>
      <div class="hero-stats">
        <div><div class="hero-stat-num">30+</div><div class="hero-stat-label">Years of Experience</div></div>
        <div><div class="hero-stat-num">4,500+</div><div class="hero-stat-label">Openwork Advisers</div></div>
        <div><div class="hero-stat-num">FCA</div><div class="hero-stat-label">Authorised &amp; Regulated</div></div>
      </div>
    </div>
    <div class="hero-image-wrap">
      <div class="hero-image-card">
        <img src="https://aitana.co.uk/wp-content/uploads/2023/03/Frame-1-1024x684.jpg" alt="Aitana Financial Services" />
        <div class="hero-floating-badge">✓ Whole of Market Advice<br>Since 1993</div>
      </div>
    </div>
  </div>
</section>

<!-- ─── Trust Bar ─────────────────────────────────────────────── -->
<section class="trust-bar">
  <div class="container trust-bar-inner">
    <div class="trust-item"><div class="trust-icon">✓</div><span>Expert Advice</span></div>
    <div class="trust-item"><div class="trust-icon">👤</div><span>Personal Service</span></div>
    <div class="trust-item"><div class="trust-icon">🤝</div><span>Continuing Support</span></div>
    <div class="trust-item"><div class="trust-icon">🏛️</div><span>FCA Authorised</span></div>
    <div class="trust-item"><div class="trust-icon">🇬🇧</div><span>Openwork Partnership</span></div>
  </div>
</section>

<!-- ─── Pillars ───────────────────────────────────────────────── -->
<section class="section pillars">
  <div class="container">
    <p class="section-sub" style="margin-bottom:16px;font-weight:600;color:var(--orange);text-transform:uppercase;font-size:0.82rem;letter-spacing:0.08em;">Welcome to Aitana Financial Services</p>
    <h2 class="section-title">Why Choose Aitana?</h2>
    <p class="section-sub">Aitana Financial Services began in 1993, and today we cover the whole of the country, focusing on giving the best advice for your circumstances.</p>
    <div class="pillars-grid">
      <div class="pillar-card"><div class="pillar-icon">🎯</div><h3>Expert Advice</h3><p>Our highly qualified advisers cut through complexity to give you clear, personalised guidance that truly works for your financial situation.</p></div>
      <div class="pillar-card"><div class="pillar-icon">🤝</div><h3>Personal Service</h3><p>We take the time to understand you — your goals, your family, your future. You're not just a case number to us.</p></div>
      <div class="pillar-card"><div class="pillar-icon">🔄</div><h3>Continuing Support</h3><p>Our relationship doesn't end when you sign. We review your plans regularly to make sure they keep working as your life changes.</p></div>
    </div>
  </div>
</section>

<!-- ─── Services ─────────────────────────────────────────────── -->
<section class="section services">
  <div class="container">
    <p class="section-sub" style="margin-bottom:16px;font-weight:600;color:var(--orange);text-transform:uppercase;font-size:0.82rem;letter-spacing:0.08em;">What We Do</p>
    <h2 class="section-title">Our Services</h2>
    <p class="section-sub">From your first mortgage to retirement planning, we're here at every stage of your financial journey.</p>
    <div class="services-grid">
      <div class="service-card">
        <div class="service-card-img"><span class="service-card-category">Mortgages</span><img src="https://aitana.co.uk/wp-content/uploads/2023/03/Frame-1-1024x684.jpg" alt="Mortgage advice" /></div>
        <div class="service-card-body"><h3>Re-Mortgage Advice</h3><p>Whether you're looking to get a better rate, release equity, or restructure your debt, our advisers search the whole market to find the best deal for you.</p><a href="<?php echo esc_url(aitana_page_url('mortgages')); ?>" class="btn btn-outline">Find out more</a></div>
      </div>
      <div class="service-card">
        <div class="service-card-img"><span class="service-card-category">Investments</span><img src="https://aitana.co.uk/wp-content/uploads/2023/03/frame-3-1024x685.jpg" alt="Investment principles" /></div>
        <div class="service-card-body"><h3>Investment Principles</h3><p>Building wealth takes patience and the right strategy. We help you understand investment principles and create a portfolio aligned to your risk appetite and goals.</p><a href="<?php echo esc_url(aitana_page_url('investment-principles')); ?>" class="btn btn-outline">Find out more</a></div>
      </div>
      <div class="service-card">
        <div class="service-card-img"><span class="service-card-category">Pensions</span><img src="https://aitana.co.uk/wp-content/uploads/2023/03/frame-4-1024x648.jpg" alt="Pension plans" /></div>
        <div class="service-card-body"><h3>Pension Plans for the Self-Employed</h3><p>Being your own boss is rewarding, but pension planning is often neglected. We'll help you build a tax-efficient retirement fund on your terms.</p><a href="<?php echo esc_url(aitana_page_url('self-employed-pensions')); ?>" class="btn btn-outline">Find out more</a></div>
      </div>
      <div class="service-card">
        <div class="service-card-img"><span class="service-card-category">Protection</span><img src="https://aitana.co.uk/wp-content/uploads/2023/03/Frame-2-1024x683.jpg" alt="Protection insurance" /></div>
        <div class="service-card-body"><h3>Protection</h3><p>Life is unpredictable. We'll find the right life insurance, critical illness, and income protection cover to keep you and your family secure.</p><a href="<?php echo esc_url(aitana_page_url('protection')); ?>" class="btn btn-outline">Find out more</a></div>
      </div>
    </div>
  </div>
</section>

<!-- ─── About ────────────────────────────────────────────────── -->
<section class="section about">
  <div class="container about-inner">
    <div>
      <span class="about-tag">About Us</span>
      <h2>What Does A Financial Adviser Do?</h2>
      <p class="about-desc">Michelle Strelley, one of our expert advisers, explains the role of a financial adviser and why having professional guidance makes a real difference to your financial outcomes.</p>
      <div class="about-list">
        <div class="about-list-item"><div class="about-list-icon">📊</div><div><h4>Holistic Financial Review</h4><p>We look at your whole financial picture — income, debts, savings, goals — before making any recommendations.</p></div></div>
        <div class="about-list-item"><div class="about-list-icon">📄</div><div><h4>Regulated Advice</h4><p>All our advice is regulated by the FCA, meaning you have full consumer protections and can trust the guidance you receive.</p></div></div>
        <div class="about-list-item"><div class="about-list-icon">🔍</div><div><h4>Whole of Market Access</h4><p>As part of The Openwork Partnership, we have access to thousands of products from across the market.</p></div></div>
      </div>
      <a href="<?php echo esc_url(aitana_page_url('financial-planning')); ?>" class="btn btn-primary">Learn more →</a>
    </div>
    <div class="about-image-wrap">
      <img src="https://aitana.co.uk/wp-content/uploads/2023/03/frame-3-1024x685.jpg" alt="Financial adviser at Aitana" />
      <div class="about-detail-badge"><span>1993</span>Established</div>
    </div>
  </div>
</section>

<!-- ─── CTA Banner ───────────────────────────────────────────── -->
<section class="cta-banner">
  <div class="container cta-banner-inner">
    <div class="cta-banner-text">
      <h2>We're Ready To Help...</h2>
      <p>Book a free consultation with one of our expert advisers. No obligation, no jargon — just clear, friendly advice.</p>
    </div>
    <div class="cta-banner-actions">
      <a href="<?php echo esc_url(aitana_page_url('contact')); ?>" class="btn btn-white">Get In Touch</a>
      <a href="tel:01795435094" class="btn btn-outline" style="border-color:#fff;color:#fff;">01795 435094</a>
    </div>
  </div>
</section>

<!-- ─── Google Reviews (Trustindex) ──────────────────────── -->
<section class="section-sm" style="background:var(--bg-white);padding:56px 0;">
  <div class="container">
    <h2 class="section-title" style="margin-bottom:8px;">What Our Clients Say</h2>
    <p class="section-sub">Rated 5 stars by hundreds of happy clients across the UK.</p>
    <?php echo do_shortcode('[trustindex no-registration=google]'); ?>
  </div>
</section>

<!-- ─── Openwork ─────────────────────────────────────────────── -->
<section class="openwork">
  <div class="container">
    <div class="ow-logo">The Openwork Partnership</div>
    <p>Aitana Financial Services is a trading name of Kevin Paul Manktelow which is an appointed representative of The Openwork Partnership, a trading style of Openwork Limited which is authorised and regulated by the Financial Conduct Authority.</p>
    <p>The Openwork Partnership is one of the UK's largest Financial Advice networks, with over 4,500 advisers and in excess of 700 appointed representatives based throughout the UK.</p>
    <p style="margin-top:8px;font-style:italic;">Approved by The Openwork Partnership on 29th September 2025</p>
  </div>
</section>

<?php get_footer(); ?>
