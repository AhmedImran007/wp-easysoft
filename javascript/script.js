/**
 * Front-end JavaScript
 *
 * The JavaScript code you place here will be processed by esbuild. The output
 * file will be created at `../theme/js/script.min.js` and enqueued in
 * `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Generate table of contents from H2 headings
document.addEventListener('DOMContentLoaded', function () {
	const tocNav = document.getElementById('toc-nav');
	const article = document.querySelector('article');

	if (tocNav && article) {
		const headings = article.querySelectorAll('h2');
		if (headings.length > 0) {
			headings.forEach((heading, index) => {
				// Add ID to heading if not present
				if (!heading.id) {
					heading.id = 'section-' + (index + 1);
				}

				// Create TOC link
				const link = document.createElement('a');
				link.href = '#' + heading.id;
				link.className =
					'block text-sm text-gray-600 hover:text-primary transition';
				link.textContent = heading.textContent;

				tocNav.appendChild(link);
			});
		} else {
			tocNav.innerHTML =
				'<p class="text-sm text-gray-500">No sections available</p>';
		}
	}

	// Smooth scrolling for table of contents
	document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
		anchor.addEventListener('click', function (e) {
			e.preventDefault();
			const target = document.querySelector(this.getAttribute('href'));
			if (target) {
				target.scrollIntoView({
					behavior: 'smooth',
					block: 'start',
				});
			}
		});
	});

	// Highlight active section in table of contents
	window.addEventListener('scroll', function () {
		const sections = document.querySelectorAll('h2[id]');
		const tocLinks = document.querySelectorAll('#toc-nav a[href^="#"]');

		let current = '';
		sections.forEach((section) => {
			const sectionTop = section.offsetTop;
			const sectionHeight = section.clientHeight;
			if (pageYOffset >= sectionTop - 100) {
				current = section.getAttribute('id');
			}
		});

		tocLinks.forEach((link) => {
			link.classList.remove('text-primary', 'font-medium');
			link.classList.add('text-gray-600');
			if (link.getAttribute('href') === '#' + current) {
				link.classList.remove('text-gray-600');
				link.classList.add('text-primary', 'font-medium');
			}
		});
	});
});

// Copy link to clipboard
function copyToClipboard(text) {
	navigator.clipboard.writeText(text).then(
		function () {
			alert('Link copied to clipboard!');
		},
		function (err) {
			console.error('Could not copy text: ', err);
		}
	);
}

// Reading time calculation
function calculateReadingTime() {
	const content = document.querySelector('article').textContent;
	const wordsPerMinute = 200;
	const wordCount = content.trim().split(/\s+/).length;
	const readingTime = Math.ceil(wordCount / wordsPerMinute);
	return readingTime;
}
