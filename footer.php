<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package purp
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			Proudly powered by 
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'purp' ) ); ?>"><?php printf( esc_html__( '%s', 'purp' ), 'WordPress' ); ?></a>
			<span class="sep">  |  </span>
			<?php printf( esc_html__( 'Theme: %1$s', 'purp' ), '<a href="https://github.com/c-rahtz/purp" rel="nofollow">purp</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
