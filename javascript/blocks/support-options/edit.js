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
	const { title, description, options } = attributes;

	const blockProps = useBlockProps({
		className: 'py-16',
	});

	const updateOption = (index, field, value) => {
		const newOptions = [...options];
		newOptions[index][field] = value;
		setAttributes({ options: newOptions });
	};

	const updateFeature = (optionIndex, featureIndex, value) => {
		const newOptions = [...options];
		const newFeatures = [...newOptions[optionIndex].features];
		newFeatures[featureIndex] = value;
		newOptions[optionIndex].features = newFeatures;
		setAttributes({ options: newOptions });
	};

	const addOption = () => {
		const newOptions = [
			...options,
			{
				title: __('New Support Option', 'wp-easysoft'),
				icon: 'fas fa-question-circle',
				description: __(
					'Description of this support option',
					'wp-easysoft'
				),
				features: [
					__('Feature 1', 'wp-easysoft'),
					__('Feature 2', 'wp-easysoft'),
					__('Feature 3', 'wp-easysoft'),
				],
				buttonText: __('Learn More', 'wp-easysoft'),
				buttonURL: '#',
				buttonStyle: 'primary',
				buttonAction: 'link',
			},
		];
		setAttributes({ options: newOptions });
	};

	const removeOption = (index) => {
		const newOptions = options.filter((_, i) => i !== index);
		setAttributes({ options: newOptions });
	};

	const addFeature = (optionIndex) => {
		const newOptions = [...options];
		const newFeatures = [
			...newOptions[optionIndex].features,
			__('New Feature', 'wp-easysoft'),
		];
		newOptions[optionIndex].features = newFeatures;
		setAttributes({ options: newOptions });
	};

	const removeFeature = (optionIndex, featureIndex) => {
		const newOptions = [...options];
		const newFeatures = newOptions[optionIndex].features.filter(
			(_, i) => i !== featureIndex
		);
		newOptions[optionIndex].features = newFeatures;
		setAttributes({ options: newOptions });
	};

	const moveOption = (fromIndex, toIndex) => {
		const newOptions = [...options];
		const [movedOption] = newOptions.splice(fromIndex, 1);
		newOptions.splice(toIndex, 0, movedOption);
		setAttributes({ options: newOptions });
	};

	// Button style classes
	const getButtonClass = (style) => {
		switch (style) {
			case 'primary':
				return 'btn-primary text-white hover:shadow-lg';
			case 'success':
				return 'bg-green-500 hover:bg-green-600 text-white';
			case 'outline':
				return 'border border-primary text-primary hover:bg-primary-light';
			default:
				return 'btn-primary text-white';
		}
	};

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={__('Support Options', 'wp-easysoft')}
					initialOpen={true}
				>
					<div className="block-editor-support-options-controls">
						{options.map((option, optionIndex) => (
							<div
								key={optionIndex}
								className="support-option-control"
								style={{
									marginBottom: '25px',
									padding: '15px',
									border: '1px solid #e0e0e0',
									borderRadius: '4px',
								}}
							>
								<div className="mb-3 flex items-center justify-between">
									<strong>
										{__('Option', 'wp-easysoft')}{' '}
										{optionIndex + 1}: {option.title}
									</strong>
									<div className="flex gap-1">
										{optionIndex > 0 && (
											<Button
												isSmall
												onClick={() =>
													moveOption(
														optionIndex,
														optionIndex - 1
													)
												}
												icon="arrow-up"
												label={__(
													'Move up',
													'wp-easysoft'
												)}
											/>
										)}
										{optionIndex < options.length - 1 && (
											<Button
												isSmall
												onClick={() =>
													moveOption(
														optionIndex,
														optionIndex + 1
													)
												}
												icon="arrow-down"
												label={__(
													'Move down',
													'wp-easysoft'
												)}
											/>
										)}
										{options.length > 1 && (
											<Button
												isDestructive
												isSmall
												onClick={() =>
													removeOption(optionIndex)
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
									value={option.icon}
									onChange={(value) =>
										updateOption(optionIndex, 'icon', value)
									}
									help={__(
										'Font Awesome icon class (e.g., fas fa-ticket-alt)',
										'wp-easysoft'
									)}
								/>

								<TextControl
									label={__('Title', 'wp-easysoft')}
									value={option.title}
									onChange={(value) =>
										updateOption(
											optionIndex,
											'title',
											value
										)
									}
								/>

								<TextControl
									label={__('Description', 'wp-easysoft')}
									value={option.description}
									onChange={(value) =>
										updateOption(
											optionIndex,
											'description',
											value
										)
									}
									multiline
								/>

								<TextControl
									label={__('Button Text', 'wp-easysoft')}
									value={option.buttonText}
									onChange={(value) =>
										updateOption(
											optionIndex,
											'buttonText',
											value
										)
									}
								/>

								<TextControl
									label={__('Button URL', 'wp-easysoft')}
									value={option.buttonURL}
									onChange={(value) =>
										updateOption(
											optionIndex,
											'buttonURL',
											value
										)
									}
								/>

								<SelectControl
									label={__('Button Style', 'wp-easysoft')}
									value={option.buttonStyle}
									options={[
										{
											label: __('Primary', 'wp-easysoft'),
											value: 'primary',
										},
										{
											label: __('Success', 'wp-easysoft'),
											value: 'success',
										},
										{
											label: __('Outline', 'wp-easysoft'),
											value: 'outline',
										},
									]}
									onChange={(value) =>
										updateOption(
											optionIndex,
											'buttonStyle',
											value
										)
									}
								/>

								<div className="mt-4">
									<label className="components-base-control__label">
										{__('Features', 'wp-easysoft')}
									</label>
									{option.features.map(
										(feature, featureIndex) => (
											<div
												key={featureIndex}
												className="mb-2 flex items-center gap-2"
											>
												<TextControl
													value={feature}
													onChange={(value) =>
														updateFeature(
															optionIndex,
															featureIndex,
															value
														)
													}
													placeholder={__(
														'Feature text...',
														'wp-easysoft'
													)}
													style={{ flex: 1 }}
												/>
												{option.features.length > 1 && (
													<Button
														isDestructive
														isSmall
														onClick={() =>
															removeFeature(
																optionIndex,
																featureIndex
															)
														}
														label={__(
															'Remove feature',
															'wp-easysoft'
														)}
													>
														×
													</Button>
												)}
											</div>
										)
									)}
									<Button
										isSmall
										onClick={() => addFeature(optionIndex)}
										className="mt-2"
									>
										{__('Add Feature', 'wp-easysoft')}
									</Button>
								</div>
							</div>
						))}

						<Button
							isPrimary
							onClick={addOption}
							className="support-add-option-button"
							style={{ width: '100%' }}
						>
							{__('Add Support Option', 'wp-easysoft')}
						</Button>
					</div>
				</PanelBody>
			</InspectorControls>

			<section {...blockProps}>
				<div className="mx-auto max-w-7xl px-4">
					{/* Header */}
					<div className="mb-12 text-center">
						<RichText
							tagName="h2"
							className="text-primary mb-4 text-3xl font-bold md:text-4xl"
							value={title}
							onChange={(value) =>
								setAttributes({ title: value })
							}
							placeholder={__(
								'Choose Your Support Channel',
								'wp-easysoft'
							)}
							allowedFormats={[]}
						/>
						<RichText
							tagName="p"
							className="mx-auto max-w-2xl text-xl text-gray-600"
							value={description}
							onChange={(value) =>
								setAttributes({ description: value })
							}
							placeholder={__(
								'Different ways to get help...',
								'wp-easysoft'
							)}
							allowedFormats={[]}
						/>
					</div>

					{/* Support Options Grid */}
					<div className="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
						{options.map((option, index) => (
							<div
								key={index}
								className="support-card rounded-xl bg-white p-8 text-center shadow-lg"
							>
								{/* Icon */}
								<div className="bg-primary-light mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full">
									<i
										className={`${option.icon} text-primary text-2xl`}
									></i>
								</div>

								{/* Title */}
								<RichText
									tagName="h3"
									className="text-primary mb-3 text-xl font-bold"
									value={option.title}
									onChange={(value) =>
										updateOption(index, 'title', value)
									}
									placeholder={__(
										'Support Option Title',
										'wp-easysoft'
									)}
									allowedFormats={[]}
								/>

								{/* Description */}
								<RichText
									tagName="p"
									className="mb-6 text-gray-600"
									value={option.description}
									onChange={(value) =>
										updateOption(
											index,
											'description',
											value
										)
									}
									placeholder={__(
										'Support option description...',
										'wp-easysoft'
									)}
									allowedFormats={[]}
								/>

								{/* Features List */}
								<ul className="mb-6 space-y-2 text-left text-sm text-gray-600">
									{option.features.map(
										(feature, featureIndex) => (
											<li
												key={featureIndex}
												className="flex items-center gap-2"
											>
												<i className="fas fa-check text-green-500"></i>
												<RichText
													tagName="span"
													value={feature}
													onChange={(value) =>
														updateFeature(
															index,
															featureIndex,
															value
														)
													}
													placeholder={__(
														'Feature...',
														'wp-easysoft'
													)}
													allowedFormats={[]}
												/>
											</li>
										)
									)}
								</ul>

								{/* Action Button */}
								{option.buttonAction === 'link' ? (
									<a
										href={option.buttonURL}
										className={`${getButtonClass(option.buttonStyle)} inline-block rounded-lg px-6 py-3 font-medium transition`}
									>
										<RichText
											tagName="span"
											value={option.buttonText}
											onChange={(value) =>
												updateOption(
													index,
													'buttonText',
													value
												)
											}
											placeholder={__(
												'Button text',
												'wp-easysoft'
											)}
											allowedFormats={[]}
										/>
									</a>
								) : (
									<button
										onClick={() =>
											console.log(
												`Action for ${option.title}`
											)
										}
										className={`${getButtonClass(option.buttonStyle)} rounded-lg px-6 py-3 font-medium transition`}
									>
										<RichText
											tagName="span"
											value={option.buttonText}
											onChange={(value) =>
												updateOption(
													index,
													'buttonText',
													value
												)
											}
											placeholder={__(
												'Button text',
												'wp-easysoft'
											)}
											allowedFormats={[]}
										/>
									</button>
								)}
							</div>
						))}
					</div>
				</div>
			</section>
		</>
	);
}
