<?php
$title               = $attributes['title'] ?? '🚀 Introducing Easy Map — The Ultimate WordPress Store Locator Plugin';
$description         = $attributes['description'] ?? 'Create beautiful, customizable maps using Google Maps, OpenStreetMap, or Leaflet — with powerful features like clustering, filters, search, and unlimited locations.';
$features            = $attributes['features'] ?? [
  'Google Maps + OSM + Leaflet',
  'Store Locator',
  'Clustering',
  'Unlimited Markers',
  'Custom Map Styles',
  'WooCommerce Support'
];
$primaryButtonText   = $attributes['primaryButtonText'] ?? 'Get Easy Map PRO';
$primaryButtonURL    = $attributes['primaryButtonURL'] ?? '#';
$secondaryButtonText = $attributes['secondaryButtonText'] ?? 'Free Version on WP.org';
$secondaryButtonURL  = $attributes['secondaryButtonURL'] ?? '#';
$imageURL            = $attributes['imageURL'] ?? 'https://picsum.photos/seed/easymapinterface/600/400.jpg';
$imageAlt            = $attributes['imageAlt'] ?? 'Easy Map Interface';
?>

<!-- Featured Plugin Section -->
<section class="max-w-full py-16 bg-gray-50" aria-labelledby="featured-plugin-title">
  <div class="container mx-auto px-4">
    <div class="max-w-5xl mx-auto">
      <!-- Title -->
      <h2 id="featured-plugin-title" class="text-3xl md:text-4xl font-bold text-center mb-4">
        <?php echo wp_kses_post($title); ?>
      </h2>

      <!-- Description -->
      <p class="text-xl text-gray-600 text-center mb-10 max-w-3xl mx-auto">
        <?php echo esc_html($description); ?>
      </p>

      <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="md:flex">
          <!-- Left Content -->
          <div class="md:w-1/2 p-8 flex flex-col justify-center">
            <!-- Features -->
            <div class="flex flex-wrap gap-2 mb-6" aria-label="<?php esc_attr_e('Plugin Features', 'wp-easysoft'); ?>">
              <?php foreach ($features as $feature): ?>
                <?php if (!empty($feature)): ?>
                  <span class="bg-primary-light text-primary px-3 py-1 rounded-full text-sm font-medium">
                    <?php echo esc_html($feature); ?>
                  </span>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
              <a href="<?php echo esc_url($primaryButtonURL); ?>"
                class="btn-primary text-white px-6 py-3 rounded-lg font-medium text-center hover:shadow-lg transition-shadow focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                aria-label="<?php echo esc_attr($primaryButtonText); ?>">
                <?php echo esc_html($primaryButtonText); ?>
              </a>
              <a href="<?php echo esc_url($secondaryButtonURL); ?>"
                class="btn-secondary border border-primary text-primary px-6 py-3 rounded-lg font-medium text-center hover:bg-primary-light transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                aria-label="<?php echo esc_attr($secondaryButtonText); ?>">
                <?php echo esc_html($secondaryButtonText); ?>
              </a>
            </div>
          </div>

          <!-- Right Image -->
          <div class="md:w-1/2">
            <img src="<?php echo esc_url($imageURL); ?>" alt="<?php echo esc_attr($imageAlt); ?>"
              class="w-full h-64 md:h-full object-cover">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
