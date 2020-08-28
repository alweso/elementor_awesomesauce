<?php if ( has_post_thumbnail() ) : ?>
  <div>
    <div class="thumbnail w-100 h-100">
      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="w-100 h-100 d-block">
        <?php the_post_thumbnail('featured-small', ['class' => 'img-fluid w-100', 'title' => 'Feature image']); ?>
      </a>
      </div>
  </div>
<?php endif; ?>
<?php include (ELEMENTOR_AWESOMESAUCE . 'widgets/content/description.php'); ?>
