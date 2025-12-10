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
        <div class="max-w-7xl mx-auto">
          <?php foreach ($plugins as $index => $plugin):
            $plugin_slug = sanitize_title($plugin->post_title);
            $meta_fields = wp_easysoft_get_plugin_meta($plugin->ID);

            // Extract pricing data
            $has_pro           = $meta_fields['has_pro'];
            $free_version_url  = $meta_fields['free_version_url'];
            $pro_version_url   = $meta_fields['pro_version_url'];
            $free_features     = $meta_fields['free_features'];
            $pro_features      = $meta_fields['pro_features'];
            $short_description = $meta_fields['short_description'];

            // Pricing details
            $free_plan_title  = $meta_fields['free_plan_title'] ?: 'Free Version';
            $free_plan_price  = $meta_fields['free_plan_price'] ?: 'FREE';
            $free_plan_period = $meta_fields['free_plan_period'] ?: '/forever';
            $free_plan_desc   = $meta_fields['free_plan_desc'] ?: 'Perfect for basic needs';

            $pro_plan_title  = $meta_fields['pro_plan_title'] ?: $plugin->post_title . ' PRO';
            $pro_plan_price  = $meta_fields['pro_plan_price'] ?: '$59';
            $pro_plan_period = $meta_fields['pro_plan_period'] ?: '/year';
            $pro_plan_desc   = $meta_fields['pro_plan_desc'] ?: 'Unlock all features and premium support';
            ?>
            <div id="<?php echo esc_attr($plugin_slug); ?>-pricing"
              class="plugin-pricing <?php echo $index === 0 ? '' : 'hidden'; ?>">
              <div class="text-center mb-12">
                <h3 class="text-2xl font-bold text-primary mb-4"><?php echo esc_html($plugin->post_title); ?> Pricing</h3>
                <p class="text-gray-600 max-w-2xl mx-auto"><?php echo esc_html($short_description); ?></p>
              </div>

              <div
                class="<?php echo $has_pro ? 'grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto' : 'max-w-4xl mx-auto'; ?>">
                <!-- Free Version Card -->
                <div class="pricing-card bg-white rounded-xl shadow-lg p-8 <?php echo !$has_pro ? 'text-center' : ''; ?>">
                  <?php if (!$has_pro): ?>
                    <div class="flex justify-center mb-4">
                      <?php if (has_post_thumbnail($plugin->ID)): ?>
                        <?php echo get_the_post_thumbnail($plugin->ID, 'thumbnail', ['class' => 'w-16 h-16 rounded-lg']); ?>
                      <?php else: ?>
                        <i class="fa-solid fa-plug text-primary text-4xl"></i>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>

                  <h4 class="text-xl font-bold text-gray-800 mb-2"><?php echo esc_html($free_plan_title); ?></h4>
                  <div class="text-4xl font-bold text-gray-800 mb-4">
                    <?php echo esc_html($free_plan_price); ?><span
                      class="text-lg font-normal text-gray-600"><?php echo esc_html($free_plan_period); ?></span>
                  </div>
                  <p class="text-gray-600 mb-6"><?php echo esc_html($free_plan_desc); ?></p>

                  <?php if (!empty($free_features)): ?>
                    <ul class="space-y-3 mb-8 <?php echo !$has_pro ? 'max-w-md mx-auto' : ''; ?>">
                      <?php foreach ($free_features as $i => $feature):
                        if (empty($feature))
                          continue;
                        ?>
                        <li class="flex items-center gap-2">
                          <?php if ($i < 4): ?>
                            <i class="fas fa-check feature-check"></i>
                            <span><?php echo esc_html($feature); ?></span>
                          <?php else: ?>
                            <i class="fas fa-times feature-cross"></i>
                            <span class="text-gray-400"><?php echo esc_html($feature); ?></span>
                          <?php endif; ?>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  <?php endif; ?>

                  <?php if ($free_version_url): ?>
                    <a href="<?php echo esc_url($free_version_url); ?>" target="_blank" rel="noopener noreferrer"
                      class="w-full block text-center border border-primary text-primary px-6 py-3 rounded-lg font-medium hover:bg-primary-light transition">
                      Download Free Version
                    </a>
                  <?php endif; ?>

                  <?php if (!$has_pro): ?>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mt-6">
                      <p class="text-sm text-yellow-800">
                        <i class="fas fa-sparkles mr-2"></i>
                        <strong>PRO version coming soon!</strong> Get notified when we release premium features.
                      </p>
                    </div>
                  <?php endif; ?>
                </div>

                <!-- PRO Version Card -->
                <?php if ($has_pro): ?>
                  <div
                    class="pricing-card bg-gradient-to-br from-primary to-primary-light rounded-xl shadow-xl p-8 text-white relative">
                    <div class="popular-badge absolute -top-4 right-4 text-white px-4 py-1 rounded-full text-sm font-medium">
                      POPULAR</div>
                    <h4 class="text-xl font-bold mb-2"><?php echo esc_html($pro_plan_title); ?></h4>
                    <div class="text-4xl font-bold mb-4"><?php echo esc_html($pro_plan_price); ?><span
                        class="text-lg font-normal opacity-90"><?php echo esc_html($pro_plan_period); ?></span></div>
                    <p class="opacity-90 mb-6"><?php echo esc_html($pro_plan_desc); ?></p>

                    <?php if (!empty($pro_features)): ?>
                      <ul class="space-y-3 mb-8">
                        <?php foreach ($pro_features as $feature):
                          if (empty($feature))
                            continue;
                          ?>
                          <li class="flex items-center gap-2">
                            <i class="fas fa-check text-green-400"></i>
                            <span><?php echo esc_html($feature); ?></span>
                          </li>
                        <?php endforeach; ?>
                      </ul>
                    <?php endif; ?>

                    <?php if ($pro_version_url): ?>
                      <a href="<?php echo esc_url($pro_version_url); ?>" target="_blank" rel="noopener noreferrer"
                        class="w-full block text-center bg-white text-primary px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Get <?php echo esc_html($plugin->post_title); ?> PRO
                      </a>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
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
          }
        });
      });
    }

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
</style>

<?php
get_footer();
