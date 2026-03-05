<?php
/**
 * The footer — shown on every page, includes chatbot
 */
if (!defined('ABSPATH')) {
  exit;
}
?>

  <!-- ─── Footer ──────────────────────────────────────────── -->
  <footer class="site-footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <div class="footer-brand-name">Aitana Financial Services</div>
          <p>Expert financial advisers providing personalised guidance on mortgages, pensions, investments, and protection since 1993.</p>
          <div style="display:flex;gap:12px;margin-top:16px;">
            <a href="tel:01795435094" class="btn btn-primary" style="font-size:0.85rem;padding:10px 20px;">📞 Call Us</a>
            <a href="<?php echo esc_url(aitana_page_url('contact')); ?>" class="btn btn-outline" style="font-size:0.85rem;padding:10px 20px;border-color:rgba(255,255,255,0.3);color:rgba(255,255,255,0.7);">Get In Touch</a>
          </div>
        </div>
        <div class="footer-col">
          <h5>Useful Links</h5>
          <ul>
            <li><a href="<?php echo esc_url(aitana_page_url('mortgages')); ?>">Mortgages</a></li>
            <li><a href="<?php echo esc_url(aitana_page_url('financial-planning')); ?>">Financial Planning</a></li>
            <li><a href="<?php echo esc_url(aitana_page_url('self-employed-pensions')); ?>">Pension Plans for the Self-Employed</a></li>
            <li><a href="<?php echo esc_url(aitana_page_url('investment-principles')); ?>">Investment Principles</a></li>
            <li><a href="<?php echo esc_url(aitana_page_url('protection')); ?>">Protection</a></li>
            <li><a href="<?php echo esc_url(aitana_page_url('contact')); ?>">Contact Us</a></li>
            <li><a href="https://www.theopenworkpartnership.com/privacy-notice/" target="_blank" rel="noopener">Privacy Policy</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h5>Main Office</h5>
          <div class="footer-contact-item"><span>📞</span><a href="tel:01795435094">01795 435094</a></div>
          <div class="footer-contact-item"><span>📧</span><a href="mailto:enquiries@aitana.co.uk">enquiries@aitana.co.uk</a></div>
          <div class="footer-contact-item"><span>📍</span><span>Ground Floor, Unit 4, Markerstudy Business Park, Whitstable, Kent CT5 3FE</span></div>
          <div class="footer-office-title">Taunton Office</div>
          <div class="footer-contact-item"><span>📞</span><a href="tel:01823428314">01823 428314</a></div>
          <div class="footer-contact-item"><span>📍</span><span>43 Bridge Street, Taunton, Somerset TA1 1TP</span></div>
        </div>
        <div class="footer-col">
          <h5>Ask A.D.A.M</h5>
          <p style="font-size:0.88rem;color:rgba(255,255,255,0.55);margin-bottom:16px;">Our AI assistant is available 24/7 to answer your financial questions instantly.</p>
          <button class="btn btn-primary adam-trigger" style="font-size:0.85rem;padding:10px 20px;border:none;cursor:pointer;">Chat with A.D.A.M →</button>
        </div>
      </div>
    </div>
    <div class="container footer-bottom">
      <span>Copyright &copy; <?php echo date('Y'); ?> Aitana Financial Services | All Rights Reserved</span>
      <span><a href="https://www.theopenworkpartnership.com/privacy-notice/" target="_blank" rel="noopener">Privacy Policy</a></span>
    </div>
    <div class="fca-notice">
      <div class="container">
        Aitana Financial Services is a trading name of Kevin Paul Manktelow which is an appointed representative of The Openwork Partnership, a trading style of Openwork Limited which is authorised and regulated by the Financial Conduct Authority registered in England and Wales. The information on this website is for use of residents of the United Kingdom only.
      </div>
    </div>
  </footer>

<?php wp_footer(); ?>
</body>
</html>
