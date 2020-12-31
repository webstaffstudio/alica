<?php
namespace Anahata\Modules\Shortcodes\EventsList;

use Anahata\Modules\Events\Lib\EventsQuery;
use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class EventsList implements ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_events_list';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
                'name'                      => esc_html__('Mikado Events List', 'mikado-core'),
                'base'                      => $this->getBase(),
                'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
                'icon'                      => 'icon-wpb-events extended-custom-icon',
                'allowed_container_element' => 'vc_row',
                'params'                    => array_merge(
                    array(
                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__('Number of Columns', 'mikado-core'),
                            'param_name'  => 'columns',
                            'value'       => array(
                                ''                             => '',
                                esc_html__('One', 'mikado-core')   => 'one',
                                esc_html__('Two', 'mikado-core')   => 'two',
                                esc_html__('Three', 'mikado-core') => 'three',
                                esc_html__('Four', 'mikado-core')  => 'four',
                                esc_html__('Five', 'mikado-core')  => 'five',
                                esc_html__('Six', 'mikado-core')   => 'six'
                            ),
                            'admin_label' => true,
                            'description' => esc_html__('Default value is Three', 'mikado-core'),
                            'group'       => esc_html__('Layout Options', 'mikado-core')
                        ),
                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__('Image Proportions', 'mikado-core'),
                            'param_name'  => 'image_size',
                            'value'       => array(
                                esc_html__('Original', 'mikado-core')  => 'full',
                                esc_html__('Square', 'mikado-core')    => 'square',
                                esc_html__('Landscape', 'mikado-core') => 'landscape',
                                esc_html__('Portrait', 'mikado-core')  => 'portrait'
                            ),
                            'save_always' => true,
                            'admin_label' => true,
                            'description' => '',
                            'group'       => esc_html__('Layout Options', 'mikado-core')
                        ),
                    ),
                    EventsQuery::getInstance()->queryVCParams()
                )
            )
        );
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'columns'    => '',
            'image_size' => ''
        );

        $eventsQuery = EventsQuery::getInstance();

        $default_atts = array_merge($default_atts, $eventsQuery->getShortcodeAtts());
        $params       = shortcode_atts($default_atts, $atts);

        $queryResults = $eventsQuery->buildQueryObject($params);

        $params['query']  = $queryResults;
        $params['caller'] = $this;

        $itemClass[] = 'mkd-events-list-item';

        switch($params['columns']) {
            case 'one':
                $itemClass[] = 'mkd-grid-col-12';
                break;
            case 'two':
                $itemClass[] = 'mkd-grid-col-6';
                break;
            case 'three':
                $itemClass[] = 'mkd-grid-col-4';
                break;
            case 'four':
                $itemClass[] = 'mkd-grid-col-3';
                $itemClass[] = 'mkd-grid-col-ipad-landscape-6';
                $itemClass[] = 'mkd-grid-col-ipad-portrait-12';
                break;
            default:
                $itemClass[] = 'mkd-grid-col-4';
                break;
        }

        $params['item_class'] = implode(' ', $itemClass);

        $params['image_size'] = $this->getImageSize($params);

        return mikado_core_get_core_shortcode_template_part('templates/events-list-holder', 'events-list', '', $params);
    }

    public function getEventItemTemplate($params) {
        echo mikado_core_get_core_shortcode_template_part('templates/events-list-item', 'events-list', '', $params);
    }

    private function getImageSize($params) {

        if(!empty($params['image_size'])) {
            $image_size = $params['image_size'];

            switch($image_size) {
                case 'landscape':
                    $thumb_size = 'anahata_mikado_landscape';
                    break;
                case 'portrait':
                    $thumb_size = 'anahata_mikado_portrait';
                    break;
                case 'square':
                    $thumb_size = 'anahata_mikado_square';
                    break;
                case 'full':
                    $thumb_size = 'full';
                    break;
                case 'custom':
                    $thumb_size = 'custom';
                    break;
                default:
                    $thumb_size = 'full';
                    break;
            }

            return $thumb_size;
        }
    }
}