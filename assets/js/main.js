/**
 * Matcha Launch — Main JS
 * Lightweight, no framework. Each section can register
 * its own init function here as we build it.
 */

(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		matchaInit();
	});

	function matchaInit() {
		// Section init calls get added here as widgets are built, e.g.
        matchaNavbarInit();
		// matchaHeroInit();
		// matchaFlavorsInit();
	}

})();

function matchaNavbarInit() {
	const root = document.getElementById('matchaBloomNav');
	if (!root) return;

	const trigger = document.getElementById('matchaBloomTrigger');
	const overlay = document.getElementById('matchaBloomOverlay');
	const ringProgress = document.getElementById('matchaRingProgress');
	const navLinks = overlay ? overlay.querySelectorAll('[data-nav-link]') : [];
	const CIRCUMFERENCE = 182.2; // 2 * PI * r(29)

	/* ---- Scroll progress ring ---- */
	let ticking = false;
	function updateRing() {
		const scrollTop = window.scrollY;
		const docHeight = document.documentElement.scrollHeight - window.innerHeight;
		const pct = docHeight > 0 ? Math.min(scrollTop / docHeight, 1) : 0;
		if (ringProgress) {
			ringProgress.style.strokeDashoffset = CIRCUMFERENCE * (1 - pct);
		}
		ticking = false;
	}
	window.addEventListener('scroll', () => {
		if (!ticking) {
			window.requestAnimationFrame(updateRing);
			ticking = true;
		}
	}, { passive: true });
	updateRing();

	/* ---- Set bloom origin to trigger's center ---- */
	function setOrigin() {
		const rect = trigger.getBoundingClientRect();
		const x = rect.left + rect.width / 2;
		const y = rect.top + rect.height / 2;
		root.style.setProperty('--origin-x', x + 'px');
		root.style.setProperty('--origin-y', y + 'px');
	}

	/* ---- Open / close ---- */
	function openBloom() {
		setOrigin();
		root.classList.add('is-open');
		trigger.setAttribute('aria-expanded', 'true');
		overlay.setAttribute('aria-hidden', 'false');
		document.body.classList.add('matcha-lock-scroll');
	}
	function closeBloom() {
		root.classList.remove('is-open');
		trigger.setAttribute('aria-expanded', 'false');
		overlay.setAttribute('aria-hidden', 'true');
		document.body.classList.remove('matcha-lock-scroll');
	}

	trigger.addEventListener('click', () => {
		root.classList.contains('is-open') ? closeBloom() : openBloom();
	});

	navLinks.forEach((link) => link.addEventListener('click', closeBloom));

	document.addEventListener('keydown', (e) => {
		if (e.key === 'Escape' && root.classList.contains('is-open')) closeBloom();
	});

	window.addEventListener('resize', () => {
		if (root.classList.contains('is-open')) setOrigin();
	});
}
