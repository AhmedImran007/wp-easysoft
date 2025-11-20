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

	<div class="relative max-w-7xl mx-auto px-4 py-20">
		<!-- Main footer content -->
		<div class="grid lg:grid-cols-4 md:grid-cols-2 gap-12 mb-16">

			<!-- About / Brand Section -->
			<div class="space-y-6">
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
				<div class="flex space-x-4">
					<a href="#"
						class="w-10 h-10 bg-white/5 hover:bg-indigo-500/20 rounded-lg flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg">
						<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
							<path
								d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
						</svg>
					</a>
					<a href="#"
						class="w-10 h-10 bg-white/5 hover:bg-indigo-500/20 rounded-lg flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg">
						<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
							<path
								d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
						</svg>
					</a>
					<a href="#"
						class="w-10 h-10 bg-white/5 hover:bg-indigo-500/20 rounded-lg flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg">
						<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
							<path
								d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
						</svg>
					</a>
				</div>
			</div>

			<!-- Products -->
			<div class="space-y-6">
				<h3 class="text-white font-bold text-xl relative inline-block">
					Products
					<span
						class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-indigo-500 to-purple-600 transform translate-y-1"></span>
				</h3>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-products',
						'menu_class'     => 'space-y-3',
						'container'      => false,
						'fallback_cb'    => 'wp_easysoft_footer_products_fallback',
						'link_before'    => '<div class="flex items-center space-x-2 group"><span class="w-1.5 h-1.5 bg-indigo-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span><span class="text-gray-400 hover:text-white transition-all duration-300 group-hover:translate-x-1">',
						'link_after'     => '</span></div>',
					)
				);
				?>
			</div>

			<!-- Support -->
			<div class="space-y-6">
				<h3 class="text-white font-bold text-xl relative inline-block">
					Support
					<span
						class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-indigo-500 to-purple-600 transform translate-y-1"></span>
				</h3>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-support',
						'menu_class'     => 'space-y-3',
						'container'      => false,
						'fallback_cb'    => 'wp_easysoft_footer_support_fallback',
						'link_before'    => '<div class="flex items-center space-x-2 group"><span class="w-1.5 h-1.5 bg-green-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span><span class="text-gray-400 hover:text-white transition-all duration-300 group-hover:translate-x-1">',
						'link_after'     => '</span></div>',
					)
				);
				?>
			</div>

			<!-- Legal & Contact -->
			<div class="space-y-6">
				<h3 class="text-white font-bold text-xl relative inline-block">
					Legal
					<span
						class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-indigo-500 to-purple-600 transform translate-y-1"></span>
				</h3>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-legal',
						'menu_class'     => 'space-y-3',
						'container'      => false,
						'fallback_cb'    => 'wp_easysoft_footer_legal_fallback',
						'link_before'    => '<div class="flex items-center space-x-2 group"><span class="w-1.5 h-1.5 bg-purple-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span><span class="text-gray-400 hover:text-white transition-all duration-300 group-hover:translate-x-1">',
						'link_after'     => '</span></div>',
					)
				);
				?>

				<!-- Contact Info -->
				<div class="pt-4 space-y-3">
					<div class="flex items-center space-x-3 text-gray-400 hover:text-white transition-colors">
						<svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
						</svg>
						<span class="text-sm">support@wpeasysoft.com</span>
					</div>
				</div>
			</div>
		</div>

		<!-- Newsletter Section -->
		<div class="border-t border-gray-700/50 pt-12 mb-8">
			<div class="max-w-2xl mx-auto text-center space-y-6">
				<div class="space-y-3">
					<h3 class="text-white font-bold text-2xl">Stay Updated</h3>
					<p class="text-gray-400 text-sm leading-relaxed">
						Get the latest updates, plugin releases, and exclusive tips directly to your inbox.
					</p>
				</div>
				<form class="mt-6 flex gap-3 justify-center max-w-md mx-auto" action="#" method="post">
					<div class="flex-1 relative">
						<input type="email" name="email" placeholder="Enter your email" required
							class="w-full rounded-xl bg-white/5 px-4 py-3 text-white placeholder-gray-400 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300 text-sm backdrop-blur-sm" />
						<div
							class="absolute inset-0 rounded-xl bg-gradient-to-r from-indigo-500/20 to-purple-500/20 -z-10 blur-sm opacity-0 transition-opacity duration-300 focus-within:opacity-100">
						</div>
					</div>
					<button type="submit"
						class="flex-none rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 hover:from-indigo-600 hover:to-purple-700 transform">
						Subscribe
					</button>
				</form>
			</div>
		</div>

		<!-- Bottom Bar -->
		<div class="border-t border-gray-700/50 pt-8">
			<div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
				<div class="text-gray-500 text-sm">
					&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
				</div>
				<div class="flex items-center space-x-6 text-sm text-gray-500">
					<span>Made with ❤️ for WordPress</span>
					<div class="flex items-center space-x-2">
						<span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
						<span>All systems operational</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>

<?php
// Enhanced fallback functions for footer menus
function wp_easysoft_footer_about_fallback()
{
	echo '<ul class="space-y-3">';
	echo '<li><a href="#" class="flex items-center space-x-2 group"><span class="w-1.5 h-1.5 bg-indigo-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span><span class="text-gray-400 hover:text-white transition-all duration-300 group-hover:translate-x-1">About</span></a></li>';
	echo '<li><a href="#" class="flex items-center space-x-2 group"><span class="w-1.5 h-1.5 bg-indigo-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span><span class="text-gray-400 hover:text-white transition-all duration-300 group-hover:translate-x-1">Contact</span></a></li>';
	echo '<li><a href="#" class="flex items-center space-x-2 group"><span class="w-1.5 h-1.5 bg-indigo-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span><span class="text-gray-400 hover:text-white transition-all duration-300 group-hover:translate-x-1">Blog</span></a></li>';
	echo '</ul>';
}

function wp_easysoft_footer_products_fallback()
{
	echo '<ul class="space-y-3">';
	echo '<li><a href="#" class="flex items-center space-x-2 group"><span class="w-1.5 h-1.5 bg-indigo-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span><span class="text-gray-400 hover:text-white transition-all duration-300 group-hover:translate-x-1">Easy Map</span></a></li>';
	echo '<li><a href="#" class="flex items-center space-x-2 group"><span class="w-1.5 h-1.5 bg-indigo-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span><span class="text-gray-400 hover:text-white transition-all duration-300 group-hover:translate-x-1">VideoJS Player</span></a></li>';
	echo '<li><a href="#" class="flex items-center space-x-2 group"><span class="w-1.5 h-1.5 bg-indigo-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span><span class="text-gray-400 hover:text-white transition-all duration-300 group-hover:translate-x-1">ActiveCampaign Sync</span></a></li>';
	echo '<li><a href="#" class="flex items-center space-x-2 group"><span class="w-1.5 h-1.5 bg-indigo-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span><span class="text-gray-400 hover:text-white transition-all duration-300 group-hover:translate-x-1">Elementor Addons</span></a></li>';
	echo '<li><a href="#" class="flex items-center space-x-2 group"><span class="w-1.5 h-1.5 bg-indigo-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span><span class="text-gray-400 hover:text-white transition-all duration-300 group-hover:translate-x-1">Product Video Gallery</span></a></li>';
	echo '</ul>';
}

function wp_easysoft_footer_support_fallback()
{
	echo '<ul class="space-y-3">';
	echo '<li><a href="#" class="flex items-center space-x-2 group"><span class="w-1.5 h-1.5 bg-green-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span><span class="text-gray-400 hover:text-white transition-all duration-300 group-hover:translate-x-1">Documentation</span></a></li>';
	echo '<li><a href="#" class="flex items-center space-x-2 group"><span class="w-1.5 h-1.5 bg-green-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span><span class="text-gray-400 hover:text-white transition-all duration-300 group-hover:translate-x-1">FAQ</span></a></li>';
	echo '<li><a href="#" class="flex items-center space-x-2 group"><span class="w-1.5 h-1.5 bg-green-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span><span class="text-gray-400 hover:text-white transition-all duration-300 group-hover:translate-x-1">Support Ticket</span></a></li>';
	echo '</ul>';
}

function wp_easysoft_footer_legal_fallback()
{
	echo '<ul class="space-y-3">';
	echo '<li><a href="#" class="flex items-center space-x-2 group"><span class="w-1.5 h-1.5 bg-purple-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span><span class="text-gray-400 hover:text-white transition-all duration-300 group-hover:translate-x-1">Terms & Conditions</span></a></li>';
	echo '<li><a href="#" class="flex items-center space-x-2 group"><span class="w-1.5 h-1.5 bg-purple-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span><span class="text-gray-400 hover:text-white transition-all duration-300 group-hover:translate-x-1">Refund Policy</span></a></li>';
	echo '<li><a href="#" class="flex items-center space-x-2 group"><span class="w-1.5 h-1.5 bg-purple-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span><span class="text-gray-400 hover:text-white transition-all duration-300 group-hover:translate-x-1">Privacy</span></a></li>';
	echo '</ul>';
}
?>

