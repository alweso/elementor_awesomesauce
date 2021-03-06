<?php
namespace ElementorAwesomesauce;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.0.0
 */
class Plugin {

  /**
   * Instance
   *
   * @since 1.0.0
   * @access private
   * @static
   *
   * @var Plugin The single instance of the class.
   */
  private static $_instance = null;

  /**
   * Instance
   *
   * Ensures only one instance of the class is loaded or can be loaded.
   *
   * @since 1.2.0
   * @access public
   *
   * @return Plugin An instance of the class.
   */
  public static function instance() {
    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }

    return self::$_instance;
  }

  /**
   * widget_scripts
   *
   * Load required plugin core files.
   *
   * @since 1.2.0
   * @access public
   */
  public function widget_scripts() {
    wp_register_script( 'elementor-awesomesauce', plugins_url( '/assets/js/awesomesauce.js', __FILE__ ), [ 'jquery' ], false, true );
  }

  public function widget_styles() {
		wp_register_style( 'elementor-awesomesauce', plugins_url( 'css/widgets.css', __FILE__ ) );
	}



  /**
   * Include Widgets files
   *
   * Load widgets files
   *
   * @since 1.2.0
   * @access private
   */
  private function include_widgets_files() {
    require_once( __DIR__ . '/widgets/post-tabs-grid.php' );
    require_once( __DIR__ . '/widgets/post-tabs-list.php' );
    require_once( __DIR__ . '/widgets/post-grid.php' );
    require_once( __DIR__ . '/widgets/video-playlist.php' );
    require_once( __DIR__ . '/widgets/category-list-images.php' );
    require_once( __DIR__ . '/widgets/featured-posts.php' );
    require_once( __DIR__ . '/widgets/featured-gallery.php' );
    require_once( __DIR__ . '/widgets/post-list.php' );
    require_once( __DIR__ . '/widgets/post-block.php' );
    require_once( __DIR__ . '/widgets/post-carousel.php' );
    require_once( __DIR__ . '/widgets/comments.php' );
  }

  /**
   * Register Widgets
   *
   * Register new Elementor widgets.
   *
   * @since 1.2.0
   * @access public
   */
  public function register_widgets() {
    // Its is now safe to include Widgets files
    $this->include_widgets_files();

    // Register Widgets
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PostTabsGrid() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PostTabsList() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PostGrid() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\VideoPlaylist() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\CategoryListImages() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\FeaturedPosts() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\FeaturedGallery() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PostList() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PostBlock() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PostCarousel() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Comments() );

  }

  /**
   *  Plugin class constructor
   *
   * Register plugin action hooks and filters
   *
   * @since 1.2.0
   * @access public
   */
  public function __construct() {

    // Register widget scripts
    add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

    // Register widgets
    add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
  }
}

// Instantiate Plugin Class
Plugin::instance();
