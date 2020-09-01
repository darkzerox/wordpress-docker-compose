<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Magnetolabs
 */

get_header(); ?>
<div class="container">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <?php if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<div id="breadcrumbs" class="mb-4">', '</div>');
      } ?>

      <?php while (have_posts()):
        the_post();

        if (is_singular(['post'])) {
          get_template_part('template-parts/content', 'blog');
        } else {
          get_template_part('template-parts/content', get_post_type());
        }

        // the_post_navigation();
      endwhile; ?>

    </main><!-- #main -->

    <?php magneto_related_posts(); ?>
  </div><!-- #primary -->
</div> <!-- .container -->



<?php dzx_subscribe(); ?>


<?php get_footer();