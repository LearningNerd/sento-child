<?php
/**
 * Setup theme functions for Sento child.
 *
 * @package sento-child
 */

// Setup content width 
if ( ! isset( $content_width ) )
	$content_width = 1170;

//----------------------------------------------------------------------------------
//	Add Theme Options Panel & Assign Variable Values
//----------------------------------------------------------------------------------

	// Add Redux Framework
	//require_once( get_template_directory() . '/admin/main/framework.php' );
	require_once( '/admin/main/framework.php' );
	//require_once( get_template_directory() . '/admin/main/options.php' );
	require_once( '/admin/main/options.php' );
	require_once( '/admin/main-extensions/extensions-init.php' );
	//require_once( get_template_directory() . '/admin/main-extensions/extensions-init.php' );

	// Add Notice Informing Users Theme Options Have Moved To Customizer
	require_once( '/admin/main/customizer_migration_notice/customizer_migration_notice.php' );

	// Load Theme Variables.
	require_once( '/admin/main/options/00.variables.php' ); 

	// Add Theme Options Features.
	require_once( '/admin/main/options/00.theme-setup.php' ); 
	require_once( '/admin/main/options/01.general-settings.php' ); 
	require_once( '/admin/main/options/02.homepage.php' ); 
	require_once( '/admin/main/options/03.header.php' ); 
	require_once( '/admin/main/options/04.footer.php' );
	require_once( '/admin/main/options/05.blog.php' ); 
	require_once( '/admin/main/options/08.special-pages.php' ); 

//----------------------------------------------------------------------------------
//	Assign Theme Specific Functions
//----------------------------------------------------------------------------------

// Setup theme features, register menus and scripts.
if ( ! function_exists( 'thinkup_themesetup' ) ) {

	function thinkup_themesetup() {

		// Load required files
		require_once ( '/lib/functions/extras.php' );
		require_once ( '/lib/functions/template-tags.php' );

		// Make theme translation ready.
		load_theme_textdomain( 'sento', '/languages' );

		// Add default theme functions.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats', array( 'gallery', 'image', 'video', 'audio', 'status', 'quote', 'link', 'chat' ) );
		add_theme_support( 'title-tag' );

		// Add support for custom background
		add_theme_support( 'custom-background' );

		// Add support for custom header
		$args = apply_filters( 'custom-header', array( 'height' => 200, 'width'  => 1600 ) );
		add_theme_support( 'custom-header', $args );

		// Add WooCommerce functions.
		add_theme_support( 'woocommerce' );

		// Register theme menu's.
		register_nav_menus( array( 'pre_header_menu' => __( 'Pre Header Menu', 'sento' ) ) );
		register_nav_menus( array( 'header_menu'     => __( 'Primary Header Menu', 'sento' ) ) );
		register_nav_menus( array( 'sub_footer_menu' => __( 'Footer Menu', 'sento' ) ) );
	}
}
add_action( 'after_setup_theme', 'thinkup_themesetup' );


//----------------------------------------------------------------------------------
//	Register Front-End Styles And Scripts
//----------------------------------------------------------------------------------

function thinkup_frontscripts() {

	// Add jQuery library.
	wp_enqueue_script('jquery');

	// Register theme stylesheets.
	wp_register_style( 'thinkup-responsive', get_template_directory_uri() . '/styles/style-responsive.css', '', '1.1' );
	wp_register_style( 'thinkup-sidebarleft', get_template_directory_uri() . '/styles/layouts/thinkup-left-sidebar.css', '', '1.1' );
	wp_register_style( 'thinkup-sidebarright', get_template_directory_uri() . '/styles/layouts/thinkup-right-sidebar.css', '', '1.1' );

	// Add theme stylesheets.
	wp_enqueue_style( 'thinkup-bootstrap', get_template_directory_uri() . '/lib/extentions/bootstrap/css/bootstrap.css', '', '2.3.2' );
	wp_enqueue_style( 'thinkup-prettyPhoto', get_template_directory_uri() . '/lib/extentions/prettyPhoto/css/prettyPhoto.css', '', '3.1.6' );
	wp_enqueue_style( 'thinkup-shortcodes', get_template_directory_uri() . '/styles/style-shortcodes.css', '', '1.1' );
	wp_enqueue_style( 'thinkup-style', get_stylesheet_uri(), '', '1.1.15' );

	// Add Font Packages and Google Fonts
	wp_enqueue_style( 'our-google-fonts', 'https://fonts.googleapis.com/css?family=Fira+Sans:300,400|Ubuntu:300,400,500');
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'thinkup-font-awesome', get_template_directory_uri() . '/lib/extentions/font-awesome/css/font-awesome.css', '', '4.2.0' );

	// Add theme scripts
	wp_enqueue_script( 'thinkup-imagesloaded', get_template_directory_uri() . '/lib/scripts/plugins/imagesloaded/imagesloaded.js', array( 'jquery' ), '1.3.4', true );
	wp_enqueue_script( 'thinkup-prettyPhoto', ( get_template_directory_uri().'/lib/extentions/prettyPhoto/js/jquery.prettyPhoto.js' ), array( 'jquery' ), '3.1.6', 'true' );
	wp_enqueue_script( 'thinkup-frontend', get_template_directory_uri() . '/lib/scripts/main-frontend.js', array( 'jquery' ), '1.1', 'true'  );
	wp_enqueue_script( 'thinkup-bootstrap', get_template_directory_uri() . '/lib/extentions/bootstrap/js/bootstrap.js', array( 'jquery' ), '2.3.2', 'true'  );
	wp_enqueue_script( 'thinkup-modernizr', get_template_directory_uri() . '/lib/scripts/modernizr.js', array( 'jquery' ), '2.6.2', 'true'  );

	// Register Retina script - Enqueued in 01.general-settings.php
	wp_register_script( 'thinkup-retina', get_template_directory_uri() . '/lib/scripts/retina.js', array( 'jquery' ), '0.0.2', '', true );

	// Add Masonry script to all archive pages
	if ( thinkup_check_isblog() or is_page_template( 'template-blog.php' ) or is_archive() ) {
		wp_enqueue_script( 'thinkup-masonry', get_template_directory_uri() . '/lib/scripts/plugins/masonry/masonry.js', array( 'jquery' ), '3.1.2', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Add ThinkUpSlider scripts
	if ( is_front_page() or thinkup_check_ishome() ) {
		wp_enqueue_script( 'thinkup-slider', get_template_directory_uri() . '/lib/scripts/plugins/ResponsiveSlides/responsiveslides.js', array( 'jquery' ), '1.54', 'true' );
		wp_enqueue_script( 'thinkup-slider-call', get_template_directory_uri() . '/lib/scripts/plugins/ResponsiveSlides/responsiveslides-call.js', array( 'jquery' ), '', 'true' );
	}
}
add_action( 'wp_enqueue_scripts', 'thinkup_frontscripts', 10 );


//----------------------------------------------------------------------------------
//	Register Back-End Styles And Scripts
//----------------------------------------------------------------------------------

function thinkup_adminscripts() {

	// Register theme stylesheets.
	wp_register_style( 'thinkup-backend', get_template_directory_uri() . '/styles/backend/style-backend.css', '', 1.1 );
	wp_register_style( 'thinkup-font-awesome-backend', get_template_directory_uri() . '/lib/extentions/font-awesome/css/font-awesome.css', '', '4.2.0' );

	// Register theme scripts.
	wp_register_script( 'thinkup-backend', get_template_directory_uri() . '/lib/scripts/main-backend.js', array( 'jquery' ), '1.1' );

		// Add theme stylesheets.
		wp_enqueue_style( 'thinkup-backend' );
		wp_enqueue_style( 'thinkup-font-awesome-backend' );

		// Add theme scripts.
		wp_enqueue_script( 'thinkup-backend' );
}
add_action( 'admin_enqueue_scripts', 'thinkup_adminscripts' );


//----------------------------------------------------------------------------------
//	Register Theme Widgets
//----------------------------------------------------------------------------------

function thinkup_widgets_init() {

	// Register default sidebar
	register_sidebar( array(
		'name' => __( 'Sidebar', 'sento' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Register footer sidebars
    register_sidebar( array(
        'name' => __( 'Footer Column 1', 'sento' ),
        'id' => 'footer-w1',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="footer-widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );
 
    register_sidebar( array(
        'name' => __( 'Footer Column 2', 'sento' ),
        'id' => 'footer-w2',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="footer-widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Column 3', 'sento' ),
        'id' => 'footer-w3',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="footer-widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Column 4', 'sento' ),
        'id' => 'footer-w4',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="footer-widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Column 5', 'sento' ),
        'id' => 'footer-w5',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="footer-widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Column 6', 'sento' ),
        'id' => 'footer-w6',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="footer-widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );

	// Register sub-footer sidebars
    register_sidebar( array(
        'name' => __( 'Sub-Footer Column 1', 'sento' ),
        'id' => 'sub-footer-w1',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="sub-footer-widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Sub-Footer Column 2', 'sento' ),
        'id' => 'sub-footer-w2',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="sub-footer-widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );
}
add_action( 'widgets_init', 'thinkup_widgets_init' );