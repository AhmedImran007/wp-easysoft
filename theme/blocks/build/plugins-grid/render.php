<?php
$title         = $attributes['title'] ?? 'Our WordPress Plugins';
$description   = $attributes['description'] ?? 'Enhance your site with lightweight, high-performance tools.';
$numberOfPosts = $attributes['numberOfPosts'] ?? 6;
$orderBy       = $attributes['orderBy'] ?? 'date';
$order         = $attributes['order'] ?? 'desc';

// Query plugins
$plugin_args = array(
  'post_type'      => 'wp_plugin',
  'posts_per_page' => $numberOfPosts,
  'orderby'        => $orderBy,
  'order'          => $order,
  'post_status'    => 'publish',
);

$plugins_query = new WP_Query($plugin_args);
?>

<!-- All Plugins Overview -->
<section id="plugins" class="py-16 bg-white max-w-full not-prose" aria-labelledby="plugins-grid-title">
  <div class="container mx-auto px-4">
    <!-- Header -->
    <h2 id="plugins-grid-title" class="text-3xl md:text-4xl font-bold text-center mb-4">
      <?php echo wp_kses_post($title); ?>
    </h2>
    <p class="text-xl text-gray-600 text-center mb-12 max-w-2xl mx-auto">
      <?php echo esc_html($description); ?>
    </p>

    <!-- Plugins Grid -->
    <?php if ($plugins_query->have_posts()): ?>
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php while ($plugins_query->have_posts()):
          $plugins_query->the_post();
          $plugin_id        = get_the_ID();
          $has_pro          = get_post_meta($plugin_id, 'has_pro', true);
          $active_installs  = get_post_meta($plugin_id, 'active_installs', true);
          $free_version_url = get_post_meta($plugin_id, 'free_version_url', true);
          $pro_version_url  = get_post_meta($plugin_id, 'pro_version_url', true);
          ?>
          <!-- Plugin Card -->
          <div
            class="plugin-card bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 transition-transform hover:scale-105">
            <div class="p-6">
              <div class="flex justify-between items-start mb-4">
                <!-- Plugin Icon -->
                <div class="bg-primary-light p-3 rounded-lg">
                  <?php if (has_post_thumbnail()): ?>
                    <?php the_post_thumbnail('thumbnail', array(
                      'class' => 'w-8 h-8 object-contain',
                      'alt'   => get_the_title()
                    )); ?>
                  <?php else: ?>
                    <i class="fas fa-plug text-primary text-2xl" aria-hidden="true"></i>
                  <?php endif; ?>
                </div>

                <!-- PRO Badge -->
                <?php if ($has_pro): ?>
                  <span class="accent-light-bg accent-color px-2 py-1 rounded-full text-xs font-medium">
                    <?php esc_html_e('PRO Available', 'wp-easysoft'); ?>
                  </span>
                <?php endif; ?>
              </div>

              <!-- Plugin Title -->
              <h3 class="text-xl font-bold mb-2">
                <?php the_title(); ?>
              </h3>

              <!-- Active Installs -->
              <div class="flex items-center text-sm text-gray-500 mb-3">
                <i class="fas fa-download mr-1" aria-hidden="true"></i>
                <span>
                  <?php
                  echo esc_html($active_installs ?: '0');
                  esc_html_e(' Active Installs', 'wp-easysoft');
                  ?>
                </span>
              </div>

              <!-- Plugin Description -->
              <div class="text-gray-600 mb-6">
                <?php the_excerpt(); ?>
              </div>

              <!-- Action Links -->
              <div class="flex gap-3">
                <a href="<?php the_permalink(); ?>"
                  class="text-primary font-medium hover:text-primary-light transition focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 rounded"
                  aria-label="<?php printf(esc_attr__('Learn more about %s', 'wp-easysoft'), get_the_title()); ?>">
                  <?php esc_html_e('Learn More', 'wp-easysoft'); ?>
                </a>
                <?php if ($free_version_url): ?>
                  <a href="<?php echo esc_url($free_version_url); ?>"
                    class="text-gray-600 font-medium hover:text-gray-700 transition focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 rounded"
                    aria-label="<?php printf(esc_attr__('Get free version of %s', 'wp-easysoft'), get_the_title()); ?>">
                    <?php esc_html_e('Free Version', 'wp-easysoft'); ?>
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <div class="text-center py-8">
        <p class="text-gray-500">
          <?php esc_html_e('No plugins found. Please add some plugins in the admin area.', 'wp-easysoft'); ?>
        </p>
      </div>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>
  </div>
</section>
