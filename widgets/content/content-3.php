<?php if ( has_post_thumbnail() ) : ?>
<div class="thumbnail w-100 h-100">
  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="w-100 h-100 d-block" style="background:url('<?php the_post_thumbnail_url('large-horizontal') ?>');">
  </a>
  <?php include (ELEMENTOR_AWESOMESAUCE . 'widgets/content/description.php'); ?>
  </div>
<?php endif; ?>
