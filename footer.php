<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
	</div><!-- #content / main page wrapper -->

	<!-- REVEAL FOOTER CONTAINER -->
	<footer class="k-footer-reveal" id="site-footer">
		
		<!-- Ambient Laser Grid & Radial Gradient -->
		<div class="k-footer-bg-grid"></div>

		<div class="k-footer-centered-container">
			
			<!-- Top Centered Call-To-Action Block -->
			<div class="k-footer-cta-block">
				<span class="k-mono-label">// READY TO ENGAGE?</span>
				<h2 class="k-footer-cta-title">LET’S BUILD SOMETHING <span>SUPERIOR</span></h2>
				<p class="k-footer-cta-desc">
					Transform your digital presence with zero-bloat custom engineering, fluid motion systems, and unmatched performance.
				</p>
				<div class="k-footer-cta-action">
					<a href="#contact" class="k-footer-primary-btn">
						<span>INITIATE PROJECT SPRINT</span>
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
					</a>
				</div>
			</div>

			<div class="k-footer-divider"></div>

			<!-- Middle Centered Split Navigation -->
			<div class="k-footer-nav-wrapper">
				
				<!-- Main Navigation Links -->
				<div class="k-footer-nav-group">
					<span class="k-nav-group-label">// MAIN</span>
					<ul class="k-f-main-links">
						<li><a href="#hero">OVERVIEW</a></li>
						<li><a href="#work">SELECTED WORK</a></li>
						<li><a href="#process">METHODOLOGY</a></li>
						<li><a href="#comparison">THE DIFFERENCE</a></li>
						<li><a href="#pricing">PRICING</a></li>
						<li><a href="#faq">KNOWLEDGE BASE</a></li>
					</ul>
				</div>

				<!-- Social Links with ArrowUpRight Icons -->
				<div class="k-footer-nav-group">
					<span class="k-nav-group-label">// CONNECT</span>
					<ul class="k-f-social-links">
						<li>
							<a href="https://github.com" target="_blank" rel="noopener">
								<span>GITHUB</span>
								<svg class="k-arrow-up-right" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
							</a>
						</li>
						<li>
							<a href="https://twitter.com" target="_blank" rel="noopener">
								<span>TWITTER / X</span>
								<svg class="k-arrow-up-right" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
							</a>
						</li>
						<li>
							<a href="https://linkedin.com" target="_blank" rel="noopener">
								<span>LINKEDIN</span>
								<svg class="k-arrow-up-right" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
							</a>
						</li>
						<li>
							<a href="https://dribbble.com" target="_blank" rel="noopener">
								<span>DRIBBBLE</span>
								<svg class="k-arrow-up-right" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
							</a>
						</li>
					</ul>
				</div>

				<!-- Legal Links & Timezone -->
				<div class="k-footer-nav-group">
					<span class="k-nav-group-label">// LEGAL & TIME</span>
					<div class="k-f-legal-links">
						<a href="#">PRIVACY POLICY</a>
						<span class="k-legal-dot">•</span>
						<a href="#">TERMS OF SERVICE</a>
						<span class="k-legal-dot">•</span>
						<a href="#">SECURITY AUDITS</a>
					</div>
					<!-- <div class="k-f-clock-pill">
						<span class="k-pulse-dot"></span>
						<span>PKT TIMEZONE: <strong id="kFooterClock">00:00:00</strong></span>
					</div> -->
				</div>

			</div>

			<!-- Bottom Decorative Brand Wordmark (Large SVG Gradient Fade) -->
			<div class="k-footer-wordmark-container">
				<svg class="k-brand-wordmark-svg" viewBox="0 0 1000 200" fill="none" xmlns="http://www.w3.org/2000/svg">
					<defs>
						<!-- Vertical Gradient Fading from Primary Accent to Transparent -->
						<linearGradient id="kWordmarkGradient" x1="0%" y1="0%" x2="0%" y2="100%">
							<stop offset="0%" stop-color="var(--hero-accent, #ccff00)" stop-opacity="0.9" />
							<stop offset="60%" stop-color="var(--hero-accent, #ccff00)" stop-opacity="0.25" />
							<stop offset="100%" stop-color="var(--hero-accent, #ccff00)" stop-opacity="0.0" />
						</linearGradient>
					</defs>
					
					<text x="50%" y="70%" text-anchor="middle" class="k-wordmark-text-path" fill="url(#kWordmarkGradient)">
						KINETIC
					</text>
				</svg>
			</div>

			<!-- Copyright bar -->
			<div class="k-footer-copyright">
				&copy; <?php echo date('Y'); ?> KINETIC ENGINE. ALL RIGHTS RESERVED. HANDCRAFTED WITH ZERO BLOAT.
			</div>

		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>