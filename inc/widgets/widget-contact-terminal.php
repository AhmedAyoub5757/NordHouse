<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Kinetic_Contact_Terminal_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'kinetic_contact_terminal';
	}

	public function get_title() {
		return __( 'Kinetic Split Questionnaire & Connected Globe', 'kinetic' );
	}

	public function get_icon() {
		return 'eicon-globe';
	}

	public function get_categories() {
		return array( 'kinetic-widgets' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Section Header & Info', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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
				'label'   => __( 'Description', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Deploying high-performance digital products globally. Complete our 30-second inquiry flow to initiate your sprint.',
			)
		);

		$this->add_control(
			'target_email',
			array(
				'label'   => __( 'Recipient Email', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'hello@kinetic-studio.io',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="k-split-terminal-section" id="contact">
			<div class="k-split-terminal-container">
				
				<!-- LHS: Full-Bleed Connected Globe (Equal Height Alignment) -->
				<div class="k-terminal-left-col">
					<div class="k-terminal-sticky-inner">
						<h2 class="k-terminal-split-h2"><?php echo wp_kses_post( $settings['section_title'] ); ?></h2>
						<p class="k-terminal-split-desc"><?php echo esc_html( $settings['section_desc'] ); ?></p>

						<!-- BORDERLESS GLOBE CONTAINER -->
						<div class="nexus-borderless-globe-wrap">
							<canvas id="nexusGlobeCanvas"></canvas>
						</div>
					</div>
				</div>

				<!-- RHS: Questionnaire Card (Equal Height Alignment) -->
				<div class="k-terminal-right-col">
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
							<h3 class="k-q-prompt">What digital capabilities do you require?</h3>

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
				</div>

			</div>
		</section>
		<?php
	}
}

\Elementor\Plugin::instance()->widgets_manager->register( new Kinetic_Contact_Terminal_Widget() );