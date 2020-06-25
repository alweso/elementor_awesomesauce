<?php
namespace ElementorAwesomesauce\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* @since 1.1.0
*/
class PostGrid extends Widget_Base {

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
    return 'post-grid';
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
    return __( 'Post Grid', 'elementor-post-grid' );
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
    return [ 'general' ];
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
        'default' => __( 'Post grid', 'elementor-awesomesauce' ),
      ]
    );

    $this->add_control(
      'post_title_crop',
      [
        'label'         => esc_html__( 'Post Title limit', 'digiqole' ),
        'type'          => Controls_Manager::NUMBER,
        'default' => '35',

      ]
    );

    $this->add_control(
      'post_content_crop',
      [
        'label'         => esc_html__( 'Post Exerpt limit', 'digiqole' ),
        'type'          => Controls_Manager::NUMBER,
        'default' => '30',

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
      'order_by',
      [
        'label' => __( 'Show', 'elementor-awesomesauce' ),
        'type' => Controls_Manager::SELECT,
        'default' => __( 'date', 'elementor-awesomesauce' ),
        'options' => [
          'date'  => __( 'Latest posts', 'elementor-awesomesauce' ),
          'comment_count'  => __( 'Most commented', 'elementor-awesomesauce' ),
          'meta_value_num'  => __( 'Most read', 'elementor-awesomesauce' ),
        ],
      ]
    );

    $this->add_control(
         'post_pick_by',
         [
             'label'     => esc_html__( 'Post pick by', 'digiqole' ),
             'type'      => Controls_Manager::SELECT,
             'default'   => '',
             'options'   => [
                     'category'      =>esc_html__( 'Category', 'digiqole' ),
                     'tags'      =>esc_html__( 'Tags', 'digiqole' ),
                     // 'stickypost'    =>esc_html__( 'Sticky posts', 'digiqole' ),
                     'post'    =>esc_html__( 'Post id', 'digiqole' ),
                     'author'    =>esc_html__( 'Author', 'digiqole' ),
                 ],
         ]
       );

       $this->add_control(
         'post_categories',
         [
           'label' => __( 'Choose categories', 'elementor-awesomesauce' ),
           'type' => \Elementor\Controls_Manager::SELECT2,
           'default' => '',
           'options' => $this->post_category(),
           'label_block' => true,
           'multiple' => true,
           'condition' => [ 'post_pick_by' => ['category'] ]
         ]
       );

       $this->add_control(
         'post_tags',
         [
           'label' => esc_html__('Select tags', 'digiqole'),
           'type' => Controls_Manager::SELECT2,
           'options' => $this->digiqole_post_tags(),
           'label_block' => true,
           'multiple' => true,
           'condition' => [ 'post_pick_by' => ['tags'] ]
         ]
       );

    $this->add_control(
   'author_id',
   [
     'label' => esc_html__( 'Author id', 'digiqole' ),
     'type' => \Elementor\Controls_Manager::TEXT,
         'placeholder' => esc_html__( '1,2,3', 'digiqole' ),
         'condition' => [ 'post_pick_by' => ['author'] ]
   ]
    );
    $this->add_control(
   'post_id',
   [
     'label' => esc_html__( 'Post id', 'digiqole' ),
     'type' => \Elementor\Controls_Manager::TEXT,
         'placeholder' => esc_html__( '1,2,3', 'digiqole' ),
         'condition' => [ 'post_pick_by' => ['post'] ]
   ]
    );

    $this->add_control(
      'post_count',
      [
        'label' => __( 'Post count', 'elementor-awesomesauce' ),
        'type' => Controls_Manager::NUMBER,
        'default' => __( 4, 'elementor-awesomesauce' ),
      ]
    );

    $this->add_control(
      'show_date',
      [
        'label' => esc_html__('Show Date', 'digiqole'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'digiqole'),
        'label_off' => esc_html__('No', 'digiqole'),
        'default' => 'yes',
      ]
    );

    $this->add_control(
      'show_cat',
      [
        'label' => esc_html__('Show Category', 'digiqole'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'digiqole'),
        'label_off' => esc_html__('No', 'digiqole'),
        'default' => 'yes',
      ]
    );
    $this->add_control(
      'show_author',
      [
        'label' => esc_html__('Show author', 'digiqole'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'digiqole'),
        'label_off' => esc_html__('No', 'digiqole'),
        'default' => 'yes',
      ]
    );

    $this->add_control(
      'number_of_columns_phone',
      [
        'label' => __( 'Number of columns (phone)', 'elementor-awesomesauce' ),
        'type' => Controls_Manager::SELECT,
        'default' => __( '12', 'elementor-awesomesauce' ),
        'options' => [
          '12'  => __( '1', 'elementor-awesomesauce' ),
          '6'  => __( '2', 'elementor-awesomesauce' ),
        ],
      ]
    );

    $this->add_control(
      'number_of_columns_tablet',
      [
        'label' => __( 'Number of columns (tablet)', 'elementor-awesomesauce' ),
        'type' => Controls_Manager::SELECT,
        'default' => __( '6', 'elementor-awesomesauce' ),
        'options' => [
          '12'  => __( '1', 'elementor-awesomesauce' ),
          '6'  => __( '2', 'elementor-awesomesauce' ),
          '4' => __( '3', 'elementor-awesomesauce' ),
          '3' => __( '4', 'elementor-awesomesauce' ),
        ],
      ]
    );

    $this->add_control(
      'number_of_columns_desktop',
      [
        'label' => __( 'Number of columns (desktop)', 'elementor-awesomesauce' ),
        'type' => Controls_Manager::SELECT,
        'default' => __( '3', 'elementor-awesomesauce' ),
        'options' => [
          '6'  => __( '2', 'elementor-awesomesauce' ),
          '4' => __( '3', 'elementor-awesomesauce' ),
          '3' => __( '4', 'elementor-awesomesauce' ),
        ],
      ]
    );


    $this->add_responsive_control(
      'thumbnail_height',
      [
        'label' =>esc_html__( 'Thumbnail Height', 'digiqole' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 1000,
          ],
        ],
        'devices' => [ 'desktop', 'tablet', 'mobile' ],
        'desktop_default' => [
          'size' => 300,
          'unit' => 'px',
        ],
        'tablet_default' => [
          'size' => 250,
          'unit' => 'px',
        ],
        'mobile_default' => [
          'size' => 250,
          'unit' => 'px',
        ],
        'selectors' => [
          '{{WRAPPER}} .featured-post .item' => 'min-height: {{SIZE}}{{UNIT}};',
        ],

      ]
    );

    $this->add_responsive_control(
      'col_number',
      [
        'label' =>esc_html__( 'Column number', 'digiqole' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 1000,
          ],
        ],
        'devices' => [ 'desktop', 'tablet', 'mobile' ],
        'desktop_default' => [
          'size' => 300,
          'unit' => 'px',
        ],
        'tablet_default' => [
          'size' => 250,
          'unit' => 'px',
        ],
        'mobile_default' => [
          'size' => 250,
          'unit' => 'px',
        ],
        'selectors' => [
          '{{WRAPPER}} .featured-post .item' => 'min-height: {{SIZE}}{{UNIT}};',
        ],

      ]
    );


    $this->end_controls_section();

    $this->start_controls_section(
			'typography_section',
			[
				'label' => __( 'Typography and text settings', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
        'label' => __( 'Title typography', 'plugin-domain' ),
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .title',
			]
		);

    $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
        'label' => __( 'Description typography', 'plugin-domain' ),
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .description',
			]
		);

    $this->add_control(
    'title_color',
    [
      'label' => __( 'Title Color', 'plugin-domain' ),
      'type' => \Elementor\Controls_Manager::COLOR,
      'scheme' => [
        'type' => \Elementor\Scheme_Color::get_type(),
        'value' => \Elementor\Scheme_Color::COLOR_1,
      ],
      'selectors' => [
        '{{WRAPPER}} .title' => 'color: {{VALUE}}',
      ],
    ]
  );

    $this->end_controls_section();

    $this->start_controls_section(
			'border_section',
			[
				'label' => __( 'Grid item border', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


    $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .wrapper',
			]
		);

    $this->end_controls_section();

    $this->start_controls_section(
      'sizing_section',
      [
        'label' => __( 'Paddings and margins', 'plugin-name' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_responsive_control(
    	'grid_item_padding',
    	[
    		'label' =>esc_html__( 'Grid item padding', 'digiqole' ),
    		'type' => \Elementor\Controls_Manager::DIMENSIONS,
    		'size_units' => [ 'px', 'em', '%' ],
    		'selectors' => [
    			'{{WRAPPER}} .wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
    		],
    	]
      );

      $this->add_responsive_control(
      	'grid_item_margin',
      	[
      		'label' =>esc_html__( 'Grid item margin', 'digiqole' ),
      		'type' => \Elementor\Controls_Manager::DIMENSIONS,
      		'size_units' => [ 'px', 'em', '%' ],
      		'selectors' => [
      			'{{WRAPPER}} .wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
      		],
      	]
        );

        $this->add_control(
        'grid_item_color',
        [
          'label' => __( 'Grid item color', 'plugin-domain' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          // 'scheme' => [
          //   'type' => \Elementor\Scheme_Color::get_type(),
          //   'value' => \Elementor\Scheme_Color::COLOR_1,
          // ],
          'default' => '#ffffff',
          'selectors' => [
            '{{WRAPPER}} .wrapper' => 'background-color: {{VALUE}}',
          ],
        ]
      );

    $this->add_responsive_control(
			'thumbnail_margin_bottom',
			[
				'label' => __( 'Thumbnail margin bottom', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 30,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 20,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .widget-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

    // $this->start_controls_section(
    //   'style_section',
    //   [
    //     'label' => __( 'Style Section', 'plugin-name' ),
    //     'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    //   ]
    // );
    //
    // $this->add_responsive_control(
		// 	'grid_margin',
		// 	[
		// 		'label' =>esc_html__( 'margin', 'digiqole' ),
		// 		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', 'em', '%' ],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .grid-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
    //   );
    //
    // $this->end_controls_section();
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
    $show_cat           = $settings['show_cat'];
    $show_date          = $settings['show_date'];
    $show_author         = $settings['show_author'];
    $number_of_columns_phone = $settings['number_of_columns_phone'];
    $number_of_columns_tablet = $settings['posts_per_page'];
    $number_of_columns_desktop = $settings['number_of_columns_desktop'];
    $crop	= (isset($settings['post_title_crop'])) ? $settings['post_title_crop'] : 20;
    $post_content_crop	= (isset($settings['post_content_crop'])) ? $settings['post_content_crop'] : 50;

    $this->add_inline_editing_attributes( 'title', 'none' );
    // $this->add_inline_editing_attributes( 'order_by', 'advanced' );
    // $this->add_inline_editing_attributes( 'post_count', 'advanced' );
    ?>
    <?php
    $arg = [
      'post_type'   =>  'post',
      'post_status' => 'publish',
      'orderby' => $settings['order_by'],
      'posts_per_page' => $settings['post_count'],
      // 'category__in' => $settings['post_categories'],
      // 'tag' => 'family, games, fun',
      // 'tag' => $settings['post_tags'],
      'meta_key'    => 'number_of_views',
      'order' => $settings['order'],
    ];

    if($settings['post_pick_by']=='stickypost'){
           $arg['post__in'] = get_option( 'sticky_posts' );
           $arg['ignore_sticky_posts'] = 1;
        }

        if($settings['post_pick_by']=='category') {
           $arg['category__in'] = $settings['post_categories'];
        }

        if($settings['post_pick_by']=='tags') {
           $arg['tag__in'] = $settings['post_tags'];
        }

        if($settings['post_pick_by']=='post') {
           $digiqole_posts = explode(',',$settings['post_id']);
           $arg['post__in'] = $digiqole_posts;
           $arg['posts_per_page'] = count($digiqole_posts);
        }

        if($settings['post_pick_by']=='author') {
         $digiqole_authors = explode(',',$settings['author_id']);
         $arg['author__in'] = $digiqole_authors;
        }

    $queryd = new \WP_Query( $arg );
    if ( $queryd->have_posts() ) : ?>
    <div class="row">
      <div class="col-12">
        <h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h2>
        <p><?php echo get_field('number_of_views'); ?></p>
        <h3>
          <?php $allTags = $settings['post_tags'];
          foreach ($allTags as $oneTag) {
            $theTag = get_term_by($oneTag, 'term_id', 'tags');
            echo $oneTag->name;
          }
          ?>
        </h3>
      </div>
      <?php while ($queryd->have_posts()) : $queryd->the_post(); ?>
        <div class="col-<?php echo $number_of_columns_phone ?> col-md-<?php echo $number_of_columns_tablet ?> col-lg-<?php echo $number_of_columns_desktop ?>">
          <!-- <h6><?php echo get_the_title(); ?></h6> -->
          <div class="wrapper">
          <p style="color:blue">
            <?php the_tags(); ?>
          </p>
          <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="widget-image d-block">
              <?php the_post_thumbnail('featured-small', ['class' => 'img-fluid', 'title' => 'Feature image']); ?>
            </a>
          <?php endif; ?>
          <div class="views">
            <?php echo get_field('number_of_views'); ?>
          </div>
          <div class="category">
            <?php if($show_cat) {
              the_category();
              wp_list_authors( array(
                  'show_fullname' => 1,
                  'optioncount'   => 1,
                  'html'          => false,
                  'orderby'       => 'post_count',
                  'order'         => $settings['Order'],
              ) );
            }
            ?>
          </div>
          <div class="date">
            <?php if($show_date) {
              the_date( 'F j, Y' );
            }
            ?>
          </div>
          <div class="author">
            <?php if($show_author) {?>
              <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="author-avatar">
                <?php echo get_avatar( get_the_author_meta( 'ID' ), 40); ?>
              </a>
              <span>by <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></span>
            <?php } ?>
          </div>
          <!-- <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?> -->
          <h2 class="title"><?php echo esc_html(wp_trim_words(get_the_title(), $crop,'')); ?></h2>
          <p><?php esc_html(wp_trim_words(get_the_excerpt(), $post_content_crop, '...') );?></p>
          <h2><?php echo $post_content_crop ?></h2>
        </div>
        </div>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    </div>
  <?php endif; ?>
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

function digiqole_post_tags(){
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

function digiqole_post_authors(){
  $terms = wp_list_authors( array(
      'show_fullname' => 1,
      'optioncount'   => 1,
      'html'          => false,
      'orderby'       => 'post_count',
      'order'         => 'DESC',
  ) );

  $cat_list = [];
  foreach($terms as $post) {
    $cat_list[$post->term_id]  = [$post->name];
  }
  return $cat_list;
}

}
