<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Revived_Furnishings
 */

?>


	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">


			<?php
			//////////////////////////
			//Services Page
			/////////////////////////
			if (is_page('services')){

					if( function_exists('get_field') ){
						$service_items = get_field('services_content');
								


								//repeater field
								if( have_rows('services_content') ){

									while( have_rows('services_content') ){
										the_row();

											$serviceimage = get_sub_field('service_image');

											if( !empty($serviceimage) ){

												// vars
												$url = $serviceimage['url'];
												$alt = $serviceimage['alt'];

												// thumbnail
												$size = 'large';
												$thumb = $serviceimage['sizes'][ $size ];
												$width = $serviceimage['sizes'][ $size . '-width' ];
												$height = $serviceimage['sizes'][ $size . '-height' ];

												?>

												<div class="service-wrapper">

													<div class="service-image">
														<?php

														echo '<img src="' . $thumb . '" alt="' . $alt . '" width="' . $width . '" height="' . $height . '"/>';

														?>
													</div><!-- end service-image -->


													<div class="service-description">
														<?php
														
														echo '<h2>';
														the_sub_field('service_title');
														echo '</h2>';
														the_sub_field('service_description');
														echo '<div class="service-description-link"><a href="';
														the_sub_field('page_link');
														echo '">';
														the_sub_field('page_link_text');
														echo '</a></div>';

														?>

															
																											
													</div><!-- end service-description -->

												</div><!-- end service-wrapper -->

												<?php
										}
										}
									}

							
								//Add Ons

								?>
	
								<div class="add-on-service-wrapper">

									<div class="add-on-left">
										<?php
											if( get_field('add_on_service_title_#1') ){
												echo '<h2>';
												the_field('add_on_service_title_#1');
												echo '</h2>';
												} 

												if( get_field('add_on_service_content_#1') ){
												// echo '<p>';
												the_field('add_on_service_content_#1');
												// echo '</p>';
												} 
										?>
									</div><!-- end add-on-left -->

									<div class="add-on-right">
										<?php
											if( get_field('add_on_service_title_#2') ){
												echo '<h2>';
												the_field('add_on_service_title_#2');
												echo '</h2>';
												}

												if( get_field('add_on_service_content_#2') ){
													// echo '<p>';
													the_field('add_on_service_content_#2');
													// echo '</p>';
												} 
										?>
									</div><!-- end add-on-right -->

								</div><!-- end add-on-service-wrapper -->


							<?php

					}
			}
			?>



<?php
			//////////////////////////
			//About Page
			/////////////////////////
			if (is_page('about')){

					if( function_exists('get_field') ){
						$about_sections = get_field('about_section');
								

								//repeater field
								if( have_rows('about_section') ){

									while( have_rows('about_section') ){
										the_row();

											$aboutimage = get_sub_field('about_image');

											if( !empty($aboutimage) ){

												// vars
												$url = $aboutimage['url'];
												$alt = $aboutimage['alt'];

												// thumbnail
												$size = 'large'; 
												$thumb = $aboutimage['sizes'][ $size ];
												$width = $aboutimage['sizes'][ $size . '-width' ];
												$height = $aboutimage['sizes'][ $size . '-height' ];

												?>
														<div class="about-wrapper">
															<div class="about_images">
															<?php

															echo '<img src="' . $thumb . '" alt="' . $alt . '" width="' . $width . '" height="' . $height . '"/>';

															?>
															</div>
														

															<div class="about_content">
															<?php
															the_sub_field('about_content');
															?>

															</div>
														</div>


												<?php
											}//if empty
										}// while have_rows
									}//if have_rows

					}//if function
			}//is_page
			?>






		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'revivedfurnishings' ),
				'after'  => '</div>',
			) );
		?>
	</div> <!-- .entry-content-->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'revivedfurnishings' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>

