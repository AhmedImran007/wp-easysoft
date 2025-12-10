<?php
// This file is generated. Do not modify it manually.
return array(
	'contact-hero' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'wp-easysoft/contact-hero',
		'title' => 'Contact Page Hero',
		'category' => 'layout',
		'icon' => 'email',
		'description' => 'A hero section for contact pages with support statistics.',
		'keywords' => array(
			'contact',
			'hero',
			'support',
			'stats',
			'help'
		),
		'textdomain' => 'wp-easysoft',
		'attributes' => array(
			'title' => array(
				'type' => 'string',
				'default' => 'How Can We Help You?'
			),
			'description' => array(
				'type' => 'string',
				'default' => 'Our dedicated support team is here to help you succeed with our WordPress plugins. Multiple ways to get the assistance you need.'
			),
			'stats' => array(
				'type' => 'array',
				'default' => array(
					array(
						'value' => '24h',
						'label' => 'Average Response Time'
					),
					array(
						'value' => '98%',
						'label' => 'Customer Satisfaction'
					),
					array(
						'value' => '1000+',
						'label' => 'Tickets Resolved'
					)
				)
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false
		),
		'editorScript' => 'file:./index.js',
		'render' => 'file:./render.php'
	),
	'contact-info' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'wp-easysoft/contact-info',
		'title' => 'Contact Information',
		'category' => 'layout',
		'icon' => 'share',
		'description' => 'Display contact information and social media links in a grid layout.',
		'keywords' => array(
			'contact',
			'social',
			'email',
			'channels',
			'info'
		),
		'textdomain' => 'wp-easysoft',
		'attributes' => array(
			'title' => array(
				'type' => 'string',
				'default' => 'Other Ways to Reach Us'
			),
			'description' => array(
				'type' => 'string',
				'default' => 'Multiple channels to stay connected and get updates'
			),
			'contactItems' => array(
				'type' => 'array',
				'default' => array(
					array(
						'icon' => 'fas fa-envelope',
						'title' => 'Email',
						'subtitle' => 'General inquiries',
						'linkText' => 'support@wpeasysoft.com',
						'linkURL' => 'mailto:support@wpeasysoft.com',
						'linkType' => 'email'
					),
					array(
						'icon' => 'fab fa-twitter',
						'title' => 'Twitter',
						'subtitle' => 'Updates and tips',
						'linkText' => '@wpeasysoft',
						'linkURL' => '#',
						'linkType' => 'social'
					),
					array(
						'icon' => 'fab fa-facebook',
						'title' => 'Facebook',
						'subtitle' => 'Community updates',
						'linkText' => 'WP EasySoft',
						'linkURL' => '#',
						'linkType' => 'social'
					),
					array(
						'icon' => 'fab fa-youtube',
						'title' => 'YouTube',
						'subtitle' => 'Video tutorials',
						'linkText' => 'WP EasySoft TV',
						'linkURL' => '#',
						'linkType' => 'social'
					)
				)
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false
		),
		'editorScript' => 'file:./index.js',
		'render' => 'file:./render.php'
	),
	'cta-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'wp-easysoft/cta-section',
		'title' => 'CTA Section',
		'category' => 'layout',
		'icon' => 'megaphone',
		'description' => 'A call-to-action section with features list and prominent button.',
		'keywords' => array(
			'cta',
			'call to action',
			'upgrade',
			'features',
			'pro'
		),
		'textdomain' => 'wp-easysoft',
		'attributes' => array(
			'title' => array(
				'type' => 'string',
				'default' => 'Upgrade to Easy Map PRO and Unlock Powerful Features'
			),
			'buttonText' => array(
				'type' => 'string',
				'default' => 'Buy Easy Map PRO'
			),
			'buttonURL' => array(
				'type' => 'string',
				'default' => '#'
			),
			'features' => array(
				'type' => 'array',
				'default' => array(
					'Custom Map Themes',
					'Marker Clustering',
					'Location Filters',
					'Unlimited Stores',
					'Priority Support',
					'Automatic Updates'
				)
			),
			'backgroundStyle' => array(
				'type' => 'string',
				'default' => 'gradient'
			),
			'textColor' => array(
				'type' => 'string',
				'default' => 'text-white'
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false
		),
		'editorScript' => 'file:./index.js',
		'render' => 'file:./render.php'
	),
	'faq' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'wp-easysoft/faq',
		'title' => 'FAQ Section',
		'category' => 'layout',
		'icon' => 'editor-help',
		'description' => 'A frequently asked questions section with expandable answers using Alpine.js.',
		'keywords' => array(
			'faq',
			'questions',
			'help',
			'support',
			'accordion',
			'alpine'
		),
		'textdomain' => 'wp-easysoft',
		'attributes' => array(
			'title' => array(
				'type' => 'string',
				'default' => 'Frequently Asked Questions'
			),
			'description' => array(
				'type' => 'string',
				'default' => 'Quick answers to common support questions'
			),
			'faqs' => array(
				'type' => 'array',
				'default' => array(
					array(
						'question' => 'How long does it take to get a response?',
						'answer' => 'Response times vary by priority level: Critical issues within 2 hours, High within 6 hours, Medium within 24 hours, and Low within 48 hours. PRO users receive priority support with faster response times.',
						'open' => false
					),
					array(
						'question' => 'Do you offer phone support?',
						'answer' => 'We currently offer support through tickets, live chat, and our community forum. Phone support is available for Enterprise customers with custom agreements.',
						'open' => false
					),
					array(
						'question' => 'What information should I include in my support ticket?',
						'answer' => 'Please include: WordPress version, PHP version, plugin version, detailed description of the issue, steps to reproduce, any error messages, and screenshots if applicable. The more detail you provide, the faster we can help.',
						'open' => false
					),
					array(
						'question' => 'Is there a limit to support tickets?',
						'answer' => 'PRO users have unlimited support tickets. Free users can submit up to 3 tickets per month. Community forum is always available for unlimited questions.',
						'open' => false
					),
					array(
						'question' => 'Do you help with custom development?',
						'answer' => 'Yes! We offer custom development services for WordPress plugin customization and new feature development. Contact us with your requirements for a quote.',
						'open' => false
					)
				)
			),
			'accordionMode' => array(
				'type' => 'boolean',
				'default' => false
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false
		),
		'editorScript' => 'file:./index.js',
		'render' => 'file:./render.php'
	),
	'featured-plugin' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'wp-easysoft/featured-plugin',
		'title' => 'Featured Plugin',
		'category' => 'layout',
		'icon' => 'location',
		'description' => 'A featured plugin showcase section with features and call-to-action.',
		'keywords' => array(
			'plugin',
			'featured',
			'showcase',
			'map',
			'store locator'
		),
		'textdomain' => 'wp-easysoft',
		'attributes' => array(
			'title' => array(
				'type' => 'string',
				'default' => '🚀 Introducing Easy Map — The Ultimate WordPress Store Locator Plugin'
			),
			'description' => array(
				'type' => 'string',
				'default' => 'Create beautiful, customizable maps using Google Maps, OpenStreetMap, or Leaflet — with powerful features like clustering, filters, search, and unlimited locations.'
			),
			'features' => array(
				'type' => 'array',
				'default' => array(
					'Google Maps + OSM + Leaflet',
					'Store Locator',
					'Clustering',
					'Unlimited Markers',
					'Custom Map Styles',
					'WooCommerce Support'
				)
			),
			'primaryButtonText' => array(
				'type' => 'string',
				'default' => 'Get Easy Map PRO'
			),
			'primaryButtonURL' => array(
				'type' => 'string',
				'default' => '#'
			),
			'secondaryButtonText' => array(
				'type' => 'string',
				'default' => 'Free Version on WP.org'
			),
			'secondaryButtonURL' => array(
				'type' => 'string',
				'default' => '#'
			),
			'imageURL' => array(
				'type' => 'string',
				'default' => 'https://picsum.photos/seed/easymapinterface/600/400.jpg'
			),
			'imageAlt' => array(
				'type' => 'string',
				'default' => 'Easy Map Interface'
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false
		),
		'editorScript' => 'file:./index.js',
		'render' => 'file:./render.php'
	),
	'hero' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'wp-easysoft/hero',
		'title' => 'WP EasySoft Hero',
		'category' => 'layout',
		'icon' => 'cover-image',
		'description' => 'A hero section for WP EasySoft with plugins showcase.',
		'keywords' => array(
			'hero',
			'banner',
			'plugins',
			'wordpress'
		),
		'textdomain' => 'wp-easysoft',
		'attributes' => array(
			'title' => array(
				'type' => 'string',
				'default' => 'Build Better WordPress Websites With Powerful & Easy-to-Use Plugins'
			),
			'subtitle' => array(
				'type' => 'string',
				'default' => 'High-quality plugins for maps, videos, product galleries, and seamless integrations — trusted by WordPress professionals worldwide.'
			),
			'primaryButtonText' => array(
				'type' => 'string',
				'default' => 'View All Plugins'
			),
			'primaryButtonURL' => array(
				'type' => 'string',
				'default' => '#plugins'
			),
			'secondaryButtonText' => array(
				'type' => 'string',
				'default' => 'Get Easy Map PRO'
			),
			'secondaryButtonURL' => array(
				'type' => 'string',
				'default' => '#'
			),
			'plugins' => array(
				'type' => 'array',
				'default' => array(
					array(
						'name' => 'Easy Map',
						'icon' => 'fas fa-map-marked-alt'
					),
					array(
						'name' => 'VideoJS Player',
						'icon' => 'fas fa-video'
					),
					array(
						'name' => 'Data Sync',
						'icon' => 'fas fa-sync'
					),
					array(
						'name' => 'Elementor Addons',
						'icon' => 'fas fa-cube'
					),
					array(
						'name' => 'Product Gallery',
						'icon' => 'fas fa-shopping-cart'
					)
				)
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false
		),
		'editorScript' => 'file:./index.js',
		'render' => 'file:./render.php'
	),
	'plugins-grid' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'wp-easysoft/plugins-grid',
		'title' => 'Plugins Grid',
		'category' => 'layout',
		'icon' => 'admin-plugins',
		'description' => 'Display a grid of WordPress plugins from the custom post type.',
		'keywords' => array(
			'plugins',
			'grid',
			'showcase',
			'wordpress'
		),
		'textdomain' => 'wp-easysoft',
		'attributes' => array(
			'title' => array(
				'type' => 'string',
				'default' => 'Our WordPress Plugins'
			),
			'description' => array(
				'type' => 'string',
				'default' => 'Enhance your site with lightweight, high-performance tools.'
			),
			'numberOfPosts' => array(
				'type' => 'number',
				'default' => 6
			),
			'orderBy' => array(
				'type' => 'string',
				'default' => 'date'
			),
			'order' => array(
				'type' => 'string',
				'default' => 'desc'
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false
		),
		'editorScript' => 'file:./index.js',
		'render' => 'file:./render.php'
	),
	'social-proof' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'wp-easysoft/social-proof',
		'title' => 'Social Proof Features',
		'category' => 'layout',
		'icon' => 'awards',
		'description' => 'A social proof section showcasing key features and compatibility.',
		'keywords' => array(
			'social proof',
			'features',
			'compatibility',
			'trust'
		),
		'textdomain' => 'wp-easysoft',
		'attributes' => array(
			'features' => array(
				'type' => 'array',
				'default' => array(
					array(
						'icon' => 'fas fa-feather-alt',
						'text' => 'Lightweight Code'
					),
					array(
						'icon' => 'fas fa-sync-alt',
						'text' => 'Regular Updates'
					),
					array(
						'icon' => 'fas fa-shopping-basket',
						'text' => 'WooCommerce Ready'
					),
					array(
						'icon' => 'fab fa-wordpress',
						'text' => 'Gutenberg Compatible'
					),
					array(
						'icon' => 'fab fa-elementor',
						'text' => 'Elementor Compatible'
					),
					array(
						'icon' => 'fas fa-headset',
						'text' => 'Fast Support'
					)
				)
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false
		),
		'editorScript' => 'file:./index.js',
		'render' => 'file:./render.php'
	),
	'support-form' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'wp-easysoft/support-form',
		'title' => 'Support Ticket Form',
		'category' => 'layout',
		'icon' => 'forms',
		'description' => 'A support ticket form with Contact Form 7 integration and customizable sidebar info.',
		'keywords' => array(
			'support',
			'contact',
			'form',
			'ticket',
			'cf7'
		),
		'textdomain' => 'wp-easysoft',
		'attributes' => array(
			'title' => array(
				'type' => 'string',
				'default' => 'Submit a Support Ticket'
			),
			'description' => array(
				'type' => 'string',
				'default' => 'Fill out the form below and we\'ll get back to you as soon as possible'
			),
			'cf7Shortcode' => array(
				'type' => 'string',
				'default' => ''
			),
			'proTips' => array(
				'type' => 'array',
				'default' => array(
					'Include your WordPress version',
					'Mention your PHP version',
					'Describe steps to reproduce the issue',
					'Include error messages if any'
				)
			),
			'responseTimes' => array(
				'type' => 'array',
				'default' => array(
					array(
						'priority' => 'Critical',
						'time' => 'Within 2 hours'
					),
					array(
						'priority' => 'High',
						'time' => 'Within 6 hours'
					),
					array(
						'priority' => 'Medium',
						'time' => 'Within 24 hours'
					),
					array(
						'priority' => 'Low',
						'time' => 'Within 48 hours'
					)
				)
			),
			'proSupportText' => array(
				'type' => 'string',
				'default' => 'PRO users get priority support with faster response times and dedicated assistance.'
			),
			'proUpgradeLink' => array(
				'type' => 'string',
				'default' => '#'
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false
		),
		'editorScript' => 'file:./index.js',
		'render' => 'file:./render.php'
	),
	'support-options' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'wp-easysoft/support-options',
		'title' => 'Support Options',
		'category' => 'layout',
		'icon' => 'format-chat',
		'description' => 'Display different support channels with features and action buttons.',
		'keywords' => array(
			'support',
			'contact',
			'help',
			'channels',
			'options'
		),
		'textdomain' => 'wp-easysoft',
		'attributes' => array(
			'title' => array(
				'type' => 'string',
				'default' => 'Choose Your Support Channel'
			),
			'description' => array(
				'type' => 'string',
				'default' => 'Different ways to get help based on your needs and urgency'
			),
			'options' => array(
				'type' => 'array',
				'default' => array(
					array(
						'title' => 'Support Ticket',
						'icon' => 'fas fa-ticket-alt',
						'description' => 'Get personalized help from our expert team for complex issues',
						'features' => array(
							'Priority response for PRO users',
							'Detailed troubleshooting',
							'Screen sharing available'
						),
						'buttonText' => 'Open Ticket',
						'buttonURL' => '#ticket-form',
						'buttonStyle' => 'primary',
						'buttonAction' => 'link'
					),
					array(
						'title' => 'Live Chat',
						'icon' => 'fas fa-comments',
						'description' => 'Get instant help for quick questions and guidance',
						'features' => array(
							'Available weekdays 9-5 EST',
							'Instant responses',
							'Real-time collaboration'
						),
						'buttonText' => 'Start Chat',
						'buttonURL' => '#',
						'buttonStyle' => 'success',
						'buttonAction' => 'link'
					),
					array(
						'title' => 'Community Forum',
						'icon' => 'fas fa-users',
						'description' => 'Connect with other users and share solutions',
						'features' => array(
							'Free for everyone',
							'Community knowledge base',
							'User-generated solutions'
						),
						'buttonText' => 'Visit Forum',
						'buttonURL' => '#',
						'buttonStyle' => 'outline',
						'buttonAction' => 'link'
					),
					array(
						'title' => 'Documentation',
						'icon' => 'fas fa-book',
						'description' => 'Self-service guides and tutorials for all features',
						'features' => array(
							'Step-by-step guides',
							'Video tutorials',
							'Code examples'
						),
						'buttonText' => 'Browse Docs',
						'buttonURL' => '#',
						'buttonStyle' => 'outline',
						'buttonAction' => 'link'
					)
				)
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false
		),
		'editorScript' => 'file:./index.js',
		'render' => 'file:./render.php'
	),
	'testimonials' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'wp-easysoft/testimonials',
		'title' => 'Testimonials',
		'category' => 'layout',
		'icon' => 'testimonial',
		'description' => 'Display customer testimonials and reviews in a beautiful grid layout.',
		'keywords' => array(
			'testimonials',
			'reviews',
			'quotes',
			'customers'
		),
		'textdomain' => 'wp-easysoft',
		'attributes' => array(
			'title' => array(
				'type' => 'string',
				'default' => 'What Our Customers Say'
			),
			'description' => array(
				'type' => 'string',
				'default' => 'Join thousands of satisfied WordPress users who trust our plugins'
			),
			'testimonials' => array(
				'type' => 'array',
				'default' => array(
					array(
						'name' => 'Sarah Johnson',
						'role' => 'Web Developer',
						'company' => 'Creative Agency',
						'content' => 'Easy Map plugin saved me hours of work! The interface is intuitive and the documentation is excellent. My clients love the store locator feature.',
						'rating' => 5,
						'avatar' => ''
					),
					array(
						'name' => 'Mike Chen',
						'role' => 'E-commerce Manager',
						'company' => 'Online Store',
						'content' => 'The Product Video Gallery transformed our WooCommerce store. Sales increased by 30% after adding video demonstrations to our products.',
						'rating' => 5,
						'avatar' => ''
					),
					array(
						'name' => 'Emily Rodriguez',
						'role' => 'Blog Owner',
						'company' => 'Travel Blog',
						'content' => 'Lightweight, fast, and exactly what I needed. The support team is incredibly responsive and helpful. Highly recommended!',
						'rating' => 5,
						'avatar' => ''
					)
				)
			),
			'columns' => array(
				'type' => 'string',
				'default' => '3'
			),
			'backgroundColor' => array(
				'type' => 'string',
				'default' => 'bg-white'
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false
		),
		'editorScript' => 'file:./index.js',
		'render' => 'file:./render.php'
	),
	'why-choose' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'wp-easysoft/why-choose',
		'title' => 'Why Choose Us',
		'category' => 'layout',
		'icon' => 'heart',
		'description' => 'A section showcasing reasons to choose WP EasySoft plugins.',
		'keywords' => array(
			'features',
			'benefits',
			'why choose',
			'advantages'
		),
		'textdomain' => 'wp-easysoft',
		'attributes' => array(
			'title' => array(
				'type' => 'string',
				'default' => 'Why Website Owners Love Our Plugins'
			),
			'features' => array(
				'type' => 'array',
				'default' => array(
					array(
						'icon' => 'fas fa-bolt',
						'title' => 'Lightweight & Fast',
						'description' => 'Optimized coding ensures no performance impact.'
					),
					array(
						'icon' => 'fas fa-tools',
						'title' => 'Easy to Use',
						'description' => 'Simple UI, straightforward settings, and clean documentation.'
					),
					array(
						'icon' => 'fas fa-sync-alt',
						'title' => 'Regular Updates',
						'description' => 'Continuous improvements and new features.'
					),
					array(
						'icon' => 'fas fa-headset',
						'title' => 'Priority Support (PRO)',
						'description' => 'Fast response and real-time assistance for PRO customers.'
					)
				)
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false
		),
		'editorScript' => 'file:./index.js',
		'render' => 'file:./render.php'
	)
);
