<?php
/**
 * Template part for displaying single posts
 *
 * @package WP_EasySoft
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('prose lg:prose-lg max-w-full mb-12'); ?>>

	<!-- Post Header -->
	<header class="entry-header mb-6">
		<?php
		the_title(
			'<h1 class="entry-title text-4xl font-extrabold leading-tight text-gray-900">',
			'</h1>'
		);
		?>

		<?php if (!is_page()): ?>
			<div class="entry-meta mt-2 text-sm text-gray-500">
				<?php wp_easysoft_entry_meta(); ?>
			</div>
		<?php endif; ?>
	</header>

	<!-- Featured Image -->
	<?php if (has_post_thumbnail()): ?>
		<div class="mb-6">
			<?php wp_easysoft_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

	<!-- Post Content -->
	<div <?php wp_easysoft_content_class('entry-content text-gray-800 leading-relaxed'); ?>>
		<?php
		the_content(
			sprintf(
				wp_kses(
					__('Continue reading<span class="sr-only"> "%s"</span>', 'wp-easysoft'),
					array('span' => array('class' => array()))
				),
				get_the_title()
			)
		);

		wp_link_pages(array(
			'before' => '<div class="page-links mt-6 text-sm font-medium text-gray-600">' . __('Pages:', 'wp-easysoft'),
			'after'  => '</div>',
		));
		?>
	</div>

	<!-- Post Footer -->
	<footer class="entry-footer mt-10 border-t border-gray-200 pt-6 text-sm text-gray-500">
		<?php wp_easysoft_entry_footer(); ?>
	</footer>

</article>
