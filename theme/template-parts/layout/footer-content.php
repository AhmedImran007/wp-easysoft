<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP_EasySoft
 */
?>

<footer id="colophon"
	class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-gray-300 relative overflow-hidden">
	<!-- Background decoration -->
	<div class="absolute inset-0 bg-grid-white/[0.02] bg-[size:60px_60px]"></div>
	<div class="absolute top-0 left-0 w-72 h-72 bg-indigo-500/10 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl">
	</div>
	<div
		class="absolute bottom-0 right-0 w-96 h-96 bg-purple-500/10 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl">
	</div>

	<div class="relative max-w-7xl mx-auto px-4 py-16">
		<!-- Main footer content -->
		<div class="grid lg:grid-cols-4 md:grid-cols-2 gap-8 mb-12">

			<!-- About / Brand Widget Area -->
			<div class="space-y-6" id="footer-about">
				<?php if (is_active_sidebar('footer-about')): ?>
					<?php dynamic_sidebar('footer-about'); ?>
				<?php else: ?>
					<!-- Default About Section -->
					<div class="flex items-center space-x-3">
						<div
							class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
							<span class="text-white font-bold text-lg">WE</span>
						</div>
						<h3
							class="text-white font-bold text-2xl bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">
							<?php bloginfo('name'); ?>
						</h3>
					</div>
					<p class="text-gray-400 text-sm leading-relaxed">
						<?php bloginfo('description'); ?>
					</p>

					<!-- Social Icons with Font Awesome -->
					<div class="footer-social-icons">
						<a href="#" class="social-icon">
							<i class="fab fa-twitter"></i>
						</a>
						<a href="#" class="social-icon">
							<i class="fab fa-facebook-f"></i>
						</a>
						<a href="#" class="social-icon">
							<i class="fab fa-linkedin-in"></i>
						</a>
						<a href="#" class="social-icon">
							<i class="fab fa-instagram"></i>
						</a>
					</div>

					<!-- Email Section -->
					<a href="mailto:support@wpeasysoft.com" class="footer-email">
						<i class="fas fa-envelope"></i>
						<span>support@wpeasysoft.com</span>
					</a>
				<?php endif; ?>
			</div>

			<!-- Products Widget Area -->
			<div class="space-y-6" id="footer-products">
				<?php if (is_active_sidebar('footer-products')): ?>
					<?php dynamic_sidebar('footer-products'); ?>
				<?php else: ?>
					<h3 class="footer-widget-title text-white font-bold text-lg relative inline-block">
						Products
						<span
							class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-indigo-500 to-purple-600 transform translate-y-1"></span>
					</h3>
					<?php
					// Display menu if exists, otherwise show default
					if (has_nav_menu('footer-products')) {
						wp_nav_menu(array(
							'theme_location' => 'footer-products',
							'menu_class'     => 'footer-menu-list',
							'container'      => false,
							'depth'          => 1,
							'fallback_cb'    => false,
							'link_before'    => '<span class="footer-menu-bullet bg-indigo-500"></span>',
							'item_wrap'      => '<ul class="footer-menu-list">%3$s</ul>',
						));
					} else {
						echo '<ul class="footer-menu-list">';
						echo '<li><a href="#" class="footer-menu-link"><span class="footer-menu-bullet bg-indigo-500"></span>Easy Map</a></li>';
						echo '<li><a href="#" class="footer-menu-link"><span class="footer-menu-bullet bg-indigo-500"></span>VideoJS Player</a></li>';
						echo '<li><a href="#" class="footer-menu-link"><span class="footer-menu-bullet bg-indigo-500"></span>ActiveCampaign Sync</a></li>';
						echo '<li><a href="#" class="footer-menu-link"><span class="footer-menu-bullet bg-indigo-500"></span>Elementor Addons</a></li>';
						echo '</ul>';
					}
					?>
				<?php endif; ?>
			</div>

			<!-- Support Widget Area -->
			<div class="space-y-6" id="footer-support">
				<?php if (is_active_sidebar('footer-support')): ?>
					<?php dynamic_sidebar('footer-support'); ?>
				<?php else: ?>
					<h3 class="footer-widget-title text-white font-bold text-lg relative inline-block">
						Support
						<span
							class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-indigo-500 to-purple-600 transform translate-y-1"></span>
					</h3>
					<?php
					// Display menu if exists, otherwise show default
					if (has_nav_menu('footer-support')) {
						wp_nav_menu(array(
							'theme_location' => 'footer-support',
							'menu_class'     => 'footer-menu-list',
							'container'      => false,
							'depth'          => 1,
							'fallback_cb'    => false,
							'link_before'    => '<span class="footer-menu-bullet bg-green-500"></span>',
							'item_wrap'      => '<ul class="footer-menu-list">%3$s</ul>',
						));
					} else {
						echo '<ul class="footer-menu-list">';
						echo '<li><a href="#" class="footer-menu-link"><span class="footer-menu-bullet bg-green-500"></span>Documentation</a></li>';
						echo '<li><a href="#" class="footer-menu-link"><span class="footer-menu-bullet bg-green-500"></span>FAQ</a></li>';
						echo '<li><a href="#" class="footer-menu-link"><span class="footer-menu-bullet bg-green-500"></span>Support Ticket</a></li>';
						echo '</ul>';
					}
					?>
				<?php endif; ?>
			</div>

			<!-- Legal Widget Area -->
			<div class="space-y-6" id="footer-legal">
				<?php if (is_active_sidebar('footer-legal')): ?>
					<?php dynamic_sidebar('footer-legal'); ?>
				<?php else: ?>
					<h3 class="footer-widget-title text-white font-bold text-lg relative inline-block">
						Legal
						<span
							class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-indigo-500 to-purple-600 transform translate-y-1"></span>
					</h3>
					<?php
					// Display menu if exists, otherwise show default
					if (has_nav_menu('footer-legal')) {
						wp_nav_menu(array(
							'theme_location' => 'footer-legal',
							'menu_class'     => 'footer-menu-list',
							'container'      => false,
							'depth'          => 1,
							'fallback_cb'    => false,
							'link_before'    => '<span class="footer-menu-bullet bg-purple-500"></span>',
							'item_wrap'      => '<ul class="footer-menu-list">%3$s</ul>',
						));
					} else {
						echo '<ul class="footer-menu-list">';
						echo '<li><a href="#" class="footer-menu-link"><span class="footer-menu-bullet bg-purple-500"></span>Terms & Conditions</a></li>';
						echo '<li><a href="#" class="footer-menu-link"><span class="footer-menu-bullet bg-purple-500"></span>Refund Policy</a></li>';
						echo '<li><a href="#" class="footer-menu-link"><span class="footer-menu-bullet bg-purple-500"></span>Privacy Policy</a></li>';
						echo '</ul>';
					}
					?>
				<?php endif; ?>
			</div>
		</div>

		<!-- Copyright Widget Area -->
		<div class="border-t border-gray-700/50 pt-6">
			<?php if (is_active_sidebar('footer-copyright')): ?>
				<?php dynamic_sidebar('footer-copyright'); ?>
			<?php else: ?>
				<div class="text-center">
					<div class="text-gray-500 text-sm">
						&copy; <?php echo date('Y'); ?> 	<?php bloginfo('name'); ?>. All rights reserved.
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</footer>
