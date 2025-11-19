<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP_EasySoft
 */

?>

<footer id="colophon" class="bg-gray-900 text-gray-300 py-12">
	<div class="container mx-auto px-4">
		<div class="grid md:grid-cols-5 gap-8 mb-8">
			<?php if (is_active_sidebar('footer-widget-1')): ?>
				<div role="complementary" aria-label="<?php esc_attr_e('Footer Widget 1', 'wp-easysoft'); ?>">
					<?php dynamic_sidebar('footer-widget-1'); ?>
				</div>
			<?php else: ?>
				<div>
					<h3 class="text-white font-bold text-lg mb-4"><?php bloginfo('name'); ?></h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer-about',
							'menu_class'     => 'space-y-2',
							'container'      => false,
							'fallback_cb'    => 'wp_easysoft_footer_about_fallback',
							'link_before'    => '<span class="hover:text-white transition">',
							'link_after'     => '</span>',
						)
					);
					?>
				</div>
			<?php endif; ?>

			<?php if (is_active_sidebar('footer-widget-2')): ?>
				<div role="complementary" aria-label="<?php esc_attr_e('Footer Widget 2', 'wp-easysoft'); ?>">
					<?php dynamic_sidebar('footer-widget-2'); ?>
				</div>
			<?php else: ?>
				<div>
					<h3 class="text-white font-bold text-lg mb-4"><?php esc_html_e('Products', 'wp-easysoft'); ?></h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer-products',
							'menu_class'     => 'space-y-2',
							'container'      => false,
							'fallback_cb'    => 'wp_easysoft_footer_products_fallback',
							'link_before'    => '<span class="hover:text-white transition">',
							'link_after'     => '</span>',
						)
					);
					?>
				</div>
			<?php endif; ?>

			<?php if (is_active_sidebar('footer-widget-3')): ?>
				<div role="complementary" aria-label="<?php esc_attr_e('Footer Widget 3', 'wp-easysoft'); ?>">
					<?php dynamic_sidebar('footer-widget-3'); ?>
				</div>
			<?php else: ?>
				<div>
					<h3 class="text-white font-bold text-lg mb-4"><?php esc_html_e('Support', 'wp-easysoft'); ?></h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer-support',
							'menu_class'     => 'space-y-2',
							'container'      => false,
							'fallback_cb'    => 'wp_easysoft_footer_support_fallback',
							'link_before'    => '<span class="hover:text-white transition">',
							'link_after'     => '</span>',
						)
					);
					?>
				</div>
			<?php endif; ?>

			<?php if (is_active_sidebar('footer-widget-4')): ?>
				<div role="complementary" aria-label="<?php esc_attr_e('Footer Widget 4', 'wp-easysoft'); ?>">
					<?php dynamic_sidebar('footer-widget-4'); ?>
				</div>
			<?php else: ?>
				<div>
					<h3 class="text-white font-bold text-lg mb-4"><?php esc_html_e('Legal', 'wp-easysoft'); ?></h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer-legal',
							'menu_class'     => 'space-y-2',
							'container'      => false,
							'fallback_cb'    => 'wp_easysoft_footer_legal_fallback',
							'link_before'    => '<span class="hover:text-white transition">',
							'link_after'     => '</span>',
						)
					);
					?>
				</div>
			<?php endif; ?>

			<?php if (is_active_sidebar('footer-widget-5')): ?>
				<div role="complementary" aria-label="<?php esc_attr_e('Footer Widget 5', 'wp-easysoft'); ?>">
					<?php dynamic_sidebar('footer-widget-5'); ?>
				</div>
			<?php else: ?>
				<div>
					<h3 class="text-white font-bold text-lg mb-4"><?php esc_html_e('Newsletter', 'wp-easysoft'); ?></h3>
					<p class="mb-4"><?php esc_html_e('Get updates and plugin releases', 'wp-easysoft'); ?></p>
					<div class="mt-6 flex max-w-md gap-x-4">
						<label for="email-address" class="sr-only">Email address</label>
						<input id="email-address" type="email" name="email" required placeholder="Enter your email"
							autocomplete="email"
							class="min-w-0 flex-auto rounded-md bg-white/5 px-3.5 py-2 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
						<button type="submit"
							class="flex-none rounded-md bg-indigo-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Subscribe</button>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<div class="border-t border-gray-800 pt-8 text-center">
			<p>
				<?php
				printf(
					esc_html__('&copy; %s %s. All rights reserved.', 'wp-easysoft'),
					date('Y'),
					get_bloginfo('name')
				);
				?>
			</p>
		</div>
	</div>
</footer><!-- #colophon -->

<?php
// Fallback functions for footer menus
function wp_easysoft_footer_about_fallback()
{
	echo '<ul class="space-y-2">';
	echo '<li><a href="#" class="hover:text-white transition">' . esc_html__('About', 'wp-easysoft') . '</a></li>';
	echo '<li><a href="#" class="hover:text-white transition">' . esc_html__('Contact', 'wp-easysoft') . '</a></li>';
	echo '<li><a href="#" class="hover:text-white transition">' . esc_html__('Blog', 'wp-easysoft') . '</a></li>';
	echo '</ul>';
}

function wp_easysoft_footer_products_fallback()
{
	echo '<ul class="space-y-2">';
	echo '<li><a href="#" class="hover:text-white transition">' . esc_html__('Easy Map', 'wp-easysoft') . '</a></li>';
	echo '<li><a href="#" class="hover:text-white transition">' . esc_html__('VideoJS Player', 'wp-easysoft') . '</a></li>';
	echo '<li><a href="#" class="hover:text-white transition">' . esc_html__('ActiveCampaign Sync', 'wp-easysoft') . '</a></li>';
	echo '<li><a href="#" class="hover:text-white transition">' . esc_html__('Elementor Addons', 'wp-easysoft') . '</a></li>';
	echo '<li><a href="#" class="hover:text-white transition">' . esc_html__('Product Video Gallery', 'wp-easysoft') . '</a></li>';
	echo '</ul>';
}

function wp_easysoft_footer_support_fallback()
{
	echo '<ul class="space-y-2">';
	echo '<li><a href="#" class="hover:text-white transition">' . esc_html__('Documentation', 'wp-easysoft') . '</a></li>';
	echo '<li><a href="#" class="hover:text-white transition">' . esc_html__('FAQ', 'wp-easysoft') . '</a></li>';
	echo '<li><a href="#" class="hover:text-white transition">' . esc_html__('Support Ticket', 'wp-easysoft') . '</a></li>';
	echo '</ul>';
}

function wp_easysoft_footer_legal_fallback()
{
	echo '<ul class="space-y-2">';
	echo '<li><a href="#" class="hover:text-white transition">' . esc_html__('Terms & Conditions', 'wp-easysoft') . '</a></li>';
	echo '<li><a href="#" class="hover:text-white transition">' . esc_html__('Refund Policy', 'wp-easysoft') . '</a></li>';
	echo '<li><a href="#" class="hover:text-white transition">' . esc_html__('Privacy', 'wp-easysoft') . '</a></li>';
	echo '</ul>';
}
?>

