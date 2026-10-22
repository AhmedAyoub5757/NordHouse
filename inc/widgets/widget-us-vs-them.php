<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Kinetic_Us_Vs_Them_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'kinetic_us_vs_them';
	}

	public function get_title() {
		return __( 'Kinetic Visual Matrix', 'kinetic' );
	}

	public function get_icon() {
		return 'eicon-table';
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
				'default' => '// ARCHITECTURAL BENCHMARKS',
			)
		);

		$this->add_control(
			'section_title',
			array(
				'label'   => __( 'Main Title', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'THE <span>MONOLITH</span> SPECS',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_rows',
			array(
				'label' => __( 'Comparison Benchmarks', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'metric_title',
			array(
				'label'   => __( 'Metric Title', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'PAGE LOAD SPEED',
			)
		);

		$repeater->add_control(
			'them_metric',
			array(
				'label'   => __( 'Them Value', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '4.8s',
			)
		);

		$repeater->add_control(
			'them_label',
			array(
				'label'   => __( 'Them Sublabel', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'Bloated / Sluggish',
			)
		);

		$repeater->add_control(
			'us_metric',
			array(
				'label'   => __( 'Us Value', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '0.2s',
			)
		);

		$repeater->add_control(
			'us_label',
			array(
				'label'   => __( 'Us Sublabel', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'Instant Execution',
			)
		);

		$this->add_control(
			'benchmarks',
			array(
				'label'       => __( 'Benchmark List', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'metric_title' => 'PAGE LOAD SPEED',
						'them_metric'  => '4.8s',
						'them_label'   => 'Sluggish / Lagging',
						'us_metric'    => '0.2s',
						'us_label'     => 'Instant Execution',
					),
					array(
						'metric_title' => 'LIGHTHOUSE SCORE',
						'them_metric'  => '45/100',
						'them_label'   => 'Poor Core Vitals',
						'us_metric'    => '100/100',
						'us_label'     => 'Perfect Optimization',
					),
					array(
						'metric_title' => 'CODE DEPENDENCIES',
						'them_metric'  => '35+ Plugins',
						'them_label'   => 'High Vulnerability',
						'us_metric'    => '0 Plugins',
						'us_label'     => '100% Pure Code',
					),
					array(
						'metric_title' => 'DESIGN ORIGIN',
						'them_metric'  => 'TEMPLATE',
						'them_label'   => 'Cookie-Cutter',
						'us_metric'    => 'BESPOKE',
						'us_label'     => 'Neo-Brutalist Craft',
					),
				),
				'title_field' => '{{{ metric_title }}}',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="k-visual-matrix-section" id="comparison">
			<div class="k-vmatrix-header">
				<span class="k-mono-label"><?php echo esc_html( $settings['section_badge'] ); ?></span>
				<h2 class="k-vmatrix-h2"><?php echo wp_kses_post( $settings['section_title'] ); ?></h2>
			</div>

			<!-- Visual Benchmarks List -->
			<div class="k-vmatrix-grid">
				
				<!-- Grid Legend Bar -->
				<div class="k-vmatrix-legend-row">
					<span class="k-vleg-title">METRIC PILLAR</span>
					<span class="k-vleg-them">TRADITIONAL AGENCIES</span>
					<span class="k-vleg-us">KINETIC MONOLITH</span>
				</div>

				<?php foreach ( $settings['benchmarks'] as $idx => $item ) : ?>
					<div class="k-vmatrix-row">
						
						<!-- Metric Title Column -->
						<div class="k-vcell k-vcell-title">
							<span class="k-vcell-num">// 0<?php echo $idx + 1; ?></span>
							<span class="k-vcell-name"><?php echo esc_html( $item['metric_title'] ); ?></span>
						</div>

						<!-- Them Metric Column -->
						<div class="k-vcell k-vcell-them">
							<div class="k-vmetric-box">
								<span class="k-vval-them"><?php echo esc_html( $item['them_metric'] ); ?></span>
								<span class="k-vlbl-them"><?php echo esc_html( $item['them_label'] ); ?></span>
							</div>
							<span class="k-vicon k-vicon-cross">
								<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
							</span>
						</div>

						<!-- Us Metric Column -->
						<div class="k-vcell k-vcell-us">
							<div class="k-vmetric-box">
								<span class="k-vval-us"><?php echo esc_html( $item['us_metric'] ); ?></span>
								<span class="k-vlbl-us"><?php echo esc_html( $item['us_label'] ); ?></span>
							</div>
							<span class="k-vicon k-vicon-check">
								<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
							</span>
						</div>

					</div>
				<?php endforeach; ?>

			</div>
		</section>
		<?php
	}
}

\Elementor\Plugin::instance()->widgets_manager->register( new Kinetic_Us_Vs_Them_Widget() );