<?php
/**
 * Archive Template for WP Plugin Custom Post Type
 *
 * @package WP_EasySoft
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
  exit;
}

get_header();

// Get archive page meta (if using ACF for archive page settings).
$archive_title       = esc_html__('Our Premium WordPress Plugins', 'wp-easysoft');
$archive_description = esc_html__('Discover our collection of powerful WordPress plugins designed to enhance your website functionality.', 'wp-easysoft');

// Pagination.
$paged          = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
$posts_per_page = 12;

// Query plugins.
$args = array(
  'post_type'      => 'wp_plugin',
  'posts_per_page' => $posts_per_page,
  'paged'          => $paged,
  'orderby'        => 'meta_value_num',
  'meta_key'       => 'rating',
  'order'          => 'DESC',
  'post_status'    => 'publish',
);

$plugins_query = new WP_Query($args);

// Get total plugin count.
$plugin_counts = wp_count_posts('wp_plugin');
$total_plugins = isset($plugin_counts->publish) ? absint($plugin_counts->publish) : 0;
?>

<!-- Archive Hero Section -->
<section class="gradient-bg text-white py-16">
  <div class="max-w-7xl mx-auto px-4">
    <div class="text-center">
      <h1 class="text-4xl md:text-5xl font-bold mb-6">
        <?php echo esc_html($archive_title); ?>
      </h1>

      <p class="text-xl mb-8 opacity-90 max-w-3xl mx-auto">
        <?php echo esc_html($archive_description); ?>
      </p>

      <div class="flex flex-wrap justify-center gap-6">
        <div class="flex items-center gap-2">

          <div>
            <div class="text-2xl font-bold"><i class="fas fa-plug text-2xl opacity-80" aria-hidden="true"></i>
              <?php echo esc_html(number_format_i18n($total_plugins)); ?></div>
            <div class="text-sm opacity-80"><?php esc_html_e('Premium Plugins', 'wp-easysoft'); ?></div>
          </div>
        </div>

        <div class="flex items-center gap-2">
          <div>
            <div class="text-2xl font-bold">
              <i class="fas fa-star text-2xl text-yellow-400" aria-hidden="true"></i>
              5.0
            </div>
            <div class="text-sm opacity-80"><?php esc_html_e('Average Rating', 'wp-easysoft'); ?></div>
          </div>
        </div>

        <div class="flex items-center gap-2">
          <div>
            <div class="text-2xl font-bold">
              <i class="fas fa-download text-2xl opacity-80" aria-hidden="true"></i>
              10K+
            </div>
            <div class="text-sm opacity-80"><?php esc_html_e('Active Installs', 'wp-easysoft'); ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Plugins Grid -->
<section class="py-16">
  <div class="max-w-7xl mx-auto px-4">
    <?php if ($plugins_query->have_posts()): ?>
      <!-- Grid Layout -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-8">
        <?php
        while ($plugins_query->have_posts()):
          $plugins_query->the_post();

          // Get plugin meta using the same helper function as single template.
          $meta_fields = function_exists('wp_easysoft_get_plugin_meta') ? wp_easysoft_get_plugin_meta(get_the_ID()) : array();

          // Basic meta data with fallbacks.
          $has_pro           = isset($meta_fields['has_pro']) ? $meta_fields['has_pro'] : false;
          $rating            = isset($meta_fields['rating']) && $meta_fields['rating'] ? floatval($meta_fields['rating']) : 4.5;
          $active_installs   = isset($meta_fields['active_installs']) ? $meta_fields['active_installs'] : '';
          $tagline           = isset($meta_fields['tagline']) && $meta_fields['tagline'] ? $meta_fields['tagline'] : get_the_title() . ' - ' . __('WordPress Plugin', 'wp-easysoft');
          $free_version_url  = isset($meta_fields['free_version_url']) ? esc_url($meta_fields['free_version_url']) : '';
          $pro_version_url   = isset($meta_fields['pro_version_url']) ? esc_url($meta_fields['pro_version_url']) : '';
          $short_description = isset($meta_fields['short_description']) && $meta_fields['short_description'] ? $meta_fields['short_description'] : (get_the_excerpt() ?: __('A powerful WordPress plugin with advanced features.', 'wp-easysoft'));
          ?>
          <article
            class="plugin-card bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200 group"
            id="plugin-<?php echo esc_attr(get_the_ID()); ?>">
            <!-- Plugin Header -->
            <div class="p-6 pb-4">
              <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-3">
                  <?php if (has_post_thumbnail()): ?>
                    <?php
                    the_post_thumbnail(
                      'thumbnail',
                      array(
                        'class' => 'w-12 h-12 rounded-lg object-cover group-hover:scale-105 transition-transform duration-300',
                        'alt'   => esc_attr(get_the_title()),
                      )
                    );
                    ?>
                  <?php else: ?>
                    <div
                      class="w-12 h-12 bg-primary-light rounded-lg flex items-center justify-center group-hover:bg-primary transition-colors duration-300">
                      <i class="fas fa-plug text-primary group-hover:text-white transition-colors duration-300 text-xl"
                        aria-hidden="true"></i>
                    </div>
                  <?php endif; ?>
                  <div>
                    <h2 class="font-bold text-lg text-gray-800 group-hover:text-primary transition-colors duration-300">
                      <a href="<?php the_permalink(); ?>"
                        class="hover:underline focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 rounded">
                        <?php the_title(); ?>
                      </a>
                    </h2>
                    <?php if ($has_pro): ?>
                      <span class="text-xs bg-primary/10 text-primary px-2 py-1 rounded-full font-medium">
                        <?php esc_html_e('PRO Available', 'wp-easysoft'); ?>
                      </span>
                    <?php endif; ?>
                  </div>
                </div>

                <!-- Rating -->
                <div class="text-right">
                  <div class="flex items-center gap-1 mb-1">
                    <?php
                    $stars      = floatval($rating);
                    $full_stars = floor($stars);
                    $half_star  = $stars - $full_stars >= 0.5;

                    for ($i = 0; $i < 5; $i++):
                      if ($i < $full_stars):
                        ?>
                        <i class="fas fa-star text-yellow-400 text-sm" aria-hidden="true"></i>
                      <?php elseif ($half_star && $i === $full_stars): ?>
                        <i class="fas fa-star-half-alt text-yellow-400 text-sm" aria-hidden="true"></i>
                      <?php else: ?>
                        <i class="far fa-star text-gray-300 text-sm" aria-hidden="true"></i>
                      <?php endif; ?>
                    <?php endfor; ?>
                  </div>
                  <span
                    class="text-sm font-semibold text-gray-700"><?php echo esc_html(number_format($rating, 1)); ?></span>
                </div>
              </div>

              <!-- Tagline/Short Description -->
              <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                <?php echo esc_html($tagline); ?>
              </p>
            </div>

            <!-- Plugin Stats -->
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
              <div class="flex items-center justify-between text-sm">
                <?php if (!empty($active_installs)): ?>
                  <div class="flex items-center gap-2">
                    <i class="fas fa-download text-gray-400" aria-hidden="true"></i>
                    <span class="text-gray-600"><?php echo esc_html($active_installs); ?>
                      <?php esc_html_e('Installs', 'wp-easysoft'); ?></span>
                  </div>
                <?php else: ?>
                  <div class="flex items-center gap-2">
                    <i class="fas fa-rocket text-gray-400" aria-hidden="true"></i>
                    <span class="text-gray-600"><?php esc_html_e('Popular', 'wp-easysoft'); ?></span>
                  </div>
                <?php endif; ?>

                <div class="flex items-center gap-2">
                  <?php if (!empty($free_version_url)): ?>
                    <a href="<?php echo esc_url($free_version_url); ?>" target="_blank" rel="noopener noreferrer"
                      class="text-primary hover:text-primary-dark font-medium text-sm transition-colors focus:outline-none focus:underline">
                      <?php esc_html_e('Free', 'wp-easysoft'); ?>
                    </a>
                  <?php endif; ?>

                  <?php if ($has_pro && !empty($pro_version_url)): ?>
                    <span class="text-gray-300" aria-hidden="true">|</span>
                    <a href="<?php echo esc_url($pro_version_url); ?>" target="_blank" rel="noopener noreferrer"
                      class="text-primary hover:text-primary-dark font-medium text-sm transition-colors focus:outline-none focus:underline">
                      <?php esc_html_e('PRO', 'wp-easysoft'); ?>
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            </div>

            <!-- Plugin Footer -->
            <div class="px-6 py-3 border-t border-gray-100">
              <a href="<?php the_permalink(); ?>"
                class="block text-center text-primary hover:text-primary-dark font-medium text-sm transition-colors group/link focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 rounded">
                <?php esc_html_e('View Details & Features', 'wp-easysoft'); ?>
                <i class="fas fa-arrow-right ml-1 group-hover/link:translate-x-1 transition-transform"
                  aria-hidden="true"></i>
              </a>
            </div>
          </article>
        <?php endwhile; ?>
      </div>

      <!-- Pagination -->
      <?php if ($plugins_query->max_num_pages > 1): ?>
        <nav class="mt-16 flex justify-center" aria-label="<?php esc_attr_e('Plugin pagination', 'wp-easysoft'); ?>">
          <div class="flex items-center space-x-2">
            <?php
            echo wp_kses_post(
              paginate_links(
                array(
                  'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                  'format'    => '?paged=%#%',
                  'current'   => max(1, $paged),
                  'total'     => $plugins_query->max_num_pages,
                  'prev_text' => '<i class="fas fa-chevron-left" aria-hidden="true"></i> ' . esc_html__('Previous', 'wp-easysoft'),
                  'next_text' => esc_html__('Next', 'wp-easysoft') . ' <i class="fas fa-chevron-right" aria-hidden="true"></i>',
                  'mid_size'  => 1,
                  'type'      => 'plain',
                )
              )
            );
            ?>
          </div>
        </nav>
      <?php endif; ?>

    <?php else: ?>
      <!-- No Plugins Found -->
      <div class="text-center py-16">
        <div class="mb-6">
          <i class="fas fa-plug text-gray-300 text-6xl" aria-hidden="true"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-700 mb-3"><?php esc_html_e('No Plugins Available', 'wp-easysoft'); ?>
        </h3>
        <p class="text-gray-600 max-w-md mx-auto mb-6">
          <?php esc_html_e("We're currently working on new plugins. Check back soon for amazing WordPress solutions!", 'wp-easysoft'); ?>
        </p>
      </div>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>
  </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4">
    <div class="text-center mb-12">
      <h2 class="text-3xl font-bold text-gray-800 mb-4"><?php esc_html_e('Why Choose Our Plugins?', 'wp-easysoft'); ?>
      </h2>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        <?php esc_html_e('High-quality, reliable WordPress plugins built with performance and user experience in mind.', 'wp-easysoft'); ?>
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      <div class="text-center">
        <div class="w-16 h-16 bg-primary-light rounded-full flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-shield-alt text-primary text-2xl" aria-hidden="true"></i>
        </div>
        <h3 class="font-bold text-gray-800 mb-2"><?php esc_html_e('Secure & Stable', 'wp-easysoft'); ?></h3>
        <p class="text-gray-600 text-sm">
          <?php esc_html_e('Regularly updated and tested for security', 'wp-easysoft'); ?>
        </p>
      </div>

      <div class="text-center">
        <div class="w-16 h-16 bg-primary-light rounded-full flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-headset text-primary text-2xl" aria-hidden="true"></i>
        </div>
        <h3 class="font-bold text-gray-800 mb-2"><?php esc_html_e('Premium Support', 'wp-easysoft'); ?></h3>
        <p class="text-gray-600 text-sm"><?php esc_html_e('Dedicated support for all our plugins', 'wp-easysoft'); ?>
        </p>
      </div>

      <div class="text-center">
        <div class="w-16 h-16 bg-primary-light rounded-full flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-mobile-alt text-primary text-2xl" aria-hidden="true"></i>
        </div>
        <h3 class="font-bold text-gray-800 mb-2"><?php esc_html_e('Mobile Responsive', 'wp-easysoft'); ?></h3>
        <p class="text-gray-600 text-sm"><?php esc_html_e('Works perfectly on all devices', 'wp-easysoft'); ?></p>
      </div>

      <div class="text-center">
        <div class="w-16 h-16 bg-primary-light rounded-full flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-code text-primary text-2xl" aria-hidden="true"></i>
        </div>
        <h3 class="font-bold text-gray-800 mb-2"><?php esc_html_e('Developer Friendly', 'wp-easysoft'); ?></h3>
        <p class="text-gray-600 text-sm"><?php esc_html_e('Clean code with filters and hooks', 'wp-easysoft'); ?></p>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="py-16 gradient-bg text-white">
  <div class="max-w-4xl mx-auto px-4 text-center">
    <h2 class="text-3xl font-bold mb-4"><?php esc_html_e('Need Help Choosing the Right Plugin?', 'wp-easysoft'); ?>
    </h2>
    <p class="text-xl mb-8 opacity-90 max-w-2xl mx-auto">
      <?php esc_html_e('Our plugin experts can help you select the perfect solution for your WordPress website.', 'wp-easysoft'); ?>
    </p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a href="<?php echo esc_url(site_url('/contact')); ?>"
        class="bg-white text-primary px-8 py-3 rounded-lg font-medium text-lg inline-block hover:bg-gray-100 transition focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-primary">
        <?php esc_html_e('Contact Our Team', 'wp-easysoft'); ?> <i class="fas fa-arrow-right ml-2"
          aria-hidden="true"></i>
      </a>
      <a href="<?php echo esc_url(site_url('/documentation')); ?>"
        class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-medium text-lg inline-block hover:bg-white hover:text-primary transition focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2">
        <?php esc_html_e('View Documentation', 'wp-easysoft'); ?>
      </a>
    </div>
  </div>
</section>

<style>
  /* Plugin Card Styles */
  .plugin-card {
    position: relative;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .plugin-card:hover {
    transform: translateY(-8px);
  }

  .plugin-card::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
    border-radius: 0 0 8px 8px;
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  .plugin-card:hover::after {
    opacity: 1;
  }

  .line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  /* Pagination Styles */
  .page-numbers {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    padding: 0 15px;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    color: #4b5563;
    font-weight: 500;
    transition: all 0.2s ease;
    margin: 0 2px;
  }

  .page-numbers:hover {
    background-color: #f3f4f6;
    border-color: var(--primary-color);
    color: var(--primary-color);
  }

  .page-numbers.current {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
  }

  .page-numbers.dots {
    border: none;
    min-width: auto;
  }

  .page-numbers.prev,
  .page-numbers.next {
    padding: 0 20px;
  }
</style>

<script>
  // Simple hover animation for plugin cards
  document.addEventListener('DOMContentLoaded', function () {
    const pluginCards = document.querySelectorAll('.plugin-card');

    pluginCards.forEach(card => {
      card.addEventListener('mouseenter', function () {
        this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.1)';
      });

      card.addEventListener('mouseleave', function () {
        this.style.boxShadow = '';
      });
    });
  });
</script>

<?php
get_footer();
