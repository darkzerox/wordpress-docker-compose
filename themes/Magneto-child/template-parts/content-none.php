<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mangetolabs
 */
global $domain;
?>
<div class="col-sm-12">
  <section class="no-results not-found">
    <header class="page-header">
      <h1 class="page-title"><?php esc_html_e('Nothing Found', $domain);?></h1>
    </header><!-- .page-header -->

    <div class="page-content mb-5">
      <?php
if (is_home() && current_user_can('publish_posts')):

    printf(
        '<p>' . wp_kses(
            /* translators: 1: link to WP admin new post page. */
            __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', $domain),
            array(
                'a' => array(
                    'href' => array(),
                ),
            )
        ) . '</p>',
        esc_url(admin_url('post-new.php'))
    );

elseif (is_search()):
?>

      <p>
        <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', $domain);?>
      </p>
      <div class="search-box mt-3">
        <form role="search" method="get" class="search-form" action="/">
          <input class="input-search" type="input" placeholder="ค้นหาบทความ" name="s"><?php echo icon('search') ?>
        </form>
      </div>

      <?php
// get_search_form();

else:
?>

      <p>
        <?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', $domain);?>
      </p>
      <?php
// get_search_form();

endif;
?>
    </div><!-- .page-content -->
  </section><!-- .no-results -->
</div><!-- /.col-sm-12 -->