<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Kinetic_Testimonials_Bubble_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'kinetic_testimonials_bubble';
	}

	public function get_title() {
		return __( 'Kinetic Bubble Testimonials', 'kinetic' );
	}

	public function get_icon() {
		return 'eicon-testimonial';
	}

	public function get_categories() {
		return array( 'kinetic-widgets' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_center_content',
			array(
				'label' => __( 'Central Focal Text', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'center_badge',
			array(
				'label'   => __( 'Small Badge Text', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '// PROVEN RECORD OF EXCELLENCE',
			)
		);

		$this->add_control(
			'center_title',
			array(
				'label'   => __( 'Main Center Title', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Trusted by founders who switched to custom engineering',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_bubbles',
			array(
				'label' => __( 'Testimonial Bubbles', 'kinetic' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'quote_text',
			array(
				'label'   => __( 'Client Review / Quote', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Finally a web agency that delivers 100/100 Lighthouse speed without excuses.',
			)
		);

		$repeater->add_control(
			'client_name',
			array(
				'label'   => __( 'Client Name', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'Sara Jenkins',
			)
		);

		$repeater->add_control(
			'client_role',
			array(
				'label'   => __( 'Role / Company', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'Founder, Nexus AI',
			)
		);

		$repeater->add_control(
			'avatar_url',
			array(
				'label'   => __( 'Avatar Image URL', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'https://i.pravatar.cc/150?img=32',
			)
		);

		$repeater->add_control(
			'bubble_position',
			array(
				'label'   => __( 'Desktop Screen Zone', 'kinetic' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'top-left',
				'options' => array(
					'top-left'     => __( 'Top Left', 'kinetic' ),
					'top-right'    => __( 'Top Right', 'kinetic' ),
					'mid-left'     => __( 'Mid Left', 'kinetic' ),
					'mid-right'    => __( 'Mid Right', 'kinetic' ),
					'bottom-left'  => __( 'Bottom Left', 'kinetic' ),
					'bottom-right' => __( 'Bottom Right', 'kinetic' ),
				),
			)
		);

		$this->add_control(
			'bubbles_list',
			array(
				'label'       => __( 'Speech Bubbles', 'kinetic' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'quote_text'      => 'The first agency that actually built a zero-bloat custom theme for us. Outstanding speed.',
						'client_name'     => 'Marcus Vance',
						'client_role'     => 'CTO, Vault FinTech',
						'avatar_url'      => 'https://i.pravatar.cc/150?img=11',
						'bubble_position' => 'top-left',
					),
					array(
						'quote_text'      => 'Rare to find developers who understand both high-level motion design and strict WP architecture.',
						'client_name'     => 'Elena Rostova',
						'client_role'     => 'Design Director, Aura',
						'avatar_url'      => 'https://i.pravatar.cc/150?img=20',
						'bubble_position' => 'top-right',
					),
					array(
						'quote_text'      => 'Conversion rate spiked +340% within 3 weeks of launching our new Kinetic landing page.',
						'client_name'     => 'David Chen',
						'client_role'     => 'Head of Growth',
						'avatar_url'      => 'https://i.pravatar.cc/150?img=33',
						'bubble_position' => 'mid-left',
					),
					array(
						'quote_text'      => 'Code structure is so clean that our internal team can edit content easily via Elementor.',
						'client_name'     => 'Sarah Lindqvist',
						'client_role'     => 'Product Lead',
						'avatar_url'      => 'https://i.pravatar.cc/150?img=47',
						'bubble_position' => 'mid-right',
					),
					array(
						'quote_text'      => 'We recommended Kinetic to three partner startups before our sprint was even finished.',
						'client_name'     => 'Jake Miller',
						'client_role'     => 'Founder, CyberSpace',
						'avatar_url'      => 'https://i.pravatar.cc/150?img=60',
						'bubble_position' => 'bottom-left',
					),
					array(
						'quote_text'      => 'Couldn\'t explain how much we love the micro-interactions. Unmatched quality.',
						'client_name'     => 'Nina Thorne',
						'client_role'     => 'CMO, HyperDrive',
						'avatar_url'      => 'https://i.pravatar.cc/150?img=5',
						'bubble_position' => 'bottom-right',
					),
				),
				'title_field' => '{{{ client_name }}} — {{{ bubble_position }}}',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="k-bubble-section" id="testimonials">
			<div class="k-bubble-stage">
				
				<!-- Central Headline Focal Point -->
				<div class="k-bubble-center-box">
					<span class="k-mono-label"><?php echo esc_html( $settings['center_badge'] ); ?></span>
					<h2 class="k-bubble-main-h2"><?php echo esc_html( $settings['center_title'] ); ?></h2>
					<div class="k-center-pulse-pill">
						<span class="k-pulse-dot"></span>
						<span>100% VERIFIED CLIENT FEEDBACK</span>
					</div>
				</div>

				<!-- Floating Testimonial Bubbles Stream -->
				<div class="k-bubbles-container">
					<?php foreach ( $settings['bubbles_list'] as $idx => $item ) : ?>
						<div class="k-bubble-card pos-<?php echo esc_attr( $item['bubble_position'] ); ?>" data-bubble-index="<?php echo esc_attr( $idx ); ?>">
							
							<div class="k-bubble-content">
								<p class="k-bubble-quote">"<?php echo esc_html( $item['quote_text'] ); ?>"</p>
							</div>

							<div class="k-bubble-meta">
								<img src="<?php echo esc_url( $item['avatar_url'] ); ?>" alt="<?php echo esc_attr( $item['client_name'] ); ?>" class="k-bubble-avatar">
								<div class="k-bubble-author">
									<span class="k-author-name"><?php echo esc_html( $item['client_name'] ); ?></span>
									<span class="k-author-role"><?php echo esc_html( $item['client_role'] ); ?></span>
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

\Elementor\Plugin::instance()->widgets_manager->register( new Kinetic_Testimonials_Bubble_Widget() );