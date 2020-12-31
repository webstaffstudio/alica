<?php
namespace Anahata\Modules\OrderedList;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class OrderedList implements ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'mkd_list_ordered';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {

		vc_map(array(
			'name'                      => esc_html__('List - Ordered', 'mikado-core'),
			'base'                      => $this->base,
			'icon'                      => 'icon-wpb-ordered-list extended-custom-icon',
			'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'textarea_html',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => esc_html__('Content', 'mikado-core'),
					'param_name'  => 'content',
					'value'       => '<ol><li>Lorem Ipsum</li><li>Lorem Ipsum</li><li>Lorem Ipsum</li></ol>',
					'description' => ''
				)
			)
		));

	}

	public function render($atts, $content = null) {
		$html = '';
		$html .= '<div class= "mkd-ordered-list" >'.anahata_mikado_remove_auto_ptag($content, true).'</div>';

		return $html;
	}

}

