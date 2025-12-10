<?php
$title          = $attributes['title'] ?? 'Submit a Support Ticket';
$description    = $attributes['description'] ?? 'Fill out the form below and we\'ll get back to you as soon as possible';
$cf7Shortcode   = $attributes['cf7Shortcode'] ?? '';
$proTips        = $attributes['proTips'] ?? [
    'Include your WordPress version',
    'Mention your PHP version',
    'Describe steps to reproduce the issue',
    'Include error messages if any'
];
$responseTimes  = $attributes['responseTimes'] ?? [
    ['priority' => 'Critical', 'time' => 'Within 2 hours'],
    ['priority' => 'High', 'time' => 'Within 6 hours'],
    ['priority' => 'Medium', 'time' => 'Within 24 hours'],
    ['priority' => 'Low', 'time' => 'Within 48 hours']
];
$proSupportText = $attributes['proSupportText'] ?? 'PRO users get priority support with faster response times and dedicated assistance.';
$proUpgradeLink = $attributes['proUpgradeLink'] ?? '#';

// Check if Contact Form 7 is active
$cf7_active = class_exists('WPCF7');
?>

<!-- Support Ticket Form with CF7 -->
<section id="ticket-form" class="py-16 bg-white not-prose">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
                <?php echo wp_kses_post($title); ?>
            </h2>
            <p class="text-xl text-gray-600">
                <?php echo esc_html($description); ?>
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Contact Form 7 Area -->
            <div class="lg:col-span-2">
                <?php if ($cf7_active && !empty($cf7Shortcode)): ?>
                    <?php echo do_shortcode($cf7Shortcode); ?>
                <?php elseif (!$cf7_active): ?>
                    <div class="bg-red-50 border border-red-200 rounded-lg p-8 text-center">
                        <i class="fas fa-exclamation-circle text-red-500 text-4xl mb-4"></i>
                        <h3 class="text-xl font-bold mb-2"><?php esc_html_e('Contact Form 7 Required', 'wp-easysoft'); ?>
                        </h3>
                        <p class="text-gray-600 mb-4">
                            <?php esc_html_e('Please install and activate the Contact Form 7 plugin to use this form.', 'wp-easysoft'); ?>
                        </p>
                        <?php if (current_user_can('install_plugins')): ?>
                            <a href="<?php echo esc_url(admin_url('plugin-install.php?s=contact+form+7&tab=search&type=term')); ?>"
                                class="btn-primary text-white px-6 py-3 rounded-lg font-medium inline-block">
                                <?php esc_html_e('Install Contact Form 7', 'wp-easysoft'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php elseif (empty($cf7Shortcode)): ?>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-8 text-center">
                        <i class="fas fa-exclamation-triangle text-yellow-500 text-4xl mb-4"></i>
                        <h3 class="text-xl font-bold mb-2"><?php esc_html_e('No Form Shortcode', 'wp-easysoft'); ?></h3>
                        <p class="text-gray-600 mb-4">
                            <?php esc_html_e('Please add a Contact Form 7 shortcode in the block settings.', 'wp-easysoft'); ?>
                        </p>
                        <div class="text-sm text-gray-500 bg-white p-3 rounded border border-gray-200 inline-block">
                            <code>[contact-form-7 id="123" title="Support Ticket"]</code>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-6">
                <!-- Pro Tips -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h3 class="font-semibold text-blue-900 mb-3">
                        <i class="fas fa-lightbulb mr-2" aria-hidden="true"></i>
                        <?php esc_html_e('Pro Tips', 'wp-easysoft'); ?>
                    </h3>
                    <ul class="space-y-2 text-sm text-blue-800"
                        aria-label="<?php esc_attr_e('Helpful tips for support requests', 'wp-easysoft'); ?>">
                        <?php foreach ($proTips as $tip): ?>
                            <li><?php echo esc_html($tip); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Response Times -->
                <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                    <h3 class="font-semibold text-green-900 mb-3">
                        <i class="fas fa-clock mr-2" aria-hidden="true"></i>
                        <?php esc_html_e('Response Times', 'wp-easysoft'); ?>
                    </h3>
                    <ul class="space-y-2 text-sm text-green-800"
                        aria-label="<?php esc_attr_e('Expected response times by priority', 'wp-easysoft'); ?>">
                        <?php foreach ($responseTimes as $item): ?>
                            <li><strong><?php echo esc_html($item['priority']); ?>:</strong>
                                <?php echo esc_html($item['time']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- PRO Support -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                    <h3 class="font-semibold text-yellow-900 mb-3">
                        <i class="fas fa-star mr-2" aria-hidden="true"></i>
                        <?php esc_html_e('PRO Support', 'wp-easysoft'); ?>
                    </h3>
                    <p class="text-sm text-yellow-800 mb-3">
                        <?php echo esc_html($proSupportText); ?>
                    </p>
                    <a href="<?php echo esc_url($proUpgradeLink); ?>"
                        class="text-yellow-700 font-medium text-sm hover:underline focus:outline-none focus:ring-2 focus:ring-yellow-500 rounded">
                        <?php esc_html_e('Upgrade to PRO →', 'wp-easysoft'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
