<?php 

global $domain;
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(array('post-list')); ?>>

  <div class="post-feature-image">
    <a href="<?php echo esc_url( get_permalink() )  ;?>">
      <?php the_post_thumbnail(array(690,450)); ?>
    </a>
  </div>

  <div class="post-list-content">
    <div class="post-category s2 text-primary">
      <?php 
      $categories = get_the_category();
      ?>
      <?php if ($categories ) :?>
      <a href="<?php echo get_category_link($categories[0]->term_id)?>"><?php echo $categories[0]->cat_name; ?></a>
      <?php endif ;?>

    </div><!-- /.post-category -->
    <header class="entry-header">
      <?php
      the_title( '<h3 class="entry-title dark"><a class="nagative-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
      ?>
    </header><!-- .entry-header -->

    <div class="post-excerpt s2 fw-light"> <?php echo get_the_excerpt( );?> </div>

    <a href="<?php echo  esc_url( get_permalink() ) ?>" class="arrow"><?php _e('อ่านต่อ', $domain)?></a>
    <!-- /.more-link -->

  </div>
</article>