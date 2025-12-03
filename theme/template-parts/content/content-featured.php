<?php
/**
 * Full Width Featured Post Template
 *
 * @package _tw
 */
?>

<div class="blog-card bg-white rounded-xl overflow-hidden shadow-md mb-10">

  <div class="relative">
    <?php if (has_post_thumbnail()): ?>
      <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail('large', ['class' => 'w-full h-72 md:h-96 object-cover']); ?>
      </a>
    <?php else: ?>
      <a href="<?php the_permalink(); ?>">
        <img src="https://picsum.photos/seed/featured/900/500" class="w-full h-72 md:h-96 object-cover"
          alt="<?php the_title(); ?>">
      </a>
    <?php endif; ?>

    <div class="absolute top-4 left-4 flex flex-wrap gap-2">
      <!-- Featured Badge -->
      <span class="bg-primary text-white px-3 py-1 rounded-full text-xs font-medium">
        Featured
      </span>

      <!-- Category Badge -->
      <?php
      $categories = get_the_category();
      if (!empty($categories)):
        $primary_category = $categories[0];
        ?>
        <a href="<?php echo esc_url(get_category_link($primary_category->term_id)); ?>"
          class="bg-white text-primary px-3 py-1 rounded-full text-xs font-medium hover:bg-primary-light hover:text-white transition">
          <?php echo esc_html($primary_category->name); ?>
        </a>
      <?php endif; ?>
    </div>
  </div>

  <div class="p-6 md:p-8">

    <!-- Meta Info -->
    <div class="flex items-center text-sm text-gray-500 mb-3">
      <span class="mr-2">By <?php the_author(); ?></span>
      <span class="mx-2">•</span>
      <span class="mr-2"><?php echo get_the_date('F j, Y'); ?></span>
      <span class="mx-2">•</span>
      <span>
        <?php
        $content   = get_post_field('post_content', get_the_ID());
        $read_time = ceil(str_word_count(strip_tags($content)) / 200);
        echo $read_time . ' min read';
        ?>
      </span>
    </div>

    <!-- Title -->
    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-primary">
      <a href="<?php the_permalink(); ?>" class="hover:text-primary-light transition">
        <?php the_title(); ?>
      </a>
    </h2>

    <!-- Excerpt -->
    <p class="text-gray-700 text-lg mb-4">
      <?php echo wp_trim_words(get_the_excerpt(), 40); ?>
    </p>

    <!-- Read More -->
    <a href="<?php the_permalink(); ?>"
      class="inline-block text-primary font-semibold hover:text-primary-light transition">
      Read More →
    </a>

  </div>
</div>
