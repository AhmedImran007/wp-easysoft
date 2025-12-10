<?php
$title       = $attributes['title'] ?? 'Choose Your Support Channel';
$description = $attributes['description'] ?? 'Different ways to get help based on your needs and urgency';
$options     = $attributes['options'] ?? [
  [
    'title'        => 'Support Ticket',
    'icon'         => 'fas fa-ticket-alt',
    'description'  => 'Get personalized help from our expert team for complex issues',
    'features'     => [
      'Priority response for PRO users',
      'Detailed troubleshooting',
      'Screen sharing available'
    ],
    'buttonText'   => 'Open Ticket',
    'buttonURL'    => '#ticket-form',
    'buttonStyle'  => 'primary',
    'buttonAction' => 'link'
  ],
  [
    'title'        => 'Live Chat',
    'icon'         => 'fas fa-comments',
    'description'  => 'Get instant help for quick questions and guidance',
    'features'     => [
      'Available weekdays 9-5 EST',
      'Instant responses',
      'Real-time collaboration'
    ],
    'buttonText'   => 'Start Chat',
    'buttonURL'    => '#',
    'buttonStyle'  => 'success',
    'buttonAction' => 'link'
  ],
  [
    'title'        => 'Community Forum',
    'icon'         => 'fas fa-users',
    'description'  => 'Connect with other users and share solutions',
    'features'     => [
      'Free for everyone',
      'Community knowledge base',
      'User-generated solutions'
    ],
    'buttonText'   => 'Visit Forum',
    'buttonURL'    => '#',
    'buttonStyle'  => 'outline',
    'buttonAction' => 'link'
  ],
  [
    'title'        => 'Documentation',
    'icon'         => 'fas fa-book',
    'description'  => 'Self-service guides and tutorials for all features',
    'features'     => [
      'Step-by-step guides',
      'Video tutorials',
      'Code examples'
    ],
    'buttonText'   => 'Browse Docs',
    'buttonURL'    => '#',
    'buttonStyle'  => 'outline',
    'buttonAction' => 'link'
  ]
];

// Helper function for button classes - check if function exists first
if (!function_exists('get_support_button_class')) {
  function get_support_button_class($style)
  {
    switch ($style) {
      case 'primary':
        return 'btn-primary text-white hover:shadow-lg';
      case 'success':
        return 'bg-green-500 hover:bg-green-600 text-white';
      case 'outline':
        return 'border border-primary text-primary hover:bg-primary-light';
      default:
        return 'btn-primary text-white';
    }
  }
}
?>

<!-- Support Options Section -->
<section class="py-16 not-prose" aria-labelledby="support-options-title">
  <div class="max-w-7xl mx-auto px-4">
    <!-- Header -->
    <div class="text-center mb-12">
      <h2 id="support-options-title" class="text-3xl md:text-4xl font-bold text-primary mb-4">
        <?php echo wp_kses_post($title); ?>
      </h2>
      <p class="text-xl text-gray-600 max-w-2xl mx-auto">
        <?php echo esc_html($description); ?>
      </p>
    </div>

    <!-- Support Options Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      <?php foreach ($options as $index => $option): ?>
        <div class="support-card bg-white rounded-xl shadow-lg p-8 text-center transition-transform hover:scale-105"
          aria-labelledby="support-option-<?php echo $index; ?>">
          <!-- Icon -->
          <div class="bg-primary-light w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="<?php echo esc_attr($option['icon']); ?> text-primary text-2xl" aria-hidden="true"></i>
          </div>

          <!-- Title -->
          <h3 id="support-option-<?php echo $index; ?>" class="text-xl font-bold text-primary mb-3">
            <?php echo esc_html($option['title']); ?>
          </h3>

          <!-- Description -->
          <p class="text-gray-600 mb-6">
            <?php echo esc_html($option['description']); ?>
          </p>

          <!-- Features List -->
          <ul class="text-left text-sm text-gray-600 mb-6 space-y-2"
            aria-label="<?php printf(esc_attr__('Features for %s', 'wp-easysoft'), $option['title']); ?>">
            <?php foreach ($option['features'] as $feature): ?>
              <li class="flex items-center gap-2">
                <i class="fas fa-check text-green-500" aria-hidden="true"></i>
                <span><?php echo esc_html($feature); ?></span>
              </li>
            <?php endforeach; ?>
          </ul>

          <!-- Action Button -->
          <?php if ($option['buttonAction'] === 'link'): ?>
            <a href="<?php echo esc_url($option['buttonURL']); ?>"
              class="<?php echo esc_attr(get_support_button_class($option['buttonStyle'])); ?> px-6 py-3 rounded-lg font-medium inline-block transition focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
              aria-label="<?php printf(esc_attr__('Open %s', 'wp-easysoft'), $option['title']); ?>">
              <?php echo esc_html($option['buttonText']); ?>
            </a>
          <?php else: ?>
            <button onclick="console.log('Action for <?php echo esc_js($option['title']); ?>')"
              class="<?php echo esc_attr(get_support_button_class($option['buttonStyle'])); ?> px-6 py-3 rounded-lg font-medium transition focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
              aria-label="<?php printf(esc_attr__('Open %s', 'wp-easysoft'), $option['title']); ?>">
              <?php echo esc_html($option['buttonText']); ?>
            </button>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
