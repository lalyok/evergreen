(function () {
  'use strict';

  const dataUrl = (window.EvergreenQuiz && window.EvergreenQuiz.dataUrl) || (window.location.origin + '/wp-content/themes/evergreen/assets/data/quiz.json');
  const container = document.getElementById('evergreen-quiz');
  if (!container) return;

  let quiz = null;
  let currentIndex = 0;
  const selections = {}; // questionId -> [answerIds]

  function createEl(tag, attrs = {}, ...children) {
    const el = document.createElement(tag);
    Object.keys(attrs).forEach(k => el.setAttribute(k, attrs[k]));
    children.forEach(c => {
      if (typeof c === 'string') el.appendChild(document.createTextNode(c));
      else if (c) el.appendChild(c);
    });
    return el;
  }

  function renderQuestion(idx) {
    container.innerHTML = '';
    const q = quiz.questions[idx];
    const title = createEl('h3', {}, q.title);
    const list = createEl('div', { class: 'quiz-answers' });
    q.answers.forEach(a => {
      const id = 'quiz' + a.id;
      const label = createEl('label', { class: 'quiz-label checkbox-label' });
      const input = createEl('input', { class: 'checkbox',type: 'checkbox', id: id, 'data-answer-id': a.id });
      const checkmark = createEl('span', { class: 'checkmark' });
      if (selections[q.id] && selections[q.id].includes(a.id)) input.checked = true;
      label.appendChild(input);
      label.appendChild(checkmark);
      label.appendChild(document.createTextNode(' ' + a.text));
      list.appendChild(label);
    });

    const nextBtn = createEl('button', { class: 'button', type: 'button' }, idx === quiz.questions.length - 1 ? 'Далее' : 'Далее');
    nextBtn.addEventListener('click', onNext);
    // Next disabled by default until at least one answer selected
    nextBtn.disabled = true;

    const backBtn = createEl('button', { class: 'button back', type: 'button' }, 'Назад');
    backBtn.addEventListener('click', () => {
      if (currentIndex > 0) {
        currentIndex -= 1;
        renderQuestion(currentIndex);
      }
    });
    backBtn.disabled = idx === 0;

    // Progress indicators (numbers) under the button
    const progress = createEl('div', { class: 'quiz-progress' });
    for (let i = 0; i < quiz.questions.length; i++) {
      const isActive = i === idx;
      const item = createEl('button', { type: 'button', class: 'quiz-progress-item' + (isActive ? ' active' : ''), 'data-step': String(i) }, String(i + 1));
      progress.appendChild(item);
    }

    const content = createEl('div', { class: 'quiz-content' });
    content.appendChild(title);
    content.appendChild(list);
    const actionsWrap = createEl('div', { class: 'quiz-actions' });
    actionsWrap.appendChild(backBtn);
    actionsWrap.appendChild(nextBtn);
    container.appendChild(content);
    container.appendChild(actionsWrap);
    container.appendChild(progress);
    // trigger enter animation
    requestAnimationFrame(() => content.classList.add('animate-in'));

    // Attach change listeners to inputs to toggle next button
    const inputs = container.querySelectorAll('input[type="checkbox"][data-answer-id]');
    inputs.forEach(i => i.addEventListener('change', () => {
      const anyChecked = Array.from(container.querySelectorAll('input[type="checkbox"][data-answer-id]')).some(x => x.checked);
      nextBtn.disabled = !anyChecked;
    }));

    // Initialize next button state (in case answers were pre-selected)
    const anyCheckedInit = Array.from(container.querySelectorAll('input[type="checkbox"][data-answer-id]')).some(i => i.checked);
    nextBtn.disabled = !anyCheckedInit;
  }

  function onNext() {
    const q = quiz.questions[currentIndex];
    const checked = Array.from(container.querySelectorAll('input[type="checkbox"][data-answer-id]'))
      .filter(i => i.checked)
      .map(i => i.getAttribute('data-answer-id'));
    selections[q.id] = checked;

    if (currentIndex < quiz.questions.length - 1) {
      currentIndex += 1;
      renderQuestion(currentIndex);
      return;
    }

    // Finish: compute union of keys
    const keysSet = new Set();
    quiz.questions.forEach(question => {
      const sel = selections[question.id] || [];
      sel.forEach(ansId => {
        const ans = question.answers.find(a => a.id === ansId);
        if (ans && Array.isArray(ans.keys)) ans.keys.forEach(k => keysSet.add(k));
      });
    });

    const keys = Array.from(keysSet);
    renderResults(keys);
  }

  function renderResults(keys) {
    container.innerHTML = '';
    const content = createEl('div', { class: 'quiz-content' });
    const header = createEl('h3', {}, 'Вам подойдёт:');
    content.appendChild(header);
    const wrap = createEl('div', { class: 'quiz-results' });
    content.appendChild(wrap);
    const CTA = createEl('button', { class: 'button open-modal quiz-CTA' }, 'Получить бесплатную консультацию');
    content.appendChild(CTA);
    container.appendChild(content);
    // trigger enter animation
    requestAnimationFrame(() => content.classList.add('animate-in'));
    CTA.addEventListener('click', function(e){
        e.preventDefault();
        var contactModal = document.getElementById('contact-modal');
        if (!contactModal) return;
        contactModal.classList.add('is-open');
        contactModal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('modal-open');
    });

    // If preloaded posts exist (localized), use them; otherwise try REST
    const preload = window.EvergreenQuiz && window.EvergreenQuiz.preloadedServices;
    if (preload && Array.isArray(preload)) {
      const matched = filterServicesByKeys(preload, keys);
      renderServiceCards(matched, wrap);
      return;
    }

    // Try custom REST API (server endpoint provides services with quiz_key)
    const query = (keys && keys.length) ? '?keys=' + encodeURIComponent(keys.join(',')) : '';
    const restRoot = (window.EvergreenQuiz && window.EvergreenQuiz.restBase) || (window.location.origin + '/wp-json/evergreen/v1/services');
    const restRootTrim = restRoot.replace(/\/$/, '');
    const restBase = restRootTrim + query;
    fetch(restBase).then(r => {
      if (!r.ok) throw new Error('REST request failed: ' + r.status);
      return r.json();
    }).then(posts => {
      // endpoint returns objects: {id,title,link,excerpt,thumb,quiz_key}
      const mapped = posts.map(p => ({
        id: p.id,
        title: p.title,
        link: p.link,
        excerpt: p.excerpt,
        thumb: p.thumb,
        keys: p.quiz_key || p.keys || []
      }));
      const matched = filterServicesByKeys(mapped, keys);
      renderServiceCards(matched, wrap);
    }).catch(err => {
      wrap.appendChild(createEl('p', {}, 'Не удалось загрузить услуги. Пожалуйста, попробуйте позже.'));
      console.error('Quiz REST error:', err, restBase);
    });
  }

  function normalizePost(p) {
    const acf = p.acf || {};
    const quizKeys = acf.quiz_key || p.quiz_key || (p.meta && p.meta.quiz_key) || [];
    const keys = Array.isArray(quizKeys) ? quizKeys : String(quizKeys).split(/\s*,\s*/).filter(Boolean);
    const title = (p.title && p.title.rendered) || p.title || '';
    const link = p.link || p.link || ('/');
    const excerpt = (p.excerpt && p.excerpt.rendered) || '';
    const thumb = (p._embedded && p._embedded['wp:featuredmedia'] && p._embedded['wp:featuredmedia'][0] && p._embedded['wp:featuredmedia'][0].source_url) || '';
    return { id: p.id, title: title, link: link, excerpt: excerpt, thumb: thumb, keys: keys };
  }

  function filterServicesByKeys(list, keys) {
    if (!keys || keys.length === 0) return [];
    return list.filter(s => Array.isArray(s.keys) && s.keys.some(k => keys.includes(k)));
  }

  function renderServiceCards(list, wrap) {
    if (!list || list.length === 0) {
      wrap.appendChild(createEl('p', {}, 'К сожалению, ничего не подошло.'));
      return;
    }
    list.forEach(s => {
      const card = createEl('article', { class: 'quiz-card' });
      if (s.thumb) card.appendChild(createEl('img', { src: s.thumb, alt: s.title }));
      const h = createEl('h4', {});
      const a = createEl('a', { href: s.link, class: 'quiz-link', target: '_blank' }, s.title);
      h.appendChild(a);
      card.appendChild(h);
      wrap.appendChild(card);
    });
  }

  // Bootstrap
  fetch(dataUrl).then(r => r.json()).then(json => {
    quiz = json;
    renderQuestion(0);
  }).catch(err => {
    container.innerHTML = '<p>Не удалось загрузить квиз.</p>';
    console.error(err);
  });

})();
