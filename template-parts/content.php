<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package purp
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">


		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title index-excerpt"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php purp_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>


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

			if (has_post_thumbnail() && is_home()) {
				echo "<figure class='featured-image'>";
				echo "<a href='" . esc_url( get_permalink()) . "' rel='bookmark'>";
				echo the_post_thumbnail();
				echo "</a>";
				echo "</figure>";
			}

			if ( has_excerpt( $post->ID) ) {
				echo '<div class="entry-excerpt">';
				echo '<p>' . get_the_excerpt() . '</p>';
				echo '</div><!-- .entry-excerpt -->';
			}
			the_excerpt();

			// wp_link_pages( array(
			// 	'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'purp' ),
			// 	'after'  => '</div>',
			// ) );
		?>
	
		<?php  if ( is_home() && is_front_page() ) {	?>
		<div class="continue-reading">
			<a href="<?php echo esc_url( get_permalink()) ?>" rel="bookmark">
				<?php 

					printf(
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&raquo;</span>', 'purp' ), array( 'span' => array( 'class' => array() ) ) ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
					);

				?>

			</a>
		</div>
		<?php  }?>

		<footer class="entry-footer">
			<?php purp_entry_footer(); ?>
		</footer><!-- .entry-footer -->

		<?php 
				if ( !is_home() && !is_search() && !is_404() ) {
					the_post_navigation( array(
						'next_text' => '<span class="screen-reader-text">' . __( 'Next post:', 'purp' ) .
						'</span> ' . '<span class="post-title">%title</span>',

						'prev_text' => '<span class="screen-reader-text">' . __( 'Previous post:', 'purp' ) . 
						'</span> ' . '<span class="post-title">%title</span>',
					));
				}

				// If comments are open or we have at least one comment, load up the comment template.
				// echo "comments open: " . comments_open();
				// echo "comment number: " . get_comments_number();
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

		 ?>
	</div><!-- .entry-content -->

	<?php

		// if we're not on the home or front-page
		if ( !is_home() && !is_front_page() && !is_search() && !is_404() ) {
			get_sidebar(); 
		}
	?>


</article><!-- #post-## -->
