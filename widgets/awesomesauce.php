<?php
namespace ElementorAwesomesauce\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Awesomesauce extends Widget_Base {

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
    return 'awesomesauce';
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
    return __( 'Awesomesauce', 'elementor-awesomesauce' );
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
        'default' => __( 'Title', 'elementor-awesomesauce' ),
      ]
    );

    $this->add_control(
      'order_by',
      [
        'label' => __( 'Order by', 'elementor-awesomesauce' ),
        'type' => Controls_Manager::SELECT,
        'default' => __( 'date', 'elementor-awesomesauce' ),
      ]
    );

    $this->add_control(
      'post_count',
      [
        'label' => __( 'Post count', 'elementor-awesomesauce' ),
        'type' => Controls_Manager::NUMBER,
        'default' => __( '4', 'elementor-awesomesauce' ),
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

    $this->add_inline_editing_attributes( 'title', 'none' );
    // $this->add_inline_editing_attributes( 'order_by', 'advanced' );
    // $this->add_inline_editing_attributes( 'post_count', 'advanced' );
    ?>
    <h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h2>
    <?php


    $arg = [
            'post_type'   =>  'post',
            'post_status' => 'publish',
            'order' => $settings['order_by'],
            'posts_per_page' => $settings['post_count'],
        ];

     $query = new \WP_Query( $arg ); ?>



        <?php if ( $query->have_posts() ) : ?>
           <?php while ($query->have_posts()) : $query->the_post(); ?>
           <div class="grid-item">
                <?php echo get_the_title(); ?>
           </div>
            <?php endwhile; ?>

        <?php endif;
  }

  /**
   * Render the widget output in the editor.
   *
   * Written as a Backbone JavaScript template and used to generate the live preview.
   *
   * @since 1.1.0
   *
   * @access protected
   */
  protected function _content_template() {

  }
}
