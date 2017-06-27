<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Revived_Furnishings
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		
		<!--repeater field-->
		<div class="left-side">
		<?php if( have_rows('image') ): ?>

			<ul class="slides">

			<?php while( have_rows('image') ): the_row(); 

				// vars
				$image = get_sub_field('product-images');

				?>

				<li class="slide">

						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>">

				</li>

			<?php endwhile; ?>

			</ul>

		<?php endif; ?>
		</div><!-- end left-side -->

		<!--end single furniture repeater-->

		<div class="right-side">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
			echo "<p>";
			the_field('price');
			echo "</p>";
			echo "<p>";
			the_field('dimensions');
			echo "</p>";
			echo "<p>";
			the_field('description');
			echo "</p>";
			echo "<p>Want to buy this piece? <a href='http://revivedfurnishing.htpwebdesign.ca/contact/'>Send us an email!</a></p>";

		?>

		<?php 

		$beforeimage = get_field('before_image');

		if( !empty($beforeimage) ): ?>

			<div class="before">

			<?php
				echo "<p>Before:</p>";
			?>

			<img class="beforeimage" src="<?php echo $beforeimage['url']; ?>" alt="<?php echo $beforeimage['alt']; ?>" />

			</div><!-- end before -->

		</div><!--end right-side-->
		<?php endif; ?>

			
		<?php
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php revivedfurnishings_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'revivedfurnishings' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'revivedfurnishings' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<!-- <footer class="entry-footer"> -->
		<!-- <?php //revivedfurnishings_entry_footer(); ?> -->
	<!-- </footer> --><!-- .entry-footer -->
</article><!-- #post-## -->

