<?php
namespace ElementorAwesomesauce\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* @since 1.1.0
*/
class FeaturedGallery extends Widget_Base {

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
  return 'featured-gallery';
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
  return __( 'Featured Gallery', 'elementor-featured-gallery' );
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
      'default' => __( 'Categories', 'elementor-awesomesauce' ),
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

  $this->add_control(
    'tabs',
    [
      'label' => esc_html__('Tabs', 'elementor-awesomesauce'),
      'type' => Controls_Manager::REPEATER,
      'default' => [
        [
          'tab_title' => esc_html__('Add Label', 'elementor-awesomesauce'),
          'post_cats' => 1,
        ],
      ],
      'fields' => [
        [
          'name' => 'post_cats',
          'label' => __( 'Categories( Include )', 'elementor-awesomesauce' ),
          'type' => \Elementor\Controls_Manager::SELECT2,
          'options' => $this->post_category(),
          'label_block' => true,
          'multiple' => true,
        ],
        [
          'name' => 'tab_title',
          'label'         => esc_html__( 'Tab title', 'elementor-awesomesauce' ),
          'type'          => Controls_Manager::TEXT,
          'default'       => 'Add Label',
        ],
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
}

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

}
