<?php
/**
 * Template part for displaying posts in a loop
 *
 * @package WP_EasySoft
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('prose lg:prose-lg max-w-full mb-12'); ?>>

	<!-- Header -->
	<header class="entry-header mb-4">
		<?php
		if (is_sticky() && is_home() && !is_paged()) {
			echo '<span class="inline-block px-2 py-1 text-xs font-semibold bg-yellow-200 text-yellow-800 rounded mb-2">Featured</span>';
		}

		if (is_singular()):
			the_title('<h1 class="entry-title text-3xl font-bold text-gray-900">', '</h1>');
		else:
			the_title(
				sprintf(
					'<h2 class="entry-title text-2xl font-semibold text-gray-900 hover:text-blue-600 transition">
                        <a href="%s" rel="bookmark">',
					esc_url(get_permalink())
				),
				'</a></h2>'
			);
		endif;
		?>
	</header>

	<!-- Featured Image -->
	<?php if (has_post_thumbnail()): ?>
		<div class="mb-4 entry-image">
			<?php wp_easysoft_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

	<!-- Content -->
	<div <?php wp_easysoft_content_class('entry-content text-gray-700 max-w-full'); ?>>
		<?php
		the_content(
			sprintf(
				wp_kses(
					__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'wp-easysoft'),
					array('span' => array('class'))
				),
				the_title('<span class="screen-reader-text">"', '"</span>', false)
			)
		);

		wp_link_pages(array(
			'before' => '<div class="page-links text-sm">Pages:',
			'after'  => '</div>',
		));
		?>
	</div>

	<!-- Footer -->
	<footer class="entry-footer mt-6 text-sm text-gray-500">
		<?php wp_easysoft_entry_footer(); ?>
	</footer>

</article>
