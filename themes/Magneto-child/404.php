<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Magnetolabs
 */

get_header();
global $domain;
?>

<div class="container">

  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <div class="row">
        <div class="col-lg-8 col-sm-12 offset-lg-2">
          <section class="error-404 not-found text-center my-5 pb-5">
            <?php echo 'asd'; ?>

            <h1> <?php _e('PAGE NOT FOUND', $domain); ?> </h1>

            <a class="btn btn-primary btn-lg mt-4" href="/"><?php _e(
              'กลับสู่หน้าหลัก',
              $domain
            ); ?></a>
          </section>
        </div><!-- /.col-lg-8 col-sm-12 offset-lg-2 -->
      </div><!-- /.row -->


    </main><!-- #main -->
  </div><!-- #primary -->
</div>
<!--.container-->
<?php get_footer();