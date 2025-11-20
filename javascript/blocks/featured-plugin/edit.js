import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, TextControl, Button } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
	const {
		title,
		description,
		features,
		primaryButtonText,
		primaryButtonURL,
		secondaryButtonText,
		secondaryButtonURL,
		imageURL,
		imageAlt,
	} = attributes;

	const blockProps = useBlockProps({
		className: 'py-16 bg-gray-50',
	});

	const updateFeature = (index, value) => {
		const newFeatures = [...features];
		newFeatures[index] = value;
		setAttributes({ features: newFeatures });
	};

	const addFeature = () => {
		const newFeatures = [...features, __('New Feature', 'wp-easysoft')];
		setAttributes({ features: newFeatures });
	};

	const removeFeature = (index) => {
		const newFeatures = features.filter((_, i) => i !== index);
		setAttributes({ features: newFeatures });
	};

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={__('Plugin Details', 'wp-easysoft')}
					initialOpen={true}
				>
					<TextControl
						label={__('Primary Button Text', 'wp-easysoft')}
						value={primaryButtonText}
						onChange={(value) =>
							setAttributes({ primaryButtonText: value })
						}
					/>
					<TextControl
						label={__('Primary Button URL', 'wp-easysoft')}
						value={primaryButtonURL}
						onChange={(value) =>
							setAttributes({ primaryButtonURL: value })
						}
					/>
					<TextControl
						label={__('Secondary Button Text', 'wp-easysoft')}
						value={secondaryButtonText}
						onChange={(value) =>
							setAttributes({ secondaryButtonText: value })
						}
					/>
					<TextControl
						label={__('Secondary Button URL', 'wp-easysoft')}
						value={secondaryButtonURL}
						onChange={(value) =>
							setAttributes({ secondaryButtonURL: value })
						}
					/>
				</PanelBody>

				<PanelBody
					title={__('Image Settings', 'wp-easysoft')}
					initialOpen={false}
				>
					<TextControl
						label={__('Image URL', 'wp-easysoft')}
						value={imageURL}
						onChange={(value) => setAttributes({ imageURL: value })}
						help={__(
							'Enter the URL for the plugin screenshot',
							'wp-easysoft'
						)}
					/>
					<TextControl
						label={__('Image Alt Text', 'wp-easysoft')}
						value={imageAlt}
						onChange={(value) => setAttributes({ imageAlt: value })}
					/>
				</PanelBody>

				<PanelBody
					title={__('Features', 'wp-easysoft')}
					initialOpen={false}
				>
					<div className="block-editor-features-controls">
						{features.map((feature, index) => (
							<div
								key={index}
								className="feature-control"
								style={{
									marginBottom: '15px',
									padding: '12px',
									border: '1px solid #e0e0e0',
									borderRadius: '4px',
									display: 'flex',
									alignItems: 'center',
									gap: '10px',
								}}
							>
								<TextControl
									value={feature}
									onChange={(value) =>
										updateFeature(index, value)
									}
									placeholder={__(
										'Feature text...',
										'wp-easysoft'
									)}
									style={{ flex: 1 }}
								/>
								{features.length > 1 && (
									<Button
										isDestructive
										isSmall
										onClick={() => removeFeature(index)}
									>
										{__('Remove', 'wp-easysoft')}
									</Button>
								)}
							</div>
						))}

						<Button
							isPrimary
							onClick={addFeature}
							className="add-feature-button"
						>
							{__('Add Feature', 'wp-easysoft')}
						</Button>
					</div>
				</PanelBody>
			</InspectorControls>

			<section {...blockProps}>
				<div className="container mx-auto px-4">
					<div className="mx-auto max-w-5xl">
						{/* Title */}
						<RichText
							tagName="h2"
							className="mb-4 text-center text-3xl font-bold md:text-4xl"
							value={title}
							onChange={(value) =>
								setAttributes({ title: value })
							}
							placeholder={__('Plugin title...', 'wp-easysoft')}
							allowedFormats={[]}
						/>

						{/* Description */}
						<RichText
							tagName="p"
							className="mx-auto mb-10 max-w-3xl text-center text-xl text-gray-600"
							value={description}
							onChange={(value) =>
								setAttributes({ description: value })
							}
							placeholder={__(
								'Plugin description...',
								'wp-easysoft'
							)}
							allowedFormats={[]}
						/>

						<div className="overflow-hidden rounded-xl bg-white shadow-lg">
							<div className="md:flex">
								{/* Left Content */}
								<div className="flex flex-col justify-center p-8 md:w-1/2">
									{/* Features */}
									<div className="mb-6 flex flex-wrap gap-2">
										{features.map((feature, index) => (
											<span
												key={index}
												className="bg-primary-light text-primary rounded-full px-3 py-1 text-sm font-medium"
											>
												<RichText
													tagName="span"
													value={feature}
													onChange={(value) =>
														updateFeature(
															index,
															value
														)
													}
													placeholder={__(
														'Feature...',
														'wp-easysoft'
													)}
													allowedFormats={[]}
												/>
											</span>
										))}
									</div>

									{/* Buttons */}
									<div className="flex flex-col gap-4 sm:flex-row">
										<a
											href={primaryButtonURL}
											className="btn-primary rounded-lg px-6 py-3 text-center font-medium text-white"
										>
											<RichText
												tagName="span"
												value={primaryButtonText}
												onChange={(value) =>
													setAttributes({
														primaryButtonText:
															value,
													})
												}
												placeholder={__(
													'Primary button...',
													'wp-easysoft'
												)}
												allowedFormats={[]}
											/>
										</a>
										<a
											href={secondaryButtonURL}
											className="btn-secondary border-primary text-primary hover:bg-primary-light rounded-lg border px-6 py-3 text-center font-medium"
										>
											<RichText
												tagName="span"
												value={secondaryButtonText}
												onChange={(value) =>
													setAttributes({
														secondaryButtonText:
															value,
													})
												}
												placeholder={__(
													'Secondary button...',
													'wp-easysoft'
												)}
												allowedFormats={[]}
											/>
										</a>
									</div>
								</div>

								{/* Right Image */}
								<div className="md:w-1/2">
									<div className="flex h-64 w-full items-center justify-center bg-gray-200 md:h-full">
										<span className="text-gray-500">
											{imageURL
												? __(
														'Plugin Image Preview',
														'wp-easysoft'
													)
												: __(
														'No image set',
														'wp-easysoft'
													)}
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</>
	);
}
