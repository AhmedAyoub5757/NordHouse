document.addEventListener('DOMContentLoaded', () => {
	console.log('Kinetic theme assets loaded.');
});

document.addEventListener('DOMContentLoaded', () => {
	const trigger = document.getElementById('kNavTrigger');
	const curtain = document.getElementById('kCurtainNav');
	const taglineDisplay = document.getElementById('kNavHoverTagline');
	const menuItems = document.querySelectorAll('.k-curtain-item');
	const btnLabel = trigger ? trigger.querySelector('.k-btn-label') : null;

	let isOpen = false;

	if (trigger && curtain) {
		trigger.addEventListener('click', () => {
			isOpen = !isOpen;
			
			if (isOpen) {
				curtain.classList.add('is-active');
				trigger.classList.add('is-open');
				if (btnLabel) btnLabel.textContent = 'CLOSE';
				
				// Enhanced GSAP Animations on curtain open
				if (typeof gsap !== 'undefined') {
					// Stagger reveal links with rotation shift
					gsap.fromTo('.k-curtain-item', 
						{ y: 80, opacity: 0, rotateX: -20 },
						{ y: 0, opacity: 1, rotateX: 0, duration: 0.8, stagger: 0.1, ease: 'power4.out', delay: 0.3 }
					);

					// Stagger reveal footer info
					gsap.fromTo('.k-footer-col',
						{ y: 30, opacity: 0 },
						{ y: 0, opacity: 1, duration: 0.6, stagger: 0.15, ease: 'power2.out', delay: 0.6 }
					);
				}
			} else {
				curtain.classList.remove('is-active');
				trigger.classList.remove('is-open');
				if (btnLabel) btnLabel.textContent = 'MENU';
			}
		});

		// Dynamic hover tagline transition with GSAP text fade
		menuItems.forEach(item => {
			item.addEventListener('mouseenter', () => {
				const tag = item.getAttribute('data-tagline');
				if (taglineDisplay && tag) {
					if (typeof gsap !== 'undefined') {
						gsap.to(taglineDisplay, { opacity: 0, y: -5, duration: 0.15, onComplete: () => {
							taglineDisplay.textContent = `// ${tag}`;
							gsap.to(taglineDisplay, { opacity: 1, y: 0, duration: 0.25 });
						}});
					} else {
						taglineDisplay.textContent = `// ${tag}`;
					}
				}
			});

			item.addEventListener('mouseleave', () => {
				if (taglineDisplay) {
					if (typeof gsap !== 'undefined') {
						gsap.to(taglineDisplay, { opacity: 0, y: 5, duration: 0.15, onComplete: () => {
							taglineDisplay.textContent = 'SELECT A DESTINATION';
							gsap.to(taglineDisplay, { opacity: 1, y: 0, duration: 0.25 });
						}});
					} else {
						taglineDisplay.textContent = 'SELECT A DESTINATION';
					}
				}
			});

			// Close curtain on link click
			item.addEventListener('click', () => {
				curtain.classList.remove('is-active');
				trigger.classList.remove('is-open');
				if (btnLabel) btnLabel.textContent = 'MENU';
				isOpen = false;
			});
		});
	}
});

document.addEventListener('DOMContentLoaded', () => {
	const cols = document.querySelectorAll('.k-mono-col');

	if (cols.length > 0) {
		
		// GSAP Sequential Appear Animation
		if (typeof gsap !== 'undefined') {
			const tl = gsap.timeline({ delay: 0.3 });

			// 1. Draw vertical column border lines down
			tl.to('.k-col-border', {
				height: '100%',
				duration: 0.8,
				stagger: 0.1,
				ease: 'power3.inOut'
			})
			// 2. Pop in index numbers sequentially
			.to('.k-col-num', {
				y: 0,
				opacity: 1,
				duration: 0.5,
				stagger: 0.08,
				ease: 'power2.out'
			}, '-=0.4')
			// 3. Reveal vertical hollow titles
			.to('.k-col-vertical-title', {
				opacity: 1,
				duration: 0.6,
				stagger: 0.08,
				ease: 'power3.out'
			}, '-=0.3');
		}

		// Column Expansion Logic
		cols.forEach(col => {
			// Expand column on mouse enter (Desktop)
			col.addEventListener('mouseenter', () => {
				if (window.innerWidth > 991) {
					cols.forEach(c => c.classList.remove('is-active'));
					col.classList.add('is-active');
				}
			});

			// Expand column on click/tap (Mobile / Tablet)
			col.addEventListener('click', () => {
				if (window.innerWidth <= 991) {
					const isActive = col.classList.contains('is-active');
					cols.forEach(c => c.classList.remove('is-active'));
					if (!isActive) {
						col.classList.add('is-active');
					}
				}
			});
		});
	}
});

document.addEventListener('DOMContentLoaded', () => {

	// 1. CUSTOM CURSOR TRACKING
	const cursorDot = document.createElement('div');
	const cursorFollower = document.createElement('div');
	cursorDot.className = 'k-cursor-dot';
	cursorFollower.className = 'k-cursor-follower';
	document.body.appendChild(cursorDot);
	document.body.appendChild(cursorFollower);

	let mouseX = 0, mouseY = 0;
	let followerX = 0, followerY = 0;

	window.addEventListener('mousemove', (e) => {
		mouseX = e.clientX;
		mouseY = e.clientY;

		cursorDot.style.left = `${mouseX}px`;
		cursorDot.style.top = `${mouseY}px`;
	});

	function animateCursor() {
		followerX += (mouseX - followerX) * 0.15;
		followerY += (mouseY - followerY) * 0.15;
		cursorFollower.style.left = `${followerX}px`;
		cursorFollower.style.top = `${followerY}px`;
		requestAnimationFrame(animateCursor);
	}
	animateCursor();

	// Hover states for links & buttons
	const interactiveElements = document.querySelectorAll('a, button, .k-mono-col, .k-work-item');
	interactiveElements.forEach(el => {
		el.addEventListener('mouseenter', () => document.body.classList.add('cursor-hover'));
		el.addEventListener('mouseleave', () => document.body.classList.remove('cursor-hover'));
	});

	// 2. PRELOADER COUNTDOWN ANIMATION
	const loaderNum = document.getElementById('kLoaderNum');
	const loaderBar = document.getElementById('kLoaderBar');
	const preloader = document.getElementById('kPreloader');

	if (loaderNum && loaderBar && preloader) {
		let count = 0;
		const interval = setInterval(() => {
			count += Math.floor(Math.random() * 8) + 1;
			if (count >= 100) {
				count = 100;
				clearInterval(interval);

				// GSAP Preloader Curtain Out Reveal
				if (typeof gsap !== 'undefined') {
					gsap.to(preloader, {
						clipPath: 'polygon(0 0, 100% 0, 100% 0, 0 0)',
						duration: 1,
						ease: 'power4.inOut',
						delay: 0.2,
						onComplete: () => preloader.style.display = 'none'
					});
				} else {
					preloader.style.display = 'none';
				}
			}
			loaderNum.textContent = count.toString().padStart(3, '0');
			loaderBar.style.width = `${count}%`;
		}, 30);
	}

	// 3. OPTION A FLOATING PREVIEW CARD ON CURSOR MOVE
	const workItems = document.querySelectorAll('.k-work-item');
	const previewCard = document.getElementById('kHoverPreviewCard');
	const previewImg = document.getElementById('kHoverPreviewImg');

	if (workItems.length > 0 && previewCard && previewImg) {
		workItems.forEach(item => {
			item.addEventListener('mouseenter', () => {
				const imgSrc = item.getAttribute('data-preview');
				if (imgSrc) {
					previewImg.src = imgSrc;
					previewCard.classList.add('is-visible');
				}
			});

			item.addEventListener('mousemove', (e) => {
				if (typeof gsap !== 'undefined') {
					gsap.to(previewCard, {
						x: e.clientX,
						y: e.clientY,
						duration: 0.4,
						ease: 'power2.out'
					});
				}
			});

			item.addEventListener('mouseleave', () => {
				previewCard.classList.remove('is-visible');
			});
		});
	}
});

document.addEventListener('DOMContentLoaded', () => {

	// 1. COOL NEO-BRUTALIST PRELOADER SEQUENCE
	const loaderNum = document.getElementById('kLoaderNum');
	const preloader = document.getElementById('kPreloader');
	const curtainPanel = document.getElementById('kLoaderCurtain');
	const statusText = document.getElementById('kLoaderStatus');

	const loadingSteps = [
		'INITIALIZING CORE...',
		'ENQUEUING VECTOR ASSETS...',
		'COMPILING GRAPHICS PIPELINE...',
		'SYSTEM READY.'
	];

	if (loaderNum && preloader && curtainPanel) {
		let count = 0;

		const interval = setInterval(() => {
			count += Math.floor(Math.random() * 7) + 2;

			// Update status labels
			if (statusText) {
				if (count < 30) statusText.textContent = loadingSteps[0];
				else if (count < 60) statusText.textContent = loadingSteps[1];
				else if (count < 90) statusText.textContent = loadingSteps[2];
				else statusText.textContent = loadingSteps[3];
			}

			if (count >= 100) {
				count = 100;
				clearInterval(interval);

				// GSAP Smooth Curtain Reveal Timeline
				if (typeof gsap !== 'undefined') {
					const loaderTl = gsap.timeline();

					loaderTl
						.to(curtainPanel, {
							y: '0%',
							duration: 0.6,
							ease: 'power4.in'
						})
						.to(preloader, {
							display: 'none',
							duration: 0
						})
						.to(curtainPanel, {
							y: '-100%',
							duration: 0.7,
							ease: 'power4.out'
						});
				} else {
					preloader.style.display = 'none';
				}
			}

			loaderNum.textContent = count.toString().padStart(3, '0');
		}, 35);
	}

	// 2. STAGGER REVEAL FOR WORK SHOWCASE SECTION
	if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
		gsap.registerPlugin(ScrollTrigger);

		gsap.to('.k-work-item', {
			opacity: 1,
			y: 0,
			duration: 0.8,
			stagger: 0.18,
			ease: 'power3.out',
			scrollTrigger: {
				trigger: '.k-work-list',
				start: 'top 80%',
				toggleActions: 'play none none none'
			}
		});
	} else {
		// Fallback reveal
		document.querySelectorAll('.k-work-item').forEach(item => {
			item.style.opacity = '1';
			item.style.transform = 'translateY(0)';
		});
	}

	// 3. FLOATING CURSOR PREVIEW CARD (OPTION A)
	const workItems = document.querySelectorAll('.k-work-item');
	const previewCard = document.getElementById('kHoverPreviewCard');
	const previewImg = document.getElementById('kHoverPreviewImg');

	if (workItems.length > 0 && previewCard && previewImg) {
		workItems.forEach(item => {
			item.addEventListener('mouseenter', () => {
				const imgSrc = item.getAttribute('data-preview');
				if (imgSrc) {
					previewImg.src = imgSrc;
					previewCard.classList.add('is-visible');
				}
			});

			item.addEventListener('mousemove', (e) => {
				if (typeof gsap !== 'undefined') {
					gsap.to(previewCard, {
						x: e.clientX,
						y: e.clientY,
						duration: 0.35,
						ease: 'power2.out'
					});
				}
			});

			item.addEventListener('mouseleave', () => {
				previewCard.classList.remove('is-visible');
			});
		});
	}
});

document.addEventListener('DOMContentLoaded', () => {

	// METHODOLOGY SEQUENTIAL STAGGER REVEAL WITH ASYMMETRICAL LASER DRAW
	if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
		gsap.registerPlugin(ScrollTrigger);

		const laserLine = document.getElementById('kLaserPathActive');
		const nodes = document.querySelectorAll('.k-runway-node-item');

		if (laserLine) {
			const lineLength = laserLine.getTotalLength ? laserLine.getTotalLength() : 1600;
			laserLine.style.strokeDasharray = lineLength;
			laserLine.style.strokeDashoffset = lineLength;

			// GSAP ScrollTrigger Sequence
			const tl = gsap.timeline({
				scrollTrigger: {
					trigger: '#process',
					start: 'top 65%',
					end: 'bottom 80%',
					scrub: 1.2
				}
			});

			// 1. Draw Asymmetrical Laser Curve smoothly through nodes
			tl.to(laserLine, {
				strokeDashoffset: 0,
				ease: 'none',
				duration: 2
			});

			// 2. Reveal Nodes sequentially as wave passes
			nodes.forEach((node, i) => {
				tl.to(node, {
					opacity: 1,
					y: 0,
					duration: 0.4,
					onStart: () => node.classList.add('is-visible'),
					onReverseComplete: () => node.classList.remove('is-visible')
				}, i * 0.45);
			});
		}
	} else {
		// Fallback reveal
		document.querySelectorAll('.k-runway-node-item').forEach(node => {
			node.classList.add('is-visible');
			node.style.opacity = '1';
			node.style.transform = 'none';
		});
	}
});

document.addEventListener('DOMContentLoaded', () => {

	// VISUAL MATRIX SEQUENTIAL STAGGER REVEAL
	if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
		gsap.registerPlugin(ScrollTrigger);

		gsap.to('.k-vmatrix-row', {
			opacity: 1,
			y: 0,
			duration: 0.7,
			stagger: 0.15,
			ease: 'power3.out',
			scrollTrigger: {
				trigger: '.k-vmatrix-grid',
				start: 'top 80%',
				toggleActions: 'play none none none'
			}
		});
	} else {
		document.querySelectorAll('.k-vmatrix-row').forEach(row => {
			row.style.opacity = '1';
			row.style.transform = 'none';
		});
	}
});


document.addEventListener('DOMContentLoaded', () => {

	// 1. INTERACTIVE PRICE MORPHING ANIMATION
	const toggleBtn = document.getElementById('kBillingToggle');
	const labelOnce = document.getElementById('kLabelOnce');
	const labelRetainer = document.getElementById('kLabelRetainer');
	const pricesOnce = document.querySelectorAll('.k-val-once');
	const pricesRetainer = document.querySelectorAll('.k-val-retainer');
	const subLabels = document.querySelectorAll('#kPriceSubLabel');

	function animateToggle(isRetainer) {
		if (typeof gsap !== 'undefined') {
			const activeHide = isRetainer ? pricesOnce : pricesRetainer;
			const activeShow = isRetainer ? pricesRetainer : pricesOnce;

			// Slide out current prices
			gsap.to(activeHide, {
				y: -20,
				opacity: 0,
				duration: 0.25,
				ease: 'power2.in',
				onComplete: () => {
					activeHide.forEach(p => p.style.display = 'none');
					
					// Prepare & slide in new prices
					activeShow.forEach(p => p.style.display = 'block');
					gsap.fromTo(activeShow, 
						{ y: 20, opacity: 0 },
						{ y: 0, opacity: 1, duration: 0.35, ease: 'power3.out' }
					);
				}
			});

			// Fade sub labels
			gsap.to(subLabels, {
				opacity: 0,
				duration: 0.2,
				onComplete: () => {
					subLabels.forEach(lbl => {
						lbl.textContent = isRetainer ? '// MONTHLY DEDICATED SPRINT' : '// FIXED DELIVERABLE';
					});
					gsap.to(subLabels, { opacity: 1, duration: 0.2 });
				}
			});

		} else {
			// Fallback switch
			if (isRetainer) {
				pricesOnce.forEach(p => p.style.display = 'none');
				pricesRetainer.forEach(p => p.style.display = 'block');
			} else {
				pricesRetainer.forEach(p => p.style.display = 'none');
				pricesOnce.forEach(p => p.style.display = 'block');
			}
		}
	}

	if (toggleBtn) {
		toggleBtn.addEventListener('click', () => {
			toggleBtn.classList.toggle('is-active');
			const isRetainer = toggleBtn.classList.contains('is-active');

			if (isRetainer) {
				labelOnce.classList.remove('active');
				labelRetainer.classList.add('active');
			} else {
				labelRetainer.classList.remove('active');
				labelOnce.classList.add('active');
			}

			animateToggle(isRetainer);
		});

		// Allow direct text clicking
		if (labelOnce && labelRetainer) {
			labelOnce.addEventListener('click', () => {
				if (toggleBtn.classList.contains('is-active')) {
					toggleBtn.classList.remove('is-active');
					labelRetainer.classList.remove('active');
					labelOnce.classList.add('active');
					animateToggle(false);
				}
			});

			labelRetainer.addEventListener('click', () => {
				if (!toggleBtn.classList.contains('is-active')) {
					toggleBtn.classList.add('is-active');
					labelOnce.classList.remove('active');
					labelRetainer.classList.add('active');
					animateToggle(true);
				}
			});
		}
	}

	// 2. PRICING CARDS & FEATURE LIST GSAP STAGGER REVEAL
	if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
		gsap.registerPlugin(ScrollTrigger);

		// Card staggered rise
		gsap.to('.k-pricing-card', {
			opacity: 1,
			y: 0,
			duration: 0.8,
			stagger: 0.2,
			ease: 'power3.out',
			scrollTrigger: {
				trigger: '.k-pricing-grid',
				start: 'top 75%',
				toggleActions: 'play none none none'
			}
		});

		// Stagger feature rows within each card
		document.querySelectorAll('.k-pricing-card').forEach(card => {
			gsap.from(card.querySelectorAll('.k-feat-row'), {
				opacity: 0,
				x: -15,
				duration: 0.5,
				stagger: 0.08,
				ease: 'power2.out',
				scrollTrigger: {
					trigger: card,
					start: 'top 80%'
				}
			});
		});
	} else {
		document.querySelectorAll('.k-pricing-card').forEach(c => {
			c.style.opacity = '1';
			c.style.transform = 'none';
		});
	}
});

document.addEventListener('DOMContentLoaded', () => {

	// BUBBLE TESTIMONIALS PHYSICS & HOVER FOCUS
	const bubblesContainer = document.querySelector('.k-bubbles-container');
	const bubbles = document.querySelectorAll('.k-bubble-card');

	if (bubbles.length > 0) {
		
		// GSAP Stagger Reveal & Floating Physics Loop
		if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
			gsap.registerPlugin(ScrollTrigger);

			// 1. Initial Stagger Reveal
			gsap.to('.k-bubble-card', {
				opacity: 1,
				scale: 1,
				duration: 0.8,
				stagger: 0.15,
				ease: 'power3.out',
				scrollTrigger: {
					trigger: '.k-bubble-section',
					start: 'top 70%',
					toggleActions: 'play none none none'
				},
				onComplete: () => {
					// 2. Continuous Organic Bobbing Float Effect
					if (window.innerWidth > 991) {
						bubbles.forEach((b, index) => {
							gsap.to(b, {
								y: (index % 2 === 0 ? '-=15' : '+=15'),
								x: (index % 3 === 0 ? '+=10' : '-=10'),
								duration: 2.5 + (index * 0.4),
								repeat: -1,
								yoyo: true,
								ease: 'sine.inOut'
							});
						});
					}
				}
			});
		} else {
			bubbles.forEach(b => b.style.opacity = '1');
		}

		// 3. Hover Focus Isolation Logic
		if (bubblesContainer) {
			bubbles.forEach(bubble => {
				bubble.addEventListener('mouseenter', () => {
					bubblesContainer.classList.add('has-hover');
				});

				bubble.addEventListener('mouseleave', () => {
					bubblesContainer.classList.remove('has-hover');
				});
			});
		}
	}
});

document.addEventListener('DOMContentLoaded', () => {

	// 1. FAQ ACCORDION EXPAND & TOGGLE LOGIC
	const faqItems = document.querySelectorAll('.k-faq-item');

	faqItems.forEach(item => {
		const btn = item.querySelector('.k-faq-question-btn');
		const body = item.querySelector('.k-faq-answer-body');
		const inner = item.querySelector('.k-faq-answer-inner');

		// Set initial height for pre-opened item
		if (item.classList.contains('is-open') && body && inner) {
			body.style.height = `${inner.offsetHeight}px`;
		}

		if (btn && body && inner) {
			btn.addEventListener('click', () => {
				const isOpen = item.classList.contains('is-open');

				// Close all other accordions
				faqItems.forEach(other => {
					other.classList.remove('is-open');
					const otherBody = other.querySelector('.k-faq-answer-body');
					if (otherBody) otherBody.style.height = '0px';
				});

				// Toggle current
				if (!isOpen) {
					item.classList.add('is-open');
					body.style.height = `${inner.offsetHeight}px`;
				} else {
					item.classList.remove('is-open');
					body.style.height = '0px';
				}
			});
		}
	});

	// 2. FAQ INSTANT SEARCH FILTER
	const searchInput = document.getElementById('kFaqSearchInput');
	if (searchInput) {
		searchInput.addEventListener('input', (e) => {
			const term = e.target.value.toLowerCase().trim();

			faqItems.forEach(item => {
				const qText = item.querySelector('.k-faq-q-text').textContent.toLowerCase();
				const aText = item.querySelector('.k-faq-answer-inner p').textContent.toLowerCase();

				if (qText.includes(term) || aText.includes(term)) {
					item.style.display = 'block';
				} else {
					item.style.display = 'none';
				}
			});
		});
	}

	// 3. GSAP STAGGER REVEAL FOR FAQ ROWS
	if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
		gsap.registerPlugin(ScrollTrigger);

		gsap.to('.k-faq-item', {
			opacity: 1,
			y: 0,
			duration: 0.8,
			stagger: 0.15,
			ease: 'power3.out',
			scrollTrigger: {
				trigger: '.k-faq-accordion-list',
				start: 'top 75%',
				toggleActions: 'play none none none'
			}
		});
	} else {
		faqItems.forEach(f => {
			f.style.opacity = '1';
			f.style.transform = 'none';
		});
	}
});