<?php

global $domain;
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Magnetolabs
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function body_classes($classes)
{
  // Adds a class of hfeed to non-singular pages.
  if (!is_singular()) {
    $classes[] = 'hfeed';
  }

  // Adds a class of no-sidebar when there is no sidebar present.
  if (!is_active_sidebar('sidebar')) {
    $classes[] = 'no-sidebar';
  }

  return $classes;
}
add_filter('body_class', 'body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function pingback_header()
{
  if (is_singular() && pings_open()) {
    printf(
      '<link rel="pingback" href="%s">',
      esc_url(get_bloginfo('pingback_url'))
    );
  }
}
add_action('wp_head', 'pingback_header');

/**
 * Hook Sidebar
 *
 */
function template_sidebar()
{
  if (is_active_sidebar('sidebar')): ?>
<div class="container">
  <?php get_sidebar(); ?>
</div>
<?php endif;
}
add_action('template_sidebar', 'template_sidebar');

/**
 *
 * Image SizE
 */
// add_image_size( 'post-list', 312, 200 ,true ) ;
// add_image_size( 'project-list', 522, 370 ,true ) ;

//display only user's post
function posts_for_current_author($query)
{
  global $pagenow;

  if ('edit.php' != $pagenow || !$query->is_admin) {
    return $query;
  }

  if (!current_user_can('edit_others_posts')) {
    global $user_ID;
    $query->set('author', $user_ID);
  }
  return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author');

//disable back end
function wpse23007_redirect()
{
  if (
    is_admin() &&
    !defined('DOING_AJAX') &&
    (current_user_can('subscriber') ||
      current_user_can('contributor') ||
      current_user_can('author'))
  ) {
    wp_redirect(home_url() . '/dashboard/');
    exit();
  }
}
add_action('init', 'wpse23007_redirect');

//acf add option menu
if (function_exists('acf_add_options_page')) {
  acf_add_options_page();
  // acf_add_options_page('Contact Us');
  // acf_add_options_page('Clients Say');
}

//remove taximony prefix
add_filter('get_the_archive_title', function ($title) {
  if (is_category()) {
    $title = single_cat_title('', false);
  } elseif (is_tag()) {
    $title = single_tag_title('', false);
  } elseif (is_author()) {
    $title = '<span class="vcard">' . get_the_author() . '</span>';
  } elseif (is_tax()) {
    //for custom post types
    $title = sprintf(__('%1$s'), single_term_title('', false));
  } elseif (is_post_type_archive()) {
    $title = post_type_archive_title('', false);
  }
  return $title;
});

//post pagination
function numeric_posts_nav()
{
  if (is_singular()) {
    return;
  }

  global $wp_query;

  /** Stop execution if there's only 1 page */
  if ($wp_query->max_num_pages <= 1) {
    return;
  }

  $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
  $max = intval($wp_query->max_num_pages);

  /** Add current page to the array */
  if ($paged >= 1) {
    $links[] = $paged;
  }

  /** Add the pages around the current page to the array */
  if ($paged >= 3) {
    $links[] = $paged - 1;
    $links[] = $paged - 2;
  }

  if ($paged + 2 <= $max) {
    $links[] = $paged + 2;
    $links[] = $paged + 1;
  }

  echo '<div class="navigation"><ul>' . "\n";

  /** Previous Post Link */
  if (get_previous_posts_link()) {
    printf(
      '<li class="pre-post">%s</li>' . "\n",
      get_previous_posts_link('<i class="fal fa-angle-left"></i>')
    );
  }

  /** Link to first page, plus ellipses if necessary */
  if (!in_array(1, $links)) {
    $class = 1 == $paged ? ' class="active"' : '';

    printf(
      '<li%s><a href="%s">%s</a></li>' . "\n",
      $class,
      esc_url(get_pagenum_link(1)),
      '1'
    );

    if (!in_array(2, $links)) {
      echo '<li>…</li>';
    }
  }

  /** Link to current page, plus 2 pages in either direction if necessary */
  sort($links);
  foreach ((array) $links as $link) {
    $class = $paged == $link ? ' class="active"' : '';
    printf(
      '<li%s><a href="%s">%s</a></li>' . "\n",
      $class,
      esc_url(get_pagenum_link($link)),
      $link
    );
  }

  /** Link to last page, plus ellipses if necessary */
  if (!in_array($max, $links)) {
    if (!in_array($max - 1, $links)) {
      echo '<li>…</li>' . "\n";
    }

    $class = $paged == $max ? ' class="active"' : '';
    printf(
      '<li%s><a href="%s">%s</a></li>' . "\n",
      $class,
      esc_url(get_pagenum_link($max)),
      $max
    );
  }

  /** Next Post Link */
  if (get_next_posts_link()) {
    printf(
      '<li class="next-post">%s</li>' . "\n",
      get_next_posts_link('<i class="fal fa-angle-right"></i>')
    );
  }

  echo '</ul></div>' . "\n";

  wp_reset_postdata();
} //end post pagination

/**
 * Get image by Image ID
 *
 */
function get_image(
  $id,
  $link = "",
  $target = "",
  $nofollow = false,
  $size = 'full'
) {
  $imgSrc = wp_get_attachment_image_src($id, $size);
  $imgSrcset = esc_attr(wp_get_attachment_image_srcset($id, $size));

  if ($nofollow) {
    $rel = 'rel="nofollow noopener"';
  }

  $html = "";
  if ($link != "" || $link != null) {
    $html .=
      '<a href = "' . $link . '" target = "' . $target . '" ' . $rel . '>';
  }
  $html .= '<img src = "' . $imgSrc[0] . '"  srcset="' . $imgSrcset . '"  >';
  if ($link != "" || $link != null) {
    $html .= '</a>';
  }

  return $html;
}

// class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu{
//     // don't output children opening tag (`<ul>`)
//     public function start_lvl(&$output, $depth = 0, $args = NULL){}
//     // don't output children closing tag
//     public function end_lvl(&$output, $depth = 0, $args = NULL){}
//     public function start_el(&$output, $item, $depth = 0, $args = NULL, $id = 0){
//       // add spacing to the title based on the current depth
//       $item->title = str_repeat("&nbsp;", $depth * 4) . $item->title;
//       // call the prototype and replace the <li> tag
//       // from the generated markup...
//       parent::start_el($output, $item, $depth = 0, $args = NULL, $id = 0);
//       $output = str_replace('<li', '<option', $output);
//     }
//     // replace closing </li> with the closing option tag
//     public function end_el(&$output, $item, $depth = 0, $args = NULL, $id = 0){
//       $output .= "</option>\n";
//     }
// }

function new_excerpt_more($more)
{
  return ' ... ';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * Related posts
 *
 * @global object $post
 * @param array $args
 * @return
 */
function magneto_related_posts($args = [])
{
  global $post;

  // default args
  $args = wp_parse_args($args, [
    'post_id' => !empty($post) ? $post->ID : '',
    'taxonomy' => 'post_tag',
    'limit' => 3,
    'post_type' => !empty($post) ? $post->post_type : 'post',
    'orderby' => 'rand',
    'order' => 'DESC',
  ]);

  // check taxonomy
  if (!taxonomy_exists($args['taxonomy'])) {
    return;
  }

  // post taxonomies
  $taxonomies = wp_get_post_terms($args['post_id'], $args['taxonomy'], [
    'fields' => 'ids',
  ]);

  if (empty($taxonomies)) {
    return;
  }

  // post categories
  $categories = wp_get_post_terms($args['post_id'], 'category', [
    'fields' => 'ids',
  ]);

  if (empty($categories)) {
    return;
  }

  // query
  $terms_args = [
    'post__not_in' => (array) $args['post_id'],
    'post_type' => $args['post_type'],
    'tax_query' => [
      'relation' => 'OR',
      [
        'taxonomy' => $args['taxonomy'],
        'field' => 'term_id',
        'terms' => $taxonomies,
      ],
      [
        'taxonomy' => 'category',
        'field' => 'term_id',
        'terms' => $categories,
      ],
    ],
    'posts_per_page' => $args['limit'],
    'orderby' => $args['orderby'],
    'order' => $args['order'],
  ];

  $related_posts = get_posts($terms_args);
  if (!empty($related_posts)) { ?>
<div class="relate-article mb-5">
  <header class="section-header relate-post">
    <h2 class="mb-5 text-uppercase text-center"><?php _e(
      'Related Articles'
    ); ?></h2>
  </header>
  <div class="row ">
    <!-- the loop -->
    <?php foreach ($related_posts as $post) {
      setup_postdata($post); ?>
    <div class="col-lg-4 col-6 px-4">
      <?php get_template_part('template-parts/content-post-list'); ?>
    </div> <!-- post-item -->
    <?php
    } ?>
    <!-- end of t
    he loop -->
  </div>
  <!-- row -->
</div><!-- /.relate-article -->

<?php }
  wp_reset_postdata();
}

function dzx_subscribe()
{
  ?>
<div class="section-subscribe bg-gray">
  <div class="container">
    <div class="hero ">
      <div class="hero-body">
        <div class="columns">
          <div class="colum col-5">
            <h2><?php echo get_field('subscribe_title', 'option'); ?></h2>
            <p class="font-head"><?php echo get_field(
              'subscribe_description',
              'option'
            ); ?></p>

          </div><!-- /.colum col-5 -->
          <div class="column">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque impedit, dolores nesciunt fuga repellendus
            nobis repudiandae ex ipsa, porro similique voluptatem voluptates accusantium doloremque id! Dignissimos
            facilis qui eveniet explicabo?
          </div><!-- /.column -->

        </div><!-- /.columns -->
      </div>
    </div>
  </div><!-- /.container -->

</div><!-- /.section-subscribe -->


<?php
}