<?php
namespace ElementorAwesomesauce\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* @since 1.1.0
*/
class PostTabsList extends Widget_Base {

/**
* Retrieve the widget name.
*
* @since 1.1.0
*
* @access public
*
* @return string Widget name.
*/
public function get_name() {
  return 'post-tabs-list';
}

/**
* Retrieve the widget title.
*
* @since 1.1.0
*
* @access public
*
* @return string Widget title.
*/
public function get_title() {
  return __( 'Post Tabs List', 'elementor-post-tabs' );
}

/**
* Retrieve the widget icon.
*
* @since 1.1.0
*
* @access public
*
* @return string Widget icon.
*/
public function get_icon() {
  return 'fa fa-pencil';
}

/**
* Retrieve the list of categories the widget belongs to.
*
* Used to determine where to display the widget in the editor.
*
* Note that currently Elementor supports only one category.
* When multiple categories passed, Elementor uses the first one.
*
* @since 1.1.0
*
* @access public
*
* @return array Widget categories.
*/
public function get_categories() {
  return ['general', 'test-category'];
}

/**
* Register the widget controls.
*
* Adds different input fields to allow the user to change and customize the widget settings.
*
* @since 1.1.0
*
* @access protected
*/
protected function _register_controls() {
  $this->start_controls_section(
    'section_content',
    [
      'label' => __( 'Content', 'elementor-awesomesauce' ),
    ]
  );

  $this->add_control(
    'title',
    [
      'label' => __( 'Title', 'elementor-awesomesauce' ),
      'type' => Controls_Manager::TEXT,
      'default' => __( 'Latest posts', 'elementor-awesomesauce' ),
    ]
  );

  $this->add_control(
    'post_title_crop',
    [
      'label'         => esc_html__( 'Post Title limit', 'elementor_awesomesauce' ),
      'type'          => Controls_Manager::NUMBER,
      'default' => '35',

    ]
  );

  $this->add_control(
    'show_excerpt',
    [
      'label' => esc_html__('Show Description', 'elementor_awesomesauce'),
      'type' => Controls_Manager::SWITCHER,
      'label_on' => esc_html__('yes', 'elementor_awesomesauce'),
      'label_off' => esc_html__('no', 'elementor_awesomesauce'),
      'default' => 'No',
    ]
  );

  $this->add_control(
    'post_content_crop',
    [
      'label'         => esc_html__( 'Post Exerpt limit', 'elementor_awesomesauce' ),
      'type'          => Controls_Manager::NUMBER,
      'default' => '30',
      'condition' => [ 'show_excerpt' => ['yes'] ]

    ]
  );

  $this->add_control(
    'order',
    [
      'label' => __( 'Order ASC/DESC', 'elementor-awesomesauce' ),
      'type' => Controls_Manager::SELECT,
      'default' => __( 'DESC', 'elementor-awesomesauce' ),
      'options' => [
        'DESC'  => __( 'Descending', 'elementor-awesomesauce' ),
        'ASC' => __( 'Ascending', 'elementor-awesomesauce' ),
      ],
    ]
  );

  $this->add_control(
    'post_count',
    [
      'label' => __( 'Post count', 'elementor-awesomesauce' ),
      'type' => Controls_Manager::NUMBER,
      'default' => __( '3', 'elementor-awesomesauce' ),
    ]
  );

  $this->add_control(
    'tabs',
    [
      'label' => esc_html__('Tabs', 'digiqole'),
      'type' => Controls_Manager::REPEATER,
      'default' => [
        [
          'tab_title' => esc_html__('Add Label', 'digiqole'),
          'post_cats' => 1,
        ],
      ],
      'fields' => [
        [
          'name' => 'post_cats',
          'label' => __( 'Categories( Include )', 'elementor-pro' ),
          'type' => \Elementor\Controls_Manager::SELECT2,
          'options' => $this->post_category(),
          'label_block' => true,
          'multiple' => true,
        ],
        [   'name' => 'tab_title',
        'label'         => esc_html__( 'Tab title', 'digiqole' ),
        'type'          => Controls_Manager::TEXT,
        'default'       => 'Add Label',
      ],
      [
        'name' => 'ts_offset_enable',
        'label'         => esc_html__( 'Post Skip', 'digiqole' ),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'digiqole'),
        'label_off' => esc_html__('No', 'digiqole'),
      ],
      [
        'name' => 'ts_offset_item_num',
        'label'         => esc_html__( 'Skip post count', 'digiqole' ),
        'type'          => Controls_Manager::NUMBER,
        'default'       => '1',
        'condition' => [ 'ts_offset_enable' => 'yes' ]
      ],
    ],
  ]
);

$this->add_control(
  'show_date',
  [
    'label' => esc_html__('Show Date', 'elementor_awesomesauce'),
    'type' => Controls_Manager::SWITCHER,
    'label_on' => esc_html__('Yes', 'elementor_awesomesauce'),
    'label_off' => esc_html__('No', 'elementor_awesomesauce'),
    'default' => 'yes',
  ]
);

$this->add_control(
  'show_cat',
  [
    'label' => esc_html__('Show Category', 'elementor_awesomesauce'),
    'type' => Controls_Manager::SWITCHER,
    'label_on' => esc_html__('Yes', 'elementor_awesomesauce'),
    'label_off' => esc_html__('No', 'elementor_awesomesauce'),
    'default' => 'yes',
  ]
);
$this->add_control(
  'show_tags',
  [
    'label' => esc_html__('Show tags', 'elementor_awesomesauce'),
    'type' => Controls_Manager::SWITCHER,
    'label_on' => esc_html__('Yes', 'elementor_awesomesauce'),
    'label_off' => esc_html__('No', 'elementor_awesomesauce'),
    'default' => 'no',
  ]
);
$this->add_control(
  'show_author',
  [
    'label' => esc_html__('Show author', 'elementor_awesomesauce'),
    'type' => Controls_Manager::SWITCHER,
    'label_on' => esc_html__('Yes', 'elementor_awesomesauce'),
    'label_off' => esc_html__('No', 'elementor_awesomesauce'),
    'default' => 'yes',
  ]
);
$this->add_control(
  'show_views',
  [
    'label' => esc_html__('Show views', 'elementor_awesomesauce'),
    'type' => Controls_Manager::SWITCHER,
    'label_on' => esc_html__('Yes', 'elementor_awesomesauce'),
    'label_off' => esc_html__('No', 'elementor_awesomesauce'),
    'default' => 'no',
  ]
);
$this->add_control(
  'show_comments',
  [
    'label' => esc_html__('Show comments', 'elementor_awesomesauce'),
    'type' => Controls_Manager::SWITCHER,
    'label_on' => esc_html__('Yes', 'elementor_awesomesauce'),
    'label_off' => esc_html__('No', 'elementor_awesomesauce'),
    'default' => 'no',
  ]
);

$this->add_responsive_control(
  'number_of_columns',
  [
    'label' => __( 'Number of columns', 'elementor-awesomesauce' ),
    'type' => \Elementor\Controls_Manager::SELECT,
    'options' => [
      '1fr'  => __( '1', 'elementor-awesomesauce' ),
      '1fr 1fr'  => __( '2', 'elementor-awesomesauce' ),
      '1fr 1fr 1fr'  => __( '3', 'elementor-awesomesauce' ),
      '1fr 1fr 1fr 1fr'  => __( '4', 'elementor-awesomesauce' ),
    ],
    'devices' => [ 'desktop', 'tablet', 'mobile' ],
    'selectors' => [
      '{{WRAPPER}} .big-wrapper' => 'grid-template-columns: {{VALUE}};',
    ],
  ]
);

  $this->end_controls_section();

  $this->start_controls_section(
    'general_style_settings',
    [
      'label' => __( 'General settings', 'elementor-awesomesauce' ),
      'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]
  );



              $this->add_control(
                'big_typo_section',
                [
                  'label' => __( 'Typography', 'plugin-name' ),
                  'type' => \Elementor\Controls_Manager::HEADING,
                  'separator' => 'before',
                ]
              );

              $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                  'label' => __( 'Title typography', '' ),
                  'name' => 'big_title_typography',
                  'selector' => '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .news-title',
                ]
              );

              $this->add_control(
                'big_title_color_1',
                [
                  'label' => __( 'Title color', '' ),
                  'type' => \Elementor\Controls_Manager::COLOR,
                  'default' => '#000000',
                  'selectors' => [
                    '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .news-title' => 'color: {{VALUE}}',
                  ],
                ]
              );

              $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                  'label' => __( 'Description typography', '' ),
                  'name' => 'big_desc_typography',
                  'selector' => '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .description',
                ]
              );


              $this->add_control(
                'big_description_color_2',
                [
                  'label' => __( 'Description color', '' ),
                  'type' => \Elementor\Controls_Manager::COLOR,
                  'default' => '#000000',
                  'selectors' => [
                    '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .description-inner p' => 'color: {{VALUE}}',
                  ],
                ]
              );

              $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                  'label' => __( 'Big details typography', '' ),
                  'name' => 'big_details_typography',
                  'selector' => '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .description-inner .comments-views-date span',
                ]
              );

              $this->add_control(
                'big_details_color_2',
                [
                  'label' => __( 'details color', '' ),
                  'type' => \Elementor\Controls_Manager::COLOR,
                  'default' => '#989898',
                  'selectors' => [
                    '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .description-inner .comments-views-date span' => 'color: {{VALUE}}',
                  ],
                ]
              );

  $this->add_control(
    'big_thumbnail_border',
    [
      'label' => __( 'Thumbnail border', 'elementor_awesomesauce' ),
      'type' => \Elementor\Controls_Manager::HEADING,
    ]
  );


  $this->add_group_control(
    \Elementor\Group_Control_Border::get_type(),
    [
      'name' => 'big_thumb_border',
      'fields_options' => [
    'border' => ['default' => 'solid'],
    'width' => [
      'default' => [
        'top' => 6,
        'right' => 6,
        'bottom' => 6,
        'left' => 6,
        'unit'=> 'px',
        'isLinked' => true,
      ],
    ],
    'color' => ['default' => '#FFFFFF'],
  ],
      'selector' => '{{WRAPPER}} .awesomesauce-post-block .wrapper .thumbnail',
    ]
  );

  $this->add_control(
    'item_border',
    [
      'label' => __( 'Item border', 'elementor_awesomesauce' ),
      'type' => \Elementor\Controls_Manager::HEADING,
      'separator' => 'before'
    ]
  );

  $this->add_group_control(
    \Elementor\Group_Control_Border::get_type(),
    [
      'name' => 'big_itemborder',
      'fields_options' => [
    'width' => [
      'default' => [
        'top' => 1,
        'right' => 1,
        'bottom' => 1,
        'left' => 1,
        'unit'=> 'px',
        'isLinked' => true,
      ],
    ],
    'color' => ['default' => '#000'],
  ],
      'selector' => '{{WRAPPER}} .awesomesauce-post-block .wrapper',
    ]
  );

  $this->add_control(
    'columns_rows',
    [
      'label' => __( 'Columns and rows', 'elementor_awesomesauce' ),
      'type' => \Elementor\Controls_Manager::HEADING,
      'separator' => 'before'
    ]
  );


  $this->add_responsive_control(
    'big_grid_item_column_gap',
    [
      'label' =>esc_html__( 'Grid item column gap (css grid)', 'elementor_awesomesauce' ),
      'type' => \Elementor\Controls_Manager::NUMBER,
      'default' => 15,
      'selectors' => [
        '{{WRAPPER}} .awesomesauce-post-block .big-wrapper' => 'column-gap: {{VALUE}}px;',
      ],
    ]
  );

  $this->add_responsive_control(
    'big_grid_item_row_gap',
    [
      'label' =>esc_html__( 'Grid item row gap (css grid)', 'elementor_awesomesauce' ),
      'type' => \Elementor\Controls_Manager::NUMBER,
      'default' => 15,
      'selectors' => [
        '{{WRAPPER}} .awesomesauce-post-block .big-wrapper' => 'row-gap: {{VALUE}}px;',
      ],
    ]
  );


  $this->add_control(
    'column_width',
    [
      'label' => __( 'Column width', 'elementor-awesomesauce' ),
      'type' => \Elementor\Controls_Manager::SLIDER,
      'size_units' => [ 'fr'],
      'range' => [
        'fr' => [
          'min' => 4,
          'max' => 10,
          'step' => 1,
        ],
      ],
      'default' => [
        'unit' => 'fr',
        'size' => 5,
      ],
      'selectors' => [
        '{{WRAPPER}} .big-wrapper--style-a' => 'grid-template-columns: {{SIZE}}{{UNIT}} 4fr;',
      ],
      'condition' => [ 'block_style' => ['style-1'] ],
    ]
  );

  $this->add_control(
    'background',
    [
      'label' => __( 'Background', 'elementor_awesomesauce' ),
      'type' => \Elementor\Controls_Manager::HEADING,
      'separator' => 'before'
    ]
  );


                      $this->add_control(
                        'grid_item_color',
                        [
                          'label' => __( 'Grid item background color', '' ),
                          'type' => \Elementor\Controls_Manager::COLOR,
                          'default' => 'rgba(255,255,255,0)',
                          'selectors' => [
                            '{{WRAPPER}} .awesomesauce-post-block .wrapper' => 'background-color: {{VALUE}}',
                          ],
                        ]
                      );




      $this->add_control(
        'paddings',
        [
          'label' => __( 'Paddings', 'elementor_awesomesauce' ),
          'type' => \Elementor\Controls_Manager::HEADING,
          'separator' => 'before',
        ]
      );


  $this->add_responsive_control(
    'big_grid_item_padding',
    [
      'label' =>esc_html__( 'Big Grid item padding', 'elementor_awesomesauce' ),
      'type' => \Elementor\Controls_Manager::DIMENSIONS,
      'size_units' => [ 'px'],
      'placeholder' => '0',
      'default' => [
        'top' => '0',
        'right' => '0',
        'bottom' => '0',
        'left' => '0',
        'unit' => 'px',
        'isLinked' => true,
      ],
      'selectors' => [
        '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .description-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
      ],
    ]
  );


          $this->add_control(
            'big_margins_section',
            [
              'label' => __( 'Margins', 'plugin-name' ),
              'type' => \Elementor\Controls_Manager::HEADING,
              'separator' => 'before',
            ]
          );



              $this->add_responsive_control(
                'big_thumbnail_margin_bottom',
                [
                  'label' => __( 'Big thumbnail margin bottom', 'elementor-awesomesauce' ),
                  'type' => \Elementor\Controls_Manager::SLIDER,
                  'range' => [
                    'px' => [
                      'min' => 0,
                      'max' => 100,
                    ],
                  ],
                  'devices' => [ 'desktop', 'tablet', 'mobile' ],
                  'desktop_default' => [
                    'size' => 10,
                    'unit' => 'px',
                  ],
                  'tablet_default' => [
                    'size' => 10,
                    'unit' => 'px',
                  ],
                  'mobile_default' => [
                    'size' => 10,
                    'unit' => 'px',
                  ],
                  'selectors' => [
                    '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .thumbnail' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                  ],
                ]
              );



              $this->add_responsive_control(
                'big_category_margin_bottom',
                [
                  'label' => __( 'Big category margin bottom', 'elementor-awesomesauce' ),
                  'type' => \Elementor\Controls_Manager::SLIDER,
                  'range' => [
                    'px' => [
                      'min' => 0,
                      'max' => 100,
                    ],
                  ],
                  'devices' => [ 'desktop', 'tablet', 'mobile' ],
                  'desktop_default' => [
                    'size' => 10,
                    'unit' => 'px',
                  ],
                  'tablet_default' => [
                    'size' => 10,
                    'unit' => 'px',
                  ],
                  'mobile_default' => [
                    'size' => 10,
                    'unit' => 'px',
                  ],
                  'selectors' => [
                    '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                  ],
                ]
              );

              $this->add_responsive_control(
                'big_title_margin_bottom',
                [
                  'label' => __( 'Big title margin bottom', 'elementor-awesomesauce' ),
                  'type' => \Elementor\Controls_Manager::SLIDER,
                  'range' => [
                    'px' => [
                      'min' => 0,
                      'max' => 100,
                    ],
                  ],
                  'devices' => [ 'desktop', 'tablet', 'mobile' ],
                  'desktop_default' => [
                    'size' => 5,
                    'unit' => 'px',
                  ],
                  'tablet_default' => [
                    'size' => 5,
                    'unit' => 'px',
                  ],
                  'mobile_default' => [
                    'size' => 5,
                    'unit' => 'px',
                  ],
                  'selectors' => [
                    '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .news-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                  ],
                ]
              );

              $this->add_responsive_control(
                'big_excerpt_margin_bottom',
                [
                  'label' => __( 'Big excerpt margin bottom', 'elementor-awesomesauce' ),
                  'type' => \Elementor\Controls_Manager::SLIDER,
                  'range' => [
                    'px' => [
                      'min' => 0,
                      'max' => 100,
                    ],
                  ],
                  'devices' => [ 'desktop', 'tablet', 'mobile' ],
                  'desktop_default' => [
                    'size' => 5,
                    'unit' => 'px',
                  ],
                  'tablet_default' => [
                    'size' => 5,
                    'unit' => 'px',
                  ],
                  'mobile_default' => [
                    'size' => 5,
                    'unit' => 'px',
                  ],
                  'selectors' => [
                    '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .description p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                  ],
                ]
              );

      $this->end_controls_section();
}

/**
* Render the widget output on the frontend.
*
* Written in PHP and used to generate the final HTML.
*
* @since 1.1.0
*
* @access protected
*/
protected function render() {
  $settings = $this->get_settings_for_display();
  $tabs = $settings['tabs'];
  $post_count = count($tabs);
  $show_title         = $settings['show_title'];
  $show_cat           = $settings['show_cat'];
  $show_date          = $settings['show_date'];
  $show_author         = $settings['show_author'];
  $show_views         = $settings['show_views'];
  $show_comments         = $settings['show_comments'];
  $show_tags        = $settings['show_tags'];
  $number_of_columns_phone = $settings['number_of_columns_phone'];
  $number_of_columns_tablet = $settings['posts_per_page'];
  $number_of_columns_desktop = $settings['number_of_columns_desktop'];
  $crop	= (isset($settings['post_title_crop'])) ? $settings['post_title_crop'] : 20;
  $post_content_crop	= (isset($settings['post_content_crop'])) ? $settings['post_content_crop'] : 50;

  $this->add_inline_editing_attributes( 'title', 'none' );
// $this->add_inline_editing_attributes( 'order_by', 'advanced' );
// $this->add_inline_editing_attributes( 'post_count', 'advanced' );
  ?>
  <h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h2>

  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <?php
      foreach ( $tabs as $tab_key=>$value ) {

        if( $tab_key == 0 ){
          echo '<a id="'.$this->get_id().$value['_id'].'-tab" class="nav-item nav-link active" data-toggle="tab" href="#nav-'.$this->get_id().$value['_id'].'" role="tab" aria-controls="nav-'.$this->get_id().$value['_id'].'" aria-selected="true">'.$value['tab_title'].'</a>';
        } else {
          echo '<a id="'.$this->get_id().$value['_id'].'-tab" class="nav-item nav-link" data-toggle="tab" href="#nav-'.$this->get_id().$value['_id'].'" role="tab" aria-controls="nav-'.$this->get_id().$value['_id'].'" aria-selected="true">'.$value['tab_title'].'</a>';
        }

      }
      ?>
    </div>
  </nav>

  <div class="tab-content awesomesauce-post-block post-list-tabs">
    <?php foreach ($tabs as $content_key=>$value) {
      if( $content_key == 0){
        echo '<div class="tab-pane fade show active" role="tabpanel"  id="nav-'.$this->get_id().$value['_id'].'" aria-labelledby="nav-'.$this->get_id().$value['_id'].'-tab">';
      } else {
        echo '<div class="tab-pane fade" role="tabpanel" id="nav-'.$this->get_id().$value['_id'].'"aria-labelledby="nav-'.$this->get_id().$value['_id'].'-tab">';
      }

      $arg = array(
      'post_type'   =>  'post',
        'post_status' => 'publish',
        'posts_per_page' => $settings['post_count'],
        'orderby' => $settings['order_by'],
        'category__in' => $value['post_cats'],
        'meta_key'    => 'number_of_views',
        'order' => $settings['order'],
      );

      $queryd = new \WP_Query( $arg );
      if ( $queryd->have_posts() ) : ?>
          <?php  require 'block_styles/post-grid.php'; ?>
        <?php wp_reset_postdata(); ?>
      <!-- </div> -->
    <?php endif; ?>
    </div>
  <?php } ?>
</div>
<?php }

protected function _content_template() {

}

public function post_category() {

  $terms = get_terms( array(
    'taxonomy'    => 'category',
    'hide_empty'  => false,
    'posts_per_page' => -1,
    'suppress_filters' => false,
  ) );

  $cat_list = [];
  foreach($terms as $post) {
    $cat_list[$post->term_id]  = [$post->name];
  }
  return $cat_list;
}

function elementor_awesomesauce_post_tags(){
  $terms = get_terms( array(
    'taxonomy'    => 'post_tag',
    'hide_empty'  => false,
    'posts_per_page' => -1,
  ) );

  $cat_list = [];
  foreach($terms as $post) {
    $cat_list[$post->term_id]  = [$post->name];
  }
  return $cat_list;
}

}
