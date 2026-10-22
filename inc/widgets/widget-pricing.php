<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Kinetic_Pricing_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'kinetic_pricing';
	}

	public function get_title() {
		return __( 'Kinetic Neo Pricing Monolith', 'kinetic' );
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
				'default' => '// ENGAGEMENT ARCHITECTURE',
			)
		);

		$this->add_control(
			'section_title',
			array(
				'label'   => __( 'Main Title', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'TRANSPARENT <span>INVESTMENT</span>',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_plans',
			array(
				'label' => __( 'Pricing Tiers', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'plan_index',
			array(
				'label'   => __( 'Index Number', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '01',
			)
		);

		$repeater->add_control(
			'plan_name',
			array(
				'label'   => __( 'Plan Title', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'MVP SPRINT',
			)
		);

		$repeater->add_control(
			'plan_tagline',
			array(
				'label'   => __( 'Tagline', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'Rapid deployment landing page engineered for high conversion.',
			)
		);

		$repeater->add_control(
			'price_once',
			array(
				'label'   => __( 'One-Time Price ($)', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '$2,490',
			)
		);

		$repeater->add_control(
			'price_retainer',
			array(
				'label'   => __( 'Monthly Retainer Price ($)', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '$1,850/mo',
			)
		);

		$repeater->add_control(
			'is_featured',
			array(
				'label'        => __( 'Featured Tier Highlight', 'kinetic' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$repeater->add_control(
			'plan_features',
			array(
				'label'       => __( 'Features (Separated by Bullet •)', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => 'Custom WordPress Boilerplate • 100/100 Core Web Vitals • Elementor Custom Widgets • 2-Week Sprint Delivery • 30 Days Tech Support',
			)
		);

		$repeater->add_control(
			'btn_text',
			array(
				'label'   => __( 'CTA Button Text', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'INITIATE SPRINT',
			)
		);

		$this->add_control(
			'plans_list',
			array(
				'label'       => __( 'Pricing Cards', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'plan_index'     => '01',
						'plan_name'      => 'MVP SPRINT',
						'plan_tagline'   => 'Single-page landing experience built for fast launch and maximal conversion.',
						'price_once'     => '$2,490',
						'price_retainer' => '$1,850/mo',
						'is_featured'    => 'no',
						'plan_features'  => 'Custom WP Theme Engine • Custom Elementor Widgets • GSAP Micro-Animations • Mobile Latency Optimization',
						'btn_text'       => 'START MVP',
					),
					array(
						'plan_index'     => '02',
						'plan_name'      => 'FULL ENGINE',
						'plan_tagline'   => 'Complete custom multi-service platform with headless/custom WP setup & 3D graphics.',
						'price_once'     => '$4,950',
						'price_retainer' => '$3,400/mo',
						'is_featured'    => 'yes',
						'plan_features'  => 'Bespoke Custom Theme • Advanced Motion & Interactions • Tailored Admin Control Panel • Technical SEO Architecture • 60 Days Support',
						'btn_text'       => 'CLAIM FULL ENGINE',
					),
					array(
						'plan_index'     => '03',
						'plan_name'      => 'WAR ROOM',
						'plan_tagline'   => 'Dedicated senior engineering team for ongoing iterative growth and web app updates.',
						'price_once'     => '$8,200',
						'price_retainer' => '$5,900/mo',
						'is_featured'    => 'no',
						'plan_features'  => 'Priority Development Queue • Unlimited Micro-Revisions • Performance Monitoring • Direct Slack War Room Channel',
						'btn_text'       => 'BOOK WAR ROOM',
					),
				),
				'title_field' => '{{{ plan_index }}} — {{{ plan_name }}}',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="k-pricing-section" id="pricing">
			<div class="k-pricing-header">
				<div>
					<span class="k-mono-label"><?php echo esc_html( $settings['section_badge'] ); ?></span>
					<h2 class="k-pricing-h2"><?php echo wp_kses_post( $settings['section_title'] ); ?></h2>
				</div>

				<!-- Billing Frequency Switcher -->
				<div class="k-billing-toggle-wrap">
					<span class="k-toggle-label active" id="kLabelOnce">ONE-TIME SPRINT</span>
					<button class="k-toggle-switch" id="kBillingToggle" aria-label="Toggle Billing Mode">
						<span class="k-toggle-knob"></span>
					</button>
					<span class="k-toggle-label" id="kLabelRetainer">MONTHLY RETAINER</span>
				</div>
			</div>

			<!-- Asymmetrical Pricing Cards Grid -->
			<div class="k-pricing-grid">
				<?php foreach ( $settings['plans_list'] as $idx => $plan ) : 
					$is_feat = 'yes' === $plan['is_featured'] ? 'is-featured' : '';
				?>
					<div class="k-pricing-card <?php echo esc_attr( $is_feat ); ?>" data-card="<?php echo esc_attr( $idx ); ?>">
						
						<!-- Laser Scanline Border Effect -->
						<div class="k-card-scanline"></div>

						<?php if ( 'yes' === $plan['is_featured'] ) : ?>
							<div class="k-featured-badge">MOST POPULAR</div>
						<?php endif; ?>

						<div class="k-card-top">
							<span class="k-plan-idx">// <?php echo esc_html( $plan['plan_index'] ); ?></span>
							<h3 class="k-plan-title"><?php echo esc_html( $plan['plan_name'] ); ?></h3>
							<p class="k-plan-tagline"><?php echo esc_html( $plan['plan_tagline'] ); ?></p>
						</div>

						<div class="k-card-price-box">
							<div class="k-price-display-wrapper">
								<span class="k-price-val k-val-once" data-price-once="<?php echo esc_attr( $plan['price_once'] ); ?>"><?php echo esc_html( $plan['price_once'] ); ?></span>
								<span class="k-price-val k-val-retainer" data-price-retainer="<?php echo esc_attr( $plan['price_retainer'] ); ?>" style="display: none;"><?php echo esc_html( $plan['price_retainer'] ); ?></span>
							</div>
							<span class="k-price-sub" id="kPriceSubLabel">// FIXED DELIVERABLE</span>
						</div>

						<div class="k-card-features-list">
							<?php 
							$features = explode( '•', $plan['plan_features'] );
							foreach ( $features as $feat ) :
								if ( trim( $feat ) !== '' ) : ?>
									<div class="k-feat-row">
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
										<span><?php echo esc_html( trim( $feat ) ); ?></span>
									</div>
								<?php endif;
							endforeach; 
							?>
						</div>

						<div class="k-card-footer">
							<a href="#contact" class="k-pricing-btn">
								<span><?php echo esc_html( $plan['btn_text'] ); ?></span>
								<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
							</a>
						</div>

					</div>
				<?php endforeach; ?>
			</div>
		</section>
		<?php
	}
}

\Elementor\Plugin::instance()->widgets_manager->register( new Kinetic_Pricing_Widget() );