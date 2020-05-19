<?php
namespace ElementorAwesomesauce\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* @since 1.1.0
*/
class PostTabsTypeOne extends Widget_Base {

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
  return 'post-tabs-type-one';
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
  return __( 'Post Tabs Type One', 'elementor-post-tabs-type-one' );
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
  $settings = $this->get_settings_for_display();
  $tabs = $settings['tabs'];
  $post_count = count($tabs);
  $show_date = $settings['show_date'];

  ?>
  <h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h2>


  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <?php foreach ($tabs as $tab_key=>$value) {
        if( $tab_key == 0 ){
          echo '<a id="nav-'.$this->get_id().$value['_id'].'-tab" class="nav-link active" href="#nav-'.$this->get_id().$value['_id'].'" data-toggle="tab" aria-controls="nav-'.$this->get_id().$value['_id'].'" aria-selected="true">'.$value['tab_title'].'</a>';
        } else {
          echo '<a id="nav-'.$this->get_id().$value['_id'].'-tab" class="nav-link" href="#nav-'.$this->get_id().$value['_id'].'" data-toggle="tab" aria-controls="nav-'.$this->get_id().$value['_id'].'" aria-selected="false">'.$value['tab_title'].'</a>';
        }
      }?> 
    </div>
  </nav>

  <div class="tab-content" id="nav-tabContent">
    <?php foreach ($tabs as $content_key=>$value) {

      if( $content_key == 0){
        echo '<div role="tabpanel" class="tab-pane fade active show" id="nav-'.$this->get_id().$value['_id'].'" aria-labelledby="nav-'.$this->get_id().$value['_id'].'-tab">';
      } else {
        echo '<div role="tabpanel" class="tab-pane fade" id="nav-'.$this->get_id().$value['_id'].'" aria-labelledby="nav-'.$this->get_id().$value['_id'].'-tab">';
      }

      $args = array(
        'post_type'   =>  'post',
        'post_status' => 'publish',
        'posts_per_page' => 6,
        'category__in' => $value['post_cats'],
      );

      $query = new \WP_Query($args); ?>

      <?php if ( $query->have_posts() ) : ?>
        <div class="row">
          <?php $i=0; ?>
          <?php while ($query->have_posts()) : $query->the_post(); ?>
            <?php $i++; ?>
            <?php if ( $i == 1 ) : ?>
              <div class="col-12">
                <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" style="float:left;margin-right:20px;padding:10px;background:white;"><?php the_post_thumbnail('medium-horizontal'); ?></a>
                       <h5><?php the_title();?></h5>
                       <?php the_excerpt() ?>
              <?php if($show_date == 'yes') { ?>
                <span class="post-date"> <i class="fa fa-clock-o"></i> <?php echo get_the_date(get_option('date_format')); ?></span>
              <?php } ?>
              </div>
              <?php else : ?>
                <div class="col-6">
                  <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" style="float:left;margin-right:20px;padding:10px;background:white;"><?php the_post_thumbnail('small-horizontal'); ?></a>
                       <h5><?php the_title();?></h5>
              <?php if($show_date == 'yes') { ?>
                <span class="post-date"> <i class="fa fa-clock-o"></i> <?php echo get_the_date(get_option('date_format')); ?></span>
              <?php } ?>
                </div>
              <?php endif ?>
            <?php endwhile; 
            wp_reset_postdata(); 
            $i = 0;?>
          </div>
        <?php endif; ?>
      </div><!-- Tab pane 1 end -->
      <?php } ?> <!-- closing tab content -->

    </div> <!-- closing foreach -->
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

}