<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Magnetolabs
 */

get_header();
global $domain;
?>
<div class="page-archive">
  <div class="container">
    <div id="primary" class="content-area">
      <main id="main" class="site-main">
        <div class="row">
          <div class="col-lg-8 col-sm-12 pr-4">
            <header class="page-header">
              <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
              } ?>
              <?php
              the_archive_title('<h1 class="page-title">', '</h1>');

              the_archive_description(
                '<div class=" s2 fw-light archive-description">',
                '</div>'
              );
              ?>
            </header><!-- .page-header -->
          </div>
        </div>

        <div class="row">
          <div class="col-lg-8 col-sm-12">
            <div class="row">
              <?php if (have_posts()): ?>
              <?php
              /* Start the Loop */
              while (have_posts()):
                the_post(); ?>
              <div class="col-lg-6 pr-lg-5 col-sm-12">
                <?php get_template_part(
                  'template-parts/content',
                  'post-list'
                ); ?>
              </div> <!-- col-lg-6 -->

              <?php
              endwhile;
              // the_posts_navigation();
              numeric_posts_nav();
              else:get_template_part('template-parts/content', 'none');endif; ?>
            </div> <!-- row -->
            <!-- col-8 -->
          </div>
          <div class="col-lg-4 col-sm-12 pl-lg-4 ">
            <aside id="secondary" class="widget-area">
              <?php do_action('module-archive-sidebar'); ?>
            </aside><!-- #secondary -->
          </div>
        </div> <!-- row -->
      </main><!-- #main -->
    </div><!-- #primary -->

  </div>
  <!--.container-->
</div>


<?php get_footer();