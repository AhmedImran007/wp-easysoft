import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
	const {
		title,
		subtitle,
		primaryButtonText,
		primaryButtonURL,
		secondaryButtonText,
		secondaryButtonURL,
		plugins,
	} = attributes;

	const blockProps = useBlockProps({
		className: 'gradient-bg text-white py-20',
	});

	const updatePlugin = (index, field, value) => {
		const newPlugins = [...plugins];
		newPlugins[index][field] = value;
		setAttributes({ plugins: newPlugins });
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title="Buttons" initialOpen={true}>
					<TextControl
						label="Primary Button Text"
						value={primaryButtonText}
						onChange={(v) =>
							setAttributes({ primaryButtonText: v })
						}
					/>
					<TextControl
						label="Primary Button URL"
						value={primaryButtonURL}
						onChange={(v) => setAttributes({ primaryButtonURL: v })}
					/>

					<hr />

					<TextControl
						label="Secondary Button Text"
						value={secondaryButtonText}
						onChange={(v) =>
							setAttributes({ secondaryButtonText: v })
						}
					/>
					<TextControl
						label="Secondary Button URL"
						value={secondaryButtonURL}
						onChange={(v) =>
							setAttributes({ secondaryButtonURL: v })
						}
					/>
				</PanelBody>

				<PanelBody title="Plugins" initialOpen={false}>
					{plugins.map((plugin, i) => (
						<div key={i} style={{ marginBottom: '18px' }}>
							<TextControl
								label={`Plugin ${i + 1} Icon Class`}
								value={plugin.icon}
								onChange={(v) => updatePlugin(i, 'icon', v)}
								help="Font Awesome icon class (e.g., fas fa-map-marked-alt)"
							/>

							<TextControl
								label={`Plugin ${i + 1} Name`}
								value={plugin.name}
								onChange={(v) => updatePlugin(i, 'name', v)}
							/>
						</div>
					))}
				</PanelBody>
			</InspectorControls>

			<section {...blockProps}>
				<div className="container mx-auto px-4">
					<div className="mx-auto max-w-4xl text-center">
						{/* Title */}
						<RichText
							tagName="h2"
							className="mb-6 text-4xl font-bold text-white md:text-5xl"
							value={title}
							onChange={(v) => setAttributes({ title: v })}
							placeholder="Hero title..."
							allowedFormats={[]}
						/>

						{/* Subtitle */}
						<RichText
							tagName="p"
							className="mb-8 text-xl opacity-90"
							value={subtitle}
							onChange={(v) => setAttributes({ subtitle: v })}
							placeholder="Hero subtitle..."
							allowedFormats={[]}
						/>

						{/* CTA Buttons */}
						<div className="flex flex-col justify-center gap-4 sm:flex-row">
							<a
								href={primaryButtonURL}
								className="btn-primary inline-block rounded-lg px-8 py-3 text-lg font-medium text-white"
							>
								<RichText
									tagName="span"
									value={primaryButtonText}
									onChange={(v) =>
										setAttributes({ primaryButtonText: v })
									}
									placeholder="Primary button"
									allowedFormats={[]}
								/>
							</a>

							<a
								href={secondaryButtonURL}
								className="btn-secondary text-primary inline-block rounded-lg bg-white px-8 py-3 text-lg font-medium hover:bg-gray-100"
							>
								<RichText
									tagName="span"
									value={secondaryButtonText}
									onChange={(v) =>
										setAttributes({
											secondaryButtonText: v,
										})
									}
									placeholder="Secondary button"
									allowedFormats={[]}
								/>
							</a>
						</div>

						{/* Plugins Showcase */}
						<div className="mt-12 flex items-center justify-center space-x-6">
							<div className="text-center">
								<div className="flex h-40 w-64 items-center justify-center rounded-lg bg-white/20 p-4 backdrop-blur-sm">
									<span className="text-white/70">
										Plugin Preview Image
									</span>
								</div>
							</div>
							<div className="flex flex-col space-y-4">
								{plugins.map((plugin, index) => (
									<div
										key={index}
										className="flex items-center space-x-3 rounded-lg bg-white/20 p-3 backdrop-blur-sm"
									>
										<i
											className={`${plugin.icon} text-2xl`}
										></i>
										<RichText
											tagName="span"
											value={plugin.name}
											onChange={(v) =>
												updatePlugin(index, 'name', v)
											}
											placeholder="Plugin name"
											allowedFormats={[]}
										/>
									</div>
								))}
							</div>
						</div>
					</div>
				</div>
			</section>
		</>
	);
}
