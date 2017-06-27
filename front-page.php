<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Revived_Furnishings
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<!-- Ambience Photo Slider -->
		<?php
    		if( have_rows('ambience_photo_slider') ){                                            
			        echo '<div class="flexslider">';
			        echo '<ul class="slides">';

			        while ( have_rows('ambience_photo_slider') ) {
			            the_row();



			    $slideimage=get_sub_field('ambience_photo');
			    $size = 'full'; // (thumbnail, medium, large, full or custom size)

			    if( $slideimage ) {
			        echo '<li>';
			        echo wp_get_attachment_image( $slideimage, $size );
			        echo '</li>';
			    }
			  }    
			    echo '</ul><!-- #slides -->';
			  echo '</div><!-- #flexslider -->'; 
			}
        ?>
            


		<section class="featured-section">
			<h1>Featured Products</h1>
  			<div class="featured-products">
			  <?php
			    $args = array(
			        'post_type' => 'furniture',
			        'posts_per_page' => 3,
			        'tax_query' => array(
			            //'relation' => 'AND',
			            array(
			              'taxonomy' => 'featured',
			              'field' => 'slug',
			              'terms' => 'front-page-featured'
			            ),
			        )
			    );

			    //the below creates a new object based on our arguments
			    $featuredFurniture = new WP_Query($args);

			    if( $featuredFurniture->have_posts() ){
			      while( $featuredFurniture->have_posts() ){
			        //set up the posts
			        $featuredFurniture->the_post();

			        //now that we have the container, lets choose what we want to display
			        echo '<div class="single-feature">';
			        echo '<a href="';
			        the_permalink();
			        echo '">';
			        the_post_thumbnail('featured-image');
			        echo '<div class="overlay">
                            <h2 class="viewproduct">View Product</h2>
                            </div>';
			        echo '</a>';
			        echo '<div class="featured-info">';
			        echo '<h3 class="featured-title">';
			        the_title();
			        echo '</h3><h3 class="featured-price">';
			        the_field('price');
			        echo '</h3>';
			        echo '</div>'; // end featured-info
			        echo'</div>'; // end single-feature
			      }
			      wp_reset_postdata();
			    }
			  ?>
			  </div> <!-- end featured-products -->
			</section> <!-- end featured-section -->

			<?php
				if( function_exists('get_field') ){
						echo '<section class="about"><h2>About Us</h2>';
						if( get_field('company_description') ){
                    		the_field('company_description');
                  		} //end if
						echo '</section>';

						echo '<section class="promotion"><h2>';
						if( get_field('promotion_title') ){
                    		the_field('promotion_title');
                  		} // end if
						echo '</h2>';

						if( get_field('promotion_description') ){
                    		the_field('promotion_description');
                  		} //end if
						echo '</section>';
				} // end outer if
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
