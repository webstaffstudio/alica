<?php
namespace MikadoCore\CPT\Portfolio\Shortcodes;

use MikadoCore\Lib;
use MikadoCore\CPT\Portfolio\Lib as PortfolioLib;

/**
 * Class PortfolioList
 * @package MikadoCore\CPT\Portfolio\Shortcodes
 */
class PortfolioList implements Lib\ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    /**
     * PortfolioList constructor.
     */
    public function __construct() {
        $this->base = 'mkd_portfolio_list';

        add_action('vc_before_init', array($this, 'vcMap'));

        add_action('wp_ajax_nopriv_mkd_core_portfolio_ajax_load_more', array($this, 'loadMorePortfolios'));
        add_action('wp_ajax_mkd_core_portfolio_ajax_load_more', array($this, 'loadMorePortfolios'));
    }


    /**
     * Loads portfolios via AJAX
     */
    public function loadMorePortfolios() {
        $shortcodeParams = $this->getShortcodeParamsFromPost();

        $html           = '';
        $portfolioQuery = PortfolioLib\PortfolioQuery::getInstance();
        $queryResults   = $portfolioQuery->buildQueryObject($shortcodeParams);

        if($shortcodeParams['type'] !== 'masonry') {
            $shortcodeParams['thumb_size']            = $this->getImageSize($shortcodeParams);
            $shortcodeParams['use_custom_image_size'] = false;
            if($shortcodeParams['thumb_size'] === 'custom' && !empty($shortcodeParams['custom_image_dimensions'])) {
                $shortcodeParams['use_custom_image_size'] = true;
                $shortcodeParams['custom_image_sizes']    = $this->getCustomImageSize($shortcodeParams['custom_image_dimensions']);
            }
        }

        if($queryResults->have_posts()) {
            while($queryResults->have_posts()) {
                $queryResults->the_post();

                $shortcodeParams['current_id'] = get_the_ID();

                if($shortcodeParams['type'] === 'masonry') {
                    $shortcodeParams['thumb_size'] = $this->getImageSize($shortcodeParams);
                }

                $get_item_link = $this->getItemLink($shortcodeParams);

                $shortcodeParams['icon_html']            = $this->getPortfolioIconsHtml($shortcodeParams);
                $shortcodeParams['category_html']        = $this->getItemCategoriesHtml($shortcodeParams);
                $shortcodeParams['categories']           = $this->getItemCategories($shortcodeParams);
                $shortcodeParams['article_masonry_size'] = $this->getMasonrySize($shortcodeParams);
                $shortcodeParams['shader_styles']        = $this->getShaderStyles($shortcodeParams);
                $shortcodeParams['item_link']            = $get_item_link['portfolio_link'];
                $shortcodeParams['item_target']          = $get_item_link['portfolio_target'];
                $shortcodeParams['is_external']          = $get_item_link['is_external'];
                $shortcodeParams['caller']               = $this;

                $html .= mkd_core_get_shortcode_module_template_part('portfolio-list/templates/'.$shortcodeParams['type'], 'portfolio', '', $shortcodeParams);
            }

            wp_reset_postdata();
        } else {
            $html .= '<p>'.esc_html__('Sorry, no posts matched your criteria.', 'mikado-core').'</p>';
        }

        $returnObj = array(
            'html' => $html,
        );

        echo json_encode($returnObj);
        exit;
    }

    /**
     * Prepares shortcode params array from $_POST and returns it
     *
     * @return array
     */
    private function getShortcodeParamsFromPost() {
        $shortcodeParams = array();

        if(!empty($_POST['type'])) {
            $shortcodeParams['type'] = $_POST['type'];
        }

        if(!empty($_POST['columns'])) {
            $shortcodeParams['columns'] = $_POST['columns'];
        }

        if(!empty($_POST['gridSize'])) {
            $shortcodeParams['grid_size'] = $_POST['gridSize'];
        }

        if(!empty($_POST['orderBy'])) {
            $shortcodeParams['order_by'] = $_POST['orderBy'];
        }

        if(!empty($_POST['order'])) {
            $shortcodeParams['order'] = $_POST['order'];
        }

        if(!empty($_POST['number'])) {
            $shortcodeParams['number'] = $_POST['number'];
        }
        if(!empty($_POST['imageSize'])) {
            $shortcodeParams['image_size'] = $_POST['imageSize'];
        }

        if(!empty($_POST['customImageDimensions'])) {
            $shortcodeParams['custom_image_dimensions'] = $_POST['customImageDimensions'];
        }

        if(!empty($_POST['filter'])) {
            $shortcodeParams['filter'] = $_POST['filter'];
        }

        if(!empty($_POST['filterOrderBy'])) {
            $shortcodeParams['filter_order_by'] = $_POST['filterOrderBy'];
        }

        if(!empty($_POST['category'])) {
            $shortcodeParams['category'] = $_POST['category'];
        }

        if(!empty($_POST['selectedProjectes'])) {
            $shortcodeParams['selected_projectes'] = $_POST['selectedProjectes'];
        }

        if(!empty($_POST['showLoadMore'])) {
            $shortcodeParams['show_load_more'] = $_POST['showLoadMore'];
        }

        if(!empty($_POST['titleTag'])) {
            $shortcodeParams['title_tag'] = $_POST['titleTag'];
        }

        if(!empty($_POST['nextPage'])) {
            $shortcodeParams['next_page'] = $_POST['nextPage'];
        }

        if(!empty($_POST['activeFilterCat'])) {
            $shortcodeParams['active_filter_cat'] = $_POST['activeFilterCat'];
        }

        if(!empty($_POST['showExcerpt'])) {
            $shortcodeParams['show_excerpt'] = $_POST['showExcerpt'];
        }

        if(!empty($_POST['space_between_portfolio_items'])) {
            $shortcodeParams['space_between_portfolio_items'] = $_POST['spaceBetweenPortfolioItems'];
        }

        return $shortcodeParams;
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     *
     * @see vc_map
     */
    public function vcMap() {
        if(function_exists('vc_map')) {
            vc_map(array(
                    'name' => esc_html__( 'Portfolio List', 'mikado-core' ),
                    'base'                      => $this->getBase(),
                    'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
                    'icon'                      => 'icon-wpb-portfolio extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array_merge(
                        array(
                            array(
                                'type'        => 'dropdown',
                                'heading' => esc_html__( 'Portfolio List Template', 'mikado-core' ),
                                'param_name'  => 'type',
                                'value'       => array(
                                    'Standard'  => 'standard',
                                    'Gallery'   => 'gallery',
                                    'Masonry'   => 'masonry',
                                    'Pinterest' => 'pinterest'
                                ),
                                'admin_label' => true,
                                'description' => '',
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            ),
                            array(
                                'type'        => 'dropdown',
                                'heading' => esc_html__( 'Masonry With/Without Space?', 'mikado-core' ),
                                'param_name'  => 'masonry_space',
                                'value'       => array(
                                    'With Space'    => 'with_space',
                                    'Without Space' => 'without_space',
                                ),
                                'dependency'  => array('element' => 'type', 'value' => 'masonry'),
                                'save_always' => true,
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            ),
                            array(
                                'type'       => 'dropdown',
                                'heading' => esc_html__( 'Show Title', 'mikado-core' ),
                                'param_name' => 'show_title',
                                'value'      => array(
                                    'Yes' => 'yes',
                                    'No'  => 'no'
                                ),
                                'dependency' => array('element' => 'type', 'value' => array('gallery')),
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            ),
                            array(
                                'type'        => 'dropdown',
                                'heading' => esc_html__( 'Title Tag', 'mikado-core' ),
                                'param_name'  => 'title_tag',
                                'value'       => array(
                                    ''   => '',
                                    'h2' => 'h2',
                                    'h3' => 'h3',
                                    'h4' => 'h4',
                                    'h5' => 'h5',
                                    'h6' => 'h6',
                                ),
                                'dependency'  => array('element' => 'show_title', 'value' => 'yes'),
                                'admin_label' => true,
                                'description' => '',
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            ),
                            array(
                                'type'       => 'dropdown',
                                'heading' => esc_html__( 'Info Position', 'mikado-core' ),
                                'param_name' => 'info_position',
                                'value'      => array(
                                    'Center' => 'center',
                                    'Left'   => 'left'
                                ),
                                'dependency' => array('element' => 'type', 'value' => array('gallery')),
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            ),
                            array(
                                'type'        => 'dropdown',
                                'heading' => esc_html__( 'Image Proportions', 'mikado-core' ),
                                'param_name'  => 'image_size',
                                'value'       => array(
                                    'Original'  => 'full',
                                    'Square'    => 'square',
                                    'Landscape' => 'landscape',
                                    'Portrait'  => 'portrait',
                                    'Custom'    => 'custom'
                                ),
                                'save_always' => true,
                                'admin_label' => true,
                                'description' => '',
                                'dependency'  => array('element' => 'type', 'value' => array('standard', 'gallery')),
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            ),
                            array(
                                'type'        => 'textfield',
                                'admin_label' => true,
                                'heading' => esc_html__( 'Image Dimensions', 'mikado-core' ),
                                'param_name'  => 'custom_image_dimensions',
                                'value'       => '',
                                'description' => esc_html__( 'Enter custom image dimensions. Enter image size in pixels: 200x100 (Width x Height)', 'mikado-core' ),
                                'group' => esc_html__( 'Layout Options', 'mikado-core' ),
                                'dependency'  => array('element' => 'image_size', 'value' => 'custom')
                            ),
                            array(
                                'type'        => 'dropdown',
                                'heading' => esc_html__( 'Show Load More', 'mikado-core' ),
                                'param_name'  => 'show_load_more',
                                'value'       => array(
                                    'Yes' => 'yes',
                                    'No'  => 'no'
                                ),
                                'save_always' => true,
                                'admin_label' => true,
                                'description' => esc_html__( 'Default value is Yes', 'mikado-core' ),
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            ),
                            array(
                                'type'        => 'dropdown',
                                'heading' => esc_html__( 'Number of Columns', 'mikado-core' ),
                                'param_name'  => 'columns',
                                'value'       => array(
                                    ''      => '',
                                    'One'   => 'one',
                                    'Two'   => 'two',
                                    'Three' => 'three',
                                    'Four'  => 'four',
                                    'Five'  => 'five',
                                    'Six'   => 'six'
                                ),
                                'admin_label' => true,
                                'description' => esc_html__( 'Default value is Three', 'mikado-core' ),
                                'dependency'  => array('element' => 'type', 'value' => array('standard', 'gallery')),
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            ),
                            array(
                                'type'        => 'dropdown',
                                'heading' => esc_html__( 'Grid Size', 'mikado-core' ),
                                'param_name'  => 'grid_size',
                                'value'       => array(
                                    'Default'        => '',
                                    '3 Columns Grid' => 'three',
                                    '4 Columns Grid' => 'four',
                                    '5 Columns Grid' => 'five'
                                ),
                                'admin_label' => true,
                                'description' => esc_html__( 'This option is only for Full Width Page Template', 'mikado-core' ),
                                'dependency'  => array('element' => 'type', 'value' => array('pinterest')),
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            ),
                            array(
                                'type'        => 'dropdown',
                                'heading' => esc_html__( 'Enable Category Filter', 'mikado-core' ),
                                'param_name'  => 'filter',
                                'value'       => array(
                                    'No'  => 'no',
                                    'Yes' => 'yes'
                                ),
                                'admin_label' => true,
                                'save_always' => true,
                                'description' => esc_html__( 'Default value is No', 'mikado-core' ),
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            ),
                            array(
                                'type'        => 'colorpicker',
                                'heading' => esc_html__( 'Filter Background Color', 'mikado-core' ),
                                'param_name'  => 'bckg_color',
                                'group' => esc_html__( 'Layout Options', 'mikado-core' ),
                                'admin_label' => true,
                                'dependency'  => array('element' => 'filter', 'value' => array('yes')),
                            ),
                            array(
                                'type'        => 'textfield',
                                'heading' => esc_html__( 'Filter Padding ', 'mikado-core' ),
                                'param_name'  => 'filter_padding',
                                'group' => esc_html__( 'Layout Options', 'mikado-core' ),
                                'admin_label' => true,
                                'description' => esc_html__('Insert padding in format: 0px 0px 1px 0px', 'mikado-core'),
                                'dependency'  => array('element' => 'filter', 'value' => array('yes')),
                            ),
                            array(
                                'type'        => 'textfield',
                                'heading' => esc_html__( 'Filter Margin ', 'mikado-core' ),
                                'param_name'  => 'filter_margin',
                                'group' => esc_html__( 'Layout Options', 'mikado-core' ),
                                'admin_label' => true,
                                'description' => esc_html__('Insert margin in format: 0px 0px 1px 0px', 'mikado-core'),
                                'dependency'  => array('element' => 'filter', 'value' => array('yes')),
                            ),
                            array(
                                'type'        => 'dropdown',
                                'heading' => esc_html__( 'Filter Position', 'mikado-core' ),
                                'param_name'  => 'filter_position',
                                'value'       => array(
                                    'Center' => 'center',
                                    'Left'   => 'left',
                                    'Right'  => 'right'
                                ),
                                'admin_label' => true,
                                'save_always' => true,
                                'description' => esc_html__( 'Default value is Center', 'mikado-core' ),
                                'dependency'  => array('element' => 'filter', 'value' => array('yes')),
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            ),
                            array(
                                'type'        => 'dropdown',
                                'heading' => esc_html__( 'Filter Style', 'mikado-core' ),
                                'param_name'  => 'filter_style',
                                'value'       => array(
                                    'Dark'  => 'dark',
                                    'Light' => 'light'
                                ),
                                'admin_label' => true,
                                'save_always' => true,
                                'dependency'  => array('element' => 'filter', 'value' => array('yes')),
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            ),
                            array(
                                'type'        => 'dropdown',
                                'heading' => esc_html__( 'Filter Order By', 'mikado-core' ),
                                'param_name'  => 'filter_order_by',
                                'value'       => array(
                                    'Name'  => 'name',
                                    'Count' => 'count',
                                    'Id'    => 'id',
                                    'Slug'  => 'slug'
                                ),
                                'admin_label' => true,
                                'save_always' => true,
                                'description' => esc_html__( 'Default value is Name', 'mikado-core' ),
                                'dependency'  => array('element' => 'filter', 'value' => array('yes')),
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            ),
                            array(
                                'type'        => 'dropdown',
                                'heading' => esc_html__( 'Space Between Portfolio Items', 'mikado-core' ),
                                'param_name'  => 'space_between_portfolio_items',
                                'value'       => array(
                                    ''    => '',
                                    'Yes' => 'yes',
                                    'No'  => 'no'
                                ),
                                'admin_label' => true,
                                'save_always' => true,
                                'dependency'  => array('element' => 'type', 'value' => array('gallery')),
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            ),
                            array(
                                'type'        => 'dropdown',
                                'heading' => esc_html__( 'Portfolio Hover Skin', 'mikado-core' ),
                                'param_name'  => 'portfolio_hover_skin',
                                'value'       => array(
                                    'Light' => 'light',
                                    'Dark'  => 'dark'
                                ),
                                'save_always' => true,
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            ),
                            array(
                                'type'        => 'dropdown',
                                'heading'     => esc_html__('Shader Styles', 'mkd-core'),
                                'param_name'  => 'shader_background_style',
                                'value'       => array(
                                    esc_html__('Common Background Color', 'mkd-core')   => 'common_background_color',
                                    esc_html__('Variable Background Color', 'mkd-core') => 'variable_background_color'
                                ),
                                'save_always' => true,
                                'admin_label' => true,
                                'description' => esc_html__('Variable background color is set on individual portfolio item single pages as Portfolio Background Color.', 'mkd-core'),
                                'group'       => esc_html__('Layout Options', 'mkd-core')
                            ),
                            array(
                                'type'       => 'colorpicker',
                                'heading'    => esc_html__('Shader Background Color', 'mkd-core'),
                                'param_name' => 'shader_background_color',
                                'dependency' => array('element' => 'shader_background_style', 'value' => 'common_background_color'),
                                'group'      => esc_html__('Layout Options', 'mkd-core')
                            ),
                            array(
                                'type'       => 'dropdown',
                                'heading' => esc_html__( 'Hover follows cursor direction', 'mikado-core' ),
                                'param_name' => 'cursor_follow',
                                'value'      => array(
                                    'No'  => 'no',
                                    'Yes' => 'yes'
                                ),
                                'dependency' => array(
                                    'element' => 'type',
                                    'value'   => array('gallery')
                                ),
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            ),
                            array(
                                'type'        => 'dropdown',
                                'heading' => esc_html__( 'Show shadow on portfolio items', 'mikado-core' ),
                                'param_name'  => 'show_shadow',
                                'value'       => array(
                                    'No'  => 'no',
                                    'Yes' => 'yes'
                                ),
                                'description' => esc_html__( 'Show shadow on portfolio items.', 'mikado-core' ),
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            ),
                            array(
                                'type'        => 'dropdown',
                                'heading' => esc_html__( 'Show Icon', 'mikado-core' ),
                                'param_name'  => 'show_icon',
                                'value'       => array(
                                    ''    => '',
                                    'Yes' => 'yes',
                                    'No'  => 'no',
                                ),
                                'dependency'  => array('element' => 'type', 'value' => 'gallery'),
                                'description' => esc_html__( 'Show icon on portfolio items.', 'mikado-core' ),
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            ),
                            array(
                                'type'        => 'dropdown',
                                'heading' => esc_html__( 'Show Excerpt?', 'mikado-core' ),
                                'param_name'  => 'show_excerpt',
                                'value'       => array(
                                    ''    => '',
                                    'Yes' => 'yes',
                                    'No'  => 'no'
                                ),
                                'admin_label' => true,
                                'save_always' => true,
                                'dependency'  => array(
                                    'element' => 'type',
                                    'value'   => array('masonry', 'gallery')
                                ),
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            ),
                            array(
                                'type'        => 'textfield',
                                'class'       => '',
                                'heading' => esc_html__( 'Excerpt Length', 'mikado-core' ),
                                'param_name'  => 'excerpt_length',
                                'save_always' => true,
                                'description' => '',
                                'dependency'  => array(
                                    'element' => 'show_excerpt',
                                    'value'   => 'yes'
                                ),
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            ),
                            array(
                                'type'        => 'dropdown',
                                'heading' => esc_html__( 'Show Category?', 'mikado-core' ),
                                'param_name'  => 'show_category',
                                'value'       => array(
                                    ''    => '',
                                    'Yes' => 'yes',
                                    'No'  => 'no'
                                ),
                                'admin_label' => true,
                                'save_always' => true,
                                'dependency'  => array(
                                    'element' => 'type',
                                    'value'   => array('masonry', 'gallery')
                                ),
                                'group' => esc_html__( 'Layout Options', 'mikado-core' )
                            )
                        ),
                        PortfolioLib\PortfolioQuery::getInstance()->queryVCParams()
                    )
                )
            );
        }
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     *
     * @return string
     */
    public function render($atts, $content = null) {

        $args = array(
            'type'                          => 'standard',
            'columns'                       => 'three',
            'grid_size'                     => 'three',
            'image_size'                    => 'full',
            'filter'                        => 'no',
            'filter_order_by'               => 'name',
            'show_load_more'                => 'yes',
            'title_tag'                     => 'h2',
            'portfolio_slider'              => '',
            'portfolios_shown'              => '',
            'space_between_portfolio_items' => '',
            'show_excerpt'                  => 'yes',
            'show_icon'                     => '',
            'custom_image_dimensions'       => '',
            'masonry_space'                 => '',
            'portfolio_hover_skin'          => 'light',
            'shader_background_style'       => 'common_background_color',
            'shader_background_color'       => '',
            'cursor_follow'                 => 'no',
            'show_shadow'                   => 'no',
            'info_position'                 => 'center',
            'show_title'                    => '',
            'filter_position'               => 'center',
            'filter_style'                  => 'dark',
            'bckg_color'                    => '',
            'filter_padding'                => '',
            'filter_margin'                 => '',
            'show_category'                 => '',
            'excerpt_length'                => '90'
        );

        $portfolioQuery = PortfolioLib\PortfolioQuery::getInstance();

        $args   = array_merge($args, $portfolioQuery->getShortcodeAtts());
        $params = shortcode_atts($args, $atts);

        extract($params);

        $queryResults            = $portfolioQuery->buildQueryObject($params);
        $params['query_results'] = $queryResults;

        $classes                 = $this->getPortfolioClasses($params);
        $dataAtts                = $this->getDataAtts($params);
        $params['caller']        = $this;
        $params['filter_styles'] = $this->getFilterStyles($params);

        $dataAtts .= ' data-max-num-pages = '.$queryResults->max_num_pages;
        $params['masonry_filter'] = '';

        $html = '';

        $item_space = '';
        if($params['masonry_space'] == 'without_space') {
            $item_space = ' mkd-masonry-without-space';
        }

        $params['space_btw_items'] = $item_space;


        $show_title = '';
        if($params['show_title'] == 'no') {
            $show_title = ' mkd-without-title';
        }

        $filter_pos = '';
        if($params['filter_position'] === 'center') {
            $filter_pos = ' mkd-filter-center';
        } elseif($params['filter_position'] === 'right') {
            $filter_pos = ' mkd-filter-right';
        } elseif($params['filter_position'] === 'left') {
            $filter_pos = ' mkd-filter-left';
        }

        $params['filter_pos_info'] = $filter_pos;

        $style_filter = '';
        if($params['filter_style'] === 'light') {
            $style_filter = ' mkd-light';
        }

        $params['style_fil'] = $style_filter;


        if($filter == 'yes' && ($type == 'masonry' || $type == 'pinterest')) {
            $params['filter_categories'] = $this->getFilterCategories($params);
            $params['masonry_filter']    = 'mkd-masonry-filter';
            $html .= mkd_core_get_shortcode_module_template_part('portfolio-list/templates/portfolio-filter', 'portfolio', '', $params);
        }

        $html .= '<div class = "mkd-portfolio-list-holder-outer '.$classes.'" '.$dataAtts.'>';

        if($filter == 'yes' && ($type == 'standard' || $type == 'gallery')) {
            $params['filter_categories'] = $this->getFilterCategories($params);
            $html .= mkd_core_get_shortcode_module_template_part('portfolio-list/templates/portfolio-filter', 'portfolio', '', $params);
        }

        $html .= '<div class = "mkd-portfolio-list-holder '.$show_title.' clearfix" >';
        if($type == 'masonry' || $type == 'pinterest') {
            $html .= '<div class="mkd-portfolio-list-masonry-grid-sizer"></div>';
            $html .= '<div class="mkd-portfolio-list-masonry-grid-gutter"></div>';
        }

        if($type !== 'masonry') {
            $params['thumb_size']            = $this->getImageSize($params);
            $params['use_custom_image_size'] = false;
            if($params['thumb_size'] === 'custom' && !empty($params['custom_image_dimensions'])) {
                $params['use_custom_image_size'] = true;
                $params['custom_image_sizes']    = $this->getCustomImageSize($params['custom_image_dimensions']);
            }
        }

        if($queryResults->have_posts()) {
            while($queryResults->have_posts()) {
                $queryResults->the_post();

                $params['current_id'] = get_the_ID();

                if($type === 'masonry') {
                    $params['thumb_size'] = $this->getImageSize($params);
                }

                $params['icon_html']            = $this->getPortfolioIconsHtml($params);
                $params['category_html']        = $this->getItemCategoriesHtml($params);
                $params['categories']           = $this->getItemCategories($params);
                $params['article_masonry_size'] = $this->getMasonrySize($params);
                $params['item_link']            = $this->getItemLink($params)['portfolio_link'];
                $params['item_target']          = $this->getItemLink($params)['portfolio_target'];
                $params['is_external']          = $this->getItemLink($params)['is_external'];
                $params['shader_styles']        = $this->getShaderStyles($params);

                $html .= mkd_core_get_shortcode_module_template_part('portfolio-list/templates/'.$type, 'portfolio', '', $params);
            }

            if($type == 'standard' || ($params['space_between_portfolio_items'] == 'yes' && $type == 'gallery')) {
                switch($columns) {
                    case 'two':
                        $html .= '<div class="mkd-ptf-gap"></div>';
                        break;
                    case 'three':
                        $html .= '<div class="mkd-ptf-gap"></div>';
                        $html .= '<div class="mkd-ptf-gap"></div>';
                        break;
                    case 'four':
                        $html .= '<div class="mkd-ptf-gap"></div>';
                        $html .= '<div class="mkd-ptf-gap"></div>';
                        $html .= '<div class="mkd-ptf-gap"></div>';
                        break;
                    case 'five':
                        $html .= '<div class="mkd-ptf-gap"></div>';
                        $html .= '<div class="mkd-ptf-gap"></div>';
                        $html .= '<div class="mkd-ptf-gap"></div>';
                        $html .= '<div class="mkd-ptf-gap"></div>';
                        break;
                    case 'six':
                        $html .= '<div class="mkd-ptf-gap"></div>';
                        $html .= '<div class="mkd-ptf-gap"></div>';
                        $html .= '<div class="mkd-ptf-gap"></div>';
                        $html .= '<div class="mkd-ptf-gap"></div>';
                        $html .= '<div class="mkd-ptf-gap"></div>';
                        break;
                    default:
                        break;
                }
            }
        } else {
            $html .= '<p>'.esc_html__('Sorry, no posts matched your criteria.').'</p>';
        }

        $html .= '</div>'; //close mkd-portfolio-list-holder

        if($show_load_more == 'yes') {
            $html .= mkd_core_get_shortcode_module_template_part('portfolio-list/templates/load-more-template', 'portfolio', '', $params);
        }

        wp_reset_postdata();

        $html .= '</div>'; // close mkd-portfolio-list-holder-outer
        return $html;
    }

    /**
     * Generates portfolio icons html
     *
     * @param $params
     *
     * @return html
     */
    public function getPortfolioIconsHtml($params) {

        $html             = '';
        $id               = $params['current_id'];
        $slug_list_       = 'pretty_photo_gallery';
        $portfolio_link   = $this->getItemLink($params)['portfolio_link'];
        $portfolio_target = $this->getItemLink($params)['portfolio_target'];

        $featured_image_array = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'full'); //original size
        $large_image          = $featured_image_array[0];

        $html .= '<div class="mkd-item-icons-holder">';

        $html .= '<a class="mkd-portfolio-lightbox" title="'.get_the_title($id).'" href="'.$large_image.'" data-rel="prettyPhoto['.$slug_list_.']"></a>';


        if(function_exists('anahata_mikado_like_portfolio_list')) {
            $html .= anahata_mikado_like_portfolio_list($id);
        }

        $html .= '<a class="mkd-preview" title="'.esc_attr__("Go to Project", "mikado-core").'" href="'.$portfolio_link.'" target="'.$portfolio_target.'" data-type="portfolio_list"></a>';

        $html .= '</div>';

        return $html;

    }

    /**
     * Generates portfolio classes
     *
     * @param $params
     *
     * @return string
     */
    public function getPortfolioClasses($params) {
        $classes       = array();
        $type          = $params['type'];
        $columns       = $params['columns'];
        $grid_size     = $params['grid_size'];
        $cursor_follow = $params['cursor_follow'];
        switch($type):
            case 'standard':
                $classes[] = 'mkd-ptf-standard';
                $classes[] = 'mkd-ptf-with-spaces';
                break;
            case 'gallery':
                $classes[] = 'mkd-ptf-gallery';

                if($params['space_between_portfolio_items'] == 'yes') {
                    $classes[] = 'mkd-ptf-with-spaces';
                }

                $classes[] = 'mkd-portfolio-gallery-hover';

                break;
            case 'masonry':
                $classes[] = 'mkd-ptf-masonry';
                $classes[] = 'mkd-portfolio-gallery-hover';

                break;

            case 'pinterest':
                $classes[] = 'mkd-ptf-pinterest';

                $classes[] = 'mkd-portfolio-gallery-hover';
                break;
        endswitch;

        if(empty($params['portfolio_slider'])) { // portfolio slider mustn't have this classes

            if($type == 'standard' || $type == 'gallery') {
                switch($columns):
                    case 'one':
                        $classes[] = 'mkd-ptf-one-column';
                        break;
                    case 'two':
                        $classes[] = 'mkd-ptf-two-columns';
                        break;
                    case 'three':
                        $classes[] = 'mkd-ptf-three-columns';
                        break;
                    case 'four':
                        $classes[] = 'mkd-ptf-four-columns';
                        break;
                    case 'five':
                        $classes[] = 'mkd-ptf-five-columns';
                        break;
                    case 'six':
                        $classes[] = 'mkd-ptf-six-columns';
                        break;
                endswitch;
            }
            if($params['show_load_more'] == 'yes') {
                $classes[] = 'mkd-ptf-load-more';
            }

            if($cursor_follow == 'yes') {
                $classes[] = 'mkd-ptf-cursor-follow';
            }

            if($params['info_position'] != '') {
                if($params['info_position'] == 'center') {
                    $classes[] = 'mkd-info-center';
                }
                if($params['info_position'] == 'left') {
                    $classes[] = 'mkd-info-left';
                }
            }

            if($params['portfolio_hover_skin'] != '') {
                if($params['portfolio_hover_skin'] == 'light') {
                    $classes[] = 'mkd-hover-light';
                }
                if($params['portfolio_hover_skin'] == 'dark') {
                    $classes[] = 'mkd-hover-dark';
                }
            }

        }

        if($type == 'pinterest') {
            switch($grid_size):
                case 'three':
                    $classes[] = 'mkd-ptf-pinterest-three-columns';
                    break;
                case 'four':
                    $classes[] = 'mkd-ptf-pinterest-four-columns';
                    break;
                case 'five':
                    $classes[] = 'mkd-ptf-pinterest-five-columns';
                    break;
            endswitch;
        }
        if($params['filter'] == 'yes') {
            $classes[] = 'mkd-ptf-has-filter';
            if($params['type'] == 'masonry' || $params['type'] == 'pinterest') {
                if($params['filter'] == 'yes') {
                    $classes[] = 'mkd-ptf-masonry-filter';
                }
            }
        }

        if(!empty($params['portfolio_slider']) && $params['portfolio_slider'] == 'yes') {
            $classes[] = 'mkd-portfolio-slider-holder';
        }

        if($params['show_shadow'] == 'yes') {
            $classes[] = 'mkd-portfolio-shadow-on-items';
        }

        return implode(' ', $classes);

    }

    public function itemExcerpt($textLength) {
        $excerpt = ($textLength > 0) ? substr(get_the_excerpt(), 0, intval($textLength)) : get_the_excerpt();

        return $excerpt;
    }

    /**
     * Generates portfolio image size
     *
     * @param $params
     *
     * @return string
     */
    public function getImageSize($params) {

        $thumb_size = 'full';
        $type       = $params['type'];

        if($type == 'standard' || $type == 'gallery') {
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
            }
        } elseif($type == 'masonry') {

            $id           = $params['current_id'];
            $masonry_size = get_post_meta($id, 'portfolio_masonry_dimenisions', true);

            switch($masonry_size):
                case 'default' :
                    $thumb_size = 'anahata_mikado_square';
                    break;
                case 'large_width' :
                    $thumb_size = 'anahata_mikado_large_width';
                    break;
                case 'large_height' :
                    $thumb_size = 'anahata_mikado_large_height';
                    break;
                case 'large_width_height' :
                    $thumb_size = 'anahata_mikado_large_width_height';
                    break;
            endswitch;
        }


        return $thumb_size;
    }

    /**
     * Generates portfolio item categories ids.This function is used for filtering
     *
     * @param $params
     *
     * @return array
     */
    public function getItemCategories($params) {
        $id                    = $params['current_id'];
        $category_return_array = array();

        $categories = wp_get_post_terms($id, 'portfolio-category');

        foreach($categories as $cat) {
            $category_return_array[] = 'portfolio_category_'.$cat->term_id;
        }

        return implode(' ', $category_return_array);
    }

    /**
     * Generates portfolio item categories html based on id
     *
     * @param $params
     *
     * @return html
     */
    public function getItemCategoriesHtml($params) {
        $id = $params['current_id'];

        $categories    = wp_get_post_terms($id, 'portfolio-category');
        $category_html = '<div class="mkd-ptf-category-holder">';
        $k             = 1;
        foreach($categories as $cat) {
            $category_html .= '<span>'.$cat->name.'</span>';
            if(count($categories) != $k) {
                $category_html .= ' / ';
            }
            $k++;
        }
        $category_html .= '</div>';

        return $category_html;
    }

    /**
     * Generates masonry size class for each article( based on id)
     *
     * @param $params
     *
     * @return string
     */
    public function getMasonrySize($params) {
        $masonry_size_class = '';

        if($params['type'] == 'masonry') {

            $id           = $params['current_id'];
            $masonry_size = get_post_meta($id, 'portfolio_masonry_dimenisions', true);
            switch($masonry_size):
                case 'default' :
                    $masonry_size_class = 'mkd-default-masonry-item';
                    break;
                case 'large_width' :
                    $masonry_size_class = 'mkd-large-width-masonry-item';
                    break;
                case 'large_height' :
                    $masonry_size_class = 'mkd-large-height-masonry-item';
                    break;
                case 'large_width_height' :
                    $masonry_size_class = 'mkd-large-width-height-masonry-item';
                    break;
            endswitch;
        }

        return $masonry_size_class;
    }

    /**
     * Generates filter categories array
     *
     * @param $params
     *
     * * @return array
     */
    public function getFilterCategories($params) {

        $cat_id       = 0;
        $top_category = '';

        if(!empty($params['category'])) {

            $top_category = get_term_by('slug', $params['category'], 'portfolio-category');
            if(isset($top_category->term_id)) {
                $cat_id = $top_category->term_id;
            }

        }

        $args = array(
            'taxonomy' => 'portfolio-category',
            'child_of' => $cat_id,
            'orderby'  => $params['filter_order_by'],
        );

        $filter_categories = get_terms($args);


        return $filter_categories;

    }

    /**
     * Generates datta attributes array
     *
     * @param $params
     *
     * @return array
     */
    public function getDataAtts($params) {

        $data_attr          = array();
        $data_return_string = '';

        if(get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif(get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        if(!empty($paged)) {
            $data_attr['data-next-page'] = $paged + 1;
        }

        if(!empty($params['type'])) {
            $data_attr['data-type'] = $params['type'];
        }

        if(!empty($params['columns'])) {
            $data_attr['data-columns'] = $params['columns'];
        }

        if(!empty($params['grid_size'])) {
            $data_attr['data-grid-size'] = $params['grid_size'];
        }

        if(!empty($params['order_by'])) {
            $data_attr['data-order-by'] = $params['order_by'];
        }

        if(!empty($params['order'])) {
            $data_attr['data-order'] = $params['order'];
        }

        if(!empty($params['number'])) {
            $data_attr['data-number'] = $params['number'];
        }

        if(!empty($params['image_size'])) {
            $data_attr['data-image-size'] = $params['image_size'];
        }

        if(!empty($params['custom_image_dimensions'])) {
            $data_attr['data-custom-image-dimensions'] = $params['custom_image_dimensions'];
        }

        if(!empty($params['filter'])) {
            $data_attr['data-filter'] = $params['filter'];
        }

        if(!empty($params['filter_order_by'])) {
            $data_attr['data-filter-order-by'] = $params['filter_order_by'];
        }

        if (!empty($params['shader_background_style'])) {
            $data_attr['data-shader-background-style'] = $params['shader_background_style'];
        }

        if (!empty($params['shader_background_color'])) {
            $data_attr['data-shader-background-color'] = $params['shader_background_color'];
        }

        if(!empty($params['category'])) {
            $data_attr['data-category'] = $params['category'];
        }

        if(!empty($params['selected_projectes'])) {
            $data_attr['data-selected-projects'] = $params['selected_projectes'];
        }

        if(!empty($params['show_load_more'])) {
            $data_attr['data-show-load-more'] = $params['show_load_more'];
        }

        if(!empty($params['title_tag'])) {
            $data_attr['data-title-tag'] = $params['title_tag'];
        }

        if(!empty($params['portfolio_slider']) && $params['portfolio_slider'] == 'yes') {
            $data_attr['data-items'] = $params['portfolios_shown'];
        }

        $data_attr['data-show-excerpt'] = empty($params['show_excerpt']) ? 'no' : $params['show_excerpt'];

        foreach($data_attr as $key => $value) {
            if($key !== '') {
                $data_return_string .= $key.'= "'.esc_attr($value).'" ';
            }
        }

        return $data_return_string;
    }


    /**
     * Checks if portfolio has external link and returns it. Else returns link to portfolio single page
     *
     * @param $params
     *
     * @return false|mixed|string
     */
    public function getItemLink($params) {

        $portfolio_link_array = array();

        $id               = $params['current_id'];
        $portfolio_link   = get_permalink($id);
        $portfolio_target = '';
        $is_external      = false;

        if(get_post_meta($id, 'portfolio_external_link', true) !== '') {
            $portfolio_link   = get_post_meta($id, 'portfolio_external_link', true);
            $portfolio_target = get_post_meta($id, 'portfolio_external_link_target', true);
            $is_external      = true;
        }

        $portfolio_link_array['portfolio_link']   = $portfolio_link;
        $portfolio_link_array['portfolio_target'] = $portfolio_target;
        $portfolio_link_array['is_external']      = $is_external;

        return $portfolio_link_array;

    }

    private function getCustomImageSize($customImageSize) {
        $imageSize = trim($customImageSize);
        //Find digits
        preg_match_all('/\d+/', $imageSize, $matches);
        if(!empty($matches[0])) {
            return array(
                $matches[0][0],
                $matches[0][1]
            );
        }

        return false;
    }

    private function getFilterStyles($params) {
        $styles = array();
        if(!empty($params['bckg_color'])) {
            $styles[] = 'background-color: '.$params['bckg_color'];
        }

        if(!empty($params['filter_padding'])) {
            $styles[] = 'padding: '.$params['filter_padding'];
        }

        if(!empty($params['filter_margin'])) {
            $styles[] = 'margin: '.$params['filter_margin'];
        }

        return $styles;
    }

    /**
     * Generates portfolio item shader styles
     *
     * @param $params
     *
     * @return html
     */
    public function getShaderStyles($params) {
        $style = array();

        if ($params['shader_background_style'] !== 'variable_background_color') {
            if ($params['shader_background_color'] !== '') {
                $style[] = 'background-color:' . $params['shader_background_color'];
            }
        } else {
            $id = $params['current_id'];
            if (get_post_meta($id, 'portfolio_background_color', true) !== '') {
                $style[] = 'background-color:' . get_post_meta($id, 'portfolio_background_color', true);
            }
        }

        return $style;
    }
}