<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP_EasySoft
 */

?>

<header id="masthead" class="bg-white shadow-sm sticky top-0 z-50" x-data="{ mobileOpen: false }">
	<div class="container max-w-7xl mx-auto px-4 py-4">
		<div class="flex justify-between items-center">

			<!-- Logo -->
			<div class="flex items-center">
				<?php if (is_front_page()): ?>
					<h1 class="text-2xl font-bold text-primary"><?php bloginfo('name'); ?></h1>
				<?php else: ?>
					<p class="text-2xl font-bold text-primary">
						<a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
					</p>
				<?php endif; ?>
			</div>

			<!-- Desktop Navigation -->
			<nav class="hidden md:flex flex-1 justify-center items-center"
				aria-label="<?php esc_attr_e('Main Navigation', 'wp-easysoft'); ?>">

				<?php
				wp_nav_menu([
					'theme_location' => 'menu-1',
					'menu_class'     => 'flex space-x-1',
					'container'      => false,
					'fallback_cb'    => false,
					'walker'         => new WPES_Dropdown_Walker(),
				]);
				?>
			</nav>

			<!-- Buy Button -->
			<div class="hidden md:flex items-center">
				<a href="#" class="btn-primary text-white px-4 py-2 rounded-lg font-medium">Buy Easy Map PRO</a>
			</div>

			<!-- Mobile Toggle -->
			<button class="md:hidden text-gray-700" @click="mobileOpen = !mobileOpen">
				<i class="fas fa-bars text-xl"></i>
			</button>
		</div>
	</div>

	<!-- Mobile Menu -->
	<div x-show="mobileOpen" x-transition class="md:hidden bg-white border-t">
		<div class="container max-w-7xl mx-auto px-4 py-4 space-y-3">

			<?php
			wp_nav_menu([
				'theme_location' => 'menu-1',
				'menu_id'        => 'mobile-menu',
				'container'      => false,
				'menu_class'     => 'space-y-3',
				'walker'         => new Walker_Nav_Menu(), // simple mobile walker
			]);
			?>

			<a href="#" class="btn-primary text-white px-4 py-2 rounded-lg font-medium block text-center">
				Buy Easy Map PRO
			</a>
		</div>
	</div>
</header>
