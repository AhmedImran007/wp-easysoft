<?php
/**
 * Archive Template (Custom Blog Design)
 *
 * @package _tw
 */

get_header();
?>

<!-- Blog Hero Section -->
<section class="gradient-bg text-white py-16">
	<div class="max-w-7xl mx-auto px-4">
		<div class="text-center">
			<?php if (is_category()): ?>
				<h2 class="text-4xl md:text-5xl font-bold mb-6">
					Category: <?php single_cat_title(); ?>
				</h2>
				<?php if (category_description()): ?>
					<p class="text-xl opacity-90 max-w-3xl mx-auto">
						<?php echo category_description(); ?>
					</p>
				<?php endif; ?>
			<?php elseif (is_tag()): ?>
				<h2 class="text-4xl md:text-5xl font-bold mb-6">
					Tag: <?php single_tag_title(); ?>
				</h2>
			<?php elseif (is_author()): ?>
				<h2 class="text-4xl md:text-5xl font-bold mb-6">
					Author: <?php echo get_the_author(); ?>
				</h2>
			<?php elseif (is_date()): ?>
				<h2 class="text-4xl md:text-5xl font-bold mb-6">
					Archive: <?php
					if (is_year()) {
						echo get_the_date('Y');
					} elseif (is_month()) {
						echo get_the_date('F Y');
					} elseif (is_day()) {
						echo get_the_date('F j, Y');
					}
					?>
				</h2>
			<?php else: ?>
				<h2 class="text-4xl md:text-5xl font-bold mb-6">Blog</h2>
				<p class="text-xl opacity-90 max-w-3xl mx-auto">
					Tips, tutorials, and insights about WordPress development, plugins & more.
				</p>
			<?php endif; ?>
		</div>
	</div>
</section>

<!-- Search + Filter Section -->
<section class="py-8 bg-white">
	<div class="max-w-7xl mx-auto px-4">
		<div class="flex flex-col md:flex-row justify-between items-center gap-4">

			<!-- Search -->
			<div class="w-full md:w-1/4">
				<form method="get" action="<?php echo esc_url(home_url('/')); ?>">
					<div class="relative">
						<input type="text" name="s" placeholder="Search articles..." value="<?php echo get_search_query(); ?>"
							class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:border-primary" />
						<i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
					</div>
				</form>
			</div>

			<!-- Categories -->
			<div class="flex flex-wrap gap-2">
				<a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"
					class="category-pill bg-primary text-white px-4 py-2 rounded-full text-sm font-medium <?php echo (!is_category() && !is_tag() && !is_author() && !is_date()) ? '!bg-primary !text-white' : 'bg-gray-200 text-gray-700'; ?>">
					All
				</a>

				<?php
				$categories = get_categories();
				foreach ($categories as $cat):
					$is_current_cat = is_category($cat->term_id);
					?>
					<a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
						class="category-pill px-4 py-2 rounded-full text-sm font-medium hover:bg-primary-light <?php echo $is_current_cat ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700'; ?>">
						<?php echo esc_html($cat->name); ?>
					</a>
				<?php endforeach; ?>
			</div>

		</div>
	</div>
</section>

<!-- Blog Content -->
<section class="py-12">
	<div class="max-w-7xl mx-auto px-4">
		<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

			<!-- MAIN CONTENT -->
			<div class="lg:col-span-2">

				<?php
				// Get current category ID if on category page
				$current_cat_id = is_category() ? get_queried_object_id() : null;

				// Get featured post IDs to exclude
				$featured_ids = get_posts([
					'post_type'      => 'post',
					'meta_key'       => '_tw_featured_post',
					'meta_value'     => '1',
					'posts_per_page' => -1,
					'fields'         => 'ids',
					'cat'            => $current_cat_id, // Respect current category
				]);

				// Modify the main query to exclude featured posts
				if (!empty($featured_ids)) {
					global $wp_query;
					$wp_query->set('post__not_in', $featured_ids);
					$wp_query->get_posts();
				}

				// FEATURED Post (respects current category)
				$featured_args = [
					'post_type'      => 'post',
					'meta_key'       => '_tw_featured_post',
					'meta_value'     => '1',
					'posts_per_page' => 1,
					'cat'            => $current_cat_id, // Respect current category
				];

				$featured_query = new WP_Query($featured_args);

				if ($featured_query->have_posts()):
					while ($featured_query->have_posts()):
						$featured_query->the_post();
						get_template_part('template-parts/content/content', 'featured');
					endwhile;
					wp_reset_postdata();
				endif;
				?>

				<!-- NORMAL POSTS -->
				<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

					<?php
					if (have_posts()):
						while (have_posts()):
							the_post();
							get_template_part('template-parts/content/content', 'excerpt');
						endwhile;
					else:
						get_template_part('template-parts/content/content', 'none');
					endif;
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
									'add_args'  => false,
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

			</div>

			<!-- SIDEBAR -->
			<aside class="lg:col-span-1">
				<?php get_sidebar(); ?>
			</aside>

		</div>
	</div>
</section>

<?php get_footer(); ?>

