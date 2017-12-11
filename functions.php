<?php
/**
 * tp_theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package tp_theme
 */

if ( ! function_exists( 'tp_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function tp_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on tp_theme, use a find and replace
		 * to change 'tp_theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'tp_theme', get_template_directory() . '/languages' );

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
            'menu-1' => esc_html__( 'Primary', 'tp_theme' ),
            'menu-2' => "Footer Menu",
            'menu-3' => "Template Menu"
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'tp_theme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'tp_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tp_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tp_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'tp_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tp_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'tp_theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'tp_theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => 'Right Sidebar',
        'id'            => 'right_sidebar',
        'description'   => 'Sidebar de droite',
        'before_widget' => '<div class="right-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="right-widget-title">',
        'after_title'   => '</h4>'
    ) );
    register_sidebar( array(
        'name'          => 'Left Sidebar',
        'id'            => 'left_sidebar',
        'description'   => 'Sidebar de gauche',
        'before_widget' => '<div class="left-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="left-widget-title">',
        'after_title'   => '</h4>'
    ) );
}
add_action( 'widgets_init', 'tp_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tp_theme_scripts() {
	wp_enqueue_style( 'tp_theme-style', get_stylesheet_uri() );

	wp_enqueue_script( 'tp_theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'tp_theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tp_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/*** tp theme functions ***/
include 'theme_settings.php';

function get_custom_styles(){

    $custom_colors = get_option( "custom_colors" );

    echo "<style>";

        for( $i=0; $i<6; $i++ ) { 
            echo "h".($i+1)." { color: #". $custom_colors["headers"][$i] . " }";
        }
        
        echo "p { color: #" . $custom_colors["body"] . " }";

        echo "#content { background-color: #" . $custom_colors["background"] . " }"; 

    echo "</style>";
}