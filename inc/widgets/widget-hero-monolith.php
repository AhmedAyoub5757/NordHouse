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

		/* ============================================================
		 * CONTENT — COLUMNS
		 * ============================================================ */
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
				'label'   => __( 'Feature List (Separated by Bullet •)', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Custom Themes • Headless WP • React/Next.js • REST APIs',
			)
		);

		$repeater->add_control(
			'col_cta_text',
			array(
				'label'       => __( 'CTA Button Text', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Auto (e.g. EXPLORE WEB DEV)', 'kinetic' ),
				'default'     => '',
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
			'col_bg_image',
			array(
				'label'   => __( 'Background Image (recommended, premium feel)', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array( 'url' => '' ),
			)
		);

		$repeater->add_control(
			'col_svg_type',
			array(
				'label'       => __( 'Fallback Vector Illustration (used only if no image set)', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'web',
				'options'     => array(
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
						'col_cta_text' => 'EXPLORE WEB DEV',
						'col_svg_type' => 'web',
					),
					array(
						'col_index'    => '02',
						'col_title'    => 'MOB APP DEV',
						'col_tagline'  => 'Native & cross-platform iOS & Android mobile experiences.',
						'col_features' => 'Flutter • React Native • iOS Native • Offline First',
						'col_cta_text' => 'EXPLORE MOB APPS',
						'col_svg_type' => 'mobile',
					),
					array(
						'col_index'    => '03',
						'col_title'    => 'UI/UX DESIGN',
						'col_tagline'  => 'Design systems, micro-interactions, and conversion-focused UI.',
						'col_features' => 'Design Systems • Wireframing • Motion Design • Usability Testing',
						'col_cta_text' => 'EXPLORE UI/UX',
						'col_svg_type' => 'uiux',
					),
					array(
						'col_index'    => '04',
						'col_title'    => 'BRAND IDENTITY',
						'col_tagline'  => 'Distinct modern visual systems, motion graphic kits, typography.',
						'col_features' => 'Brand Strategy • Motion Identity • 3D Assets • Typography',
						'col_cta_text' => 'EXPLORE BRANDING',
						'col_svg_type' => 'brand',
					),
					array(
						'col_index'    => '05',
						'col_title'    => 'PERFORMANCE OPTIMIZATION',
						'col_tagline'  => 'Lighthouse 100/100 audits, speed optimization, technical SEO.',
						'col_features' => 'Speed Optimization • Core Web Vitals • Server Tuning • Code Audits',
						'col_cta_text' => 'EXPLORE PERFORMANCE',
						'col_svg_type' => 'performance',
					),
				),
				'title_field' => '{{{ col_index }}} — {{{ col_title }}}',
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * CONTENT — BEHAVIOR
		 * ============================================================ */
		$this->start_controls_section(
			'section_behavior',
			array(
				'label' => __( 'Interaction & Autoplay', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'enable_autoplay',
			array(
				'label'        => __( 'Idle Autoplay (cycles columns when no one is interacting)', 'kinetic' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'kinetic' ),
				'label_off'    => __( 'No', 'kinetic' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'autoplay_interval',
			array(
				'label'     => __( 'Autoplay Interval (ms)', 'kinetic' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'default'   => 4500,
				'min'       => 2000,
				'max'       => 15000,
				'step'      => 500,
				'condition' => array( 'enable_autoplay' => 'yes' ),
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * STYLE
		 * ============================================================ */
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
				'label'     => __( 'Accent Color', 'kinetic' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ccff00',
				'selectors' => array(
					'{{WRAPPER}}' => '--hero-accent: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'overlay_strength',
			array(
				'label'     => __( 'Image Overlay Darkness', 'kinetic' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 1, 'step' => 0.05 ) ),
				'default'   => array( 'size' => 0.55, 'unit' => 'px' ),
				'selectors' => array(
					'{{WRAPPER}}' => '--hero-overlay: {{SIZE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings        = $this->get_settings_for_display();
		$enable_autoplay = ! empty( $settings['enable_autoplay'] ) && 'yes' === $settings['enable_autoplay'];
		$interval        = ! empty( $settings['autoplay_interval'] ) ? (int) $settings['autoplay_interval'] : 4500;
		?>
		<section
			class="k-hero-monolith <?php echo $enable_autoplay ? 'k-autoplay-on' : 'k-autoplay-off'; ?>"
			data-autoplay="<?php echo $enable_autoplay ? 'true' : 'false'; ?>"
			data-interval="<?php echo esc_attr( $interval ); ?>"
		>
			<div class="k-monolith-container">
				<?php foreach ( $settings['services_list'] as $index => $col ) :
					$col_title  = ! empty( $col['col_title'] ) ? trim( $col['col_title'] ) : '';
					$raw_cta    = ! empty( $col['col_cta_text'] ) ? trim( $col['col_cta_text'] ) : '';

					if ( empty( $raw_cta ) || ( 'EXPLORE WEB DEV' === $raw_cta && 'WEB DEV' !== $col_title ) ) {
						$cta_text = ! empty( $col_title ) ? 'EXPLORE ' . $col_title : __( 'EXPLORE SERVICE', 'kinetic' );
					} else {
						$cta_text = $raw_cta;
					}

					$cta_url    = ! empty( $col['col_cta_link']['url'] ) ? $col['col_cta_link']['url'] : '#contact';
					$bg_url     = ! empty( $col['col_bg_image']['url'] ) ? $col['col_bg_image']['url'] : '';
					$has_image  = '' !== $bg_url;
				?>
					<div
						class="k-mono-col <?php echo $index === 0 ? 'is-active' : ''; ?> <?php echo $has_image ? '' : 'k-mono-col--fallback'; ?>"
						data-col="<?php echo esc_attr( $index ); ?>"
						style="--col-index: <?php echo esc_attr( $index ); ?>;"
					>
						<!-- Autoplay progress indicator -->
						<div class="k-col-progress"></div>

						<!-- Background image / fallback gradient layer -->
						<div class="k-col-bg" <?php echo $has_image ? 'style="background-image:url(' . esc_url( $bg_url ) . ')"' : ''; ?>></div>

						<!-- Darkening overlay for legibility -->
						<div class="k-col-overlay"></div>

						<!-- Cursor-tracked spotlight glow -->
						<div class="k-col-spotlight"></div>

						<!-- Animated corner frame marks -->
						<span class="k-col-frame k-col-frame--tl"></span>
						<span class="k-col-frame k-col-frame--br"></span>

						<!-- Vertical line animation (column divider, GSAP timed) -->
						<div class="k-col-border"></div>

						<!-- Collapsed State -->
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

								<?php if ( ! $has_image ) : ?>
									<!-- Fallback vector illustration only shown when no bg image is set -->
									<div class="k-exp-illustration">
										<?php $this->render_vector_illustration( $col['col_svg_type'] ); ?>
									</div>
								<?php endif; ?>
							</div>

							<div class="k-exp-footer">
								<a href="<?php echo esc_url( $cta_url ); ?>" class="k-exp-btn k-magnetic">
									<span class="k-magnetic-inner">
										<span><?php echo esc_html( $cta_text ); ?></span>
										<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
									</span>
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
					<rect class="k-anim-path" x="65" y="12" width="70" height="136" rx="14" stroke="var(--hero-accent)" stroke-width="2" fill="#0c0d12"/>
					<line x1="88" y1="22" x2="112" y2="22" stroke="var(--hero-accent)" stroke-width="2" stroke-linecap="round"/>
					<circle cx="100" cy="136" r="3.5" stroke="var(--hero-accent)" stroke-width="1.5"/>
					<rect class="k-pulse-box k-anim-path" x="74" y="34" width="52" height="34" rx="4" fill="rgba(204,255,0,0.12)" stroke="var(--hero-accent)" stroke-dasharray="3 3"/>
					<line class="k-laser-flow" x1="75" y1="80" x2="115" y2="80" stroke="var(--hero-accent)" stroke-width="2.5" stroke-linecap="round"/>
					<line class="k-laser-flow" x1="75" y1="92" x2="105" y2="92" stroke="#666" stroke-width="2" stroke-linecap="round"/>
					<line class="k-laser-flow" x1="75" y1="102" x2="118" y2="102" stroke="#444" stroke-width="2" stroke-linecap="round"/>
					<circle class="k-wave-pulse" cx="118" cy="46" r="3" fill="var(--hero-accent)"/>
				</svg>
				<?php
				break;
			case 'uiux':
				?>
				<svg class="k-svg-art" viewBox="0 0 200 160" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect class="k-anim-path" x="20" y="20" width="160" height="120" rx="6" stroke="#252632" stroke-width="2" fill="#0c0d12"/>
					<path class="k-anim-path" d="M20 45H180" stroke="#252632" stroke-width="2"/>
					<circle cx="35" cy="32" r="3" fill="var(--hero-accent)"/>
					<circle cx="47" cy="32" r="3" fill="#555"/>
					<circle cx="59" cy="32" r="3" fill="#555"/>
					<rect class="k-pulse-box k-anim-path" x="35" y="60" width="50" height="60" rx="3" fill="rgba(204,255,0,0.12)" stroke="var(--hero-accent)"/>
					<circle class="k-spin-ring" cx="130" cy="90" r="25" stroke="var(--hero-accent)" stroke-width="2" stroke-dasharray="4 4"/>
					<circle class="k-wave-pulse" cx="130" cy="90" r="4" fill="var(--hero-accent)"/>
				</svg>
				<?php
				break;
			case 'brand':
				?>
				<svg class="k-svg-art" viewBox="0 0 200 160" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle class="k-spin-ring" cx="100" cy="80" r="54" stroke="#1f202b" stroke-width="1.5" stroke-dasharray="4 6"/>
					<circle class="k-anim-path" cx="100" cy="80" r="38" stroke="rgba(204,255,0,0.2)" stroke-width="1.5" stroke-dasharray="6 4"/>
					<polygon class="k-anim-path" points="100,32 142,56 142,104 100,128 58,104 58,56" stroke="var(--hero-accent)" stroke-width="2.2" stroke-linejoin="round" fill="rgba(204,255,0,0.04)"/>
					<path class="k-anim-path" d="M100 32 L100 80 L142 104" stroke="var(--hero-accent)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					<path class="k-anim-path" d="M100 80 L58 104" stroke="var(--hero-accent)" stroke-width="2" stroke-linecap="round"/>
					<path class="k-laser-flow" d="M45 125 C 65 60, 135 60, 155 125" stroke="var(--hero-accent)" stroke-width="2.2" stroke-linecap="round" fill="none"/>
					<line class="k-anim-path" x1="55" y1="65" x2="100" y2="52" stroke="#666" stroke-width="1" stroke-dasharray="3 3"/>
					<line class="k-anim-path" x1="100" y1="52" x2="145" y2="65" stroke="#666" stroke-width="1" stroke-dasharray="3 3"/>
					<rect class="k-wave-pulse" x="97" y="49" width="6" height="6" transform="rotate(45 100 52)" fill="var(--hero-accent)" stroke="#000" stroke-width="1"/>
					<circle cx="55" cy="65" r="2.5" fill="#fff"/>
					<circle cx="145" cy="65" r="2.5" fill="#fff"/>
					<line x1="100" y1="20" x2="100" y2="28" stroke="var(--hero-accent)" stroke-width="1.5"/>
					<line x1="100" y1="132" x2="100" y2="140" stroke="var(--hero-accent)" stroke-width="1.5"/>
					<line x1="42" y1="80" x2="50" y2="80" stroke="var(--hero-accent)" stroke-width="1.5"/>
					<line x1="150" y1="80" x2="158" y2="80" stroke="var(--hero-accent)" stroke-width="1.5"/>
				</svg>
				<?php
				break;
			case 'performance':
				?>
				<svg class="k-svg-art" viewBox="0 0 200 160" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path class="k-spin-ring" d="M40 120 A 65 65 0 1 1 160 120" stroke="#1f202b" stroke-width="4" stroke-linecap="round" fill="none" stroke-dasharray="6 6"/>
					<path class="k-anim-path" d="M40 120 A 65 65 0 1 1 145 65" stroke="var(--hero-accent)" stroke-width="4.5" stroke-linecap="round" fill="none"/>
					<path class="k-laser-flow" d="M35 125 Q 85 115, 115 75 T 165 32" stroke="var(--hero-accent)" stroke-width="3" fill="none" stroke-linecap="round"/>
					<polyline class="k-anim-path" points="145,32 165,32 165,52" stroke="var(--hero-accent)" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
					<circle cx="100" cy="115" r="8" fill="#111" stroke="var(--hero-accent)" stroke-width="2"/>
					<line class="k-anim-path" x1="100" y1="115" x2="140" y2="58" stroke="var(--hero-accent)" stroke-width="2.5" stroke-linecap="round"/>
					<circle class="k-wave-pulse" cx="165" cy="32" r="5" fill="var(--hero-accent)"/>
				</svg>
				<?php
				break;
			default: // 'web'
				?>
				<svg class="k-svg-art" viewBox="0 0 200 160" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect class="k-anim-path" x="15" y="15" width="170" height="130" rx="8" stroke="var(--hero-accent)" stroke-width="2" fill="#0c0d12"/>
					<line class="k-anim-path" x1="15" y1="42" x2="185" y2="42" stroke="#1c1d28" stroke-width="2"/>
					<circle cx="32" cy="28" r="3.5" fill="#ff5f56"/>
					<circle cx="44" cy="28" r="3.5" fill="#ffbd2e"/>
					<circle cx="56" cy="28" r="3.5" fill="#27c93f"/>
					<text x="100" y="32" text-anchor="middle" fill="#666" font-family="monospace" font-size="8" letter-spacing="1">APP.TSX</text>
					
					<path class="k-anim-path" d="M36 65 L26 77 L36 89" stroke="var(--hero-accent)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
					<path class="k-anim-path" d="M52 65 L62 77 L52 89" stroke="var(--hero-accent)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
					<line class="k-anim-path" x1="47" y1="63" x2="41" y2="91" stroke="#555" stroke-width="2" stroke-linecap="round"/>

					<line class="k-laser-flow" x1="72" y1="72" x2="145" y2="72" stroke="var(--hero-accent)" stroke-width="3" stroke-linecap="round" stroke-dasharray="25 8"/>
					<line class="k-laser-flow" x1="72" y1="84" x2="125" y2="84" stroke="#888899" stroke-width="2.5" stroke-linecap="round" stroke-dasharray="15 6"/>
					
					<rect class="k-cursor-blink" x="130" y="80" width="6" height="8" fill="var(--hero-accent)"/>

					<path class="k-laser-flow" d="M30 118 L55 118 L70 106 L85 125 L105 110 L125 122 L145 108 L170 118" stroke="var(--hero-accent)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
					<circle class="k-wave-pulse" cx="105" cy="110" r="3" fill="var(--hero-accent)"/>
				</svg>
				<?php
				break;
		}
	}
}

\Elementor\Plugin::instance()->widgets_manager->register( new Kinetic_Hero_Monolith_Widget() );