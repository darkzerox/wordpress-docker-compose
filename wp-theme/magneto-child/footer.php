<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Magnetolabs
 */

global $doamin; ?>

</div><!-- #content -->

<footer id="colophon" class="site-footer">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-sm-12 col-site-info order-2 order-lg-0">
        <div class="d-none d-lg-block">
          <?php the_custom_logo(); ?>
        </div>

        <div class="div text-primary s1 mb-2"><?php _e(
          'Contact us',
          $doamin
        ); ?></div><!-- /.div -->

      </div><!-- /.col-lg-3 col-sm-12 -->
      <div class="col-lg-9 col-sm-12 pl-lg-5 order-1">
        <nav id="footer-navigation" class="footer-navigation">
          <?php wp_nav_menu([
            'theme_location' => 'footer-menu',
          ]); ?>
        </nav><!-- #site-navigation -->
      </div><!-- /.col-lg-9 col-sm-12 -->

    </div><!-- /.row -->

  </div>
  <!--.container-->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>