<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Revived_Furnishings
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			?>

		<div class="location-info">

			<div class="info-wrapper">
				<?php the_field('address_icon', 107); ?>
				<p><?php the_field('address', 107); ?></p>
			</div><!-- end address-section -->

			<div class="info-wrapper">
				<?php the_field('email_icon', 107); ?>
				<p><?php the_field('email', 107); ?></p>
			</div><!-- end email-section -->

			<div class="info-wrapper">
				<?php the_field('phone_icon', 107); ?>
				<p><?php the_field('phone', 107); ?></p>
			</div><!-- end phone-section -->

 		</div><!--end location-info-->

 		<div class="book">

			<h2>Book an Appointment</h2>

		</div><!--end book-->

			<?php 
				echo do_shortcode('[contact-form-7 id="152" title="Contact form 1"]');
			?>

				<?php 

				$location = get_field('google_map');

				if( !empty($location) ):
				?>
				<div class="acf-map">
					<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
				</div>
				<?php endif; ?>
			

			<?php
			endwhile; // End of the loop.


			?>


<!-- added to display repeater field--> 

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
