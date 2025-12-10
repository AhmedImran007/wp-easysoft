<?php
/**
 * Single WP Plugin Template
 *
 * @package _tw
 */

get_header();

// Get all meta fields using the helper function
$meta_fields = wp_easysoft_get_plugin_meta(get_the_ID());

// Get basic meta data with fallbacks
$has_pro           = $meta_fields['has_pro'];
$active_installs   = $meta_fields['active_installs'] ?: '';
$free_version_url  = $meta_fields['free_version_url'];
$pro_version_url   = $meta_fields['pro_version_url'];
$plugin_categories = get_the_terms(get_the_ID(), 'wp_plugin_category');

// Get additional meta fields
$tagline                = $meta_fields['tagline'] ?: get_the_title() . ' - Ultimate WordPress Solution';
$short_description      = $meta_fields['short_description'] ?: (get_the_excerpt() ?: 'A powerful WordPress plugin with advanced features and customization options.');
$version                = $meta_fields['version'] ?: '1.0';
$tested_up_to           = $meta_fields['tested_up_to'] ?: '6.4';
$last_updated           = get_the_modified_date('F j, Y');
$requires_php           = $meta_fields['requires_php'] ?: '7.4';
$requires_wp            = $meta_fields['requires_wp'] ?: '5.0';
$rating                 = $meta_fields['rating'] ?: '4.9';
$woocommerce_compatible = $meta_fields['woocommerce_compatible'];

// Get JSON encoded data
$features      = $meta_fields['features'];
$use_cases     = $meta_fields['use_cases'];
$demos         = $meta_fields['demos'];
$testimonials  = $meta_fields['testimonials'];
$faqs          = $meta_fields['faqs'];
$free_features = $meta_fields['free_features'];
$pro_features  = $meta_fields['pro_features'];

// Get button texts and labels
$pro_button_text         = $meta_fields['pro_button_text'] ?: 'Get ' . get_the_title() . ' PRO';
$demo_button_text        = $meta_fields['demo_button_text'] ?: 'View Demo';
$updates_text            = $meta_fields['updates_text'] ?: 'Regular Updates';
$compatibility_text      = $meta_fields['compatibility_text'] ?: 'WooCommerce Compatible';
$try_demo_text           = $meta_fields['try_demo_text'] ?: 'Try Live Demo';
$free_button_text        = $meta_fields['free_button_text'] ?: 'Download Free Version';
$pro_button_text_pricing = $meta_fields['pro_button_text_pricing'] ?: 'Get ' . get_the_title() . ' PRO';
$cta_pro_text            = $meta_fields['cta_pro_text'] ?: 'Get ' . get_the_title() . ' PRO - $59/year';
$cta_free_text           = $meta_fields['cta_free_text'] ?: 'Start with Free Version';

// Get section headings and descriptions
$features_heading     = $meta_fields['features_heading'] ?: 'Powerful Features';
$features_desc        = $meta_fields['features_desc'] ?: 'Everything you need for a complete solution';
$demo_heading         = $meta_fields['demo_heading'] ?: 'See Plugin in Action';
$demo_desc            = $meta_fields['demo_desc'] ?: 'Explore the features through our interactive demo';
$use_cases_heading    = $meta_fields['use_cases_heading'] ?: 'Perfect For';
$use_cases_desc       = $meta_fields['use_cases_desc'] ?: 'Ideal solution for various WordPress projects';
$pricing_heading      = $meta_fields['pricing_heading'] ?: 'Choose Your Plan';
$pricing_desc         = $meta_fields['pricing_desc'] ?: 'Start with our free version or unlock all features with PRO';
$testimonials_heading = $meta_fields['testimonials_heading'] ?: 'What Our Users Say';
$testimonials_desc    = $meta_fields['testimonials_desc'] ?: 'Join thousands of satisfied users worldwide';
$faq_heading          = $meta_fields['faq_heading'] ?: 'Frequently Asked Questions';
$faq_desc             = $meta_fields['faq_desc'] ?: 'Everything you need to know about ' . get_the_title();
$requirements_heading = $meta_fields['requirements_heading'] ?: 'Technical Requirements';
$requirements_desc    = $meta_fields['requirements_desc'] ?: 'Make sure your site meets these requirements';
$cta_heading          = $meta_fields['cta_heading'] ?: 'Ready to Get Started?';
$cta_desc             = $meta_fields['cta_desc'] ?: 'Join thousands of users who trust ' . get_the_title() . ' for their WordPress needs';

// Get pricing details
$free_plan_title  = $meta_fields['free_plan_title'] ?: 'Free Version';
$free_plan_price  = $meta_fields['free_plan_price'] ?: '$0';
$free_plan_period = $meta_fields['free_plan_period'] ?: '/forever';
$free_plan_desc   = $meta_fields['free_plan_desc'] ?: 'Perfect for basic needs';

$pro_plan_title         = $meta_fields['pro_plan_title'] ?: get_the_title() . ' PRO';
$pro_plan_price         = $meta_fields['pro_plan_price'] ?: '$59';
$pro_plan_period        = $meta_fields['pro_plan_period'] ?: '/year';
$pro_plan_desc          = $meta_fields['pro_plan_desc'] ?: 'Unlock all features and premium support';
$recommended_badge_text = $meta_fields['recommended_badge_text'] ?: 'RECOMMENDED';
$show_recommended_badge = $meta_fields['show_recommended_badge'];

// Get footer texts
$pricing_footer_text = $meta_fields['pricing_footer_text'] ?: '30-day money-back guarantee • Instant download • 1 year of updates & support';
$cta_footer_text     = $meta_fields['cta_footer_text'] ?: '30-day money-back guarantee • Instant download • 1 year of updates & support';
?>

<!-- Hero Section -->
<section class="gradient-bg text-white py-20">
  <div class="max-w-7xl mx-auto px-4">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div>
        <div class="flex items-center gap-2 mb-4">
          <?php if (has_post_thumbnail()): ?>
            <?php the_post_thumbnail('thumbnail', [
              'class' => 'w-12 h-12 rounded-lg'
            ]); ?>
          <?php else: ?>
            <i class="fas fa-plug text-3xl"></i>
          <?php endif; ?>
          <span class="text-2xl font-bold"><?php the_title(); ?></span>
        </div>

        <h2 class="text-4xl md:text-5xl font-bold mb-6"><?php echo esc_html($tagline); ?></h2>

        <p class="text-xl mb-8 opacity-90"><?php echo esc_html($short_description); ?></p>

        <div class="flex flex-col sm:flex-row gap-4 mb-8">
          <?php if ($has_pro && $pro_version_url): ?>
            <a href="<?php echo esc_url($pro_version_url); ?>" target="_blank" rel="noopener noreferrer"
              class="btn-primary text-white px-8 py-3 rounded-lg font-medium text-lg inline-block">
              <?php echo esc_html($pro_button_text); ?>
            </a>
          <?php endif; ?>

          <?php if ($free_version_url): ?>
            <a href="#demo"
              class="bg-white/20 backdrop-blur-sm text-white px-8 py-3 rounded-lg font-medium text-lg inline-block hover:bg-white/30 transition">
              <?php echo esc_html($demo_button_text); ?>
            </a>
          <?php endif; ?>
        </div>

        <div class="flex items-center gap-6">
          <?php if ($rating): ?>
            <div class="flex items-center gap-2">
              <i class="fas fa-star text-yellow-400"></i>
              <span class="font-semibold"><?php echo esc_html($rating); ?>/5</span>
            </div>
          <?php endif; ?>

          <?php if ($active_installs): ?>
            <div class="flex items-center gap-2">
              <i class="fas fa-download"></i>
              <span><?php echo esc_html($active_installs); ?> Active Installs</span>
            </div>
          <?php endif; ?>

          <div class="flex items-center gap-2">
            <i class="fas fa-sync-alt"></i>
            <span><?php echo esc_html($updates_text); ?></span>
          </div>
        </div>
      </div>

      <div class="relative">
        <div class="float-animation">
          <?php if (has_post_thumbnail()): ?>
            <?php the_post_thumbnail('large', [
              'class' => 'screenshot-frame w-full h-auto'
            ]); ?>
          <?php else: ?>
            <div
              class="screenshot-frame bg-gradient-to-br from-blue-500 to-purple-600 h-80 flex items-center justify-center">
              <i class="fas fa-plug text-white text-8xl"></i>
            </div>
          <?php endif; ?>
        </div>

        <?php if ($woocommerce_compatible): ?>
          <div class="absolute -bottom-4 -left-4 bg-white rounded-lg shadow-lg p-3 flex items-center gap-2">
            <i class="fas fa-check-circle text-green-500 text-xl"></i>
            <span class="text-gray-800 font-medium"><?php echo esc_html($compatibility_text); ?></span>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- Trust Badges -->
<section class="py-8 bg-white border-b">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex flex-wrap justify-center items-center gap-8">
      <div class="flex items-center gap-2">
        <i class="fab fa-wordpress text-primary text-2xl"></i>
        <span class="font-medium">WordPress <?php echo esc_html($requires_wp); ?>+</span>
      </div>

      <?php if ($woocommerce_compatible): ?>
        <div class="flex items-center gap-2">
          <i class="fas fa-shopping-cart text-primary text-2xl"></i>
          <span class="font-medium"><?php echo esc_html($compatibility_text); ?></span>
        </div>
      <?php endif; ?>

      <div class="flex items-center gap-2">
        <i class="fas fa-mobile-alt text-primary text-2xl"></i>
        <span class="font-medium">Mobile Responsive</span>
      </div>

      <div class="flex items-center gap-2">
        <i class="fas fa-code text-primary text-2xl"></i>
        <span class="font-medium">Developer Friendly</span>
      </div>

      <?php if ($has_pro): ?>
        <div class="flex items-center gap-2">
          <i class="fas fa-headset text-primary text-2xl"></i>
          <span class="font-medium">Priority Support</span>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- Features Overview -->
<?php if (!empty($features)): ?>
  <section class="py-16">
    <div class="max-w-7xl mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
          <?php echo esc_html($features_heading); ?>
        </h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto"><?php echo esc_html($features_desc); ?></p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($features as $index => $feature):
          if (empty($feature['title']) && empty($feature['description']))
            continue;
          ?>
          <div class="feature-card bg-white rounded-xl p-6 shadow-md">
            <?php if (!empty($feature['icon'])): ?>
              <div class="bg-primary-light w-14 h-14 rounded-lg flex items-center justify-center mb-4">
                <i class="fas <?php echo esc_attr($feature['icon']); ?> text-primary text-2xl"></i>
              </div>
            <?php endif; ?>
            <?php if (!empty($feature['title'])): ?>
              <h3 class="text-xl font-bold text-primary mb-2"><?php echo esc_html($feature['title']); ?></h3>
            <?php endif; ?>
            <?php if (!empty($feature['description'])): ?>
              <p class="text-gray-600"><?php echo esc_html($feature['description']); ?></p>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<!-- Demo Section -->
<?php if (!empty($demos)): ?>
  <section id="demo" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
          <?php echo esc_html($demo_heading); ?>
        </h2>
        <p class="text-xl text-gray-600"><?php echo esc_html($demo_desc); ?></p>
      </div>

      <!-- Demo Tabs -->
      <div class="flex justify-center mb-8">
        <div class="bg-gray-100 rounded-lg p-1 inline-flex">
          <?php foreach ($demos as $i => $demo):
            if (empty($demo['title']))
              continue;
            ?>
            <button
              class="demo-tab px-6 py-2 rounded-md font-medium <?php echo $i === 0 ? 'tab-active' : 'text-gray-600'; ?>"
              data-tab="demo-<?php echo esc_attr($i); ?>">
              <?php echo esc_html($demo['title']); ?>
            </button>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Demo Content -->
      <div class="bg-gray-50 rounded-xl p-8">
        <?php foreach ($demos as $i => $demo):
          if (empty($demo['title']) && empty($demo['description']))
            continue;
          ?>
          <div id="demo-<?php echo esc_attr($i); ?>" class="demo-content <?php echo $i === 0 ? '' : 'hidden'; ?>">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
              <div>
                <?php if (!empty($demo['title'])): ?>
                  <h3 class="text-2xl font-bold text-primary mb-4"><?php echo esc_html($demo['title']); ?></h3>
                <?php endif; ?>

                <?php if (!empty($demo['description'])): ?>
                  <p class="text-gray-600 mb-4"><?php echo esc_html($demo['description']); ?></p>
                <?php endif; ?>

                <?php if (!empty($demo['features'])): ?>
                  <?php
                  $demo_features = is_array($demo['features']) ? $demo['features'] : explode(',', $demo['features']);
                  ?>
                  <ul class="space-y-2 mb-6">
                    <?php foreach ($demo_features as $feature):
                      if (empty(trim($feature)))
                        continue;
                      ?>
                      <li class="flex items-center gap-2">
                        <i class="fas fa-check text-green-500"></i>
                        <span><?php echo esc_html(trim($feature)); ?></span>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>

                <?php if (!empty($demo['demo_url'])): ?>
                  <a href="<?php echo esc_url($demo['demo_url']); ?>" target="_blank"
                    class="btn-primary text-white px-6 py-2 rounded-lg font-medium">
                    <?php echo esc_html($try_demo_text); ?>
                  </a>
                <?php endif; ?>
              </div>
              <div>
                <?php if (!empty($demo['image'])): ?>
                  <img src="<?php echo esc_url($demo['image']); ?>" alt="<?php echo esc_attr($demo['title']); ?>"
                    class="rounded-lg shadow-lg w-full h-auto">
                <?php else: ?>
                  <div
                    class="bg-gradient-to-br from-blue-100 to-purple-100 rounded-lg shadow-lg h-80 flex items-center justify-center">
                    <i class="fas fa-play-circle text-6xl text-primary opacity-50"></i>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<!-- Use Cases -->
<?php if (!empty($use_cases)): ?>
  <section class="py-16">
    <div class="max-w-7xl mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
          <?php echo esc_html($use_cases_heading); ?>
        </h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto"><?php echo esc_html($use_cases_desc); ?></p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($use_cases as $use_case):
          if (empty($use_case['title']) && empty($use_case['description']))
            continue;
          ?>
          <div class="bg-white rounded-xl p-6 text-center shadow-md hover:shadow-lg transition">
            <?php if (!empty($use_case['icon'])): ?>
              <div class="bg-primary-light w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas <?php echo esc_attr($use_case['icon']); ?> text-primary text-2xl"></i>
              </div>
            <?php endif; ?>
            <?php if (!empty($use_case['title'])): ?>
              <h3 class="font-bold text-primary mb-2"><?php echo esc_html($use_case['title']); ?></h3>
            <?php endif; ?>
            <?php if (!empty($use_case['description'])): ?>
              <p class="text-gray-600 text-sm"><?php echo esc_html($use_case['description']); ?></p>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<!-- Pricing Section -->
<section id="pricing" class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4">
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
        <?php echo esc_html($pricing_heading); ?>
      </h2>
      <p class="text-xl text-gray-600"><?php echo esc_html($pricing_desc); ?></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
      <!-- Free Version -->
      <div class="pricing-card bg-white rounded-xl shadow-lg border border-gray-200 p-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-2">
          <?php echo esc_html($free_plan_title); ?>
        </h3>
        <div class="text-4xl font-bold text-gray-800 mb-4">
          <?php echo esc_html($free_plan_price); ?><span class="text-lg font-normal text-gray-600">
            <?php echo esc_html($free_plan_period); ?>
          </span>
        </div>
        <p class="text-gray-600 mb-6"><?php echo esc_html($free_plan_desc); ?></p>

        <?php if (!empty($free_features)): ?>
          <ul class="space-y-3 mb-8">
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
            class="w-full block text-center border border-primary text-primary px-6 py-3 rounded-lg font-medium hover:bg-primary-light transition">
            <?php echo esc_html($free_button_text); ?>
          </a>
        <?php endif; ?>
      </div>

      <!-- PRO Version -->
      <?php if ($has_pro && !empty($pro_features)): ?>
        <div
          class="pricing-card bg-gradient-to-br from-primary to-primary-light rounded-xl shadow-xl p-8 text-white relative">
          <?php if ($show_recommended_badge): ?>
            <div class="absolute -top-4 right-8 accent-bg text-white px-3 py-1 rounded-full text-sm font-medium">
              <?php echo esc_html($recommended_badge_text); ?>
            </div>
          <?php endif; ?>
          <h3 class="text-2xl font-bold mb-2"><?php echo esc_html($pro_plan_title); ?></h3>
          <div class="text-4xl font-bold mb-4">
            <?php echo esc_html($pro_plan_price); ?><span class="text-lg font-normal opacity-90">
              <?php echo esc_html($pro_plan_period); ?>
            </span>
          </div>
          <p class="opacity-90 mb-6"><?php echo esc_html($pro_plan_desc); ?></p>

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

          <?php if ($pro_version_url): ?>
            <a href="<?php echo esc_url($pro_version_url); ?>" target="_blank" rel="noopener noreferrer"
              class="w-full block text-center bg-white text-primary px-6 py-3 rounded-lg font-medium hover:bg-gray-100 transition font-semibold">
              <?php echo esc_html($pro_button_text_pricing); ?>
            </a>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="text-center mt-8">
      <p class="text-gray-600">
        <i class="fas fa-shield-alt text-primary mr-2"></i>
        <?php echo esc_html($pricing_footer_text); ?>
      </p>
    </div>
  </div>
</section>

<!-- Testimonials -->
<?php if (!empty($testimonials)): ?>
  <section class="py-16">
    <div class="max-w-7xl mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
          <?php echo esc_html($testimonials_heading); ?>
        </h2>
        <p class="text-xl text-gray-600"><?php echo esc_html($testimonials_desc); ?></p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <?php foreach ($testimonials as $testimonial):
          if (empty($testimonial['content']))
            continue;
          ?>
          <div class="bg-white rounded-xl p-6 shadow-md">
            <div class="flex items-center gap-1 mb-4">
              <?php
              $stars = isset($testimonial['rating']) ? intval($testimonial['rating']) : 5;
              for ($i = 0; $i < 5; $i++): ?>
                <i class="fas fa-star <?php echo $i < $stars ? 'text-yellow-400' : 'text-gray-300'; ?>"></i>
              <?php endfor; ?>
            </div>
            <p class="text-gray-600 mb-4">"<?php echo esc_html($testimonial['content']); ?>"</p>
            <div class="flex items-center gap-3">
              <?php if (!empty($testimonial['avatar'])): ?>
                <img src="<?php echo esc_url($testimonial['avatar']); ?>" alt="<?php echo esc_attr($testimonial['name']); ?>"
                  class="w-12 h-12 rounded-full">
              <?php else: ?>
                <div class="w-12 h-12 bg-primary-light rounded-full flex items-center justify-center">
                  <i class="fas fa-user text-primary"></i>
                </div>
              <?php endif; ?>
              <div>
                <?php if (!empty($testimonial['name'])): ?>
                  <div class="font-semibold text-primary"><?php echo esc_html($testimonial['name']); ?></div>
                <?php endif; ?>
                <?php if (!empty($testimonial['position'])): ?>
                  <div class="text-sm text-gray-500"><?php echo esc_html($testimonial['position']); ?></div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<!-- FAQ Section -->
<?php if (!empty($faqs)): ?>
  <section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
          <?php echo esc_html($faq_heading); ?>
        </h2>
        <p class="text-xl text-gray-600"><?php echo esc_html($faq_desc); ?></p>
      </div>

      <div class="space-y-4">
        <?php foreach ($faqs as $index => $faq):
          if (empty($faq['question']) && empty($faq['answer']))
            continue;
          ?>
          <div class="bg-gray-50 rounded-lg p-6">
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
<?php endif; ?>

<!-- Technical Requirements -->
<section class="py-16">
  <div class="max-w-7xl mx-auto px-4">
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
        <?php echo esc_html($requirements_heading); ?>
      </h2>
      <p class="text-xl text-gray-600"><?php echo esc_html($requirements_desc); ?></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-4xl mx-auto">
      <div class="bg-white rounded-xl p-6 text-center shadow-md">
        <i class="fab fa-wordpress text-primary text-3xl mb-3"></i>
        <h3 class="font-bold text-primary mb-2">WordPress</h3>
        <p class="text-gray-600 text-sm">Version <?php echo esc_html($requires_wp); ?> or higher</p>
      </div>

      <div class="bg-white rounded-xl p-6 text-center shadow-md">
        <i class="fas fa-code text-primary text-3xl mb-3"></i>
        <h3 class="font-bold text-primary mb-2">PHP</h3>
        <p class="text-gray-600 text-sm">Version <?php echo esc_html($requires_php); ?> or higher</p>
      </div>

      <div class="bg-white rounded-xl p-6 text-center shadow-md">
        <i class="fas fa-database text-primary text-3xl mb-3"></i>
        <h3 class="font-bold text-primary mb-2">MySQL</h3>
        <p class="text-gray-600 text-sm">Version 5.6 or higher</p>
      </div>

      <div class="bg-white rounded-xl p-6 text-center shadow-md">
        <i class="fas fa-memory text-primary text-3xl mb-3"></i>
        <h3 class="font-bold text-primary mb-2">Memory</h3>
        <p class="text-gray-600 text-sm">128MB or higher</p>
      </div>
    </div>
  </div>
</section>

<!-- Plugin Content Section (if exists) -->
<?php if (!empty($meta_fields['plugin_content'])): ?>
  <section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
          <?php echo esc_html($meta_fields['content_heading'] ?: 'Plugin Details'); ?>
        </h2>
        <?php if (!empty($meta_fields['content_desc'])): ?>
          <p class="text-xl text-gray-600"><?php echo esc_html($meta_fields['content_desc']); ?></p>
        <?php endif; ?>
      </div>
      <div class="prose max-w-none">
        <?php echo wp_kses_post($meta_fields['plugin_content']); ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<!-- Final CTA -->
<section class="py-16 gradient-bg text-white">
  <div class="max-w-4xl mx-auto px-4 text-center">
    <h2 class="text-3xl md:text-4xl font-bold mb-6">
      <?php echo esc_html($cta_heading); ?>
    </h2>
    <p class="text-xl mb-8 opacity-90"><?php echo esc_html($cta_desc); ?></p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <?php if ($has_pro && $pro_version_url): ?>
        <a href="<?php echo esc_url($pro_version_url); ?>" target="_blank" rel="noopener noreferrer"
          class="bg-white text-primary px-8 py-3 rounded-lg font-medium text-lg inline-block hover:bg-gray-100 transition">
          <?php echo esc_html($cta_pro_text); ?>
        </a>
      <?php endif; ?>

      <?php if ($free_version_url): ?>
        <a href="<?php echo esc_url($free_version_url); ?>" target="_blank" rel="noopener noreferrer"
          class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-medium text-lg inline-block hover:bg-white hover:text-primary transition">
          <?php echo esc_html($cta_free_text); ?>
        </a>
      <?php endif; ?>
    </div>
    <p class="mt-6 opacity-75">
      <i class="fas fa-shield-alt mr-2"></i>
      <?php echo esc_html($cta_footer_text); ?>
    </p>
  </div>
</section>

<!-- Add JavaScript for interactive elements -->
<script>
  // Demo tabs functionality
  document.querySelectorAll('.demo-tab').forEach(tab => {
    tab.addEventListener('click', function () {
      // Remove active class from all tabs
      document.querySelectorAll('.demo-tab').forEach(t => {
        t.classList.remove('tab-active');
        t.classList.add('text-gray-600');
      });

      // Add active class to clicked tab
      this.classList.add('tab-active');
      this.classList.remove('text-gray-600');

      // Hide all demo content
      document.querySelectorAll('.demo-content').forEach(content => {
        content.classList.add('hidden');
      });

      // Show selected demo content
      document.getElementById(this.dataset.tab).classList.remove('hidden');
    });
  });

  // FAQ toggle
  function toggleFAQ(button) {
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
</script>

<?php get_footer(); ?>

