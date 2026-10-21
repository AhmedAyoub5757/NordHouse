<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Kinetic_Work_Showcase_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'kinetic_work_showcase';
	}

	public function get_title() {
		return __( 'Kinetic Asymmetrical Work Showcase', 'kinetic' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
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
			'section_label',
			array(
				'label'   => __( 'Mono Label', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '// ARCHIVE OF EXCELLENCE',
			)
		);

		$this->add_control(
			'section_title',
			array(
				'label'   => __( 'Main Title', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'SELECTED <span>WORKS</span>',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_projects',
			array(
				'label' => __( 'Project Items', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'project_num',
			array(
				'label'   => __( 'Index', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '01',
			)
		);

		$repeater->add_control(
			'project_name',
			array(
				'label'   => __( 'Client / Project Name', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'NEURAL MATRIX',
			)
		);

		$repeater->add_control(
			'project_category',
			array(
				'label'   => __( 'Category / Tech Stack', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'WEB APP • REACT / HEADLESS WP',
			)
		);

		$repeater->add_control(
			'metric_value',
			array(
				'label'   => __( 'Impact Metric Value', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '+340%',
			)
		);

		$repeater->add_control(
			'metric_label',
			array(
				'label'   => __( 'Impact Metric Label', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'CONVERSION RATE',
			)
		);

		$repeater->add_control(
			'project_image_url',
			array(
				'label'   => __( 'Dummy Image URL', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'https://picsum.photos/600/400?random=1',
			)
		);

		$repeater->add_control(
			'project_link',
			array(
				'label'   => __( 'Project Link', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$this->add_control(
			'projects',
			array(
				'label'       => __( 'Projects List', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array( 'project_num' => '01', 'project_name' => 'KINETIC VAULT', 'project_category' => 'FINTECH • WEB APPLICATION', 'metric_value' => '0.2s', 'metric_label' => 'PAGE LATENCY', 'project_image_url' => 'https://picsum.photos/600/400?random=101' ),
					array( 'project_num' => '02', 'project_name' => 'CYBER REALM', 'project_category' => 'MOBILE APP • IOS / FLUTTER', 'metric_value' => '1.2M', 'metric_label' => 'ACTIVE USERS', 'project_image_url' => 'https://picsum.photos/600/400?random=102' ),
					array( 'project_num' => '03', 'project_name' => 'AURA OS', 'project_category' => 'DESIGN SYSTEM • BRANDING', 'metric_value' => '+420%', 'metric_label' => 'BRAND REACH', 'project_image_url' => 'https://picsum.photos/600/400?random=103' ),
					array( 'project_num' => '04', 'project_name' => 'HYPER SPEED', 'project_category' => 'PERFORMANCE AUDIT • NODE', 'metric_value' => '100/100', 'metric_label' => 'LIGHTHOUSE', 'project_image_url' => 'https://picsum.photos/600/400?random=104' ),
				),
				'title_field' => '{{{ project_num }}} — {{{ project_name }}}',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<!-- COOL PRELOADER ARCHITECTURE -->
		<div class="k-preloader" id="kPreloader">
			<div class="k-loader-header">
				<div class="k-loader-brand">KINETIC<span>.</span></div>
				<span class="k-loader-tag">// SYSTEM INITIALIZATION</span>
			</div>

			<div class="k-loader-center">
				<div class="k-loader-marquee-text">ENGINEERING <span>DIGITAL</span></div>
				<div class="k-loader-marquee-text">SUPERIORITY<span>.</span></div>
			</div>

			<div class="k-loader-footer">
				<div class="k-loader-status-col">
					<span>CURRENT TASK:</span>
					<span class="k-loader-status-active" id="kLoaderStatus">INITIALIZING CORE...</span>
				</div>
				<div class="k-loader-counter-box">
					<span class="k-loader-num" id="kLoaderNum">000</span>
					<span class="k-loader-symbol">%</span>
				</div>
			</div>
		</div>

		<!-- TRANSITION CURTAIN PANEL -->
		<div class="k-loader-curtain-panel" id="kLoaderCurtain"></div>

		<!-- WORK SHOWCASE SECTION -->
		<section class="k-work-section" id="work">
			<div class="k-work-header">
				<div>
					<span class="k-mono-label"><?php echo esc_html( $settings['section_label'] ); ?></span>
					<h2 class="k-work-title-h2"><?php echo wp_kses_post( $settings['section_title'] ); ?></h2>
				</div>
			</div>

			<div class="k-work-list">
				<?php foreach ( $settings['projects'] as $item ) : 
					$url = ! empty( $item['project_link']['url'] ) ? $item['project_link']['url'] : '#';
					$img = $item['project_image_url'];
				?>
					<a href="<?php echo esc_url( $url ); ?>" class="k-work-item" data-preview="<?php echo esc_url( $img ); ?>">
						<span class="k-work-index">// <?php echo esc_html( $item['project_num'] ); ?></span>
						<div class="k-work-name-wrap">
							<span class="k-work-client"><?php echo esc_html( $item['project_name'] ); ?></span>
							<span class="k-work-cat"><?php echo esc_html( $item['project_category'] ); ?></span>
						</div>
						<div class="k-work-metric-badge">
							<span class="k-metric-val"><?php echo esc_html( $item['metric_value'] ); ?></span>
							<span class="k-metric-lbl"><?php echo esc_html( $item['metric_label'] ); ?></span>
						</div>
						<div class="k-work-arrow-box">
							<svg class="k-work-svg-arrow" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
						</div>
					</a>
				<?php endforeach; ?>
			</div>

			<!-- Floating Card Image Follower -->
			<div class="k-hover-preview-card" id="kHoverPreviewCard">
				<img src="" id="kHoverPreviewImg" alt="Project Preview">
			</div>
		</section>
		<?php
	}
}

\Elementor\Plugin::instance()->widgets_manager->register( new Kinetic_Work_Showcase_Widget() );