(() => {
  const $ = (s, p = document) => p.querySelector(s), $$ = (s, p = document) => [...p.querySelectorAll(s)];

  /* header */
  const hdr = $('.hdr'), top = $('.totop');
  const onScroll = () => { hdr.classList.toggle('scrolled', scrollY > 10); top && top.classList.toggle('show', scrollY > 600); };
  addEventListener('scroll', onScroll, { passive: true }); onScroll();
  top && top.addEventListener('click', () => scrollTo({ top: 0, behavior: 'smooth' }));
  const burger = $('.burger'), menu = $('.menu');
  burger && burger.addEventListener('click', () => {
    const o = menu.classList.toggle('open'); burger.classList.toggle('on', o); burger.setAttribute('aria-expanded', o);
  });
  $$('.dd-btn').forEach(b => b.addEventListener('click', () => { if (innerWidth <= 900) b.parentElement.classList.toggle('open'); }));

  /* scroll reveal (auto-applies to grids, section heads, splits) */
  $$('.sec-head, .grid > *, .split > *, .stats, .faq details, .cta, .tl-i').forEach(el => el.classList.add('rv'));
  $$('.grid').forEach(g => [...g.children].forEach((c, i) => c.dataset.d = i * 90));
  const io = new IntersectionObserver(es => es.forEach(en => {
    if (!en.isIntersecting) return;
    const el = en.target, d = +(el.dataset.d || 0);
    el.style.transitionDelay = d + 'ms'; el.classList.add('in'); io.unobserve(el);
    setTimeout(() => { el.classList.remove('rv', 'in'); el.style.transitionDelay = ''; }, 1100 + d); // free the element so 3D tilt stays smooth
  }), { threshold: .12 });
  $$('.rv').forEach(el => io.observe(el));

  /* 3D tilt + spotlight on cards */
  if (matchMedia('(hover:hover)').matches) {
    $$('.card:not(.soon)').forEach(c => {
      c.addEventListener('mousemove', e => {
        const r = c.getBoundingClientRect(), x = (e.clientX - r.left) / r.width, y = (e.clientY - r.top) / r.height;
        c.style.transform = `perspective(900px) rotateX(${(.5 - y) * 9}deg) rotateY(${(x - .5) * 11}deg) translateY(-6px)`;
        c.style.setProperty('--mx', x * 100 + '%'); c.style.setProperty('--my', y * 100 + '%');
      });
      c.addEventListener('mouseleave', () => { c.style.transform = ''; });
    });
    /* hero 3D scene follows the mouse */
    const st = $('#stage');
    st && addEventListener('mousemove', e => {
      const x = e.clientX / innerWidth - .5, y = e.clientY / innerHeight - .5;
      st.style.transform = `rotateX(${-y * 22}deg) rotateY(${x * 30}deg)`;
    });
  }

  /* animated counters */
  const co = new IntersectionObserver(es => es.forEach(en => {
    if (!en.isIntersecting) return;
    const el = en.target, t = +el.dataset.count; let s = null;
    const f = ts => { s ??= ts; const p = Math.min((ts - s) / 1600, 1); el.textContent = Math.round(t * (1 - Math.pow(1 - p, 3))); if (p < 1) requestAnimationFrame(f); };
    requestAnimationFrame(f); co.unobserve(el);
  }), { threshold: .5 });
  $$('[data-count]').forEach(el => co.observe(el));

  /* hero calculator mock: cycles examples */
  const ex = [['1,250 × 8%', '100'], ['72 kg → lb', '158.73 lb'], ['₨ 50,000 ÷ 12', '4,166.67'], ['√144 + 3²', '21'], ['2h 45m + 1h 30m', '4h 15m']];
  const a = $('#mockExp'), b = $('#mockRes');
  if (a && b) { let i = 0; setInterval(() => { a.style.opacity = b.style.opacity = 0; setTimeout(() => { i = (i + 1) % ex.length; a.textContent = ex[i][0]; b.textContent = ex[i][1]; a.style.opacity = b.style.opacity = 1; }, 400); }, 2800); }

  /* tools page: search + category filter */
  const q = $('#toolSearch'), chips = $$('.chip-b'), items = $$('[data-tool]'), none = $('#noRes');
  if (items.length || q) {
    let cat = new URLSearchParams(location.search).get('cat') || 'all';
    const apply = () => {
      const s = (q ? q.value : '').toLowerCase().trim(); let n = 0;
      items.forEach(i => { const ok = (cat === 'all' || i.dataset.cat === cat) && (!s || i.dataset.search.includes(s)); i.style.display = ok ? '' : 'none'; if (ok) n++; });
      if (none) none.style.display = n ? 'none' : 'block';
      chips.forEach(c => c.classList.toggle('on', c.dataset.cat === cat));
    };
    q && q.addEventListener('input', apply);
    chips.forEach(c => c.addEventListener('click', () => { cat = c.dataset.cat; apply(); }));
    if (q || chips.length) apply();
  }
})();
