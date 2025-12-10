<?php
$title           = $attributes['title'] ?? 'What Our Customers Say';
$description     = $attributes['description'] ?? 'Join thousands of satisfied WordPress users who trust our plugins';
$testimonials    = $attributes['testimonials'] ?? [
  [
    'name'    => 'Sarah Johnson',
    'role'    => 'Web Developer',
    'company' => 'Creative Agency',
    'content' => 'Easy Map plugin saved me hours of work! The interface is intuitive and the documentation is excellent. My clients love the store locator feature.',
    'rating'  => 5,
    'avatar'  => ''
  ],
  [
    'name'    => 'Mike Chen',
    'role'    => 'E-commerce Manager',
    'company' => 'Online Store',
    'content' => 'The Product Video Gallery transformed our WooCommerce store. Sales increased by 30% after adding video demonstrations to our products.',
    'rating'  => 5,
    'avatar'  => ''
  ],
  [
    'name'    => 'Emily Rodriguez',
    'role'    => 'Blog Owner',
    'company' => 'Travel Blog',
    'content' => 'Lightweight, fast, and exactly what I needed. The support team is incredibly responsive and helpful. Highly recommended!',
    'rating'  => 5,
    'avatar'  => ''
  ]
];
$columns         = $attributes['columns'] ?? '3';
$backgroundColor = $attributes['backgroundColor'] ?? 'bg-white';

// Helper function to render stars - check if function exists first
if (!function_exists('render_testimonial_stars')) {
  function render_testimonial_stars($rating)
  {
    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
      $star_class  = $i <= $rating ? 'text-yellow-400' : 'text-gray-300';
      $stars      .= '<i class="fas fa-star ' . $star_class . '" aria-hidden="true"></i>';
    }
    return $stars;
  }
}

// Grid classes based on columns
$gridClasses = [
  '2' => 'grid md:grid-cols-2 gap-8',
  '3' => 'grid md:grid-cols-2 lg:grid-cols-3 gap-8'
];
?>

<!-- Testimonials Section -->
<section class="max-w-full py-16 not-prose <?php echo esc_attr($backgroundColor); ?>"
  aria-labelledby="testimonials-title">
  <div class="container mx-auto px-4">
    <!-- Header -->
    <div class="text-center mb-12">
      <h2 id="testimonials-title" class="text-3xl md:text-4xl font-bold mb-4">
        <?php echo wp_kses_post($title); ?>
      </h2>
      <p class="text-xl text-gray-600 max-w-2xl mx-auto">
        <?php echo esc_html($description); ?>
      </p>
    </div>

    <!-- Testimonials Grid -->
    <div class="<?php echo esc_attr($gridClasses[$columns]); ?>">
      <?php foreach ($testimonials as $index => $testimonial): ?>
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 transition-all duration-300 hover:shadow-xl"
          aria-labelledby="testimonial-<?php echo $index; ?>">
          <!-- Rating -->
          <div class="flex gap-1 mb-4"
            aria-label="<?php printf(esc_attr__('Rated %d out of 5 stars', 'wp-easysoft'), $testimonial['rating']); ?>">
            <?php echo render_testimonial_stars($testimonial['rating']); ?>
          </div>

          <!-- Content -->
          <blockquote class="text-gray-700 mb-6 text-lg leading-relaxed italic">
            "<?php echo esc_html($testimonial['content']); ?>"
          </blockquote>

          <!-- Author -->
          <div class="flex items-center gap-4">
            <div class="flex-shrink-0">
              <?php if (!empty($testimonial['avatar'])): ?>
                <img src="<?php echo esc_url($testimonial['avatar']); ?>"
                  alt="<?php echo esc_attr($testimonial['name']); ?>" class="w-12 h-12 rounded-full object-cover" />
              <?php else: ?>
                <div
                  class="w-12 h-12 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500 flex items-center justify-center text-white font-bold">
                  <?php echo esc_html(substr($testimonial['name'], 0, 1)); ?>
                </div>
              <?php endif; ?>
            </div>
            <div>
              <div id="testimonial-<?php echo $index; ?>" class="font-bold text-gray-900">
                <?php echo esc_html($testimonial['name']); ?>
              </div>
              <div class="text-sm text-gray-600">
                <?php echo esc_html($testimonial['role']); ?>
                <?php if (!empty($testimonial['company'])): ?>
                  <span> • </span>
                  <?php echo esc_html($testimonial['company']); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
