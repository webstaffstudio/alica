<?php
namespace Anahata\Modules\Blockquote;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Blockquote
 */
class Blockquote implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'mkd_blockquote';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 * @see mkd_core_get_carousel_slider_array_vc()
	 */
	public function vcMap() {

		vc_map(array(
			'name'                      => esc_html__('Blockquote', 'mikado-core'),
			'base'                      => $this->getBase(),
			'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
			'icon'                      => 'icon-wpb-blockquote extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					"type"        => "textarea",
					"heading"     => esc_html__("Text", "anahata"),
					"param_name"  => "text",
					"value"       => esc_html__("Blockquote text", "anahata"),
					"save_always" => true
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__("Width (%)", "anahata"),
					"param_name" => "width"
				)
			)
		));

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'text'  => '',
			'width' => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['blockquote_style'] = $this->getBlockquoteStyle($params);

		//Get HTML from template
		$html = mikado_core_get_core_shortcode_template_part('templates/blockquote-template', 'blockquote', '', $params);

		return $html;

	}

	/**
	 * Return Style for Blockquote
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getBlockquoteStyle($params) {
		$blockquote_style = array();

		if($params['width'] !== '') {
			$width              = strstr($params['width'], '%') ? $params['width'] : $params['width'].'%';
			$blockquote_style[] = 'width: '.$width;
		}

		return implode(';', $blockquote_style);
	}

}