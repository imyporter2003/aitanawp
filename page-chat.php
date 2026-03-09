<?php
/**
 * Template Name: Chat with an Adviser
 *
 * A full-page React-powered live chat portal.
 * Customers can see which advisers are online and start a real-time chat.
 *
 * To use:
 *  1. Place this file in your active theme directory.
 *  2. In WordPress Admin → Pages → Add New, create a page called "Chat with an Adviser".
 *  3. Under "Page Attributes", select "Chat with an Adviser" as the template.
 *  4. Publish and visit the page.
 *
 * Configuration:
 *  Set AITANA_CHAT_SERVER_URL in wp-config.php:
 *    define( 'AITANA_CHAT_SERVER_URL', 'https://your-server.com' );
 *  Or edit the default below.
 */

// Get the Chat Server URL from wp-config.php, or use the live backend if not defined
$chat_server_url = defined('AITANA_CHAT_SERVER_URL') ? AITANA_CHAT_SERVER_URL : 'https://aitana-livechat-backend-production.up.railway.app';


get_header();
?>

<main id="site-main" class="chat-portal-page">

  <!-- ── Hero ──────────────────────────────────────────────────────── -->
  <section class="chat-hero">
    <div class="container">
      <div class="chat-hero-inner">
        <div class="chat-hero-badge">
          <span class="chat-hero-badge-dot"></span>
          Live Chat Available
        </div>
        <h1>Chat with an <span>Aitana Adviser</span></h1>
        <p class="chat-hero-desc">
          Got a question about mortgages, pensions, investments or insurance?
          Connect instantly with one of our FCA-authorised advisers — no phone queues, no waiting rooms.
        </p>
        <div class="chat-trust-row">
          <span class="chat-trust-item">✅ Free, no-obligation advice</span>
          <span class="chat-trust-item">🔒 Confidential & secure</span>
          <span class="chat-trust-item">⭐ 5-star rated service</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ── Adviser Directory ──────────────────────────────────────────── -->
  <section class="chat-directory section">
    <div class="container">
      <h2 class="section-title">Our Advisers</h2>
      <p class="section-sub">Click "Start Chat" to begin a real-time conversation with an available adviser.</p>

      <!-- Loading / error states -->
      <div id="chat-loading" class="chat-loading-state">
        <div class="chat-spinner"></div>
        <p>Loading advisers…</p>
      </div>
      <div id="chat-no-advisers" class="chat-no-advisers" style="display:none;">
        <div class="chat-offline-icon">💬</div>
        <h3>No advisers available right now</h3>
        <p>Our team is offline at the moment. Please call us on <a href="tel:01795435094">01795 435094</a> or <a href="<?php echo esc_url(home_url('/contact')); ?>">send us a message</a>.</p>
      </div>

      <!-- Adviser cards grid -->
      <div id="adviser-grid" class="adviser-grid" style="display:none;"></div>
    </div>
  </section>

  <!-- ── Chat Widget (modal) ────────────────────────────────────────── -->
  <div id="chat-overlay" class="chat-overlay" style="display:none;" aria-modal="true" role="dialog" aria-label="Chat with adviser">
    <div class="chat-modal">
      <!-- Chat header -->
      <div class="chat-modal-header" id="chat-modal-header">
        <div class="chat-modal-adviser">
          <div class="chat-modal-avatar" id="chat-modal-avatar">?</div>
          <div>
            <div class="chat-modal-name" id="chat-modal-name">Adviser</div>
            <div class="chat-modal-status">
              <span class="status-dot available"></span>
              <span id="chat-modal-status-text">Online &amp; Available</span>
            </div>
          </div>
        </div>
        <button class="chat-close-btn" id="chat-close-btn" aria-label="Close chat">✕</button>
      </div>

      <!-- Pre-chat form (shown before session starts) -->
      <div id="pre-chat-form" class="pre-chat-form">
        <p class="pre-chat-intro">Before we start, we just need a couple of details:</p>
        <div class="chat-form-group">
          <label for="customer-name">Your name <span class="required">*</span></label>
          <input type="text" id="customer-name" placeholder="e.g. John Smith" required />
        </div>
        <div class="chat-form-group">
          <label for="customer-email">Email address <span class="required">*</span></label>
          <input type="email" id="customer-email" placeholder="john@example.com" />
          <small>So we can send you a transcript if you'd like one.</small>
        </div>
        <button class="btn btn-primary chat-start-btn" id="start-chat-btn">
          Start chat →
        </button>
        <p class="chat-disclaimer">
          By starting this chat you agree that your data will be processed in accordance with our
          <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>" target="_blank">Privacy Policy</a>.
        </p>
      </div>

      <!-- Chat messages area (hidden until session starts) -->
      <div id="chat-session" class="chat-session" style="display:none;">
        <div id="chat-messages" class="chat-messages-list"></div>
        <div id="chat-typing" class="chat-typing-indicator" style="display:none;">
          <span class="typing-dot"></span>
          <span class="typing-dot"></span>
          <span class="typing-dot"></span>
        </div>
        <div class="chat-input-row">
          <textarea
            id="chat-input"
            class="chat-textarea-widget"
            placeholder="Type a message… (Enter to send)"
            rows="1"
          ></textarea>
          <button id="chat-send-btn" class="chat-send-btn" aria-label="Send">➤</button>
        </div>
      </div>
    </div>
  </div>

</main>

<?php get_footer(); ?>

<!-- ── Socket.io client library ────────────────────────────────────── -->
<script src="<?php echo esc_url($chat_server_url . '/socket.io/socket.io.js'); ?>"></script>

<script>
(function () {
  'use strict';

  const SERVER_URL = <?php echo json_encode($chat_server_url); ?>;
  let socket = null;
  let activeAdviserId = null;
  let sessionId = null;
  let customerName = '';
  let customerEmail = '';
  let typingTimeout = null;
  let adviserIsTyping = false;

  // ── DOM refs ──────────────────────────────────────────────────────────────
  const $ = id => document.getElementById(id);
  const $overlay     = $('chat-overlay');
  const $preChatForm = $('pre-chat-form');
  const $chatSession = $('chat-session');
  const $messages    = $('chat-messages');
  const $typingEl    = $('chat-typing');
  const $input       = $('chat-input');
  const $sendBtn     = $('chat-send-btn');
  const $startBtn    = $('start-chat-btn');
  const $closeBtn    = $('chat-close-btn');
  const $grid        = $('adviser-grid');
  const $loading     = $('chat-loading');
  const $noAdvisers  = $('chat-no-advisers');

  // ── Load advisers ─────────────────────────────────────────────────────────
  async function loadAdvisers() {
    try {
      const res = await fetch(SERVER_URL + '/advisers/all');
      const all = await res.json();

      $loading.style.display = 'none';

      if (!all || all.length === 0) {
        $noAdvisers.style.display = 'block';
        return;
      }

      // Separate online/offline
      const online  = all.filter(a => a.is_online);
      const offline = all.filter(a => !a.is_online);
      const sorted  = [...online, ...offline];

      $grid.style.display = 'grid';
      $grid.innerHTML = sorted.map(buildAdviserCard).join('');

      // Bind "Start Chat" buttons
      $grid.querySelectorAll('[data-adviser-id]').forEach(btn => {
        btn.addEventListener('click', () => {
          const id    = btn.dataset.adviserId;
          const name  = btn.dataset.adviserName;
          openChatWidget(id, name);
        });
      });

      // Listen for real-time adviser status updates
      if (!socket) initSocket();

    } catch (err) {
      $loading.style.display = 'none';
      $noAdvisers.style.display = 'block';
      console.error('[Aitana Chat] Could not load advisers:', err);
    }
  }

  function buildAdviserCard(adviser) {
    const statusClass = adviser.is_online ? adviser.status || 'available' : 'offline';
    const statusLabel = adviser.is_online
        ? (adviser.status === 'busy' ? 'Busy' : 'Available now')
        : 'Offline';
    const canChat = adviser.is_online && adviser.status !== 'offline';
    const initials = adviser.name.split(' ').map(w => w[0]).join('').toUpperCase().slice(0, 2);

    return `
      <div class="adviser-card${adviser.is_online ? ' adviser-card--online' : ''}">
        <div class="adviser-card-avatar">${initials}</div>
        <div class="adviser-card-status ${statusClass}">
          <span class="status-dot ${statusClass}"></span>
          ${statusLabel}
        </div>
        <h3 class="adviser-card-name">${escapeHtml(adviser.name)}</h3>
        <p class="adviser-card-title">${escapeHtml(adviser.title)}</p>
        <p class="adviser-card-specialty">${escapeHtml(adviser.specialty)}</p>
        ${canChat
          ? `<button class="btn btn-primary adviser-chat-btn" data-adviser-id="${adviser.id}" data-adviser-name="${escapeHtml(adviser.name)}">
               💬 Start Chat
             </button>`
          : `<button class="btn adviser-chat-btn--disabled" disabled>
               ${adviser.is_online ? '⏳ Currently busy' : '○ Offline'}
             </button>`
        }
      </div>`;
  }

  function escapeHtml(str) {
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

  // ── Socket.io (customer side) ─────────────────────────────────────────────
  function initSocket() {
    socket = io(SERVER_URL);

    socket.on('advisers:updated', () => {
      // Refresh the adviser grid when statuses change
      loadAdvisers();
    });

    socket.on('session:started', (data) => {
      sessionId = data.sessionId;
      $preChatForm.style.display = 'none';
      $chatSession.style.display = 'flex';
      appendMessage('system', `You're now chatting with ${data.adviserName}. They'll be with you shortly!`);
    });

    socket.on('message:received', (msg) => {
      if (msg.session_id !== sessionId) return;
      if (msg.sender_type === 'adviser') {
        appendMessage('adviser', msg.content, msg.sender_name);
        hideTyping();
      }
    });

    socket.on('typing:start', ({ senderType }) => {
      if (senderType === 'adviser') showTyping();
    });

    socket.on('typing:stop', ({ senderType }) => {
      if (senderType === 'adviser') hideTyping();
    });

    socket.on('error', (err) => {
      appendMessage('system', '⚠️ ' + (err.message || 'An error occurred'));
    });
  }

  // ── Chat widget ────────────────────────────────────────────────────────────
  function openChatWidget(adviserId, adviserName) {
    activeAdviserId = adviserId;
    $('chat-modal-name').textContent = adviserName;
    $('chat-modal-avatar').textContent = adviserName.split(' ').map(w => w[0]).join('').toUpperCase().slice(0, 2);
    $overlay.style.display = 'flex';
    document.body.style.overflow = 'hidden';
    if (!socket) initSocket();
  }

  $closeBtn.addEventListener('click', closeChat);
  $overlay.addEventListener('click', (e) => {
    if (e.target === $overlay) closeChat();
  });

  function closeChat() {
    $overlay.style.display = 'none';
    document.body.style.overflow = '';
    if (sessionId && socket) {
      socket.emit('adviser:close-session', { sessionId }); // polite close
    }
  }

  // Pre-chat form submit
  $startBtn.addEventListener('click', () => {
    const nameEl  = $('customer-name');
    const emailEl = $('customer-email');
    customerName  = nameEl.value.trim();
    customerEmail = emailEl.value.trim();

    if (!customerName) {
      nameEl.focus();
      nameEl.style.borderColor = '#dc2626';
      return;
    }
    nameEl.style.borderColor = '';

    if (!socket) initSocket();

    socket.emit('customer:start-chat', {
      adviserId: activeAdviserId,
      customerName,
      customerEmail,
    });
    $startBtn.disabled = true;
    $startBtn.textContent = 'Connecting…';
  });

  // Send message
  function sendMessage() {
    const content = $input.value.trim();
    if (!content || !sessionId) return;
    socket.emit('message:send', {
      sessionId,
      content,
      senderType: 'customer',
      senderName: customerName || 'You',
    });
    appendMessage('customer', content, 'You');
    $input.value = '';
    $input.style.height = 'auto';
  }

  $sendBtn.addEventListener('click', sendMessage);
  $input.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault();
      sendMessage();
    }
  });

  $input.addEventListener('input', () => {
    if (!socket || !sessionId) return;
    socket.emit('typing:start', { sessionId, senderType: 'customer' });
    clearTimeout(typingTimeout);
    typingTimeout = setTimeout(() => {
      socket.emit('typing:stop', { sessionId, senderType: 'customer' });
    }, 1500);
    // Auto-resize
    $input.style.height = 'auto';
    $input.style.height = Math.min($input.scrollHeight, 100) + 'px';
  });

  // ── Message rendering ──────────────────────────────────────────────────────
  function appendMessage(type, content, senderName) {
    const div = document.createElement('div');
    const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

    if (type === 'system') {
      div.className = 'chat-msg-system';
      div.textContent = content;
    } else {
      div.className = `chat-msg chat-msg--${type}`;
      div.innerHTML = `
        <div class="chat-msg-bubble">${escapeHtml(content)}</div>
        <div class="chat-msg-meta">${escapeHtml(senderName || type)} · ${time}</div>`;
    }

    $messages.appendChild(div);
    $messages.scrollTop = $messages.scrollHeight;
  }

  function showTyping() {
    if (!adviserIsTyping) {
      adviserIsTyping = true;
      $typingEl.style.display = 'flex';
      $messages.scrollTop = $messages.scrollHeight;
    }
  }

  function hideTyping() {
    adviserIsTyping = false;
    $typingEl.style.display = 'none';
  }

  // ── Init ───────────────────────────────────────────────────────────────────
  loadAdvisers();

  // Keyboard: Escape closes chat
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && $overlay.style.display !== 'none') closeChat();
  });

})();
</script>
