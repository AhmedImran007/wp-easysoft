<?php
/**
 * Pricing Page Custom Fields
 */

// Add meta boxes for Pricing Page
function wp_easysoft_add_pricing_page_meta_boxes()
{
  global $post;

  // Only add to pages
  if (!isset($post) || $post->post_type !== 'page') {
    return;
  }

  // Check if it's the pricing page template
  $template = get_post_meta($post->ID, '_wp_page_template', true);
  if ($template !== 'page-pricing.php') {
    return;
  }

  add_meta_box(
    'pricing_page_hero_section',
    __('Hero Section', 'wp-easysoft'),
    'wp_easysoft_pricing_page_hero_callback',
    'page',
    'normal',
    'high'
  );

  add_meta_box(
    'pricing_page_features_section',
    __('Features Section', 'wp-easysoft'),
    'wp_easysoft_pricing_page_features_callback',
    'page',
    'normal',
    'high'
  );

  add_meta_box(
    'pricing_page_faq_section',
    __('FAQ Section', 'wp-easysoft'),
    'wp_easysoft_pricing_page_faq_callback',
    'page',
    'normal',
    'high'
  );

  add_meta_box(
    'pricing_page_cta_section',
    __('Call to Action Section', 'wp-easysoft'),
    'wp_easysoft_pricing_page_cta_callback',
    'page',
    'normal',
    'high'
  );
}
add_action('add_meta_boxes', 'wp_easysoft_add_pricing_page_meta_boxes');

// Hero Section Meta Box
function wp_easysoft_pricing_page_hero_callback($post)
{
  wp_nonce_field('wp_easysoft_save_pricing_page_meta', 'wp_easysoft_pricing_page_meta_nonce');

  $hero_title       = get_post_meta($post->ID, '_pricing_hero_title', true);
  $hero_description = get_post_meta($post->ID, '_pricing_hero_description', true);
  ?>

  <div class="meta-box-section">
    <div class="meta-field-row">
      <label for="pricing_hero_title">Hero Title</label>
      <input type="text" id="pricing_hero_title" name="pricing_hero_title"
        value="<?php echo esc_attr($hero_title ?: 'Simple, Transparent Pricing'); ?>" class="regular-text"
        placeholder="Enter hero title">
    </div>

    <div class="meta-field-row">
      <label for="pricing_hero_description">Hero Description</label>
      <textarea id="pricing_hero_description" name="pricing_hero_description" rows="3" class="large-text"
        placeholder="Enter hero description"><?php echo esc_textarea($hero_description ?: 'Choose the perfect plugin for your needs. Start with our free versions or unlock premium features with PRO versions.'); ?></textarea>
    </div>

    <h3>Hero Features</h3>
    <?php
    $hero_features = array(
      array(
        'label'   => 'Feature 1',
        'meta'    => '_pricing_hero_feature_1',
        'default' => '30-day money-back guarantee'
      ),
      array(
        'label'   => 'Feature 2',
        'meta'    => '_pricing_hero_feature_2',
        'default' => '1 year of updates'
      ),
      array(
        'label'   => 'Feature 3',
        'meta'    => '_pricing_hero_feature_3',
        'default' => 'Priority support for PRO'
      ),
    );

    foreach ($hero_features as $feature):
      $value = get_post_meta($post->ID, $feature['meta'], true);
      ?>
      <div class="meta-field-row">
        <label for="<?php echo esc_attr($feature['meta']); ?>"><?php echo esc_html($feature['label']); ?></label>
        <input type="text" id="<?php echo esc_attr($feature['meta']); ?>" name="<?php echo esc_attr($feature['meta']); ?>"
          value="<?php echo esc_attr($value ?: $feature['default']); ?>" class="regular-text"
          placeholder="Enter feature text">
      </div>
    <?php endforeach; ?>
  </div>

  <?php
}

// Features Section Meta Box
function wp_easysoft_pricing_page_features_callback($post)
{
  $features_title       = get_post_meta($post->ID, '_pricing_features_title', true);
  $features_description = get_post_meta($post->ID, '_pricing_features_description', true);
  ?>

  <div class="meta-box-section">
    <div class="meta-field-row">
      <label for="pricing_features_title">Features Section Title</label>
      <input type="text" id="pricing_features_title" name="pricing_features_title"
        value="<?php echo esc_attr($features_title ?: 'Why Choose Our Plugins?'); ?>" class="regular-text"
        placeholder="Enter features title">
    </div>

    <div class="meta-field-row">
      <label for="pricing_features_description">Features Section Description</label>
      <textarea id="pricing_features_description" name="pricing_features_description" rows="2" class="large-text"
        placeholder="Enter features description"><?php echo esc_textarea($features_description ?: 'Professional WordPress solutions built with performance and user experience in mind'); ?></textarea>
    </div>

    <h3>Features Items</h3>
    <?php
    $features_items = array(
      array(
        'title'       => 'Lightweight & Fast',
        'description' => 'Optimized code ensures no performance impact on your site',
        'icon'        => 'fa-bolt'
      ),
      array(
        'title'       => 'Regular Updates',
        'description' => 'Continuous improvements and new features added regularly',
        'icon'        => 'fa-sync-alt'
      ),
      array(
        'title'       => 'Secure & Reliable',
        'description' => 'Built following WordPress best practices and security standards',
        'icon'        => 'fa-shield-alt'
      ),
      array(
        'title'       => 'Expert Support',
        'description' => 'Priority support for PRO users, community support for everyone',
        'icon'        => 'fa-headset'
      ),
    );

    foreach ($features_items as $index => $item):
      $item_title = get_post_meta($post->ID, '_pricing_feature_' . ($index + 1) . '_title', true);
      $item_desc  = get_post_meta($post->ID, '_pricing_feature_' . ($index + 1) . '_description', true);
      $item_icon  = get_post_meta($post->ID, '_pricing_feature_' . ($index + 1) . '_icon', true);
      ?>
      <div class="repeater-item">
        <h4>Feature <?php echo $index + 1; ?></h4>
        <div class="meta-field-row">
          <label for="pricing_feature_<?php echo $index + 1; ?>_title">Title</label>
          <input type="text" id="pricing_feature_<?php echo $index + 1; ?>_title"
            name="pricing_feature_<?php echo $index + 1; ?>_title"
            value="<?php echo esc_attr($item_title ?: $item['title']); ?>" class="regular-text"
            placeholder="Enter feature title">
        </div>

        <div class="meta-field-row">
          <label for="pricing_feature_<?php echo $index + 1; ?>_description">Description</label>
          <textarea id="pricing_feature_<?php echo $index + 1; ?>_description"
            name="pricing_feature_<?php echo $index + 1; ?>_description" rows="2" class="large-text"
            placeholder="Enter feature description"><?php echo esc_textarea($item_desc ?: $item['description']); ?></textarea>
        </div>

        <div class="meta-field-row">
          <label for="pricing_feature_<?php echo $index + 1; ?>_icon">FontAwesome Icon Class</label>
          <input type="text" id="pricing_feature_<?php echo $index + 1; ?>_icon"
            name="pricing_feature_<?php echo $index + 1; ?>_icon"
            value="<?php echo esc_attr($item_icon ?: $item['icon']); ?>" class="regular-text" placeholder="e.g., fa-bolt">
          <p class="description">See available icons at <a href="https://fontawesome.com/icons"
              target="_blank">FontAwesome</a></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <?php
}

// FAQ Section Meta Box - FIXED VERSION
function wp_easysoft_pricing_page_faq_callback($post)
{
  $faq_title       = get_post_meta($post->ID, '_pricing_faq_title', true);
  $faq_description = get_post_meta($post->ID, '_pricing_faq_description', true);

  // Get existing FAQs or use defaults
  $faqs_json = get_post_meta($post->ID, '_pricing_faqs', true);

  // Default FAQs
  $default_faqs = array(
    array(
      'question' => 'Can I try plugins before purchasing?',
      'answer'   => 'Yes! All our plugins have free versions you can download and test before deciding to upgrade to PRO. The free versions include core features so you can evaluate if the plugin meets your needs.'
    ),
    array(
      'question' => 'When will other PRO versions be available?',
      'answer'   => 'We\'re actively developing PRO versions for many of our plugins. Sign up for our newsletter to get notified as soon as they\'re released.'
    ),
    array(
      'question' => 'Can I upgrade from Free to PRO later?',
      'answer'   => 'Absolutely! You can upgrade to PRO at any time. Your settings and data will be preserved during the upgrade process. Simply purchase the PRO version and install it over your existing free plugin.'
    ),
    array(
      'question' => 'What happens after the first year?',
      'answer'   => 'After the first year, you can renew your PRO license at 50% off the original price to continue receiving updates and priority support. Your plugins will continue to work even if you don\'t renew, but you won\'t receive updates or support.'
    ),
    array(
      'question' => 'Do you offer refunds?',
      'answer'   => 'Yes! We offer a 30-day money-back guarantee on all PRO purchases. If you\'re not satisfied with our plugins for any reason, simply contact us within 30 days for a full refund.'
    ),
    array(
      'question' => 'Are plugins compatible with latest WordPress?',
      'answer'   => 'Yes! All our plugins are regularly tested and updated to ensure compatibility with the latest WordPress version. We also maintain backward compatibility with several previous WordPress versions.'
    ),
  );

  // Initialize FAQs array
  $faqs = $default_faqs;

  // Try to decode JSON if it exists and is valid
  if (!empty($faqs_json)) {
    $decoded_faqs = json_decode($faqs_json, true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded_faqs) && !empty($decoded_faqs)) {
      $faqs = $decoded_faqs;
    }
  }
  ?>

  <div class="meta-box-section">
    <div class="meta-field-row">
      <label for="pricing_faq_title">FAQ Section Title</label>
      <input type="text" id="pricing_faq_title" name="pricing_faq_title"
        value="<?php echo esc_attr($faq_title ?: 'Frequently Asked Questions'); ?>" class="regular-text"
        placeholder="Enter FAQ title">
    </div>

    <div class="meta-field-row">
      <label for="pricing_faq_description">FAQ Section Description</label>
      <textarea id="pricing_faq_description" name="pricing_faq_description" rows="2" class="large-text"
        placeholder="Enter FAQ description"><?php echo esc_textarea($faq_description ?: 'Everything you need to know about our pricing'); ?></textarea>
    </div>

    <h3>FAQ Items</h3>
    <div id="faq-repeater">
      <?php if (is_array($faqs) && !empty($faqs)): ?>
        <?php foreach ($faqs as $index => $faq): ?>
          <?php if (is_array($faq) && isset($faq['question']) && isset($faq['answer'])): ?>
            <div class="repeater-item" data-index="<?php echo $index; ?>">
              <h4>FAQ #<?php echo $index + 1; ?></h4>
              <div class="meta-field-row">
                <label>Question</label>
                <input type="text" name="pricing_faq[<?php echo $index; ?>][question]"
                  value="<?php echo esc_attr($faq['question']); ?>" class="regular-text" placeholder="Enter question">
              </div>

              <div class="meta-field-row">
                <label>Answer</label>
                <textarea name="pricing_faq[<?php echo $index; ?>][answer]" rows="3" class="large-text"
                  placeholder="Enter answer"><?php echo esc_textarea($faq['answer']); ?></textarea>
              </div>

              <button type="button" class="button button-small remove-faq-item" onclick="removeFAQItem(this)">Remove
                FAQ</button>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <button type="button" class="button" onclick="addFAQItem()">Add FAQ Item</button>
  </div>

  <script>
    function addFAQItem() {
      const container = document.getElementById('faq-repeater');
      const items = container.querySelectorAll('.repeater-item');
      const newIndex = items.length;

      const html = `
            <div class="repeater-item" data-index="${newIndex}">
                <h4>FAQ #${newIndex + 1}</h4>
                <div class="meta-field-row">
                    <label>Question</label>
                    <input type="text" name="pricing_faq[${newIndex}][question]"
                           value="" class="regular-text" placeholder="Enter question">
                </div>

                <div class="meta-field-row">
                    <label>Answer</label>
                    <textarea name="pricing_faq[${newIndex}][answer]"
                              rows="3" class="large-text"
                              placeholder="Enter answer"></textarea>
                </div>

                <button type="button" class="button button-small remove-faq-item" onclick="removeFAQItem(this)">Remove FAQ</button>
            </div>
        `;

      container.insertAdjacentHTML('beforeend', html);
    }

    function removeFAQItem(button) {
      if (confirm('Are you sure you want to remove this FAQ?')) {
        button.closest('.repeater-item').remove();
        // Re-index items
        const container = document.getElementById('faq-repeater');
        const items = container.querySelectorAll('.repeater-item');
        items.forEach((item, index) => {
          item.setAttribute('data-index', index);
          // Update input names
          const questionInput = item.querySelector('input[name*="question"]');
          const answerTextarea = item.querySelector('textarea[name*="answer"]');
          if (questionInput) {
            questionInput.setAttribute('name', `pricing_faq[${index}][question]`);
          }
          if (answerTextarea) {
            answerTextarea.setAttribute('name', `pricing_faq[${index}][answer]`);
          }
          // Update heading
          const heading = item.querySelector('h4');
          if (heading) {
            heading.textContent = `FAQ #${index + 1}`;
          }
        });
      }
    }
  </script>

  <?php
}

// CTA Section Meta Box
function wp_easysoft_pricing_page_cta_callback($post)
{
  $cta_title         = get_post_meta($post->ID, '_pricing_cta_title', true);
  $cta_description   = get_post_meta($post->ID, '_pricing_cta_description', true);
  $cta_button_1_text = get_post_meta($post->ID, '_pricing_cta_button_1_text', true);
  $cta_button_1_url  = get_post_meta($post->ID, '_pricing_cta_button_1_url', true);
  $cta_button_2_text = get_post_meta($post->ID, '_pricing_cta_button_2_text', true);
  $cta_button_2_url  = get_post_meta($post->ID, '_pricing_cta_button_2_url', true);
  ?>

  <div class="meta-box-section">
    <div class="meta-field-row">
      <label for="pricing_cta_title">CTA Section Title</label>
      <input type="text" id="pricing_cta_title" name="pricing_cta_title"
        value="<?php echo esc_attr($cta_title ?: 'Ready to Get Started?'); ?>" class="regular-text"
        placeholder="Enter CTA title">
    </div>

    <div class="meta-field-row">
      <label for="pricing_cta_description">CTA Section Description</label>
      <textarea id="pricing_cta_description" name="pricing_cta_description" rows="2" class="large-text"
        placeholder="Enter CTA description"><?php echo esc_textarea($cta_description ?: 'Choose the perfect plugin for your WordPress needs'); ?></textarea>
    </div>

    <h3>Buttons</h3>

    <div class="meta-field-row">
      <label for="pricing_cta_button_1_text">Button 1 Text</label>
      <input type="text" id="pricing_cta_button_1_text" name="pricing_cta_button_1_text"
        value="<?php echo esc_attr($cta_button_1_text ?: 'Browse All Plugins'); ?>" class="regular-text"
        placeholder="Enter button text">
    </div>

    <div class="meta-field-row">
      <label for="pricing_cta_button_1_url">Button 1 URL</label>
      <input type="url" id="pricing_cta_button_1_url" name="pricing_cta_button_1_url"
        value="<?php echo esc_attr($cta_button_1_url ?: get_post_type_archive_link('wp_plugin') ?: '#'); ?>"
        class="regular-text" placeholder="Enter button URL">
    </div>

    <div class="meta-field-row">
      <label for="pricing_cta_button_2_text">Button 2 Text</label>
      <input type="text" id="pricing_cta_button_2_text" name="pricing_cta_button_2_text"
        value="<?php echo esc_attr($cta_button_2_text ?: 'Get Started'); ?>" class="regular-text"
        placeholder="Enter button text">
    </div>

    <div class="meta-field-row">
      <label for="pricing_cta_button_2_url">Button 2 URL</label>
      <input type="url" id="pricing_cta_button_2_url" name="pricing_cta_button_2_url"
        value="<?php echo esc_attr($cta_button_2_url ?: '#'); ?>" class="regular-text" placeholder="Enter button URL">
    </div>
  </div>

  <?php
}

// Save Pricing Page Meta Data
function wp_easysoft_save_pricing_page_meta($post_id)
{
  // Security checks
  if (
    !isset($_POST['wp_easysoft_pricing_page_meta_nonce']) ||
    !wp_verify_nonce($_POST['wp_easysoft_pricing_page_meta_nonce'], 'wp_easysoft_save_pricing_page_meta')
  ) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  if (!current_user_can('edit_page', $post_id)) {
    return;
  }

  // Save hero section
  $hero_fields = array(
    'pricing_hero_title',
    'pricing_hero_description',
    '_pricing_hero_feature_1',
    '_pricing_hero_feature_2',
    '_pricing_hero_feature_3'
  );

  foreach ($hero_fields as $field) {
    if (isset($_POST[$field])) {
      update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
    }
  }

  // Save features section
  $features_fields = array(
    'pricing_features_title',
    'pricing_features_description'
  );

  foreach ($features_fields as $field) {
    if (isset($_POST[$field])) {
      update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
    }
  }

  // Save feature items (4 items)
  for ($i = 1; $i <= 4; $i++) {
    $title_field = 'pricing_feature_' . $i . '_title';
    $desc_field  = 'pricing_feature_' . $i . '_description';
    $icon_field  = 'pricing_feature_' . $i . '_icon';

    if (isset($_POST[$title_field])) {
      update_post_meta($post_id, '_' . $title_field, sanitize_text_field($_POST[$title_field]));
    }
    if (isset($_POST[$desc_field])) {
      update_post_meta($post_id, '_' . $desc_field, sanitize_textarea_field($_POST[$desc_field]));
    }
    if (isset($_POST[$icon_field])) {
      update_post_meta($post_id, '_' . $icon_field, sanitize_text_field($_POST[$icon_field]));
    }
  }

  // Save FAQ section
  if (isset($_POST['pricing_faq_title'])) {
    update_post_meta($post_id, '_pricing_faq_title', sanitize_text_field($_POST['pricing_faq_title']));
  }
  if (isset($_POST['pricing_faq_description'])) {
    update_post_meta($post_id, '_pricing_faq_description', sanitize_textarea_field($_POST['pricing_faq_description']));
  }

  // Save FAQs
  if (isset($_POST['pricing_faq']) && is_array($_POST['pricing_faq'])) {
    $faqs = array();
    foreach ($_POST['pricing_faq'] as $faq) {
      if (isset($faq['question'], $faq['answer'])) {
        $question = trim(sanitize_text_field($faq['question']));
        $answer   = trim(sanitize_textarea_field($faq['answer']));

        if (!empty($question) && !empty($answer)) {
          $faqs[] = array(
            'question' => $question,
            'answer'   => $answer
          );
        }
      }
    }

    if (!empty($faqs)) {
      update_post_meta($post_id, '_pricing_faqs', wp_json_encode($faqs, JSON_UNESCAPED_UNICODE));
    } else {
      delete_post_meta($post_id, '_pricing_faqs');
    }
  }

  // Save CTA section
  $cta_fields = array(
    'pricing_cta_title',
    'pricing_cta_description',
    'pricing_cta_button_1_text',
    'pricing_cta_button_1_url',
    'pricing_cta_button_2_text',
    'pricing_cta_button_2_url'
  );

  foreach ($cta_fields as $field) {
    if (isset($_POST[$field])) {
      update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
    }
  }
}
add_action('save_post_page', 'wp_easysoft_save_pricing_page_meta');

// Helper function to get pricing page meta - FIXED VERSION
function wp_easysoft_get_pricing_page_meta($page_id = null)
{
  if (!$page_id) {
    global $post;
    $page_id = $post->ID;
  }

  $meta = array();

  // Hero section
  $meta['hero_title']       = get_post_meta($page_id, '_pricing_hero_title', true) ?: 'Simple, Transparent Pricing';
  $meta['hero_description'] = get_post_meta($page_id, '_pricing_hero_description', true) ?: 'Choose the perfect plugin for your needs. Start with our free versions or unlock premium features with PRO versions.';
  $meta['hero_feature_1']   = get_post_meta($page_id, '_pricing_hero_feature_1', true) ?: '30-day money-back guarantee';
  $meta['hero_feature_2']   = get_post_meta($page_id, '_pricing_hero_feature_2', true) ?: '1 year of updates';
  $meta['hero_feature_3']   = get_post_meta($page_id, '_pricing_hero_feature_3', true) ?: 'Priority support for PRO';

  // Features section
  $meta['features_title']       = get_post_meta($page_id, '_pricing_features_title', true) ?: 'Why Choose Our Plugins?';
  $meta['features_description'] = get_post_meta($page_id, '_pricing_features_description', true) ?: 'Professional WordPress solutions built with performance and user experience in mind';

  // Feature items
  for ($i = 1; $i <= 4; $i++) {
    $meta['feature_' . $i . '_title']       = get_post_meta($page_id, '_pricing_feature_' . $i . '_title', true);
    $meta['feature_' . $i . '_description'] = get_post_meta($page_id, '_pricing_feature_' . $i . '_description', true);
    $meta['feature_' . $i . '_icon']        = get_post_meta($page_id, '_pricing_feature_' . $i . '_icon', true);
  }

  // FAQ section
  $meta['faq_title']       = get_post_meta($page_id, '_pricing_faq_title', true) ?: 'Frequently Asked Questions';
  $meta['faq_description'] = get_post_meta($page_id, '_pricing_faq_description', true) ?: 'Everything you need to know about our pricing';

  // Default FAQs
  $default_faqs = array(
    array(
      'question' => 'Can I try plugins before purchasing?',
      'answer'   => 'Yes! All our plugins have free versions you can download and test before deciding to upgrade to PRO. The free versions include core features so you can evaluate if the plugin meets your needs.'
    ),
    array(
      'question' => 'When will other PRO versions be available?',
      'answer'   => 'We\'re actively developing PRO versions for many of our plugins. Sign up for our newsletter to get notified as soon as they\'re released.'
    ),
    array(
      'question' => 'Can I upgrade from Free to PRO later?',
      'answer'   => 'Absolutely! You can upgrade to PRO at any time. Your settings and data will be preserved during the upgrade process. Simply purchase the PRO version and install it over your existing free plugin.'
    ),
    array(
      'question' => 'What happens after the first year?',
      'answer'   => 'After the first year, you can renew your PRO license at 50% off the original price to continue receiving updates and priority support. Your plugins will continue to work even if you don\'t renew, but you won\'t receive updates or support.'
    ),
    array(
      'question' => 'Do you offer refunds?',
      'answer'   => 'Yes! We offer a 30-day money-back guarantee on all PRO purchases. If you\'re not satisfied with our plugins for any reason, simply contact us within 30 days for a full refund.'
    ),
    array(
      'question' => 'Are plugins compatible with latest WordPress?',
      'answer'   => 'Yes! All our plugins are regularly tested and updated to ensure compatibility with the latest WordPress version. We also maintain backward compatibility with several previous WordPress versions.'
    ),
  );

  // Get stored FAQs
  $faqs_json    = get_post_meta($page_id, '_pricing_faqs', true);
  $meta['faqs'] = $default_faqs;

  if (!empty($faqs_json)) {
    $decoded_faqs = json_decode($faqs_json, true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded_faqs) && !empty($decoded_faqs)) {
      $meta['faqs'] = $decoded_faqs;
    }
  }

  // CTA section
  $meta['cta_title']         = get_post_meta($page_id, '_pricing_cta_title', true) ?: 'Ready to Get Started?';
  $meta['cta_description']   = get_post_meta($page_id, '_pricing_cta_description', true) ?: 'Choose the perfect plugin for your WordPress needs';
  $meta['cta_button_1_text'] = get_post_meta($page_id, '_pricing_cta_button_1_text', true) ?: 'Browse All Plugins';
  $meta['cta_button_1_url']  = get_post_meta($page_id, '_pricing_cta_button_1_url', true) ?: (get_post_type_archive_link('wp_plugin') ?: '#');
  $meta['cta_button_2_text'] = get_post_meta($page_id, '_pricing_cta_button_2_text', true) ?: 'Get Started';
  $meta['cta_button_2_url']  = get_post_meta($page_id, '_pricing_cta_button_2_url', true) ?: '#';

  return $meta;
}

// Add admin CSS for meta boxes
function wp_easysoft_pricing_page_admin_styles()
{
  echo '<style>
        .meta-box-section {
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
        }
        .meta-box-section h3 {
            margin-top: 0;
            color: #1F3266;
            border-bottom: 2px solid #1F3266;
            padding-bottom: 8px;
        }
        .meta-box-section h4 {
            margin-top: 15px;
            color: #333;
        }
        .repeater-item {
            background: white;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .repeater-item h4 {
            margin-top: 0;
            margin-bottom: 15px;
            color: #1F3266;
        }
        .meta-field-row {
            margin-bottom: 15px;
        }
        .meta-field-row label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #333;
        }
        .meta-field-row .description {
            margin-top: 5px;
            font-style: italic;
            color: #666;
        }
        .remove-faq-item {
            margin-top: 10px;
        }
    </style>';
}
add_action('admin_head', 'wp_easysoft_pricing_page_admin_styles');
