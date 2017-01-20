<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package purp
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php 
		the_title( '<h1 class="entry-title">', '</h1>' );

		if ( 'post' === get_post_type() ) : ?>

		<div class="entry-meta">
			<?php purp_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php 
			if (has_post_thumbnail() && !is_home()) { ?>
				<figure class="featured-image">
					<?php 
					$featured_image = the_post_thumbnail(); 
					echo $featured_image; ?>
				</figure>
		<?php } ?>


	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'purp' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'purp' ),
				'after'  => '</div>',
			) );
		?>


		<footer class="entry-footer">
			<?php purp_entry_footer(); ?>
		</footer><!-- .entry-footer -->

		<?php 

			the_post_navigation( array(
				'next_text' => '<span class="screen-reader-text">' . __( 'Next post:', 'purp' ) .
				'</span> ' . '<span class="post-title">%title</span>',

				'prev_text' => '<span class="screen-reader-text">' . __( 'Previous post:', 'purp' ) . 
				'</span> ' . '<span class="post-title">%title</span>',
			));


			// If comments are open or we have at least one comment, load up the comment template.
			// echo "comments open: " . comments_open();
			// echo "comment number: " . get_comments_number();
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		 ?>


	</div><!-- .entry-content -->

	<?php get_sidebar(); ?>



</article><!-- #post-## -->