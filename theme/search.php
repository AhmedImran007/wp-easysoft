<?php
/**
 * Search Results Template
 *
 * @package _tw
 */

get_header();
?>

<!-- Search Hero Section -->
<section class="gradient-bg text-white py-16">
	<div class="max-w-7xl mx-auto px-4">
		<div class="text-center">
			<h1 class="text-4xl md:text-5xl font-bold mb-6">
				Search Results
			</h1>
			<p class="text-xl opacity-90 max-w-3xl mx-auto">
				Showing results for: <span class="font-semibold">"<?php echo esc_html(get_search_query()); ?>"</span>
			</p>
		</div>
	</div>
</section>

<!-- Search + Filter Section -->
<section class="py-8 bg-white">
	<div class="max-w-7xl mx-auto px-4">
		<div class="flex flex-col md:flex-row justify-between items-center gap-4">

			<!-- Search Form -->
			<div class="w-full md:w-1/4">
				<form method="get" action="<?php echo esc_url(home_url('/')); ?>">
					<div class="relative">
						<input type="text" name="s" placeholder="Search articles..."
							value="<?php echo esc_attr(get_search_query()); ?>"
							class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:border-primary" />
						<i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
					</div>
				</form>
			</div>

			<!-- Categories -->
			<div class="flex flex-wrap gap-2">
				<a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"
					class="category-pill bg-primary text-white px-4 py-2 rounded-full text-sm font-medium">
					All
				</a>

				<?php
				$categories = get_categories();
				foreach ($categories as $cat):
					?>
					<a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
						class="category-pill px-4 py-2 rounded-full text-sm font-medium bg-gray-200 text-gray-700 hover:bg-primary-light">
						<?php echo esc_html($cat->name); ?>
					</a>
				<?php endforeach; ?>
			</div>

		</div>
	</div>
</section>

<!-- Search Results Content -->
<section class="py-12">
	<div class="max-w-7xl mx-auto px-4">
		<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

			<!-- MAIN CONTENT -->
			<div class="lg:col-span-2">

				<!-- Results Count -->
				<div class="mb-8">
					<?php
					global $wp_query;
					$total_results = $wp_query->found_posts;
					?>
					<p class="text-gray-600">
						Found <span class="font-semibold text-primary"><?php echo number_format_i18n($total_results); ?></span>
						<?php echo _n('result', 'results', $total_results, 'wp-easysoft'); ?> for
						"<span class="font-semibold"><?php echo esc_html(get_search_query()); ?></span>"
					</p>
				</div>

				<!-- Search Results -->
				<?php if (have_posts()): ?>
					<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
						<?php
						// Start the Loop
						while (have_posts()):
							the_post();
							get_template_part('template-parts/content/content', 'excerpt');
						endwhile;
						?>
					</div>

					<!-- Pagination -->
					<div class="mt-12">
						<?php
						global $wp_query;
						if ($wp_query->max_num_pages > 1):
							$paged = get_query_var('paged') ? get_query_var('paged') : 1;
							?>

							<div class="flex items-center justify-center space-x-3">
								<!-- Previous Button -->
								<?php if ($paged > 1): ?>
									<a href="<?php echo esc_url(get_pagenum_link($paged - 1)); ?>"
										class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm">
										<i class="fas fa-chevron-left mr-2 text-xs"></i>
										<?php _e('Previous', 'wp-easysoft'); ?>
									</a>
								<?php else: ?>
									<span
										class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed">
										<i class="fas fa-chevron-left mr-2 text-xs"></i>
										<?php _e('Previous', 'wp-easysoft'); ?>
									</span>
								<?php endif; ?>

								<!-- Page Numbers -->
								<div class="flex items-center space-x-2">
									<?php
									$pagination_args = array(
										'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
										'format'    => '?paged=%#%',
										'total'     => $wp_query->max_num_pages,
										'current'   => max(1, get_query_var('paged')),
										'show_all'  => false,
										'end_size'  => 1,
										'mid_size'  => 2,
										'prev_next' => false,
										'type'      => 'array',
										'add_args'  => array('s' => get_search_query()),
									);

									$paginate_links = paginate_links($pagination_args);

									if ($paginate_links) {
										foreach ($paginate_links as $page_link) {
											echo '<span class="px-3 py-1 text-sm rounded-md">' . $page_link . '</span>';
										}
									}
									?>
								</div>

								<!-- Next Button -->
								<?php if ($paged < $wp_query->max_num_pages): ?>
									<a href="<?php echo esc_url(get_pagenum_link($paged + 1)); ?>"
										class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm">
										<?php _e('Next', 'wp-easysoft'); ?>
										<i class="fas fa-chevron-right ml-2 text-xs"></i>
									</a>
								<?php else: ?>
									<span
										class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed">
										<?php _e('Next', 'wp-easysoft'); ?>
										<i class="fas fa-chevron-right ml-2 text-xs"></i>
									</span>
								<?php endif; ?>
							</div>

						<?php endif; ?>
					</div>

				<?php else: ?>

					<!-- No Results -->
					<?php get_template_part('template-parts/content/content', 'none'); ?>

				<?php endif; ?>

			</div>

			<!-- SIDEBAR -->
			<aside class="lg:col-span-1">
				<?php get_sidebar(); ?>
			</aside>

		</div>
	</div>
</section>

<?php get_footer(); ?>

