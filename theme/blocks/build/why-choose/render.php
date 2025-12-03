<?php
$title    = $attributes['title'] ?? 'Why Website Owners Love Our Plugins';
$features = $attributes['features'] ?? [
  [
    'icon'        => 'fas fa-bolt',
    'title'       => 'Lightweight & Fast',
    'description' => 'Optimized coding ensures no performance impact.'
  ],
  [
    'icon'        => 'fas fa-tools',
    'title'       => 'Easy to Use',
    'description' => 'Simple UI, straightforward settings, and clean documentation.'
  ],
  [
    'icon'        => 'fas fa-sync-alt',
    'title'       => 'Regular Updates',
    'description' => 'Continuous improvements and new features.'
  ],
  [
    'icon'        => 'fas fa-headset',
    'title'       => 'Priority Support (PRO)',
    'description' => 'Fast response and real-time assistance for PRO customers.'
  ]
];
?>

<!-- Why Choose WP EasySoft -->
<section class="py-16 bg-gray-50 not-prose" aria-labelledby="why-choose-title">
  <div class="container mx-auto px-4">
    <!-- Title -->
    <h2 id="why-choose-title" class="text-3xl md:text-4xl font-bold text-center mb-12">
      <?php echo wp_kses_post($title); ?>
    </h2>

    <!-- Features Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
      <?php foreach ($features as $index => $feature): ?>
        <div class="card-hover bg-white rounded-xl p-6 text-center shadow-md transition-transform hover:scale-105"
          aria-labelledby="feature-<?php echo $index; ?>">
          <div class="mb-4">
            <i class="<?php echo esc_attr($feature['icon']); ?> feature-icon text-4xl text-primary"
              aria-hidden="true"></i>
          </div>

          <h3 id="feature-<?php echo $index; ?>" class="text-xl font-bold mb-2">
            <?php echo esc_html($feature['title']); ?>
          </h3>

          <p class="text-gray-600">
            <?php echo esc_html($feature['description']); ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
