<?php
$title           = $attributes['title'] ?? 'Upgrade to Easy Map PRO and Unlock Powerful Features';
$buttonText      = $attributes['buttonText'] ?? 'Buy Easy Map PRO';
$buttonURL       = $attributes['buttonURL'] ?? '#';
$features        = $attributes['features'] ?? [
  'Custom Map Themes',
  'Marker Clustering',
  'Location Filters',
  'Unlimited Stores',
  'Priority Support',
  'Automatic Updates'
];
$backgroundStyle = $attributes['backgroundStyle'] ?? 'gradient';
$textColor       = $attributes['textColor'] ?? 'text-white';

// Background classes
$backgroundClasses = [
  'gradient'      => 'gradient-bg',
  'solid-primary' => 'bg-primary',
  'solid-dark'    => 'bg-gray-900'
];

// Button classes based on background
$buttonClasses = [
  'gradient'      => 'bg-white text-primary hover:bg-gray-100',
  'solid-primary' => 'bg-white text-primary hover:bg-gray-100',
  'solid-dark'    => 'bg-white text-gray-900 hover:bg-gray-100'
];
?>

<!-- CTA Section -->
<section
  class="max-w-full py-16 not-prose <?php echo esc_attr($backgroundClasses[$backgroundStyle]); ?> <?php echo esc_attr($textColor); ?>"
  aria-labelledby="cta-title">
  <div class="container mx-auto px-4">
    <div class="max-w-4xl mx-auto text-center">
      <!-- Title -->
      <h2 id="cta-title" class="text-3xl md:text-4xl font-bold mb-6">
        <?php echo wp_kses_post($title); ?>
      </h2>

      <!-- Features Grid -->
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10"
        aria-label="<?php esc_attr_e('PRO Features', 'wp-easysoft'); ?>">
        <?php foreach ($features as $index => $feature): ?>
          <?php if (!empty($feature)): ?>
            <div class="flex items-center space-x-3 justify-center md:justify-start">
              <i class="fas fa-check-circle text-2xl opacity-90" aria-hidden="true"></i>
              <span class="text-lg font-medium">
                <?php echo esc_html($feature); ?>
              </span>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>

      <!-- CTA Button -->
      <a href="<?php echo esc_url($buttonURL); ?>" class="
                    inline-block px-8 py-4 rounded-lg font-medium text-lg
                    transition-all duration-300 hover:scale-105 hover:shadow-2xl
                    focus:outline-none focus:ring-4 focus:ring-white focus:ring-opacity-50
                    <?php echo esc_attr($buttonClasses[$backgroundStyle]); ?>
                " aria-label="<?php echo esc_attr($buttonText); ?>">
        <?php echo esc_html($buttonText); ?>
      </a>
    </div>
  </div>
</section>
