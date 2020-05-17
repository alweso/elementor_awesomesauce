<?php
namespace ElementorAwesomesauce\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* @since 1.1.0
*/
class PostTabs extends Widget_Base {

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
  return 'post-tabs';
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
  return __( 'Post Tabs', 'elementor-post-tabs' );
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
      'default' => __( 'Latest posts', 'elementor-awesomesauce' ),
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

$output_categories = array();
$categories=get_categories($args);
  foreach($categories as $category) { 
     $output_categories[$category->cat_ID] = $category->name;
}
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
          'options' => $output_categories,
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
  $show_cat           = $settings['show_cat'];
  $show_date          = $settings['show_date'];
  $show_author         = $settings['show_author'];

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



  <div class="tab-content" id="nav-tabContent">
    <?php foreach ($tabs as $content_key=>$value) {
      if( $content_key == 0){
        echo '<div class="tab-pane fade show active" role="tabpanel"  id="nav-'.$this->get_id().$value['_id'].'" aria-labelledby="nav-'.$this->get_id().$value['_id'].'-tab">';
      } else {
        echo '<div class="tab-pane fade" role="tabpanel" id="nav-'.$this->get_id().$value['_id'].'"aria-labelledby="nav-'.$this->get_id().$value['_id'].'-tab">';
      }
      ?><div class="row"><?php

      $arg = array(
      'post_type'   =>  'post',
        'post_status' => 'publish',
        'posts_per_page' => $settings['post_count'],
        'category__in' => $value['post_cats'],
      );



      $queryd = new \WP_Query( $arg ); 

      if ( $queryd->have_posts() ) : ?>
        <?php while ($queryd->have_posts()) : $queryd->the_post(); ?>
          <div class="col-sm-4">
            <!-- <h6><?php echo get_the_title(); ?></h6> -->

            <?php if ( has_post_thumbnail() ) : ?>
              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php the_post_thumbnail('featured-small', ['class' => 'img-fluid', 'title' => 'Feature image']); ?>
              </a>
            <?php endif; ?>
            <div class="category">
              <?php if($show_cat) {
                the_category();
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
              <?php }
              ?>
            </div>
            <?php if ( has_post_thumbnail() ) : ?>
              <?php
              the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
              ?>
              <?php else : ?>
                <?php
                the_title( sprintf( '<h4 class="entry-title no-image"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
                ?>
              <?php endif ?>
            </div>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        <?php endif; ?>
      </div>
    </div>
  <?php } ?>
</div>
<?php }

protected function _content_template() {

}
}