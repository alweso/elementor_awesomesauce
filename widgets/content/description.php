<div class="description">
  <div class="description-inner">
    <?php if($show_cat) { ?>
      <div class="category">
        <?php
        $categories = get_the_category();
        foreach ( $categories as $category ) {
          echo '<span style="display: inline-block;
          color: white;
          padding: 0px 5px;
          margin-right: 10px;
          background-color: #177c51;
          font-size: 11px;
          font-family: Montserrat;
          font-weight: 600; background-color:'.get_field('category_colors', $category).'" class="acf-category-color">'.$category->name.'</span>';
        }
        ?>
      </div>
    <?php }  ?>
    <h4 class="news-title"><?php echo esc_html(wp_trim_words(get_the_title(), $crop,'')); ?></h4>
    <?php if($show_exerpt == "yes" || $show_exerpt_2 == "yes") {?>
      <p><?php echo esc_html( wp_trim_words(get_the_excerpt(),$post_content_crop,'...') );?></p>
    <?php } ?>
    <span class="comments-views-date">
      <?php if($show_comments) { ?>
        <span class="comments">
          <i class="fa fa-comment"></i><?php  echo get_comments_number(); ?>
        </span>
      <?php }  ?>
      <?php if($show_views) { ?>
        <span class="views">
          <i class="fa fa-eye"></i><?php  echo get_field('number_of_views'); ?>
        </span>
      <?php }  ?>
      <?php if($show_date) { ?>
        <span class="date">
          <i class="fa fa-calendar"></i><?php the_date('Y-m-d'); ?>
        </span>
      <?php }  ?>
    </span>
    <?php if($show_author == "yes") {?>
      <div class="author">
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="author-avatar">
          <?php echo get_avatar( get_the_author_meta( 'ID' ), 40); ?>
        </a>
        <span>by <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></span>
      </div>
    <?php } ?>
    <?php if($show_tags == "yes") { ?>
      <div class="tags">
        <?php  the_tags(); ?>
      </div>
    <?php }  ?>
  </div>
</div>
