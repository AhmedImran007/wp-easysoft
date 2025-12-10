<?php
$title        = $attributes['title'] ?? 'Other Ways to Reach Us';
$description  = $attributes['description'] ?? 'Multiple channels to stay connected and get updates';
$contactItems = $attributes['contactItems'] ?? [
  [
    'icon'     => 'fas fa-envelope',
    'title'    => 'Email',
    'subtitle' => 'General inquiries',
    'linkText' => 'support@wpeasysoft.com',
    'linkURL'  => 'mailto:support@wpeasysoft.com',
    'linkType' => 'email'
  ],
  [
    'icon'     => 'fab fa-twitter',
    'title'    => 'Twitter',
    'subtitle' => 'Updates and tips',
    'linkText' => '@wpeasysoft',
    'linkURL'  => '#',
    'linkType' => 'social'
  ],
  [
    'icon'     => 'fab fa-facebook',
    'title'    => 'Facebook',
    'subtitle' => 'Community updates',
    'linkText' => 'WP EasySoft',
    'linkURL'  => '#',
    'linkType' => 'social'
  ],
  [
    'icon'     => 'fab fa-youtube',
    'title'    => 'YouTube',
    'subtitle' => 'Video tutorials',
    'linkText' => 'WP EasySoft TV',
    'linkURL'  => '#',
    'linkType' => 'social'
  ]
];

// Helper function to get link attributes - check if function exists first
if (!function_exists('get_contact_link_attributes')) {
  function get_contact_link_attributes($item)
  {
    $attributes = 'class="inline-block text-primary hover:text-primary-light transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:rounded"';

    if ($item['linkType'] === 'social' || $item['linkType'] === 'website') {
      $attributes .= ' target="_blank" rel="noopener noreferrer"';
    }

    if ($item['linkType'] === 'email') {
      $attributes .= ' title="' . esc_attr__('Send email', 'wp-easysoft') . '"';
    } elseif ($item['linkType'] === 'phone') {
      $attributes .= ' title="' . esc_attr__('Call us', 'wp-easysoft') . '"';
    } else {
      $attributes .= ' title="' . sprintf(esc_attr__('Visit our %s', 'wp-easysoft'), esc_attr($item['title'])) . '"';
    }

    return $attributes;
  }
}
?>

<!-- Contact Info Section -->
<section class="py-16 bg-white not-prose" aria-labelledby="contact-info-title">
  <div class="max-w-7xl mx-auto px-4">
    <!-- Header -->
    <div class="text-center mb-12">
      <h2 id="contact-info-title" class="text-3xl md:text-4xl font-bold text-primary mb-4">
        <?php echo wp_kses_post($title); ?>
      </h2>
      <p class="text-xl text-gray-600">
        <?php echo esc_html($description); ?>
      </p>
    </div>

    <!-- Contact Items Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      <?php foreach ($contactItems as $index => $item): ?>
        <div class="text-center transition-transform hover:scale-105"
          aria-labelledby="contact-item-<?php echo $index; ?>">
          <!-- Icon -->
          <div
            class="bg-primary-light w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 transition-colors hover:bg-primary group">
            <i class="<?php echo esc_attr($item['icon']); ?> text-primary text-2xl transition-colors group-hover:text-white"
              aria-hidden="true"></i>
          </div>

          <!-- Title -->
          <h3 id="contact-item-<?php echo $index; ?>" class="font-semibold text-primary mb-2">
            <?php echo esc_html($item['title']); ?>
          </h3>

          <!-- Subtitle -->
          <p class="text-gray-600 mb-2">
            <?php echo esc_html($item['subtitle']); ?>
          </p>

          <!-- Link -->
          <a href="<?php echo esc_url($item['linkURL']); ?>" <?php echo get_contact_link_attributes($item); ?>>
            <?php echo esc_html($item['linkText']); ?>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
