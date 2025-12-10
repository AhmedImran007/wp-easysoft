<?php
// Helper function to render header blocks
if (!function_exists('block_header_area')) {
  function block_header_area()
  {
    if (function_exists('block_template_part')) {
      block_template_part('header');
    } elseif (function_exists('wp_block_template_part')) {
      wp_block_template_part('header');
    }
  }
}

// Helper function to render footer blocks
if (!function_exists('block_footer_area')) {
  function block_footer_area()
  {
    if (function_exists('block_template_part')) {
      block_template_part('footer');
    } elseif (function_exists('wp_block_template_part')) {
      wp_block_template_part('footer');
    }
  }
}

/**
 * The template for displaying a single doc
 */

// For block themes, we need to output the minimal HTML structure
if (function_exists('wp_is_block_theme') && wp_is_block_theme()) {
  ?>
  <!DOCTYPE html>
  <html <?php language_attributes(); ?>>

  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="wp-site-blocks">
      <?php block_header_area(); ?>
      <?php
} else {
  get_header();
}
/**
 * The template for displaying a single doc
 *
 * To customize this template, create a folder in your current theme named "wedocs" and copy it there.
 */
$skip_sidebar = (get_post_meta($post->ID, 'skip_sidebar', true) == 'yes') ? true : false;

?>

    <?php
    /**
     * @since 1.4
     *
     * @hooked wedocs_template_wrapper_start - 10
     */
    do_action('wedocs_before_main_content');
    ?>

    <?php while (have_posts()) {
      the_post(); ?>

      <div class="wedocs-single-wrap min-h-screen bg-gray-50">
        <div class="container max-w-7xl mx-auto px-4 py-4">
          <div class="flex flex-col lg:flex-row">

            <?php if (!$skip_sidebar) { ?>
              <?php wedocs_get_template_part('docs', 'sidebar', ['post' => $post]); ?>
            <?php } ?>

            <div class="wedocs-single-content flex-grow p-4 md:p-8 lg:p-12 w-full">
              <div class="max-w-7xl">
                <?php wedocs_breadcrumbs(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope
                  itemtype="http://schema.org/Article">
                  <!-- Article Header -->
                  <header class="mb-10 pb-8 border-b border-gray-200 relative">
                    <div class="flex items-center justify-between mb-4">
                      <?php if (wedocs_get_general_settings('print', 'on') === 'on') { ?>
                        <button
                          class="wedocs-print-article wedocs-hide-print wedocs-hide-mobile flex items-center gap-2 text-gray-500 hover:text-purple-600 transition-colors duration-200 group ml-auto"
                          title="<?php echo esc_attr(__('Print this article', 'wedocs')); ?>">
                          <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                            </path>
                          </svg>
                          <span class="text-sm font-medium"><?php _e('Print', 'wedocs'); ?></span>
                        </button>
                      <?php } ?>
                    </div>

                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-6" itemprop="headline">
                      <?php the_title(); ?>
                    </h1>

                  </header>

                  <!-- Article Content -->
                  <div class="article-content prose prose-lg prose-purple max-w-none mb-12" itemprop="articleBody">
                    <?php
                    the_content(sprintf(
                      /* translators: %s: Name of current post. */
                      wp_kses(__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'wedocs'), ['span' => ['class' => []]]),
                      the_title('<span class="screen-reader-text">"', '"</span>', false)
                    ));

                    wp_link_pages([
                      'before' => '<div class="pagination-links text-sm text-gray-600 mt-6 mb-8 p-4 bg-gray-100 rounded-lg">' . esc_html__('Document Pages:', 'wedocs'),
                      'after'  => '</div>',
                    ]);

                    $children = wp_list_pages('title_li=&order=menu_order&child_of=' . $post->ID . '&echo=0&post_type=' . $post->post_type);

                    if ($children) {
                      echo '<div class="related-articles bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 rounded-lg p-6 mb-10 shadow-sm max-w-7xl">';
                      echo '<h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center gap-2">';
                      echo '<svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                      echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>';
                      echo '</svg>';
                      echo __('Related Articles', 'wedocs') . '</h3>';
                      echo '<ul class="space-y-3">';
                      echo $children;
                      echo '</ul>';
                      echo '</div>';
                    }

                    $tags_list = wedocs_get_the_doc_tags($post->ID, '', ', ');

                    if ($tags_list) {
                      echo '<div class="article-tags mt-10 pt-6 border-t border-gray-200 max-w-7xl">';
                      echo '<div class="flex items-center gap-2 mb-3">';
                      echo '<svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                      echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>';
                      echo '</svg>';
                      echo '<span class="text-sm font-medium text-gray-700">' . _x('Tags', 'Used before tag names.', 'wedocs') . '</span>';
                      echo '</div>';
                      echo '<div class="flex flex-wrap gap-2">';
                      echo $tags_list;
                      echo '</div>';
                      echo '</div>';
                    }
                    ?>
                  </div>

                  <!-- Article Navigation -->
                  <div class="max-w-7xl">
                    <?php wedocs_doc_nav(); ?>
                  </div>

                  <!-- Article Footer -->
                  <footer class="article-footer mt-14 pt-10 border-t border-gray-200">
                    <?php if (wedocs_get_general_settings('email', 'on') === 'on') { ?>
                      <div class="help-section mb-10 max-w-7xl">
                        <div
                          class="bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-200 rounded-2xl p-8 shadow-sm">
                          <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                            <div class="flex-shrink-0">
                              <div
                                class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                  </path>
                                </svg>
                              </div>
                            </div>
                            <div class="flex-grow">
                              <h3 class="text-xl font-bold text-gray-900 mb-3"><?php _e('Need More Help?', 'wedocs'); ?>
                              </h3>

                              <div class="bg-purple-50 border border-purple-100 rounded-xl p-4 mb-4">
                                <p class="text-gray-700 mb-3">
                                  <?php _e('Still have questions or need assistance with this article?', 'wedocs'); ?>
                                </p>

                                <?php
                                // Get contact page URL
                                $contact_page_url = '';

                                // Try multiple ways to get contact page
                                if (function_exists('get_page_by_path')) {
                                  $contact_page = get_page_by_path('contact');
                                  if ($contact_page) {
                                    $contact_page_url = get_permalink($contact_page->ID);
                                  }
                                }

                                // Fallback to site URL
                                if (!$contact_page_url) {
                                  $contact_page_url = site_url('/contact/');
                                }
                                ?>

                                <a href="<?php echo esc_url($contact_page_url); ?>"
                                  class="inline-flex items-center justify-center gap-2 w-full sm:w-auto px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg transition-all duration-200 group shadow-sm hover:shadow">
                                  <i class="fa-solid fa-headset"></i>
                                  <?php _e('Contact Support Team', 'wedocs'); ?>
                                  <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                                </a>
                              </div>

                              <div class="text-sm text-gray-600">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                  <div class="wedocs-article-author" itemprop="author" itemscope
                                    itemtype="https://schema.org/Person">
                                    <div class="flex items-center gap-2">
                                      <i class="fa-solid fa-user text-gray-400"></i>
                                      <span>
                                        <?php _e('Author:', 'wedocs'); ?>
                                        <span itemprop="name" class="font-medium"><?php echo get_the_author(); ?></span>
                                      </span>
                                    </div>
                                    <meta itemprop="url"
                                      content="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" />
                                  </div>

                                  <time class="flex items-center gap-2 text-gray-500"
                                    datetime="<?php echo esc_attr(get_the_modified_date('c')); ?>" itemprop="dateModified">
                                    <i class="fa-solid fa-calendar-day"></i>
                                    <?php printf(__('Last updated: %s', 'wedocs'), get_the_modified_date()); ?>
                                  </time>
                                </div>
                                <meta itemprop="datePublished" content="<?php echo get_the_time('c'); ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>

                    <?php if (wedocs_get_general_settings('helpful', 'on') === 'on') { ?>
                      <div class="feedback-section mt-10 max-w-7xl">
                        <?php if (!empty($post->post_content)): ?>
                          <div class="wedoc-feedback-wrap bg-white rounded-2xl border border-gray-200 p-6 md:p-8 shadow-sm">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 md:gap-8">
                              <div class="flex-grow">
                                <p class="text-lg font-semibold text-gray-900 mb-2">
                                  <?php echo esc_html__('Was this article helpful to you?', 'wedocs'); ?>
                                </p>
                                <p class="text-sm text-gray-600">
                                  <?php echo esc_html__('Your feedback helps us improve our documentation.', 'wedocs'); ?>
                                </p>
                              </div>

                              <?php
                              $positive = (int) get_post_meta($post->ID, 'positive', true);
                              $negative = (int) get_post_meta($post->ID, 'negative', true);

                              $positive_title = $positive ?
                                sprintf(_n('%d person found this useful', '%d persons found this useful', $positive, 'wedocs'), $positive) :
                                __('No votes yet', 'wedocs');

                              $negative_title = $negative ?
                                sprintf(_n('%d person found this not useful', '%d persons found this not useful', $negative, 'wedocs'), $negative) :
                                __('No votes yet', 'wedocs');
                              ?>

                              <div class="feedback-links flex items-center gap-3">
                                <!-- Positive Feedback Button -->
                                <button type="button"
                                  class="tip positive flex items-center gap-2 px-4 py-2 bg-green-50 hover:bg-green-100 text-green-700 hover:text-green-800 border border-green-200 hover:border-green-300 rounded-xl transition-all duration-200 group active:scale-95"
                                  data-id="<?php the_ID(); ?>" data-type="positive"
                                  title="<?php echo esc_attr($positive_title); ?>"
                                  aria-label="<?php echo esc_attr__('Mark as helpful', 'wedocs'); ?>">
                                  <i
                                    class="fa-solid fa-thumbs-up text-green-600 group-hover:scale-110 transition-transform"></i>
                                  <span class="font-medium"><?php _e('Yes', 'wedocs'); ?></span>
                                  <?php if ($positive > 0): ?>
                                    <span
                                      class="inline-flex items-center justify-center min-w-6 h-6 bg-green-600 text-white text-xs font-medium rounded-full px-1.5">
                                      <?php echo $positive; ?>
                                    </span>
                                  <?php endif; ?>
                                </button>

                                <!-- Negative Feedback Button -->
                                <button type="button"
                                  class="tip negative flex items-center gap-2 px-4 py-2 bg-red-50 hover:bg-red-100 text-red-700 hover:text-red-800 border border-red-200 hover:border-red-300 rounded-xl transition-all duration-200 group active:scale-95"
                                  data-id="<?php the_ID(); ?>" data-type="negative"
                                  title="<?php echo esc_attr($negative_title); ?>"
                                  aria-label="<?php echo esc_attr__('Mark as not helpful', 'wedocs'); ?>">
                                  <i
                                    class="fa-solid fa-thumbs-down text-red-600 group-hover:scale-110 transition-transform"></i>
                                  <span class="font-medium"><?php _e('No', 'wedocs'); ?></span>
                                  <?php if ($negative > 0): ?>
                                    <span
                                      class="inline-flex items-center justify-center min-w-6 h-6 bg-red-600 text-white text-xs font-medium rounded-full px-1.5">
                                      <?php echo $negative; ?>
                                    </span>
                                  <?php endif; ?>
                                </button>
                              </div><!-- end .feedback-links -->
                            </div>

                            <!-- Feedback Stats -->
                            <?php if ($positive > 0 || $negative > 0): ?>
                              <div class="mt-6 pt-6 border-t border-gray-100">
                                <div class="flex items-center justify-between text-sm text-gray-600">
                                  <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-2">
                                      <i class="fa-solid fa-thumbs-up text-green-600 text-sm"></i>
                                      <span><?php echo $positive; ?>         <?php _e('found helpful', 'wedocs'); ?></span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                      <i class="fa-solid fa-thumbs-down text-red-600 text-sm"></i>
                                      <span><?php echo $negative; ?>         <?php _e('found not helpful', 'wedocs'); ?></span>
                                    </div>
                                  </div>

                                  <?php $total = $positive + $negative; ?>
                                  <?php if ($total > 0): ?>
                                    <?php
                                    $helpful_percentage = $total > 0 ? round(($positive / $total) * 100) : 0;
                                    $helpful_color      = $helpful_percentage >= 70 ? 'text-green-600' : ($helpful_percentage >= 40 ? 'text-yellow-600' : 'text-red-600');
                                    ?>
                                    <div class="flex items-center gap-2">
                                      <span class="font-medium <?php echo $helpful_color; ?>">
                                        <?php echo $helpful_percentage; ?>%
                                      </span>
                                      <span class="text-gray-500"><?php _e('found helpful', 'wedocs'); ?></span>
                                    </div>
                                  <?php endif; ?>
                                </div>

                                <!-- Progress Bar -->
                                <?php if ($total > 0): ?>
                                  <div class="mt-3 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full"
                                      style="width: <?php echo $helpful_percentage; ?>%"></div>
                                  </div>
                                <?php endif; ?>
                              </div>
                            <?php else: ?>
                              <div class="mt-4 pt-4 border-t border-gray-100">
                                <p class="text-sm text-gray-500 text-center">
                                  <i class="fa-regular fa-lightbulb text-yellow-500 mr-1"></i>
                                  <?php _e('Be the first to share your feedback!', 'wedocs'); ?>
                                </p>
                              </div>
                            <?php endif; ?>
                          </div>
                        <?php endif; ?>
                      </div>
                    <?php } ?>
                  </footer>

                  <?php if (wedocs_get_general_settings('email', 'on') === 'on') { ?>
                    <div class="max-w-7xl">
                      <?php wedocs_get_template_part('content', 'modal'); ?>
                    </div>
                  <?php } ?>

                  <?php if (wedocs_get_general_settings('comments', 'off') === 'on') { ?>
                    <?php if (comments_open() || get_comments_number()) { ?>
                      <div class="comments-section mt-14 pt-10 border-t border-gray-200 max-w-7xl">
                        <div class="bg-white rounded-2xl shadow-sm p-8">
                          <h3 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                            <svg class="w-7 h-7 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                              </path>
                            </svg>
                            <?php _e('Comments & Discussion', 'wedocs'); ?>
                          </h3>
                          <?php comments_template(); ?>
                        </div>
                      </div>
                    <?php } ?>
                  <?php } ?>

                </article>
              </div>
            </div>
          </div>
        </div>
      </div>

    <?php } ?>

    <?php
    /**
     * @since 1.4
     *
     * @hooked wedocs_template_wrapper_end - 10
     */
    do_action('wedocs_after_main_content');
    ?>

    <?php
    // Close out based on theme type
    if (function_exists('wp_is_block_theme') && wp_is_block_theme()) {
      ?>
      <?php block_footer_area(); ?>
    </div><!-- .wp-site-blocks -->
    <?php wp_footer(); ?>
  </body>

  </html>
  <?php
    } else {
      get_footer();
    }
