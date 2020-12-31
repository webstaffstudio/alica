<?php

namespace Anahata\Modules\Shortcodes\CardsSlider;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class CardsSlider
 */
class CardsSlider implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	/**
	 * CardsSlider constructor.
	 */
	public function __construct() {
		$this->base = 'mkd_cards_slider';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 *
	 */
	public function vcMap() {
		vc_map(array(
			'name'                    => esc_html__('Cards Slider Holder', 'mikado-core'),
			'base'                    => $this->base,
			'as_parent'               => array('only' => 'mkd_cards_slider_item'),
			'content_element'         => true,
			'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
			'icon'                    => 'icon-wpb-cards-slider extended-custom-icon',
			'js_view'                 => 'VcColumnView',

		));
	}

	/**
	 * @param array $atts
	 * @param null $content
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {
		$default_attrs = array(

        );
		$params        = shortcode_atts($default_attrs, $atts);

		$params['content'] = $content;

		return mikado_core_get_core_shortcode_template_part('templates/cards-slider-holder', 'cards-slider', '', $params);
	}
}