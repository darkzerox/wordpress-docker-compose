<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Magnetolabs
 */
global $domain;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if (get_field('hide_title') == false) : ?>

	<header class="entry-header py-5 mb-5">
		<?php the_title( '<h1 class="entry-title text-center">', '</h1>' ); ?>
		<div class="page-feature-image w-100">
			<?php echo get_the_post_thumbnail(); ?>
		</div><!-- /.page-feature-image -->
	</header><!-- .entry-header -->


	<?php endif ; ?>

	<div class="entry-content">
		<?php
		
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', $domain ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', $domain ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
	</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->