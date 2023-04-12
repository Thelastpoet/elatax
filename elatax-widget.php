<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;

class Elatax_Widget extends Widget_Base {

    public function get_name() {
        return 'elatax';
    }

    public function get_title() {
        return __('Elatax', 'elatax');
    }

    public function get_icon() {
        return 'eicon-archive-title';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function _register_controls() {
         // Content Controls
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'elatax'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'taxonomy',
            [
            'label' => __('Taxonomy', 'elatax'),
            'type' => Controls_Manager::SELECT,
            'options' => array_flip(get_taxonomies(['public' => true])),
            'default' => 'category',
            ]
        );

        $this->end_controls_section();

        // Style Controls
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'elatax'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'term_typography',
                'label' => __('Typography', 'elatax'),
                'selector' => '{{WRAPPER}} .elatax-term',
            ]
        );

        $this->add_control(
            'term_color',
            [
                'label' => __('Text Color', 'elatax'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elatax-term' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'term_text_shadow',
                'label' => __('Text Shadow', 'elatax'),
                'selector' => '{{WRAPPER}} .elatax-term',
            ]
        );

        $this->end_controls_section();

        // Layout Controls
        $this->start_controls_section(
            'layout_section',
            [
                'label' => __('Layout', 'elatax'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label' => __('Columns', 'elatax'),
                'type' => Controls_Manager::SELECT,
                'default' => 4,
                'tablet_default' => 2,
                'mobile_default' => 1,
                'options' => [
                    1 => __('1', 'elatax'),
                    2 => __('2', 'elatax'),
                    3 => __('3', 'elatax'),
                    4 => __('4', 'elatax'),
                    5 => __('5', 'elatax'),
                    6 => __('6', 'elatax'),
                ],
            ]
        );

        $this->add_control(
            'title_html_tag',
            [
                'label' => __('Title HTML Tag', 'elatax'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => __('H1', 'elatax'),
                    'h2' => __('H2', 'elatax'),
                    'h3' => __('H3', 'elatax'),
                    'h4' => __('H4', 'elatax'),
                    'h5' => __('H5', 'elatax'),
                    'h6' => __('H6', 'elatax'),
                    'p' => __('p', 'etax'),
                ],
                'default' => 'h3',
            ]
        );

        $this->add_control(
            'terms_per_page',
            [
                'label' => __('Terms per Page', 'elatax'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'default' => 10,
            ]
        );

        $this->end_controls_section();

        // Pagination Controls
        $this->start_controls_section(
            'pagination_section',
            [
                'label' => __('Pagination', 'elatax'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label' => __('Enable Pagination', 'elatax'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'elatax'),
                'label_off' => __('No', 'elatax'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'pagination_type',
            [
                'label' => __('Pagination Type', 'elatax'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __('None', 'elatax'),
                    'numbers' => __('Numbers', 'elatax'),
                    'prev_next' => __('Previous/Next', 'elatax'),
                    'numbers_prev_next' => __('Numbers + Previous/Next', 'elatax'),
                    'load_on_click' => __('Load on Click', 'elatax'),
                    'infinite_scroll' => __('Infinite Scroll', 'elatax'),
                ],
                'default' => '',
                'condition' => [
                    'pagination' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'page_limit',
            [
                'label' => __('Page Limit', 'elatax'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'default' => 5,
                'condition' => [
                    'pagination' => 'yes',
                    'pagination_type!' => '',
                ],
            ]
        );
    
        $this->add_control(
            'pagination_shorten',
            [
                'label' => __('Shorten', 'elatax'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'elatax'),
                'label_off' => __('No', 'elatax'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'pagination' => 'yes',
                    'pagination_type!' => '',
                ],
            ]
        );
    
        $this->add_control(
            'pagination_alignment',
            [
                'label' => __('Alignment', 'elatax'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'elatax'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'elatax'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'elatax'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => false,
                'condition' => [
                    'pagination' => 'yes',
                    'pagination_type!' => '',
                ],
            ]
        );
    
        $this->add_control(
            'prev_label',
            [
                'label' => __('Previous Label', 'elatax'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Previous', 'elatax'),
                'condition' => [
                    'pagination' => 'yes',
                    'pagination_type' => ['prev_next', 'numbers_prev_next'],
                ],
            ]
        );
    
        $this->add_control(
            'next_label',
            [
                'label' => __('Next Label', 'elatax'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Next', 'elatax'),
                'condition' => [
                    'pagination' => 'yes',
                    'pagination_type' => ['prev_next', 'numbers_prev_next'],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pagination_style_section',
            [
                'label' => __('Pagination Style', 'elatax'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'pagination' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pagination_typography',
                'label' => __('Typography', 'elatax'),
                'selector' => '{{WRAPPER}} .elatax-pagination a',
            ]
        );

        $this->add_control(
            'pagination_color',
            [
                'label' => __('Text Color', 'elatax'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elatax-pagination a' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'pagination_color_hover',
            [
                'label' => __('Text Hover Color', 'elatax'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elatax-pagination a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_space_between',
            [
                'label' => __('Space Between', 'elatax'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elatax-pagination a' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'pagination_spacing',
            [
                'label' => __('Spacing', 'elatax'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elatax-pagination' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $taxonomy = $settings['taxonomy'];
        $columns = $settings['columns'];
        $title_html_tag = $settings['title_html_tag'];
        $terms_per_page = $settings['terms_per_page'];
        $paged = max(1, get_query_var('paged'));
    
        $terms = get_terms(array(
            'taxonomy' => $taxonomy,
            'hide_empty' => false,
            'number' => $terms_per_page,
            'offset' => ($paged - 1) * $terms_per_page,
        ));
    
        $total_terms = wp_count_terms($taxonomy, array('hide_empty' => false));
        $total_pages = ceil($total_terms / $terms_per_page);
    
        if (!empty($terms) && !is_wp_error($terms)) {
            echo '<div class="elatax-terms-list" style="display: flex; flex-wrap: wrap;">';
    
            foreach ($terms as $term) {
                $term_link = get_term_link($term);
                echo sprintf('<div class="elatax-term" style="flex-basis: calc(100%% / %d);"><a href="%s"><%s>%s</%s></a></div>', $columns, esc_url($term_link), $title_html_tag, esc_html($term->name), $title_html_tag);
            }
    
            echo '</div>';

            // Add pagination controls
            if ($settings['pagination_type'] !== '') {
                echo '<div class="elatax-pagination" style="text-align: ' . $settings['pagination_alignment'] . ';">';
                switch ($settings['pagination_type']) {
                    case 'numbers':
                    case 'numbers_prev_next':
                        for ($i = 1; $i <= $total_pages; $i++) {
                            $class = ($paged == $i) ? 'current' : '';
                            echo sprintf('<a href="%s" class="%s">%d</a>', get_pagenum_link($i, $settings['pagination_shorten']), $class, $i);
                        }
                        // No break statement here to continue with the prev_next case.
                    case 'prev_next':
                        if ($settings['pagination_type'] === 'prev_next' || $settings['pagination_type'] === 'numbers_prev_next') {
                            if ($paged > 1) {
                                echo sprintf('<a href="%s" class="prev">&laquo; ' . $settings['pagination_previous_label'] . '</a>', get_pagenum_link($paged - 1, $settings['pagination_shorten']));
                            }
                            if ($paged < $total_pages) {
                                echo sprintf('<a href="%s" class="next">' . $settings['pagination_next_label'] . ' &raquo;</a>', get_pagenum_link($paged + 1, $settings['pagination_shorten']));
                            }
                        }
                        break;
                    case 'load_on_click':
                        // Load on Click implementation
                        break;
                    case 'infinite_scroll':
                        // Infinite Scroll implementation
                        break;
                }
                echo '</div>';
            }
        } else {
            echo __('No terms found.', 'elatax');
        }
    }
    
}

// Register the custom widget in Elementor
add_action('elementor/widgets/widgets_registered', function ($widgets_manager) {
    $widgets_manager->register_widget_type(new Elatax_Widget());
});