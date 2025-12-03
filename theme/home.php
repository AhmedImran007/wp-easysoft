<?php
/**
 * Home (Blog) Template
 *
 * This file is used for:
 * - Default blog posts page (if no index-specific template)
 * - Static "Posts Page" assigned in WP settings
 *
 * @package _tw
 */

get_header();
?>

<!-- Hero Section -->
<section class="gradient-bg text-white py-16">
  <div class="max-w-7xl mx-auto px-4 text-center">
    <h1 class="text-4xl md:text-5xl font-bold mb-4">
      <?php
      // If user set a static page as "Posts Page"
      $blog_page_id = get_option('page_for_posts');
      echo $blog_page_id ? get_the_title($blog_page_id) : 'Latest Articles';
      ?>
    </h1>

    <p class="text-lg opacity-90 max-w-2xl mx-auto">
      Insights, tutorials, and resources for developers and creators.
    </p>
  </div>
</section>

<!-- Search + Category Filters -->
<section class="py-8 bg-white">
  <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-4">

    <!-- Search -->
    <div class="w-full md:w-1/4">
      <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
        <div class="relative">
          <input type="text" name="s" placeholder="Search posts..."
            class="w-full px-4 py-2 pl-10 border rounded-lg border-gray-300 focus:outline-none focus:border-primary" />
          <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>
      </form>
    </div>

    <!-- Categories -->
    <div class="flex flex-wrap gap-2">
      <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"
        class="px-4 py-2 text-sm rounded-full bg-primary text-white font-medium">
        All
      </a>

      <?php foreach (get_categories() as $cat): ?>
        <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
          class="px-4 py-2 text-sm rounded-full bg-gray-200 text-gray-800 hover:bg-primary-light">
          <?php echo esc_html($cat->name); ?>
        </a>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- Blog Content -->
<section class="py-12">
  <div class="max-w-7xl mx-auto px-4">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

      <!-- MAIN BLOG POSTS -->
      <div class="lg:col-span-2">

        <?php
        // FEATURED Post (using custom meta field)
        $featured_query = new WP_Query([
          'post_type'      => 'post',
          'meta_key'       => '_tw_featured_post',
          'meta_value'     => '1',
          'posts_per_page' => 1,
        ]);

        if ($featured_query->have_posts()):
          while ($featured_query->have_posts()):
            $featured_query->the_post();
            get_template_part('template-parts/content/content', 'featured');
          endwhile;
          wp_reset_postdata();
        endif;

        // Get featured post IDs to exclude from main loop
        $featured_ids = get_posts([
          'post_type'      => 'post',
          'meta_key'       => '_tw_featured_post',
          'meta_value'     => '1',
          'posts_per_page' => -1,
          'fields'         => 'ids',
        ]);

        // Modify the main query to exclude featured posts
        if (!empty($featured_ids)) {
          global $wp_query;
          $wp_query->set('post__not_in', $featured_ids);
          $wp_query->get_posts();
        }
        ?>

        <!-- Normal Posts -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

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

