
<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Revived_Furnishings
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
	
	<div class="footer-flex">

		<div class="footer-col1">

		<h1>Contact</h1>

		<?php 
		//vars
		 ?>


		<?php the_field('address_icon', 107); ?>
		<p><?php the_field('address', 107); ?></p>
		<?php the_field('email_icon', 107); ?>
		<p><?php the_field('email', 107); ?></p>
		<?php the_field('phone_icon', 107); ?>
		<p><?php the_field('phone', 107); ?></p>

		</div><!-- end footer-col1 -->

		<div class="footer-col2">

		<h1>Custom Work</h1>

		<p>Have a peice of furniture that you would like revived? <a href="#">Book an appointment here!</a></p>

		</div><!-- end footer-col2 -->

		<div class="footer-col3">

		<h1>Connect</h1>

		<p>Want to see some more pictures? Follow us on social media!</p>

		<nav id="social-nav" class="social-nav" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'social') ); ?>
		</nav>

		</div><!-- end footer-col3 -->

	</div><!-- end footer-flex -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
