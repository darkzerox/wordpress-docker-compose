<?php
// Blog template

$categories = get_the_category(); ?>

<div class="row">
  <div class="col-12">
    <header class=" post-header">
      <h1 class="h2"><?php echo get_the_title(); ?></h1>
      <div class="post-meta d-flex  justify-content-start">
        <p>
          <?php if ($categories): ?>

          <a class="category-head" href="<?php echo get_category_link(
            $categories[0]->term_id
          ); ?>"><?php echo $categories[0]->cat_name; ?></a>
          <?php endif; ?>
          <time class="date" time="<?php echo get_the_date(
            'c'
          ); ?>" itemprop="datePublished">
            <?php echo get_the_date('d M Y'); ?></time>
        </p>
      </div><!-- /.post-meta -->
    </header>
  </div><!-- /.col-sm-12 -->
</div><!-- row -->

<div class="row">
  <div class="col-2">
    <div class="seed-social-bar">
      <?php if (function_exists('seed_social')) {
        seed_social();
      } ?>
    </div><!-- /.seed-social -->
  </div><!-- /.col-lg-2 col-sm-12 -->

  <div class="col-8">
    <div class="post-feature-img  ">
      <?php echo get_the_post_thumbnail(null, 'large'); ?>
    </div>

    <div class="post-content">
      <?php the_content(); ?>

      <div class="post-meta">
        <div class="post-tags d-flex flex-wrap">
          <div class="tags-title">Tags:</div>
          <?php
          $post_tags = get_the_tags();

          if ($post_tags) {
            foreach ($post_tags as $tag) { ?>
          <div class="tags-list "><a href="/tag/<?php echo $tag->slug; ?>"><?php echo $tag->name; ?>, </a></div>
          <?php }
          }
          ?>
        </div>
      </div><!-- /.post-meta -->
    </div>
  </div><!-- /.col-lg-8 col-sm-12 -->
</div><!-- /.row -->