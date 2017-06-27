<?php
/**
 * Revived Furnishings functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Revived_Furnishings
 */

if ( ! function_exists( 'revivedfurnishings_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function revivedfurnishings_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Revived Furnishings, use a find and replace
	 * to change 'revivedfurnishings' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'revivedfurnishings', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'revivedfurnishings' ),
        'social' => esc_html__( 'Social Menu', 'revivedfurnishings' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

    // Crop Image size
    add_image_size( 'featured-image', 300, 300, true );
}
endif;
add_action( 'after_setup_theme', 'revivedfurnishings_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function revivedfurnishings_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'revivedfurnishings_content_width', 640 );
}
add_action( 'after_setup_theme', 'revivedfurnishings_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function revivedfurnishings_scripts() {

    //jquery 
    wp_register_script( 'jQuery', 'https://code.jquery.com/jquery-3.2.1.min.js', null, null, true );
    wp_enqueue_script('jQuery');

	wp_enqueue_style( 'revivedfurnishings-style', get_stylesheet_uri() );

	wp_enqueue_script( 'revivedfurnishings-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'revivedfurnishings-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

    wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/js/jquery.waypoints.min.js', array(), '20151215', true );

    wp_enqueue_script( 'revivedfurnishings-fixed-to-static', get_template_directory_uri() . '/js/fixed-to-static.js', array(), '20151215', true );

    //font awesome
    wp_register_style( 'fontawesome', 'http:////maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'fontawesome');

    if ( is_page('contact') || is_admin() ) {
        //call in the necessary js files
        //wp_enqueue_script( 'mindset-mapapi', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', '', '', false );
        wp_enqueue_script( 'revivedfurnishings-mapapi', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBBEsAHz1Yijg-1TyYl-y-kPi0xl5yL-Y0', '', '', true );
        wp_enqueue_script( 'revivedfurnishings-map', get_template_directory_uri().'/js/googlemap.js', array('revivedfurnishings-mapapi'), '', true );
    }

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    //include Isotope into the archive-furniture page
    if(is_post_type_archive('furniture')){
        
        wp_register_script( 'imagesloaded', get_template_directory_uri( '/js/imagesloaded.pkgd.min.js' ), array( 'jquery' ), '4.1.1', true );
        
        wp_enqueue_script( 'revived-isotope-cdn', 'https://npmcdn.com/isotope-layout@3.0/dist/isotope.pkgd.min.js', array('imagesloaded'), 20170531, true );
        
        wp_enqueue_script( 'revived-furniture-multi-settings', get_template_directory_uri() . '/js/isotope-radiobutton.js', array('revived-isotope-cdn'), 20170615, true );      
    }

    //include Isotope and lightbox into archive-artwork page
    if(is_post_type_archive('artwork')){
        
        wp_register_script( 'imagesloaded', get_template_directory_uri( '/js/imagesloaded.pkgd.min.js' ), array( 'jquery' ), '4.1.1', true );
        
        wp_enqueue_script( 'revived-isotope-cdn', 'https://npmcdn.com/isotope-layout@3.0/dist/isotope.pkgd.min.js', array('imagesloaded'), 20170531, true );
        
        wp_enqueue_script( 'artwork-isotope', get_template_directory_uri() . '/js/isotope-settings-artwork.js', array('revived-isotope-cdn'), 20170531, true );  

        // artwork lightbox
        wp_enqueue_script( 'swipebox', get_template_directory_uri().'/js/jquery.swipebox.min.js', array('jquery'), '', true );

        wp_enqueue_script( 'hookup.swipebox', get_template_directory_uri().'/js/load-swipebox.js', array('swipebox'), true );  
    }

            // enqueue flexslider script if it is the front page
    if ( is_front_page( ) ) {
     
        //wp_enqueue_style('revivedfurnishings-flex', get_template_directory_uri() . '/flexslider.css');

        //call in the necessary js files
        wp_enqueue_script( 'jquery.flexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js', array('jquery'), '', true );

        wp_enqueue_script( 'hookup.flexslider', get_template_directory_uri().'/js/load-flexslider.js', array('jquery.flexslider'), true );

    }
}
add_action( 'wp_enqueue_scripts', 'revivedfurnishings_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


// Custom Log-In Page
function my_custom_login() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login/custom-login-styles.css" />';
    }
add_action('login_head', 'my_custom_login');


// Clicking on logo will link to Revived Furnishings Web
function my_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );


function my_login_logo_url_title() {
    return 'Revived Furnishings';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


// Customize Login Error Message
function login_error_override()
{
    return 'Incorrect login credentials.';
}
add_filter('login_errors', 'login_error_override');


//ACF Google Map

function my_acf_init() {
    
    acf_update_setting('google_api_key', 'AIzaSyBBEsAHz1Yijg-1TyYl-y-kPi0xl5yL-Y0');
}

add_action('acf/init', 'my_acf_init');



// Custom Post Types
function CPT() {

	//Furniture CPT
    $labels = array(
        'name'               => _x( 'Furniture', 'post type general name' ),
        'singular_name'      => _x( 'Furniture', 'post type singular name'),
        'menu_name'          => _x( 'Furniture', 'admin menu' ),
        'name_admin_bar'     => _x( 'Furniture', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'furniture' ),
        'add_new_item'       => __( 'Add New Furniture' ),
        'new_item'           => __( 'New Furniture' ),
        'edit_item'          => __( 'Edit Furniture' ),
        'view_item'          => __( 'View Furniture' ),
        'all_items'          => __( 'All Furniture' ),
        'search_items'       => __( 'Search Furniture' ),
        'parent_item_colon'  => __( 'Parent Furniture:' ),
        'not_found'          => __( 'No furniture found.' ),
        'not_found_in_trash' => __( 'No furniture found in Trash.' ),
        'archives'           => __( 'Furniture Archives'),
        'insert_into_item'   => __( 'Uploaded to this furniture'),
        'uploaded_to_this_item' => __( 'Furniture Archives'),
        'filter_item_list'   => __( 'Filter furniture list'),
        'items_list_navigation' => __( 'Furniture list navigation'),
        'items_list'         => __( 'Furniture list'),
        'featured_image'     => __( 'Furniture feature image'),
        'set_featured_image' => __( 'Set furniture feature image'),
        'remove_featured_image' => __( 'Remove furniture feature image'),
        'use_featured_image' => __( 'Use as feature image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'furniture' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'thumbnail', 'editor'),
        'menu_icon'          => 'dashicons-hammer',
    );
    register_post_type( 'furniture', $args );


    //Artwork CPT
    $labels = array(
        'name'               => _x( 'Artwork', 'post type general name' ),
        'singular_name'      => _x( 'Artwork', 'post type singular name'),
        'menu_name'          => _x( 'Artwork', 'admin menu' ),
        'name_admin_bar'     => _x( 'Artwork', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'artwork' ),
        'add_new_item'       => __( 'Add New Artwork' ),
        'new_item'           => __( 'New Artwork' ),
        'edit_item'          => __( 'Edit Artwork' ),
        'view_item'          => __( 'View Artwork' ),
        'all_items'          => __( 'All Artwork' ),
        'search_items'       => __( 'Search Artwork' ),
        'parent_item_colon'  => __( 'Parent Artwork:' ),
        'not_found'          => __( 'No artwork found.' ),
        'not_found_in_trash' => __( 'No artwork found in Trash.' ),
        'archives'           => __( 'Artwork Archives'),
        'insert_into_item'   => __( 'Uploaded to this artwork'),
        'uploaded_to_this_item' => __( 'Artwork Archives'),
        'filter_item_list'   => __( 'Filter artwork list'),
        'items_list_navigation' => __( 'Artwork list navigation'),
        'items_list'         => __( 'Artwork list'),
        'featured_image'     => __( 'Artwork feature image'),
        'set_featured_image' => __( 'Set artwork feature image'),
        'remove_featured_image' => __( 'Remove artwork feature image'),
        'use_featured_image' => __( 'Use as feature image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'artwork' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'thumbnail'),
        'menu_icon'          => 'dashicons-admin-customizer',
    );
    register_post_type( 'artwork', $args );
}


 add_action( 'init', 'CPT' );



// function rewrite_flush() {
//     CPT();
//     flush_rewrite_rules();
// }
// register_activation_hook( __FILE__, 'rewrite_flush' );



// Custom Taxonomy

function custom_taxonomies() {
    
    //Furniture Categories taxonomy
    $labels = array(
        'name'              => _x( 'Furniture Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Furniture Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Furniture Categories' ),
        'all_items'         => __( 'All Furniture Types' ),
        'parent_item'       => __( 'Parent Furniture Category' ),
        'parent_item_colon' => __( 'Parent Furniture Category:' ),
        'edit_item'         => __( 'Edit Furniture Category' ),
        'view_item'         => __( 'View Furniture Category' ),
        'update_item'       => __( 'Update Furniture Category' ),
        'add_new_item'      => __( 'Add New Furniture Category' ),
        'new_item_name'     => __( 'New Furniture Category Name' ),
        'menu_name'         => __( 'Furniture Category' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'furniture-categories' ),
    );
    register_taxonomy( 'furniture-category', array( 'furniture' ), $args );


    //Furniture Active/Sold taxonomy
    $labels = array(
        'name'              => _x( 'Sale Status', 'taxonomy general name' ),
        'singular_name'     => _x( 'Sale Status', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Furniture Sale Status' ),
        'all_items'         => __( 'All Furniture Sale Status' ),
        'parent_item'       => __( 'Parent Furniture Sale Status' ),
        'parent_item_colon' => __( 'Parent Furniture Sale Status:' ),
        'edit_item'         => __( 'Edit Furniture Sale Status' ),
        'view_item'         => __( 'View Furniture Sale Status' ),
        'update_item'       => __( 'Update Furniture Sale Status' ),
        'add_new_item'      => __( 'Add New Furniture Sale Status' ),
        'new_item_name'     => __( 'New Furniture Sale Status' ),
        'menu_name'         => __( 'Furniture Sale Status' ),
    );

    $capabilities = array(
            'manage_terms'      => '',
            'edit_terms'        => '',
            'delete_terms'      => '',
            'assign_terms'      => 'edit_posts',
    );
    
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'capabilities'      => $capabilities,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'furniture-status' ),
    );
    register_taxonomy( 'furniture-status', array( 'furniture' ), $args );


     //Featured Furnitures taxonomy
    $labels = array(
        'name'              => _x( 'Featured', 'taxonomy general name' ),
        'singular_name'     => _x( 'Featured', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Featured' ),
        'all_items'         => __( 'All Featured' ),
        'parent_item'       => __( 'Parent Featured' ),
        'parent_item_colon' => __( 'Parent Featured:' ),
        'edit_item'         => __( 'Edit Featured' ),
        'view_item'         => __( 'View Featured' ),
        'update_item'       => __( 'Update Featured' ),
        'add_new_item'      => __( 'Add New Featured' ),
        'new_item_name'     => __( 'New Furniture Featured' ),
        'menu_name'         => __( 'Featured' ),
    );

    $capabilities = array(
            'manage_terms'      => '',
            'edit_terms'        => '',
            'delete_terms'      => '',
            'assign_terms'      => 'edit_posts',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'capabilities'      => $capabilities, 
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'featured' ),
    );
    register_taxonomy( 'featured', array('furniture'), $args );

 }
 add_action( 'init', 'custom_taxonomies');



//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////              Dashboard Customization               ////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////


 // Rename Dashboard Menus
function revived_furnishings_change_menu_label() {
    global $menu;
    global $submenu;
    
    $menu[10][0] = 'Images';//Media
    $submenu['upload.php'][5][0] = 'MyLibrary';//Library
    $submenu['upload.php'][10][0] = 'Add Images';//Add New
    
    $menu[20][0] = 'MyPages';//Pages
    $submenu['edit.php?post_type=page'][5][0] = 'All MyPages';//All Pages
    $submenu['edit.php?post_type=page'][10][0] = 'Add MyPage';//Add New
}
add_action( 'admin_menu', 'revived_furnishings_change_menu_label' );


//Remove Menu from Admins Menu list in the Dashboard for everyone...
function revived_furnishings_remove_menus(){
  remove_menu_page( 'edit.php' );                   //Posts
  remove_menu_page( 'edit-comments.php' );          //Comments
  remove_menu_page( 'wpcf7' );                  // Contact Form
  remove_submenu_page( 'themes.php', 'widgets.php' );  //Widgets  
}
add_action( 'admin_menu', 'revived_furnishings_remove_menus' );


//Remove submenu || you must provide the slug of the submenu's parent, and then the slug for the submenu itself 
function revived_furnishings_remove_menu_pages() {
    remove_submenu_page( 'edit.php?post_type=page', 'post-new.php?post_type=page' ); //remove Add New Page
    remove_submenu_page('themes.php','theme-editor.php');//remove Theme editor
}
add_action( 'admin_menu', 'revived_furnishings_remove_menu_pages' );


// hide "Add New" button on "MyPages" page
function remove_add_new_button() {
  global $pagenow;
  if(is_admin()){
    if($pagenow == 'edit.php' && $_GET['post_type'] == 'page'){
      echo '<style>.page-title-action{display: none;}</style>';
    }  
  }
}
add_action('admin_head','remove_add_new_button');



// Re-order left admin menu
function revived_furnishings_change_menu_order( $__return_true ) {
    return array(
      'index.php', // Dashboard
      'separator1', // --Space--
      'edit.php?post_type=furniture', // Furniture
      'edit.php?post_type=artwork', // Artwork
      'edit.php?post_type=page', // Pages 
      'upload.php', // Media
      'separator2', // --Space--
      'themes.php', // Appearance
      'plugins.php', // Plugins
      'users.php', // Users
      'tools.php', // Tools
      'options-general.php', // Settings
      'edit.php?post_type=acf-field-group', // ACF
   );
}
add_filter( 'custom_menu_order', 'revived_furnishings_change_menu_order' );
add_filter( 'menu_order', 'revived_furnishings_change_menu_order' );


// Remove Dashboard Widgets for relevant users
function revived_furnishings_remove_dashboard_widgets() {
//    $user = wp_get_current_user();
//    if ( ! $user->has_cap( 'manage_options' ) ) {
        remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );// Incoming Links
        remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );// Plugins
        remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );// WordPress blog
        remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );// Other WordPress News
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );// Quick Press
        remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );// Recent Drafts
        remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );// Recent Comments
        remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );// Right Now
        remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');//Activity
    
            
        // gravity forms
       remove_meta_box( 'rg_forms_dashboard', 'dashboard', 'normal');
        // Yoast SEO
       remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal');
//    }
}
add_action( 'wp_dashboard_setup', 'revived_furnishings_remove_dashboard_widgets' );


// disable default dashboard widgets
function remove_dashboard_widgets() {

    global $wp_meta_boxes;

    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);

    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');


//remove welcome panel widget
remove_action('welcome_panel', 'wp_welcome_panel');





///////////////////////////////////////////////////////////////////////
# REMOVE TOOLBAR ITEMS ON THE DASHBOARD
//////////////////////////////////////////////////////////////////////
function revived_furnishings_remove_admin_bar_links() {
    global $wp_admin_bar;

    //Remove WordPress Logo Menu Items
    $wp_admin_bar->remove_menu('wp-logo'); // Removes WP Logo and submenus completely, to remove individual items, use the below mentioned codes
    $wp_admin_bar->remove_menu('about'); // 'About WordPress'
    $wp_admin_bar->remove_menu('wporg'); // 'WordPress.org'
    $wp_admin_bar->remove_menu('documentation'); // 'Documentation'
    $wp_admin_bar->remove_menu('support-forums'); // 'Support Forums'
    $wp_admin_bar->remove_menu('feedback'); // 'Feedback'

    //Remove Site Name Items
    $wp_admin_bar->remove_menu('themes'); // 'Themes'
    $wp_admin_bar->remove_menu('widgets'); // 'Widgets'
    $wp_admin_bar->remove_menu('menus'); // 'Menus'

    // Remove Comments Bubble
    $wp_admin_bar->remove_menu('comments');

    //Remove Edit Page
    $wp_admin_bar->remove_menu('edit');

    //Remove '+ New' Menu Items
    $wp_admin_bar->remove_menu('new-post'); // 'Post' Link
    $wp_admin_bar->remove_menu('new-link'); // 'Link' Link
    $wp_admin_bar->remove_menu('new-page'); // 'Page' Link
    
}
add_action( 'wp_before_admin_bar_render', 'revived_furnishings_remove_admin_bar_links' );


//CHANGE THE HOWDY $username TO SOMETHING ELSE
function replace_howdy( $wp_admin_bar ) {
  $my_account=$wp_admin_bar->get_node('my-account');
  $newtitle = str_replace( 'Howdy,', 'Welcome,', $my_account->title );
  $wp_admin_bar->add_node( array(
  'id' => 'my-account',
  'title' => $newtitle,
  ) );
}
add_filter( 'admin_bar_menu', 'replace_howdy',25 );


// Custom Admin footer
function revived_furnishings_footer_admin() {
    echo '<span id="footer-thankyou">Built with love by Revived Furnishings Team</span>';
}
add_filter( 'admin_footer_text', 'revived_furnishings_footer_admin' );