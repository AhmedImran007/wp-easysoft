<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP_EasySoft
 */

?>

<header id="masthead" class="bg-white shadow-sm sticky top-0 z-50">
	<div class="container mx-auto px-4 py-4">
		<div class="flex justify-between items-center">
			<div class="flex items-center">
				<?php
				if (is_front_page()):
					?>
					<h1 class="text-2xl font-bold text-primary"><?php bloginfo('name'); ?></h1>
					<?php
				else:
					?>
					<p class="text-2xl font-bold text-primary"><a href="<?php echo esc_url(home_url('/')); ?>"
							rel="home"><?php bloginfo('name'); ?></a></p>
					<?php
				endif;

				$wp_easysoft_description = get_bloginfo('description', 'display');
				if ($wp_easysoft_description || is_customize_preview()):
					?>
					<p class="sr-only">
						<?php echo $wp_easysoft_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</p>
				<?php endif; ?>
			</div>

			<nav id="site-navigation" class="hidden md:flex flex-1 justify-center items-center space-x-6"
				aria-label="<?php esc_attr_e('Main Navigation', 'wp-easysoft'); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'container'      => false,
						'items_wrap'     => '<div class="flex space-x-6 list-none">%3$s</div>',
						'fallback_cb'    => false,
						'link_before'    => '<span class="text-gray-700 hover:text-primary transition">',
						'link_after'     => '</span>',
					)
				);
				?>
			</nav>

			<div class="hidden md:flex items-center">
				<a href="#" class="btn-primary text-white px-4 py-2 rounded-lg font-medium">Buy Easy Map PRO</a>
			</div>

			<button class="md:hidden text-gray-700" id="mobile-menu-button" aria-controls="mobile-menu" aria-expanded="false">
				<i class="fas fa-bars text-xl"></i>
				<span class="sr-only"><?php esc_html_e('Primary Menu', 'wp-easysoft'); ?></span>
			</button>
		</div>
	</div>

	<!-- Mobile Menu -->
	<div id="mobile-menu" class="hidden md:hidden bg-white border-t"
		aria-label="<?php esc_attr_e('Mobile Navigation', 'wp-easysoft'); ?>">
		<div class="container mx-auto px-4 py-4 space-y-3">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'mobile-primary-menu',
					'container'      => false,
					'items_wrap'     => '<div class="space-y-3">%3$s</div>',
					'fallback_cb'    => false,
					'link_before'    => '<span class="block text-gray-700 hover:text-primary transition">',
					'link_after'     => '</span>',
				)
			);
			?>
			<a href="#" class="btn-primary text-white px-4 py-2 rounded-lg font-medium inline-block text-center">Buy Easy Map
				PRO</a>
		</div>
	</div>
</header><!-- #masthead -->
