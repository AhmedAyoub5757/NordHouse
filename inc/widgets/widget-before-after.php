<?php
/**
 * Kinetic Before/After Widget
 *
 * Interactive "Before vs After" transformation comparison section
 * for the Kinetic / WP Monolith dark neo-brutalist theme.
 *
 * @package Kinetic
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Utils;

/**
 * Class Kinetic_Before_After_Widget
 *
 * Renders a draggable / hover-controlled split-screen comparison
 * between a "Before" (legacy) state and an "After" (engineered) state.
 */
class Kinetic_Before_After_Widget extends Widget_Base {

	/**
	 * Widget name (internal slug).
	 */
	public function get_name() {
		return 'kinetic_before_after';
	}

	/**
	 * Widget display title.
	 */
	public function get_title() {
		return esc_html__( 'Before / After Transformation', 'kinetic' );
	}

	/**
	 * Widget icon (Elementor icon library).
	 */
	public function get_icon() {
		return 'eicon-image-before-after';
	}

	/**
	 * Widget category.
	 */
	public function get_categories() {
		return array( 'kinetic-widgets' );
	}

	/**
	 * Keywords for Elementor search.
	 */
	public function get_keywords() {
		return array( 'before', 'after', 'comparison', 'slider', 'transformation', 'split screen' );
	}

	/**
	 * Script dependencies.
	 */
	public function get_script_depends() {
		return array( 'gsap', 'kinetic-before-after' );
	}

	/**
	 * Style dependencies.
	 */
	public function get_style_depends() {
		return array( 'kinetic-before-after' );
	}

	/**
	 * Register Elementor controls.
	 */
	protected function register_controls() {

		/* =====================================================
		 * SECTION: Header Content
		 * ===================================================== */
		$this->start_controls_section(
			'section_header',
			array(
				'label' => esc_html__( 'Section Header', 'kinetic' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'mono_badge',
			array(
				'label'       => esc_html__( 'Mono Badge Text', 'kinetic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '// TRANSFORMATION ENGINE', 'kinetic' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'main_title',
			array(
				'label'       => esc_html__( 'Main Section Title', 'kinetic' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'LEGACY vs <span>ENGINEERED</span>',
				'label_block' => true,
				'description' => esc_html__( 'Basic HTML (e.g. <span>) is allowed for accent styling.', 'kinetic' ),
			)
		);

		$this->add_control(
			'section_description',
			array(
				'label'       => esc_html__( 'Section Description', 'kinetic' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 4,
				'default'     => esc_html__( 'Drag the slider to see what happens when a bloated, generic site gets rebuilt on a custom-engineered WP Monolith stack.', 'kinetic' ),
				'label_block' => true,
			)
		);

		$this->end_controls_section();

		/* =====================================================
		 * SECTION: Before State
		 * ===================================================== */
		$this->start_controls_section(
			'section_before',
			array(
				'label' => esc_html__( 'Before (Legacy) State', 'kinetic' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'before_title',
			array(
				'label'       => esc_html__( 'Before Title', 'kinetic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Legacy Site', 'kinetic' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'before_tagline',
			array(
				'label'       => esc_html__( 'Before Tagline', 'kinetic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Slow. Bloated. Forgettable.', 'kinetic' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'before_image',
			array(
				'label'   => esc_html__( 'Before Image', 'kinetic' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$before_repeater = new Repeater();

		$before_repeater->add_control(
			'metric_label',
			array(
				'label'       => esc_html__( 'Metric Label', 'kinetic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Load Time', 'kinetic' ),
				'label_block' => true,
			)
		);

		$before_repeater->add_control(
			'metric_value',
			array(
				'label'       => esc_html__( 'Metric Value', 'kinetic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '6.8s', 'kinetic' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'before_metrics',
			array(
				'label'       => esc_html__( 'Before Metrics', 'kinetic' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $before_repeater->get_controls(),
				'default'     => array(
					array(
						'metric_label' => esc_html__( 'Load Time', 'kinetic' ),
						'metric_value' => esc_html__( '6.8s', 'kinetic' ),
					),
					array(
						'metric_label' => esc_html__( 'Lighthouse Score', 'kinetic' ),
						'metric_value' => esc_html__( '34 / 100', 'kinetic' ),
					),
					array(
						'metric_label' => esc_html__( 'Conversion Rate', 'kinetic' ),
						'metric_value' => esc_html__( '0.8%', 'kinetic' ),
					),
				),
				'title_field' => '{{{ metric_label }}}: {{{ metric_value }}}',
			)
		);

		$this->end_controls_section();

		/* =====================================================
		 * SECTION: After State
		 * ===================================================== */
		$this->start_controls_section(
			'section_after',
			array(
				'label' => esc_html__( 'After (Engineered) State', 'kinetic' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'after_title',
			array(
				'label'       => esc_html__( 'After Title', 'kinetic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'WP Monolith', 'kinetic' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'after_tagline',
			array(
				'label'       => esc_html__( 'After Tagline', 'kinetic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Fast. Zero-Bloat. Built to Convert.', 'kinetic' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'after_image',
			array(
				'label'   => esc_html__( 'After Image', 'kinetic' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$after_repeater = new Repeater();

		$after_repeater->add_control(
			'metric_label',
			array(
				'label'       => esc_html__( 'Metric Label', 'kinetic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Load Time', 'kinetic' ),
				'label_block' => true,
			)
		);

		$after_repeater->add_control(
			'metric_value',
			array(
				'label'       => esc_html__( 'Metric Value', 'kinetic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '0.4s', 'kinetic' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'after_metrics',
			array(
				'label'       => esc_html__( 'After Metrics', 'kinetic' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $after_repeater->get_controls(),
				'default'     => array(
					array(
						'metric_label' => esc_html__( 'Load Time', 'kinetic' ),
						'metric_value' => esc_html__( '0.4s', 'kinetic' ),
					),
					array(
						'metric_label' => esc_html__( 'Lighthouse Score', 'kinetic' ),
						'metric_value' => esc_html__( '100 / 100', 'kinetic' ),
					),
					array(
						'metric_label' => esc_html__( 'Conversion Rate', 'kinetic' ),
						'metric_value' => esc_html__( '4.6%', 'kinetic' ),
					),
				),
				'title_field' => '{{{ metric_label }}}: {{{ metric_value }}}',
			)
		);

		$this->end_controls_section();

		/* =====================================================
		 * SECTION: CTA
		 * ===================================================== */
		$this->start_controls_section(
			'section_cta',
			array(
				'label' => esc_html__( 'Call To Action', 'kinetic' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'cta_text',
			array(
				'label'       => esc_html__( 'Button Text', 'kinetic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Start My Engineering Audit', 'kinetic' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'cta_link',
			array(
				'label'         => esc_html__( 'Button Link', 'kinetic' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'kinetic' ),
				'default'       => array(
					'url'         => '#contact',
					'is_external' => false,
					'nofollow'    => false,
				),
				'show_external' => true,
			)
		);

		$this->end_controls_section();

		/* =====================================================
		 * SECTION: Style — Colors (optional overrides)
		 * ===================================================== */
		$this->start_controls_section(
			'section_style_colors',
			array(
				'label' => esc_html__( 'Colors', 'kinetic' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'accent_color',
			array(
				'label'     => esc_html__( 'Neon Accent Color', 'kinetic' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ccff00',
				'selectors' => array(
					'{{WRAPPER}}.kinetic-ba' => '--kba-accent: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'alert_color',
			array(
				'label'     => esc_html__( 'Alert / Legacy Red', 'kinetic' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff4d4d',
				'selectors' => array(
					'{{WRAPPER}}.kinetic-ba' => '--kba-alert: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Helper: render a metrics list.
	 *
	 * @param array  $metrics Repeater items.
	 * @param string $state   'before' or 'after'.
	 */
	private function render_metrics( $metrics, $state ) {
		if ( empty( $metrics ) || ! is_array( $metrics ) ) {
			return;
		}
		?>
		<ul class="kba-metrics kba-metrics--<?php echo esc_attr( $state ); ?>">
			<?php foreach ( $metrics as $metric ) : ?>
				<li class="kba-metric">
					<span class="kba-metric__label"><?php echo esc_html( $metric['metric_label'] ); ?></span>
					<span class="kba-metric__value"><?php echo esc_html( $metric['metric_value'] ); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php
	}

	/**
	 * Render widget output on the frontend.
	 */
	protected function render() {
		$settings  = $this->get_settings_for_display();
		$widget_id = 'kba-' . $this->get_id();

		$before_img = ! empty( $settings['before_image']['url'] ) ? $settings['before_image']['url'] : '';
		$after_img  = ! empty( $settings['after_image']['url'] ) ? $settings['after_image']['url'] : '';

		$this->add_render_attribute( 'wrapper', 'class', 'kinetic-ba' );
		$this->add_render_attribute( 'wrapper', 'id', $widget_id );
		$this->add_render_attribute( 'wrapper', 'data-widget-id', $widget_id );

		if ( ! empty( $settings['cta_link']['url'] ) ) {
			$this->add_link_attributes( 'cta_link', $settings['cta_link'] );
		}
		?>
		<section <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>

			<header class="kba-header">
				<?php if ( ! empty( $settings['mono_badge'] ) ) : ?>
					<span class="kba-badge"><?php echo esc_html( $settings['mono_badge'] ); ?></span>
				<?php endif; ?>

				<?php if ( ! empty( $settings['main_title'] ) ) : ?>
					<h2 class="kba-title"><?php echo wp_kses_post( $settings['main_title'] ); ?></h2>
				<?php endif; ?>

				<?php if ( ! empty( $settings['section_description'] ) ) : ?>
					<p class="kba-description"><?php echo esc_html( $settings['section_description'] ); ?></p>
				<?php endif; ?>
			</header>

			<div class="kba-stage" data-kba-stage>

				<div class="kba-frame" data-kba-frame>

					<!-- BEFORE (base layer, full width) -->
					<div class="kba-panel kba-panel--before" data-kba-panel="before">
						<?php if ( $before_img ) : ?>
							<img
								class="kba-panel__img"
								src="<?php echo esc_url( $before_img ); ?>"
								alt="<?php echo esc_attr( $settings['before_title'] ); ?>"
								draggable="false"
							/>
						<?php endif; ?>
						<div class="kba-panel__scrim"></div>

						<div class="kba-panel__content">
							<span class="kba-tag kba-tag--alert"><?php esc_html_e( 'BEFORE', 'kinetic' ); ?></span>
							<h3 class="kba-panel__title"><?php echo esc_html( $settings['before_title'] ); ?></h3>
							<p class="kba-panel__tagline"><?php echo esc_html( $settings['before_tagline'] ); ?></p>
							<?php $this->render_metrics( $settings['before_metrics'], 'before' ); ?>
						</div>
					</div>

					<!-- AFTER (clipped reveal layer) -->
					<div class="kba-panel kba-panel--after" data-kba-panel="after">
						<?php if ( $after_img ) : ?>
							<img
								class="kba-panel__img"
								src="<?php echo esc_url( $after_img ); ?>"
								alt="<?php echo esc_attr( $settings['after_title'] ); ?>"
								draggable="false"
							/>
						<?php endif; ?>
						<div class="kba-panel__scrim"></div>

						<div class="kba-panel__content">
							<span class="kba-tag kba-tag--accent"><?php esc_html_e( 'AFTER', 'kinetic' ); ?></span>
							<h3 class="kba-panel__title"><?php echo esc_html( $settings['after_title'] ); ?></h3>
							<p class="kba-panel__tagline"><?php echo esc_html( $settings['after_tagline'] ); ?></p>
							<?php $this->render_metrics( $settings['after_metrics'], 'after' ); ?>
						</div>
					</div>

					<!-- Drag handle -->
					<div class="kba-handle" data-kba-handle>
						<span class="kba-handle__line kba-handle__line--top"></span>
						<span class="kba-handle__grip">
							<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M5 3L1 7L5 11" stroke="currentColor" stroke-width="1.6" stroke-linecap="square"/>
								<path d="M9 3L13 7L9 11" stroke="currentColor" stroke-width="1.6" stroke-linecap="square"/>
							</svg>
						</span>
						<span class="kba-handle__line kba-handle__line--bottom"></span>
					</div>

				</div>
			</div>

			<?php if ( ! empty( $settings['cta_text'] ) ) : ?>
				<div class="kba-cta-wrap">
					<a class="kba-cta" <?php echo $this->get_render_attribute_string( 'cta_link' ); ?>>
						<span class="kba-cta__text"><?php echo esc_html( $settings['cta_text'] ); ?></span>
						<span class="kba-cta__arrow" aria-hidden="true">&#8594;</span>
					</a>
				</div>
			<?php endif; ?>

		</section>
		<?php
	}

	/**
	 * Content template for the Elementor editor live preview (optional, JS).
	 */
	protected function content_template() {
		?>
		<#
		var beforeImg = settings.before_image.url;
		var afterImg  = settings.after_image.url;
		#>
		<section class="kinetic-ba">
			<header class="kba-header">
				<# if ( settings.mono_badge ) { #>
					<span class="kba-badge">{{{ settings.mono_badge }}}</span>
				<# } #>
				<# if ( settings.main_title ) { #>
					<h2 class="kba-title">{{{ settings.main_title }}}</h2>
				<# } #>
				<# if ( settings.section_description ) { #>
					<p class="kba-description">{{{ settings.section_description }}}</p>
				<# } #>
			</header>
			<div class="kba-stage">
				<div class="kba-frame">
					<div class="kba-panel kba-panel--before">
						<# if ( beforeImg ) { #><img class="kba-panel__img" src="{{{ beforeImg }}}" /><# } #>
						<div class="kba-panel__scrim"></div>
						<div class="kba-panel__content">
							<span class="kba-tag kba-tag--alert">BEFORE</span>
							<h3 class="kba-panel__title">{{{ settings.before_title }}}</h3>
							<p class="kba-panel__tagline">{{{ settings.before_tagline }}}</p>
						</div>
					</div>
					<div class="kba-panel kba-panel--after" style="clip-path: inset(0 50% 0 0);">
						<# if ( afterImg ) { #><img class="kba-panel__img" src="{{{ afterImg }}}" /><# } #>
						<div class="kba-panel__scrim"></div>
						<div class="kba-panel__content">
							<span class="kba-tag kba-tag--accent">AFTER</span>
							<h3 class="kba-panel__title">{{{ settings.after_title }}}</h3>
							<p class="kba-panel__tagline">{{{ settings.after_tagline }}}</p>
						</div>
					</div>
					<div class="kba-handle" style="left:50%;"></div>
				</div>
			</div>
		</section>
		<?php
	}
}

\Elementor\Plugin::instance()->widgets_manager->register( new Kinetic_Before_After_Widget() );