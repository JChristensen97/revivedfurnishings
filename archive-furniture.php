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
        <h1>Furniture</h1>
        
	<!--FILTER NAVIGATION-->
        
<div class="isotope-navigation">
    <!-- Clear All button -->
    <!-- <div class="ui-group">
        <div class="sort-clear">
            <button class="clear-all" id="clear">Clear</button>
        </div>
    </div> -->

    <div class="ui-group">
        <div class="button-group js-radio-button-group" data-filter-group="room-type">
            <button class="button checked" data-filter="">All</button>
            <?php 
                $terms = get_terms('furniture-category');
                $count = count($terms); //How many are they?
                if ( $count > 0 ){  //If there are more than 0 terms
                    foreach ( $terms as $term ) {  //for each term:
                        echo "<button class='button' data-filter='.".$term->slug."'>" . $term->name . "</button>\n";
                    }
                } 
            ?>
        </div> <!-- end button-group -->
    </div> <!-- end ui-group -->

    <div class="ui-group">
        <div class="button-group js-radio-button-group" data-filter-group="status">
            <?php 
                $statusterms = get_terms('furniture-status');
                $count = count($statusterms); //How many are they?
                if ( $count > 0 ){  //If there are more than 0 terms
                    foreach ( $statusterms as $status ) {  //for each term:
                        echo "<button class='button' data-filter='.".$status->slug."'>" . $status->name . "</button>\n";
                    }
                } 
            ?>
        </div> <!-- end button-group -->
    </div> <!-- end ui-group -->

</div> <!-- end isotope-navigation -->



<section id="isotope-container">
<?php 
    $args = array(
        'post_type'=> 'furniture',
        'posts_per_page' => -1,
    );

    $the_furniture = new WP_Query($args);?>

<?php if ( $the_furniture->have_posts() ) : ?>
    <div id="item-list">
    <?php while ( $the_furniture->have_posts() ) {
            $the_furniture->the_post(); 

                $termList = get_the_terms( $post->ID, 'furniture-category' );  //Get the assigned terms for a particular item
                $termName = ""; //initialize the string that will contain the terms
                    foreach ( $termList as $term ) { // for each term 
                        $termName .= $term->slug.' '; //create a string that has all the slugs 
                    }

                $statusList = get_the_terms( $post->ID, 'furniture-status' );  //Get the assigned terms for a particular item
                $statusName = ""; //initialize the string that will contain the terms
                    foreach ( $statusList as $status ) { // for each term 
                        $statusName .= $status->slug.' '; //create a string that has all the slugs 
                    }
    ?> 
            <div class="<?php echo $termName;?><?php echo $statusName;?>item"> <?php // 'item' is used as an identifier in the js file ?>

                <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium'); ?>
                    <div class="overlay">
                        <h2 class="viewproduct">View Product</h2>
                    </div>                     
                </a>
                <div class="productInfo">
                    <h3 class="furniture_title"><?php the_title(); ?></h3>
                    <?php if( function_exists('get_field') ){
                        echo '<h3 class="furniture_price">';
                        if( get_field('price') ){
                            the_field('price');
                        } // end if
                        echo '</h3>';
                    } // end outer if
                    ?>
                </div> <!-- end productInfo -->

            </div> <!-- end item -->
    <?php }  ?> <!-- end while -->
    </div> <!-- end item-list -->
<?php endif; ?>
         
</section> <!-- end #isotope-container -->
</main>
</div> <!-- end #primary -->


<?php
get_sidebar();
get_footer();
