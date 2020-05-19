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
 
  /**
   * Include Widgets files
   *
   * Load widgets files
   *
   * @since 1.2.0
   * @access private
   */
  private function include_widgets_files() {
    require_once( __DIR__ . '/widgets/awesomesauce.php' );
    require_once( __DIR__ . '/widgets/post-tabs.php' );
    require_once( __DIR__ . '/widgets/post-grid.php' );
    require_once( __DIR__ . '/widgets/video-playlist.php' );
    require_once( __DIR__ . '/widgets/post-tabs-type-one.php' );
    require_once( __DIR__ . '/widgets/post-tabs-type-two.php' );
    require_once( __DIR__ . '/widgets/category-list-images.php' );
    require_once( __DIR__ . '/widgets/featured-posts.php' );
    require_once( __DIR__ . '/widgets/featured-posts-2.php' );
    require_once( __DIR__ . '/widgets/featured-gallery.php' );
    require_once( __DIR__ . '/widgets/post-list-type-one.php' );
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
    // \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Awesomesauce() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PostTabs() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PostGrid() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\VideoPlaylist() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PostTabsTypeOne() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PostTabsTypeTwo() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\CategoryListImages() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\FeaturedPosts() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\FeaturedPosts2() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\FeaturedGallery() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PostListTypeOne() );

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