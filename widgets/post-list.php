<?php
namespace ElementorAwesomesauce\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* @since 1.1.0
*/
class PostList extends Widget_Base {

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
    return 'post-list';
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
    return __( 'Post List', 'elementor-post-list' );
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
        'default' => __( 'Post list', 'elementor-awesomesauce' ),
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
        'label'     => esc_html__( 'Post pick by', 'elementor_awesomesauce' ),
        'type'      => Controls_Manager::SELECT,
        'default'   => '',
        'options'   => [
          'category'      =>esc_html__( 'Category', 'elementor_awesomesauce' ),
          'tags'      =>esc_html__( 'Tags', 'elementor_awesomesauce' ),
          'stickypost'    =>esc_html__( 'Sticky posts', 'elementor_awesomesauce' ),
          'post'    =>esc_html__( 'Post id', 'elementor_awesomesauce' ),
          'author'    =>esc_html__( 'Author', 'elementor_awesomesauce' ),
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
        'label' => esc_html__('Select tags', 'elementor_awesomesauce'),
        'type' => Controls_Manager::SELECT2,
        'options' => $this->elementor_awesomesauce_post_tags(),
        'label_block' => true,
        'multiple' => true,
        'condition' => [ 'post_pick_by' => ['tags'] ]
      ]
    );

    $this->add_control(
      'author_id',
      [
        'label' => esc_html__( 'Author id', 'elementor_awesomesauce' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => esc_html__( '1,2,3', 'elementor_awesomesauce' ),
        'condition' => [ 'post_pick_by' => ['author'] ]
      ]
    );
    $this->add_control(
      'post_id',
      [
        'label' => esc_html__( 'Post id', 'elementor_awesomesauce' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => esc_html__( '1,2,3', 'elementor_awesomesauce' ),
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
        'label' => __( 'List item border', 'elementor-awesomesauce' ),
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
        'label' => __( 'Paddings and margins', 'elementor-awesomesauce' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_responsive_control(
      'list_item_padding',
      [
        'label' =>esc_html__( 'List item padding', 'elementor_awesomesauce' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', 'em', '%' ],
        'selectors' => [
          '{{WRAPPER}} .wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'list_item_row_gap',
      [
        'label' =>esc_html__( 'List item row gap (css grid)', 'elementor_awesomesauce' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 15,
        'selectors' => [
          '{{WRAPPER}} .wrapper' => 'margin-bottom: {{VALUE}}px;',
        ],
      ]
    );

    $this->add_control(
      'list_item_color',
      [
        'label' => __( 'List item color', '' ),
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
        'label' => __( 'Thumbnail margin bottom', 'elementor-awesomesauce' ),
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
    $show_title         = $settings['show_title'];
    $show_cat           = $settings['show_cat'];
    $show_date          = $settings['show_date'];
    $show_author         = $settings['show_author'];
    $show_views         = $settings['show_views'];
    $show_comments         = $settings['show_comments'];
    $show_tags        = $settings['show_tags'];
    $crop	= (isset($settings['post_title_crop'])) ? $settings['post_title_crop'] : 20;
    $post_content_crop	= (isset($settings['post_content_crop'])) ? $settings['post_content_crop'] : 50;

    $this->add_inline_editing_attributes( 'title', 'none' );
    ?>
    <?php
    $arg = [
      'post_type'   =>  'post',
      'post_status' => 'publish',
      'orderby' => $settings['order_by'],
      'posts_per_page' => $settings['post_count'],
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
      $elementor_awesomesauce_posts = explode(',',$settings['post_id']);
      $arg['post__in'] = $elementor_awesomesauce_posts;
      $arg['posts_per_page'] = count($elementor_awesomesauce_posts);
    }

    if($settings['post_pick_by']=='author') {
      $elementor_awesomesauce_authors = explode(',',$settings['author_id']);
      $arg['author__in'] = $elementor_awesomesauce_authors;
    }

    $queryd = new \WP_Query( $arg );
    if ( $queryd->have_posts() ) : ?>
    <div class="row">
      <?php if($show_title) { ?>
        <div class="col-12">
          <h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h2>
        </div>
      <?php }  ?>
      <div class="big-wrapper">
        <?php while ($queryd->have_posts()) : $queryd->the_post(); ?>
          <div class="wrapper" style="display:grid;grid-template-columns:1fr 3fr;grid-column-gap:15px;">
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
                  <?php the_category(); ?>
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

function elementor_awesomesauce_post_authors(){
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
