<?php

class AnahataMikadoCallToActionButton extends AnahataMikadoWidget {
    public function __construct() {
        parent::__construct(
            'mkd_call_to_action_button', // Base ID
            esc_html__('Mikado Call To Action Button', 'mikado-core') // Name
        );

        $this->setParams();
    }

    protected function setParams() {

        $this->params = array_merge(
            anahata_mikado_icon_collections()->getWidgetIconParams(),
            array(
                array(
                    'type'        => 'textfield',
                    'title'       => esc_html__('Button Text', 'mikado-core'),
                    'name'        => 'button_text',
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'title'       => esc_html__('Link', 'mikado-core'),
                    'name'        => 'link',
                    'description' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'title'       => esc_html__('Link Target', 'mikado-core'),
                    'name'        => 'link_target',
                    'options'     => array(
                        '_self'  => esc_html__('Same Window', 'mikado-core'),
                        '_blank' => esc_html__('New Window', 'mikado-core')
                    ),
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'title'       => esc_html__('Text Color', 'mikado-core'),
                    'name'        => 'text_color',
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'title'       => esc_html__('Background Color', 'mikado-core'),
                    'name'        => 'background_color',
                    'description' => ''
                )
            )
        );

    }

    public function widget($args, $instance) {
		echo anahata_mikado_get_module_part($args['before_widget']);

        $iconPack = $instance['icon_pack'];
        $iconHtml = '';

        if($iconPack !== '') {
            $iconPackName = anahata_mikado_icon_collections()->getIconCollectionParamNameByKey($iconPack);
            $icon         = $instance[$iconPackName];

            $iconHtml = anahata_mikado_icon_collections()->renderIcon($icon, $iconPack);
        }

        $buttonStyles = array();

        if($instance['background_color'] !== '') {
            $buttonStyles[] = 'background-color: '.$instance['background_color'];
        }

        if($instance['text_color'] !== '') {
            $buttonStyles[] = 'color: '.$instance['text_color'];
        }

        ?>

        <?php if($instance['link'] !== '' && $instance['button_text'] !== '') : ?>
            <a <?php anahata_mikado_inline_style($buttonStyles); ?> class="mkd-call-to-action-button" target="<?php echo esc_attr($instance['link_target']); ?>" href="<?php echo esc_url($instance['link']) ?>">
				<span class="mkd-ctab-holder">
					<?php if($iconHtml !== '') : ?>
                        <span class="mkd-ctab-icon">
							<?php echo anahata_mikado_get_module_part($iconHtml); ?>
						</span>
                    <?php endif; ?>
                    <?php echo esc_html($instance['button_text']); ?>
				</span>
            </a>
        <?php endif; ?>

        <?php echo anahata_mikado_get_module_part($args['after_widget']);
    }
}