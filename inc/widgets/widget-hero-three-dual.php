<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Kinetic_Hero_Three_Dual_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'kinetic_hero_three_dual';
	}

	public function get_title() {
		return __( 'Kinetic Dual-Column Three.js Hero', 'kinetic' );
	}

	public function get_icon() {
		return 'eicon-layout-medium';
	}

	public function get_categories() {
		return array( 'kinetic-widgets' );
	}

	protected function register_controls() {

		// CONTENT CONTROLS
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Hero Left Content', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'badge_text',
			array(
				'label'   => __( 'Mono Badge', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '// NEXT-GEN WEB ARCHITECTURE',
			)
		);

		$this->add_control(
			'headline_prefix',
			array(
				'label'   => __( 'Headline Prefix Text', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'WE ENGINEER',
			)
		);

		$this->add_control(
			'headline_rotator_words',
			array(
				'label'       => __( 'Rotating Words (Comma Separated)', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'MONOLITHS, PLATFORMS, EXPERIENCES, ENGINES',
				'description' => __( 'Comma-separated list of dynamic highlighted words.', 'kinetic' ),
			)
		);

		$this->add_control(
			'headline_suffix',
			array(
				'label'   => __( 'Headline Suffix Text', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'WITHOUT BLOAT',
			)
		);

		$this->add_control(
			'sub_description',
			array(
				'label'   => __( 'Sub Description', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Custom WordPress engineering built with bespoke Elementor controls, fluid WebGL motion, and native 100/100 Core Web Vitals performance.',
			)
		);

		$this->add_control(
			'btn_primary_text',
			array(
				'label'   => __( 'Primary Button Text', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'EXPLORE SPRINTS',
			)
		);

		$this->add_control(
			'btn_secondary_text',
			array(
				'label'   => __( 'Secondary Button Text', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'VIEW SHOWCASE',
			)
		);

		$this->end_controls_section();

		// THREE.JS CANVAS CONTROLS
		$this->start_controls_section(
			'section_three_settings',
			array(
				'label' => __( 'Three.js & Motion Controls', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_orb',
			array(
				'label'        => __( 'Display WebGL Orb', 'kinetic' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'particle_count',
			array(
				'label'   => __( 'Particle Count', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 2800,
				'min'     => 500,
				'max'     => 6000,
				'step'    => 100,
			)
		);

		$this->add_control(
			'rotate_interval',
			array(
				'label'       => __( 'Word Rotate Speed (ms)', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'default'     => 2600,
				'min'         => 1000,
				'max'         => 10000,
				'step'        => 200,
			)
		);

		$this->add_control(
			'mouse_sensitivity',
			array(
				'label'   => __( 'Mouse Tracking Sensitivity', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range'   => array(
					'px' => array(
						'min'  => 0.01,
						'max'  => 0.15,
						'step' => 0.01,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 0.05,
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$rotator_words = array_map( 'trim', explode( ',', $settings['headline_rotator_words'] ) );
		$show_orb = 'yes' === $settings['show_orb'] ? '1' : '0';
		?>
		<section class="k-dual-hero-section" id="hero">
			
			<!-- Background Radial Glow Anchor (RHS Biased) -->
			<div class="k-dual-hero-glow"></div>

			<!-- Full-Bleed Background Three.js WebGL Canvas -->
			<div id="k-three-canvas-container-dual" 
				 class="k-dual-canvas-wrap" 
				 data-show-orb="<?php echo esc_attr( $show_orb ); ?>"
				 data-particle-count="<?php echo esc_attr( $settings['particle_count'] ); ?>"
				 data-sensitivity="<?php echo esc_attr( $settings['mouse_sensitivity']['size'] ); ?>"
				 data-rotate-speed="<?php echo esc_attr( $settings['rotate_interval'] ); ?>">
			</div>

			<!-- Left-Aligned Content Container -->
			<div class="k-dual-hero-container">
				<div class="k-dual-hero-left">
					
					<!-- Mono Badge -->
					<div class="k-dual-badge-wrap">
						<span class="k-pulse-dot"></span>
						<span class="k-mono-label"><?php echo esc_html( $settings['badge_text'] ); ?></span>
					</div>

					<!-- Animated Headline with Rotating Highlight -->
					<h1 class="k-dual-hero-title">
						<span class="k-title-prefix"><?php echo esc_html( $settings['headline_prefix'] ); ?></span>
						<span class="k-rotator-wrapper">
							<?php foreach ( $rotator_words as $idx => $word ) : ?>
								<span class="k-rotator-word <?php echo $idx === 0 ? 'is-active' : ''; ?>">
									<?php echo esc_html( $word ); ?>
								</span>
							<?php endforeach; ?>
						</span>
						<span class="k-title-suffix"><?php echo esc_html( $settings['headline_suffix'] ); ?></span>
					</h1>

					<!-- Sub Description -->
					<p class="k-dual-hero-desc"><?php echo esc_html( $settings['sub_description'] ); ?></p>

					<!-- Animated Action Buttons -->
					<div class="k-dual-hero-actions">
						<a href="#contact" class="k-btn-dual-primary">
							<span class="k-btn-light-sweep"></span>
							<span class="k-btn-label"><?php echo esc_html( $settings['btn_primary_text'] ); ?></span>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
						</a>
						<a href="#work" class="k-btn-dual-secondary">
							<span class="k-btn-label"><?php echo esc_html( $settings['btn_secondary_text'] ); ?></span>
						</a>
					</div>

					<!-- Metrics Micro Bar -->
					<div class="k-dual-hero-metrics">
						<div class="k-metric-pill">
							<span class="k-metric-val">100/100</span>
							<span class="k-metric-lbl">LIGHTHOUSE</span>
						</div>
						<div class="k-metric-pill">
							<span class="k-metric-val">0.2s</span>
							<span class="k-metric-lbl">LATENCY</span>
						</div>
						<div class="k-metric-pill">
							<span class="k-metric-val">0%</span>
							<span class="k-metric-lbl">PLUGIN BLOAT</span>
						</div>
					</div>

				</div>
			</div>

		</section>

		<!-- Script Fallback Loader for Three.js -->
		<script>
		if (typeof THREE === 'undefined') {
			var script = document.createElement('script');
			script.src = 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js';
			script.onload = function() {
				if (typeof initKineticHeroThreeDual === 'function') {
					initKineticHeroThreeDual();
				}
			};
			document.head.appendChild(script);
		} else {
			document.addEventListener('DOMContentLoaded', function() {
				if (typeof initKineticHeroThreeDual === 'function') {
					initKineticHeroThreeDual();
				}
			});
		}
		</script>
		<?php
	}
}

\Elementor\Plugin::instance()->widgets_manager->register( new Kinetic_Hero_Three_Dual_Widget() );