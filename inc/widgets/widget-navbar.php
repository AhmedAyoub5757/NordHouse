<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Kinetic_Navbar_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'kinetic_navbar';
	}

	public function get_title() {
		return __( 'Kinetic Fullscreen Curtain Nav', 'kinetic' );
	}

	public function get_icon() {
		return 'eicon-nav-menu';
	}

	public function get_categories() {
		return array( 'kinetic-widgets' );
	}

	protected function register_controls() {

		// BRANDING CONTROLS
		$this->start_controls_section(
			'section_branding',
			array(
				'label' => __( 'Branding', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'brand_logo',
			array(
				'label'       => __( 'Brand Logo Text', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'KINETIC',
			)
		);

		$this->end_controls_section();

		// MENU ITEMS REPEATER
		$this->start_controls_section(
			'section_menu',
			array(
				'label' => __( 'Navigation Links', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'link_title',
			array(
				'label'       => __( 'Link Title', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'SERVICES',
			)
		);

		$repeater->add_control(
			'link_subtitle',
			array(
				'label'       => __( 'Hover Tagline/Description', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'Web Engineering • Mobile Architecture • UI/UX',
			)
		);

		$repeater->add_control(
			'link_url',
			array(
				'label'       => __( 'Link URL', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'default'     => array( 'url' => '#services' ),
			)
		);

		$repeater->add_control(
			'link_number',
			array(
				'label'       => __( 'Index (e.g. 01)', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '01',
			)
		);

		$this->add_control(
			'nav_links',
			array(
				'label'       => __( 'Menu Items', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array( 'link_title' => 'SERVICES', 'link_subtitle' => 'Web Dev, Mobile Apps, Design Systems', 'link_number' => '01', 'link_url' => array( 'url' => '#services' ) ),
					array( 'link_title' => 'SELECTED WORK', 'link_subtitle' => 'Case Studies, Interactive Products', 'link_number' => '02', 'link_url' => array( 'url' => '#work' ) ),
					array( 'link_title' => 'METHODOLOGY', 'link_subtitle' => 'Sprint Workflow, Architecture, QA', 'link_number' => '03', 'link_url' => array( 'url' => '#process' ) ),
					array( 'link_title' => 'INITIATE CONTACT', 'link_subtitle' => 'Start a New Project or Audit', 'link_number' => '04', 'link_url' => array( 'url' => '#contact' ) ),
				),
				'title_field' => '{{{ link_number }}} — {{{ link_title }}}',
			)
		);

		$this->end_controls_section();

		// CONTACT / EXTRA DETAILS
		$this->start_controls_section(
			'section_footer_info',
			array(
				'label' => __( 'Curtain Footer Info', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'email_address',
			array(
				'label'   => __( 'Email Address', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'hello@kinetic-studio.io',
			)
		);

		$this->add_control(
			'location_text',
			array(
				'label'   => __( 'Location Text', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'NEW YORK [40.7128° N] — TOKYO [35.6762° E]',
			)
		);

		$this->end_controls_section();

		// STYLE CONTROLS
		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Theme Colors', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'curtain_bg',
			array(
				'label'     => __( 'Curtain Background', 'kinetic' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#070709',
				'selectors' => array(
					'{{WRAPPER}} .k-curtain-nav' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'accent_color',
			array(
				'label'     => __( 'Accent Neon', 'kinetic' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ccff00',
				'selectors' => array(
					'{{WRAPPER}}' => '--k-accent: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<!-- FLOATING DOCK BAR -->
		<div class="k-floating-dock">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="k-dock-brand">
				<span><?php echo esc_html( $settings['brand_logo'] ); ?></span>
				<span class="k-dot">.</span>
			</a>

			<button class="k-trigger-btn" aria-label="Toggle Menu" id="kNavTrigger">
				<span class="k-btn-label">MENU</span>
				<div class="k-burger-icon">
					<!-- SVG Hamburger / Close Morph -->
					<svg class="k-svg-menu" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path class="k-svg-line k-svg-top" d="M3 8H21" stroke="currentColor" stroke-width="2" stroke-linecap="square"/>
						<path class="k-svg-line k-svg-bot" d="M3 16H21" stroke="currentColor" stroke-width="2" stroke-linecap="square"/>
					</svg>
				</div>
			</button>
		</div>

		<!-- FULLSCREEN OVERLAY CURTAIN -->
		<div class="k-curtain-nav" id="kCurtainNav">
			<div class="k-curtain-grid-overlay"></div>
			
			<div class="k-curtain-content">
				<div class="k-curtain-header">
					<span class="k-mono-label">// NAVIGATION INDEX</span>
					<span class="k-mono-label k-hover-display" id="kNavHoverTagline">SELECT A DESTINATION</span>
				</div>

				<div class="k-curtain-menu">
					<?php foreach ( $settings['nav_links'] as $index => $item ) : 
						$target = $item['link_url']['is_external'] ? ' target="_blank"' : '';
						$nofollow = $item['link_url']['nofollow'] ? ' rel="nofollow"' : '';
					?>
						<a href="<?php echo esc_url( $item['link_url']['url'] ); ?>" 
						   class="k-curtain-item" 
						   data-tagline="<?php echo esc_attr( $item['link_subtitle'] ); ?>"
						   <?php echo $target . $nofollow; ?>>
							<span class="k-item-num"><?php echo esc_html( $item['link_number'] ); ?></span>
							<span class="k-item-text" data-text="<?php echo esc_attr( $item['link_title'] ); ?>">
								<?php echo esc_html( $item['link_title'] ); ?>
							</span>
							<span class="k-item-arrow-wrap">
								<!-- SVG Up-Right Diagonal Arrow Icon -->
								<svg class="k-svg-arrow" width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M7 17L17 7M17 7H7M17 7V17" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="round"/>
								</svg>
							</span>
						</a>
					<?php endforeach; ?>
				</div>

				<div class="k-curtain-footer">
					<div class="k-footer-col">
						<span class="k-f-title">
							<!-- SVG Mail Icon -->
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
							DIRECT LINE
						</span>
						<a href="mailto:<?php echo esc_attr( $settings['email_address'] ); ?>" class="k-f-link">
							<?php echo esc_html( $settings['email_address'] ); ?>
						</a>
					</div>
					<div class="k-footer-col">
						<span class="k-f-title">
							<!-- SVG Globe/Location Icon -->
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
							OPERATIONAL AXIS
						</span>
						<span class="k-f-info"><?php echo esc_html( $settings['location_text'] ); ?></span>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

\Elementor\Plugin::instance()->widgets_manager->register( new Kinetic_Navbar_Widget() );