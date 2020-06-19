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
      'post_count',
      [
        'label' => __( 'Post count', 'elementor-awesomesauce' ),
        'type' => Controls_Manager::NUMBER,
        'default' => __( 4, 'elementor-awesomesauce' ),
      ]
    );

    $this->add_control(
      'post_categories',
      [
        'label' => __( 'Choose categories', 'elementor-awesomesauce' ),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'options' => $this->post_category(),
        'label_block' => true,
        'multiple' => true,
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


		$this->add_responsive_control(
			'number_of_columns',
			[
				'label' => __( 'Number of columns', 'plugin-name' ),
				'type' => Controls_Manager::SELECT,
        'default' => __( '12', 'elementor-awesomesauce' ),
        'options' => [
          '6'  => __( '2', 'elementor-awesomesauce' ),
          '4' => __( '3', 'elementor-awesomesauce' ),
          '3' => __( '4', 'elementor-awesomesauce' ),
        ],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'number_of_columns_desktop' => [
          'default' => __( '12', 'elementor-awesomesauce' ),
          'options' => [
            '6'  => __( '2', 'elementor-awesomesauce' ),
  					'4' => __( '3', 'elementor-awesomesauce' ),
  					'3' => __( '4', 'elementor-awesomesauce' ),
  				],
				],
				'number_of_columns_tablet' => [
          'default' => __( '12', 'elementor-awesomesauce' ),
          'options' => [
            '12'  => __( '1', 'elementor-awesomesauce' ),
  					'6'  => __( '2', 'elementor-awesomesauce' ),
  					'4' => __( '3', 'elementor-awesomesauce' ),
  					'3' => __( '4', 'elementor-awesomesauce' ),
  				],
				],
				'number_of_columns_phone' => [
          'default' => __( '12', 'elementor-awesomesauce' ),
          'options' => [
            '12'  => __( '1', 'elementor-awesomesauce' ),
  					'6'  => __( '2', 'elementor-awesomesauce' ),
  				],
				],
				'selectors' => [
					'{{WRAPPER}} .widget-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

    $this->add_control(
      'show_on_phones',
      [
        'label' => esc_html__('Show on phones', 'digiqole'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => esc_html__('', 'digiqole'),
        'label_off' => esc_html__('col-hidden', 'digiqole'),
        'default' => '',
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
      'show_on_tablets',
      [
        'label' => esc_html__('Show on tablets', 'digiqole'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => esc_html__('', 'digiqole'),
        'label_off' => esc_html__('col-md-hidden', 'digiqole'),
        'default' => '',
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
      'show_on_desktop',
      [
        'label' => esc_html__('Show on phones', 'digiqole'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => esc_html__('', 'digiqole'),
        'label_off' => esc_html__('col-lg-hidden', 'digiqole'),
        'default' => '',
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
    $show_cat           = $settings['show_cat'];
    $show_date          = $settings['show_date'];
    $show_author         = $settings['show_author'];
    $number_of_columns_phone = $settings['number_of_columns_phone'];
    $number_of_columns_tablet = $settings['number_of_columns_tablet'];
    $number_of_columns_desktop = $settings['number_of_columns_desktop'];

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
      'category__in' => $settings['post_categories'],
      'meta_key'    => 'number_of_views',

    ];
    $queryd = new \WP_Query( $arg );
    if ( $queryd->have_posts() ) : ?>
    <div class="row">
      <div class="col-12">
        <h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h2>
        <p><?php echo get_field('number_of_views'); ?></p>
      </div>
      <?php while ($queryd->have_posts()) : $queryd->the_post(); ?>
        <div class="col-<?php echo $number_of_columns_phone ?> col-md-<?php echo $number_of_columns_tablet ?> col-lg-<?php echo $number_of_columns_desktop ?>">
          <!-- <h6><?php echo get_the_title(); ?></h6> -->

          <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
              <?php the_post_thumbnail('featured-small', ['class' => 'img-fluid', 'title' => 'Feature image']); ?>
            </a>
          <?php endif; ?>
          <div class="views">
            <?php echo get_field('number_of_views'); ?>
          </div>
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
            <?php } ?>
          </div>
          <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
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
}
