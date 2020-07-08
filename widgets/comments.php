<?php

namespace ElementorAwesomesauce\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;


class Comments extends Widget_Base {


    public $base;

    public function get_name() {
        return 'comments';
    }

    public function get_title() {
        return esc_html__( 'Comments', 'elementor-comments' );
    }

    public function get_icon() {
        return 'fa fa-pencil';
    }

    public function get_categories() {
      return ['general', 'test-category'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Comment settings', 'elementor-awesomesauce'),
            ]
        );

        $this->add_control(
         'comment_count',
         [
           'label'         => esc_html__( 'Comment count', 'digiqole' ),
           'type'          => Controls_Manager::NUMBER,
           'default'       => '4',

         ]
       );

       $this->add_control(
         'commnet_limit',
         [
           'label'         => esc_html__( 'Comment crop', 'digiqole' ),
           'type'          => Controls_Manager::NUMBER,
           'default'       => '15',

         ]
       );

     $this->add_control(
         'comment_order',
         [
             'label'     =>esc_html__( 'Comment order', 'digiqole' ),
             'type'      => Controls_Manager::SELECT,
             'default'   => 'DESC',
             'options'   => [
                     'DESC'      =>esc_html__( 'Descending', 'digiqole' ),
                     'ASC'       =>esc_html__( 'Ascending', 'digiqole' ),
                 ],
         ]
     );

        $this->end_controls_section();




    } //Register control end

    protected function render( ) {

		$settings = $this->get_settings();
      $comment_count    = $settings['comment_count'];
      $comment_order    = $settings['comment_order'];
      $commnet_limit    = $settings['commnet_limit'];

      $args = array(
         'orderby' => 'comment_ID',
         'order'  => $comment_order,
         'number' => $comment_count,
         'suppress_filters' => false,

     );
     if($settings['ts_offset_enable']=='yes'){
      $args['offset'] = $settings['ts_offset_item_num'];
    }

     $comments_query = new \WP_Comment_Query;
     $comments = $comments_query->query( $args );

    ?>
      <?php if ( $comments ):  ?>
         <div class="ts-author-comments">
            <?php foreach ( $comments as $comment ) : ?>
               <div class="row ts-comments-row align-items-center mb-50">
                  <div class="col-lg-4 col-md-2">

                     <div class="ts-author-media">
                        <div class="ts-author-thumb">
                            <?php echo get_avatar(get_the_author_meta('ID')); ?>
                        </div>
                        <div class="ts-author-meta">

                          <?php echo get_the_date(get_option($comment->comment_date)); ?>
                        </div>
                     </div>

                  </div>
                  <div class="col-lg-8 col-md-10">
                      <div class="ts-author-content">
                            <div class="comment">
                                <a href="<?php echo esc_url(get_post_permalink($comment->comment_post_ID)); ?> ">
                                    <?php echo esc_html(wp_trim_words($comment->comment_content,$commnet_limit,'') ); ?>
                                    </a>
                                </div>
                            <div class="ts-author">
                                <?php echo esc_html__('by','digiqole'); ?>
                                <a href="<?php echo esc_url($comment->comment_author_url); ?>" >
                                    <?php echo esc_html($comment->comment_author); ?>
                                </a>
                            </div>
                      </div>
                  </div>
               </div>
            <?php endforeach; ?>
         </div><!-- author comments end -->
     <?php endif; ?>

    <?php

    }

    protected function _content_template() { }
}
