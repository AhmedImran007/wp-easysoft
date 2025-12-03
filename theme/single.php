<?php
/**
 * The template for displaying all single posts
 *
 * @package WP_EasySoft
 */

get_header();
$reading_time = wp_estimate_reading_time(get_the_content());
?>

<!-- Breadcrumb -->
<section class=" not-prose py-4 bg-white border-b">
	<div class="max-w-7xl mx-auto px-4">
		<nav class="flex items-center space-x-2 text-sm">
			<a href="<?php echo home_url(); ?>" class="text-gray-500 hover:text-primary transition">Home</a>
			<i class="fas fa-chevron-right text-gray-400 text-xs"></i>
			<a href="<?php echo get_post_type_archive_link('post'); ?>"
				class="text-gray-500 hover:text-primary transition">Blog</a>
			<i class="fas fa-chevron-right text-gray-400 text-xs"></i>
			<span class="text-primary"><?php the_title(); ?></span>
		</nav>
	</div>
</section>

<!-- Article Header -->
<section class="not-prose py-12 bg-white">
	<div class="max-w-4xl mx-auto px-4">
		<div class="text-center mb-8">
			<?php if (has_category('featured')): ?>
				<span class="accent-light-bg accent-color px-3 py-1 rounded-full text-sm font-medium">Featured Tutorial</span>
			<?php endif; ?>

			<h1 class="text-3xl md:text-4xl font-bold text-primary mt-4 mb-6"><?php the_title(); ?></h1>

			<div class="flex flex-wrap justify-center items-center gap-4 text-gray-600">
				<div class="flex items-center gap-2">
					<?php
					$user_id = get_post_field('post_author', get_the_ID());
					$user    = get_userdata($user_id);


					if ($user) {
						echo get_avatar($user_id, 40, '', '', array('class' => 'w-10 h-10 rounded-full'));
					} else {
						// Fallback avatar if user doesn't exist
						echo '<div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center text-white font-semibold">A</div>';
					}
					?>
					<div class="text-left">
						<div class="font-medium text-gray-800">
							<?php
							if ($user) {
								echo esc_html($user->display_name ?: $user->user_login);
							} else {
								echo __('Author', 'wp-easysoft');
							}
							?>
						</div>
						<div class="text-sm text-gray-600"><?php echo wp_get_user_role_display_name($user_id); ?></div>
					</div>
				</div>
				<span>•</span>
				<time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
				<span>•</span>
				<span><?php echo $reading_time; ?> min read</span>
			</div>
		</div>

		<!-- Featured Image -->
		<?php if (has_post_thumbnail()): ?>
			<?php
			$image_id     = get_post_thumbnail_id();
			$image_alt    = get_the_title();
			$image_src    = wp_get_attachment_image_src($image_id, 'full');
			$image_srcset = wp_get_attachment_image_srcset($image_id, 'full');

			// Generate responsive sizes attribute
			$image_sizes = '(max-width: 640px) 100vw, (max-width: 768px) 90vw, (max-width: 1024px) 80vw, 1200px';

			if ($image_src):
				// Calculate natural aspect ratio for padding trick
				$width        = $image_src[1];
				$height       = $image_src[2];
				$aspect_ratio = ($height / $width) * 100;
				?>
				<div class="featured-image-wrapper w-full max-w-4xl mx-auto rounded-xl shadow-lg overflow-hidden bg-gray-100">
					<!-- Aspect ratio container -->
					<div class="relative" style="padding-bottom: 50%;"> <!-- 600/1200 = 0.5 = 50% -->
						<img src="<?php echo esc_url($image_src[0]); ?>" srcset="<?php echo esc_attr($image_srcset); ?>"
							sizes="<?php echo esc_attr($image_sizes); ?>" alt="<?php echo esc_attr($image_alt); ?>" width="1200"
							height="600" class="absolute inset-0 w-full h-full object-cover" loading="eager" decoding="async" />

						<!-- Optional: Add focal point or overlay -->
						<div
							class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300">
						</div>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</section>

<!-- Article Content -->
<section class="py-12">
	<div class="max-w-4xl mx-auto px-4">
		<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
			<!-- Table of Contents (Desktop) -->
			<div class="hidden lg:block lg:col-span-1">
				<div class="sticky top-24">
					<div class="bg-white rounded-xl p-6 shadow-md">
						<h3 class="font-bold text-primary mb-4">Table of Contents</h3>
						<nav class="space-y-2" id="toc-nav">
							<!-- Table of contents will be populated by JavaScript -->
						</nav>
					</div>
				</div>
			</div>

			<!-- Main Content -->
			<div class="lg:col-span-3">
				<article class="prose max-w-none">
					<?php
					while (have_posts()):
						the_post();
						the_content();

						// Pagination for multi-page posts
						wp_link_pages(array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'wp-easysoft') . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
							'pagelink'    => '<span class="screen-reader-text">' . __('Page', 'wp-easysoft') . ' </span>%',
							'separator'   => '<span class="screen-reader-text">, </span>',
						));
					endwhile;
					?>
				</article>

				<!-- Tags -->
				<?php if (has_tag()): ?>
					<div class="mt-12 pt-8 border-t">
						<h3 class="font-bold text-primary mb-4">Tags</h3>
						<div class="flex flex-wrap gap-2">
							<?php
							$tags = get_the_tags();
							foreach ($tags as $tag):
								?>
								<a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"
									class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-primary hover:text-white transition">
									<?php echo esc_html($tag->name); ?>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>

				<!-- Social Sharing -->
				<div class="mt-12 pt-8 border-t">
					<h3 class="font-bold text-primary mb-4"><?php _e('Share this article', 'wp-easysoft'); ?></h3>
					<div class="flex gap-3">
						<?php
						$post_url      = urlencode(get_permalink());
						$post_title    = urlencode(get_the_title());
						$sharing_links = array(
							'facebook' => "https://www.facebook.com/sharer/sharer.php?u=$post_url",
							'twitter'  => "https://twitter.com/intent/tweet?text=$post_title&url=$post_url",
							'linkedin' => "https://www.linkedin.com/shareArticle?mini=true&url=$post_url&title=$post_title",
						);
						?>
						<a href="<?php echo $sharing_links['facebook']; ?>" target="_blank"
							class="social-share bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700">
							<i class="fab fa-facebook-f"></i>
						</a>
						<a href="<?php echo $sharing_links['twitter']; ?>" target="_blank"
							class="social-share bg-sky-500 text-white p-3 rounded-lg hover:bg-sky-600">
							<i class="fab fa-twitter"></i>
						</a>
						<a href="<?php echo $sharing_links['linkedin']; ?>" target="_blank"
							class="social-share bg-blue-700 text-white p-3 rounded-lg hover:bg-blue-800">
							<i class="fab fa-linkedin-in"></i>
						</a>
						<button onclick="copyToClipboard('<?php echo get_permalink(); ?>')"
							class="social-share bg-gray-800 text-white p-3 rounded-lg hover:bg-gray-900">
							<i class="fas fa-link"></i>
						</button>
					</div>
				</div>

				<!-- Author Bio -->
				<div class="mt-12 p-6 bg-gray-50 rounded-xl">
					<div class="flex gap-4">
						<!-- Avatar -->
						<?php echo get_avatar($user_id, 80, '', '', ['class' => 'w-20 h-20 rounded-full']); ?>

						<div>
							<!-- Name -->
							<h3 class="font-bold text-primary text-lg">
								<?php
								if ($user) {
									echo esc_html($user->display_name ?: $user->user_login);
								} else {
									echo __('Author', 'wp-easysoft');
								}
								?>
							</h3>

							<!-- Role -->
							<p class="text-gray-600 mb-2">
								<?php echo wp_get_user_role_display_name($user_id); ?>
							</p>

							<!-- Bio -->
							<p class="text-gray-600">
								<?php echo wp_kses_post(get_the_author_meta('description', $user_id)); ?>
							</p>

							<!-- Social Icons -->
							<div class="flex gap-3 mt-3">
								<?php if ($website = get_the_author_meta('user_url', $user_id)): ?>
									<a href="<?php echo esc_url($website); ?>" class="text-gray-500 hover:text-primary transition"
										target="_blank" title="Website">
										<i class="fas fa-globe"></i>
									</a>
								<?php endif; ?>

								<?php if ($twitter = get_the_author_meta('twitter', $user_id)): ?>
									<a href="<?php echo esc_url($twitter); ?>" class="text-gray-500 hover:text-primary transition"
										target="_blank" title="Twitter">
										<i class="fab fa-twitter"></i>
									</a>
								<?php endif; ?>

								<?php if ($linkedin = get_the_author_meta('linkedin', $user_id)): ?>
									<a href="<?php echo esc_url($linkedin); ?>" class="text-gray-500 hover:text-primary transition"
										target="_blank" title="LinkedIn">
										<i class="fab fa-linkedin"></i>
									</a>
								<?php endif; ?>

								<?php if ($github = get_the_author_meta('github', $user_id)): ?>
									<a href="<?php echo esc_url($github); ?>" class="text-gray-500 hover:text-primary transition"
										target="_blank" title="GitHub">
										<i class="fab fa-github"></i>
									</a>
								<?php endif; ?>

								<?php if ($facebook = get_the_author_meta('facebook', $user_id)): ?>
									<a href="<?php echo esc_url($facebook); ?>" class="text-gray-500 hover:text-primary transition"
										target="_blank" title="Facebook">
										<i class="fab fa-facebook"></i>
									</a>
								<?php endif; ?>

								<?php if ($instagram = get_the_author_meta('instagram', $user_id)): ?>
									<a href="<?php echo esc_url($instagram); ?>" class="text-gray-500 hover:text-primary transition"
										target="_blank" title="Instagram">
										<i class="fab fa-instagram"></i>
									</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>

				<!-- Post Navigation -->
				<?php
				$previous_post = get_previous_post();
				$next_post     = get_next_post();
				if ($previous_post || $next_post):
					?>
					<div class="mt-12 pt-8 border-t">
						<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
							<?php if ($previous_post): ?>
								<a href="<?php echo get_permalink($previous_post); ?>" class="group">
									<div class="flex items-center gap-4">
										<div
											class="flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform duration-300">
											<i class="fas fa-chevron-left"></i>
										</div>
										<div>
											<span class="text-sm text-gray-500 font-medium"><?php _e('Previous', 'wp-easysoft'); ?></span>
											<h5
												class="text-base font-semibold text-gray-900 group-hover:text-primary transition-colors line-clamp-1">
												<?php echo get_the_title($previous_post); ?>
											</h5>

										</div>
									</div>
								</a>
							<?php endif; ?>

							<?php if ($next_post): ?>
								<a href="<?php echo get_permalink($next_post); ?>" class="group md:text-right md:justify-end">
									<div class="flex items-center gap-4 md:flex-row-reverse">
										<div
											class="flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform duration-300">
											<i class="fas fa-chevron-right"></i>
										</div>
										<div>
											<span class="text-sm text-gray-500 font-medium"><?php _e('Next', 'wp-easysoft'); ?></span>
											<h5
												class="text-base font-semibold text-gray-900 group-hover:text-primary transition-colors  line-clamp-1">
												<?php echo get_the_title($next_post); ?>
											</h5>
										</div>
									</div>
								</a>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<!-- Related Posts -->
<?php
$related = get_posts(array(
	'category__in' => wp_get_post_categories(get_the_ID()),
	'numberposts'  => 3,
	'post__not_in' => array(get_the_ID()),
	'orderby'      => 'rand'
));

if ($related):
	?>
	<section class="py-12 bg-white">
		<div class="max-w-7xl mx-auto px-4">
			<h2 class="text-2xl font-bold text-primary mb-8"><?php _e('Related Articles', 'wp-easysoft'); ?></h2>
			<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
				<?php foreach ($related as $post):
					setup_postdata($post); ?>
					<div class="related-card bg-white rounded-xl overflow-hidden shadow-md border border-gray-100">
						<?php if (has_post_thumbnail()): ?>
							<?php the_post_thumbnail('medium', array(
								'class' => 'w-full h-48 object-cover',
								'alt'   => get_the_title()
							)); ?>
						<?php else: ?>
							<div class="w-full h-48 bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
								<i class="fas fa-newspaper text-white text-4xl"></i>
							</div>
						<?php endif; ?>
						<div class="p-5">
							<span class="text-sm text-gray-500"><?php echo get_the_date(); ?></span>
							<h3 class="font-bold text-primary mt-2 mb-2 line-clamp-2"><?php the_title(); ?></h3>
							<a href="<?php the_permalink(); ?>" class="text-primary font-medium hover:text-primary-light transition">
								<?php _e('Read More', 'wp-easysoft'); ?> →
							</a>
						</div>
					</div>
				<?php endforeach;
				wp_reset_postdata(); ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<!-- Comments Section -->
<?php if (comments_open() || get_comments_number()): ?>
	<section class="py-12">
		<div class="max-w-4xl mx-auto px-4">
			<h2 class="text-2xl font-bold text-primary mb-8">
				<?php _e('Comments', 'wp-easysoft'); ?>
				<?php if (get_comments_number() > 0): ?>
					<span class="text-gray-600">(<?php echo get_comments_number(); ?>)</span>
				<?php endif; ?>
			</h2>

			<?php comments_template(); ?>
		</div>
	</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="py-16 gradient-bg text-white">
	<div class="max-w-7xl mx-auto px-4">
		<div class="max-w-4xl mx-auto text-center">
			<h2 class="text-3xl font-bold mb-6"><?php _e('Ready to Build Your Store Locator?', 'wp-easysoft'); ?></h2>
			<p class="text-xl mb-8 opacity-90">
				<?php _e('Get Easy Map PRO today and start creating beautiful, interactive maps for your WordPress site.', 'wp-easysoft'); ?>
			</p>
			<a href="#"
				class="bg-white text-primary px-8 py-3 rounded-lg font-medium text-lg inline-block hover:bg-gray-100 transition">
				<?php _e('Get Easy Map PRO', 'wp-easysoft'); ?>
			</a>
		</div>
	</div>
</section>

<?php
get_footer();
