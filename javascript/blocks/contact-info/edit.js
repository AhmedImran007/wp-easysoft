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
	const { title, description, contactItems } = attributes;

	const blockProps = useBlockProps({
		className: 'py-16 bg-white',
	});

	const updateContactItem = (index, field, value) => {
		const newItems = [...contactItems];
		newItems[index][field] = value;
		setAttributes({ contactItems: newItems });
	};

	const addContactItem = () => {
		const newItems = [
			...contactItems,
			{
				icon: 'fas fa-share-alt',
				title: __('New Channel', 'wp-easysoft'),
				subtitle: __('Channel description', 'wp-easysoft'),
				linkText: __('Link text', 'wp-easysoft'),
				linkURL: '#',
				linkType: 'social',
			},
		];
		setAttributes({ contactItems: newItems });
	};

	const removeContactItem = (index) => {
		const newItems = contactItems.filter((_, i) => i !== index);
		setAttributes({ contactItems: newItems });
	};

	const moveContactItem = (fromIndex, toIndex) => {
		const newItems = [...contactItems];
		const [movedItem] = newItems.splice(fromIndex, 1);
		newItems.splice(toIndex, 0, movedItem);
		setAttributes({ contactItems: newItems });
	};

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={__('Contact Items', 'wp-easysoft')}
					initialOpen={true}
				>
					<div className="block-editor-contact-info-controls">
						{contactItems.map((item, index) => (
							<div
								key={index}
								className="contact-item-control"
								style={{
									marginBottom: '20px',
									padding: '15px',
									border: '1px solid #e0e0e0',
									borderRadius: '4px',
								}}
							>
								<div className="mb-3 flex items-center justify-between">
									<strong>
										{__('Item', 'wp-easysoft')} {index + 1}:{' '}
										{item.title}
									</strong>
									<div className="flex gap-1">
										{index > 0 && (
											<Button
												isSmall
												onClick={() =>
													moveContactItem(
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
										{index < contactItems.length - 1 && (
											<Button
												isSmall
												onClick={() =>
													moveContactItem(
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
										{contactItems.length > 1 && (
											<Button
												isDestructive
												isSmall
												onClick={() =>
													removeContactItem(index)
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
									value={item.icon}
									onChange={(value) =>
										updateContactItem(index, 'icon', value)
									}
									help={__(
										'Font Awesome icon class (e.g., fas fa-envelope, fab fa-twitter)',
										'wp-easysoft'
									)}
								/>

								<TextControl
									label={__('Title', 'wp-easysoft')}
									value={item.title}
									onChange={(value) =>
										updateContactItem(index, 'title', value)
									}
								/>

								<TextControl
									label={__('Subtitle', 'wp-easysoft')}
									value={item.subtitle}
									onChange={(value) =>
										updateContactItem(
											index,
											'subtitle',
											value
										)
									}
								/>

								<SelectControl
									label={__('Link Type', 'wp-easysoft')}
									value={item.linkType}
									options={[
										{
											label: __(
												'Social Media',
												'wp-easysoft'
											),
											value: 'social',
										},
										{
											label: __('Email', 'wp-easysoft'),
											value: 'email',
										},
										{
											label: __('Website', 'wp-easysoft'),
											value: 'website',
										},
										{
											label: __('Phone', 'wp-easysoft'),
											value: 'phone',
										},
									]}
									onChange={(value) =>
										updateContactItem(
											index,
											'linkType',
											value
										)
									}
								/>

								<TextControl
									label={__('Link Text', 'wp-easysoft')}
									value={item.linkText}
									onChange={(value) =>
										updateContactItem(
											index,
											'linkText',
											value
										)
									}
								/>

								<TextControl
									label={__('Link URL', 'wp-easysoft')}
									value={item.linkURL}
									onChange={(value) =>
										updateContactItem(
											index,
											'linkURL',
											value
										)
									}
									help={__(
										'For email use mailto:email@example.com, for phone use tel:+1234567890',
										'wp-easysoft'
									)}
								/>
							</div>
						))}

						<Button
							isPrimary
							onClick={addContactItem}
							className="contact-info-add-button"
							style={{ width: '100%' }}
						>
							{__('Add Contact Item', 'wp-easysoft')}
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
								'Other Ways to Reach Us',
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
								'Multiple channels to stay connected...',
								'wp-easysoft'
							)}
							allowedFormats={[]}
						/>
					</div>

					{/* Contact Items Grid */}
					<div className="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
						{contactItems.map((item, index) => (
							<div
								key={index}
								className="text-center transition-transform hover:scale-105"
							>
								{/* Icon */}
								<div className="bg-primary-light hover:bg-primary mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full transition-colors hover:text-white">
									<i
										className={`${item.icon} text-primary text-2xl transition-colors`}
									></i>
								</div>

								{/* Title */}
								<RichText
									tagName="h3"
									className="text-primary mb-2 font-semibold"
									value={item.title}
									onChange={(value) =>
										updateContactItem(index, 'title', value)
									}
									placeholder={__(
										'Channel title',
										'wp-easysoft'
									)}
									allowedFormats={[]}
								/>

								{/* Subtitle */}
								<RichText
									tagName="p"
									className="mb-2 text-gray-600"
									value={item.subtitle}
									onChange={(value) =>
										updateContactItem(
											index,
											'subtitle',
											value
										)
									}
									placeholder={__(
										'Channel description',
										'wp-easysoft'
									)}
									allowedFormats={[]}
								/>

								{/* Link */}
								<a
									href={item.linkURL}
									className={`inline-block ${
										item.linkType === 'email'
											? 'text-primary hover:text-primary-light'
											: item.linkType === 'phone'
												? 'text-primary hover:text-primary-light'
												: 'text-primary hover:text-primary-light'
									} focus:ring-primary transition-colors focus:rounded focus:ring-2 focus:ring-offset-2 focus:outline-none`}
									target={
										item.linkType === 'social' ||
										item.linkType === 'website'
											? '_blank'
											: '_self'
									}
									rel={
										item.linkType === 'social' ||
										item.linkType === 'website'
											? 'noopener noreferrer'
											: ''
									}
								>
									<RichText
										tagName="span"
										value={item.linkText}
										onChange={(value) =>
											updateContactItem(
												index,
												'linkText',
												value
											)
										}
										placeholder={__(
											'Link text',
											'wp-easysoft'
										)}
										allowedFormats={[]}
									/>
								</a>
							</div>
						))}
					</div>
				</div>
			</section>
		</>
	);
}
