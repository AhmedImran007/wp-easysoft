<?php
$features = $attributes['features'] ?? [
  ['icon' => 'fas fa-feather-alt', 'text' => 'Lightweight Code'],
  ['icon' => 'fas fa-sync-alt', 'text' => 'Regular Updates'],
  ['icon' => 'fas fa-shopping-basket', 'text' => 'WooCommerce Ready'],
  ['icon' => 'fab fa-wordpress', 'text' => 'Gutenberg Compatible'],
  ['icon' => 'fab fa-elementor', 'text' => 'Elementor Compatible'],
  ['icon' => 'fas fa-headset', 'text' => 'Fast Support'],
];
?>

<!-- Social Proof Section -->
<section class="max-w-full py-12 bg-white"
  aria-label="<?php esc_attr_e('Key Features and Compatibility', 'wp-easysoft'); ?>">
  <div class="container mx-auto px-4">
    <div class="flex flex-wrap justify-center items-center gap-8 md:gap-12">
      <?php foreach ($features as $index => $feature): ?>
        <div class="flex items-center space-x-2 transition-transform hover:scale-105"
          aria-label="<?php echo esc_attr($feature['text']); ?>">
          <i class="<?php echo esc_attr($feature['icon']); ?> text-primary text-xl" aria-hidden="true"></i>
          <span class="text-gray-700 font-medium">
            <?php echo esc_html($feature['text']); ?>
          </span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
