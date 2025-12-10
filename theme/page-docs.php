<?php
/**
 * Template Name: Docs Page
 *
 * TailwindCSS 4.1 version for WP_EasySoft
 */

get_header();
?>

<!-- START WP_EASYSOFT DOCS SECTION -->

<div class="wpeasysoft-docs-wrap py-16 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4">

    <!-- Search Section -->
    <section id="docsSearch" class="text-center mb-12">
      <h1 class="text-4xl font-bold text-gray-900 mb-6">
        <?php esc_html_e('How can we help?', 'wpeasysoft'); ?>
      </h1>

      <form role="search" method="get" id="searchBar" class="max-w-2xl mx-auto"
        action="<?php echo esc_url(home_url('/')); ?>">
        <div class="flex items-center gap-2">
          <label for="s" class="sr-only">
            <?php esc_html_e('Search for:', 'wpeasysoft'); ?>
          </label>

          <input type="search" name="s" value="<?php echo is_search() ? esc_attr(get_search_query()) : ''; ?>"
            class="w-full px-4 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder:text-gray-400 focus:ring-2 focus:ring-primary focus:outline-none"
            placeholder="<?php esc_html_e('Search', 'wpeasysoft'); ?> <?php bloginfo('name'); ?> <?php esc_html_e('knowledge base', 'wpeasysoft'); ?>" />

          <input type="hidden" name="post_type" value="docs" />

          <button type="submit"
            class="px-6 py-3 bg-primary text-white rounded-xl font-semibold hover:bg-primary/80 transition">
            <?php esc_html_e('Search', 'wpeasysoft'); ?>
          </button>
        </div>
      </form>
    </section>

    <!-- Results Section -->
    <section id="contentArea" class="mt-12">
      <div id="noResults" class="hidden text-center text-red-600 text-lg">
        <?php esc_html_e('No results found', 'wpeasysoft'); ?>
      </div>

      <?php
      $categories = get_pages([
        'parent'     => 0,
        'post_type'  => 'docs',
        'sort_order' => 'DESC',
      ]);

      if ($categories):
        foreach ($categories as $category):
          ?>

          <section class="collection-category mb-14">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">
              <a href="<?php echo esc_url(get_permalink($category)); ?>" class="hover:text-primary transition">
                <?php echo esc_html($category->post_title); ?>
              </a>
            </h2>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

              <?php
              $childrens = get_pages([
                'child_of'  => $category->ID,
                'post_type' => 'docs',
              ]);

              foreach ($childrens as $children):
                if ($children->post_parent === $category->ID):
                  ?>

                  <a href="<?php echo esc_url(get_permalink($children->ID)); ?>"
                    class="block p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:border-primary hover:shadow-md transition">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">
                      <?php echo esc_html($children->post_title); ?>
                    </h3>

                    <?php
                    $items = get_pages([
                      'child_of'  => $children->ID,
                      'post_type' => 'docs',
                    ]);
                    ?>

                    <p class="text-sm text-gray-600">
                      <?php echo count($items) > 0 ? count($items) . ' articles' : '0 article'; ?>
                    </p>
                  </a>

                  <?php
                endif;
              endforeach;
              ?>

            </div>
          </section>

          <?php
        endforeach;
      endif;
      ?>

    </section>
  </div>
</div>

<!-- END WP_EASYSOFT DOCS SECTION -->

<?php get_footer(); ?>

