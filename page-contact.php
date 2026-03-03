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
        <?php if (function_exists('wpcf7_get_tag')): ?>
          <!-- Contact Form 7 shortcode — replace ID with your form ID after setup -->
          <?php echo do_shortcode('[contact-form-7 id="YOUR_FORM_ID" title="Contact form 1"]'); ?>
        <?php
else: ?>
          <form id="aitana-contact-form" onsubmit="aitanaSubmitForm(event)">
            <div class="form-row">
              <div class="form-group"><label for="firstName">First Name *</label><input type="text" id="firstName" required placeholder="Jane" /></div>
              <div class="form-group"><label for="lastName">Last Name *</label><input type="text" id="lastName" required placeholder="Smith" /></div>
            </div>
            <div class="form-group"><label for="email">Email Address *</label><input type="email" id="email" required placeholder="jane@example.com" /></div>
            <div class="form-group"><label for="phone">Phone Number</label><input type="tel" id="phone" placeholder="07700 900000" /></div>
            <div class="form-group">
              <label for="service">What can we help you with?</label>
              <select id="service">
                <option value="">Please select…</option>
                <option>Mortgages</option><option>Remortgage</option><option>Pensions</option>
                <option>Investments</option><option>Protection &amp; Insurance</option>
                <option>Financial Planning</option><option>Other</option>
              </select>
            </div>
            <div class="form-group"><label for="message">Message</label><textarea id="message" placeholder="Tell us a little about your situation…"></textarea></div>
            <p class="form-privacy">The internet is not a secure medium and the privacy of your data cannot be guaranteed. By submitting this form you consent to us contacting you. See our <a href="https://www.theopenworkpartnership.com/privacy-notice/" target="_blank" rel="noopener">Privacy Policy</a>.</p>
            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;border:none;cursor:pointer;">Send Message →</button>
            <div id="form-success" style="display:none;margin-top:16px;padding:14px;background:var(--orange-light);border-radius:8px;color:var(--navy);font-size:0.9rem;font-weight:500;">✅ Thank you! We'll be in touch shortly.</div>
          </form>
          <script>
            function aitanaSubmitForm(e) {
              e.preventDefault();
              document.getElementById('aitana-contact-form').style.opacity = '0.4';
              document.getElementById('form-success').style.display = 'block';
            }
          </script>
        <?php
endif; ?>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
