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

	// 2. PRICING CARDS & FEATURE LIST GSAP STAGGER REVEAL (EACH LIST ITEM APPEARS ONE BY ONE)
	if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
		gsap.registerPlugin(ScrollTrigger);

		// Animate section header elements first
		gsap.fromTo('.k-pricing-header > *',
			{ opacity: 0, y: 30 },
			{
				opacity: 1,
				y: 0,
				duration: 0.7,
				stagger: 0.15,
				ease: 'power3.out',
				scrollTrigger: {
					trigger: '.k-pricing-section',
					start: 'top 78%',
					toggleActions: 'play none none none'
				}
			}
		);

		// Stagger cards and inside each card stagger each list item one by one
		const pricingCards = document.querySelectorAll('.k-pricing-card');
		pricingCards.forEach((card, index) => {
			const cardTl = gsap.timeline({
				scrollTrigger: {
					trigger: card,
					start: 'top 82%',
					toggleActions: 'play none none none'
				}
			});

			// 1. Card itself rises
			cardTl.fromTo(card,
				{ opacity: 0, y: 50 },
				{ opacity: 1, y: 0, duration: 0.7, ease: 'power3.out', delay: index * 0.15 }
			);

			// 2. Plan price & title
			const topParts = card.querySelectorAll('.k-card-top, .k-card-price-box');
			cardTl.fromTo(topParts,
				{ opacity: 0, y: 15 },
				{ opacity: 1, y: 0, duration: 0.4, stagger: 0.1, ease: 'power2.out' },
				'-=0.35'
			);

			// 3. EACH LIST ITEM APPEARS ONE BY ONE!
			const featRows = card.querySelectorAll('.k-feat-row');
			if (featRows.length > 0) {
				cardTl.fromTo(featRows,
					{ opacity: 0, x: -25 },
					{ opacity: 1, x: 0, duration: 0.45, stagger: 0.12, ease: 'power2.out' },
					'-=0.15'
				);

				// Checkmark pop bounce on each list item
				cardTl.fromTo(card.querySelectorAll('.k-feat-row svg'),
					{ scale: 0, opacity: 0 },
					{ scale: 1, opacity: 1, duration: 0.35, stagger: 0.12, ease: 'back.out(2)' },
					'<' // synchronized with the row slide!
				);
			}

			// 4. CTA Button at bottom
			const ctaBtn = card.querySelector('.k-pricing-btn');
			if (ctaBtn) {
				cardTl.fromTo(ctaBtn,
					{ opacity: 0, y: 15 },
					{ opacity: 1, y: 0, duration: 0.4, ease: 'power2.out' },
					'-=0.2'
				);
			}
		});
	} else {
		document.querySelectorAll('.k-pricing-card').forEach(c => {
			c.style.opacity = '1';
			c.style.transform = 'none';
		});
		document.querySelectorAll('.k-feat-row').forEach(f => {
			f.style.opacity = '1';
			f.style.transform = 'none';
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


// QUESTIONNAIRE STEP NAVIGATION & PROGRESS
function updateProgress(stepNum) {
	const progressFill = document.getElementById('kQProgress');
	if (progressFill) {
		progressFill.style.width = `${stepNum * 25}%`;
	}
}

function nextQuestion(currentStep) {
	const currentEl = document.querySelector(`.k-q-step[data-step="${currentStep}"]`);
	const nextEl = document.querySelector(`.k-q-step[data-step="${currentStep + 1}"]`);

	if (currentEl && nextEl) {
		if (typeof gsap !== 'undefined') {
			gsap.to(currentEl, {
				x: -40,
				opacity: 0,
				duration: 0.3,
				onComplete: () => {
					currentEl.classList.remove('is-active');
					nextEl.classList.add('is-active');
					gsap.fromTo(nextEl, 
						{ x: 40, opacity: 0 },
						{ x: 0, opacity: 1, duration: 0.35 }
					);
				}
			});
		} else {
			currentEl.classList.remove('is-active');
			nextEl.classList.add('is-active');
		}
		updateProgress(currentStep + 1);
	}
}

function prevQuestion(currentStep) {
	const currentEl = document.querySelector(`.k-q-step[data-step="${currentStep}"]`);
	const prevEl = document.querySelector(`.k-q-step[data-step="${currentStep - 1}"]`);

	if (currentEl && prevEl) {
		if (typeof gsap !== 'undefined') {
			gsap.to(currentEl, {
				x: 40,
				opacity: 0,
				duration: 0.3,
				onComplete: () => {
					currentEl.classList.remove('is-active');
					prevEl.classList.add('is-active');
					gsap.fromTo(prevEl, 
						{ x: -40, opacity: 0 },
						{ x: 0, opacity: 1, duration: 0.35 }
					);
				}
			});
		} else {
			currentEl.classList.remove('is-active');
			prevEl.classList.add('is-active');
		}
		updateProgress(currentStep - 1);
	}
}

document.addEventListener('DOMContentLoaded', () => {

	// REST API TRANSMISSION HANDLER
	const submitBtn = document.getElementById('kSubmitInquiry');
	if (submitBtn) {
		submitBtn.addEventListener('click', async () => {
			
			const targetEmail = submitBtn.getAttribute('data-target-email') || '';
			const serviceInputs = document.querySelectorAll('input[name="services"]:checked');
			const selectedServices = Array.from(serviceInputs).map(cb => cb.value);

			const budgetInput = document.querySelector('input[name="budget"]:checked');
			const selectedBudget = budgetInput ? budgetInput.value : 'Not Specified';

			const projectDetails = document.getElementById('kProjectDetails').value;
			const clientName = document.getElementById('kClientName').value;
			const clientEmail = document.getElementById('kClientEmail').value;

			if (!clientName || !clientEmail) {
				alert('PLEASE PROVIDE YOUR NAME AND EMAIL ADDRESS.');
				return;
			}

			const btnTextSpan = submitBtn.querySelector('span');
			if (btnTextSpan) btnTextSpan.textContent = 'TRANSMITTING...';
			submitBtn.disabled = true;

			try {
				const response = await fetch('/wp-json/kinetic/v1/submit-inquiry', {
					method: 'POST',
					headers: { 'Content-Type': 'application/json' },
					body: JSON.stringify({
						services: selectedServices,
						budget: selectedBudget,
						details: projectDetails,
						name: clientName,
						email: clientEmail,
						recipient: targetEmail
					})
				});

				const result = await response.json();

				const step4 = document.querySelector('.k-q-step[data-step="4"]');
				const responseStep = document.getElementById('kResponseStep');
				const responseMsg = document.getElementById('kResponseMsg');

				if (step4 && responseStep) {
					if (typeof gsap !== 'undefined') {
						gsap.to(step4, {
							scale: 0.95,
							opacity: 0,
							duration: 0.3,
							onComplete: () => {
								step4.classList.remove('is-active');
								responseStep.classList.add('is-active');
								if (responseMsg) responseMsg.textContent = result.message;
								gsap.fromTo('.k-success-terminal-card', 
									{ scale: 0.9, opacity: 0 },
									{ scale: 1, opacity: 1, duration: 0.6, ease: 'back.out(1.7)' }
								);
							}
						});
					} else {
						step4.classList.remove('is-active');
						responseStep.classList.add('is-active');
						if (responseMsg) responseMsg.textContent = result.message;
					}
				}

			} catch (error) {
				alert('TRANSMISSION ERROR. PLEASE EMAIL US DIRECTLY.');
				if (btnTextSpan) btnTextSpan.textContent = 'TRANSMIT INQUIRY';
				submitBtn.disabled = false;
			}
		});
	}
});

document.addEventListener('DOMContentLoaded', () => {

	// 1. REAL-TIME TIMEZONE CLOCK (PKT)
	const clockEl = document.getElementById('kFooterClock');
	if (clockEl) {
		function updateClock() {
			const now = new Date();
			const options = { timeZone: 'Asia/Karachi', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
			clockEl.textContent = now.toLocaleTimeString('en-US', options);
		}
		updateClock();
		setInterval(updateClock, 1000);
	}

	// 2. FOOTER REVEAL & WORDMARK SCALING ANIMATION
	const footer = document.getElementById('site-footer');
	const mainContent = document.getElementById('content') || document.querySelector('.site-content-wrapper');

	if (footer && mainContent && window.innerWidth > 991) {
		
		function setFooterHeight() {
			const footerHeight = footer.offsetHeight;
			mainContent.style.marginBottom = `${footerHeight}px`;
		}

		setFooterHeight();
		window.addEventListener('resize', setFooterHeight);

		// GSAP ScrollTrigger Unfold Reveal & Wordmark Scale
		if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
			gsap.registerPlugin(ScrollTrigger);

			footer.style.position = 'fixed';
			footer.style.bottom = '0';
			footer.style.left = '0';

			const footerTl = gsap.timeline({
				scrollTrigger: {
					trigger: mainContent,
					start: 'bottom bottom',
					end: 'bottom top',
					scrub: true
				}
			});

			// Unfold reveal transition
			footerTl.from(footer, {
				y: '25%',
				opacity: 0.6,
				ease: 'none'
			});

			// Scale wordmark text slightly as it reveals
			footerTl.from('.k-wordmark-text-path', {
				scale: 0.9,
				transformOrigin: 'center center',
				ease: 'none'
			}, 0);
		}
	}
});

document.addEventListener('DOMContentLoaded', () => {
	const heroes = document.querySelectorAll('.k-hero-monolith');

	heroes.forEach((hero) => {
		const cols = hero.querySelectorAll('.k-mono-col');
		if (!cols.length) return;

		const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		const autoplayEnabled = hero.dataset.autoplay === 'true' && !prefersReducedMotion;
		const interval = parseInt(hero.dataset.interval, 10) || 4500;

		let activeIndex = 0;
		let autoplayTimer = null;
		let resumeTimer = null;
		let userInteracting = false;

		/* ---------------------------------------------------------
		 * GSAP entrance timeline
		 * --------------------------------------------------------- */
		if (typeof gsap !== 'undefined') {
			const tl = gsap.timeline({ delay: 0.3 });

			tl.to(hero.querySelectorAll('.k-col-border'), {
				height: '100%',
				duration: 0.8,
				stagger: 0.1,
				ease: 'power3.inOut'
			})
				.to(hero.querySelectorAll('.k-col-num'), {
					y: 0,
					opacity: 1,
					duration: 0.5,
					stagger: 0.08,
					ease: 'power2.out'
				}, '-=0.4')
				.to(hero.querySelectorAll('.k-col-vertical-title'), {
					opacity: 1,
					duration: 0.6,
					stagger: 0.08,
					ease: 'power3.out'
				}, '-=0.3');
		}

		/* ---------------------------------------------------------
		 * Core: set active column
		 * --------------------------------------------------------- */
		function setActive(index) {
			activeIndex = index;
			cols.forEach((c, i) => {
				c.classList.toggle('is-active', i === index);
				resetProgress(c);
			});
			if (autoplayEnabled && !userInteracting) {
				startProgress(cols[index]);
			}
		}

		/* ---------------------------------------------------------
		 * Autoplay progress bar
		 * --------------------------------------------------------- */
		function resetProgress(col) {
			const bar = col.querySelector('.k-col-progress');
			if (!bar) return;
			bar.style.transition = 'none';
			bar.style.width = '0%';
		}

		function startProgress(col) {
			const bar = col.querySelector('.k-col-progress');
			if (!bar) return;
			// Force reflow so the transition restarts cleanly.
			// eslint-disable-next-line no-unused-expressions
			bar.offsetWidth;
			bar.style.transition = `width ${interval}ms linear`;
			bar.style.width = '100%';
		}

		/* ---------------------------------------------------------
		 * Autoplay loop — pauses while the user is interacting
		 * --------------------------------------------------------- */
		function startAutoplay() {
			if (!autoplayEnabled) return;
			clearInterval(autoplayTimer);
			startProgress(cols[activeIndex]);
			autoplayTimer = setInterval(() => {
				const next = (activeIndex + 1) % cols.length;
				setActive(next);
			}, interval);
		}

		function pauseAutoplay() {
			clearInterval(autoplayTimer);
			autoplayTimer = null;
			cols.forEach(resetProgress);
		}

		function scheduleResume() {
			clearTimeout(resumeTimer);
			resumeTimer = setTimeout(() => {
				userInteracting = false;
				startAutoplay();
			}, 1200);
		}

		/* ---------------------------------------------------------
		 * Hover / click interaction
		 * --------------------------------------------------------- */
		cols.forEach((col, i) => {
			col.addEventListener('mouseenter', () => {
				if (window.innerWidth > 991) {
					userInteracting = true;
					clearTimeout(resumeTimer);
					pauseAutoplay();
					setActive(i);
				}
			});

			col.addEventListener('click', () => {
				if (window.innerWidth <= 991) {
					const isActive = col.classList.contains('is-active');
					cols.forEach((c) => c.classList.remove('is-active'));
					if (!isActive) col.classList.add('is-active');
				}
			});

			// Cursor-tracked spotlight glow
			col.addEventListener('mousemove', (e) => {
				const rect = col.getBoundingClientRect();
				const mx = ((e.clientX - rect.left) / rect.width) * 100;
				const my = ((e.clientY - rect.top) / rect.height) * 100;
				col.style.setProperty('--mx', `${mx}%`);
				col.style.setProperty('--my', `${my}%`);
			});
		});

		hero.addEventListener('mouseleave', () => {
			if (window.innerWidth > 991 && autoplayEnabled) {
				scheduleResume();
			}
		});

		/* ---------------------------------------------------------
		 * Magnetic CTA buttons
		 * --------------------------------------------------------- */
		if (!prefersReducedMotion) {
			hero.querySelectorAll('.k-magnetic').forEach((btn) => {
				const inner = btn.querySelector('.k-magnetic-inner');
				if (!inner) return;

				btn.addEventListener('mousemove', (e) => {
					const rect = btn.getBoundingClientRect();
					const relX = e.clientX - rect.left - rect.width / 2;
					const relY = e.clientY - rect.top - rect.height / 2;
					inner.style.transform = `translate(${relX * 0.25}px, ${relY * 0.4}px)`;
				});

				btn.addEventListener('mouseleave', () => {
					inner.style.transform = 'translate(0, 0)';
				});
			});
		}

		/* ---------------------------------------------------------
		 * Kick off autoplay
		 * --------------------------------------------------------- */
		if (autoplayEnabled) {
			startAutoplay();
		}
	});
});

/* ============================================================
 * NAVBAR: Transparent over hero, frosted glass when scrolled past
 * ============================================================ */
document.addEventListener('DOMContentLoaded', () => {
	const dock = document.querySelector('.k-floating-dock');
	const hero = document.querySelector('.k-hero-monolith');

	if (dock && hero) {
		function checkScroll() {
			const heroBottom = hero.getBoundingClientRect().bottom;
			if (heroBottom <= 80) {
				dock.classList.add('is-scrolled');
			} else {
				dock.classList.remove('is-scrolled');
			}
		}

		window.addEventListener('scroll', checkScroll, { passive: true });
		checkScroll();
	}
});

/* ============================================================
 * SVG DRAW ANIMATION: Reset stroke offsets when column changes
 * so the draw animation replays every time a column is activated
 * ============================================================ */
document.addEventListener('DOMContentLoaded', () => {
	const cols = document.querySelectorAll('.k-mono-col');

	if (cols.length > 0) {
		// Observe class changes on each column
		const observer = new MutationObserver((mutations) => {
			mutations.forEach((mutation) => {
				const col = mutation.target;
				if (col.classList.contains('is-active')) {
					// Reset all SVG strokes in this column to trigger the draw animation
					const shapes = col.querySelectorAll('.k-svg-art line, .k-svg-art rect, .k-svg-art circle, .k-svg-art path, .k-svg-art polygon, .k-svg-art polyline');
					shapes.forEach((shape) => {
						// Force reset: remove transition, set offset to 600, reflow, then restore
						shape.style.transition = 'none';
						shape.style.strokeDashoffset = '600';
						// eslint-disable-next-line no-unused-expressions
						shape.offsetWidth; // Force reflow
						shape.style.transition = '';
						shape.style.strokeDashoffset = '';
					});
				}
			});
		});

		cols.forEach((col) => {
			observer.observe(col, { attributes: true, attributeFilter: ['class'] });
		});
	}
});

/* ============================================================
 * UNIVERSAL WEBSITE-WIDE STAGGERED SCROLL ANIMATIONS
 * Everything appears one by one sequentially across all sections
 * ============================================================ */
window.addEventListener('load', () => {
	if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
	gsap.registerPlugin(ScrollTrigger);

	// 1. All Section Headers: Stagger badge -> heading -> subtitle
	const sectionHeaders = document.querySelectorAll(
		'.k-work-header, .k-runway-header, .k-vmatrix-header, .k-pricing-header, .k-bubble-header, .k-faq-header, .k-terminal-header'
	);
	sectionHeaders.forEach((header) => {
		const children = header.children;
		if (children.length > 0) {
			gsap.fromTo(children,
				{ opacity: 0, y: 35 },
				{
					opacity: 1,
					y: 0,
					duration: 0.7,
					stagger: 0.15,
					ease: 'power3.out',
					scrollTrigger: {
						trigger: header,
						start: 'top 85%',
						toggleActions: 'play none none none'
					}
				}
			);
		}
	});

	// 2. Terminal Section: Terminal window and contact columns stagger
	const termSection = document.querySelector('.k-terminal-section');
	if (termSection) {
		const termCols = termSection.querySelectorAll('.k-term-col, .k-contact-direct-line, .k-terminal-window');
		if (termCols.length > 0) {
			gsap.fromTo(termCols,
				{ opacity: 0, y: 40 },
				{
					opacity: 1,
					y: 0,
					duration: 0.75,
					stagger: 0.18,
					ease: 'power3.out',
					scrollTrigger: {
						trigger: termSection,
						start: 'top 75%',
						toggleActions: 'play none none none'
					}
				}
			);
		}
	}

	// 3. Footer Elements Stagger
	const footer = document.getElementById('site-footer');
	if (footer) {
		const footerBlocks = footer.querySelectorAll('.k-footer-block, .k-footer-col, .k-footer-bottom');
		if (footerBlocks.length > 0) {
			gsap.fromTo(footerBlocks,
				{ opacity: 0, y: 30 },
				{
					opacity: 1,
					y: 0,
					duration: 0.65,
					stagger: 0.12,
					ease: 'power2.out',
					scrollTrigger: {
						trigger: footer,
						start: 'top 90%',
						toggleActions: 'play none none none'
					}
				}
			);
		}
	}

	// Refresh ScrollTrigger once everything is mounted
	setTimeout(() => {
		ScrollTrigger.refresh();
	}, 200);
});

// HEADLINE WORD ROTATOR ENGINE
function initHeadlineRotator() {
	const wrapper = document.querySelector('.k-rotator-wrapper');
	const container = document.getElementById('k-three-canvas-container-dual');
	
	if (!wrapper) return;

	const words = wrapper.querySelectorAll('.k-rotator-word');
	if (words.length <= 1) return;

	const interval = container ? parseInt(container.getAttribute('data-rotate-speed')) || 2600 : 2600;
	let currentIndex = 0;

	setInterval(() => {
		const currentWord = words[currentIndex];
		currentIndex = (currentIndex + 1) % words.length;
		const nextWord = words[currentIndex];

		currentWord.classList.remove('is-active');
		currentWord.classList.add('is-exiting');

		setTimeout(() => {
			currentWord.classList.remove('is-exiting');
		}, 600);

		nextWord.classList.add('is-active');
	}, interval);
}

// THREE.JS RHS BIASED ORB & PARTICLE ENGINE
function initKineticHeroThreeDual() {
	const container = document.getElementById('k-three-canvas-container-dual');
	if (!container || typeof THREE === 'undefined') return;

	const showOrb = container.getAttribute('data-show-orb') !== '0';
	if (!showOrb) return;

	container.innerHTML = '';

	const particleCount = parseInt(container.getAttribute('data-particle-count')) || 2800;
	const sensitivity = parseFloat(container.getAttribute('data-sensitivity')) || 0.05;

	const width = container.clientWidth || window.innerWidth;
	const height = container.clientHeight || window.innerHeight;

	// 1. SCENE SETUP
	const scene = new THREE.Scene();
	const camera = new THREE.PerspectiveCamera(60, width / height, 0.1, 1000);
	camera.position.z = 85;

	const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
	renderer.setSize(width, height);
	renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
	container.appendChild(renderer.domElement);

	// 2. ORB GEOMETRY WITH RHS BIAS ANCHOR
	const geometry = new THREE.BufferGeometry();
	const positions = new Float32Array(particleCount * 3);
	const initialPositions = new Float32Array(particleCount * 3);
	const scatterDirections = new Float32Array(particleCount * 3);

	const radius = 30;

	for (let i = 0; i < particleCount; i++) {
		const phi = Math.acos(-1 + (2 * i) / particleCount);
		const theta = Math.sqrt(particleCount * Math.PI) * phi;

		const x = radius * Math.cos(theta) * Math.sin(phi);
		const y = radius * Math.sin(theta) * Math.sin(phi);
		const z = radius * Math.cos(phi);

		positions[i * 3] = x;
		positions[i * 3 + 1] = y;
		positions[i * 3 + 2] = z;

		initialPositions[i * 3] = x;
		initialPositions[i * 3 + 1] = y;
		initialPositions[i * 3 + 2] = z;

		// Dispersal vectors allow full-screen particle spread
		scatterDirections[i * 3] = (Math.random() - 0.5) * 220;
		scatterDirections[i * 3 + 1] = (Math.random() - 0.5) * 220;
		scatterDirections[i * 3 + 2] = (Math.random() - 0.5) * 220;
	}

	geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));

	// Radial Glow Point Texture
	const canvas = document.createElement('canvas');
	canvas.width = 32;
	canvas.height = 32;
	const ctx = canvas.getContext('2d');
	const grad = ctx.createRadialGradient(16, 16, 0, 16, 16, 16);
	grad.addColorStop(0, 'rgba(204,255,0,1)');
	grad.addColorStop(0.35, 'rgba(204,255,0,0.35)');
	grad.addColorStop(1, 'rgba(0,0,0,0)');
	ctx.fillStyle = grad;
	ctx.fillRect(0, 0, 32, 32);

	const texture = new THREE.CanvasTexture(canvas);

	const material = new THREE.PointsMaterial({
		color: 0xccff00,
		size: 2.4,
		map: texture,
		transparent: true,
		opacity: 0.9,
		blending: THREE.AdditiveBlending,
		depthWrite: false
	});

	const particleSystem = new THREE.Points(geometry, material);
	
	// Shift initial orb origin toward RHS (+25 X-Offset)
	const baseOffsetX = window.innerWidth > 991 ? 25 : 0;
	particleSystem.position.x = baseOffsetX;
	scene.add(particleSystem);

	// 3. MOUSE TRACKING WITH CONTROLLED SENSITIVITY
	const mouse = { x: 0, y: 0, targetX: 0, targetY: 0 };

	window.addEventListener('mousemove', (e) => {
		mouse.targetX = (e.clientX / window.innerWidth) * 2 - 1;
		mouse.targetY = -(e.clientY / window.innerHeight) * 2 + 1;
	});

	// 4. GSAP SCROLL DISPERSAL
	let dispersalProgress = { value: 0 };

	if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
		gsap.registerPlugin(ScrollTrigger);

		gsap.to(dispersalProgress, {
			value: 1,
			ease: 'none',
			scrollTrigger: {
				trigger: '#hero',
				start: 'top top',
				end: 'bottom top',
				scrub: 1,
				onUpdate: (self) => {
					material.opacity = 0.9 * (1 - self.progress);
				}
			}
		});
	}

	// 5. ANIMATION LOOP
	function animate() {
		requestAnimationFrame(animate);

		mouse.x += (mouse.targetX - mouse.x) * sensitivity;
		mouse.y += (mouse.targetY - mouse.y) * sensitivity;

		// Track mouse movement relative to the RHS base offset
		particleSystem.position.x = baseOffsetX + (mouse.x * 20);
		particleSystem.position.y = mouse.y * 15;
		particleSystem.rotation.y += 0.003;

		const pos = particleSystem.geometry.attributes.position.array;
		const factor = dispersalProgress.value;

		for (let i = 0; i < particleCount; i++) {
			pos[i * 3] = initialPositions[i * 3] + scatterDirections[i * 3] * factor;
			pos[i * 3 + 1] = initialPositions[i * 3 + 1] + scatterDirections[i * 3 + 1] * factor;
			pos[i * 3 + 2] = initialPositions[i * 3 + 2] + scatterDirections[i * 3 + 2] * factor;
		}

		particleSystem.geometry.attributes.position.needsUpdate = true;
		renderer.render(scene, camera);
	}

	animate();

	window.addEventListener('resize', () => {
		const newW = container.clientWidth || window.innerWidth;
		const newH = container.clientHeight || window.innerHeight;
		camera.aspect = newW / newH;
		camera.updateProjectionMatrix();
		renderer.setSize(newW, newH);
	});
}

document.addEventListener('DOMContentLoaded', () => {
	initHeadlineRotator();
	initKineticHeroThreeDual();
});

document.addEventListener('DOMContentLoaded', () => {

	// BEFORE / AFTER SPLIT SMOOTH DRAG ENGINE
	const container = document.getElementById('kBAContainer');
	const beforeLayer = document.getElementById('kBABeforeLayer');
	const handle = document.getElementById('kBAHandle');

	if (container && beforeLayer && handle) {
		let isDragging = false;
		let targetPercentage = 50;
		let currentPercentage = 50;

		function setSplitPosition(pct) {
			targetPercentage = Math.max(0, Math.min(100, pct));
		}

		function updateAnimation() {
			// Physics easing lerp
			currentPercentage += (targetPercentage - currentPercentage) * 0.15;
			
			beforeLayer.style.width = `${currentPercentage}%`;
			handle.style.left = `${currentPercentage}%`;

			requestAnimationFrame(updateAnimation);
		}

		updateAnimation();

		function getMousePos(e) {
			const rect = container.getBoundingClientRect();
			const x = (e.touches ? e.touches[0].clientX : e.clientX) - rect.left;
			return (x / rect.width) * 100;
		}

		container.addEventListener('mousedown', (e) => {
			isDragging = true;
			setSplitPosition(getMousePos(e));
		});

		container.addEventListener('touchstart', (e) => {
			isDragging = true;
			setSplitPosition(getMousePos(e));
		});

		window.addEventListener('mousemove', (e) => {
			if (isDragging) setSplitPosition(getMousePos(e));
		});

		window.addEventListener('touchmove', (e) => {
			if (isDragging) setSplitPosition(getMousePos(e));
		});

		window.addEventListener('mouseup', () => isDragging = false);
		window.addEventListener('touchend', () => isDragging = false);
	}
});

document.addEventListener('DOMContentLoaded', () => {

	const frame = document.getElementById('kBaFrame');
	const afterLayer = document.querySelector('.k-ba-after');
	const handle = document.getElementById('kBaHandle');

	if (frame && afterLayer && handle) {
		let isDragging = false;

		function updateSplit(clientX) {
			const rect = frame.getBoundingClientRect();
			let x = clientX - rect.left;
			x = Math.max(0, Math.min(x, rect.width));
			const percentage = (x / rect.width) * 100;

			afterLayer.style.width = `${percentage}%`;
			handle.style.left = `${percentage}%`;
		}

		frame.addEventListener('mousedown', (e) => {
			isDragging = true;
			updateSplit(e.clientX);
		});

		window.addEventListener('mousemove', (e) => {
			if (!isDragging) return;
			updateSplit(e.clientX);
		});

		window.addEventListener('mouseup', () => {
			isDragging = false;
		});

		// Touch Support for Mobile
		frame.addEventListener('touchstart', (e) => {
			isDragging = true;
			updateSplit(e.touches[0].clientX);
		});

		window.addEventListener('touchmove', (e) => {
			if (!isDragging) return;
			updateSplit(e.touches[0].clientX);
		});

		window.addEventListener('touchend', () => {
			isDragging = false;
		});
	}
});

/**
 * Kinetic Before/After Widget — interaction script
 * Pure JS + GSAP. Drag (mouse/touch) or hover to reveal the
 * "After" layer across the "Before" layer via a clip-path wipe.
 */
( function () {
	'use strict';

	function initInstance( frame ) {
		var afterPanel = frame.querySelector( '[data-kba-panel="after"]' );
		var handle      = frame.querySelector( '[data-kba-handle]' );
		if ( ! afterPanel || ! handle ) {
			return;
		}

		var hasGsap = typeof window.gsap !== 'undefined';
		var isDragging = false;
		var currentPercent = 50;
		var rafPending = false;

		// Respect reduced-motion preference for the ambient/eased updates.
		var prefersReducedMotion = window.matchMedia &&
			window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

		function setPosition( percent, animate ) {
			percent = Math.max( 0, Math.min( 100, percent ) );
			currentPercent = percent;

			var clipRight = 100 - percent;
			var clipValue = 'inset(0 ' + clipRight + '% 0 0)';

			if ( hasGsap && animate && ! prefersReducedMotion ) {
				gsap.to( afterPanel, {
					clipPath: clipValue,
					duration: 0.5,
					ease: 'power3.out',
					overwrite: true,
				} );
				gsap.to( handle, {
					left: percent + '%',
					duration: 0.5,
					ease: 'power3.out',
					overwrite: true,
				} );
			} else {
				afterPanel.style.clipPath = clipValue;
				handle.style.left = percent + '%';
			}
		}

		function percentFromClientX( clientX ) {
			var rect = frame.getBoundingClientRect();
			var x = clientX - rect.left;
			return ( x / rect.width ) * 100;
		}

		function scheduleUpdate( percent, animate ) {
			if ( rafPending ) {
				return;
			}
			rafPending = true;
			requestAnimationFrame( function () {
				setPosition( percent, animate );
				rafPending = false;
			} );
		}

		/* ---------------- Drag (pointer) interaction ---------------- */

		function onPointerDown( e ) {
			isDragging = true;
			frame.classList.add( 'is-dragging' );
			onPointerMove( e );
			window.addEventListener( 'pointermove', onPointerMove, { passive: true } );
			window.addEventListener( 'pointerup', onPointerUp, { passive: true } );
		}

		function onPointerMove( e ) {
			if ( ! isDragging ) {
				return;
			}
			var clientX = e.clientX;
			if ( typeof clientX === 'undefined' && e.touches && e.touches[ 0 ] ) {
				clientX = e.touches[ 0 ].clientX;
			}
			scheduleUpdate( percentFromClientX( clientX ), false );
		}

		function onPointerUp() {
			isDragging = false;
			frame.classList.remove( 'is-dragging' );
			window.removeEventListener( 'pointermove', onPointerMove );
			window.removeEventListener( 'pointerup', onPointerUp );
		}

		handle.addEventListener( 'pointerdown', onPointerDown );
		frame.addEventListener( 'pointerdown', function ( e ) {
			// Allow clicking/tapping anywhere in the frame to start the drag.
			onPointerDown( e );
		} );

		/* ---------------- Hover interaction (desktop, non-touch) ---------------- */

		var isTouchDevice = window.matchMedia &&
			window.matchMedia( '(hover: none), (pointer: coarse)' ).matches;

		if ( ! isTouchDevice ) {
			frame.addEventListener( 'mousemove', function ( e ) {
				if ( isDragging ) {
					return; // dragging already handles this with higher precision.
				}
				scheduleUpdate( percentFromClientX( e.clientX ), true );
			} );

			frame.addEventListener( 'mouseleave', function () {
				scheduleUpdate( 50, true );
			} );
		}

		/* ---------------- Keyboard accessibility ---------------- */

		handle.setAttribute( 'tabindex', '0' );
		handle.setAttribute( 'role', 'slider' );
		handle.setAttribute( 'aria-label', 'Before and after comparison slider' );
		handle.setAttribute( 'aria-valuemin', '0' );
		handle.setAttribute( 'aria-valuemax', '100' );

		handle.addEventListener( 'keydown', function ( e ) {
			var step = 5;
			if ( e.key === 'ArrowLeft' ) {
				scheduleUpdate( currentPercent - step, true );
				e.preventDefault();
			} else if ( e.key === 'ArrowRight' ) {
				scheduleUpdate( currentPercent + step, true );
				e.preventDefault();
			}
		} );

		/* ---------------- Reveal-on-scroll entrance (GSAP) ---------------- */

		if ( hasGsap && ! prefersReducedMotion ) {
			gsap.set( frame, { opacity: 0, y: 24 } );

			var revealFrame = function () {
				gsap.to( frame, {
					opacity: 1,
					y: 0,
					duration: 0.8,
					ease: 'power3.out',
				} );
			};

			if ( 'IntersectionObserver' in window ) {
				var observer = new IntersectionObserver(
					function ( entries ) {
						entries.forEach( function ( entry ) {
							if ( entry.isIntersecting ) {
								revealFrame();
								observer.unobserve( entry.target );
							}
						} );
					},
					{ threshold: 0.25 }
				);
				observer.observe( frame );
			} else {
				revealFrame();
			}
		}

		// Initialize at 50/50.
		setPosition( 50, false );

		// Keep aria-valuenow in sync.
		var updateAria = function () {
			handle.setAttribute( 'aria-valuenow', Math.round( currentPercent ) );
			requestAnimationFrame( updateAria );
		};
		requestAnimationFrame( updateAria );
	}

	function initAll() {
		var frames = document.querySelectorAll( '[data-kba-frame]' );
		frames.forEach( initInstance );
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', initAll );
	} else {
		initAll();
	}

	// Re-init when Elementor editor rebuilds the widget (editor preview only).
	if ( window.elementorFrontend && window.elementorFrontend.hooks ) {
		window.elementorFrontend.hooks.addAction(
			'frontend/element_ready/kinetic-before-after.default',
			function ( $scope ) {
				var frame = $scope[ 0 ].querySelector( '[data-kba-frame]' );
				if ( frame ) {
					initInstance( frame );
				}
			}
		);
	}
} )();

document.addEventListener('DOMContentLoaded', () => {

	const canvas = document.getElementById('nexusGlobeCanvas');

	if (canvas) {
		const ctx = canvas.getContext('2d');
		let width, height;
		let dots = [];
		const dotCount = 450;
		const globeRadius = 130;

		let rotationX = 0;
		let rotationY = 0;
		let autoSpeedY = 0.006;
		let isDragging = false;
		let lastMouseX = 0;
		let lastMouseY = 0;

		// Major Global Tech Hub Nodes with Location Flags
		const flagNodes = [
			{ lat: 40.7128, lon: -74.0060, label: '🇺🇸 [US-EST]' },
			{ lat: 51.5074, lon: -0.1278,  label: '🇬🇧 [UK-GMT]' },
			{ lat: 24.8607, lon: 67.0011,  label: '🇵🇰 [PK-PKT]' },
			{ lat: 1.3521,  lon: 103.8198, label: '🇸🇬 [SG-SGT]' }
		];

		function resizeCanvas() {
			const rect = canvas.parentNode.getBoundingClientRect();
			width = rect.width;
			height = rect.height;
			canvas.width = width * (window.devicePixelRatio || 1);
			canvas.height = height * (window.devicePixelRatio || 1);
			ctx.scale(window.devicePixelRatio || 1, window.devicePixelRatio || 1);
		}

		resizeCanvas();
		window.addEventListener('resize', resizeCanvas);

		function latLonToXYZ(lat, lon, radius) {
			const phi = (90 - lat) * (Math.PI / 180);
			const theta = (lon + 180) * (Math.PI / 180);
			return {
				x: -(radius * Math.sin(phi) * Math.cos(theta)),
				y: radius * Math.cos(phi),
				z: radius * Math.sin(phi) * Math.sin(theta)
			};
		}

		function initGlobe() {
			dots = [];
			
			// Generate standard Fibonacci sphere dots
			for (let i = 0; i < dotCount; i++) {
				const phi = Math.acos(-1 + (2 * i) / dotCount);
				const theta = Math.sqrt(dotCount * Math.PI) * phi;

				const x = globeRadius * Math.cos(theta) * Math.sin(phi);
				const y = globeRadius * Math.sin(theta) * Math.sin(phi);
				const z = globeRadius * Math.cos(phi);

				dots.push({ x, y, z, isFlag: false });
			}

			// Add flagship location nodes
			flagNodes.forEach(node => {
				const pos = latLonToXYZ(node.lat, node.lon, globeRadius);
				dots.push({ x: pos.x, y: pos.y, z: pos.z, isFlag: true, label: node.label });
			});
		}

		initGlobe();

		// Drag Control
		canvas.addEventListener('mousedown', (e) => {
			isDragging = true;
			lastMouseX = e.clientX;
			lastMouseY = e.clientY;
		});

		window.addEventListener('mouseup', () => isDragging = false);

		window.addEventListener('mousemove', (e) => {
			if (isDragging) {
				const deltaX = e.clientX - lastMouseX;
				const deltaY = e.clientY - lastMouseY;
				rotationY += deltaX * 0.008;
				rotationX += deltaY * 0.008;
				lastMouseX = e.clientX;
				lastMouseY = e.clientY;
			}
		});

		// Render Loop
		function renderGlobe() {
			ctx.clearRect(0, 0, width, height);

			if (!isDragging) {
				rotationY += autoSpeedY;
			}

			const cosX = Math.cos(rotationX);
			const sinX = Math.sin(rotationX);
			const cosY = Math.cos(rotationY);
			const sinY = Math.sin(rotationY);

			const centerX = width / 2;
			const centerY = height / 2;

			// Project 3D to 2D
			const projectedDots = dots.map(dot => {
				let x1 = dot.x * cosY - dot.z * sinY;
				let z1 = dot.z * cosY + dot.x * sinY;

				let y1 = dot.y * cosX - z1 * sinX;
				let z2 = z1 * cosX + dot.y * sinX;

				const scale = 320 / (320 + z2);
				const projX = x1 * scale + centerX;
				const projY = y1 * scale + centerY;
				const alpha = Math.max(0.1, (z2 + globeRadius) / (globeRadius * 2));

				return { projX, projY, scale, alpha, z: z2, isFlag: dot.isFlag, label: dot.label };
			});

			projectedDots.sort((a, b) => a.z - b.z);

			// 1. Draw Connected Energy Arcs Between Flag Nodes
			const flagPoints = projectedDots.filter(d => d.isFlag && d.z > -40);
			for (let i = 0; i < flagPoints.length; i++) {
				for (let j = i + 1; j < flagPoints.length; j++) {
					const p1 = flagPoints[i];
					const p2 = flagPoints[j];

					ctx.beginPath();
					ctx.moveTo(p1.projX, p1.projY);
					
					// Curve energy arc outward
					const midX = (p1.projX + p2.projX) / 2;
					const midY = (p1.projY + p2.projY) / 2 - 30;

					ctx.quadraticCurveTo(midX, midY, p2.projX, p2.projY);
					ctx.strokeStyle = `rgba(204, 255, 0, ${Math.min(p1.alpha, p2.alpha) * 0.4})`;
					ctx.lineWidth = 1;
					ctx.stroke();
				}
			}

			// 2. Render Nodes and Location Flags
			projectedDots.forEach(dot => {
				ctx.beginPath();

				if (dot.isFlag) {
					// Glowing Primary Flag Node
					ctx.arc(dot.projX, dot.projY, 4 * dot.scale, 0, Math.PI * 2);
					ctx.fillStyle = `rgba(204, 255, 0, ${dot.alpha})`;
					ctx.shadowBlur = 10;
					ctx.shadowColor = '#ccff00';
					ctx.fill();

					// Draw Country Flag Label if on front hemisphere
					if (dot.z > -20) {
						ctx.font = '10px "Courier New", monospace';
						ctx.fillStyle = `rgba(255, 255, 255, ${dot.alpha})`;
						ctx.fillText(dot.label, dot.projX + 8, dot.projY + 3);
					}
				} else {
					// Standard Dot Matrix
					ctx.arc(dot.projX, dot.projY, 1.2 * dot.scale, 0, Math.PI * 2);
					ctx.fillStyle = `rgba(255, 255, 255, ${dot.alpha * 0.5})`;
					ctx.shadowBlur = 0;
					ctx.fill();
				}
			});

			requestAnimationFrame(renderGlobe);
		}

		renderGlobe();
	}
});

document.addEventListener('DOMContentLoaded', () => {

	const pricingGrid = document.querySelector('.k-addon-grid');

	if (pricingGrid) {
		const basePrice = parseInt(pricingGrid.getAttribute('data-base-price')) || 950;
		const moduleCards = document.querySelectorAll('.k-module-card');
		const totalPriceEl = document.getElementById('kTotalPrice');
		const addonCountEl = document.getElementById('kAddonCount');
		const addonTotalDisplayEl = document.getElementById('kAddonTotalDisplay');
		const summaryMonolith = document.querySelector('.k-summary-monolith');

		let currentTotal = basePrice;

		function calculateTotals(isInitial = false) {
			let activeAddonsCount = 0;
			let activeAddonsPrice = 0;

			moduleCards.forEach(card => {
				const checkbox = card.querySelector('.k-addon-checkbox');
				const price = parseInt(card.getAttribute('data-price')) || 0;

				if (checkbox && checkbox.checked) {
					activeAddonsCount++;
					activeAddonsPrice += price;
					card.classList.add('is-selected');
				} else {
					card.classList.remove('is-selected');
				}
			});

			const newGrandTotal = basePrice + activeAddonsPrice;

			if (!isInitial && typeof gsap !== 'undefined') {
				// Smooth counter animation
				gsap.to({ val: currentTotal }, {
					val: newGrandTotal,
					duration: 0.5,
					ease: 'power3.out',
					onUpdate: function() {
						totalPriceEl.textContent = Math.round(this.targets()[0].val);
					}
				});

				gsap.to({ val: parseInt(addonTotalDisplayEl.textContent) || 0 }, {
					val: activeAddonsPrice,
					duration: 0.5,
					ease: 'power3.out',
					onUpdate: function() {
						addonTotalDisplayEl.textContent = Math.round(this.targets()[0].val);
					}
				});

				// Subtle glow pulse on summary card
				if (summaryMonolith) {
					gsap.fromTo(summaryMonolith, 
						{ borderColor: '#ccff00', boxShadow: '0 0 30px rgba(204,255,0,0.25)' },
						{ borderColor: '#1c1c28', boxShadow: '0 0 0px rgba(0,0,0,0)', duration: 0.8, ease: 'power2.out' }
					);
				}

			} else {
				totalPriceEl.textContent = newGrandTotal;
				addonTotalDisplayEl.textContent = activeAddonsPrice;
			}

			currentTotal = newGrandTotal;
			addonCountEl.textContent = activeAddonsCount;
		}

		// Listen for toggle switches
		moduleCards.forEach(card => {
			const checkbox = card.querySelector('.k-addon-checkbox');
			if (checkbox) {
				checkbox.addEventListener('change', () => {
					calculateTotals(false);
				});
			}
		});

		// Initial calculation
		calculateTotals(true);
	}
});