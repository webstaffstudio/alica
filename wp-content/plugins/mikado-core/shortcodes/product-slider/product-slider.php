<?php

namespace Anahata\Modules\Shortcodes\ProductSlider;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class ProductSlider implements ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_product_slider';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Product Slider', 'mikado-core'),
            'base'                      => $this->base,
            'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
            'icon'                      => 'icon-wpb-product-slider extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    "type"        => "dropdown",
                    "class"       => "",
                    "heading"     => esc_html__('Product type', 'mikado-core'),
                    "param_name"  => "product_type",
                    "value"       => array(
                        esc_html__('Recent Products', 'mikado-core')      => 'recent_products',
                        esc_html__('Featured Products', 'mikado-core')    => 'featured_products',
                        esc_html__('Products By Id', 'mikado-core')       => 'products',
                        esc_html__('Products By Category', 'mikado-core') => 'product_category',
                        esc_html__('Products On Sale', 'mikado-core')     => 'sale_products',
                        esc_html__('Best Selling', 'mikado-core')         => 'best_selling_products',
                        esc_html__('Top Rated', 'mikado-core')            => 'top_rated_products'
                    ),
                    "save_always" => true,
                    "description" => '',
                    'admin_label' => true
                ),
                array(
                    "type"        => "dropdown",
                    "class"       => "",
                    "heading"     => esc_html__('Order By', 'mikado-core'),
                    "param_name"  => "order_by",
                    "value"       => array(
                        ''                                     => '',
                        esc_html__('Date', 'mikado-core')          => 'date',
                        esc_html__('ID', 'mikado-core')            => 'id',
                        esc_html__('Author', 'mikado-core')        => 'author',
                        esc_html__('Title', 'mikado-core')         => 'title',
                        esc_html__('Modified', 'mikado-core')      => 'modified',
                        esc_html__('Random', 'mikado-core')        => 'rand',
                        esc_html__('Comment count', 'mikado-core') => 'comment_count',
                        esc_html__('Menu order', 'mikado-core')    => 'menu_order'
                    ),
                    "description" => "",
                    'admin_label' => true,
                    "dependency"  => array(
                        'element' => "product_type",
                        'value'   => array(
                            "recent_products",
                            "featured_products",
                            "product_category",
                            "sale_products",
                            "top_rated_products"
                        )
                    )
                ),
                array(
                    "type"        => "dropdown",
                    "class"       => "",
                    "heading"     => esc_html__('Padding between product items', 'mikado-core'),
                    "param_name"  => "padding_between",
                    "value"       => array(
                        esc_html__('No', 'mikado-core')  => 'no',
                        esc_html__('Yes', 'mikado-core') => 'yes'
                    ),
                    "save_always" => true,
                    'admin_label' => true,
                    "description" => ''
                ),
                array(
                    "type"        => "dropdown",
                    "class"       => "",
                    "heading"     => esc_html__('Order', 'mikado-core'),
                    "param_name"  => "order",
                    "value"       => array(
                        ''                            => '',
                        esc_html__('ASC', 'mikado-core')  => 'ASC',
                        esc_html__('DESC', 'mikado-core') => 'DESC',
                    ),
                    "description" => "",
                    'admin_label' => true,
                    "dependency"  => array(
                        'element' => "product_type",
                        'value'   => array(
                            "recent_products",
                            "featured_products",
                            "products",
                            "product_category",
                            "sale_products",
                            "top_rated_products"
                        )
                    )
                ),
                array(
                    "type"        => "textfield",
                    "class"       => "",
                    "heading"     => esc_html__('Number', 'mikado-core'),
                    "param_name"  => "number",
                    "value"       => "-1",
                    "save_value"  => true,
                    'admin_label' => true,
                    "description" => esc_html__('Number of product on page (-1 is all)', 'mikado-core')
                ),
                array(
                    "type"       => "checkbox",
                    "class"      => "",
                    "heading"    => esc_html__('Prev/Next navigation', 'mikado-core'),
                    "value"      => array("Enable prev/next navigation?" => "yes"),
                    "param_name" => "enable_navigation"
                ),
                array(
                    "type"       => "checkbox",
                    "class"      => "",
                    "heading"    => esc_html__('Bullets navigation', 'mikado-core'),
                    "value"      => array("Show bullets navigation?" => "yes"),
                    "param_name" => "pager_navigation"
                ),
                array(
                    "type"        => "textfield",
                    "class"       => "",
                    "heading"     => esc_html__('Products', 'mikado-core'),
                    "param_name"  => "ids",
                    "value"       => "",
                    "description" => esc_html__('Delimit ID numbers by comma', 'mikado-core'),
                    "dependency"  => array('element' => "product_type", 'value' => array("products"))
                ),
                array(
                    "type"        => "textfield",
                    "class"       => "",
                    "heading"     => esc_html__('Category', 'mikado-core'),
                    "param_name"  => "category",
                    "value"       => "",
                    "description" => esc_html__('Delimit category slugs by comma', 'mikado-core'),
                    'admin_label' => true,
                    "dependency"  => array('element' => "product_type", 'value' => array("product_category"))
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            "product_type"      => "recent_products",
            "padding_between"   => "no",
            "order_by"          => "date",
            "order"             => "ASC",
            "number"            => "-1",
            "enable_navigation" => "",
            "pager_navigation"  => "",
            "ids"               => "",
            "category"          => ""
        );
        $params       = shortcode_atts($default_atts, $atts);

        $params['product_slider_param_array'] = $this->getSliderParamArray($params);
        $params['additional_classes']         = $this->getAddtionalClasses($params);
        $params['data_attribute']             = $this->getDataAttribute($params);

        return mikado_core_get_core_shortcode_template_part('templates/product-slider-template', 'product-slider', '', $params);
    }

    /**
     * Return Product Param Array
     *
     * @param $params
     *
     * @return array
     */
    private function getSliderParamArray($params) {
        $product_slider_param_array = array();

        if(($params['product_type'] != 'products' && $params['product_type'] != 'best_selling_products') && $params['order_by'] !== '') {
            $product_slider_param_array[] = "orderby='".$params['order_by']."'";
        }
        if($params['product_type'] != 'best_selling_products' && $params['order_by'] !== '') {
            $product_slider_param_array[] = "order='".$params['order']."'";
        }
        if($params['order_by'] !== '') {
            $product_slider_param_array[] = "per_page='".$params['number']."'";
        }
        if($params['product_type'] == 'products' && $params['ids'] !== '') {
            $product_slider_param_array[] = "ids='".$params['ids']."'";
        }
        if($params['product_type'] == 'product_category' && $params['category'] !== '') {
            $product_slider_param_array[] = "category='".$params['category']."'";
        }

        return $product_slider_param_array;
    }

    /**
     * Return Product Slider holder calsses
     *
     * @param $params
     *
     * @return string
     */
    private function getAddtionalClasses($params) {
        $additional_classes = '';

        if($params['padding_between'] == 'yes') {
            $additional_classes .= " with-padding";
        }


        $additional_classes .= " mkd-product-3";


        return $additional_classes;
    }

    /**
     * Return Product Slider data attribute
     *
     * @param $params
     *
     * @return string
     */
    private function getDataAttribute($params) {
        $data_attribute = '';


        $data_attribute .= " data-products_shown=3";


        return $data_attribute;
    }
}

