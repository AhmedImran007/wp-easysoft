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
		'prose prose-neutral max-w-none prose-a:text-primary content-wide'
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
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_easysoft_widgets_init()
{

	// Footer Widget
	register_sidebar(
		array(
			'name'          => __('Footer', 'wp-easysoft'),
			'id'            => 'footer-widget',
			'description'   => __('Add widgets here to appear in your footer.', 'wp-easysoft'),
			'before_widget' => '<section id="%1$s" class="widget %2$s mb-6">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title text-lg font-bold mb-3">',
			'after_title'   => '</h2>',
		)
	);

	// Main Sidebar
	register_sidebar(
		array(
			'name'          => __('Main Sidebar', 'tw'),
			'id'            => 'main-sidebar',
			'description'   => __('Widgets in this area will be shown in the sidebar.', 'tw'),
			'before_widget' => '<div id="%1$s" class="widget %2$s mb-6 p-4 bg-white shadow rounded">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title text-xl font-bold mb-3">',
			'after_title'   => '</h3>',
		)
	);

	// Header Widget Area (NEW)
	register_sidebar(
		array(
			'name'          => __('Header Widget', 'wp-easysoft'),
			'id'            => 'header-widget',
			'description'   => __('Appears in the header section.', 'wp-easysoft'),
			'before_widget' => '<div id="%1$s" class="widget %2$s header-widget mx-4">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title text-base font-semibold mb-2">',
			'after_title'   => '</h3>',
		)
	);

	// Blog Sidebar (NEW)
	register_sidebar(
		array(
			'name'          => __('Blog Sidebar', 'wp-easysoft'),
			'id'            => 'blog-sidebar',
			'description'   => __('Sidebar widgets for blog pages.', 'wp-easysoft'),
			'before_widget' => '<div id="%1$s" class="widget %2$s mb-6 p-4 bg-gray-100 border rounded">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title text-lg font-semibold mb-2">',
			'after_title'   => '</h3>',
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
 * Register theme Gutenberg blocks (clean version).
 */
add_action('init', function () {

	$build_dir = get_template_directory() . '/blocks/build/';
	$manifest  = $build_dir . 'blocks-manifest.php';

	// Stop if build directory missing
	if (!file_exists($build_dir)) {
		return;
	}

	// --- WordPress 6.5 bulk loader ---
	if (function_exists('wp_register_block_types_from_metadata_collection')) {
		if (file_exists($manifest)) {
			wp_register_block_types_from_metadata_collection($build_dir, $manifest);
			return;
		}
	}

	// --- Fallback loader ---
	if (function_exists('wp_register_block_metadata_collection')) {
		if (file_exists($manifest)) {
			wp_register_block_metadata_collection($build_dir, $manifest);
			return;
		}
	}

	// --- Manual registration using manifest ---
	if (file_exists($manifest)) {
		$manifest_data = require $manifest;

		foreach (array_keys($manifest_data) as $slug) {
			$block_path = $build_dir . $slug;

			if (file_exists($block_path . '/block.json')) {
				register_block_type($block_path);
			}
		}
		return;
	}

	// --- Final fallback: scan directories ---
	$folders = glob($build_dir . '*', GLOB_ONLYDIR);

	foreach ($folders as $folder) {
		if (file_exists($folder . '/block.json')) {
			register_block_type($folder);
		}
	}

});

class WPES_Dropdown_Walker extends Walker_Nav_Menu
{

	// Start submenu
	function start_lvl(&$output, $depth = 0, $args = null)
	{
		$indent  = str_repeat("\t", $depth);
		$output .= "\n$indent<ul x-show=\"open\"
            x-transition:enter=\"transition ease-out duration-200\"
            x-transition:enter-start=\"opacity-0 translate-y-2\"
            x-transition:enter-end=\"opacity-100 translate-y-0\"
            x-transition:leave=\"transition ease-in duration-150\"
            x-transition:leave-start=\"opacity-100 translate-y-0\"
            x-transition:leave-end=\"opacity-0 translate-y-2\"
            class=\"absolute left-0 mt-2 w-48 bg-white shadow-lg py-2 border border-gray-200 z-50\"
            @mouseenter=\"open = true\"
            @mouseleave=\"open = false\">\n";
	}

	// Start menu item
	function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
	{
		$has_children = in_array("menu-item-has-children", $item->classes);
		$indent       = ($depth) ? str_repeat("\t", $depth) : '';

		// <li> with Alpine.js data
		$output .= $indent . '<li class="relative" x-data="{ open: false }" ' .
			($has_children ? '@mouseenter="open = true" @mouseleave="open = false"' : '') . '>';

		$atts = !empty($item->url) ? ' href="' . esc_url($item->url) . '"' : '';

		$output .= '<a ' . $atts . ' class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-primary transition flex items-center justify-between w-full">';
		$output .= esc_html($item->title);

		// Add dropdown arrow if has children
		if ($has_children) {
			$output .= '<i class="fas fa-chevron-down ml-2 text-xs transition-transform" :class="{ \'rotate-180\': open }"></i>';
		}

		$output .= '</a>';
	}

	// End menu item
	function end_el(&$output, $item, $depth = 0, $args = null)
	{
		$output .= "</li>\n";
	}
}

// Register Custom Post Type: WP Plugin
function wp_easysoft_register_wp_plugin_post_type()
{
	$labels = array(
		'name'                  => _x('WP Plugins', 'Post Type General Name', 'wp-easysoft'),
		'singular_name'         => _x('WP Plugin', 'Post Type Singular Name', 'wp-easysoft'),
		'menu_name'             => __('WP Plugins', 'wp-easysoft'),
		'name_admin_bar'        => __('WP Plugin', 'wp-easysoft'),
		'archives'              => __('WP Plugin Archives', 'wp-easysoft'),
		'attributes'            => __('WP Plugin Attributes', 'wp-easysoft'),
		'parent_item_colon'     => __('Parent WP Plugin:', 'wp-easysoft'),
		'all_items'             => __('All WP Plugins', 'wp-easysoft'),
		'add_new_item'          => __('Add New WP Plugin', 'wp-easysoft'),
		'add_new'               => __('Add New', 'wp-easysoft'),
		'new_item'              => __('New WP Plugin', 'wp-easysoft'),
		'edit_item'             => __('Edit WP Plugin', 'wp-easysoft'),
		'update_item'           => __('Update WP Plugin', 'wp-easysoft'),
		'view_item'             => __('View WP Plugin', 'wp-easysoft'),
		'view_items'            => __('View WP Plugins', 'wp-easysoft'),
		'search_items'          => __('Search WP Plugin', 'wp-easysoft'),
		'not_found'             => __('Not found', 'wp-easysoft'),
		'not_found_in_trash'    => __('Not found in Trash', 'wp-easysoft'),
		'featured_image'        => __('WP Plugin Icon', 'wp-easysoft'),
		'set_featured_image'    => __('Set plugin icon', 'wp-easysoft'),
		'remove_featured_image' => __('Remove plugin icon', 'wp-easysoft'),
		'use_featured_image'    => __('Use as plugin icon', 'wp-easysoft'),
		'insert_into_item'      => __('Insert into plugin', 'wp-easysoft'),
		'uploaded_to_this_item' => __('Uploaded to this plugin', 'wp-easysoft'),
		'items_list'            => __('WP Plugins list', 'wp-easysoft'),
		'items_list_navigation' => __('WP Plugins list navigation', 'wp-easysoft'),
		'filter_items_list'     => __('Filter plugins list', 'wp-easysoft'),
	);

	$args = array(
		'label'               => __('WP Plugin', 'wp-easysoft'),
		'description'         => __('WordPress Plugin Showcase', 'wp-easysoft'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
		'taxonomies'          => array('wp_plugin_category'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-admin-plugins',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest'        => true,
	);

	register_post_type('wp_plugin', $args);
}
add_action('init', 'wp_easysoft_register_wp_plugin_post_type', 0);

// Register Custom Taxonomy for WP Plugin Categories
function wp_easysoft_register_wp_plugin_taxonomy()
{
	$labels = array(
		'name'                       => _x('WP Plugin Categories', 'Taxonomy General Name', 'wp-easysoft'),
		'singular_name'              => _x('WP Plugin Category', 'Taxonomy Singular Name', 'wp-easysoft'),
		'menu_name'                  => __('Categories', 'wp-easysoft'),
		'all_items'                  => __('All Categories', 'wp-easysoft'),
		'parent_item'                => __('Parent Category', 'wp-easysoft'),
		'parent_item_colon'          => __('Parent Category:', 'wp-easysoft'),
		'new_item_name'              => __('New Category Name', 'wp-easysoft'),
		'add_new_item'               => __('Add New Category', 'wp-easysoft'),
		'edit_item'                  => __('Edit Category', 'wp-easysoft'),
		'update_item'                => __('Update Category', 'wp-easysoft'),
		'view_item'                  => __('View Category', 'wp-easysoft'),
		'separate_items_with_commas' => __('Separate categories with commas', 'wp-easysoft'),
		'add_or_remove_items'        => __('Add or remove categories', 'wp-easysoft'),
		'choose_from_most_used'      => __('Choose from the most used', 'wp-easysoft'),
		'popular_items'              => __('Popular Categories', 'wp-easysoft'),
		'search_items'               => __('Search Categories', 'wp-easysoft'),
		'not_found'                  => __('Not Found', 'wp-easysoft'),
		'no_terms'                   => __('No categories', 'wp-easysoft'),
		'items_list'                 => __('Categories list', 'wp-easysoft'),
		'items_list_navigation'      => __('Categories list navigation', 'wp-easysoft'),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_in_rest'      => true,
	);

	register_taxonomy('wp_plugin_category', array('wp_plugin'), $args);
}
add_action('init', 'wp_easysoft_register_wp_plugin_taxonomy', 0);

// Add meta fields for wp_plugins
function wp_easysoft_add_wp_plugin_meta_boxes()
{
	add_meta_box(
		'wp_plugin_details',
		__('WP Plugin Details', 'wp-easysoft'),
		'wp_easysoft_wp_plugin_meta_box_callback',
		'wp_plugin',
		'normal',
		'high'
	);
}
add_action('add_meta_boxes', 'wp_easysoft_add_wp_plugin_meta_boxes');

function wp_easysoft_wp_plugin_meta_box_callback($post)
{
	wp_nonce_field('wp_easysoft_save_wp_plugin_meta', 'wp_easysoft_wp_plugin_meta_nonce');

	$has_pro          = get_post_meta($post->ID, 'has_pro', true);
	$active_installs  = get_post_meta($post->ID, 'active_installs', true);
	$free_version_url = get_post_meta($post->ID, 'free_version_url', true);
	$pro_version_url  = get_post_meta($post->ID, 'pro_version_url', true);
	?>
	<div style="display: grid; gap: 12px;">
		<p>
			<label for="has_pro" style="display: block; margin-bottom: 4px;">
				<input type="checkbox" id="has_pro" name="has_pro" value="1" <?php checked($has_pro, '1'); ?> />
				<?php _e('Has PRO version available', 'wp-easysoft'); ?>
			</label>
		</p>

		<p>
			<label for="active_installs" style="display: block; margin-bottom: 4px;">
				<?php _e('Active Installs', 'wp-easysoft'); ?>
			</label>
			<input type="text" id="active_installs" name="active_installs" value="<?php echo esc_attr($active_installs); ?>"
				class="widefat" placeholder="e.g., 90+ Active Installs" />
		</p>

		<p>
			<label for="free_version_url" style="display: block; margin-bottom: 4px;">
				<?php _e('Free Version URL', 'wp-easysoft'); ?>
			</label>
			<input type="url" id="free_version_url" name="free_version_url" value="<?php echo esc_attr($free_version_url); ?>"
				class="widefat" placeholder="https://wordpress.org/plugins/..." />
		</p>

		<p>
			<label for="pro_version_url" style="display: block; margin-bottom: 4px;">
				<?php _e('PRO Version URL', 'wp-easysoft'); ?>
			</label>
			<input type="url" id="pro_version_url" name="pro_version_url" value="<?php echo esc_attr($pro_version_url); ?>"
				class="widefat" placeholder="https://your-site.com/pro-version" />
		</p>
	</div>
	<?php
}

function wp_easysoft_save_wp_plugin_meta($post_id)
{
	if (
		!isset($_POST['wp_easysoft_wp_plugin_meta_nonce']) ||
		!wp_verify_nonce($_POST['wp_easysoft_wp_plugin_meta_nonce'], 'wp_easysoft_save_wp_plugin_meta')
	) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	$fields = ['has_pro', 'active_installs', 'free_version_url', 'pro_version_url'];

	foreach ($fields as $field) {
		if (isset($_POST[$field])) {
			update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
		} else {
			delete_post_meta($post_id, $field);
		}
	}
}
add_action('save_post_wp_plugin', 'wp_easysoft_save_wp_plugin_meta');

/**
 * Add Featured Post Meta Box
 */
function tw_add_featured_meta_box()
{
	add_meta_box(
		'tw_featured_post',
		__('Featured Post', '_tw'),
		'tw_featured_post_callback',
		'post',
		'side',
		'high'
	);
}
add_action('add_meta_boxes', 'tw_add_featured_meta_box');

/**
 * Meta Box HTML
 */
function tw_featured_post_callback($post)
{
	wp_nonce_field('tw_save_featured_post', 'tw_featured_post_nonce');
	$value = get_post_meta($post->ID, '_tw_featured_post', true);
	?>
	<p>
		<label>
			<input type="checkbox" name="tw_featured_post" value="1" <?php checked($value, '1'); ?> />
			<?php _e('Mark this post as Featured', '_tw'); ?>
		</label>
	</p>
	<?php
}

/**
 * Save Featured Status
 */
function tw_save_featured_post($post_id)
{

	// Nonce check
	if (
		!isset($_POST['tw_featured_post_nonce']) ||
		!wp_verify_nonce($_POST['tw_featured_post_nonce'], 'tw_save_featured_post')
	) {
		return;
	}

	// Autosave check
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;

	// Permission check
	if (!current_user_can('edit_post', $post_id))
		return;

	// Save / Delete
	if (isset($_POST['tw_featured_post'])) {
		update_post_meta($post_id, '_tw_featured_post', '1');
	} else {
		delete_post_meta($post_id, '_tw_featured_post');
	}
}
add_action('save_post', 'tw_save_featured_post');

/**
 * Display reading time with icon
 */
function wp_display_reading_time($post_id = null)
{
	if (!$post_id) {
		$post_id = get_the_ID();
	}

	$post_content = get_post_field('post_content', $post_id);
	$reading_time = wp_estimate_reading_time($post_content);

	return '<span>' . $reading_time . ' min read</span>';
}

/**
 * Calculate reading time from content
 */
function wp_estimate_reading_time($content)
{
	$word_count   = str_word_count(strip_tags($content));
	$reading_time = ceil($word_count / 200); // Assuming 200 words per minute
	return $reading_time ?: 1;
}

// Optional: Add reading time to post meta in archive views
function wp_add_reading_time_to_archive($post_id = null)
{
	if (!$post_id) {
		global $post;
		$post_id = $post->ID;
	}

	$post_content = get_post_field('post_content', $post_id);
	$reading_time = wp_estimate_reading_time($post_content);

	echo '<span class="reading-time">';
	echo '<i class="fas fa-clock mr-1"></i>';
	echo $reading_time . ' ' . __('min read', 'wp-easysoft');
	echo '</span>';
}


/**
 * Get user role display name with proper error handling
 */
function wp_get_user_role_display_name($user_id = null)
{
	if (!$user_id) {
		$user_id = get_the_author_meta('ID');
	}

	// Check if user exists
	$user = get_userdata($user_id);
	if (!$user) {
		return __('Author', 'wp-easysoft');
	}

	// Check if user has roles
	if (empty($user->roles)) {
		return __('Author', 'wp-easysoft');
	}

	// Get WordPress roles object
	$wp_roles = wp_roles();

	// Get the first role and convert to display name
	$first_role = reset($user->roles);

	// Check if role exists in role names
	if (isset($wp_roles->role_names[$first_role])) {
		return $wp_roles->role_names[$first_role];
	}

	// Fallback to role slug with capitalization
	if ($first_role) {
		return ucfirst(str_replace('_', ' ', $first_role));
	}

	return __('Author', 'wp-easysoft');
}

/**
 * Display author info with role (safe version)
 */
function wp_display_author_info($size = 40, $show_role = true)
{
	$user_id = get_the_author_meta('ID');

	// Check if user exists before trying to get avatar
	$user = get_userdata($user_id);
	if (!$user) {
		return '';
	}

	$avatar       = get_avatar($user_id, $size, '', '', array('class' => 'w-' . $size . ' h-' . $size . ' rounded-full'));
	$display_name = $user->display_name ?: $user->user_login;

	$output  = '<div class="flex items-center gap-2">';
	$output .= $avatar;
	$output .= '<div class="text-left">';
	$output .= '<div class="font-medium text-gray-800">' . esc_html($display_name) . '</div>';

	if ($show_role) {
		$role_display  = wp_get_user_role_display_name($user_id);
		$output       .= '<div class="text-sm text-gray-600">' . esc_html($role_display) . '</div>';
	}

	$output .= '</div>';
	$output .= '</div>';

	return $output;
}

/**
 * Add social media fields to user profile
 */

function wp_easysoft_add_user_social_fields($methods)
{
	// Remove existing methods if needed
	unset($methods['aim']);
	unset($methods['yim']);
	unset($methods['jabber']);

	// Add our social fields
	$methods['twitter']   = __('Twitter URL', 'wp-easysoft');
	$methods['linkedin']  = __('LinkedIn URL', 'wp-easysoft');
	$methods['github']    = __('GitHub URL', 'wp-easysoft');
	$methods['facebook']  = __('Facebook URL', 'wp-easysoft');
	$methods['instagram'] = __('Instagram URL', 'wp-easysoft');

	return $methods;
}

// Add custom fields to user profile (alternative method)
add_action('show_user_profile', 'wp_easysoft_show_extra_profile_fields');
add_action('edit_user_profile', 'wp_easysoft_show_extra_profile_fields');

function wp_easysoft_show_extra_profile_fields($user)
{
	?>
	<h3><?php _e('Social Media Profiles', 'wp-easysoft'); ?></h3>
	<table class="form-table">
		<tr>
			<th><label for="twitter"><?php _e('Twitter URL', 'wp-easysoft'); ?></label></th>
			<td>
				<input type="url" name="twitter" id="twitter"
					value="<?php echo esc_url(get_the_author_meta('twitter', $user->ID)); ?>" class="regular-text" />
				<p class="description"><?php _e('Enter your full Twitter profile URL', 'wp-easysoft'); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="linkedin"><?php _e('LinkedIn URL', 'wp-easysoft'); ?></label></th>
			<td>
				<input type="url" name="linkedin" id="linkedin"
					value="<?php echo esc_url(get_the_author_meta('linkedin', $user->ID)); ?>" class="regular-text" />
				<p class="description"><?php _e('Enter your full LinkedIn profile URL', 'wp-easysoft'); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="github"><?php _e('GitHub URL', 'wp-easysoft'); ?></label></th>
			<td>
				<input type="url" name="github" id="github"
					value="<?php echo esc_url(get_the_author_meta('github', $user->ID)); ?>" class="regular-text" />
				<p class="description"><?php _e('Enter your full GitHub profile URL', 'wp-easysoft'); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="facebook"><?php _e('Facebook URL', 'wp-easysoft'); ?></label></th>
			<td>
				<input type="url" name="facebook" id="facebook"
					value="<?php echo esc_url(get_the_author_meta('facebook', $user->ID)); ?>" class="regular-text" />
				<p class="description"><?php _e('Enter your full Facebook profile URL', 'wp-easysoft'); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="instagram"><?php _e('Instagram URL', 'wp-easysoft'); ?></label></th>
			<td>
				<input type="url" name="instagram" id="instagram"
					value="<?php echo esc_url(get_the_author_meta('instagram', $user->ID)); ?>" class="regular-text" />
				<p class="description"><?php _e('Enter your full Instagram profile URL', 'wp-easysoft'); ?></p>
			</td>
		</tr>
	</table>
	<?php
}

// Save the custom fields
add_action('personal_options_update', 'wp_easysoft_save_extra_profile_fields');
add_action('edit_user_profile_update', 'wp_easysoft_save_extra_profile_fields');

function wp_easysoft_save_extra_profile_fields($user_id)
{
	if (!current_user_can('edit_user', $user_id)) {
		return false;
	}

	// Sanitize and save social URLs
	$social_fields = array('twitter', 'linkedin', 'github', 'facebook', 'instagram');

	foreach ($social_fields as $field) {
		if (isset($_POST[$field])) {
			$url = esc_url_raw($_POST[$field]);
			update_user_meta($user_id, $field, $url);
		}
	}
}

// Add validation for social URLs
add_action('user_profile_update_errors', 'wp_easysoft_validate_social_urls', 10, 3);

function wp_easysoft_validate_social_urls($errors, $update, $user)
{
	$social_fields = array('twitter', 'linkedin', 'github', 'facebook', 'instagram');

	foreach ($social_fields as $field) {
		if (isset($_POST[$field]) && !empty($_POST[$field])) {
			$url = $_POST[$field];

			// Check if it's a valid URL
			if (!filter_var($url, FILTER_VALIDATE_URL)) {
				$errors->add($field . '_error', sprintf(__('Please enter a valid URL for %s', 'wp-easysoft'), $field));
			}

			// Check for specific domain patterns (optional)
			switch ($field) {
				case 'twitter':
					if (strpos($url, 'twitter.com') === false && strpos($url, 'x.com') === false) {
						$errors->add('twitter_error', __('Twitter URL should contain twitter.com or x.com', 'wp-easysoft'));
					}
					break;
				case 'linkedin':
					if (strpos($url, 'linkedin.com') === false) {
						$errors->add('linkedin_error', __('LinkedIn URL should contain linkedin.com', 'wp-easysoft'));
					}
					break;
				case 'github':
					if (strpos($url, 'github.com') === false) {
						$errors->add('github_error', __('GitHub URL should contain github.com', 'wp-easysoft'));
					}
					break;
				case 'facebook':
					if (strpos($url, 'facebook.com') === false) {
						$errors->add('facebook_error', __('Facebook URL should contain facebook.com', 'wp-easysoft'));
					}
					break;
				case 'instagram':
					if (strpos($url, 'instagram.com') === false) {
						$errors->add('instagram_error', __('Instagram URL should contain instagram.com', 'wp-easysoft'));
					}
					break;
			}
		}
	}

	return $errors;
}

