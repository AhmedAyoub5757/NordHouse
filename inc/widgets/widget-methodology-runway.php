<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Kinetic_Methodology_Runway_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'kinetic_methodology_runway';
	}

	public function get_title() {
		return __( 'Kinetic Horizontal Process Runway', 'kinetic' );
	}

	public function get_icon() {
		return 'eicon-time-line';
	}

	public function get_categories() {
		return array( 'kinetic-widgets' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Section Title', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'section_badge',
			array(
				'label'   => __( 'Mono Badge', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '// WORKFLOW ENGINE',
			)
		);

		$this->add_control(
			'section_title',
			array(
				'label'   => __( 'Main Title', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'OUR SPRINT <span>METHODOLOGY</span>',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_steps',
			array(
				'label' => __( 'Process Steps', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'step_number',
			array(
				'label'   => __( 'Step Index', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '01',
			)
		);

		$repeater->add_control(
			'step_title',
			array(
				'label'   => __( 'Step Title', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'DISCOVERY & DIAGNOSTICS',
			)
		);

		$repeater->add_control(
			'step_desc',
			array(
				'label'   => __( 'Description', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'In-depth architecture analysis, competitor landscape mapping, and technical feasibility audits.',
			)
		);

		$repeater->add_control(
			'step_progress',
			array(
				'label'   => __( 'Completion Indicator', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '25% COMPLETED',
			)
		);

		$repeater->add_control(
			'step_svg_type',
			array(
				'label'   => __( 'SVG Icon Type', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'discovery',
				'options' => array(
					'discovery'    => __( 'Discovery / Radar', 'kinetic' ),
					'architecture' => __( 'Architecture / Grid', 'kinetic' ),
					'execution'    => __( 'Execution / Code', 'kinetic' ),
					'deployment'   => __( 'Deployment / Rocket', 'kinetic' ),
				),
			)
		);

		$this->add_control(
			'process_steps',
			array(
				'label'       => __( 'Sprint Steps', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'step_number'   => '01',
						'step_title'    => 'DISCOVERY & AUDIT',
						'step_desc'     => 'In-depth codebase analysis, UX audits, and high-level architectural roadmap definition.',
						'step_progress' => '25% SPRINT PHASING',
						'step_svg_type' => 'discovery',
					),
					array(
						'step_number'   => '02',
						'step_title'    => 'SYSTEM ARCHITECTURE',
						'step_desc'     => 'Creating custom component design systems, DB schematics, and API data-flow pipelines.',
						'step_progress' => '50% SPRINT PHASING',
						'step_svg_type' => 'architecture',
					),
					array(
						'step_number'   => '03',
						'step_title'    => 'PRECISION EXECUTION',
						'step_desc'     => 'Iterative frontend & backend engineering with zero third-party dependencies or page bloat.',
						'step_progress' => '75% SPRINT PHASING',
						'step_svg_type' => 'execution',
					),
					array(
						'step_number'   => '04',
						'step_title'    => 'DEPLOYMENT & LAUNCH',
						'step_desc'     => 'Server tuning, Lighthouse 100/100 audits, CI/CD automated deployment, and launch protocols.',
						'step_progress' => '100% DEPLOYED',
						'step_svg_type' => 'deployment',
					),
				),
				'title_field' => 'Step {{{ step_number }}} — {{{ step_title }}}',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="k-runway-section" id="process">
			<div class="k-runway-header">
				<span class="k-mono-label"><?php echo esc_html( $settings['section_badge'] ); ?></span>
				<h2 class="k-runway-h2"><?php echo wp_kses_post( $settings['section_title'] ); ?></h2>
			</div>

			<!-- Dynamic Asymmetrical Laser Wave Container -->
			<div class="k-runway-track-container">
				
				<!-- Asymmetrical Curved Path Connecting Off-Set Nodes -->
				<svg class="k-laser-wave-svg" viewBox="0 0 1200 280" fill="none" preserveAspectRatio="none">
					<path class="k-laser-path-bg" d="M 0,40 C 150,40 200,160 300,160 C 450,160 500,60 600,60 C 750,60 800,200 900,200 C 1050,200 1100,80 1200,80" stroke="#1c1c28" stroke-width="3" fill="none"/>
					<path class="k-laser-path-active" id="kLaserPathActive" d="M 0,40 C 150,40 200,160 300,160 C 450,160 500,60 600,60 C 750,60 800,200 900,200 C 1050,200 1100,80 1200,80" stroke="var(--hero-accent, #ccff00)" stroke-width="3" fill="none"/>
				</svg>

				<!-- Non-Card Asymmetrical Grid Layout -->
				<div class="k-runway-nodes-grid">
					<?php foreach ( $settings['process_steps'] as $idx => $step ) : ?>
						<div class="k-runway-node-item k-node-asym-<?php echo esc_attr( $idx ); ?>" data-step="<?php echo esc_attr( $idx ); ?>">
							
							<div class="k-node-point-wrap">
								<div class="k-node-badge-icon">
									<?php $this->render_step_icon( $step['step_svg_type'] ); ?>
								</div>
								<div class="k-node-pulse-ring"></div>
							</div>

							<div class="k-node-info-block">
								<div class="k-node-meta">
									<span class="k-node-num"><?php echo esc_html( $step['step_number'] ); ?></span>
									<span class="k-node-progress"><?php echo esc_html( $step['step_progress'] ); ?></span>
								</div>
								<h3 class="k-node-title"><?php echo esc_html( $step['step_title'] ); ?></h3>
								<p class="k-node-desc"><?php echo esc_html( $step['step_desc'] ); ?></p>
							</div>

						</div>
					<?php endforeach; ?>
				</div>

			</div>
		</section>
		<?php
	}

	private function render_step_icon( $type ) {
		switch ( $type ) {
			case 'architecture':
				?>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
				<?php
				break;
			case 'execution':
				?>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
				<?php
				break;
			case 'deployment':
				?>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"/><path d="M12 15l-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"/></svg>
				<?php
				break;
			default: // 'discovery'
				?>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
				<?php
				break;
		}
	}
}

\Elementor\Plugin::instance()->widgets_manager->register( new Kinetic_Methodology_Runway_Widget() );