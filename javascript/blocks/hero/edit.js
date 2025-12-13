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
	} = attributes;

	const blockProps = useBlockProps({
		className: 'gradient-bg text-white py-20',
	});

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
					</div>
				</div>
			</section>
		</>
	);
}
