<?php
/**
 * The template for displaying search result
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Magnetolabs
 */

get_header();
global $domain;
?>
<div class="page-search">

  <div class="container">
    <div id="primary" class="content-area">
      <main id="main" class="site-main">
        <div class="row">
          <div class="col-lg-8 pr-lg-4 col-sm-12">
            <header class="page-header mb-5">
              <?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
}
?>

              <?php
echo '<h1><span class="fw-light-">' . __('ผลการค้นหาสำหรับ', $domain) . " : </span><span class='bold'> " . get_search_query() . '</span></h1>';
?>
            </header><!-- .page-header -->
          </div>
        </div>

        <div class="row">
          <div class="col-lg-8  pr-lg-4 col-sm-12">
            <div class="row">
              <?php if (have_posts()): ?>

              <?php
/* Start the Loop */
$i = 0;
while (have_posts()):
    the_post();
    ?>
	              <div class="col-lg-6 col-sm-12 pr-5">
	                <?php
    get_template_part('template-parts/content', 'post-list');
    ?>
	              </div>
	              <?php
    if ($i == 1) {
        ?>
	              <div class="col-sm-12">
	                <div class="loop-banner">
	                  <img src="<?php echo get_template_directory_uri() . '/public/images/loop-banner.png'; ?>" alt="">
	                </div>
	              </div>
	              <?php
    }

    ?>


	              <?php
    $i++;
endwhile;
// the_posts_navigation();
numeric_posts_nav();
else:
    get_template_part('template-parts/content', 'none');
endif;
?>
            </div> <!-- row -->
          </div> <!-- col-9 -->

          <?php if (have_posts()): ?>

          <div class="col-lg-4 col-sm-12 ">
            <aside id="secondary" class="widget-area">
              <?php do_action('module-archive-sidebar');?>
            </aside><!-- #secondary -->
          </div>

          <?php endif;?>
        </div> <!-- row -->
      </main><!-- #main -->
    </div><!-- #primary -->

  </div>
  <!--.container-->
</div>
<?php
get_footer();