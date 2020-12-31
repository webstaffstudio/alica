<?php
namespace Anahata\Modules\Shortcodes\InfoBox;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class InfoBox implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkd_info_box';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Info Box', 'mikado-core'),
			'base'                      => $this->base,
			'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
			'icon'                      => 'icon-wpb-info-box extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array_merge(
				anahata_mikado_icon_collections()->getVCParamsArray('', '', true),
				array(
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Title', 'mikado-core'),
						'param_name'  => 'title',
						'value'       => '',
						'save_always' => true,
						'admin_label' => true
					),
					array(
						'type'        => 'textarea',
						'heading'     => esc_html__('Text', 'mikado-core'),
						'param_name'  => 'text',
						'value'       => '',
						'save_always' => true,
						'admin_label' => true
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Button Link', 'mikado-core'),
						'param_name'  => 'button_link',
						'value'       => '',
						'save_always' => true,
						'admin_label' => true
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Button Text', 'mikado-core'),
						'param_name'  => 'button_text',
						'value'       => '',
						'save_always' => true,
						'admin_label' => true,
						'dependency'  => array('element' => 'button_link', 'not_empty' => true)
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Button Target', 'mikado-core'),
						'param_name'  => 'button_target',
						'value'       => array(
							esc_html__('Same Window', 'mikado-core') => '',
							esc_html__('New Window', 'mikado-core')  => '_blank'
						),
						'save_always' => true,
						'admin_label' => true,
						'dependency'  => array('element' => 'button_link', 'not_empty' => true)
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Background Color', 'mikado-core'),
						'param_name'  => 'background_color',
						'value'       => '',
						'save_always' => true,
						'admin_label' => true,
						'group'       => esc_html__('Design Options', 'mikado-core'),
					),
					array(
						'type'        => 'attach_image',
						'heading'     => esc_html__('Background Image', 'mikado-core'),
						'param_name'  => 'background_image',
						'value'       => '',
						'save_always' => true,
						'admin_label' => true,
						'group'       => esc_html__('Design Options', 'mikado-core'),
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Button Type', 'mikado-core'),
						'param_name'  => 'button_type',
						'value'       => array_flip(anahata_mikado_get_btn_types(true)),
						'save_always' => true,
						'admin_label' => true,
						'dependency'  => array('element' => 'button_link', 'not_empty' => true),
						'group'       => esc_html__('Design Options', 'mikado-core'),
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Hover Button Type', 'mikado-core'),
						'param_name'  => 'hover_button_type',
						'value'       => array_flip(anahata_mikado_get_btn_types(true)),
						'save_always' => true,
						'admin_label' => true,
						'dependency'  => array('element' => 'button_link', 'not_empty' => true),
						'group'       => esc_html__('Design Options', 'mikado-core'),
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Button Hover Background Color', 'mikado-core'),
						'param_name'  => 'button_hover_bg_color',
						'value'       => '',
						'save_always' => true,
						'group'       => esc_html__('Design Options', 'mikado-core'),
						'dependency'  => array('element' => 'button_link', 'not_empty' => true)
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Button Hover Text Color', 'mikado-core'),
						'param_name'  => 'button_hover_color',
						'value'       => '',
						'save_always' => true,
						'group'       => esc_html__('Design Options', 'mikado-core'),
						'dependency'  => array('element' => 'button_link', 'not_empty' => true)
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Button Hover Border Color', 'mikado-core'),
						'param_name'  => 'button_hover_border_color',
						'value'       => '',
						'save_always' => true,
						'group'       => esc_html__('Design Options', 'mikado-core'),
						'dependency'  => array('element' => 'button_link', 'not_empty' => true)
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Icon Color', 'mikado-core'),
						'param_name'  => 'icon_color',
						'value'       => '',
						'save_always' => true,
						'dependency'  => array('element' => 'icon_pack', 'not_empty' => true),
						'group'       => esc_html__('Design Options', 'mikado-core'),
					)
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$defaultAtts = array(
			'background_color'          => '',
			'background_image'          => '',
			'title'                     => '',
			'button_link'               => '',
			'button_text'               => '',
			'button_target'             => '',
			'button_type'               => '',
			'hover_button_type'         => '',
			'button_hover_bg_color'     => '',
			'button_hover_color'        => '',
			'button_hover_border_color' => '',
			'text'                      => '',
			'icon_color'                => ''
		);

		$defaultAtts = array_merge($defaultAtts, anahata_mikado_icon_collections()->getShortcodeParams());
		$params      = shortcode_atts($defaultAtts, $atts);

		$params['holder_styles']  = $this->getHolderStyles($params);
		$params['button_params']  = $this->getButtonParams($params);
		$params['holder_classes'] = $this->getHolderClasses($params);

		$iconPackName          = anahata_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$params['icon']        = $iconPackName ? $params[$iconPackName] : '';
		$params['show_icon']   = $params['icon'] !== '';
		$params['icon_styles'] = $this->getIconStyles($params);

		return mikado_core_get_core_shortcode_template_part('templates/info-box-template', 'info-box', '', $params);
	}

	private function getHolderStyles($params) {
		$styles = array();

		if($params['background_color'] !== '') {
			$styles[] = 'background-color: '.$params['background_color'];
		} elseif($params['background_image']) {
			$styles[] = 'background-image: url('.wp_get_attachment_url($params['background_image']).')';
		}

		return $styles;
	}

	private function getButtonParams($params) {
		$btnParams = array();

		if(!empty($params['button_link'])) {
			$btnParams['link'] = $params['button_link'];
		}

		if(!empty($params['button_text'])) {
			$btnParams['text'] = $params['button_text'];
		}

		if(!empty($params['button_target'])) {
			$btnParams['target'] = $params['button_target'];
		}

		if(!empty($params['button_type'])) {
			$btnParams['type'] = $params['button_type'];
		}

		if(!empty($params['hover_button_type'])) {
			$btnParams['hover_type'] = $params['hover_button_type'];
		}

		if(!empty($params['button_hover_bg_color'])) {
			$btnParams['hover_background_color'] = $params['button_hover_bg_color'];
		}

		if(!empty($params['button_hover_color'])) {
			$btnParams['hover_color'] = $params['button_hover_color'];
		}

		if(!empty($params['button_hover_border_color'])) {
			$btnParams['hover_border_color'] = $params['button_hover_border_color'];
		}

		$btnParams['size'] = 'small';

		return $btnParams;
	}

	private function getHolderClasses($params) {
		$classes = array('mkd-info-box-holder');

		if(!empty($params['background_image']) && empty($params['background_color'])) {
			$classes[] = 'mkd-info-box-with-image';
		}

		return $classes;
	}

	private function getIconStyles($params) {
		$styles = array();

		if(!empty($params['show_icon']) && $params['show_icon']) {
			if(!empty($params['icon_color'])) {
				$styles[] = 'color: '.$params['icon_color'];
			}
		}

		return implode(', ', $styles);
	}

}