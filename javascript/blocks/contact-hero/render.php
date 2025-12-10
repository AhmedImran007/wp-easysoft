<?php
$title       = $attributes['title'] ?? 'How Can We Help You?';
$description = $attributes['description'] ?? 'Our dedicated support team is here to help you succeed with our WordPress plugins. Multiple ways to get the assistance you need.';
$stats       = $attributes['stats'] ?? [
  [
    'value' => '24h',
    'label' => 'Average Response Time'
  ],
  [
    'value' => '98%',
    'label' => 'Customer Satisfaction'
  ],
  [
    'value' => '1000+',
    'label' => 'Tickets Resolved'
  ]
];
?>

<!-- Contact Hero Section -->
<section class="gradient-bg text-white py-20 not-prose" aria-labelledby="contact-hero-title">
  <div class="max-w-7xl mx-auto px-4">
    <div class="text-center">
      <!-- Title -->
      <h2 id="contact-hero-title" class="text-4xl md:text-5xl font-bold mb-6">
        <?php echo wp_kses_post($title); ?>
      </h2>

      <!-- Description -->
      <p class="text-xl mb-8 opacity-90 max-w-3xl mx-auto">
        <?php echo esc_html($description); ?>
      </p>

      <!-- Quick Stats -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-3xl mx-auto"
        aria-label="<?php esc_attr_e('Support Statistics', 'wp-easysoft'); ?>">
        <?php foreach ($stats as $index => $stat): ?>
          <div class="text-center">
            <div class="text-4xl font-bold mb-2">
              <?php echo esc_html($stat['value']); ?>
            </div>
            <p class="opacity-90">
              <?php echo esc_html($stat['label']); ?>
            </p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
