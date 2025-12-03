<?php
// This file is generated. Do not modify it manually.
return array(
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
