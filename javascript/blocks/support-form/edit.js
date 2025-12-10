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
	TextareaControl,
} from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
	const {
		title,
		description,
		cf7Shortcode,
		proTips,
		responseTimes,
		proSupportText,
		proUpgradeLink,
	} = attributes;

	const blockProps = useBlockProps({
		className: 'py-16 bg-white',
	});

	// Update functions
	const updateProTip = (index, value) => {
		const newTips = [...proTips];
		newTips[index] = value;
		setAttributes({ proTips: newTips });
	};

	const addProTip = () => {
		const newTips = [...proTips, __('New tip...', 'wp-easysoft')];
		setAttributes({ proTips: newTips });
	};

	const removeProTip = (index) => {
		const newTips = proTips.filter((_, i) => i !== index);
		setAttributes({ proTips: newTips });
	};

	const updateResponseTime = (index, field, value) => {
		const newTimes = [...responseTimes];
		newTimes[index][field] = value;
		setAttributes({ responseTimes: newTimes });
	};

	const addResponseTime = () => {
		const newTimes = [
			...responseTimes,
			{
				priority: __('New', 'wp-easysoft'),
				time: __('Within ...', 'wp-easysoft'),
			},
		];
		setAttributes({ responseTimes: newTimes });
	};

	const removeResponseTime = (index) => {
		const newTimes = responseTimes.filter((_, i) => i !== index);
		setAttributes({ responseTimes: newTimes });
	};

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={__('Contact Form 7', 'wp-easysoft')}
					initialOpen={true}
				>
					<TextareaControl
						label={__('CF7 Shortcode', 'wp-easysoft')}
						value={cf7Shortcode}
						onChange={(value) =>
							setAttributes({ cf7Shortcode: value })
						}
						help={__(
							'Paste your Contact Form 7 shortcode here, e.g., [contact-form-7 id="123" title="Support Ticket"]',
							'wp-easysoft'
						)}
						rows={3}
					/>
				</PanelBody>

				<PanelBody
					title={__('Pro Tips', 'wp-easysoft')}
					initialOpen={false}
				>
					<div className="block-editor-tips-controls">
						{proTips.map((tip, index) => (
							<div
								key={index}
								className="tip-control"
								style={{
									marginBottom: '10px',
									padding: '10px',
									border: '1px solid #e0e0e0',
									borderRadius: '4px',
									display: 'flex',
									alignItems: 'center',
									gap: '10px',
								}}
							>
								<TextControl
									value={tip}
									onChange={(value) =>
										updateProTip(index, value)
									}
									placeholder={__(
										'Tip text...',
										'wp-easysoft'
									)}
									style={{ flex: 1 }}
								/>
								{proTips.length > 1 && (
									<Button
										isDestructive
										isSmall
										onClick={() => removeProTip(index)}
										label={__('Remove tip', 'wp-easysoft')}
									>
										×
									</Button>
								)}
							</div>
						))}

						<Button
							isSecondary
							onClick={addProTip}
							className="tips-add-button"
							style={{ width: '100%' }}
						>
							{__('Add Pro Tip', 'wp-easysoft')}
						</Button>
					</div>
				</PanelBody>

				<PanelBody
					title={__('Response Times', 'wp-easysoft')}
					initialOpen={false}
				>
					<div className="block-editor-response-times-controls">
						{responseTimes.map((item, index) => (
							<div
								key={index}
								className="response-time-control"
								style={{
									marginBottom: '10px',
									padding: '10px',
									border: '1px solid #e0e0e0',
									borderRadius: '4px',
									display: 'flex',
									alignItems: 'center',
									gap: '10px',
								}}
							>
								<TextControl
									label={__('Priority', 'wp-easysoft')}
									value={item.priority}
									onChange={(value) =>
										updateResponseTime(
											index,
											'priority',
											value
										)
									}
									style={{ flex: 1 }}
								/>
								<TextControl
									label={__('Time', 'wp-easysoft')}
									value={item.time}
									onChange={(value) =>
										updateResponseTime(index, 'time', value)
									}
									style={{ flex: 1 }}
								/>
								{responseTimes.length > 1 && (
									<Button
										isDestructive
										isSmall
										onClick={() =>
											removeResponseTime(index)
										}
										label={__('Remove', 'wp-easysoft')}
										style={{ marginTop: '20px' }}
									>
										×
									</Button>
								)}
							</div>
						))}
						<Button
							isSecondary
							onClick={addResponseTime}
							style={{ width: '100%' }}
						>
							{__('Add Response Time', 'wp-easysoft')}
						</Button>
					</div>
				</PanelBody>

				<PanelBody
					title={__('PRO Support', 'wp-easysoft')}
					initialOpen={false}
				>
					<TextControl
						label={__('PRO Support Text', 'wp-easysoft')}
						value={proSupportText}
						onChange={(value) =>
							setAttributes({ proSupportText: value })
						}
						multiline
						rows={3}
					/>
					<TextControl
						label={__('Upgrade Link', 'wp-easysoft')}
						value={proUpgradeLink}
						onChange={(value) =>
							setAttributes({ proUpgradeLink: value })
						}
					/>
				</PanelBody>
			</InspectorControls>

			<section {...blockProps}>
				<div className="mx-auto max-w-4xl px-4">
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
								'Submit a Support Ticket',
								'wp-easysoft'
							)}
							allowedFormats={[]}
						/>
						<RichText
							tagName="p"
							className="text-xl text-gray-600"
							value={description}
							onChange={(value) =>
								setAttributes({ description: value })
							}
							placeholder={__(
								'Fill out the form below...',
								'wp-easysoft'
							)}
							allowedFormats={[]}
						/>
					</div>

					<div className="grid grid-cols-1 gap-8 lg:grid-cols-3">
						{/* Contact Form 7 Area */}
						<div className="lg:col-span-2">
							{cf7Shortcode ? (
								<div className="rounded-lg border border-gray-200 bg-gray-50 p-8">
									<div className="mb-4 text-center">
										<i className="fas fa-check-circle mb-4 text-4xl text-green-500"></i>
										<h3 className="mb-2 text-xl font-bold">
											{__(
												'Contact Form 7 Shortcode Added',
												'wp-easysoft'
											)}
										</h3>
										<p className="text-gray-600">
											{__(
												'Your Contact Form 7 form will be displayed here on the frontend.',
												'wp-easysoft'
											)}
										</p>
									</div>
									<div className="rounded border border-gray-300 bg-white p-4">
										<code className="text-sm break-all text-gray-700">
											{cf7Shortcode}
										</code>
									</div>
								</div>
							) : (
								<div className="rounded-lg border border-yellow-200 bg-yellow-50 p-8">
									<div className="text-center">
										<i className="fas fa-exclamation-triangle mb-4 text-4xl text-yellow-500"></i>
										<h3 className="mb-2 text-xl font-bold">
											{__(
												'No Form Shortcode',
												'wp-easysoft'
											)}
										</h3>
										<p className="mb-4 text-gray-600">
											{__(
												'Please add a Contact Form 7 shortcode in the block settings.',
												'wp-easysoft'
											)}
										</p>
										<div className="inline-block rounded border border-gray-200 bg-white p-3 text-sm text-gray-500">
											<code>
												[contact-form-7 id="123"
												title="Support Ticket"]
											</code>
										</div>
									</div>
								</div>
							)}
						</div>

						{/* Sidebar Info - Always shown in editor for preview */}
						<div className="space-y-6">
							{/* Pro Tips */}
							<div className="rounded-lg border border-blue-200 bg-blue-50 p-6">
								<h3 className="mb-3 font-semibold text-blue-900">
									<i className="fas fa-lightbulb mr-2"></i>
									{__('Pro Tips', 'wp-easysoft')}
								</h3>
								<ul className="space-y-2 text-sm text-blue-800">
									{proTips.map((tip, index) => (
										<li key={index}>• {tip}</li>
									))}
								</ul>
							</div>

							{/* Response Times */}
							<div className="rounded-lg border border-green-200 bg-green-50 p-6">
								<h3 className="mb-3 font-semibold text-green-900">
									<i className="fas fa-clock mr-2"></i>
									{__('Response Times', 'wp-easysoft')}
								</h3>
								<ul className="space-y-2 text-sm text-green-800">
									{responseTimes.map((item, index) => (
										<li key={index}>
											<strong>{item.priority}:</strong>{' '}
											{item.time}
										</li>
									))}
								</ul>
							</div>

							{/* PRO Support */}
							<div className="rounded-lg border border-yellow-200 bg-yellow-50 p-6">
								<h3 className="mb-3 font-semibold text-yellow-900">
									<i className="fas fa-star mr-2"></i>
									{__('PRO Support', 'wp-easysoft')}
								</h3>
								<RichText
									tagName="p"
									className="mb-3 text-sm text-yellow-800"
									value={proSupportText}
									onChange={(value) =>
										setAttributes({ proSupportText: value })
									}
									placeholder={__(
										'PRO users get priority support...',
										'wp-easysoft'
									)}
									allowedFormats={[]}
								/>
								<a
									href={proUpgradeLink}
									className="text-sm font-medium text-yellow-700 hover:underline"
								>
									{__('Upgrade to PRO →', 'wp-easysoft')}
								</a>
							</div>
						</div>
					</div>
				</div>
			</section>
		</>
	);
}
