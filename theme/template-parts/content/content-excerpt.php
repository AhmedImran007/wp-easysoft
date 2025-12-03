<?php
/**
 * Blog Card for Archive & Search Pages
 *
 * @package _tw
 */
?>

<div class="blog-card bg-white rounded-xl overflow-hidden shadow-md">

	<!-- Thumbnail -->
	<?php if (has_post_thumbnail()): ?>
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail('medium_large', [
				'class' => 'w-full h-48 object-cover'
			]); ?>
		</a>
	<?php else: ?>
		<a href="<?php the_permalink(); ?>">
			<img src="https://picsum.photos/seed/noimage/400/250.jpg" class="w-full h-48 object-cover"
				alt="<?php the_title(); ?>">
		</a>
	<?php endif; ?>

	<div class="p-5">

		<!-- Category Badge -->
		<div class="mb-3">
			<?php
			$categories = get_the_category();
			if (!empty($categories)):
				$primary_category = $categories[0]; // Get the first category
				?>
				<a href="<?php echo esc_url(get_category_link($primary_category->term_id)); ?>"
					class="inline-block px-3 py-1 bg-primary-light text-primary text-xs font-medium rounded-full hover:bg-primary hover:text-white transition">
					<?php echo esc_html($primary_category->name); ?>
				</a>
			<?php endif; ?>
		</div>

		<!-- Meta Info -->
		<div class="flex items-center text-sm text-gray-500 mb-2">
			<span><?php echo get_the_date('F j, Y'); ?></span>
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
		<h3 class="text-xl font-bold mb-2 text-primary">
			<a href="<?php the_permalink(); ?>" class="hover:text-primary-light transition">
				<?php the_title(); ?>
			</a>
		</h3>

		<!-- Excerpt -->
		<p class="text-gray-600 mb-3">
			<?php echo wp_trim_words(get_the_excerpt(), 22); ?>
		</p>

		<!-- Read More -->
		<a href="<?php the_permalink(); ?>" class="text-primary font-medium hover:text-primary-light transition">
			Read More
		</a>

	</div>

</div>
