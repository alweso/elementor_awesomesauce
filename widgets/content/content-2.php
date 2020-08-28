<?php if ( has_post_thumbnail() ) : ?>
  <div>
    <div class="thumbnail thumbnail--small">
      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="widget-image d-block">
        <?php the_post_thumbnail('featured-small', ['class' => 'img-fluid', 'title' => 'Feature image']); ?>
      </a>
    </div>
  </div>
<?php endif; ?>

<?php include (ELEMENTOR_AWESOMESAUCE . 'widgets/content/description_small.php'); ?>
