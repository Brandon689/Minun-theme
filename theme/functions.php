<?php

add_action('after_setup_theme', function() {
  remove_action('wp_head', 'feed_links_extra');
  remove_action('wp_head', 'feed_links');
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_head', 'rest_output_link_header');
  remove_action('wp_head', 'rest_output_link_wp_head');
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wp_oembed_add_discovery_links');
  remove_action('wp_head', 'wp_resource_hints');
  remove_action('wp_head', 'wp_shortlink_wp_head');

  remove_action('template_redirect', 'rest_output_link_header');
  remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 20 );

  remove_action('wp_body_open', 'gutenberg_global_styles_render_svg_filters');
  remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
  remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
  remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
  remove_action('wp_footer', 'wp_enqueue_global_styles');

  remove_filter('render_block', 'wp_render_duotone_support');
  remove_filter('render_block', 'wp_render_layout_support_flag');
  remove_filter('render_block', 'wp_restore_group_inner_container');

  //add_filter('get_site_icon_url', '__return_false');
  add_filter('the_generator', '__return_null');
  add_filter('use_block_editor_for_post_type', '__return_false');

});
// add_action( 'do_faviconico', 'magic_favicon_remover');
// function magic_favicon_remover() {
//     exit;
// }
add_action('init', function() {
  remove_action('wp_head', 'wc_gallery_noscript');
});

add_action('enqueue_block_assets', function() {
	wp_deregister_style('wc-blocks-style');
	wp_dequeue_style('wc-blocks-style');
});

function woo_dequeue_select2() {
    if ( class_exists( 'woocommerce' ) ) {
        wp_dequeue_style( 'select2' );
        wp_deregister_style( 'select2' );

        wp_dequeue_script( 'selectWoo');
        wp_deregister_script('selectWoo');
    } 
}
add_action( 'wp_enqueue_scripts', 'woo_dequeue_select2', 100 );


add_action('wp_enqueue_scripts', function() {
  wp_deregister_script('jquery');
  wp_deregister_script('jquery-core');
  wp_deregister_script('wc-cart-fragments');

  wp_deregister_style('woocommerce-inline');
  wp_deregister_style('wp-block-library');
}, 100);








/**
 * minun functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package minun
 */

if ( ! defined( 'minun_VERSION' ) ) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define( 'minun_VERSION', '0.1.0' );
}

// if ( ! defined( 'minun_TYPOGRAPHY_CLASSES' ) ) {
// 	/*
// 	 * Set Tailwind Typography classes for the front end, block editor and
// 	 * classic editor using the constant below.
// 	 *
// 	 * For the front end, these classes are added by the `minun_content_class`
// 	 * function. You will see that function used everywhere an `entry-content`
// 	 * or `page-content` class has been added to a wrapper element.
// 	 *
// 	 * For the block editor, these classes are converted to a JavaScript array
// 	 * and then used by the `./javascript/block-editor.js` file, which adds
// 	 * them to the appropriate elements in the block editor (and adds them
// 	 * again when they’re removed.)
// 	 *
// 	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
// 	 * Fields), these classes are added to TinyMCE’s body class when it
// 	 * initializes.
// 	 */
// 	define(
// 		'minun_TYPOGRAPHY_CLASSES',
// 		'prose prose-neutral max-w-none prose-a:text-primary'
// 	);
// }

if ( ! function_exists( 'minun_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function minun_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on minun, use a find and replace
		 * to change 'minun' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'minun', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'minun' ),
				'menu-2' => __( 'Footer Menu', 'minun' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
add_theme_support( 'woocommerce' );

	if (class_exists('Woocommerce')){
    add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
	}
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );
		add_editor_style( 'style-editor-extra.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', 'minun_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function minun_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'minun' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'minun' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'minun_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function minun_scripts() {
	wp_enqueue_style( 'minun-style', get_stylesheet_uri(), array(), minun_VERSION );
	wp_enqueue_script( 'minun-script', get_template_directory_uri() . '/js/script.min.js', array(), minun_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'minun_scripts' );

/**
 * Enqueue the block editor script.
 */
// function minun_enqueue_block_editor_script() {
// 	wp_enqueue_script(
// 		'minun-editor',
// 		get_template_directory_uri() . '/js/block-editor.min.js',
// 		array(
// 			'wp-blocks',
// 			'wp-edit-post',
// 		),
// 		minun_VERSION,
// 		true
// 	);
// }
// add_action( 'enqueue_block_editor_assets', 'minun_enqueue_block_editor_script' );

/**
 * Enqueue the script necessary to support Tailwind Typography in the block
 * editor, using an inline script to create a JavaScript array containing the
 * Tailwind Typography classes from minun_TYPOGRAPHY_CLASSES.
 */
// function minun_enqueue_typography_script() {
// 	if ( is_admin() ) {
// 		wp_enqueue_script(
// 			'minun-typography',
// 			get_template_directory_uri() . '/js/tailwind-typography-classes.min.js',
// 			array(
// 				//'wp-blocks',
// 				'wp-edit-post',
// 			),
// 			minun_VERSION,
// 			true
// 		);
// 		wp_add_inline_script( 'minun-typography', "tailwindTypographyClasses = '" . esc_attr( minun_TYPOGRAPHY_CLASSES ) . "'.split(' ');", 'before' );
// 	}
// }
// add_action( 'enqueue_block_assets', 'minun_enqueue_typography_script' );

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
// function minun_tinymce_add_class( $settings ) {
// 	$settings['body_class'] = minun_TYPOGRAPHY_CLASSES;
// 	return $settings;
// }
// add_filter( 'tiny_mce_before_init', 'minun_tinymce_add_class' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

