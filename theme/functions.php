<?php
/**
 * WP EasySoft functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP_EasySoft
 */

if (!defined('WP_EASYSOFT_VERSION')) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define('WP_EASYSOFT_VERSION', '0.1.0');
}

if (!defined('WP_EASYSOFT_TYPOGRAPHY_CLASSES')) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `wp_easysoft_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'WP_EASYSOFT_TYPOGRAPHY_CLASSES',
		'prose prose-neutral max-w-none prose-a:text-primary'
	);
}

if (!function_exists('wp_easysoft_setup')):
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wp_easysoft_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on WP EasySoft, use a find and replace
		 * to change 'wp-easysoft' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('wp-easysoft', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __('Primary', 'wp-easysoft'),
				'menu-2' => __('Footer Menu', 'wp-easysoft'),
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

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		// Add support for editor styles.
		add_theme_support('editor-styles');

		// Enqueue editor styles.
		add_editor_style('style-editor.css');

		// Add support for responsive embedded content.
		add_theme_support('responsive-embeds');

		// Remove support for block templates.
		remove_theme_support('block-templates');
	}
endif;
add_action('after_setup_theme', 'wp_easysoft_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_easysoft_widgets_init()
{
	register_sidebar(
		array(
			'name'          => __('Footer', 'wp-easysoft'),
			'id'            => 'sidebar-1',
			'description'   => __('Add widgets here to appear in your footer.', 'wp-easysoft'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'wp_easysoft_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function wp_easysoft_scripts()
{
	wp_enqueue_style('wp-easysoft-style', get_stylesheet_uri(), array(), WP_EASYSOFT_VERSION);
	wp_enqueue_script('wp-easysoft-script', get_template_directory_uri() . '/js/script.min.js', array(), WP_EASYSOFT_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
	// Enqueue Font Awesome from CDN
	wp_enqueue_style(
		'font-awesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
		array(),
		'6.4.0'
	);
}
add_action('wp_enqueue_scripts', 'wp_easysoft_scripts');

/**
 * Enqueue the block editor script.
 */
function wp_easysoft_enqueue_block_editor_script()
{
	$current_screen = function_exists('get_current_screen') ? get_current_screen() : null;

	if (
		$current_screen &&
		$current_screen->is_block_editor() &&
		'widgets' !== $current_screen->id
	) {
		wp_enqueue_script(
			'wp-easysoft-editor',
			get_template_directory_uri() . '/js/block-editor.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			WP_EASYSOFT_VERSION,
			true
		);
		wp_add_inline_script('wp-easysoft-editor', "tailwindTypographyClasses = '" . esc_attr(WP_EASYSOFT_TYPOGRAPHY_CLASSES) . "'.split(' ');", 'before');
	}
}
add_action('enqueue_block_assets', 'wp_easysoft_enqueue_block_editor_script');

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function wp_easysoft_tinymce_add_class($settings)
{
	$settings['body_class'] = WP_EASYSOFT_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter('tiny_mce_before_init', 'wp_easysoft_tinymce_add_class');

/**
 * Limit the block editor to heading levels supported by Tailwind Typography.
 *
 * @param array  $args Array of arguments for registering a block type.
 * @param string $block_type Block type name including namespace.
 * @return array
 */
function wp_easysoft_modify_heading_levels($args, $block_type)
{
	if ('core/heading' !== $block_type) {
		return $args;
	}

	// Remove <h1>, <h5> and <h6>.
	$args['attributes']['levelOptions']['default'] = array(2, 3, 4);

	return $args;
}
add_filter('register_block_type_args', 'wp_easysoft_modify_heading_levels', 10, 2);

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';


/**
 * Register theme Gutenberg blocks with full debugging.
 */
add_action('init', function () {

	$build_dir = get_template_directory() . '/blocks/build/';
	$manifest  = $build_dir . 'blocks-manifest.php';

	//
	// Debug: Log base paths
	//
	error_log("=== BLOCK DEBUG START ===");
	error_log("Build directory: " . $build_dir);
	error_log("Manifest file: " . $manifest);

	//
	// Step 1: Does the build directory exist?
	//
	if (!file_exists($build_dir)) {
		error_log("ERROR: build directory does NOT exist.");
		error_log("=== BLOCK DEBUG END ===");
		return;
	} else {
		error_log("OK: build directory exists.");
	}

	//
	// Step 2: Does manifest file exist?
	//
	if (file_exists($manifest)) {
		error_log("OK: manifest.php exists.");
	} else {
		error_log("WARNING: manifest.php does NOT exist.");
	}

	//
	// Step 3: List all block.json files in build/
	//
	$block_json_files = glob($build_dir . '*/block.json');
	error_log("Block.json files detected: " . print_r($block_json_files, true));

	//
	// Step 4: WordPress 6.5 bulk loader
	//
	if (function_exists('wp_register_block_types_from_metadata_collection')) {

		error_log("Using: wp_register_block_types_from_metadata_collection()");

		if (file_exists($manifest)) {
			wp_register_block_types_from_metadata_collection($build_dir, $manifest);
			error_log("SUCCESS: Blocks registered via metadata collection loader.");
			error_log("=== BLOCK DEBUG END ===");
			return;
		} else {
			error_log("ERROR: Manifest missing — cannot use collection loader.");
		}
	}

	//
	// Step 5: WordPress fallback metadata collection loader
	//
	if (function_exists('wp_register_block_metadata_collection')) {

		error_log("Using: wp_register_block_metadata_collection()");

		if (file_exists($manifest)) {
			wp_register_block_metadata_collection($build_dir, $manifest);
			error_log("SUCCESS: Blocks registered via metadata fallback loader.");
			error_log("=== BLOCK DEBUG END ===");
			return;
		} else {
			error_log("ERROR: Manifest missing — cannot use metadata loader.");
		}
	}

	//
	// Step 6: Manual registration using manifest
	//
	if (file_exists($manifest)) {

		error_log("FALLBACK: Manual block loading using manifest.");

		$manifest_data = require $manifest;

		foreach (array_keys($manifest_data) as $slug) {
			$block_path = $build_dir . $slug;

			if (file_exists($block_path . '/block.json')) {
				register_block_type($block_path);
				error_log("REGISTERED: " . $block_path);
			} else {
				error_log("SKIPPED (missing block.json): " . $block_path);
			}
		}

		error_log("=== BLOCK DEBUG END ===");
		return;
	}

	//
	// Step 7: Final fallback — scan all folders
	//
	error_log("FALLBACK: Scanning directories manually...");

	$folders = glob($build_dir . '*', GLOB_ONLYDIR);

	foreach ($folders as $folder) {

		if (file_exists($folder . '/block.json')) {
			register_block_type($folder);
			error_log("REGISTERED (no manifest): " . $folder);
		} else {
			error_log("SKIPPED (no block.json): " . $folder);
		}
	}

	error_log("=== BLOCK DEBUG END ===");

});
