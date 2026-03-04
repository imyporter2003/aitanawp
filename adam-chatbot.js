/**
 * A.D.A.M — Aitana Digital Assistance Manager
 * Standalone chatbot widget for WordPress / any HTML site
 *
 * CONFIGURATION: Change the URL below to wherever your API is hosted.
 * Leave as empty string '' to run in demo mode (no real AI responses).
 */
const ADAM_API_URL = ''; // e.g. 'https://aitana-ruby.vercel.app/'

(function () {
    'use strict';

    /* ─── Quick Questions ────────────────────────────────────────────────────── */
    const QUICK_QUESTIONS = [
        'What services do you offer?',
        'Tell me about Mortgages',
        'How can I contact you?',
        'Speak to a human',
    ];

    /* ─── Proactive nudges ───────────────────────────────────────────────────── */
    const NUDGES = [
        "Still there? I'm here if you have any more questions about mortgages or pensions! 😊",
        "Just checking in – let me know if you'd like to dive deeper into any financial topics. 🏡",
        "I'm still here! Feel free to ask anything about Aitana Financial Services. 💰",
        "Don't be shy! If you need help with your retirement planning, just shout. 🚀",
    ];

    /* ─── Demo responses when no API is configured ───────────────────────────── */
    const DEMO_RESPONSES = {
        default: "Thank you for your message! To enable live AI responses, please configure the ADAM_API_URL in adam-chatbot.js to point to your API endpoint. In the meantime, you can reach us at 01795 435094 or enquiries@aitana.co.uk.",
        mortgage: "Great question about mortgages! Aitana Financial Services offers expert mortgage advice covering residential mortgages, remortgages, buy-to-let, and more. Our advisers search the whole market to find the best deal for your circumstances. Call us on 01795 435094 to speak with Anna Andrews, our mortgage specialist.",
        pension: "Pensions are one of our key areas of expertise! We help self-employed individuals, employed people, and business owners plan for retirement. Whether you're starting fresh or consolidating existing pensions, we'll create a plan tailored to you. Get in touch at enquiries@aitana.co.uk.",
        investment: "Our investment advice is built on sound principles – understanding your risk tolerance, diversifying your portfolio, and working towards your long-term financial goals. We're part of The Openwork Partnership, giving you access to a wide range of investment products.",
        protection: "Protecting you and your family is fundamental. We offer life insurance, critical illness cover, income protection, and business protection. We'll find the right cover at the right price for your situation.",
        contact: "You can reach us at:\n\n📞 Main Office: 01795 435094\n📍 Ground Floor, Unit 4, Markerstudy Business Park, Whitstable, Kent CT5 3FE\n\n📞 Taunton Office: 01823 428314\n📍 43 Bridge Street, Taunton, Somerset TA1 1TP\n\n📧 enquiries@aitana.co.uk\n\nWe'd love to help you!",
        human: "Of course! Our friendly team is ready to help you.\n\n📞 Call us: 01795 435094 (Main) or 01823 428314 (Taunton)\n📧 Email: enquiries@aitana.co.uk\n\nWe're here Monday–Friday during business hours.",
        services: "Aitana Financial Services offers:\n\n🏠 **Mortgages** – First-time buyer, remortgage, buy-to-let\n📈 **Investments** – Portfolio building & management\n🏖️ **Pensions** – Retirement planning & self-employed pensions\n🛡️ **Protection** – Life, critical illness & income protection\n📊 **Financial Planning** – Holistic advice for your future\n\nWe've been helping clients since 1993. How can we help you?",
    };

    /* ─── State ─────────────────────────────────────────────────────────────── */
    let messages = [];
    let isLoading = false;
    let isOpen = false;
    let proactiveTimer = null;
    let sessionId = '';
    let userMemory = {};

    /* ─── Session Init ──────────────────────────────────────────────────────── */
    function initSession() {
        try {
            const savedId = localStorage.getItem('aitana_session_id');
            const savedMemory = localStorage.getItem('aitana_user_memory');
            if (savedMemory) userMemory = JSON.parse(savedMemory);
            if (savedId) {
                sessionId = savedId;
            } else {
                sessionId = 'widget-' + Date.now();
                localStorage.setItem('aitana_session_id', sessionId);
            }
        } catch (e) {
            sessionId = 'widget-' + Date.now();
        }
    }

    /* ─── DOM Helpers ────────────────────────────────────────────────────────── */
    function el(id) { return document.getElementById(id); }

    function addMessage(role, content) {
        messages.push({ role, content, id: Date.now().toString() + Math.random() });
        renderMessages();
        if (role === 'ai') resetProactiveTimer();
    }

    function renderMessages() {
        const area = el('adam-msg-area');
        if (!area) return;
        area.innerHTML = '';
        messages.forEach(msg => {
            const row = document.createElement('div');
            row.className = 'adam-msg-row' + (msg.role === 'user' ? ' user' : '');
            if (msg.role === 'ai') {
                const avt = document.createElement('div');
                avt.className = 'adam-msg-avt';
                avt.textContent = 'A';
                row.appendChild(avt);
            }
            const bubble = document.createElement('div');
            bubble.className = 'adam-bubble ' + msg.role;
            bubble.innerHTML = msg.content.replace(/\n/g, '<br>').replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
            row.appendChild(bubble);
            area.appendChild(row);
        });
        if (isLoading) {
            const row = document.createElement('div');
            row.className = 'adam-msg-row';
            row.id = 'adam-typing-row';
            const avt = document.createElement('div');
            avt.className = 'adam-msg-avt';
            avt.textContent = 'A';
            const bubble = document.createElement('div');
            bubble.className = 'adam-bubble ai adam-typing';
            bubble.innerHTML = '<span class="adam-typing-dot"></span><span class="adam-typing-dot"></span><span class="adam-typing-dot"></span>';
            row.appendChild(avt);
            row.appendChild(bubble);
            area.appendChild(row);
        }
        area.scrollTop = area.scrollHeight;
    }

    /* ─── Proactive Timer ────────────────────────────────────────────────────── */
    function resetProactiveTimer() {
        if (proactiveTimer) clearTimeout(proactiveTimer);
        proactiveTimer = setTimeout(() => {
            if (isOpen) {
                addMessage('ai', NUDGES[Math.floor(Math.random() * NUDGES.length)]);
            }
        }, 45000);
    }

    /* ─── Demo response picker ───────────────────────────────────────────────── */
    function getDemoResponse(text) {
        const t = text.toLowerCase();
        if (t.includes('mortgage') || t.includes('remortgage') || t.includes('broker')) return DEMO_RESPONSES.mortgage;
        if (t.includes('pension') || t.includes('retire') || t.includes('self-employed')) return DEMO_RESPONSES.pension;
        if (t.includes('invest') || t.includes('portfolio') || t.includes('savings')) return DEMO_RESPONSES.investment;
        if (t.includes('protect') || t.includes('insurance') || t.includes('life cover')) return DEMO_RESPONSES.protection;
        if (t.includes('contact') || t.includes('phone') || t.includes('call') || t.includes('address') || t.includes('email')) return DEMO_RESPONSES.contact;
        if (t.includes('human') || t.includes('person') || t.includes('speak to') || t.includes('adviser')) return DEMO_RESPONSES.human;
        if (t.includes('service') || t.includes('what do') || t.includes('what can') || t.includes('help')) return DEMO_RESPONSES.services;
        return DEMO_RESPONSES.default;
    }

    /* ─── Chat API Call ──────────────────────────────────────────────────────── */
    async function performChat(text) {
        isLoading = true;
        renderMessages();
        try {
            if (!ADAM_API_URL) {
                await new Promise(r => setTimeout(r, 900 + Math.random() * 600));
                const response = getDemoResponse(text);
                isLoading = false;
                addMessage('ai', response);
                return response;
            }

            const history = messages
                .filter(m => m.role === 'user' || m.role === 'ai')
                .slice(-10)
                .map(m => ({ role: m.role === 'ai' ? 'assistant' : 'user', content: m.content }));

            const res = await fetch(ADAM_API_URL + '/api/chat', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ message: text, history, userMemory }),
            });

            if (!res.ok) throw new Error('API error ' + res.status);
            const data = await res.json();
            const fullContent = data.response;

            if (data.memoryUpdate) {
                userMemory = Object.assign({}, userMemory, data.memoryUpdate);
                try { localStorage.setItem('aitana_user_memory', JSON.stringify(userMemory)); } catch (e) { }
            }

            isLoading = false;
            addMessage('ai', fullContent);
            return fullContent;

        } catch (err) {
            console.error('[A.D.A.M]', err);
            const errMsg = "I'm having trouble connecting right now. Please call us on 01795 435094 or email enquiries@aitana.co.uk.";
            isLoading = false;
            addMessage('ai', errMsg);
            return errMsg;
        }
    }

    /* ─── Send handler ───────────────────────────────────────────────────────── */
    function sendMessage() {
        const input = el('adam-input');
        if (!input) return;
        const text = input.value.trim();
        if (!text || isLoading) return;
        input.value = '';
        addMessage('user', text);
        performChat(text);
    }

    /* ─── Toggle popup ───────────────────────────────────────────────────────── */
    function togglePopup() {
        isOpen = !isOpen;
        const popup = el('adam-popup');
        const fab = el('adam-fab');
        if (!popup) return;
        if (isOpen) {
            popup.classList.add('adam-open');
            fab.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>';
            resetProactiveTimer();
            setTimeout(() => { el('adam-input') && el('adam-input').focus(); }, 350);
            const lbl = el('adam-fab-label');
            if (lbl) lbl.style.display = 'none';
        } else {
            popup.classList.remove('adam-open');
            fab.innerHTML = 'A';
            const notif = el('adam-fab-notif');
            if (notif) notif.style.display = '';
            const lbl = el('adam-fab-label');
            if (lbl) lbl.style.display = '';
            if (proactiveTimer) clearTimeout(proactiveTimer);
        }
    }

    /* ─── Build widget HTML ───────────────────────────────────────────────────── */
    function buildWidget() {
        const wrapper = document.createElement('div');
        wrapper.id = 'adam-widget-root';
        wrapper.innerHTML = `
      <div id="adam-widget-trigger">
        <div id="adam-fab-label">Chat with A.D.A.M</div>
        <div id="adam-fab" role="button" aria-label="Open A.D.A.M chatbot" tabindex="0">A
          <div id="adam-fab-notif"></div>
        </div>
      </div>
      <div id="adam-popup" role="dialog" aria-label="A.D.A.M chat window" aria-hidden="true">
        <div class="adam-header">
          <div class="adam-header-left">
            <div class="adam-avatar">A</div>
            <div>
              <div class="adam-header-name">A.D.A.M<span class="adam-online-dot" title="Online"></span></div>
              <div class="adam-header-sub">Aitana Digital Assistance Manager</div>
            </div>
          </div>
          <div class="adam-header-actions">
            <button class="adam-header-btn" id="adam-close-btn" aria-label="Close chat" title="Close">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </button>
          </div>
        </div>
        <div class="adam-messages" id="adam-msg-area"></div>
        <div class="adam-quick-bar" id="adam-quick-bar"></div>
        <div class="adam-input-area">
          <input type="text" class="adam-input" id="adam-input" placeholder="Ask A.D.A.M anything…" autocomplete="off" maxlength="500" />
          <button class="adam-send-btn" id="adam-send-btn" aria-label="Send message">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>
            </svg>
          </button>
        </div>
      </div>
    `;
        document.body.appendChild(wrapper);
    }

    function buildQuickBar() {
        const bar = el('adam-quick-bar');
        if (!bar) return;
        QUICK_QUESTIONS.forEach(q => {
            const btn = document.createElement('button');
            btn.className = 'adam-quick-btn';
            btn.textContent = q;
            btn.addEventListener('click', () => {
                addMessage('user', q);
                performChat(q);
            });
            bar.appendChild(btn);
        });
    }

    function bindEvents() {
        const fab = el('adam-fab');
        const closeBtn = el('adam-close-btn');
        const sendBtn = el('adam-send-btn');
        const input = el('adam-input');

        if (fab) {
            fab.addEventListener('click', (e) => { e.stopPropagation(); togglePopup(); });
            fab.addEventListener('keydown', (e) => { if (e.key === 'Enter' || e.key === ' ') togglePopup(); });
        }
        const label = el('adam-fab-label');
        if (label) label.addEventListener('click', togglePopup);
        if (closeBtn) closeBtn.addEventListener('click', () => { if (isOpen) togglePopup(); });
        if (sendBtn) sendBtn.addEventListener('click', sendMessage);
        if (input) {
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
            });
        }
    }

    function init() {
        initSession();
        buildWidget();
        buildQuickBar();
        bindEvents();
        addMessage('ai', 'Hello! This is A.D.A.M (Aitana Digital Assistance Manager). How can I help you with your financial questions today?');
        resetProactiveTimer();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
