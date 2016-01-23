<?php
/**
 * _as functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _as
 */

if ( ! function_exists( '_as_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function _as_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _as, use a find and replace
	 * to change '_as' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( '_as', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary', '_as' ),
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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( '_as_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', '_as_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function _as_content_width() {
	$GLOBALS['content_width'] = apply_filters( '_as_content_width', 640 );
}
add_action( 'after_setup_theme', '_as_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _as_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', '_as' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', '_as_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function _as_scripts() {
	wp_enqueue_style( '_as-style', get_stylesheet_uri() );

	wp_enqueue_script( '_as-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( '_as-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', '_as_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
/**
 * Load RequiredPlugins.
 */
 /**
 * Include the TGM_Plugin_Activation class.
 */
 require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
  
 add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
  
 /**
10  * Register the required plugins for this theme.
11  *
12  *  <snip />
13  *
14  * This function is hooked into tgmpa_init, which is fired within the
15  * TGM_Plugin_Activation class constructor.
16  */
	function my_theme_register_required_plugins() {
	/*
	* Array of plugin arrays. Required keys are name and slug.
	* If the source is NOT from the .org repo, then source is also required.
	*/
	$plugins = array(
 
// This is an example of how to include a plugin bundled with a theme.
	array(
				'name'               => 'Visual Composer', // The plugin name.
				'slug'               => 'visual_composer', // The plugin slug (typically the folder name).
				'source'             => get_stylesheet_directory() . '/lib/plugins/js_composer.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => "4.9.2", // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
),

// This is an example of how to include a plugin from the WordPress Plugin Repository.
array(
'name'      => 'BuddyPress',
'slug'      => 'buddypress',
'required'  => false,
),

// <snip />
);

/*
48 	 * Array of configuration settings. Amend each line as needed.
49 	 *
50 	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
51 	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
52 	 * sending in a pull-request with .po file(s) with the translations.
53 	 *
54 	 * Only uncomment the strings in the config array if you want to customize the strings.
55 	 */
$config = array(
'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
'default_path' => '',                      // Default absolute path to bundled plugins.
'menu'         => 'instaluj-pluginy', // Menu slug.
'parent_slug'  => 'themes.php',            // Parent menu slug.
'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
'has_notices'  => true,                    // Show admin notices or not.
'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
'is_automatic' => false,                   // Automatically activate plugins after installation or not.
'message'      => '',                      // Message to output right before the plugins table.
/*
'strings'      => array(
'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),
'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),
// <snip>...</snip>
'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
)
*/
);
tgmpa( $plugins, $config );
}