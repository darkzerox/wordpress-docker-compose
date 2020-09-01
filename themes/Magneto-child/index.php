<?php
/**
 * The template for displaying blog listing pages
 *
 *
 * @package Magnetolabs
 */

get_header(); ?>
<div class="page-blog">
  <header class="page-header bg-gray-100">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <?php
// if ( function_exists('yoast_breadcrumb') ) {
//     yoast_breadcrumb( '<div id="breadcrumbs">','</div>' );
// }
?>

          <?php if (is_page('blog')) {
            the_archive_title('<h1 class="page-title h2 dark">', '</h1>');
            the_archive_description(
              '<div class="archive-description">',
              '</div>'
            );
          } else {
            $page_for_posts = get_option('page_for_posts'); ?>
          <div class="header-con">
            <div class="container">
              <div class="row">
                <div class="col-lg-8 col-sm-12 offset-lg-2">
                  <?php echo sprintf(
                    '<h1 class="page-title dark text-center mb-3">%s</h1>',
                    get_the_title($page_for_posts)
                  ); ?>
                  <div class="blog-description s2 text-center">

                  </div>
                </div><!-- /.col-sm-12 -->
              </div><!-- /.row -->
            </div><!-- /.container -->
          </div><!-- /.header-con -->
          <?php
          } ?>
        </div>
      </div>
    </div>
  </header><!-- .page-header -->

  <div class="container">
    <div id="primary" class="content-area">
      <main id="main" class="site-main">
        <div class="row">
          <div class="col-lg-8 col-sm-12 pr-lg-4">
            <div class="row">
              <?php if (have_posts()): ?>
              <?php
              while (have_posts()):

                the_post();

                if (is_sticky()) { ?>
              <div class="col-lg-12 pr-lg-5 col-sm-12">
                <?php get_template_part(
                  'template-parts/content',
                  'post-list-sticky'
                ); ?>
              </div>
              <?php } else { ?>
              <div class="col-lg-6 pr-lg-5 col-sm-12">
                <?php get_template_part(
                  'template-parts/content',
                  'post-list'
                ); ?>
              </div>
              <?php }
                ?>

              <?php
              endwhile;
              // the_posts_navigation();
              numeric_posts_nav();
              else:get_template_part('template-parts/content', 'none');endif; ?>
            </div> <!-- row -->
          </div> <!-- col-9 -->

          <div class="col-lg-4 col-sm-12 ">
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

<input class="bg-gray-200 focus:bg-white border-transparent focus:border-blue-400 ..." placeholder="Focus me">

<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
  Button
</button>

<?php get_footer();