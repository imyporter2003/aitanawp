<?php get_header(); ?>

<section class="page-hero">
  <div class="container">
    <div class="page-hero-breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> / Contact</div>
    <h1>We're Ready To Help</h1>
    <p>Get in touch with our friendly team to book a free, no-obligation consultation with one of our expert financial advisers.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="contact-grid">
      <!-- Contact Info -->
      <div>
        <div class="contact-info-card" style="margin-bottom:28px;">
          <div class="contact-info-group">
            <h4>Main Office — Whitstable, Kent</h4>
            <a href="tel:01795435094" class="contact-link">📞 01795 435094</a>
            <a href="mailto:enquiries@aitana.co.uk" class="contact-link">📧 enquiries@aitana.co.uk</a>
            <div class="contact-link" style="cursor:default;">📍 Ground Floor, Unit 4, Markerstudy Business Park, Whitstable, Kent CT5 3FE</div>
          </div>
          <div class="contact-info-group">
            <h4>Taunton Office — Somerset</h4>
            <a href="tel:01823428314" class="contact-link">📞 01823 428314</a>
            <a href="mailto:enquiries@aitana.co.uk" class="contact-link">📧 enquiries@aitana.co.uk</a>
            <div class="contact-link" style="cursor:default;">📍 43 Bridge Street, Taunton, Somerset TA1 1TP</div>
          </div>
        </div>
        <div class="contact-info-card">
          <h4 style="font-size:1rem;margin-bottom:12px;color:var(--navy);">Or chat with A.D.A.M</h4>
          <p style="font-size:0.9rem;margin-bottom:16px;">Our AI assistant is available 24/7 and can answer most questions instantly.</p>
          <button onclick="document.getElementById('adam-fab').click()" class="btn btn-primary" style="border:none;cursor:pointer;">Open A.D.A.M Chat →</button>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="contact-form-card">
        <h2 style="margin-bottom:8px;font-size:1.5rem;">Send us a message</h2>
        <p style="margin-bottom:28px;font-size:0.9rem;">Fill in the form and one of our advisers will be in touch within one working day.</p>
        <?php echo do_shortcode('[contact-form-7 id="ceab5ba" title="Contact form 1"]'); ?>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
