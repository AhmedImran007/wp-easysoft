<?php
$title         = $attributes['title'] ?? 'Frequently Asked Questions';
$description   = $attributes['description'] ?? 'Quick answers to common support questions';
$faqs          = $attributes['faqs'] ?? [
  [
    'question' => 'How long does it take to get a response?',
    'answer'   => 'Response times vary by priority level: Critical issues within 2 hours, High within 6 hours, Medium within 24 hours, and Low within 48 hours. PRO users receive priority support with faster response times.',
    'open'     => false
  ],
  [
    'question' => 'Do you offer phone support?',
    'answer'   => 'We currently offer support through tickets, live chat, and our community forum. Phone support is available for Enterprise customers with custom agreements.',
    'open'     => false
  ],
  [
    'question' => 'What information should I include in my support ticket?',
    'answer'   => 'Please include: WordPress version, PHP version, plugin version, detailed description of the issue, steps to reproduce, any error messages, and screenshots if applicable. The more detail you provide, the faster we can help.',
    'open'     => false
  ],
  [
    'question' => 'Is there a limit to support tickets?',
    'answer'   => 'PRO users have unlimited support tickets. Free users can submit up to 3 tickets per month. Community forum is always available for unlimited questions.',
    'open'     => false
  ],
  [
    'question' => 'Do you help with custom development?',
    'answer'   => 'Yes! We offer custom development services for WordPress plugin customization and new feature development. Contact us with your requirements for a quote.',
    'open'     => false
  ]
];
$accordionMode = $attributes['accordionMode'] ?? false;
?>

<!-- FAQ Section with Alpine.js -->
<section class="py-16 not-prose" aria-labelledby="faq-title">
  <div class="max-w-4xl mx-auto px-4">
    <!-- Header -->
    <div class="text-center mb-12">
      <h2 id="faq-title" class="text-3xl md:text-4xl font-bold text-primary mb-4">
        <?php echo wp_kses_post($title); ?>
      </h2>
      <p class="text-xl text-gray-600">
        <?php echo esc_html($description); ?>
      </p>
    </div>

    <!-- FAQ Items with Alpine.js -->
    <div class="space-y-4" x-data="{
                activeId: null,
                accordionMode: <?php echo $accordionMode ? 'true' : 'false'; ?>,
                toggleFAQ(id) {
                    if (this.accordionMode) {
                        this.activeId = this.activeId === id ? null : id;
                    } else {
                        // For non-accordion mode, toggle individual FAQ
                        const isOpen = this.isOpen(id);
                        const element = document.getElementById('faq-answer-' + id);
                        element.setAttribute('aria-hidden', isOpen);
                        element.classList.toggle('hidden', isOpen);
                    }
                },
                isOpen(id) {
                    if (this.accordionMode) {
                        return this.activeId === id;
                    } else {
                        const element = document.getElementById('faq-answer-' + id);
                        return element && element.getAttribute('aria-hidden') === 'false';
                    }
                }
            }" role="list" aria-label="<?php esc_attr_e('Frequently Asked Questions', 'wp-easysoft'); ?>">
      <?php foreach ($faqs as $index => $faq): ?>
        <div class="faq-item bg-white rounded-lg shadow-md p-6 transition-all duration-300 hover:shadow-lg"
          x-data="{ id: <?php echo $index; ?> }" role="listitem">
          <button
            class="w-full text-left flex justify-between items-center font-semibold text-primary hover:text-primary-light transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:rounded-md"
            x-on:click="toggleFAQ(id)" :aria-expanded="isOpen(id)" :aria-controls="'faq-answer-' + id"
            id="faq-question-<?php echo $index; ?>">
            <span><?php echo esc_html($faq['question']); ?></span>
            <i class="fas fa-chevron-down transition-transform duration-300" :class="{ 'rotate-180': isOpen(id) }"
              aria-hidden="true"></i>
          </button>
          <div id="faq-answer-<?php echo $index; ?>" class="overflow-hidden transition-all duration-300" :class="accordionMode ?
                            (activeId === id ? 'mt-4 opacity-100 max-h-[1000px]' : 'max-h-0 opacity-0') :
                            'max-h-0 opacity-0'" x-init="
                            if (!accordionMode && <?php echo $faq['open'] ? 'true' : 'false'; ?>) {
                                $el.classList.remove('max-h-0', 'opacity-0');
                                $el.classList.add('mt-4', 'opacity-100', 'max-h-[1000px]');
                                $el.setAttribute('aria-hidden', 'false');
                            } else {
                                $el.setAttribute('aria-hidden', 'true');
                            }
                        " :aria-hidden="!isOpen(id)" role="region"
            aria-labelledby="faq-question-<?php echo $index; ?>">
            <div class="text-gray-600">
              <?php echo wp_kses_post($faq['answer']); ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
