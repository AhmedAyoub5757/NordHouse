<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Kinetic_Contact_Terminal_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'kinetic_contact_terminal';
	}

	public function get_title() {
		return __( 'Kinetic Split Questionnaire & Metform', 'kinetic' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return array( 'kinetic-widgets' );
	}

	protected function register_controls() {

		// CONTENT SECTION: HEADINGS & TEXT
		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Section Header & Text', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'section_badge',
			array(
				'label'   => __( 'Mono Badge', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '// INITIATION TERMINAL',
			)
		);

		$this->add_control(
			'section_title',
			array(
				'label'   => __( 'Main Title', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'START A <span>CONVERSATION</span>',
			)
		);

		$this->add_control(
			'section_desc',
			array(
				'label'   => __( 'Side Description', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Complete our 30-second questionnaire. Our senior engineering lead will review your requirements and respond within 12 hours.',
			)
		);

		$this->add_control(
			'target_email',
			array(
				'label'       => __( 'Recipient / Notification Email', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'hello@kinetic-studio.io',
				'placeholder' => 'email@yourdomain.com',
			)
		);

		$this->end_controls_section();

		// CONTENT SECTION: ILLUSTRATION & METFORM SHORTCODE
		$this->start_controls_section(
			'section_form_config',
			array(
				'label' => __( 'Form & Vector Config', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'metform_shortcode',
			array(
				'label'       => __( 'Metform Shortcode (Optional)', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => '[metform form_id="123"]',
				'description' => __( 'If using the Metform plugin, paste your Metform shortcode here. Otherwise, the built-in REST API terminal will render.', 'kinetic' ),
			)
		);

		$this->add_control(
			'vector_type',
			array(
				'label'   => __( 'Side Vector Illustration', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'terminal',
				'options' => array(
					'terminal' => __( 'Terminal Communication', 'kinetic' ),
					'rocket'   => __( 'Project Launch', 'kinetic' ),
					'radar'    => __( 'Diagnostic Scan', 'kinetic' ),
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$has_shortcode = ! empty( $settings['metform_shortcode'] );
		?>
		<section class="k-split-terminal-section" id="contact">
			<div class="k-split-terminal-container">
				
				<!-- Left Column: Sticky Minimalist Visual & Info -->
				<div class="k-terminal-left-col">
					<div class="k-terminal-sticky-inner">
						<span class="k-mono-label"><?php echo esc_html( $settings['section_badge'] ); ?></span>
						<h2 class="k-terminal-split-h2"><?php echo wp_kses_post( $settings['section_title'] ); ?></h2>
						<p class="k-terminal-split-desc"><?php echo esc_html( $settings['section_desc'] ); ?></p>

						<!-- Animated unDraw Vector Frame -->
						<!-- <div class="k-terminal-vector-box">
							<?php $this->render_vector_art( $settings['vector_type'] ); ?>
						</div> -->

						<!-- Direct Support Pill -->
						<div class="k-direct-email-card">
							<div class="k-email-icon-circle">
								<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
							</div>
							<div class="k-email-details">
								<span class="k-email-lbl">DIRECT TRANSMISSION LINE</span>
								<a href="mailto:<?php echo esc_attr( $settings['target_email'] ); ?>" class="k-email-link"><?php echo esc_html( $settings['target_email'] ); ?></a>
							</div>
						</div>
					</div>
				</div>

				<!-- Right Column: Step-by-Step Questionnaire / Metform -->
				<div class="k-terminal-right-col">
					<?php if ( $has_shortcode ) : ?>
						<div class="k-metform-wrapper">
							<?php echo do_shortcode( $settings['metform_shortcode'] ); ?>
						</div>
					<?php else : ?>
						<div class="k-questionnaire-card" id="kQuestionnaireCard">
							
							<div class="k-q-progress-bar">
								<div class="k-q-progress-fill" id="kQProgress"></div>
							</div>

							<!-- STEP 1: SERVICES -->
							<div class="k-q-step is-active" data-step="1">
								<div class="k-q-step-meta">
									<span class="k-step-num">// QUESTION 01 / 04</span>
									<span class="k-step-tag">CAPABILITIES</span>
								</div>
								<h3 class="k-q-prompt">What digital services do you require?</h3>

								<div class="k-options-grid">
									<label class="k-chip-option">
										<input type="checkbox" name="services" value="Web Engineering">
										<span class="k-chip-box">
											<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
											Web Engineering
										</span>
									</label>

									<label class="k-chip-option">
										<input type="checkbox" name="services" value="Mobile Apps">
										<span class="k-chip-box">
											<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
											Mobile Apps
										</span>
									</label>

									<label class="k-chip-option">
										<input type="checkbox" name="services" value="UI/UX Strategy">
										<span class="k-chip-box">
											<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
											UI/UX Strategy
										</span>
									</label>

									<label class="k-chip-option">
										<input type="checkbox" name="services" value="Brand Systems">
										<span class="k-chip-box">
											<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
											Brand Identity
										</span>
									</label>
								</div>

								<div class="k-q-actions">
									<button class="k-q-next-btn" onclick="nextQuestion(1)">
										<span>CONTINUE</span>
										<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
									</button>
								</div>
							</div>

							<!-- STEP 2: BUDGET -->
							<div class="k-q-step" data-step="2">
								<div class="k-q-step-meta">
									<span class="k-step-num">// QUESTION 02 / 04</span>
									<span class="k-step-tag">ALLOCATION</span>
								</div>
								<h3 class="k-q-prompt">What is your target investment range?</h3>

								<div class="k-options-grid">
									<label class="k-chip-option radio">
										<input type="radio" name="budget" value="$2.5K - $5K">
										<span class="k-chip-box">$2,500 — $5,000</span>
									</label>
									<label class="k-chip-option radio">
										<input type="radio" name="budget" value="$5K - $10K">
										<span class="k-chip-box">$5,000 — $10,000</span>
									</label>
									<label class="k-chip-option radio">
										<input type="radio" name="budget" value="$10K+">
										<span class="k-chip-box">$10,000+ (Enterprise)</span>
									</label>
								</div>

								<div class="k-q-actions">
									<button class="k-q-back-btn" onclick="prevQuestion(2)">
										<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
										<span>BACK</span>
									</button>
									<button class="k-q-next-btn" onclick="nextQuestion(2)">
										<span>CONTINUE</span>
										<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
									</button>
								</div>
							</div>

							<!-- STEP 3: DETAILS -->
							<div class="k-q-step" data-step="3">
								<div class="k-q-step-meta">
									<span class="k-step-num">// QUESTION 03 / 04</span>
									<span class="k-step-tag">PROJECT SCOPE</span>
								</div>
								<h3 class="k-q-prompt">Briefly describe your objectives or launch target:</h3>

								<textarea id="kProjectDetails" class="k-q-input textarea" placeholder="Share any specific goals, references, or deadlines..."></textarea>

								<div class="k-q-actions">
									<button class="k-q-back-btn" onclick="prevQuestion(3)">
										<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
										<span>BACK</span>
									</button>
									<button class="k-q-next-btn" onclick="nextQuestion(3)">
										<span>CONTINUE</span>
										<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
									</button>
								</div>
							</div>

							<!-- STEP 4: CONTACT INFO -->
							<div class="k-q-step" data-step="4">
								<div class="k-q-step-meta">
									<span class="k-step-num">// QUESTION 04 / 04</span>
									<span class="k-step-tag">IDENTIFICATION</span>
								</div>
								<h3 class="k-q-prompt">Who should we address our response to?</h3>

								<div class="k-input-pair">
									<input type="text" id="kClientName" class="k-q-input" placeholder="YOUR FULL NAME">
									<input type="email" id="kClientEmail" class="k-q-input" placeholder="YOUR WORK EMAIL">
								</div>

								<div class="k-q-actions">
									<button class="k-q-back-btn" onclick="prevQuestion(4)">
										<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
										<span>BACK</span>
									</button>
									<button class="k-q-submit-btn" id="kSubmitInquiry" data-target-email="<?php echo esc_attr( $settings['target_email'] ); ?>">
										<span>TRANSMIT INQUIRY</span>
										<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
									</button>
								</div>
							</div>

							<!-- STYLED SUCCESS STATE -->
							<div class="k-q-step" id="kResponseStep">
								<div class="k-success-terminal-card">
									<div class="k-success-scanline"></div>
									<div class="k-success-header">
										<div class="k-success-icon-box">
											<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
										</div>
										<span class="k-success-tag">// TRANSMISSION VERIFIED</span>
									</div>
									<h4 class="k-success-title">INQUIRY RECEIVED</h4>
									<p class="k-success-desc" id="kResponseMsg">Your inquiry has been encrypted and transmitted to our senior dev team.</p>
									<div class="k-success-footer-badge">
										<span class="k-pulse-dot"></span>
										<span>EXPECT RESPONSE IN &lt; 12 HOURS</span>
									</div>
								</div>
							</div>

						</div>
					<?php endif; ?>
				</div>

			</div>
		</section>
		<?php
	}

	private function render_vector_art( $type ) {
		switch ( $type ) {
			case 'rocket':
				?>
				<svg class="k-svg-art" viewBox="0 0 240 180" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M120 20 C160 50, 170 110, 170 140 L70 140 C70 110, 80 50, 120 20 Z" stroke="var(--hero-accent)" stroke-width="2" fill="rgba(204,255,0,0.05)"/>
					<circle cx="120" cy="70" r="16" stroke="var(--hero-accent)" stroke-width="2"/>
					<path d="M70 140 L50 160 L70 150 Z" fill="var(--hero-accent)"/>
					<path d="M170 140 L190 160 L170 150 Z" fill="var(--hero-accent)"/>
				</svg>
				<?php
				break;
			case 'radar':
				?>
				<svg class="k-svg-art" viewBox="0 0 240 180" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="120" cy="90" r="70" stroke="#222" stroke-width="2"/>
					<circle cx="120" cy="90" r="45" stroke="var(--hero-accent)" stroke-width="2" stroke-dasharray="4 4"/>
					<circle cx="120" cy="90" r="20" stroke="var(--hero-accent)" stroke-width="2"/>
					<line x1="120" y1="20" x2="120" y2="160" stroke="#333" stroke-width="1"/>
					<line x1="50" y1="90" x2="190" y2="90" stroke="#333" stroke-width="1"/>
				</svg>
				<?php
				break;
			default: // 'terminal'
				?>
				<svg class="k-svg-art" viewBox="0 0 240 180" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="20" y="20" width="200" height="140" rx="6" stroke="var(--hero-accent)" stroke-width="2" fill="#0b0c10"/>
					<line x1="20" y1="50" x2="220" y2="50" stroke="var(--hero-accent)" stroke-width="2"/>
					<circle cx="35" cy="35" r="4" fill="var(--hero-accent)"/>
					<circle cx="50" cy="35" r="4" fill="#444"/>
					<polyline points="40 80 55 95 40 110" stroke="var(--hero-accent)" stroke-width="2.5" stroke-linecap="round"/>
					<line x1="65" y1="110" x2="95" y2="110" stroke="var(--hero-accent)" stroke-width="2.5"/>
				</svg>
				<?php
				break;
		}
	}
}

\Elementor\Plugin::instance()->widgets_manager->register( new Kinetic_Contact_Terminal_Widget() );