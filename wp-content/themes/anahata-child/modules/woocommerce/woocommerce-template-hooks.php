<?php

if(!function_exists('anahata_mikado_woocommerce_products_per_page')) {
    /**
     * Function that sets number of products per page. Default is 12
     * @return int number of products to be shown per page
     */
    function anahata_mikado_woocommerce_products_per_page() {

        $products_per_page = 12;

        if(anahata_mikado_options()->getOptionValue('mkd_woo_products_per_page')) {
            $products_per_page = anahata_mikado_options()->getOptionValue('mkd_woo_products_per_page');
        }

        return $products_per_page;

    }

}

if(!function_exists('anahata_mikado_alter_woo_pagination')) {
    function anahata_mikado_alter_woo_pagination($args) {
        $args['prev_text'] = '<span class="mkd-left">'.esc_html__('Previous', 'anahata').'</span>';
        $args['next_text'] = '<span class="mkd-right">'.esc_html__('Next', 'anahata').'</span>';

        return $args;
    }
}

if(!function_exists('anahata_mikado_woocommerce_cart_categories')) {
    function anahata_mikado_woocommerce_cart_categories($product_item, $cart_item, $cart_item_key) {
	    $product_id = $cart_item['product_id'];
	    $categories = wp_get_post_terms($product_id, 'product_cat');
	
	    echo '<span class="mkd-woo-title">' . $cart_item['data']->get_title() . '</span>';
	    if(!empty($categories)) {
		    foreach ($categories as $cat) {
			    echo '<a href="'.esc_url(get_term_link($cat->term_id)).'">'.esc_html($cat->name).'</a>';
		    }
	    }
    }
}


if(!function_exists('anahata_mikado_woocommerce_related_products_args')) {
    /**
     * Function that sets number of displayed related products. Hooks to woocommerce_output_related_products_args filter
     *
     * @param $args array array of args for the query
     *
     * @return mixed array of changed args
     */
    function anahata_mikado_woocommerce_related_products_args($args) {

        if(anahata_mikado_options()->getOptionValue('mkd_woo_product_list_columns')) {

            $related = anahata_mikado_options()->getOptionValue('mkd_woo_product_list_columns');
            switch($related) {
                case 'mkd-woocommerce-columns-4':
                    $args['posts_per_page'] = 4;
                    break;
                case 'mkd-woocommerce-columns-3':
                    $args['posts_per_page'] = 3;
                    break;
                default:
                    $args['posts_per_page'] = 3;
            }

        } else {
            $args['posts_per_page'] = 3;
        }

        return $args;

    }

}

if(!function_exists('anahata_mikado_woocommerce_template_loop_product_title')) {
    /**
     * Function for overriding product title template in Product List Loop
     */
    function anahata_mikado_woocommerce_template_loop_product_title() {

        $tag = anahata_mikado_options()->getOptionValue('mkd_products_list_title_tag');
        the_title('<'.$tag.' class="mkd-product-list-product-title">', '</'.$tag.'>');

    }

}

if(!function_exists('anahata_mikado_woocommerce_template_single_title')) {
    /**
     * Function for overriding product title template in Single Product template
     */
    function anahata_mikado_woocommerce_template_single_title() {

        $tag = anahata_mikado_options()->getOptionValue('mkd_single_product_title_tag');
        the_title('<'.$tag.'  itemprop="name" class="mkd-single-product-title">', '</'.$tag.'>');

    }

}

if(!function_exists('anahata_mikado_woocommerce_sale_flash')) {
    /**
     * Function for overriding Sale Flash Template
     *
     * @return string
     */
    function anahata_mikado_woocommerce_sale_flash() {

        return '<span class="mkd-onsale"><span class="mkd-onsale-inner">'.esc_html__('Sale', 'anahata').'</span></span>';

    }

}

if(!function_exists('anahata_mikado_custom_override_checkout_fields')) {
    /**
     * Overrides placeholder values for checkout fields
     *
     * @param array all checkout fields
     *
     * @return array checkout fields with overriden values
     */
    function anahata_mikado_custom_override_checkout_fields($fields) {
        //billing fields
        $args_billing = array(
            'first_name' => esc_html__('First name', 'anahata'),
            'last_name'  => esc_html__('Last name', 'anahata'),
            'company'    => esc_html__('Company name', 'anahata'),
            'address_1'  => esc_html__('Address', 'anahata'),
            'email'      => esc_html__('Email', 'anahata'),
            'phone'      => esc_html__('Phone', 'anahata'),
            'postcode'   => esc_html__('Postcode / ZIP', 'anahata'),
            'state'      => esc_html__('State / County', 'anahata')
        );

        //shipping fields
        $args_shipping = array(
            'first_name' => esc_html__('First name', 'anahata'),
            'last_name'  => esc_html__('Last name', 'anahata'),
            'company'    => esc_html__('Company name', 'anahata'),
            'address_1'  => esc_html__('Address', 'anahata'),
            'postcode'   => esc_html__('Postcode / ZIP', 'anahata')
        );

        //override billing placeholder values
        foreach($args_billing as $key => $value) {
            $fields["billing"]["billing_{$key}"]["placeholder"] = $value;
        }

        //override shipping placeholder values
        foreach($args_shipping as $key => $value) {
            $fields["shipping"]["shipping_{$key}"]["placeholder"] = $value;
        }

        return $fields;
    }

}

if(!function_exists('anahata_mikado_woocommerce_loop_add_to_cart_link')) {
    /**
     * Function that overrides default woocommerce add to cart button on product list
     * Uses HTML from mkd_button
     *
     * @return mixed|string
     */
    function anahata_mikado_woocommerce_loop_add_to_cart_link() {

        global $product;

        $button_url     = $product->add_to_cart_url();
        $button_classes = sprintf('%s %s product_type_%s',
            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
            $product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '',
            esc_attr($product->get_type())
        );
        $button_text    = $product->add_to_cart_text();
        $button_attrs   = array(
            'rel'              => 'nofollow',
            'data-product_id'  => esc_attr($product->get_id()),
            'data-product_sku' => esc_attr($product->get_sku()),
            'data-quantity'    => esc_attr(isset($quantity) ? $quantity : 1)
        );


        if(anahata_mikado_core_installed()) {
			$add_to_cart_button = anahata_mikado_get_button_html(
				array(
					'link' => $button_url,
					'custom_class' => $button_classes,
					'text' => $button_text,
					'custom_attrs' => $button_attrs,
					'type' => 'solid'
				)
			);
		} else {
        	$add_to_cart_button = '<a href="'.esc_url($button_url).'" class="mkd-btn mkd-btn-medium mkd-btn-solid mkd-btn-hover-lighten '.esc_attr($button_classes).'" '.anahata_mikado_get_inline_attrs($button_attrs).'>
										<span class="mkd-btn-text">'.esc_html($button_text).'</span>
										<span class="mkd-btn-overlay"></span>
									</a>';
		}

        return $add_to_cart_button;

    }

}

if(!function_exists('anahata_mikado_get_woocommerce_add_to_cart_button')) {
    /**
     * Function that overrides default woocommerce add to cart button on simple and grouped product single template
     * Uses HTML from mkd_button
     */
    function anahata_mikado_get_woocommerce_add_to_cart_button() {
        global $product;

        if(anahata_mikado_core_installed()) {
			$add_to_cart_button = anahata_mikado_get_button_html(
				array(
					'custom_class' => 'single_add_to_cart_button button alt',
					'text' => $product->single_add_to_cart_text(),
					'html_type' => 'button',
					'icon_pack' => 'font_elegant',
					'fe_icon' => 'icon_bag_alt',
					'text_transform' => 'none',
					'type' => 'solid',
					'custom_attrs' => array('name' => 'add-to-cart', 'value' => esc_attr($product->get_id()))
				)
			);
		} else {
			$add_to_cart_button = '<button type="submit" class="mkd-btn mkd-btn-medium mkd-btn-solid mkd-btn-icon single_add_to_cart_button button alt mkd-btn-hover-lighten" name="add-to-cart" value="'.esc_attr($product->get_id()).'">	
										<span class="mkd-btn-text">'.esc_html($product->single_add_to_cart_text()).'</span>	
										<span class="mkd-btn-overlay"></span>			
										<span class="mkd-btn-icon-holder">			
											<span aria-hidden="true" class="mkd-icon-font-elegant icon_bag_alt mkd-btn-icon-elem"></span>		
										</span>	
									</button>';
		}

		echo anahata_mikado_get_module_part($add_to_cart_button);
    }
}

if(!function_exists('anahata_mikado_get_woocommerce_add_to_cart_button_external')) {
    /**
     * Function that overrides default woocommerce add to cart button on external product single template
     * Uses HTML from mkd_button
     */
    function anahata_mikado_get_woocommerce_add_to_cart_button_external() {

        global $product;

        if(anahata_mikado_core_installed()) {
			$add_to_cart_button = anahata_mikado_get_button_html(
				array(
					'link' => $product->add_to_cart_url(),
					'custom_class' => 'single_add_to_cart_button button alt',
					'text' => $product->single_add_to_cart_text(),
					'custom_attrs' => array(
						'rel' => 'nofollow'
					),
					'icon_pack' => 'font_elegant',
					'fe_icon' => 'icon_bag_alt',
					'text_transform' => 'none',
					'type' => 'solid'
				)
			);
		} else {
        	$add_to_cart_button = '<a href="'.esc_url($product->add_to_cart_url()).'" class="mkd-btn mkd-btn-medium mkd-btn-solid mkd-btn-icon single_add_to_cart_button button alt mkd-btn-hover-lighten" rel="nofollow">
										<span class="mkd-btn-text">'.esc_html($product->single_add_to_cart_text()).'</span>	
										<span class="mkd-btn-overlay"></span>			
										<span class="mkd-btn-icon-holder">			
											<span aria-hidden="true" class="mkd-icon-font-elegant icon_bag_alt mkd-btn-icon-elem"></span>		
										</span>	
									</a>';
		}

		echo anahata_mikado_get_module_part($add_to_cart_button);
    }
}

if(!function_exists('anahata_mikado_woocommerce_single_variation_add_to_cart_button')) {
    /**
     * Function that overrides default woocommerce add to cart button on variable product single template
     * Uses HTML from mkd_button
     */
    function anahata_mikado_woocommerce_single_variation_add_to_cart_button() {
        global $product;

        $html = '<div class="variations_button">';
        woocommerce_quantity_input(array('input_value' => isset($_POST['quantity']) ? wc_stock_amount($_POST['quantity']) : 1));

        if(anahata_mikado_core_installed()) {
			$button = anahata_mikado_get_button_html(array(
				'html_type' => 'button',
				'custom_class' => 'single_add_to_cart_button button alt',
				'text' => $product->single_add_to_cart_text(),
				'icon_pack' => 'font_elegant',
				'fe_icon' => 'icon_bag_alt',
				'text_transform' => 'none',
				'type' => 'solid'
			));
		} else {
			$button = '<button type="submit" class="mkd-btn mkd-btn-medium mkd-btn-solid mkd-btn-icon single_add_to_cart_button button alt mkd-btn-hover-lighten" rel="nofollow">
							<span class="mkd-btn-text">'.esc_html($product->single_add_to_cart_text()).'</span>	
							<span class="mkd-btn-overlay"></span>			
							<span class="mkd-btn-icon-holder">			
								<span aria-hidden="true" class="mkd-icon-font-elegant icon_bag_alt mkd-btn-icon-elem"></span>		
							</span>	
						</button>';
		}

        $html .= $button;
	    
        $html .= '<input type="hidden" name="add-to-cart" value="'.absint($product->get_id()).'" />';
        $html .= '<input type="hidden" name="product_id" value="'.absint( $product->get_id() ).'" />';
        $html .= '<input type="hidden" name="variation_id" class="variation_id" value="0" />';
        $html .= '</div>';

		echo anahata_mikado_get_module_part($html);

    }

}

if(!function_exists('anahata_mikado_get_woocommerce_apply_coupon_button')) {
    /**
     * Function that overrides default woocommerce apply coupon button
     * Uses HTML from mkd_button
     */
    function anahata_mikado_get_woocommerce_apply_coupon_button() {

    	if(anahata_mikado_core_installed()) {
			$coupon_button = anahata_mikado_get_button_html(array(
				'html_type' => 'input',
				'input_name' => 'apply_coupon',
				'text' => esc_html__('Apply Coupon', 'anahata')
			));
		} else {
    		$coupon_button = '<input type="submit" class="mkd-btn mkd-btn-medium mkd-btn-solid mkd-btn-hover-lighten" name="apply_coupon" value="'.esc_html__('Apply Coupon', 'anahata').'"/>';
		}

		echo anahata_mikado_get_module_part($coupon_button);

    }

}

if(!function_exists('anahata_mikado_get_woocommerce_update_cart_button')) {
    /**
     * Function that overrides default woocommerce update cart button
     * Uses HTML from mkd_button
     */
    function anahata_mikado_get_woocommerce_update_cart_button() {

    	if(anahata_mikado_core_installed()) {
			$update_cart_button = anahata_mikado_get_button_html(array(
				'html_type' => 'input',
				'input_name' => 'update_cart',
				'text' => esc_html__('Update Cart', 'anahata'),
				'type' => 'solid'
			));
		} else {
    		$update_cart_button = '<input type="submit" name="update_cart" value="'.esc_html__('Update Cart', 'anahata').'" class="mkd-btn mkd-btn-medium mkd-btn-solid mkd-btn-hover-lighten" disabled="">';
		}

		echo anahata_mikado_get_module_part($update_cart_button);

    }

}

if(!function_exists('anahata_mikado_woocommerce_button_proceed_to_checkout')) {
    /**
     * Function that overrides default woocommerce proceed to checkout button
     * Uses HTML from mkd_button
     */
    function anahata_mikado_woocommerce_button_proceed_to_checkout() {

    	if(anahata_mikado_core_installed()) {
			$proceed_to_checkout_button = anahata_mikado_get_button_html(array(
				'link' => wc_get_checkout_url(),
				'custom_class' => 'checkout-button alt wc-forward',
				'text' => esc_html__('Proceed to Checkout', 'anahata')
			));
		} else {
    		$proceed_to_checkout_button = '<a href="'.esc_url(wc_get_checkout_url()).'" target="_self" class="mkd-btn mkd-btn-medium mkd-btn-solid checkout-button alt wc-forward mkd-btn-hover-lighten">	
												<span class="mkd-btn-text">'.esc_html__('Proceed to Checkout', 'anahata').'</span>	
												<span class="mkd-btn-overlay"></span>	
											</a>';
		}

		echo anahata_mikado_get_module_part($proceed_to_checkout_button);
    }
}

if(!function_exists('anahata_mikado_get_woocommerce_update_totals_button')) {
    /**
     * Function that overrides default woocommerce update totals button
     * Uses HTML from mkd_button
     */
    function anahata_mikado_get_woocommerce_update_totals_button() {

    	if(anahata_mikado_core_installed()) {
			$update_totals_button = anahata_mikado_get_button_html(array(
				'html_type' => 'button',
				'text' => esc_html__('Update Totals', 'anahata'),
				'custom_attrs' => array(
					'value' => 1,
					'name' => 'calc_shipping'
				)
			));
		} else {
    		$update_totals_button = '<button type="submit" class="mkd-btn mkd-btn-medium mkd-btn-solid mkd-btn-hover-lighten" value="1" name="calc_shipping">	
										<span class="mkd-btn-text">'.esc_html__('Update Totals', 'anahata').'</span>	
										<span class="mkd-btn-overlay"></span>	
									</button>';
		}

		echo anahata_mikado_get_module_part($update_totals_button);

    }

}

if(!function_exists('anahata_mikado_woocommerce_pay_order_button_html')) {
    /**
     * Function that overrides default woocommerce pay order button on checkout page
     * Uses HTML from mkd_button
     */
    function anahata_mikado_woocommerce_pay_order_button_html() {

        $pay_order_button_text = esc_html__('Pay for order', 'anahata');

        if(anahata_mikado_core_installed()) {
			$place_order_button = anahata_mikado_get_button_html(array(
				'html_type' => 'input',
				'custom_class' => 'alt',
				'custom_attrs' => array(
					'id' => 'place_order',
					'data-value' => $pay_order_button_text
				),
				'text' => $pay_order_button_text,
			));
		} else {
        	$place_order_button = '<input type="submit" name="" value="'.esc_attr($pay_order_button_text).'" class="mkd-btn mkd-btn-medium mkd-btn-solid alt mkd-btn-hover-lighten" id="place_order" data-value="'.esc_attr($pay_order_button_text).'">';
		}

        return $place_order_button;

    }

}

if(!function_exists('anahata_mikado_woocommerce_order_button_html')) {
    /**
     * Function that overrides default woocommerce place order button on checkout page
     * Uses HTML from mkd_button
     */
    function anahata_mikado_woocommerce_order_button_html() {

        $pay_order_button_text = esc_html__('Place Order', 'anahata');

        if(anahata_mikado_core_installed()) {
			$place_order_button = anahata_mikado_get_button_html(array(
				'html_type' => 'input',
				'custom_class' => 'alt',
				'custom_attrs' => array(
					'id' => 'place_order',
					'data-value' => $pay_order_button_text,
					'name' => 'woocommerce_checkout_place_order'
				),
				'text' => $pay_order_button_text,
			));
		} else {
        	$place_order_button = '<input type="submit" name="woocommerce_checkout_place_order" value="'.esc_attr($pay_order_button_text).'" class="mkd-btn mkd-btn-medium mkd-btn-solid alt mkd-btn-hover-lighten" id="place_order" data-value="'.esc_attr($pay_order_button_text).'">';
		}

        return $place_order_button;

    }

}

if(!function_exists('anahata_mikado_product_hover_image')) {
    /**
     *
     */
    function anahata_mikado_product_hover_image() {
        $ids = anahata_mikado_get_product_gallery_ids();

        if(!is_array($ids) || count($ids) === 0) {
            return;
        }

        $first_id = array_shift($ids);

        echo wp_get_attachment_image($first_id, 'shop_catalog');
    }
}

if(!function_exists('anahata_mikado_woocommerce_stock_html')) {
    function anahata_mikado_woocommerce_stock_html($availability_html, $availability = false, $product = null) {
        return '<td class="stock">'.$availability_html.'</td>';
    }
}