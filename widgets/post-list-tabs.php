<?php
namespace ElementorAwesomesauce\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* @since 1.1.0
*/
class PostListTabs extends Widget_Base {

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
  return 'post-list-tabs';
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
  return __( 'Post List Tabs', 'elementor-post-tabs' );
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
    'show_title',
    [
      'label' => esc_html__('Show title', 'elementor_awesomesauce'),
      'type' => Controls_Manager::SWITCHER,
      'label_on' => esc_html__('Yes', 'elementor_awesomesauce'),
      'label_off' => esc_html__('No', 'elementor_awesomesauce'),
      'default' => 'yes',
    ]
  );

  $this->add_control(
    'title',
    [
      'label' => __( 'Title', 'elementor-awesomesauce' ),
      'type' => Controls_Manager::TEXT,
      'default' => __( 'Posts', 'elementor-awesomesauce' ),
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


  $this->end_controls_section();

  $this->start_controls_section(
    'typography_section',
    [
      'label' => __( 'Typography and text settings', 'elementor-awesomesauce' ),
      'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]
  );

  $this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
      'label' => __( 'Title typography', '' ),
      'name' => 'title_typography',
      'selector' => '{{WRAPPER}} .title',
    ]
  );

  $this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
      'label' => __( 'Description typography', '' ),
      'name' => 'desc_typography',
      'selector' => '{{WRAPPER}} .description',
    ]
  );

  $this->add_control(
    'title_color',
    [
      'label' => __( 'Title Color', '' ),
      'type' => \Elementor\Controls_Manager::COLOR,
      'default' => '#000000',
      'selectors' => [
        '{{WRAPPER}} .title' => 'color: {{VALUE}}',
      ],
    ]
  );

  $this->end_controls_section();

  $this->start_controls_section(
    'border_section',
    [
      'label' => __( 'Grid item border', 'elementor-awesomesauce' ),
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
      'label' => __( 'Paddings, margins and background', 'elementor-awesomesauce' ),
      'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]
  );

  $this->add_responsive_control(
    'grid_item_padding',
    [
      'label' =>esc_html__( 'Grid item padding', 'elementor_awesomesauce' ),
      'type' => \Elementor\Controls_Manager::DIMENSIONS,
      'size_units' => [ 'px', 'em', '%' ],
      'selectors' => [
        '{{WRAPPER}} .wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
      ],
    ]
  );

  $this->add_responsive_control(
    'grid_item_column_gap',
    [
      'label' =>esc_html__( 'Grid item column gap (css grid)', 'elementor_awesomesauce' ),
      'type' => \Elementor\Controls_Manager::NUMBER,
      'default' => 15,
      'selectors' => [
        '{{WRAPPER}} .wrapper' => 'column-gap: {{VALUE}}px;',
      ],
    ]
  );

  $this->add_responsive_control(
    'grid_item_row_gap',
    [
      'label' =>esc_html__( 'Grid item row gap (css grid)', 'elementor_awesomesauce' ),
      'type' => \Elementor\Controls_Manager::NUMBER,
      'default' => 15,
      'selectors' => [
        '{{WRAPPER}} .big-wrapper' => 'row-gap: {{VALUE}}px;',
      ],
    ]
  );

  $this->add_control(
    'grid_item_color',
    [
      'label' => __( 'Grid item color', '' ),
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
  <?php if($show_title) { ?>
      <h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h2>
  <?php }  ?>
  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a id="" class="nav-item nav-link active" data-toggle="tab" href="#posts-recent" role="tab" aria-controls="" aria-selected="true">Latest</a>
      <a id="" class="nav-item nav-link" data-toggle="tab" href="#posts-views" role="tab" aria-controls="" aria-selected="false">Popular</a>
      <a id="" class="nav-item nav-link" data-toggle="tab" href="#posts-comments" role="tab" aria-controls="" aria-selected="false">Comments</a>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div role="tabpanel" class="tab-pane active post-tab-list" id="posts-recent">
      <?php
      $arg = array(
      'post_type'   =>  'post',
        'post_status' => 'publish',
        'posts_per_page' => $settings['post_count'],
        'orderby' => 'date',
        'category__in' => $value['post_cats'],
        'meta_key'    => 'number_of_views',
        'order' => $settings['order'],
      );

      $queryd = new \WP_Query( $arg );
      if ( $queryd->have_posts() ) : ?>
      <!-- <div class="row"> -->
        <div class="big-wrapper" style="display:grid">
          <?php while ($queryd->have_posts()) : $queryd->the_post(); ?>
            <div class="wrapper"  style="display:grid;grid-template-columns:1fr 2fr;">
              <?php if ( has_post_thumbnail() ) : ?>
                <div class="thumbnail">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="widget-image d-block">
                  <?php the_post_thumbnail('featured-small', ['class' => 'img-fluid', 'title' => 'Feature image']); ?>
                </a>
              </div>
              <?php endif; ?>
              <div class="description">

                <?php if($show_cat) { ?>
                  <div class="category">
                    <?php
                    $categories = get_the_category();
                    foreach ( $categories as $category ) {
                        echo '<span style="display:inline-block; color:white;padding:5px 10px; margin-right:10px; background-color:'.get_field('category_colors', $category).'" class="acf-category-color">'.$category->name.'</span>';
                    }
                    ?>
                  </div>
                <?php }  ?>

                <h2 class="title"><?php echo esc_html(wp_trim_words(get_the_title(), $crop,'')); ?></h2>

                <?php if($settings['show_excerpt']) {?>
                  <p><?php echo esc_html( wp_trim_words(get_the_excerpt(),$settings['post_content_crop'],'...') );?></p>
                <?php } ?>

                <?php if($show_author) {?>
                  <div class="author">
                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="author-avatar">
                      <?php echo get_avatar( get_the_author_meta( 'ID' ), 40); ?>
                    </a>
                    <span>by <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></span>
                  </div>
                <?php } ?>


                <?php if($show_date) { ?>
                  <div class="date">
                    <?php the_date( 'F j, Y' ); ?>
                  </div>
                <?php }  ?>

                <?php if($show_comments) { ?>
                  <div class="comments">
                    <?php  echo get_comments_number(); ?>
                  </div>
                <?php }  ?>
                <?php if($show_views) { ?>
                  <div class="views">
                    <?php  echo get_field('number_of_views'); ?>
                  </div>
                <?php }  ?>

                <?php if($show_tags) { ?>
                  <div class="tags">
                    <?php  the_tags(); ?>
                  </div>
                <?php }  ?>
              </div>
            </div>
            <!-- </div> -->
          <?php endwhile; ?>
        </div>
        <?php wp_reset_postdata(); ?>
      <!-- </div> -->
    <?php endif; ?>
    </div>

    <div role="tabpanel" class="tab-pane  post-tab-list" id="posts-views">
      <?php
      $arg2 = array(
      'post_type'   =>  'post',
        'post_status' => 'publish',
        'posts_per_page' => $settings['post_count'],
        'orderby' => 'meta_value_num',
        'category__in' => $value['post_cats'],
        'meta_key'    => 'number_of_views',
        'order' => $settings['order'],
      );

      $queryd = new \WP_Query( $arg2 );
      if ( $queryd->have_posts() ) : ?>
      <!-- <div class="row"> -->
        <?php if($show_title) { ?>
            <h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h2>
        <?php }  ?>
        <div class="big-wrapper"  style="display:grid">
          <?php while ($queryd->have_posts()) : $queryd->the_post(); ?>
            <div class="wrapper"  style="display:grid;grid-template-columns:1fr 2fr;">
              <?php if ( has_post_thumbnail() ) : ?>
                <div class="thumbnail">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="widget-image d-block">
                  <?php the_post_thumbnail('featured-small', ['class' => 'img-fluid', 'title' => 'Feature image']); ?>
                </a>
              </div>
              <?php endif; ?>
              <div class="description">

                <?php if($show_cat) { ?>
                  <div class="category">
                    <?php
                    $categories = get_the_category();
                    foreach ( $categories as $category ) {
                        echo '<span style="display:inline-block; color:white;padding:5px 10px; margin-right:10px; background-color:'.get_field('category_colors', $category).'" class="acf-category-color">'.$category->name.'</span>';
                    }
                    ?>
                  </div>
                <?php }  ?>

                <h2 class="title"><?php echo esc_html(wp_trim_words(get_the_title(), $crop,'')); ?></h2>

                <?php if($settings['show_excerpt']) {?>
                  <p><?php echo esc_html( wp_trim_words(get_the_excerpt(),$settings['post_content_crop'],'...') );?></p>
                <?php } ?>

                <?php if($show_author) {?>
                  <div class="author">
                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="author-avatar">
                      <?php echo get_avatar( get_the_author_meta( 'ID' ), 40); ?>
                    </a>
                    <span>by <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></span>
                  </div>
                <?php } ?>


                <?php if($show_date) { ?>
                  <div class="date">
                    <?php the_date( 'F j, Y' ); ?>
                  </div>
                <?php }  ?>

                <?php if($show_comments) { ?>
                  <div class="comments">
                    <?php  echo get_comments_number(); ?>
                  </div>
                <?php }  ?>
                <?php if($show_views) { ?>
                  <div class="views">
                    <?php  echo get_field('number_of_views'); ?>
                  </div>
                <?php }  ?>

                <?php if($show_tags) { ?>
                  <div class="tags">
                    <?php  the_tags(); ?>
                  </div>
                <?php }  ?>
              </div>
            </div>
            <!-- </div> -->
          <?php endwhile; ?>
        </div>
        <?php wp_reset_postdata(); ?>
      <!-- </div> -->
    <?php endif; ?>
    </div>
    <div role="tabpanel" class="tab-pane  post-tab-list" id="posts-comments">
      <?php
      $arg3 = array(
      'post_type'   =>  'post',
        'post_status' => 'publish',
        'posts_per_page' => $settings['post_count'],
        'orderby' => 'comment_count',
        'category__in' => $value['post_cats'],
        'order' => $settings['order'],
      );

      $queryd = new \WP_Query( $arg3);
      if ( $queryd->have_posts() ) : ?>
      <!-- <div class="row"> -->
        <?php if($show_title) { ?>
            <h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h2>
        <?php }  ?>
        <div class="big-wrapper"  style="display:grid">
          <?php while ($queryd->have_posts()) : $queryd->the_post(); ?>
            <div class="wrapper"  style="display:grid;grid-template-columns:1fr 2fr;">
              <?php if ( has_post_thumbnail() ) : ?>
                <div class="thumbnail">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="widget-image d-block">
                  <?php the_post_thumbnail('featured-small', ['class' => 'img-fluid', 'title' => 'Feature image']); ?>
                </a>
              </div>
              <?php endif; ?>
              <div class="description">

                <?php if($show_cat) { ?>
                  <div class="category">
                    <?php
                    $categories = get_the_category();
                    foreach ( $categories as $category ) {
                        echo '<span style="display:inline-block; color:white;padding:5px 10px; margin-right:10px; background-color:'.get_field('category_colors', $category).'" class="acf-category-color">'.$category->name.'</span>';
                    }
                    ?>
                  </div>
                <?php }  ?>

                <h2 class="title"><?php echo esc_html(wp_trim_words(get_the_title(), $crop,'')); ?></h2>

                <?php if($settings['show_excerpt']) {?>
                  <p><?php echo esc_html( wp_trim_words(get_the_excerpt(),$settings['post_content_crop'],'...') );?></p>
                <?php } ?>

                <?php if($show_author) {?>
                  <div class="author">
                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="author-avatar">
                      <?php echo get_avatar( get_the_author_meta( 'ID' ), 40); ?>
                    </a>
                    <span>by <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></span>
                  </div>
                <?php } ?>


                <?php if($show_date) { ?>
                  <div class="date">
                    <?php the_date( 'F j, Y' ); ?>
                  </div>
                <?php }  ?>

                <?php if($show_comments) { ?>
                  <div class="comments">
                    <?php  echo get_comments_number(); ?>
                  </div>
                <?php }  ?>
                <?php if($show_views) { ?>
                  <div class="views">
                    <?php  echo get_field('number_of_views'); ?>
                  </div>
                <?php }  ?>

                <?php if($show_tags) { ?>
                  <div class="tags">
                    <?php  the_tags(); ?>
                  </div>
                <?php }  ?>
              </div>
            </div>
            <!-- </div> -->
          <?php endwhile; ?>
        </div>
        <?php wp_reset_postdata(); ?>
      <!-- </div> -->
    <?php endif; ?>
    </div>
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
