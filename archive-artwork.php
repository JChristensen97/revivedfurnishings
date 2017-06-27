<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Revived_Furnishings
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		$args = array(
			//the post type name needs to match 'register_post_type' in
			//"functions.php" file
			'post_type' => 'artwork',
			'posts_per_pages' => -1,
			'orderby' => 'title',
			'order' => 'ASC',
			);

			$artworklist = new WP_Query($args);

			if( $artworklist->have_posts() ){
				echo '<h1>Artwork</h1>';
				echo '<section class=gallery>';
				while( $artworklist->have_posts() ){
					$artworklist->the_post();

					$image_url = get_the_post_thumbnail_url(get_the_ID(), "large");
					

					echo '<article class="art">';
					echo '<a href="';
					echo $image_url; 
					echo '" class="swipebox" title="';
					the_field('artwork_title');
					echo '">';
					the_post_thumbnail('medium');
					echo '<div class="overlay">
                          <h2 class="viewproduct">View Art</h2>
                          </div>';
					echo '</a>';

					if( function_exists('get_field') ){
						echo '<div class="artInfo">';
						echo '<h3 class="artwork_title">';
						if( get_field('artwork_title') ){
                    		the_field('artwork_title');
                  		} //end if
						echo '</h3>';

						echo '<h3 class="artwork_price">';
						if( get_field('artwork_price') ){
                    		the_field('artwork_price');
                  		} // end if
						echo '</h3>';
						echo '</div>'; //end artInfo
						echo '</article>';
					} // end outer if
				} //end while
				echo '</gallery>';
				wp_reset_postdata();
			}// end if
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
