<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Kinetic_Pricing_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'kinetic_pricing';
	}

	public function get_title() {
		return __( 'Kinetic Add-on Pricing Matrix', 'kinetic' );
	}

	public function get_icon() {
		return 'eicon-price-table';
	}

	public function get_categories() {
		return array( 'kinetic-widgets' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Section Header', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'section_badge',
			array(
				'label'   => __( 'Mono Badge', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '// ARCHITECTURE & ENGAGEMENT',
			)
		);

		$this->add_control(
			'section_title',
			array(
				'label'   => __( 'Main Title', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'FLEXIBLE <span>MODULE ARCHITECTURE</span>',
			)
		);

		$this->add_control(
			'section_desc',
			array(
				'label'   => __( 'Description', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Start with our core zero-bloat custom theme engine and add specialized technical modules tailored to your product growth.',
			)
		);

		$this->add_control(
			'currency_symbol',
			array(
				'label'   => __( 'Currency Symbol', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '$',
			)
		);

		$this->add_control(
			'base_price',
			array(
				'label'   => __( 'Base Engine Price', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 950,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_addons',
			array(
				'label' => __( 'Agency Technical Modules', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'addon_name',
			array(
				'label'   => __( 'Module Title', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'Advanced Three.js Shader Engine',
			)
		);

		$repeater->add_control(
			'addon_desc',
			array(
				'label'   => __( 'Description', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'Interactive 3D WebGL particle canvases, cursor attraction & GPU displacement shaders.',
			)
		);

		$repeater->add_control(
			'addon_price',
			array(
				'label'   => __( 'Price ($)', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 450,
			)
		);

		$repeater->add_control(
			'addon_icon_type',
			array(
				'label'   => __( 'Module Icon', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'code',
				'options' => array(
					'code'     => __( 'Code / Shaders', 'kinetic' ),
					'api'      => __( 'API / Headless', 'kinetic' ),
					'speed'    => __( 'Speed / SEO', 'kinetic' ),
					'support'  => __( 'War Room / Slack', 'kinetic' ),
				),
			)
		);

		$repeater->add_control(
			'is_active_default',
			array(
				'label'        => __( 'Enabled by Default', 'kinetic' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$this->add_control(
			'addons_list',
			array(
				'label'       => __( 'Technical Modules List', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'addon_name'        => 'Advanced Three.js Shader Engine',
						'addon_desc'        => 'Interactive 3D WebGL particle canvases, cursor attraction & GPU displacement shaders.',
						'addon_price'       => 450,
						'addon_icon_type'   => 'code',
						'is_active_default' => 'yes',
					),
					array(
						'addon_name'        => 'Headless / Custom WP REST API',
						'addon_desc'        => 'Bespoke REST endpoints, decoupled Next.js/React frontend & instant JSON payloads.',
						'addon_price'       => 650,
						'addon_icon_type'   => 'api',
						'is_active_default' => 'no',
					),
					array(
						'addon_name'        => '100/100 Core Web Vitals & Technical SEO',
						'addon_desc'        => 'Sub-second load times, structured Schema JSON-LD & optimized asset pipelines.',
						'addon_price'       => 350,
						'addon_icon_type'   => 'speed',
						'is_active_default' => 'no',
					),
					array(
						'addon_name'        => 'Direct Senior Dev Slack War Room',
						'addon_desc'        => '24/7 dedicated Slack channel, priority sprint queue & live hotfixes.',
						'addon_price'       => 850,
						'addon_icon_type'   => 'support',
						'is_active_default' => 'no',
					),
				),
				'title_field' => '{{{ addon_name }}} (${{{ addon_price }}})',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$base_price = intval( $settings['base_price'] );
		$curr = esc_html( $settings['currency_symbol'] );
		?>
		<section class="k-addon-pricing-section" id="pricing">
			<div class="k-addon-container">
				
				<!-- Section Header -->
				<div class="k-addon-header">
					<span class="k-mono-label"><?php echo esc_html( $settings['section_badge'] ); ?></span>
					<h2 class="k-addon-h2"><?php echo wp_kses_post( $settings['section_title'] ); ?></h2>
					<p class="k-addon-desc"><?php echo esc_html( $settings['section_desc'] ); ?></p>
				</div>

				<!-- Split Layout Grid (Equal Height) -->
				<div class="k-addon-grid" data-base-price="<?php echo esc_attr( $base_price ); ?>" data-currency="<?php echo esc_attr( $curr ); ?>">
					
					<!-- LHS: Add-on Modules Toggles -->
					<div class="k-addon-lhs">
						<div class="k-lhs-title-wrap">
							<h3>Add-on Technical Modules</h3>
							<p>Toggle capabilities needed for your sprint. Price calculates instantly.</p>
						</div>

						<div class="k-modules-list">
							<?php foreach ( $settings['addons_list'] as $idx => $addon ) : 
								$is_checked = 'yes' === $addon['is_active_default'];
								$checked_attr = $is_checked ? 'checked' : '';
								$active_class = $is_checked ? 'is-selected' : '';
							?>
								<div class="k-module-card <?php echo esc_attr( $active_class ); ?>" data-price="<?php echo esc_attr( $addon['addon_price'] ); ?>">
									
									<div class="k-module-icon-box">
										<?php $this->render_module_icon( $addon['addon_icon_type'] ); ?>
									</div>

									<div class="k-module-info">
										<span class="k-mod-name"><?php echo esc_html( $addon['addon_name'] ); ?></span>
										<span class="k-mod-desc"><?php echo esc_html( $addon['addon_desc'] ); ?></span>
									</div>

									<div class="k-module-right">
										<span class="k-mod-price">+<?php echo $curr . esc_html( $addon['addon_price'] ); ?></span>
										<label class="k-ios-toggle">
											<input type="checkbox" class="k-addon-checkbox" <?php echo $checked_attr; ?>>
											<span class="k-slider"></span>
										</label>
									</div>

								</div>
							<?php endforeach; ?>
						</div>
					</div>

					<!-- RHS: Your Plan Summary Card -->
					<div class="k-addon-rhs">
						<div class="k-summary-monolith">
							
							<div class="k-summary-top">
								<h3>YOUR SPRINT CONFIGURATION</h3>
								<p class="k-addon-count-txt"><span id="kAddonCount">1</span> Modules Active</p>
							</div>

							<div class="k-summary-price-box">
								<span class="k-curr"><?php echo $curr; ?></span>
								<span class="k-total-price" id="kTotalPrice">1400</span>
							</div>

							<div class="k-price-breakdown">
								Core Engine: <?php echo $curr; ?><span id="kBasePriceDisplay"><?php echo esc_html( $base_price ); ?></span> + Modules: <?php echo $curr; ?><span id="kAddonTotalDisplay">450</span>
							</div>

							<div class="k-summary-cta-wrap">
								<a href="#contact" class="k-summary-btn">
									<span>INITIATE SPRINT</span>
									<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
								</a>
							</div>

							<div class="k-always-included">
								<span class="k-inc-title">// ALWAYS INCLUDED IN CORE ENGINE</span>
								<ul class="k-inc-list">
									<li>
										<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
										<span>Custom WP Boilerplate (Zero Bloat)</span>
									</li>
									<li>
										<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
										<span>Custom Elementor Control Widgets</span>
									</li>
									<li>
										<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
										<span>Full Source Code IP Ownership</span>
									</li>
									<li>
										<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
										<span>60 Days Engineering Guarantee</span>
									</li>
								</ul>
							</div>

						</div>
					</div>

				</div>

			</div>
		</section>
		<?php
	}

	private function render_module_icon( $type ) {
		switch ( $type ) {
			case 'api':
				?>
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
				<?php
				break;
			case 'speed':
				?>
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
				<?php
				break;
			case 'support':
				?>
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
				<?php
				break;
			default: // 'code'
				?>
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
				<?php
				break;
		}
	}
}

\Elementor\Plugin::instance()->widgets_manager->register( new Kinetic_Pricing_Widget() );