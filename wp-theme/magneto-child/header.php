<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Magnetolabs
 */

global $domain; ?>
<!doctype html>
<html <?php language_attributes(); ?> style="margin-top:0 !important">

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div id="page" class="site">
    <header id="masthead" class="site-header">
      <div class="container full">
        <div class="row">
          <div class="col-lg-4">
            <?php the_custom_logo(); ?>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4 col-sm">
            <?php wp_nav_menu([
              'theme_location' => 'primary',
            ]); ?>
          </div><!-- /.col-sm-12 -->
        </div><!-- /.row -->
      </div>
      <!--.container-->

    </header><!-- #masthead -->

    <div id="content" class="site-content pt-5">