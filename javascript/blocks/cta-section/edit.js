import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	Button,
	SelectControl,
} from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
	const {
		title,
		buttonText,
		buttonURL,
		features,
		backgroundStyle,
		textColor,
	} = attributes;

	const blockProps = useBlockProps({
		className: `py-16 ${backgroundStyle === 'gradient' ? 'gradient-bg' : 'bg-primary'} ${textColor}`,
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

	const moveFeature = (fromIndex, toIndex) => {
		const newFeatures = [...features];
		const [movedFeature] = newFeatures.splice(fromIndex, 1);
		newFeatures.splice(toIndex, 0, movedFeature);
		setAttributes({ features: newFeatures });
	};

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={__('CTA Settings', 'wp-easysoft')}
					initialOpen={true}
				>
					<TextControl
						label={__('Button Text', 'wp-easysoft')}
						value={buttonText}
						onChange={(value) =>
							setAttributes({ buttonText: value })
						}
					/>
					<TextControl
						label={__('Button URL', 'wp-easysoft')}
						value={buttonURL}
						onChange={(value) =>
							setAttributes({ buttonURL: value })
						}
					/>
					<SelectControl
						label={__('Background Style', 'wp-easysoft')}
						value={backgroundStyle}
						options={[
							{
								label: __('Gradient', 'wp-easysoft'),
								value: 'gradient',
							},
							{
								label: __('Solid Primary', 'wp-easysoft'),
								value: 'solid-primary',
							},
							{
								label: __('Solid Dark', 'wp-easysoft'),
								value: 'solid-dark',
							},
						]}
						onChange={(value) =>
							setAttributes({ backgroundStyle: value })
						}
					/>
					<SelectControl
						label={__('Text Color', 'wp-easysoft')}
						value={textColor}
						options={[
							{
								label: __('White', 'wp-easysoft'),
								value: 'text-white',
							},
							{
								label: __('Light', 'wp-easysoft'),
								value: 'text-gray-100',
							},
						]}
						onChange={(value) =>
							setAttributes({ textColor: value })
						}
					/>
				</PanelBody>

				<PanelBody
					title={__('Features', 'wp-easysoft')}
					initialOpen={false}
				>
					<div className="block-editor-cta-features-controls">
						{features.map((feature, index) => (
							<div
								key={index}
								className="cta-feature-control"
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
								<div className="flex gap-1">
									{index > 0 && (
										<Button
											isSmall
											onClick={() =>
												moveFeature(index, index - 1)
											}
											icon="arrow-up"
											label={__('Move up', 'wp-easysoft')}
										/>
									)}
									{index < features.length - 1 && (
										<Button
											isSmall
											onClick={() =>
												moveFeature(index, index + 1)
											}
											icon="arrow-down"
											label={__(
												'Move down',
												'wp-easysoft'
											)}
										/>
									)}
									{features.length > 1 && (
										<Button
											isDestructive
											isSmall
											onClick={() => removeFeature(index)}
											label={__('Remove', 'wp-easysoft')}
										>
											{__('Remove', 'wp-easysoft')}
										</Button>
									)}
								</div>
							</div>
						))}

						<Button
							isPrimary
							onClick={addFeature}
							className="cta-add-feature-button"
							style={{ width: '100%' }}
						>
							{__('Add Feature', 'wp-easysoft')}
						</Button>
					</div>
				</PanelBody>
			</InspectorControls>

			<section {...blockProps}>
				<div className="container mx-auto px-4">
					<div className="mx-auto max-w-4xl text-center">
						{/* Title */}
						<RichText
							tagName="h2"
							className="mb-6 text-3xl font-bold md:text-4xl"
							value={title}
							onChange={(value) =>
								setAttributes({ title: value })
							}
							placeholder={__(
								'Upgrade to PRO and Unlock Powerful Features',
								'wp-easysoft'
							)}
							allowedFormats={[]}
						/>

						{/* Features Grid */}
						<div className="mb-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
							{features.map((feature, index) => (
								<div
									key={index}
									className="flex items-center justify-center space-x-3 md:justify-start"
								>
									<i className="fas fa-check-circle text-2xl opacity-90"></i>
									<RichText
										tagName="span"
										className="text-lg font-medium"
										value={feature}
										onChange={(value) =>
											updateFeature(index, value)
										}
										placeholder={__(
											'Feature...',
											'wp-easysoft'
										)}
										allowedFormats={[]}
									/>
								</div>
							))}
						</div>

						{/* CTA Button */}
						<a
							href={buttonURL}
							className={`focus:ring-opacity-50 inline-block rounded-lg px-8 py-4 text-lg font-medium transition-all duration-300 hover:scale-105 hover:shadow-2xl focus:ring-4 focus:ring-white focus:outline-none ${
								backgroundStyle === 'gradient'
									? 'text-primary bg-white hover:bg-gray-100'
									: backgroundStyle === 'solid-primary'
										? 'text-primary bg-white hover:bg-gray-100'
										: 'bg-white text-gray-900 hover:bg-gray-100'
							} `}
						>
							<RichText
								tagName="span"
								value={buttonText}
								onChange={(value) =>
									setAttributes({ buttonText: value })
								}
								placeholder={__(
									'Buy PRO Version',
									'wp-easysoft'
								)}
								allowedFormats={[]}
							/>
						</a>
					</div>
				</div>
			</section>
		</>
	);
}
