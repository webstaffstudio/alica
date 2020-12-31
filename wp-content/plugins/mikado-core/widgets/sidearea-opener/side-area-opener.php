<?php

class AnahataMikadoSideAreaOpener extends AnahataMikadoWidget {
    public function __construct() {
        parent::__construct(
            'mkd_side_area_opener', // Base ID
            esc_html__('Mikado Side Area Opener', 'mikado-core') // Name
        );

        $this->setParams();
    }

    protected function setParams() {

        $this->params = array(
            array(
                'name'        => 'side_area_opener_icon_color',
                'type'        => 'textfield',
                'title'       => esc_html__('Icon Color', 'mikado-core'),
                'description' => esc_html__('Define color for Side Area opener icon', 'mikado-core')
            )
        );

    }


    public function widget($args, $instance) {

        $sidearea_icon_styles = array();

        if(!empty($instance['side_area_opener_icon_color'])) {
            $sidearea_icon_styles[] = 'color: '.$instance['side_area_opener_icon_color'];
        }

		echo anahata_mikado_get_module_part($args['before_widget']);

        $icon_size = '';
        if(anahata_mikado_options()->getOptionValue('side_area_predefined_icon_size')) {
            $icon_size = anahata_mikado_options()->getOptionValue('side_area_predefined_icon_size');
        }

        $default_sidearea_opener = anahata_mikado_options()->getOptionValue('side_area_enable_default_opener') === 'yes';

        $default_sidearea_opener_class = $default_sidearea_opener ? 'mkd-side-menu-button-opener-default' : '';

        ?>
        <a class="mkd-side-menu-button-opener <?php echo esc_attr($icon_size.' '.$default_sidearea_opener_class); ?>" <?php anahata_mikado_inline_style($sidearea_icon_styles) ?> href="javascript:void(0)">
            <?php echo anahata_mikado_get_side_menu_icon_html(); ?>
        </a>

        <?php echo anahata_mikado_get_module_part($args['after_widget']); ?>

    <?php }

}