<?php
/**
 * The template for displaying all pages
 *
 * @package WP_EasySoft
 */

get_header();
?>

<section id="primary" class="bg-gray-50">
	<main id="main" class="container">

		<?php
		/* Start the Loop */
		while (have_posts()):
			the_post();

			// Page content wrapper with Tailwind prose + spacing
			echo '<div class="prose prose-lg max-w-full mx-auto mb-12">';
			get_template_part('template-parts/content/content', 'page');
			echo '</div>';

			// Comments section styling
			if (comments_open() || get_comments_number()) {
				echo '<div class="max-w-4xl mx-auto mt-8 bg-white shadow rounded-xl p-6">';
				comments_template();
				echo '</div>';
			}

		endwhile;
		?>

	</main>
</section>

<?php
get_footer();
