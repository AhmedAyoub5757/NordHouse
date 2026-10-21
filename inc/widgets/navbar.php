<?php
/**
 * Matcha Navbar Widget — "The Bloom"
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class Matcha_Navbar_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'matcha_navbar';
	}

	public function get_title() {
		return __( 'Matcha Navbar', 'matcha-launch' );
	}

	public function get_icon() {
		return 'eicon-menu-bar';
	}

	public function get_categories() {
		return array( 'matcha-sections' );
	}

	protected function register_controls() {

		/* ---- Logo ---- */
		$this->start_controls_section(
			'section_logo',
			array( 'label' => __( 'Logo', 'matcha-launch' ) )
		);

		$this->add_control(
			'logo_type',
			array(
				'label'   => __( 'Logo Type', 'matcha-launch' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => array(
					'text'  => array( 'title' => __( 'Text', 'matcha-launch' ), 'icon' => 'eicon-text' ),
					'image' => array( 'title' => __( 'Image', 'matcha-launch' ), 'icon' => 'eicon-image' ),
				),
				'default' => 'text',
				'toggle'  => false,
			)
		);

		$this->add_control(
			'logo_text',
			array(
				'label'     => __( 'Logo Text', 'matcha-launch' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => 'matcha.',
				'condition' => array( 'logo_type' => 'text' ),
			)
		);

		$this->add_control(
			'logo_image',
			array(
				'label'     => __( 'Logo Image', 'matcha-launch' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'condition' => array( 'logo_type' => 'image' ),
			)
		);

		$this->end_controls_section();

		/* ---- Nav Links ---- */
		$this->start_controls_section(
			'section_links',
			array( 'label' => __( 'Navigation Links', 'matcha-launch' ) )
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'label',
			array(
				'label'   => __( 'Label', 'matcha-launch' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'Menu Item',
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'       => __( 'Link', 'matcha-launch' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'default'     => array( 'url' => '#' ),
				'placeholder' => '#section-id',
			)
		);

		$this->add_control(
			'nav_links',
			array(
				'label'       => __( 'Links', 'matcha-launch' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array( 'label' => 'Home',      'link' => array( 'url' => '#hero' ) ),
					array( 'label' => 'Flavors',   'link' => array( 'url' => '#flavors' ) ),
					array( 'label' => 'Our Story', 'link' => array( 'url' => '#story' ) ),
					array( 'label' => 'FAQ',       'link' => array( 'url' => '#faq' ) ),
				),
				'title_field' => '{{{ label }}}',
			)
		);

		$this->end_controls_section();

		/* ---- CTA ---- */
		$this->start_controls_section(
			'section_cta',
			array( 'label' => __( 'CTA Button', 'matcha-launch' ) )
		);

		$this->add_control(
			'show_cta',
			array(
				'label'   => __( 'Show CTA Button', 'matcha-launch' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'cta_text',
			array(
				'label'     => __( 'CTA Text', 'matcha-launch' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => 'Shop the Collection',
				'condition' => array( 'show_cta' => 'yes' ),
			)
		);

		$this->add_control(
			'cta_link',
			array(
				'label'     => __( 'CTA Link', 'matcha-launch' ),
				'type'      => \Elementor\Controls_Manager::URL,
				'default'   => array( 'url' => '#shop' ),
				'condition' => array( 'show_cta' => 'yes' ),
			)
		);

		$this->end_controls_section();

		/* ---- Trigger Settings ---- */
		$this->start_controls_section(
			'section_trigger',
			array( 'label' => __( 'Trigger Settings', 'matcha-launch' ) )
		);

		$this->add_control(
			'trigger_position',
			array(
				'label'   => __( 'Trigger Position', 'matcha-launch' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => array(
					'left'  => array( 'title' => __( 'Left', 'matcha-launch' ), 'icon' => 'eicon-h-align-left' ),
					'right' => array( 'title' => __( 'Right', 'matcha-launch' ), 'icon' => 'eicon-h-align-right' ),
				),
				'default' => 'right',
				'toggle'  => false,
			)
		);

		$this->add_control(
			'menu_label',
			array(
				'label'   => __( 'Trigger Label (closed)', 'matcha-launch' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'Menu',
			)
		);

		$this->add_control(
			'close_label',
			array(
				'label'   => __( 'Trigger Label (open)', 'matcha-launch' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'Close',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$trigger_pos = $s['trigger_position'] === 'left' ? 'left' : 'right';
		?>
		<div class="matcha-bloomnav" id="matchaBloomNav" data-trigger-pos="<?php echo esc_attr( $trigger_pos ); ?>">

			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="matcha-bloomnav__logo">
				<?php if ( $s['logo_type'] === 'image' && ! empty( $s['logo_image']['url'] ) ) : ?>
					<img src="<?php echo esc_url( $s['logo_image']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>">
				<?php else : ?>
					<span><?php echo esc_html( $s['logo_text'] ); ?></span>
				<?php endif; ?>
			</a>

			<button type="button"
				class="matcha-bloomnav__trigger matcha-bloomnav__trigger--<?php echo esc_attr( $trigger_pos ); ?>"
				id="matchaBloomTrigger"
				aria-expanded="false"
				aria-controls="matchaBloomOverlay">

				<svg class="matcha-bloomnav__ring" viewBox="0 0 64 64" aria-hidden="true">
					<circle class="matcha-bloomnav__ring-track" cx="32" cy="32" r="29"></circle>
					<circle class="matcha-bloomnav__ring-progress" id="matchaRingProgress" cx="32" cy="32" r="29"></circle>
				</svg>

				<span class="matcha-bloomnav__trigger-icon" aria-hidden="true">
					<span></span>
					<span></span>
				</span>

				<span class="matcha-bloomnav__trigger-label">
					<span class="is-closed-label"><?php echo esc_html( $s['menu_label'] ); ?></span>
					<span class="is-open-label"><?php echo esc_html( $s['close_label'] ); ?></span>
				</span>
			</button>

			<div class="matcha-bloomnav__overlay" id="matchaBloomOverlay" aria-hidden="true">
				<div class="matcha-bloomnav__leaves" aria-hidden="true">
					<svg class="leaf leaf--1" viewBox="0 0 100 100"><path d="M50 5C70 20 90 40 90 60C90 82 70 95 50 95C30 95 10 82 10 60C10 40 30 20 50 5Z"/></svg>
					<svg class="leaf leaf--2" viewBox="0 0 100 100"><path d="M50 5C70 20 90 40 90 60C90 82 70 95 50 95C30 95 10 82 10 60C10 40 30 20 50 5Z"/></svg>
					<svg class="leaf leaf--3" viewBox="0 0 100 100"><path d="M50 5C70 20 90 40 90 60C90 82 70 95 50 95C30 95 10 82 10 60C10 40 30 20 50 5Z"/></svg>
				</div>

				<nav class="matcha-bloomnav__panel">
					<ul class="matcha-bloomnav__list">
						<?php foreach ( $s['nav_links'] as $i => $item ) :
							$target = ! empty( $item['link']['is_external'] ) ? ' target="_blank"' : '';
							$nofollow = ! empty( $item['link']['nofollow'] ) ? ' rel="nofollow"' : '';
							$num = str_pad( $i + 1, 2, '0', STR_PAD_LEFT );
							?>
							<li class="matcha-bloomnav__list-item" style="--i: <?php echo esc_attr( $i ); ?>">
								<a href="<?php echo esc_url( $item['link']['url'] ); ?>"
								   class="matcha-bloomnav__list-link"
								   data-nav-link
								   <?php echo $target . $nofollow; ?>>
									<span class="matcha-bloomnav__num"><?php echo esc_html( $num ); ?></span>
									<span class="matcha-bloomnav__label"><?php echo esc_html( $item['label'] ); ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>

					<?php if ( $s['show_cta'] === 'yes' && ! empty( $s['cta_text'] ) ) :
						$cta = $s['cta_link'];
						$target = ! empty( $cta['is_external'] ) ? ' target="_blank"' : '';
						$nofollow = ! empty( $cta['nofollow'] ) ? ' rel="nofollow"' : '';
						?>
						<a href="<?php echo esc_url( $cta['url'] ); ?>"
						   class="matcha-bloomnav__cta"
						   data-nav-link
						   <?php echo $target . $nofollow; ?>>
							<?php echo esc_html( $cta['text'] ?? $s['cta_text'] ); ?>
						</a>
					<?php endif; ?>
				</nav>
			</div>
		</div>
		<?php
	}
}

add_filter( 'matcha_widget_classes', function( $classes ) {
	$classes[] = 'Matcha_Navbar_Widget';
	return $classes;
} );