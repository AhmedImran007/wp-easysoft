<?php
/**
 * WP Plugin Custom Post Type and Meta Fields
 */

// Remove default editor support for wp_plugin post type
function wp_easysoft_remove_wp_plugin_editor()
{
  remove_post_type_support('wp_plugin', 'editor');
  remove_post_type_support('wp_plugin', 'excerpt');
}
add_action('init', 'wp_easysoft_remove_wp_plugin_editor');

// Register WP Plugin CPT with "wordpress-plugins" slug
function wp_easysoft_register_wp_plugin_post_type()
{
  $labels = array(
    'name'                  => _x('WP Plugins', 'Post Type General Name', 'wp-easysoft'),
    'singular_name'         => _x('WP Plugin', 'Post Type Singular Name', 'wp-easysoft'),
    'menu_name'             => __('WP Plugins', 'wp-easysoft'),
    'name_admin_bar'        => __('WP Plugin', 'wp-easysoft'),
    'archives'              => __('WP Plugin Archives', 'wp-easysoft'),
    'attributes'            => __('WP Plugin Attributes', 'wp-easysoft'),
    'parent_item_colon'     => __('Parent WP Plugin:', 'wp-easysoft'),
    'all_items'             => __('All WP Plugins', 'wp-easysoft'),
    'add_new_item'          => __('Add New WP Plugin', 'wp-easysoft'),
    'add_new'               => __('Add New', 'wp-easysoft'),
    'new_item'              => __('New WP Plugin', 'wp-easysoft'),
    'edit_item'             => __('Edit WP Plugin', 'wp-easysoft'),
    'update_item'           => __('Update WP Plugin', 'wp-easysoft'),
    'view_item'             => __('View WP Plugin', 'wp-easysoft'),
    'view_items'            => __('View WP Plugins', 'wp-easysoft'),
    'search_items'          => __('Search WP Plugin', 'wp-easysoft'),
    'not_found'             => __('Not found', 'wp-easysoft'),
    'not_found_in_trash'    => __('Not found in Trash', 'wp-easysoft'),
    'featured_image'        => __('WP Plugin Icon', 'wp-easysoft'),
    'set_featured_image'    => __('Set plugin icon', 'wp-easysoft'),
    'remove_featured_image' => __('Remove plugin icon', 'wp-easysoft'),
    'use_featured_image'    => __('Use as plugin icon', 'wp-easysoft'),
    'insert_into_item'      => __('Insert into plugin', 'wp-easysoft'),
    'uploaded_to_this_item' => __('Uploaded to this plugin', 'wp-easysoft'),
    'items_list'            => __('WP Plugins list', 'wp-easysoft'),
    'items_list_navigation' => __('WP Plugins list navigation', 'wp-easysoft'),
    'filter_items_list'     => __('Filter plugins list', 'wp-easysoft'),
  );

  $args = array(
    'label'               => __('WP Plugin', 'wp-easysoft'),
    'description'         => __('WordPress Plugin Showcase', 'wp-easysoft'),
    'labels'              => $labels,
    'supports'            => array('title', 'thumbnail', 'custom-fields'),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-admin-plugins',
    'show_in_admin_bar'   => true,
    'show_in_nav_menus'   => true,
    'can_export'          => true,
    'has_archive'         => true, // Will use "wordpress-plugins" as archive
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
    'show_in_rest'        => false,
    'rewrite'             => array(
      'slug'       => 'wordpress-plugins', // Single: /wordpress-plugins/easy-map-plugin/
      'with_front' => false,
    ),
    'query_var'           => true,
  );

  register_post_type('wp_plugin', $args);
}
add_action('init', 'wp_easysoft_register_wp_plugin_post_type', 0);

// Remove the custom permalink filter since we're using the default CPT slug
// No need for wp_easysoft_wp_plugin_permalink function anymore

// Add comprehensive meta boxes for WP Plugin
function wp_easysoft_add_wp_plugin_meta_boxes()
{
  add_meta_box(
    'wp_plugin_comprehensive_details',
    __('Plugin Details', 'wp-easysoft'),
    'wp_easysoft_wp_plugin_meta_box_callback',
    'wp_plugin',
    'normal',
    'high'
  );
}
add_action('add_meta_boxes', 'wp_easysoft_add_wp_plugin_meta_boxes');

// Helper function to get all meta fields with defaults
function wp_easysoft_get_wp_plugin_meta_fields($post_id)
{
  // Basic text fields
  $basic_fields = array(
    'tagline'                => '',
    'short_description'      => '',
    'version'                => '1.0',
    'tested_up_to'           => '6.4',
    'requires_php'           => '7.4',
    'requires_wp'            => '5.0',
    'rating'                 => '4.9',
    'active_installs'        => '',
    'free_version_url'       => '',
    'pro_version_url'        => '',
    'woocommerce_compatible' => '0',
    'has_pro'                => '0',
  );

  // Dynamic section headings
  $dynamic_text_fields = array(
    'features_heading'     => 'Powerful Features',
    'features_desc'        => '',
    'demo_heading'         => 'See Plugin in Action',
    'demo_desc'            => 'Explore the features through our interactive demo',
    'use_cases_heading'    => 'Perfect For',
    'use_cases_desc'       => 'Ideal solution for various WordPress projects',
    'pricing_heading'      => 'Choose Your Plan',
    'pricing_desc'         => 'Start with our free version or unlock all features with PRO',
    'testimonials_heading' => 'What Our Users Say',
    'testimonials_desc'    => 'Join thousands of satisfied users worldwide',
    'faq_heading'          => 'Frequently Asked Questions',
    'faq_desc'             => '',
    'requirements_heading' => 'Technical Requirements',
    'requirements_desc'    => 'Make sure your site meets these requirements',
    'cta_heading'          => 'Ready to Get Started?',
    'cta_desc'             => '',
    'content_heading'      => 'Plugin Details',
    'content_desc'         => '',
  );

  // Button texts
  $button_text_fields = array(
    'pro_button_text'         => '',
    'demo_button_text'        => 'View Demo',
    'updates_text'            => 'Regular Updates',
    'compatibility_text'      => 'WooCommerce Compatible',
    'try_demo_text'           => 'Try Live Demo',
    'free_button_text'        => 'Download Free Version',
    'pro_button_text_pricing' => '',
    'cta_pro_text'            => '',
    'cta_free_text'           => 'Start with Free Version',
    'pricing_footer_text'     => '30-day money-back guarantee • Instant download • 1 year of updates & support',
    'cta_footer_text'         => '30-day money-back guarantee • Instant download • 1 year of updates & support',
  );

  // Pricing fields
  $pricing_fields = array(
    'free_plan_title'        => 'Free Version',
    'free_plan_price'        => '$0',
    'free_plan_period'       => '/forever',
    'free_plan_desc'         => 'Perfect for basic needs',
    'pro_plan_title'         => '',
    'pro_plan_price'         => '$59',
    'pro_plan_period'        => '/year',
    'pro_plan_desc'          => 'Unlock all features and premium support',
    'recommended_badge_text' => 'RECOMMENDED',
    'show_recommended_badge' => '1',
  );

  // Merge all fields
  $all_fields = array_merge($basic_fields, $dynamic_text_fields, $button_text_fields, $pricing_fields);

  // Get values from database
  foreach ($all_fields as $field => $default) {
    $value              = get_post_meta($post_id, $field, true);
    $all_fields[$field] = !empty($value) ? $value : $default;
  }

  // Array fields with JSON decoding
  $array_fields = array('features', 'use_cases', 'demos', 'testimonials', 'faqs', 'free_features', 'pro_features');

  foreach ($array_fields as $field) {
    $json = get_post_meta($post_id, $field, true);
    if ($json) {
      $decoded            = json_decode($json, true);
      $all_fields[$field] = is_array($decoded) ? $decoded : array();
    } else {
      // Set defaults
      switch ($field) {
        case 'features':
          $all_fields[$field] = array(array('icon' => 'fa-cog', 'title' => '', 'description' => ''));
          break;
        case 'use_cases':
          $all_fields[$field] = array(array('icon' => 'fa-store', 'title' => '', 'description' => ''));
          break;
        case 'demos':
          $all_fields[$field] = array(array('title' => '', 'description' => '', 'features' => '', 'demo_url' => '', 'image' => ''));
          break;
        case 'testimonials':
          $all_fields[$field] = array(array('name' => '', 'position' => '', 'content' => '', 'avatar' => '', 'rating' => '5'));
          break;
        case 'faqs':
          $all_fields[$field] = array(array('question' => '', 'answer' => ''));
          break;
        case 'free_features':
          $all_fields[$field] = array('Basic functionality', 'Limited features', 'Community support', 'Core features');
          break;
        case 'pro_features':
          $all_fields[$field] = array('All free features included', 'Unlimited usage', 'Premium features', 'Priority support', 'Regular updates');
          break;
        default:
          $all_fields[$field] = array();
      }
    }
  }

  // Get plugin content
  $all_fields['plugin_content'] = get_post_meta($post_id, '_plugin_content', true);

  return $all_fields;
}

function wp_easysoft_wp_plugin_meta_box_callback($post)
{
  wp_nonce_field('wp_easysoft_save_wp_plugin_meta', 'wp_easysoft_wp_plugin_meta_nonce');

  // Get existing meta values
  $meta_fields = wp_easysoft_get_wp_plugin_meta_fields($post->ID);
  ?>

  <style>
    .meta-box-section {
      margin-bottom: 30px;
      padding: 20px;
      background: #f8f9fa;
      border: 1px solid #e0e0e0;
      border-radius: 5px;
    }

    .meta-box-section h3 {
      margin-top: 0;
      color: #1F3266;
      border-bottom: 2px solid #1F3266;
      padding-bottom: 10px;
    }

    .repeater-item {
      background: white;
      padding: 15px;
      margin-bottom: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    .repeater-item input,
    .repeater-item textarea {
      margin-bottom: 8px;
      width: 100%;
    }

    .add-repeater-item {
      background: #1F3266;
      color: white;
      border: none;
      padding: 8px 15px;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
      font-size: 14px;
    }

    .remove-repeater-item {
      background: #dc3545;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 5px;
      font-size: 12px;
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

    .checkbox-label {
      display: flex;
      align-items: center;
      gap: 8px;
      font-weight: normal;
    }

    .half-width {
      width: 48%;
      display: inline-block;
      margin-right: 2%;
    }

    .half-width:last-child {
      margin-right: 0;
    }
  </style>

  <!-- Basic Information Section -->
  <div class="meta-box-section">
    <h3>Basic Information</h3>

    <div class="meta-field-row">
      <label for="tagline">Tagline</label>
      <input type="text" id="tagline" name="tagline" value="<?php echo esc_attr($meta_fields['tagline']); ?>"
        class="regular-text" placeholder="Short tagline for the plugin">
    </div>

    <div class="meta-field-row">
      <label for="short_description">Short Description</label>
      <textarea id="short_description" name="short_description" rows="3" class="large-text"
        placeholder="Brief description shown in hero section"><?php echo esc_textarea($meta_fields['short_description']); ?></textarea>
    </div>

    <div class="meta-field-row">
      <label for="active_installs">Active Installs</label>
      <input type="text" id="active_installs" name="active_installs"
        value="<?php echo esc_attr($meta_fields['active_installs']); ?>" class="regular-text"
        placeholder="e.g., 90+ Active Installs">
    </div>

    <div class="meta-field-row">
      <div class="half-width">
        <label for="version">Version</label>
        <input type="text" id="version" name="version" value="<?php echo esc_attr($meta_fields['version']); ?>"
          class="regular-text" placeholder="1.0.0">
      </div>
      <div class="half-width">
        <label for="tested_up_to">Tested Up To</label>
        <input type="text" id="tested_up_to" name="tested_up_to"
          value="<?php echo esc_attr($meta_fields['tested_up_to']); ?>" class="regular-text" placeholder="e.g., 6.4">
      </div>
    </div>

    <div class="meta-field-row">
      <div class="half-width">
        <label for="requires_php">Requires PHP</label>
        <input type="text" id="requires_php" name="requires_php"
          value="<?php echo esc_attr($meta_fields['requires_php']); ?>" class="regular-text" placeholder="e.g., 7.4">
      </div>
      <div class="half-width">
        <label for="requires_wp">Requires WordPress</label>
        <input type="text" id="requires_wp" name="requires_wp"
          value="<?php echo esc_attr($meta_fields['requires_wp']); ?>" class="regular-text" placeholder="e.g., 5.0">
      </div>
    </div>

    <div class="meta-field-row">
      <label for="rating">Rating (0-5)</label>
      <input type="number" id="rating" name="rating" value="<?php echo esc_attr($meta_fields['rating']); ?>" min="0"
        max="5" step="0.1" class="regular-text" placeholder="4.9">
    </div>

    <div class="meta-field-row">
      <label for="free_version_url">Free Version URL</label>
      <input type="url" id="free_version_url" name="free_version_url"
        value="<?php echo esc_attr($meta_fields['free_version_url']); ?>" class="regular-text"
        placeholder="https://wordpress.org/plugins/...">
    </div>

    <div class="meta-field-row">
      <label for="pro_version_url">PRO Version URL</label>
      <input type="url" id="pro_version_url" name="pro_version_url"
        value="<?php echo esc_attr($meta_fields['pro_version_url']); ?>" class="regular-text"
        placeholder="https://your-site.com/pro-version">
    </div>

    <div class="meta-field-row">
      <label>Options</label>
      <div style="display: flex; flex-direction: column; gap: 10px;">
        <label class="checkbox-label">
          <input type="checkbox" name="has_pro" value="1" <?php checked($meta_fields['has_pro'], '1'); ?>>
          Has PRO version available
        </label>
        <label class="checkbox-label">
          <input type="checkbox" name="woocommerce_compatible" value="1" <?php checked($meta_fields['woocommerce_compatible'], '1'); ?>>
          WooCommerce Compatible
        </label>
      </div>
    </div>
  </div>

  <!-- Dynamic Text Sections -->
  <div class="meta-box-section">
    <h3>Dynamic Text Sections</h3>

    <div class="meta-field-row">
      <div class="half-width">
        <label for="features_heading">Features Section Heading</label>
        <input type="text" id="features_heading" name="features_heading"
          value="<?php echo esc_attr($meta_fields['features_heading']); ?>" class="regular-text"
          placeholder="Powerful Features">
      </div>
      <div class="half-width">
        <label for="demo_heading">Demo Section Heading</label>
        <input type="text" id="demo_heading" name="demo_heading"
          value="<?php echo esc_attr($meta_fields['demo_heading']); ?>" class="regular-text"
          placeholder="See Plugin in Action">
      </div>
    </div>

    <div class="meta-field-row">
      <label for="features_desc">Features Section Description</label>
      <textarea id="features_desc" name="features_desc" rows="2" class="large-text"
        placeholder="Everything you need for a complete solution"><?php echo esc_textarea($meta_fields['features_desc']); ?></textarea>
    </div>

    <div class="meta-field-row">
      <label for="demo_desc">Demo Section Description</label>
      <textarea id="demo_desc" name="demo_desc" rows="2" class="large-text"
        placeholder="Explore the features through our interactive demo"><?php echo esc_textarea($meta_fields['demo_desc']); ?></textarea>
    </div>

    <div class="meta-field-row">
      <div class="half-width">
        <label for="use_cases_heading">Use Cases Section Heading</label>
        <input type="text" id="use_cases_heading" name="use_cases_heading"
          value="<?php echo esc_attr($meta_fields['use_cases_heading']); ?>" class="regular-text"
          placeholder="Perfect For">
      </div>
      <div class="half-width">
        <label for="pricing_heading">Pricing Section Heading</label>
        <input type="text" id="pricing_heading" name="pricing_heading"
          value="<?php echo esc_attr($meta_fields['pricing_heading']); ?>" class="regular-text"
          placeholder="Choose Your Plan">
      </div>
    </div>

    <div class="meta-field-row">
      <label for="use_cases_desc">Use Cases Section Description</label>
      <textarea id="use_cases_desc" name="use_cases_desc" rows="2" class="large-text"
        placeholder="Ideal solution for various WordPress projects"><?php echo esc_textarea($meta_fields['use_cases_desc']); ?></textarea>
    </div>

    <div class="meta-field-row">
      <label for="pricing_desc">Pricing Section Description</label>
      <textarea id="pricing_desc" name="pricing_desc" rows="2" class="large-text"
        placeholder="Start with our free version or unlock all features with PRO"><?php echo esc_textarea($meta_fields['pricing_desc']); ?></textarea>
    </div>

    <div class="meta-field-row">
      <div class="half-width">
        <label for="testimonials_heading">Testimonials Section Heading</label>
        <input type="text" id="testimonials_heading" name="testimonials_heading"
          value="<?php echo esc_attr($meta_fields['testimonials_heading']); ?>" class="regular-text"
          placeholder="What Our Users Say">
      </div>
      <div class="half-width">
        <label for="faq_heading">FAQ Section Heading</label>
        <input type="text" id="faq_heading" name="faq_heading"
          value="<?php echo esc_attr($meta_fields['faq_heading']); ?>" class="regular-text"
          placeholder="Frequently Asked Questions">
      </div>
    </div>

    <div class="meta-field-row">
      <label for="testimonials_desc">Testimonials Section Description</label>
      <textarea id="testimonials_desc" name="testimonials_desc" rows="2" class="large-text"
        placeholder="Join thousands of satisfied users worldwide"><?php echo esc_textarea($meta_fields['testimonials_desc']); ?></textarea>
    </div>

    <div class="meta-field-row">
      <label for="faq_desc">FAQ Section Description</label>
      <textarea id="faq_desc" name="faq_desc" rows="2" class="large-text"
        placeholder="Everything you need to know"><?php echo esc_textarea($meta_fields['faq_desc']); ?></textarea>
    </div>

    <div class="meta-field-row">
      <div class="half-width">
        <label for="requirements_heading">Requirements Section Heading</label>
        <input type="text" id="requirements_heading" name="requirements_heading"
          value="<?php echo esc_attr($meta_fields['requirements_heading']); ?>" class="regular-text"
          placeholder="Technical Requirements">
      </div>
      <div class="half-width">
        <label for="cta_heading">CTA Section Heading</label>
        <input type="text" id="cta_heading" name="cta_heading"
          value="<?php echo esc_attr($meta_fields['cta_heading']); ?>" class="regular-text"
          placeholder="Ready to Get Started?">
      </div>
    </div>

    <div class="meta-field-row">
      <label for="requirements_desc">Requirements Section Description</label>
      <textarea id="requirements_desc" name="requirements_desc" rows="2" class="large-text"
        placeholder="Make sure your site meets these requirements"><?php echo esc_textarea($meta_fields['requirements_desc']); ?></textarea>
    </div>

    <div class="meta-field-row">
      <label for="cta_desc">CTA Section Description</label>
      <textarea id="cta_desc" name="cta_desc" rows="2" class="large-text"
        placeholder="Join thousands of users"><?php echo esc_textarea($meta_fields['cta_desc']); ?></textarea>
    </div>

    <div class="meta-field-row">
      <div class="half-width">
        <label for="content_heading">Content Section Heading</label>
        <input type="text" id="content_heading" name="content_heading"
          value="<?php echo esc_attr($meta_fields['content_heading']); ?>" class="regular-text"
          placeholder="Plugin Details">
      </div>
      <div class="half-width">
        <label for="content_desc">Content Section Description</label>
        <input type="text" id="content_desc" name="content_desc"
          value="<?php echo esc_attr($meta_fields['content_desc']); ?>" class="regular-text"
          placeholder="Learn more about the plugin">
      </div>
    </div>
  </div>

  <!-- Button & Text Customization -->
  <div class="meta-box-section">
    <h3>Button & Text Customization</h3>

    <div class="meta-field-row">
      <div class="half-width">
        <label for="pro_button_text">PRO Button Text (Hero)</label>
        <input type="text" id="pro_button_text" name="pro_button_text"
          value="<?php echo esc_attr($meta_fields['pro_button_text']); ?>" class="regular-text"
          placeholder="Get Plugin PRO">
      </div>
      <div class="half-width">
        <label for="demo_button_text">Demo Button Text</label>
        <input type="text" id="demo_button_text" name="demo_button_text"
          value="<?php echo esc_attr($meta_fields['demo_button_text']); ?>" class="regular-text" placeholder="View Demo">
      </div>
    </div>

    <div class="meta-field-row">
      <div class="half-width">
        <label for="updates_text">Updates Text</label>
        <input type="text" id="updates_text" name="updates_text"
          value="<?php echo esc_attr($meta_fields['updates_text']); ?>" class="regular-text"
          placeholder="Regular Updates">
      </div>
      <div class="half-width">
        <label for="compatibility_text">Compatibility Text</label>
        <input type="text" id="compatibility_text" name="compatibility_text"
          value="<?php echo esc_attr($meta_fields['compatibility_text']); ?>" class="regular-text"
          placeholder="WooCommerce Compatible">
      </div>
    </div>

    <div class="meta-field-row">
      <div class="half-width">
        <label for="try_demo_text">Try Demo Button Text</label>
        <input type="text" id="try_demo_text" name="try_demo_text"
          value="<?php echo esc_attr($meta_fields['try_demo_text']); ?>" class="regular-text" placeholder="Try Live Demo">
      </div>
      <div class="half-width">
        <label for="free_button_text">Free Button Text</label>
        <input type="text" id="free_button_text" name="free_button_text"
          value="<?php echo esc_attr($meta_fields['free_button_text']); ?>" class="regular-text"
          placeholder="Download Free Version">
      </div>
    </div>

    <div class="meta-field-row">
      <div class="half-width">
        <label for="pro_button_text_pricing">PRO Button Text (Pricing)</label>
        <input type="text" id="pro_button_text_pricing" name="pro_button_text_pricing"
          value="<?php echo esc_attr($meta_fields['pro_button_text_pricing']); ?>" class="regular-text"
          placeholder="Get Plugin PRO">
      </div>
      <div class="half-width">
        <label for="cta_pro_text">CTA PRO Text</label>
        <input type="text" id="cta_pro_text" name="cta_pro_text"
          value="<?php echo esc_attr($meta_fields['cta_pro_text']); ?>" class="regular-text"
          placeholder="Get Plugin PRO - $59/year">
      </div>
    </div>

    <div class="meta-field-row">
      <div class="half-width">
        <label for="cta_free_text">CTA Free Text</label>
        <input type="text" id="cta_free_text" name="cta_free_text"
          value="<?php echo esc_attr($meta_fields['cta_free_text']); ?>" class="regular-text"
          placeholder="Start with Free Version">
      </div>
    </div>

    <div class="meta-field-row">
      <label for="pricing_footer_text">Pricing Footer Text</label>
      <textarea id="pricing_footer_text" name="pricing_footer_text" rows="2" class="large-text"
        placeholder="30-day money-back guarantee • Instant download • 1 year of updates & support"><?php echo esc_textarea($meta_fields['pricing_footer_text']); ?></textarea>
    </div>

    <div class="meta-field-row">
      <label for="cta_footer_text">CTA Footer Text</label>
      <textarea id="cta_footer_text" name="cta_footer_text" rows="2" class="large-text"
        placeholder="30-day money-back guarantee • Instant download • 1 year of updates & support"><?php echo esc_textarea($meta_fields['cta_footer_text']); ?></textarea>
    </div>
  </div>

  <!-- Pricing Details -->
  <div class="meta-box-section">
    <h3>Pricing Details</h3>

    <div class="meta-field-row">
      <h4>Free Plan</h4>
      <div class="half-width">
        <label for="free_plan_title">Free Plan Title</label>
        <input type="text" id="free_plan_title" name="free_plan_title"
          value="<?php echo esc_attr($meta_fields['free_plan_title']); ?>" class="regular-text"
          placeholder="Free Version">
      </div>
      <div class="half-width">
        <label for="free_plan_price">Free Plan Price</label>
        <input type="text" id="free_plan_price" name="free_plan_price"
          value="<?php echo esc_attr($meta_fields['free_plan_price']); ?>" class="regular-text" placeholder="$0">
      </div>
    </div>

    <div class="meta-field-row">
      <div class="half-width">
        <label for="free_plan_period">Free Plan Period</label>
        <input type="text" id="free_plan_period" name="free_plan_period"
          value="<?php echo esc_attr($meta_fields['free_plan_period']); ?>" class="regular-text" placeholder="/forever">
      </div>
      <div class="half-width">
        <label for="free_plan_desc">Free Plan Description</label>
        <input type="text" id="free_plan_desc" name="free_plan_desc"
          value="<?php echo esc_attr($meta_fields['free_plan_desc']); ?>" class="regular-text"
          placeholder="Perfect for basic needs">
      </div>
    </div>

    <div class="meta-field-row">
      <h4>PRO Plan</h4>
      <div class="half-width">
        <label for="pro_plan_title">PRO Plan Title</label>
        <input type="text" id="pro_plan_title" name="pro_plan_title"
          value="<?php echo esc_attr($meta_fields['pro_plan_title']); ?>" class="regular-text"
          placeholder="<?php echo get_the_title($post->ID); ?> PRO">
      </div>
      <div class="half-width">
        <label for="pro_plan_price">PRO Plan Price</label>
        <input type="text" id="pro_plan_price" name="pro_plan_price"
          value="<?php echo esc_attr($meta_fields['pro_plan_price']); ?>" class="regular-text" placeholder="$59">
      </div>
    </div>

    <div class="meta-field-row">
      <div class="half-width">
        <label for="pro_plan_period">PRO Plan Period</label>
        <input type="text" id="pro_plan_period" name="pro_plan_period"
          value="<?php echo esc_attr($meta_fields['pro_plan_period']); ?>" class="regular-text" placeholder="/year">
      </div>
      <div class="half-width">
        <label for="pro_plan_desc">PRO Plan Description</label>
        <input type="text" id="pro_plan_desc" name="pro_plan_desc"
          value="<?php echo esc_attr($meta_fields['pro_plan_desc']); ?>" class="regular-text"
          placeholder="Unlock all features and premium support">
      </div>
    </div>

    <div class="meta-field-row">
      <div class="half-width">
        <label for="recommended_badge_text">Recommended Badge Text</label>
        <input type="text" id="recommended_badge_text" name="recommended_badge_text"
          value="<?php echo esc_attr($meta_fields['recommended_badge_text']); ?>" class="regular-text"
          placeholder="RECOMMENDED">
      </div>
      <div class="half-width">
        <label class="checkbox-label">
          <input type="checkbox" name="show_recommended_badge" value="1" <?php checked($meta_fields['show_recommended_badge'], '1'); ?>>
          Show Recommended Badge
        </label>
      </div>
    </div>
  </div>

  <!-- Plugin Content Editor -->
  <div class="meta-box-section">
    <h3>Plugin Content</h3>
    <?php
    wp_editor(
      $meta_fields['plugin_content'],
      'plugin_content',
      array(
        'textarea_name' => 'plugin_content',
        'textarea_rows' => 20,
        'media_buttons' => true,
        'teeny'         => false,
        'quicktags'     => true,
        'tinymce'       => array(
          'toolbar1' => 'formatselect,bold,italic,underline,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,unlink,wp_adv',
          'toolbar2' => 'strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help',
        ),
      )
    );
    ?>
  </div>

  <?php
  // Repeater sections for features, use cases, demos, testimonials, FAQs, and features lists
  $repeater_sections = array(
    'features'      => array(
      'title'  => 'Features (3-6 features recommended)',
      'fields' => array(
        'icon'        => array('type' => 'text', 'placeholder' => 'FontAwesome icon class (e.g., fa-cog)'),
        'title'       => array('type' => 'text', 'placeholder' => 'Feature title'),
        'description' => array('type' => 'textarea', 'placeholder' => 'Feature description', 'rows' => 2)
      )
    ),
    'use_cases'     => array(
      'title'  => 'Use Cases (4 use cases recommended)',
      'fields' => array(
        'icon'        => array('type' => 'text', 'placeholder' => 'FontAwesome icon class (e.g., fa-store)'),
        'title'       => array('type' => 'text', 'placeholder' => 'Use case title'),
        'description' => array('type' => 'textarea', 'placeholder' => 'Use case description', 'rows' => 2)
      )
    ),
    'demos'         => array(
      'title'  => 'Demo Tabs (Optional)',
      'fields' => array(
        'title'       => array('type' => 'text', 'placeholder' => 'Demo tab title'),
        'description' => array('type' => 'textarea', 'placeholder' => 'Demo description', 'rows' => 3),
        'features'    => array('type' => 'text', 'placeholder' => 'Features (comma separated)'),
        'demo_url'    => array('type' => 'url', 'placeholder' => 'Demo URL'),
        'image'       => array('type' => 'text', 'placeholder' => 'Image URL or leave empty')
      )
    ),
    'testimonials'  => array(
      'title'  => 'Testimonials (Optional)',
      'fields' => array(
        'name'     => array('type' => 'text', 'placeholder' => 'Customer name'),
        'position' => array('type' => 'text', 'placeholder' => 'Position/Company'),
        'content'  => array('type' => 'textarea', 'placeholder' => 'Testimonial content', 'rows' => 3),
        'avatar'   => array('type' => 'text', 'placeholder' => 'Avatar URL (optional)'),
        'rating'   => array('type' => 'number', 'placeholder' => 'Rating (1-5)', 'min' => 1, 'max' => 5)
      )
    ),
    'faqs'          => array(
      'title'  => 'FAQs',
      'fields' => array(
        'question' => array('type' => 'text', 'placeholder' => 'Question'),
        'answer'   => array('type' => 'textarea', 'placeholder' => 'Answer', 'rows' => 3)
      )
    ),
    'free_features' => array(
      'title'       => 'Free Version Features',
      'simple'      => true,
      'placeholder' => 'Free feature'
    ),
    'pro_features'  => array(
      'title'       => 'PRO Version Features',
      'simple'      => true,
      'placeholder' => 'PRO feature'
    )
  );

  foreach ($repeater_sections as $section_id => $section_config):
    ?>
    <div class="meta-box-section">
      <h3><?php echo esc_html($section_config['title']); ?></h3>
      <div id="<?php echo esc_attr($section_id); ?>-repeater">
        <?php
        $items = isset($meta_fields[$section_id]) ? $meta_fields[$section_id] : array();
        if (empty($items) && isset($section_config['simple'])) {
          $items = array('', '', '', '');
        }

        foreach ($items as $index => $item):
          $item = is_array($item) ? $item : array('value' => $item);
          ?>
          <div class="repeater-item" data-index="<?php echo $index; ?>">
            <?php if (isset($section_config['simple'])): ?>
              <input type="text" name="<?php echo esc_attr($section_id); ?>[<?php echo $index; ?>]"
                value="<?php echo isset($item['value']) ? esc_attr($item['value']) : esc_attr($item); ?>"
                placeholder="<?php echo esc_attr($section_config['placeholder']); ?>" class="regular-text">
            <?php else: ?>
              <?php foreach ($section_config['fields'] as $field_name => $field_config):
                $value = isset($item[$field_name]) ? $item[$field_name] : '';
                ?>
                <?php if ($field_config['type'] === 'textarea'): ?>
                  <textarea name="<?php echo esc_attr($section_id); ?>[<?php echo $index; ?>][<?php echo esc_attr($field_name); ?>]"
                    rows="<?php echo isset($field_config['rows']) ? $field_config['rows'] : 2; ?>" class="large-text"
                    placeholder="<?php echo esc_attr($field_config['placeholder']); ?>"><?php echo esc_textarea($value); ?></textarea>
                <?php else: ?>
                  <input type="<?php echo esc_attr($field_config['type']); ?>"
                    name="<?php echo esc_attr($section_id); ?>[<?php echo $index; ?>][<?php echo esc_attr($field_name); ?>]"
                    value="<?php echo esc_attr($value); ?>" placeholder="<?php echo esc_attr($field_config['placeholder']); ?>"
                    class="regular-text" <?php
                    if (isset($field_config['min'])) {
                      echo 'min="' . esc_attr($field_config['min']) . '" ';
                    }
                    if (isset($field_config['max'])) {
                      echo 'max="' . esc_attr($field_config['max']) . '"';
                    }
                    ?>>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php endif; ?>
            <button type="button" class="remove-repeater-item"
              onclick="removeRepeaterItem(this, '<?php echo esc_attr($section_id); ?>')">Remove</button>
          </div>
        <?php endforeach; ?>
      </div>
      <button type="button" class="add-repeater-item" onclick="addRepeaterItem('<?php echo esc_attr($section_id); ?>')">Add
        Item</button>
    </div>
  <?php endforeach; ?>

  <script>
    function addRepeaterItem(type) {
      const container = document.getElementById(`${type}-repeater`);
      const items = container.querySelectorAll('.repeater-item');
      const newIndex = items.length;

      // Get repeater configuration from PHP
      const config = <?php echo json_encode($repeater_sections); ?>;
      const sectionConfig = config[type];

      let html = '';

      if (sectionConfig.simple) {
        html = `
                <div class="repeater-item" data-index="${newIndex}">
                    <input type="text" name="${type}[${newIndex}]" value="" placeholder="${sectionConfig.placeholder}" class="regular-text">
                    <button type="button" class="remove-repeater-item" onclick="removeRepeaterItem(this, '${type}')">Remove</button>
                </div>
            `;
      } else {
        let fieldsHtml = '';
        for (const [fieldName, fieldConfig] of Object.entries(sectionConfig.fields)) {
          if (fieldConfig.type === 'textarea') {
            fieldsHtml += `
                        <textarea name="${type}[${newIndex}][${fieldName}]" rows="${fieldConfig.rows || 2}"
                                  class="large-text" placeholder="${fieldConfig.placeholder}"></textarea>
                    `;
          } else {
            let attrs = `type="${fieldConfig.type}" placeholder="${fieldConfig.placeholder}"`;
            if (fieldConfig.min) attrs += ` min="${fieldConfig.min}"`;
            if (fieldConfig.max) attrs += ` max="${fieldConfig.max}"`;
            fieldsHtml += `
                        <input name="${type}[${newIndex}][${fieldName}]" ${attrs} class="regular-text">
                    `;
          }
        }

        html = `
                <div class="repeater-item" data-index="${newIndex}">
                    ${fieldsHtml}
                    <button type="button" class="remove-repeater-item" onclick="removeRepeaterItem(this, '${type}')">Remove</button>
                </div>
            `;
      }

      container.insertAdjacentHTML('beforeend', html);
    }

    function removeRepeaterItem(button, type) {
      const item = button.closest('.repeater-item');
      if (confirm('Are you sure you want to remove this item?')) {
        item.remove();
        // Re-index remaining items
        const container = document.getElementById(`${type}-repeater`);
        const items = container.querySelectorAll('.repeater-item');
        items.forEach((item, index) => {
          item.setAttribute('data-index', index);
          // Update all inputs within this item
          item.querySelectorAll('input, textarea, select').forEach(field => {
            const name = field.getAttribute('name');
            if (name) {
              const matches = name.match(/\[(\d+)\]/g);
              if (matches) {
                let newName = name.replace(/\[(\d+)\]/, `[${index}]`);
                // Handle nested arrays
                if (matches.length > 1) {
                  newName = newName.replace(/\[(\d+)\]$/, `[${index}]`);
                }
                field.setAttribute('name', newName);
              }
            }
          });
        });
      }
    }
  </script>

  <?php
}

// Save plugin meta data
function wp_easysoft_save_wp_plugin_meta($post_id)
{
  // Security checks
  if (
    !isset($_POST['wp_easysoft_wp_plugin_meta_nonce']) ||
    !wp_verify_nonce($_POST['wp_easysoft_wp_plugin_meta_nonce'], 'wp_easysoft_save_wp_plugin_meta')
  ) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  // Define all fields to save
  $text_fields = array(
    // Basic fields
    'tagline',
    'short_description',
    'version',
    'tested_up_to',
    'requires_php',
    'requires_wp',
    'rating',
    'active_installs',
    'free_version_url',
    'pro_version_url',

    // Dynamic section headings
    'features_heading',
    'features_desc',
    'demo_heading',
    'demo_desc',
    'use_cases_heading',
    'use_cases_desc',
    'pricing_heading',
    'pricing_desc',
    'testimonials_heading',
    'testimonials_desc',
    'faq_heading',
    'faq_desc',
    'requirements_heading',
    'requirements_desc',
    'cta_heading',
    'cta_desc',
    'content_heading',
    'content_desc',

    // Button texts
    'pro_button_text',
    'demo_button_text',
    'updates_text',
    'compatibility_text',
    'try_demo_text',
    'free_button_text',
    'pro_button_text_pricing',
    'cta_pro_text',
    'cta_free_text',
    'pricing_footer_text',
    'cta_footer_text',

    // Pricing details
    'free_plan_title',
    'free_plan_price',
    'free_plan_period',
    'free_plan_desc',
    'pro_plan_title',
    'pro_plan_price',
    'pro_plan_period',
    'pro_plan_desc',
    'recommended_badge_text',
    'show_recommended_badge',
  );

  $checkbox_fields = array('has_pro', 'woocommerce_compatible');

  $array_fields = array('features', 'use_cases', 'demos', 'testimonials', 'faqs', 'free_features', 'pro_features');

  // Save text fields
  foreach ($text_fields as $field) {
    if (isset($_POST[$field])) {
      update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
    } else {
      delete_post_meta($post_id, $field);
    }
  }

  // Save checkbox fields
  foreach ($checkbox_fields as $field) {
    update_post_meta($post_id, $field, isset($_POST[$field]) ? '1' : '0');
  }

  // Save array fields as JSON
  foreach ($array_fields as $field) {
    if (isset($_POST[$field]) && is_array($_POST[$field])) {
      $data = $_POST[$field];

      // Clean data - remove empty items
      $data = array_values(array_filter($data, function ($item) {
        if (is_array($item)) {
          // For associative arrays, check if any field has content
          return !empty(array_filter($item, function ($value) {
            return !empty(trim($value));
          }));
        } else {
          // For simple arrays, check if the item itself has content
          return !empty(trim($item));
        }
      }));

      if (!empty($data)) {
        update_post_meta($post_id, $field, wp_json_encode($data, JSON_UNESCAPED_UNICODE));
      } else {
        delete_post_meta($post_id, $field);
      }
    } else {
      delete_post_meta($post_id, $field);
    }
  }

  // Save plugin content
  if (isset($_POST['plugin_content'])) {
    update_post_meta($post_id, '_plugin_content', wp_kses_post($_POST['plugin_content']));
  }
}
add_action('save_post_wp_plugin', 'wp_easysoft_save_wp_plugin_meta');

// Add custom columns to plugin listing
function wp_easysoft_wp_plugin_columns($columns)
{
  $new_columns = array(
    'cb'              => $columns['cb'],
    'title'           => $columns['title'],
    'version'         => __('Version', 'wp-easysoft'),
    'has_pro'         => __('Has PRO', 'wp-easysoft'),
    'active_installs' => __('Active Installs', 'wp-easysoft'),
    'date'            => $columns['date'],
  );
  return $new_columns;
}
add_filter('manage_wp_plugin_posts_columns', 'wp_easysoft_wp_plugin_columns');

function wp_easysoft_wp_plugin_custom_column($column, $post_id)
{
  switch ($column) {
    case 'version':
      $version = get_post_meta($post_id, 'version', true);
      echo $version ? esc_html($version) : '—';
      break;
    case 'has_pro':
      $has_pro = get_post_meta($post_id, 'has_pro', true);
      echo $has_pro ? '<span class="dashicons dashicons-yes-alt" style="color: #46b450;"></span>' : '<span class="dashicons dashicons-no-alt" style="color: #dc3232;"></span>';
      break;
    case 'active_installs':
      $installs = get_post_meta($post_id, 'active_installs', true);
      echo $installs ? esc_html($installs) : '—';
      break;
  }
}
add_action('manage_wp_plugin_posts_custom_column', 'wp_easysoft_wp_plugin_custom_column', 10, 2);

// Make custom columns sortable
function wp_easysoft_wp_plugin_sortable_columns($columns)
{
  $columns['version']         = 'version';
  $columns['active_installs'] = 'active_installs';
  return $columns;
}
add_filter('manage_edit-wp_plugin_sortable_columns', 'wp_easysoft_wp_plugin_sortable_columns');

// Helper function for template to get plugin meta
function wp_easysoft_get_plugin_meta($post_id = null)
{
  if (!$post_id) {
    $post_id = get_the_ID();
  }
  return wp_easysoft_get_wp_plugin_meta_fields($post_id);
}
