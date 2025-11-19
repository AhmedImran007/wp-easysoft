import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, TextControl, Button } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
	const { features } = attributes;

	const blockProps = useBlockProps({
		className: 'py-12 bg-white',
	});

	const updateFeature = (index, field, value) => {
		const newFeatures = [...features];
		newFeatures[index][field] = value;
		setAttributes({ features: newFeatures });
	};

	const addFeature = () => {
		const newFeatures = [
			...features,
			{ icon: 'fas fa-star', text: 'New Feature' },
		];
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
					title={__('Features', 'wp-easysoft')}
					initialOpen={true}
				>
					<div className="block-editor-social-proof-controls">
						{features.map((feature, index) => (
							<div
								key={index}
								className="social-proof-feature-control"
								style={{
									marginBottom: '20px',
									padding: '15px',
									border: '1px solid #e0e0e0',
									borderRadius: '4px',
								}}
							>
								<div className="mb-2 flex items-center justify-between">
									<strong>
										{__('Feature', 'wp-easysoft')}{' '}
										{index + 1}
									</strong>
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

								<TextControl
									label={__('Icon Class', 'wp-easysoft')}
									value={feature.icon}
									onChange={(value) =>
										updateFeature(index, 'icon', value)
									}
									help={__(
										'Font Awesome icon class (e.g., fas fa-star)',
										'wp-easysoft'
									)}
								/>

								<TextControl
									label={__('Feature Text', 'wp-easysoft')}
									value={feature.text}
									onChange={(value) =>
										updateFeature(index, 'text', value)
									}
								/>
							</div>
						))}

						<Button
							isPrimary
							onClick={addFeature}
							className="social-proof-add-feature"
						>
							{__('Add Feature', 'wp-easysoft')}
						</Button>
					</div>
				</PanelBody>
			</InspectorControls>

			<section {...blockProps}>
				<div className="container mx-auto px-4">
					<div className="flex flex-wrap items-center justify-center gap-8 md:gap-12">
						{features.map((feature, index) => (
							<div
								key={index}
								className="flex items-center space-x-2"
							>
								<i
									className={`${feature.icon} text-primary text-xl`}
								></i>
								<RichText
									tagName="span"
									className="font-medium text-gray-700"
									value={feature.text}
									onChange={(value) =>
										updateFeature(index, 'text', value)
									}
									placeholder={__(
										'Feature text...',
										'wp-easysoft'
									)}
									allowedFormats={[]}
								/>
							</div>
						))}
					</div>
				</div>
			</section>
		</>
	);
}
