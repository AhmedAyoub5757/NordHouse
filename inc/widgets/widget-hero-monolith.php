<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Kinetic_Hero_Monolith_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'kinetic_hero_monolith';
	}

	public function get_title() {
		return __( 'Kinetic Monolith Accordion Hero', 'kinetic' );
	}

	public function get_icon() {
		return 'eicon-columns';
	}

	public function get_categories() {
		return array( 'kinetic-widgets' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_services',
			array(
				'label' => __( 'Hero Service Columns', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'col_index',
			array(
				'label'   => __( 'Index Number', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '01',
			)
		);

		$repeater->add_control(
			'col_title',
			array(
				'label'   => __( 'Service Title', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'WEB DEV',
			)
		);

		$repeater->add_control(
			'col_tagline',
			array(
				'label'   => __( 'Expanded Tagline', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'High-performance web applications, headless CMS, Jamstack architectures.',
			)
		);

		$repeater->add_control(
			'col_features',
			array(
				'label'       => __( 'Feature List (Separated by Bullet •)', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => 'Custom Themes • Headless WP • React/Next.js • REST APIs',
			)
		);

		$repeater->add_control(
			'col_cta_text',
			array(
				'label'   => __( 'CTA Button Text', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'EXPLORE WEB DEV',
			)
		);

		$repeater->add_control(
			'col_cta_link',
			array(
				'label'   => __( 'CTA Link', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::URL,
				'default' => array( 'url' => '#services' ),
			)
		);

		$repeater->add_control(
			'col_svg_type',
			array(
				'label'   => __( 'Vector Illustration Preset', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'web',
				'options' => array(
					'web'         => __( 'Web Dev Illustration', 'kinetic' ),
					'mobile'      => __( 'Mobile App Illustration', 'kinetic' ),
					'uiux'        => __( 'UI/UX Design Illustration', 'kinetic' ),
					'brand'       => __( 'Brand Identity Illustration', 'kinetic' ),
					'performance' => __( 'Performance Illustration', 'kinetic' ),
				),
			)
		);

		$this->add_control(
			'services_list',
			array(
				'label'       => __( '5 Accordion Columns', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'col_index'    => '01',
						'col_title'    => 'WEB DEV',
						'col_tagline'  => 'Scalable web applications engineered for speed & zero downtime.',
						'col_features' => 'Custom WordPress • Jamstack • React/Next.js • REST APIs',
						'col_svg_type' => 'web',
					),
					array(
						'col_index'    => '02',
						'col_title'    => 'MOB APP DEV',
						'col_tagline'  => 'Native & cross-platform iOS & Android mobile experiences.',
						'col_features' => 'Flutter • React Native • iOS Native • Offline First',
						'col_svg_type' => 'mobile',
					),
					array(
						'col_index'    => '03',
						'col_title'    => 'UI/UX DESIGN',
						'col_tagline'  => 'Design systems, micro-interactions, and conversion-focused UI.',
						'col_features' => 'Design Systems • Wireframing • Motion Design • Usability Testing',
						'col_svg_type' => 'uiux',
					),
					array(
						'col_index'    => '04',
						'col_title'    => 'BRAND IDENTITY',
						'col_tagline'  => 'Distinct modern visual systems, motion graphic kits, typography.',
						'col_features' => 'Brand Strategy • Motion Identity • 3D Assets • Typography',
						'col_svg_type' => 'brand',
					),
					array(
						'col_index'    => '05',
						'col_title'    => 'PERFORMANCE OPTIMIZATION',
						'col_tagline'  => 'Lighthouse 100/100 audits, speed optimization, technical SEO.',
						'col_features' => 'Speed Optimization • Core Web Vitals • Server Tuning • Code Audits',
						'col_svg_type' => 'performance',
					),
				),
				'title_field' => '{{{ col_index }}} — {{{ col_title }}}',
			)
		);

		$this->end_controls_section();

		// STYLE SECTION
		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Hero Colors & Style', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'accent_color',
			array(
				'label'     => __( 'Neon Accent Color', 'kinetic' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ccff00',
				'selectors' => array(
					'{{WRAPPER}}' => '--hero-accent: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="k-hero-monolith">
			<div class="k-monolith-container">
				<?php foreach ( $settings['services_list'] as $index => $col ) : 
					$cta_url = ! empty( $col['col_cta_link']['url'] ) ? $col['col_cta_link']['url'] : '#contact';
				?>
					<div class="k-mono-col <?php echo $index === 0 ? 'is-active' : ''; ?>" data-col="<?php echo esc_attr($index); ?>">
						
						<!-- Animated Ambient Gradient Layer -->
						<div class="k-col-gradient-bg"></div>

						<!-- Border Line Animation -->
						<div class="k-col-border"></div>

						<!-- Collapsed State (Hollow Vertical Text, No Plus Icon) -->
						<div class="k-col-collapsed">
							<span class="k-col-num">// <?php echo esc_html( $col['col_index'] ); ?></span>
							<h2 class="k-col-vertical-title"><?php echo esc_html( $col['col_title'] ); ?></h2>
						</div>

						<!-- Expanded Active Content State -->
						<div class="k-col-expanded">
							<div class="k-exp-header">
								<span class="k-exp-num"><?php echo esc_html( $col['col_index'] ); ?></span>
								<h3 class="k-exp-title"><?php echo esc_html( $col['col_title'] ); ?></h3>
							</div>

							<p class="k-exp-tagline"><?php echo esc_html( $col['col_tagline'] ); ?></p>

							<div class="k-exp-body">
								<!-- Feature Tags -->
								<div class="k-exp-features">
									<?php 
									$features = explode( '•', $col['col_features'] );
									foreach ( $features as $feat ) :
										if ( trim( $feat ) !== '' ) : ?>
											<span class="k-feat-tag"><?php echo esc_html( trim( $feat ) ); ?></span>
										<?php endif;
									endforeach; 
									?>
								</div>

								<!-- Floating SVG Vector Graphic -->
								<div class="k-exp-illustration">
									<?php $this->render_vector_illustration( $col['col_svg_type'] ); ?>
								</div>
							</div>

							<div class="k-exp-footer">
								<a href="<?php echo esc_url( $cta_url ); ?>" class="k-exp-btn">
									<span><?php echo esc_html( $col['col_cta_text'] ); ?></span>
									<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
								</a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</section>
		<?php
	}

	private function render_vector_illustration( $type ) {
		switch ( $type ) {
			case 'mobile':
				?>
				<svg class="k-svg-art" viewBox="0 0 200 160" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect class="k-anim-path" x="60" y="10" width="80" height="140" rx="12" stroke="var(--hero-accent)" stroke-width="2" fill="#0d0e12"/>
					<line x1="85" y1="20" x2="115" y2="20" stroke="var(--hero-accent)" stroke-width="2" stroke-linecap="round"/>
					<circle cx="100" cy="135" r="4" stroke="var(--hero-accent)" stroke-width="2"/>
					<rect class="k-pulse-box" x="70" y="35" width="60" height="40" fill="rgba(204,255,0,0.15)" stroke="var(--hero-accent)" stroke-dasharray="2 2"/>
					<rect x="70" y="85" width="40" height="8" rx="2" fill="var(--hero-accent)"/>
					<rect x="70" y="98" width="50" height="6" rx="2" fill="#444"/>
				</svg>
				<?php
				break;
			case 'uiux':
				?>
				<svg class="k-svg-art" viewBox="0 0 200 160" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="20" y="20" width="160" height="120" rx="4" stroke="#333" stroke-width="2" fill="#0d0e12"/>
					<path d="M20 45H180" stroke="#333" stroke-width="2"/>
					<circle cx="35" cy="32" r="3" fill="var(--hero-accent)"/>
					<circle cx="47" cy="32" r="3" fill="#555"/>
					<circle cx="59" cy="32" r="3" fill="#555"/>
					<rect class="k-pulse-box" x="35" y="60" width="50" height="60" fill="rgba(204,255,0,0.12)" stroke="var(--hero-accent)"/>
					<circle class="k-spin-ring" cx="130" cy="90" r="25" stroke="var(--hero-accent)" stroke-width="2" stroke-dasharray="4 4"/>
				</svg>
				<?php
				break;
			case 'brand':
				?>
				<svg class="k-svg-art" viewBox="0 0 200 160" fill="none" xmlns="http://www.w3.org/2000/svg">
					<polygon class="k-anim-path" points="100,20 160,130 40,130" stroke="var(--hero-accent)" stroke-width="2" fill="none"/>
					<circle cx="100" cy="85" r="25" stroke="#fff" stroke-width="2" fill="rgba(204,255,0,0.1)"/>
					<line x1="40" y1="130" x2="160" y2="130" stroke="var(--hero-accent)" stroke-width="4"/>
				</svg>
				<?php
				break;
			case 'performance':
				?>
				<svg class="k-svg-art" viewBox="0 0 200 160" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path class="k-anim-path" d="M30 130 Q 70 90, 100 70 T 170 30" stroke="var(--hero-accent)" stroke-width="3" fill="none"/>
					<polyline points="150,30 170,30 170,50" stroke="var(--hero-accent)" stroke-width="3" fill="none"/>
					<line x1="30" y1="130" x2="170" y2="130" stroke="#333" stroke-width="2"/>
					<circle class="k-pulse-dot" cx="100" cy="70" r="6" fill="var(--hero-accent)"/>
				</svg>
				<?php
				break;
			default: // 'web'
				?>
				<svg class="k-svg-art" viewBox="0 0 200 160" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="20" y="20" width="160" height="120" rx="4" stroke="var(--hero-accent)" stroke-width="2" fill="#0d0e12"/>
					<line x1="20" y1="45" x2="180" y2="45" stroke="var(--hero-accent)" stroke-width="2"/>
					<path class="k-anim-path" d="M40 70 L60 85 L40 100" stroke="var(--hero-accent)" stroke-width="2" stroke-linecap="round"/>
					<line x1="70" y1="100" x2="95" y2="100" stroke="var(--hero-accent)" stroke-width="2"/>
				</svg>
				<?php
				break;
		}
	}
}

\Elementor\Plugin::instance()->widgets_manager->register( new Kinetic_Hero_Monolith_Widget() );