<?php
namespace ElementorAwesomesauce\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* @since 1.1.0
*/
class FeaturedPosts2 extends Widget_Base {

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
  return 'featured-posts-2';
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
  return __( 'Featured Posts 2', 'elementor-featured-posts-2' );
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
      'default' => __('Featured posts', 'elementor-awesomesauce' ),
    ]
  );

  $this->add_control(
    'post_count',
    [
      'label' => __( 'Post count', 'elementor-awesomesauce' ),
      'type' => Controls_Manager::NUMBER,
      'default' => __( '6', 'elementor-awesomesauce' ),
    ]
  );

  $this->add_control(
    'show_date',
    [
      'label' => esc_html__('Show Date', 'elementor-awesomesauce'),
      'type' => Controls_Manager::SWITCHER,
      'label_on' => esc_html__('Yes', 'digiqole'),
      'label_off' => esc_html__('No', 'digiqole'),
      'default' => 'yes',
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
  $post_count = $settings['post_count'];
  $show_date = $settings['show_date'];
  $title = $settings['title'];

  ?>
  <h2><?php $title ?></h2>

  <div class="tab-content" id="nav-tabContent">


    <?php $args = array(
      'post_type'   =>  'post',
      'post_status' => 'publish',
      'posts_per_page' => $post_count,
      'meta_key'    => 'is_post_featured_small',
      'meta_value'  => true
    );

    $query = new \WP_Query($args); ?>

    <?php if ( $query->have_posts() ) : ?>
      <div class="row">
      <?php $i=0; ?>
      <?php while ($query->have_posts()) : $query->the_post(); ?>
        <?php $i++; ?>
        <div class="col-4">
            <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" style="padding:10px;background:white;"><?php the_post_thumbnail('medium-horizontal'); ?></a>
            <h5><?php the_title();?></h5>
            <?php if($show_date == 'yes') { ?>
              <span class="post-date"> <i class="fa fa-clock-o"></i> <?php echo get_the_date(get_option('date_format')); ?></span>
            <?php } ?>
          </div>
        <?php endwhile;
        wp_reset_postdata();
        $i = 0;?>
      </div>
      <?php endif; ?>
    </div>
  <?php }

  protected function _content_template() {

  }

  public function post_category() {

    $terms = get_terms( array(
      'taxonomy'    => 'category',
      'hide_empty'  => false,
      'posts_per_page' => $post_count,
      'suppress_filters' => false,
    ) );

    $cat_list = [];
    foreach($terms as $term) {
      $cat_list[$term->term_id]  = [$term->name];
    }
    return $cat_list;
  }

}
