import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, TextControl, Button } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
	const { title, features } = attributes;

	const blockProps = useBlockProps({
		className: 'py-16 bg-gray-50',
	});

	const updateFeature = (index, field, value) => {
		const newFeatures = [...features];
		newFeatures[index][field] = value;
		setAttributes({ features: newFeatures });
	};

	const addFeature = () => {
		const newFeatures = [
			...features,
			{
				icon: 'fas fa-star',
				title: __('New Feature', 'wp-easysoft'),
				description: __('Feature description...', 'wp-easysoft'),
			},
		];
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
					title={__('Features', 'wp-easysoft')}
					initialOpen={true}
				>
					<div className="block-editor-why-choose-controls">
						{features.map((feature, index) => (
							<div
								key={index}
								className="why-choose-feature-control"
								style={{
									marginBottom: '20px',
									padding: '15px',
									border: '1px solid #e0e0e0',
									borderRadius: '4px',
								}}
							>
								<div className="mb-3 flex items-center justify-between">
									<strong>
										{__('Feature', 'wp-easysoft')}{' '}
										{index + 1}
									</strong>
									<div className="flex gap-1">
										{index > 0 && (
											<Button
												isSmall
												onClick={() =>
													moveFeature(
														index,
														index - 1
													)
												}
												icon="arrow-up"
												label={__(
													'Move up',
													'wp-easysoft'
												)}
											/>
										)}
										{index < features.length - 1 && (
											<Button
												isSmall
												onClick={() =>
													moveFeature(
														index,
														index + 1
													)
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
												onClick={() =>
													removeFeature(index)
												}
												label={__(
													'Remove',
													'wp-easysoft'
												)}
											>
												{__('Remove', 'wp-easysoft')}
											</Button>
										)}
									</div>
								</div>

								<TextControl
									label={__('Icon Class', 'wp-easysoft')}
									value={feature.icon}
									onChange={(value) =>
										updateFeature(index, 'icon', value)
									}
									help={__(
										'Font Awesome icon class (e.g., fas fa-bolt)',
										'wp-easysoft'
									)}
								/>

								<TextControl
									label={__('Feature Title', 'wp-easysoft')}
									value={feature.title}
									onChange={(value) =>
										updateFeature(index, 'title', value)
									}
								/>

								<TextControl
									label={__(
										'Feature Description',
										'wp-easysoft'
									)}
									value={feature.description}
									onChange={(value) =>
										updateFeature(
											index,
											'description',
											value
										)
									}
									multiline
								/>
							</div>
						))}

						<Button
							isPrimary
							onClick={addFeature}
							className="why-choose-add-feature"
							style={{ width: '100%' }}
						>
							{__('Add Feature', 'wp-easysoft')}
						</Button>
					</div>
				</PanelBody>
			</InspectorControls>

			<section {...blockProps}>
				<div className="container mx-auto px-4">
					{/* Title */}
					<RichText
						tagName="h2"
						className="mb-12 text-center text-3xl font-bold md:text-4xl"
						value={title}
						onChange={(value) => setAttributes({ title: value })}
						placeholder={__(
							'Why Website Owners Love Our Plugins',
							'wp-easysoft'
						)}
						allowedFormats={[]}
					/>

					{/* Features Grid */}
					<div className="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
						{features.map((feature, index) => (
							<div
								key={index}
								className="card-hover rounded-xl bg-white p-6 text-center shadow-md"
							>
								<div className="mb-4">
									<i
										className={`${feature.icon} feature-icon text-primary text-4xl`}
									></i>
								</div>

								<RichText
									tagName="h3"
									className="mb-2 text-xl font-bold"
									value={feature.title}
									onChange={(value) =>
										updateFeature(index, 'title', value)
									}
									placeholder={__(
										'Feature title...',
										'wp-easysoft'
									)}
									allowedFormats={[]}
								/>

								<RichText
									tagName="p"
									className="text-gray-600"
									value={feature.description}
									onChange={(value) =>
										updateFeature(
											index,
											'description',
											value
										)
									}
									placeholder={__(
										'Feature description...',
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
