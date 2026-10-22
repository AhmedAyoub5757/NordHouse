<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Kinetic_FAQ_Monolith_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'kinetic_faq_monolith';
	}

	public function get_title() {
		return __( 'Kinetic FAQ Monolith', 'kinetic' );
	}

	public function get_icon() {
		return 'eicon-help-o';
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
				'default' => '// KNOWLEDGE BASE',
			)
		);

		$this->add_control(
			'section_title',
			array(
				'label'   => __( 'Main Title', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'FREQUENTLY <span>ANSWERED</span>',
			)
		);

		$this->add_control(
			'section_desc',
			array(
				'label'   => __( 'Description', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Everything you need to know about our engineering sprint model, custom WordPress architecture, and code ownership.',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_faqs',
			array(
				'label' => __( 'FAQ Items', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'faq_number',
			array(
				'label'   => __( 'Index', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '01',
			)
		);

		$repeater->add_control(
			'faq_question',
			array(
				'label'   => __( 'Question', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'How long does a custom theme sprint take?',
			)
		);

		$repeater->add_control(
			'faq_answer',
			array(
				'label'   => __( 'Answer', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Our MVP Sprint landing pages are engineered and delivered in 2 weeks. Full custom platforms take 3–4 weeks depending on motion complexity.',
			)
		);

		$this->add_control(
			'faqs_list',
			array(
				'label'       => __( 'FAQ Accordion List', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'faq_number'   => '01',
						'faq_question' => 'How long does a custom development sprint take?',
						'faq_answer'   => 'Our MVP Sprint landing pages are engineered and launched in 2 weeks. Full multi-service platforms take 3–4 weeks depending on motion design and 3D graphics complexity.',
					),
					array(
						'faq_number'   => '02',
						'faq_question' => 'Why custom WordPress instead of pre-made templates or Elementor Pro?',
						'faq_answer'   => 'Pre-made templates rely on 30+ heavy plugins and bloated code that slow down your site. We build 100% custom theme boilerplates with dedicated Elementor widgets. You get total control without speed compromise.',
					),
					array(
						'faq_number'   => '03',
						'faq_question' => 'Do I own the full codebase after project completion?',
						'faq_answer'   => 'Yes, 100%. Upon final deployment, full copyright, source code, and intellectual property rights are transferred to your company. Zero vendor lock-in.',
					),
					array(
						'faq_number'   => '04',
						'faq_question' => 'How easy is it for our team to edit text and images later?',
						'faq_answer'   => 'Extremely easy. We build custom Elementor controls for every section (colors, text, images, show/hide toggles). Your team can edit content visually without touching code.',
					),
					array(
						'faq_number'   => '05',
						'faq_question' => 'What happens after the site goes live?',
						'faq_answer'   => 'Every tier includes 30 to 60 days of direct post-launch engineering support. We monitor Lighthouse scores, server uptime, and provide instant bug fixes.',
					),
				),
				'title_field' => '{{{ faq_number }}} — {{{ faq_question }}}',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="k-faq-section" id="faq">
			<div class="k-faq-container">
				
				<!-- Left Sticky Header Column -->
				<div class="k-faq-header-col">
					<span class="k-mono-label"><?php echo esc_html( $settings['section_badge'] ); ?></span>
					<h2 class="k-faq-h2"><?php echo wp_kses_post( $settings['section_title'] ); ?></h2>
					<p class="k-faq-desc"><?php echo esc_html( $settings['section_desc'] ); ?></p>

					<!-- Search Bar Filter Input -->
					<div class="k-faq-search-box">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
						<input type="text" id="kFaqSearchInput" placeholder="TYPE TO FILTER QUESTIONS..." aria-label="Search FAQs">
					</div>
				</div>

				<!-- Right Accordion List -->
				<div class="k-faq-accordion-list" id="kFaqList">
					<?php foreach ( $settings['faqs_list'] as $idx => $item ) : ?>
						<div class="k-faq-item <?php echo $idx === 0 ? 'is-open' : ''; ?>" data-faq="<?php echo esc_attr( $idx ); ?>">
							
							<div class="k-faq-question-btn">
								<span class="k-faq-num">// <?php echo esc_html( $item['faq_number'] ); ?></span>
								<h3 class="k-faq-q-text"><?php echo esc_html( $item['faq_question'] ); ?></h3>
								<div class="k-faq-toggle-icon">
									<svg class="k-svg-plus" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line class="k-line-v" x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
								</div>
							</div>

							<div class="k-faq-answer-body">
								<div class="k-faq-answer-inner">
									<p><?php echo esc_html( $item['faq_answer'] ); ?></p>
								</div>
							</div>

						</div>
					<?php endforeach; ?>
				</div>

			</div>
		</section>
		<?php
	}
}

\Elementor\Plugin::instance()->widgets_manager->register( new Kinetic_FAQ_Monolith_Widget() );