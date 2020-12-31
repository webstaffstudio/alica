<?php
namespace Anahata\Modules\ElementsHolderItem;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class ElementsHolderItem implements ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'mkd_elements_holder_item';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if(function_exists('vc_map')) {
            vc_map(
                array(
                    'name'                    => esc_html__('Elements Holder Item', 'mikado-core'),
                    'anahata',
                    'base'                    => $this->base,
                    'as_child'                => array('only' => 'mkd_elements_holder'),
                    'as_parent'               => array('except' => 'vc_row, vc_accordion, no_cover_boxes, no_portfolio_list, no_portfolio_slider'),
                    'content_element'         => true,
                    'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
                    'icon'                    => 'icon-wpb-elements-holder-item extended-custom-icon',
                    'show_settings_on_create' => true,
                    'js_view'                 => 'VcColumnView',
                    'params'                  => array(
                        array(
                            'type'        => 'colorpicker',
                            'class'       => '',
                            'heading'     => esc_html__('Background Color', 'mikado-core'),
                            'param_name'  => 'background_color',
                            'value'       => '',
                            'description' => ''
                        ),
                        array(
                            'type'        => 'attach_image',
                            'class'       => '',
                            'heading'     => esc_html__('Background Image', 'mikado-core'),
                            'param_name'  => 'background_image',
                            'value'       => '',
                            'description' => ''
                        ),
                        array(
                            'type'        => 'textfield',
                            'class'       => '',
                            'heading'     => esc_html__('Padding', 'mikado-core'),
                            'param_name'  => 'item_padding',
                            'value'       => '',
                            'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'mikado-core')
                        ),
                        array(
                            'type'        => 'dropdown',
                            'class'       => '',
                            'heading'     => esc_html__('Horizontal Alignment', 'mikado-core'),
                            'param_name'  => 'horizontal_aligment',
                            'value'       => array(
                                esc_html__('Left', 'mikado-core')   => 'left',
                                esc_html__('Right', 'mikado-core')  => 'right',
                                esc_html__('Center', 'mikado-core') => 'center'
                            ),
                            'description' => ''
                        ),
                        array(
                            'type'        => 'dropdown',
                            'class'       => '',
                            'heading'     => esc_html__('Vertical Alignment', 'mikado-core'),
                            'param_name'  => 'vertical_alignment',
                            'value'       => array(
                                esc_html__('Middle', 'mikado-core') => 'middle',
                                esc_html__('Top', 'mikado-core')    => 'top',
                                esc_html__('Bottom', 'mikado-core') => 'bottom'
                            ),
                            'description' => ''
                        ),
                        array(
                            'type'        => 'dropdown',
                            'class'       => '',
                            'heading'     => esc_html__('Animation Name', 'mikado-core'),
                            'param_name'  => 'animation_name',
                            'value'       => array(
                                esc_html__('No Animation', 'mikado-core')          => '',
                                esc_html__('Flip In', 'mikado-core')               => 'flip-in',
                                esc_html__('Grow In', 'mikado-core')               => 'grow-in',
                                esc_html__('X Rotate', 'mikado-core')              => 'x-rotate',
                                esc_html__('Z Rotate', 'mikado-core')              => 'z-rotate',
                                esc_html__('Y Translate', 'mikado-core')           => 'y-translate',
                                esc_html__('Fade In', 'mikado-core')               => 'fade-in',
                                esc_html__('Fade In Up', 'mikado-core')            => 'fade-in-up',
                                esc_html__('Fade In Down', 'mikado-core')          => 'fade-in-down',
                                esc_html__('Fade In Left', 'mikado-core')          => 'fade-in-left',
                                esc_html__('Fade In Right', 'mikado-core')         => 'fade-in-right',
                                esc_html__('Fade In Left X Rotate', 'mikado-core') => 'fade-in-left-x-rotate'
                            ),
                            'description' => ''
                        ),
                        array(
                            'type'        => 'textfield',
                            'class'       => '',
                            'heading'     => esc_html__('Animation Delay (ms)', 'mikado-core'),
                            'param_name'  => 'animation_delay',
                            'value'       => '',
                            'description' => '',
                            'dependency'  => array('element' => 'animation_name', 'not_empty' => true)
                        ),
                        array(
                            'type'        => 'textfield',
                            'class'       => '',
                            'group'       => esc_html__('Width & Responsiveness', 'mikado-core'),
                            'heading'     => esc_html__('Padding on screen size between 1280px-1440px', 'mikado-core'),
                            'param_name'  => 'item_padding_1280_1440',
                            'value'       => '',
                            'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'mikado-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'class'       => '',
                            'group'       => esc_html__('Width & Responsiveness', 'mikado-core'),
                            'heading'     => esc_html__('Padding on screen size between 1024px-1280px', 'mikado-core'),
                            'param_name'  => 'item_padding_1024_1280',
                            'value'       => '',
                            'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'mikado-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'class'       => '',
                            'group'       => esc_html__('Width & Responsiveness', 'mikado-core'),
                            'heading'     => esc_html__('Padding on screen size between 768px-1024px', 'mikado-core'),
                            'param_name'  => 'item_padding_768_1024',
                            'value'       => '',
                            'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'mikado-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'class'       => '',
                            'group'       => esc_html__('Width & Responsiveness', 'mikado-core'),
                            'heading'     => esc_html__('Padding on screen size between 600px-768px', 'mikado-core'),
                            'param_name'  => 'item_padding_600_768',
                            'value'       => '',
                            'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'mikado-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'class'       => '',
                            'group'       => esc_html__('Width & Responsiveness', 'mikado-core'),
                            'heading'     => esc_html__('Padding on screen size between 480px-600px', 'mikado-core'),
                            'param_name'  => 'item_padding_480_600',
                            'value'       => '',
                            'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'mikado-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'class'       => '',
                            'group'       => esc_html__('Width & Responsiveness', 'mikado-core'),
                            'heading'     => esc_html__('Padding on Screen Size Bellow 480px', 'mikado-core'),
                            'param_name'  => 'item_padding_480',
                            'value'       => '',
                            'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'mikado-core')
                        )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'background_color'       => '',
            'background_image'       => '',
            'item_padding'           => '',
            'horizontal_aligment'    => 'left',
            'vertical_alignment'     => '',
            'animation_name'         => '',
            'animation_delay'        => '',
            'item_padding_1280_1440' => '',
            'item_padding_1024_1280' => '',
            'item_padding_768_1024'  => '',
            'item_padding_600_768'   => '',
            'item_padding_480_600'   => '',
            'item_padding_480'       => ''
        );

        $params = shortcode_atts($args, $atts);
        extract($params);
        $params['content'] = $content;

        $rand_class = 'mkd-elements-holder-custom-'.mt_rand(100000, 1000000);

        $params['elements_holder_item_style']              = $this->getElementsHolderItemStyle($params);
        $params['elements_holder_item_content_style']      = $this->getElementsHolderItemContentStyle($params);
        $params['elements_holder_item_class']              = $this->getElementsHolderItemClass($params);
        $params['elements_holder_item_content_class']      = $rand_class;
        $params['elements_holder_item_data']               = $this->getData($params);

        $html = mikado_core_get_core_shortcode_template_part('templates/elements-holder-item-template', 'elements-holder', '', $params);

        return $html;
    }


    /**
     * Return Elements Holder Item style
     *
     * @param $params
     *
     * @return array
     */
    private function getElementsHolderItemStyle($params) {

        $element_holder_item_style = array();

        if($params['background_color'] !== '') {
            $element_holder_item_style[] = 'background-color: '.$params['background_color'];
        }
        if($params['background_image'] !== '') {
            $element_holder_item_style[] = 'background-image: url('.wp_get_attachment_url($params['background_image']).')';
        }
        if($params['animation_delay'] !== '') {
            $element_holder_item_style[] = 'transition-delay:'.$params['animation_delay'].'ms;'.'-webkit-transition-delay:'.$params['animation_delay'].'ms';
        }

        return implode(';', $element_holder_item_style);

    }

    /**
     * Return Elements Holder Item Content style
     *
     * @param $params
     *
     * @return array
     */
    private function getElementsHolderItemContentStyle($params) {

        $element_holder_item_content_style = array();

        if($params['item_padding'] !== '') {
            $element_holder_item_content_style[] = 'padding: '.$params['item_padding'];
        }

        return implode(';', $element_holder_item_content_style);

    }

    /**
     * Return Elements Holder Item classes
     *
     * @param $params
     *
     * @return array
     */
    private function getElementsHolderItemClass($params) {

        $element_holder_item_class = array();

        if($params['vertical_alignment'] !== '') {
            $element_holder_item_class[] = 'mkd-vertical-alignment-'.$params['vertical_alignment'];
        }

        if($params['horizontal_aligment'] !== '') {
            $element_holder_item_class[] = 'mkd-horizontal-alignment-'.$params['horizontal_aligment'];
        }

        if($params['animation_name'] !== '') {
            $element_holder_item_class[] = 'mkd-'.$params['animation_name'];
        }


        return implode(' ', $element_holder_item_class);

    }

	private function getData($params) {
		$data = array();

		if($params['animation_name'] !== '') {
			$data['data-animation'] = 'mkd-'.$params['animation_name'];
		}

		if ($params['animation_name'] !== '') {
			$data['data-animation'] = 'mkd-' . $params['animation_name'];
		}

		$data['data-item-class'] = $params['elements_holder_item_content_class'];

		if ($params['item_padding_1280_1440'] !== '') {
			$data['data-1280-1440'] = $params['item_padding_1280_1440'];
		}

		if ($params['item_padding_1024_1280'] !== '') {
			$data['data-1024-1280'] = $params['item_padding_1024_1280'];
		}

		if ($params['item_padding_768_1024'] !== '') {
			$data['data-768-1024'] = $params['item_padding_768_1024'];
		}

		if ($params['item_padding_600_768'] !== '') {
			$data['data-600-768'] = $params['item_padding_600_768'];
		}

		if ($params['item_padding_480_600'] !== '') {
			$data['data-480-600'] = $params['item_padding_480_600'];
		}

		if ($params['item_padding_480'] !== '') {
			$data['data-480'] = $params['item_padding_480'];
		}

		return $data;
	}
}
