<?php

global $domain; ?>


<article id="post-<?php the_ID(); ?>" <?php post_class(['card border-0']); ?>>
  <div class="card-image">
    <a href="<?php echo esc_url(get_permalink()); ?>">
      <?php the_post_thumbnail('medium', [
        'class' => 'img-responsive responsive--full w-100',
        'title' => 'Feature image',
      ]); ?>
    </a>

  </div>
  <div class="card-header">
    <div class="post-category ">
      <?php $categories = get_the_category(); ?>
      <?php if ($categories): ?>
      <a class="btn btn-secondary text-dark fz-xs" href="<?php echo get_category_link(
        $categories[0]->term_id
      ); ?>"><?php echo $categories[0]->cat_name; ?></a>
      <?php endif; ?>
    </div><!-- /.post-category -->

    <div class="card-title h5">
      <a class="nagative-link" href="<?php echo esc_url(
        get_permalink()
      ); ?>" rel="bookmark">
        <h5 class="fz-normal fw-normal">
          <?php echo get_the_title(); ?>
        </h5>
      </a>
    </div>
  </div>
  <div class="card-footer p-0">
    <a href="<?php echo esc_url(
      get_permalink()
    ); ?>" class=" text-dark read-more"><?php _e('READ MORE', $domain); ?></a>
</article>