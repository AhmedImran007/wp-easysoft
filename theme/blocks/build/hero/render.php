<?php
$title               = $attributes['title'] ?? 'Build Better WordPress Websites With Powerful & Easy-to-Use Plugins';
$subtitle            = $attributes['subtitle'] ?? 'High-quality plugins for maps, videos, product galleries, and seamless integrations — trusted by WordPress professionals worldwide.';
$primaryButtonText   = $attributes['primaryButtonText'] ?? 'View All Plugins';
$primaryButtonURL    = $attributes['primaryButtonURL'] ?? '#plugins';
$secondaryButtonText = $attributes['secondaryButtonText'] ?? 'Get Easy Map PRO';
$secondaryButtonURL  = $attributes['secondaryButtonURL'] ?? '#';
?>

<!-- Hero Section -->
<section class="max-w-full gradient-bg text-white py-20 not-prose" aria-labelledby="wp-easysoft-hero-title">
  <div class="container mx-auto px-4">
    <div class="max-w-4xl mx-auto text-center">
      <!-- Title -->
      <h2 id="wp-easysoft-hero-title" class="text-4xl md:text-5xl font-bold mb-6 text-white">
        <?php echo wp_kses_post($title); ?>
      </h2>

      <!-- Subtitle -->
      <p class="text-xl mb-8 opacity-90">
        <?php echo esc_html($subtitle); ?>
      </p>

      <!-- CTA Buttons -->
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="<?php echo esc_url($primaryButtonURL); ?>"
          class="btn-primary text-white px-8 py-3 rounded-lg font-medium text-lg inline-block hover:shadow-lg transition-shadow focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-primary"
          aria-label="<?php echo esc_attr($primaryButtonText); ?>">
          <?php echo esc_html($primaryButtonText); ?>
        </a>

        <a href="<?php echo esc_url($secondaryButtonURL); ?>"
          class="btn-secondary bg-white text-primary px-8 py-3 rounded-lg font-medium text-lg inline-block hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
          aria-label="<?php echo esc_attr($secondaryButtonText); ?>">
          <?php echo esc_html($secondaryButtonText); ?>
        </a>
      </div>
    </div>
  </div>
</section>
