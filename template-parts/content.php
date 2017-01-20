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

		the_title( '<h2 class="entry-title index-excerpt"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

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
		

		<footer class="entry-footer">
			<?php purp_entry_footer(); ?>
		</footer><!-- .entry-footer -->

	</div><!-- .entry-content -->


</article><!-- #post-## -->
