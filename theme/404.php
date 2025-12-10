<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WP_EasySoft
 */

get_header();
?>

<section id="primary" class="min-h-screen flex items-center justify-center bg-gray-100">
	<main id="main" class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full">

		<div class="text-center">
			<header class="page-header mb-6">
				<h1 class="page-title text-4xl font-extrabold text-gray-800 mb-4">
					<?php esc_html_e('Page Not Found', 'wp-easysoft'); ?></h1>
			</header><!-- .page-header -->

			<div <?php wp_easysoft_content_class('page-content'); ?>>
				<p class="text-lg text-gray-600 mb-6">
					<?php esc_html_e('Sorry, the page you are looking for might have been removed, renamed, or never existed.', 'wp-easysoft'); ?>
				</p>
				<div>
					<p class="text-sm text-gray-500 mb-4">
						<?php esc_html_e('Try searching for what you need or use the button below to return to the homepage.', 'wp-easysoft'); ?>
					</p>
					<?php get_search_form(); ?>
				</div>
			</div><!-- .page-content -->

			<div class="mt-6">
				<a href="<?php echo home_url(); ?>"
					class="inline-block bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition duration-200">
					<?php esc_html_e('Back to Home', 'wp-easysoft'); ?>
				</a>
			</div>
		</div>

	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
