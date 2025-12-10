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
	ToggleControl,
} from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
	const { title, description, faqs, accordionMode } = attributes;

	const blockProps = useBlockProps({
		className: 'py-16',
	});

	const updateFAQ = (index, field, value) => {
		const newFAQs = [...faqs];
		newFAQs[index][field] = value;
		setAttributes({ faqs: newFAQs });
	};

	const toggleFAQ = (index) => {
		const newFAQs = [...faqs];
		newFAQs[index].open = !newFAQs[index].open;
		setAttributes({ faqs: newFAQs });
	};

	const addFAQ = () => {
		const newFAQs = [
			...faqs,
			{
				question: __('New question?', 'wp-easysoft'),
				answer: __('Answer to the question...', 'wp-easysoft'),
				open: false,
			},
		];
		setAttributes({ faqs: newFAQs });
	};

	const removeFAQ = (index) => {
		const newFAQs = faqs.filter((_, i) => i !== index);
		setAttributes({ faqs: newFAQs });
	};

	const moveFAQ = (fromIndex, toIndex) => {
		const newFAQs = [...faqs];
		const [movedFAQ] = newFAQs.splice(fromIndex, 1);
		newFAQs.splice(toIndex, 0, movedFAQ);
		setAttributes({ faqs: newFAQs });
	};

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={__('Settings', 'wp-easysoft')}
					initialOpen={true}
				>
					<ToggleControl
						label={__('Accordion Mode', 'wp-easysoft')}
						help={__(
							'When enabled, only one FAQ can be open at a time',
							'wp-easysoft'
						)}
						checked={accordionMode}
						onChange={(value) =>
							setAttributes({ accordionMode: value })
						}
					/>
				</PanelBody>

				<PanelBody
					title={__('FAQ Items', 'wp-easysoft')}
					initialOpen={false}
				>
					<div className="block-editor-faq-controls">
						{faqs.map((faq, index) => (
							<div
								key={index}
								className="faq-control"
								style={{
									marginBottom: '20px',
									padding: '15px',
									border: '1px solid #e0e0e0',
									borderRadius: '4px',
								}}
							>
								<div className="mb-3 flex items-center justify-between">
									<strong>
										{__('FAQ', 'wp-easysoft')} {index + 1}
									</strong>
									<div className="flex gap-1">
										<Button
											isSmall
											onClick={() => toggleFAQ(index)}
											icon={
												faq.open
													? 'arrow-up'
													: 'arrow-down'
											}
											label={
												faq.open
													? __(
															'Collapse',
															'wp-easysoft'
														)
													: __(
															'Expand',
															'wp-easysoft'
														)
											}
										/>
										{index > 0 && (
											<Button
												isSmall
												onClick={() =>
													moveFAQ(index, index - 1)
												}
												icon="arrow-up"
												label={__(
													'Move up',
													'wp-easysoft'
												)}
											/>
										)}
										{index < faqs.length - 1 && (
											<Button
												isSmall
												onClick={() =>
													moveFAQ(index, index + 1)
												}
												icon="arrow-down"
												label={__(
													'Move down',
													'wp-easysoft'
												)}
											/>
										)}
										{faqs.length > 1 && (
											<Button
												isDestructive
												isSmall
												onClick={() => removeFAQ(index)}
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
									label={__('Question', 'wp-easysoft')}
									value={faq.question}
									onChange={(value) =>
										updateFAQ(index, 'question', value)
									}
									placeholder={__(
										'Enter question...',
										'wp-easysoft'
									)}
								/>

								<TextControl
									label={__('Answer', 'wp-easysoft')}
									value={faq.answer}
									onChange={(value) =>
										updateFAQ(index, 'answer', value)
									}
									multiline
									rows={4}
									placeholder={__(
										'Enter answer...',
										'wp-easysoft'
									)}
								/>
							</div>
						))}

						<Button
							isPrimary
							onClick={addFAQ}
							className="faq-add-button"
							style={{ width: '100%' }}
						>
							{__('Add FAQ Item', 'wp-easysoft')}
						</Button>
					</div>
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
								'Frequently Asked Questions',
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
								'Quick answers to common support questions',
								'wp-easysoft'
							)}
							allowedFormats={[]}
						/>
					</div>

					{/* FAQ Items - Simplified editor preview */}
					<div className="space-y-4">
						{faqs.map((faq, index) => (
							<div
								key={index}
								className="faq-item rounded-lg bg-white p-6 shadow-md"
							>
								<button
									className="text-primary hover:text-primary-light focus:ring-primary flex w-full items-center justify-between text-left font-semibold transition-colors focus:rounded-md focus:ring-2 focus:ring-offset-2 focus:outline-none"
									onClick={() => toggleFAQ(index)}
									aria-expanded={faq.open}
									aria-controls={`faq-answer-${index}`}
								>
									<RichText
										tagName="span"
										value={faq.question}
										onChange={(value) =>
											updateFAQ(index, 'question', value)
										}
										placeholder={__(
											'FAQ question...',
											'wp-easysoft'
										)}
										allowedFormats={[]}
									/>
									<i
										className={`fas fa-chevron-down transition-transform duration-300 ${faq.open ? 'rotate-180' : ''}`}
										aria-hidden="true"
									></i>
								</button>
								<div
									id={`faq-answer-${index}`}
									className={`overflow-hidden transition-all duration-300 ${faq.open ? 'mt-4 max-h-[1000px] opacity-100' : 'max-h-0 opacity-0'}`}
									aria-hidden={!faq.open}
									role="region"
									aria-labelledby={`faq-question-${index}`}
								>
									<RichText
										tagName="div"
										className="text-gray-600"
										value={faq.answer}
										onChange={(value) =>
											updateFAQ(index, 'answer', value)
										}
										placeholder={__(
											'FAQ answer...',
											'wp-easysoft'
										)}
										allowedFormats={[]}
									/>
								</div>
							</div>
						))}
					</div>
				</div>
			</section>
		</>
	);
}
