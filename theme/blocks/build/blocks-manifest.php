<?php
// This file is generated. Do not modify it manually.
return array(
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
	)
);
