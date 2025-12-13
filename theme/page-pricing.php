<?php
/**
 * Template Name: Pricing Page
 *
 * @package WP_EasySoft
 */

get_header();

// Get all published WP Plugin posts
$args = array(
  'post_type'      => 'wp_plugin',
  'posts_per_page' => -1,
  'post_status'    => 'publish',
  'orderby'        => 'menu_order',
  'order'          => 'ASC',
);

$plugins = get_posts($args);

// Get pricing page meta data
$pricing_meta = wp_easysoft_get_pricing_page_meta(get_the_ID());
?>

<section id="primary" class="bg-gray-50">
  <main id="main" class="container mx-auto">
    <!-- Hero Section -->
    <section class="gradient-bg text-white py-20 px-4">
      <div class="max-w-7xl mx-auto">
        <div class="text-center">
          <h2 class="text-4xl md:text-5xl font-bold mb-6"><?php echo esc_html($pricing_meta['hero_title']); ?></h2>
          <p class="text-xl mb-8 opacity-90 max-w-3xl mx-auto">
            <?php echo esc_html($pricing_meta['hero_description']); ?>
          </p>
          <div class="flex flex-wrap justify-center gap-6">
            <?php for ($i = 1; $i <= 3; $i++):
              if (!empty($pricing_meta['hero_feature_' . $i])): ?>
                <div class="flex items-center gap-2">
                  <i class="fas fa-check-circle text-green-400 text-xl"></i>
                  <span><?php echo esc_html($pricing_meta['hero_feature_' . $i]); ?></span>
                </div>
              <?php endif;
            endfor; ?>
          </div>
        </div>
      </div>
    </section>

    <!-- Plugin Tabs & Pricing Cards (keep existing dynamic code here) -->
    <?php if ($plugins): ?>
      <section class="py-8 bg-white border-b">
        <div class="max-w-7xl mx-auto px-4">
          <div class="flex flex-wrap justify-center gap-3" id="plugin-tabs-container">
            <?php
            $first_plugin = true;
            foreach ($plugins as $index => $plugin):
              $plugin_slug = sanitize_title($plugin->post_title);
              $meta_fields = wp_easysoft_get_plugin_meta($plugin->ID);
              $icon        = '';

              // Determine icon based on plugin name or meta field
              $plugin_name = strtolower($plugin->post_title);
              if (strpos($plugin_name, 'map') !== false) {
                $icon = 'fa-map-marked-alt';
              } elseif (strpos($plugin_name, 'video') !== false) {
                $icon = 'fa-video';
              } elseif (strpos($plugin_name, 'sync') !== false) {
                $icon = 'fa-sync';
              } elseif (strpos($plugin_name, 'elementor') !== false) {
                $icon = 'fab fa-elementor';
              } elseif (strpos($plugin_name, 'gallery') !== false) {
                $icon = 'fa-shopping-cart';
              } else {
                $icon = 'fa-solid fa-plug';
              }
              ?>
              <button
                class="plugin-tab <?php echo $first_plugin ? 'active' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'; ?> px-6 py-3 rounded-lg font-medium"
                data-plugin="<?php echo esc_attr($plugin_slug); ?>">
                <i class="<?php echo esc_attr($icon); ?> mr-2"></i><?php echo esc_html($plugin->post_title); ?>
              </button>
              <?php
              $first_plugin = false;
            endforeach;
            ?>
          </div>
        </div>
      </section>

      <!-- Individual Plugin Pricing -->
      <section class="py-16 px-4" id="pricing">
        <div class="max-w-4xl mx-auto">
          <?php
          // Track if we have any PRO plugins
          $has_pro_plugins = false;

          foreach ($plugins as $index => $plugin):
            $plugin_slug = sanitize_title($plugin->post_title);
            $meta_fields = wp_easysoft_get_plugin_meta($plugin->ID);

            // Extract pricing data
            $has_pro           = $meta_fields['has_pro'];
            $free_version_url  = $meta_fields['free_version_url'];
            $pro_version_url   = $meta_fields['pro_version_url'];
            $free_features     = $meta_fields['free_features'];
            $pro_features      = $meta_fields['pro_features'];
            $short_description = $meta_fields['short_description'];

            // Free plan details
            $free_plan_title  = $meta_fields['free_plan_title'] ?: 'Free Version';
            $free_plan_price  = $meta_fields['free_plan_price'] ?: 'FREE';
            $free_plan_period = $meta_fields['free_plan_period'] ?: '/forever';
            $free_plan_desc   = $meta_fields['free_plan_desc'] ?: 'Perfect for basic needs';

            // Pricing footer text
            $pricing_footer_text = $meta_fields['pricing_footer_text'] ?: '30-day money-back guarantee • Instant download • 1 year of updates & support';
            ?>
            <div id="<?php echo esc_attr($plugin_slug); ?>-pricing"
              class="plugin-pricing <?php echo $index === 0 ? '' : 'hidden'; ?>">
              <div class="text-center mb-12">
                <div class="flex items-center justify-center gap-3 mb-4">
                  <?php
                  // Get plugin hero image or thumbnail
                  $plugin_hero_image = $meta_fields['plugin_hero_image'];
                  if (!empty($plugin_hero_image)): ?>
                    <img src="<?php echo esc_url($plugin_hero_image); ?>" alt="<?php echo esc_attr($plugin->post_title); ?>"
                      class="w-16 h-16 rounded-lg object-cover">
                  <?php elseif (has_post_thumbnail($plugin->ID)): ?>
                    <?php echo get_the_post_thumbnail($plugin->ID, 'thumbnail', [
                      'class' => 'w-16 h-16 rounded-lg object-cover'
                    ]); ?>
                  <?php else: ?>
                    <div class="w-16 h-16 bg-primary-light rounded-lg flex items-center justify-center">
                      <i class="fa-solid fa-plug text-primary text-2xl"></i>
                    </div>
                  <?php endif; ?>
                  <h3 class="text-3xl font-bold text-primary"><?php echo esc_html($plugin->post_title); ?> Pricing</h3>
                </div>
                <p class="text-gray-600 max-w-2xl mx-auto"><?php echo esc_html($short_description); ?></p>
              </div>

              <?php if ($has_pro && !empty($pro_version_url)):
                // This plugin has PRO version - show 3-column pricing
                $has_pro_plugins = true;

                // Get 3-column pricing data from new meta fields
                $recommended_badge_text = $meta_fields['recommended_badge_text'] ?: 'RECOMMENDED';
                $buy_now_text           = $meta_fields['buy_now_text'] ?: 'Buy Now';
                $annual_label           = $meta_fields['annual_label'] ?: 'Annual';
                $lifetime_label         = $meta_fields['lifetime_label'] ?: 'Lifetime';
                $year_label             = $meta_fields['year_label'] ?: 'Year';
                $lifetime_label_period  = $meta_fields['lifetime_label_period'] ?: 'Lifetime';

                // Annual pricing
                $annual_single_site_title = $meta_fields['annual_single_site_title'] ?: 'Single Site';
                $annual_single_site_price = $meta_fields['annual_single_site_price'] ?: '$119';
                $annual_single_site_desc  = $meta_fields['annual_single_site_desc'] ?: 'Single site license. One year premium support and updates.';

                $annual_five_site_title = $meta_fields['annual_five_site_title'] ?: 'Five Site';
                $annual_five_site_price = $meta_fields['annual_five_site_price'] ?: '$199';
                $annual_five_site_desc  = $meta_fields['annual_five_site_desc'] ?: 'Five site license. One year premium support and updates.';

                $annual_ten_site_title = $meta_fields['annual_ten_site_title'] ?: 'Ten Sites';
                $annual_ten_site_price = $meta_fields['annual_ten_site_price'] ?: '$229';
                $annual_ten_site_desc  = $meta_fields['annual_ten_site_desc'] ?: 'Ten site license. One year premium support and updates.';

                $show_recommended_annual = $meta_fields['show_recommended_annual'] ?? '1';

                // Lifetime pricing
                $lifetime_single_site_title = $meta_fields['lifetime_single_site_title'] ?: 'Single Site';
                $lifetime_single_site_price = $meta_fields['lifetime_single_site_price'] ?: '$299';
                $lifetime_single_site_desc  = $meta_fields['lifetime_single_site_desc'] ?: 'Single site license. Lifetime premium support and updates.';

                $lifetime_five_site_title = $meta_fields['lifetime_five_site_title'] ?: 'Five Site';
                $lifetime_five_site_price = $meta_fields['lifetime_five_site_price'] ?: '$499';
                $lifetime_five_site_desc  = $meta_fields['lifetime_five_site_desc'] ?: 'Five site license. Lifetime premium support and updates.';

                $lifetime_ten_site_title = $meta_fields['lifetime_ten_site_title'] ?: 'Ten Sites';
                $lifetime_ten_site_price = $meta_fields['lifetime_ten_site_price'] ?: '$699';
                $lifetime_ten_site_desc  = $meta_fields['lifetime_ten_site_desc'] ?: 'Ten site license. Lifetime premium support and updates.';

                $show_recommended_lifetime = $meta_fields['show_recommended_lifetime'] ?? '1';
                ?>

                <!-- Pricing Toggle -->
                <div class="flex justify-center mb-12">
                  <div class="bg-gray-100 rounded-full p-1 inline-flex">
                    <button type="button"
                      class="pricing-toggle-btn px-8 py-3 rounded-full font-medium text-lg transition-all duration-300 bg-primary text-white"
                      data-plugin="<?php echo esc_attr($plugin_slug); ?>" data-type="annual">
                      <?php echo esc_html($annual_label); ?>
                    </button>
                    <button type="button"
                      class="pricing-toggle-btn px-8 py-3 rounded-full font-medium text-lg transition-all duration-300 text-gray-700 hover:text-primary"
                      data-plugin="<?php echo esc_attr($plugin_slug); ?>" data-type="lifetime">
                      <?php echo esc_html($lifetime_label); ?>
                    </button>
                  </div>
                </div>

                <!-- Annual Pricing Cards -->
                <div id="<?php echo esc_attr($plugin_slug); ?>-annual-pricing" class="pricing-plans active">
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Single Site -->
                    <div
                      class="pricing-card bg-white rounded-xl shadow-lg border border-gray-200 p-8 text-center hover:shadow-xl transition-shadow duration-300">
                      <h4 class="text-2xl font-bold text-gray-800 mb-4">
                        <?php echo esc_html($annual_single_site_title); ?>
                      </h4>
                      <div class="mb-4">
                        <span
                          class="text-4xl font-bold text-primary"><?php echo esc_html($annual_single_site_price); ?></span>
                        <span class="text-lg font-medium text-gray-600">/<?php echo esc_html($year_label); ?></span>
                      </div>
                      <p class="text-gray-600 mb-8">
                        <?php echo esc_html($annual_single_site_desc); ?>
                      </p>
                      <a href="<?php echo esc_url($pro_version_url); ?>?plan=annual-single" target="_blank"
                        rel="noopener noreferrer"
                        class="w-full block text-center bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-primary-dark transition">
                        <?php echo esc_html($buy_now_text); ?>
                      </a>
                    </div>

                    <!-- Five Sites -->
                    <div
                      class="pricing-card bg-white rounded-xl shadow-xl border-2 border-primary p-8 text-center hover:shadow-2xl transition-shadow duration-300 relative">
                      <?php if ($show_recommended_annual == '1'): ?>
                        <div class="absolute -top-3 left-1/2 transform -translate-x-1/2">
                          <span class="bg-primary text-white px-4 py-1 rounded-full text-sm font-medium">
                            <?php echo esc_html($recommended_badge_text); ?>
                          </span>
                        </div>
                      <?php endif; ?>
                      <h4 class="text-2xl font-bold text-gray-800 mb-4">
                        <?php echo esc_html($annual_five_site_title); ?>
                      </h4>
                      <div class="mb-4">
                        <span class="text-4xl font-bold text-primary"><?php echo esc_html($annual_five_site_price); ?></span>
                        <span class="text-lg font-medium text-gray-600">/<?php echo esc_html($year_label); ?></span>
                      </div>
                      <p class="text-gray-600 mb-8">
                        <?php echo esc_html($annual_five_site_desc); ?>
                      </p>
                      <a href="<?php echo esc_url($pro_version_url); ?>?plan=annual-five" target="_blank"
                        rel="noopener noreferrer"
                        class="w-full block text-center bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-primary-dark transition font-semibold">
                        <?php echo esc_html($buy_now_text); ?>
                      </a>
                    </div>

                    <!-- Ten Sites -->
                    <div
                      class="pricing-card bg-white rounded-xl shadow-lg border border-gray-200 p-8 text-center hover:shadow-xl transition-shadow duration-300">
                      <h4 class="text-2xl font-bold text-gray-800 mb-4">
                        <?php echo esc_html($annual_ten_site_title); ?>
                      </h4>
                      <div class="mb-4">
                        <span class="text-4xl font-bold text-primary"><?php echo esc_html($annual_ten_site_price); ?></span>
                        <span class="text-lg font-medium text-gray-600">/<?php echo esc_html($year_label); ?></span>
                      </div>
                      <p class="text-gray-600 mb-8">
                        <?php echo esc_html($annual_ten_site_desc); ?>
                      </p>
                      <a href="<?php echo esc_url($pro_version_url); ?>?plan=annual-ten" target="_blank"
                        rel="noopener noreferrer"
                        class="w-full block text-center bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-primary-dark transition">
                        <?php echo esc_html($buy_now_text); ?>
                      </a>
                    </div>
                  </div>
                </div>

                <!-- Lifetime Pricing Cards (Hidden by default) -->
                <div id="<?php echo esc_attr($plugin_slug); ?>-lifetime-pricing" class="pricing-plans hidden">
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Single Site Lifetime -->
                    <div
                      class="pricing-card bg-white rounded-xl shadow-lg border border-gray-200 p-8 text-center hover:shadow-xl transition-shadow duration-300">
                      <h4 class="text-2xl font-bold text-gray-800 mb-4">
                        <?php echo esc_html($lifetime_single_site_title); ?>
                      </h4>
                      <div class="mb-4">
                        <span
                          class="text-4xl font-bold text-primary"><?php echo esc_html($lifetime_single_site_price); ?></span>
                        <span
                          class="text-lg font-medium text-gray-600">/<?php echo esc_html($lifetime_label_period); ?></span>
                      </div>
                      <p class="text-gray-600 mb-8">
                        <?php echo esc_html($lifetime_single_site_desc); ?>
                      </p>
                      <a href="<?php echo esc_url($pro_version_url); ?>?plan=lifetime-single" target="_blank"
                        rel="noopener noreferrer"
                        class="w-full block text-center bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-primary-dark transition">
                        <?php echo esc_html($buy_now_text); ?>
                      </a>
                    </div>

                    <!-- Five Sites Lifetime -->
                    <div
                      class="pricing-card bg-white rounded-xl shadow-xl border-2 border-primary p-8 text-center hover:shadow-2xl transition-shadow duration-300 relative">
                      <?php if ($show_recommended_lifetime == '1'): ?>
                        <div class="absolute -top-3 left-1/2 transform -translate-x-1/2">
                          <span class="bg-primary text-white px-4 py-1 rounded-full text-sm font-medium">
                            <?php echo esc_html($recommended_badge_text); ?>
                          </span>
                        </div>
                      <?php endif; ?>
                      <h4 class="text-2xl font-bold text-gray-800 mb-4">
                        <?php echo esc_html($lifetime_five_site_title); ?>
                      </h4>
                      <div class="mb-4">
                        <span
                          class="text-4xl font-bold text-primary"><?php echo esc_html($lifetime_five_site_price); ?></span>
                        <span
                          class="text-lg font-medium text-gray-600">/<?php echo esc_html($lifetime_label_period); ?></span>
                      </div>
                      <p class="text-gray-600 mb-8">
                        <?php echo esc_html($lifetime_five_site_desc); ?>
                      </p>
                      <a href="<?php echo esc_url($pro_version_url); ?>?plan=lifetime-five" target="_blank"
                        rel="noopener noreferrer"
                        class="w-full block text-center bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-primary-dark transition font-semibold">
                        <?php echo esc_html($buy_now_text); ?>
                      </a>
                    </div>

                    <!-- Ten Sites Lifetime -->
                    <div
                      class="pricing-card bg-white rounded-xl shadow-lg border border-gray-200 p-8 text-center hover:shadow-xl transition-shadow duration-300">
                      <h4 class="text-2xl font-bold text-gray-800 mb-4">
                        <?php echo esc_html($lifetime_ten_site_title); ?>
                      </h4>
                      <div class="mb-4">
                        <span class="text-4xl font-bold text-primary"><?php echo esc_html($lifetime_ten_site_price); ?></span>
                        <span
                          class="text-lg font-medium text-gray-600">/<?php echo esc_html($lifetime_label_period); ?></span>
                      </div>
                      <p class="text-gray-600 mb-8">
                        <?php echo esc_html($lifetime_ten_site_desc); ?>
                      </p>
                      <a href="<?php echo esc_url($pro_version_url); ?>?plan=lifetime-ten" target="_blank"
                        rel="noopener noreferrer"
                        class="w-full block text-center bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-primary-dark transition">
                        <?php echo esc_html($buy_now_text); ?>
                      </a>
                    </div>
                  </div>
                </div>

                <!-- Free Version Link -->
                <?php if ($free_version_url): ?>
                  <div class="text-center mt-8">
                    <p class="text-gray-600">
                      <i class="fas fa-download mr-2" aria-hidden="true"></i>
                      <a href="<?php echo esc_url($free_version_url); ?>" target="_blank" rel="noopener noreferrer"
                        class="text-primary hover:underline">
                        Download Free Version
                      </a>
                      - Try before you buy!
                    </p>
                  </div>
                <?php endif; ?>

              <?php else:
                // This plugin only has free version - show free version card
                ?>

                <!-- Free Version Only Layout -->
                <div class="max-w-4xl mx-auto">
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Free Version Card -->
                    <div class="pricing-card bg-white rounded-xl shadow-lg p-8 text-center">
                      <div class="flex justify-center mb-4">
                        <?php
                        // Get plugin hero image or thumbnail
                        $plugin_hero_image = $meta_fields['plugin_hero_image'];
                        if (!empty($plugin_hero_image)): ?>
                          <img src="<?php echo esc_url($plugin_hero_image); ?>"
                            alt="<?php echo esc_attr($plugin->post_title); ?>" class="w-16 h-16 rounded-lg object-cover">
                        <?php elseif (has_post_thumbnail($plugin->ID)): ?>
                          <?php echo get_the_post_thumbnail($plugin->ID, 'thumbnail', [
                            'class' => 'w-16 h-16 rounded-lg object-cover'
                          ]); ?>
                        <?php else: ?>
                          <div class="w-16 h-16 bg-primary-light rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-plug text-primary text-2xl"></i>
                          </div>
                        <?php endif; ?>
                      </div>

                      <h4 class="text-2xl font-bold text-gray-800 mb-2"><?php echo esc_html($free_plan_title); ?></h4>
                      <div class="text-4xl font-bold text-gray-800 mb-4">
                        <?php echo esc_html($free_plan_price); ?><span class="text-lg font-normal text-gray-600">
                          <?php echo esc_html($free_plan_period); ?>
                        </span>
                      </div>
                      <p class="text-gray-600 mb-6"><?php echo esc_html($free_plan_desc); ?></p>

                      <?php if (!empty($free_features)): ?>
                        <ul class="space-y-3 mb-8 max-w-md mx-auto">
                          <?php foreach ($free_features as $i => $feature):
                            if (empty($feature))
                              continue;
                            ?>
                            <li class="flex items-center gap-2">
                              <?php if ($i < 4): ?>
                                <i class="fas fa-check text-green-500"></i>
                                <span><?php echo esc_html($feature); ?></span>
                              <?php else: ?>
                                <i class="fas fa-times text-gray-400"></i>
                                <span class="text-gray-400"><?php echo esc_html($feature); ?></span>
                              <?php endif; ?>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                      <?php endif; ?>

                      <?php if ($free_version_url): ?>
                        <a href="<?php echo esc_url($free_version_url); ?>" target="_blank" rel="noopener noreferrer"
                          class="w-full block text-center border border-primary text-primary px-6 py-3 rounded-lg font-medium hover:bg-primary-light transition mb-4">
                          <i class="fas fa-download mr-2"></i>Download Free Version
                        </a>

                        <?php if (strpos($free_version_url, 'wordpress.org') !== false): ?>
                          <div class="flex items-center justify-center gap-2 text-sm text-gray-600 mt-2">
                            <i class="fab fa-wordpress text-primary"></i>
                            <span>Available on WordPress.org</span>
                          </div>
                        <?php endif; ?>
                      <?php endif; ?>
                    </div>

                    <!-- Coming Soon Card -->
                    <div
                      class="pricing-card bg-gradient-to-br from-primary/10 to-primary/5 rounded-xl border-2 border-dashed border-primary/30 p-8 text-center flex flex-col items-center justify-center">
                      <div class="mb-6">
                        <i class="fas fa-sparkles text-primary text-5xl"></i>
                      </div>
                      <h4 class="text-2xl font-bold text-primary mb-4">PRO Version Coming Soon!</h4>
                      <p class="text-gray-600 mb-6">
                        We're working hard to bring you premium features, priority support, and enhanced functionality.
                        Sign up to get notified when it's ready!
                      </p>

                      <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 w-full">
                        <p class="text-sm text-yellow-800">
                          <i class="fas fa-clock mr-2"></i>
                          <strong>Launching Soon:</strong> PRO version with advanced features
                        </p>
                      </div>

                      <div class="mt-6 text-center">
                        <button
                          class="bg-primary text-white px-6 py-2 rounded-lg font-medium hover:bg-primary-dark transition"
                          onclick="alert('Subscribe form would appear here in production')">
                          Get Notified
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <?php if ($free_version_url): ?>
                  <div class="text-center mt-8">
                    <div class="bg-gray-50 rounded-lg p-4 inline-block">
                      <p class="text-gray-600">
                        <i class="fab fa-wordpress text-primary mr-2"></i>
                        <strong>Free version available on WordPress.org:</strong>
                        <a href="<?php echo esc_url($free_version_url); ?>" target="_blank" rel="noopener noreferrer"
                          class="text-primary hover:underline ml-2">
                          Download from WordPress.org →
                        </a>
                      </p>
                    </div>
                  </div>
                <?php endif; ?>

              <?php endif; ?>

              <!-- Pricing Footer (for both free and pro versions) -->
              <div class="text-center mt-12">
                <p class="text-gray-600">
                  <i class="fas fa-info-circle text-primary mr-2" aria-hidden="true"></i>
                  <?php echo esc_html($pricing_footer_text); ?>
                </p>
              </div>
            </div>
          <?php endforeach; ?>

          <?php
          // Check if we have any plugins at all (should always be true, but just in case)
          if (empty($plugins)): ?>
            <div class="text-center py-16">
              <div class="mb-6">
                <i class="fas fa-plug text-gray-300 text-6xl" aria-hidden="true"></i>
              </div>
              <h3 class="text-2xl font-bold text-gray-700 mb-3">No Plugins Available</h3>
              <p class="text-gray-600 max-w-md mx-auto mb-6">
                We're currently working on amazing WordPress plugins. Check back soon!
              </p>
            </div>
          <?php endif; ?>
        </div>
      </section>
    <?php endif; ?>

    <!-- Features Overview -->
    <section class="py-16 bg-white px-4">
      <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
            <?php echo esc_html($pricing_meta['features_title']); ?>
          </h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            <?php echo esc_html($pricing_meta['features_description']); ?>
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <?php for ($i = 1; $i <= 4; $i++):
            if (!empty($pricing_meta['feature_' . $i . '_title']) || !empty($pricing_meta['feature_' . $i . '_description'])): ?>
              <div class="text-center">
                <?php if (!empty($pricing_meta['feature_' . $i . '_icon'])): ?>
                  <div class="bg-primary-light w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i
                      class="fas <?php echo esc_attr($pricing_meta['feature_' . $i . '_icon']); ?> text-primary text-2xl"></i>
                  </div>
                <?php endif; ?>

                <?php if (!empty($pricing_meta['feature_' . $i . '_title'])): ?>
                  <h3 class="font-bold text-primary mb-2"><?php echo esc_html($pricing_meta['feature_' . $i . '_title']); ?>
                  </h3>
                <?php endif; ?>

                <?php if (!empty($pricing_meta['feature_' . $i . '_description'])): ?>
                  <p class="text-gray-600 text-sm"><?php echo esc_html($pricing_meta['feature_' . $i . '_description']); ?>
                  </p>
                <?php endif; ?>
              </div>
            <?php endif;
          endfor; ?>
        </div>
      </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 px-4">
      <div class="max-w-4xl mx-auto">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
            <?php echo esc_html($pricing_meta['faq_title']); ?>
          </h2>
          <p class="text-xl text-gray-600"><?php echo esc_html($pricing_meta['faq_description']); ?></p>
        </div>

        <div class="space-y-4">
          <?php foreach ($pricing_meta['faqs'] as $faq): ?>
            <div class="bg-white rounded-lg shadow-md p-6">
              <button class="faq-question w-full text-left flex justify-between items-center font-semibold text-primary"
                onclick="toggleFAQ(this)">
                <span><?php echo esc_html($faq['question']); ?></span>
                <i class="fas fa-chevron-down transition-transform"></i>
              </button>
              <div class="faq-answer hidden mt-4 text-gray-600">
                <?php echo wp_kses_post($faq['answer']); ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 gradient-bg text-white px-4">
      <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6"><?php echo esc_html($pricing_meta['cta_title']); ?></h2>
        <p class="text-xl mb-8 opacity-90"><?php echo esc_html($pricing_meta['cta_description']); ?></p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <?php if (!empty($pricing_meta['cta_button_1_text']) && !empty($pricing_meta['cta_button_1_url'])): ?>
            <a href="<?php echo esc_url($pricing_meta['cta_button_1_url']); ?>"
              class="bg-white text-primary px-8 py-3 rounded-lg font-medium text-lg inline-block hover:bg-gray-100 transition">
              <?php echo esc_html($pricing_meta['cta_button_1_text']); ?>
            </a>
          <?php endif; ?>

          <?php if (!empty($pricing_meta['cta_button_2_text']) && !empty($pricing_meta['cta_button_2_url'])): ?>
            <a href="<?php echo esc_url($pricing_meta['cta_button_2_url']); ?>"
              class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-medium text-lg inline-block hover:bg-white hover:text-primary transition">
              <?php echo esc_html($pricing_meta['cta_button_2_text']); ?>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </section>
  </main>
</section>

<script>
  // Plugin tabs functionality
  document.addEventListener('DOMContentLoaded', function () {
    // Plugin tabs functionality
    const pluginTabs = document.querySelectorAll('.plugin-tab');
    if (pluginTabs.length > 0) {
      pluginTabs.forEach(tab => {
        tab.addEventListener('click', function () {
          // Remove active class from all tabs
          document.querySelectorAll('.plugin-tab').forEach(t => {
            t.classList.remove('active', 'text-white');
            t.classList.add('bg-gray-100', 'text-gray-700');
          });

          // Add active class to clicked tab
          this.classList.add('active');
          this.classList.remove('bg-gray-100', 'text-gray-700');
          this.classList.add('text-white');

          // Hide all plugin pricing sections
          document.querySelectorAll('.plugin-pricing').forEach(pricing => {
            pricing.classList.add('hidden');
          });

          // Show selected plugin pricing
          const plugin = this.dataset.plugin;
          const pricingElement = document.getElementById(plugin + '-pricing');
          if (pricingElement) {
            pricingElement.classList.remove('hidden');

            // Reset pricing toggle to annual for this plugin
            const pricingToggles = pricingElement.querySelectorAll('.pricing-toggle-btn');
            if (pricingToggles.length) {
              // Reset to annual view
              pricingToggles.forEach(toggle => {
                toggle.classList.remove('bg-primary', 'text-white');
                toggle.classList.add('text-gray-700', 'hover:text-primary');
                if (toggle.dataset.type === 'annual') {
                  toggle.classList.add('bg-primary', 'text-white');
                  toggle.classList.remove('text-gray-700', 'hover:text-primary');
                }
              });

              // Show annual, hide lifetime
              const annualPricing = document.getElementById(plugin + '-annual-pricing');
              const lifetimePricing = document.getElementById(plugin + '-lifetime-pricing');
              if (annualPricing) annualPricing.classList.remove('hidden');
              if (annualPricing) annualPricing.classList.add('active');
              if (lifetimePricing) lifetimePricing.classList.add('hidden');
            }
          }
        });
      });
    }

    // Pricing Toggle Functionality for each plugin
    document.addEventListener('click', function (e) {
      if (e.target.classList.contains('pricing-toggle-btn')) {
        const button = e.target;
        const plugin = button.dataset.plugin;
        const type = button.dataset.type;

        // Get all toggles for this plugin
        const allToggles = document.querySelectorAll(`.pricing-toggle-btn[data-plugin="${plugin}"]`);

        // Remove active class from all toggles for this plugin
        allToggles.forEach(toggle => {
          toggle.classList.remove('bg-primary', 'text-white');
          toggle.classList.add('text-gray-700', 'hover:text-primary');
        });

        // Add active class to clicked toggle
        button.classList.add('bg-primary', 'text-white');
        button.classList.remove('text-gray-700', 'hover:text-primary');

        // Hide/show pricing plans for this plugin
        const annualPricing = document.getElementById(`${plugin}-annual-pricing`);
        const lifetimePricing = document.getElementById(`${plugin}-lifetime-pricing`);

        if (annualPricing) {
          if (type === 'annual') {
            annualPricing.classList.remove('hidden');
            annualPricing.classList.add('active');
          } else {
            annualPricing.classList.add('hidden');
            annualPricing.classList.remove('active');
          }
        }

        if (lifetimePricing) {
          if (type === 'lifetime') {
            lifetimePricing.classList.remove('hidden');
            lifetimePricing.classList.add('active');
          } else {
            lifetimePricing.classList.add('hidden');
            lifetimePricing.classList.remove('active');
          }
        }
      }
    });

    // FAQ toggle
    window.toggleFAQ = function (button) {
      const answer = button.nextElementSibling;
      const icon = button.querySelector('i');

      answer.classList.toggle('hidden');
      icon.classList.toggle('rotate-180');
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });
  });
</script>

<style>
  .gradient-bg {
    background: linear-gradient(135deg, #1F3266 0%, #4A6FA5 100%);
  }

  .gradient-text {
    background: linear-gradient(135deg, #1F3266 0%, #4A6FA5 100%);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
  }

  .btn-primary {
    background: linear-gradient(135deg, #1F3266 0%, #4A6FA5 100%);
    transition: all 0.3s ease;
  }

  .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(31, 50, 102, 0.4);
  }

  .text-primary {
    color: #1F3266;
  }

  .bg-primary {
    background-color: #1F3266;
  }

  .bg-primary-light {
    background-color: rgba(31, 50, 102, 0.1);
  }

  .border-primary {
    border-color: #1F3266;
  }

  .text-primary-light {
    color: #4A6FA5;
  }

  .accent-color {
    color: #FF6B6B;
  }

  .accent-bg {
    background-color: #FF6B6B;
  }

  .accent-light-bg {
    background-color: rgba(255, 107, 107, 0.1);
  }

  .pricing-card {
    transition: all 0.3s ease;
  }

  .pricing-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(31, 50, 102, 0.15);
  }

  .popular-badge {
    background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%);
  }

  .plugin-tab {
    transition: all 0.3s ease;
  }

  .plugin-tab.active {
    background: linear-gradient(135deg, #1F3266 0%, #4A6FA5 100%);
    color: white;
  }

  .feature-check {
    color: #10B981;
  }

  .feature-cross {
    color: #EF4444;
  }

  /* Add these to your existing CSS */
  .pricing-toggle-btn {
    min-width: 140px;
  }

  .pricing-toggle-btn:hover {
    background-color: #f3f4f6;
  }

  .pricing-plans {
    transition: opacity 0.3s ease-in-out;
  }

  .pricing-plans.active {
    animation: fadeIn 0.5s ease-in-out;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(10px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Plugin card hover effects */
  .pricing-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .pricing-card:hover {
    transform: translateY(-5px);
  }
</style>

<?php
get_footer();
