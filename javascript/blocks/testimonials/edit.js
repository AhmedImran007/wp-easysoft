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
	RangeControl,
	ToggleControl,
} from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
	const { title, description, testimonials, layout, backgroundColor } =
		attributes;

	const blockProps = useBlockProps({
		className: `py-16 ${backgroundColor}`,
	});

	const updateTestimonial = (index, field, value) => {
		const newTestimonials = [...testimonials];
		newTestimonials[index][field] = value;
		setAttributes({ testimonials: newTestimonials });
	};

	const addTestimonial = () => {
		const newTestimonials = [
			...testimonials,
			{
				name: __('New Customer', 'wp-easysoft'),
				role: __('Role', 'wp-easysoft'),
				company: __('Company', 'wp-easysoft'),
				content: __('Customer testimonial content...', 'wp-easysoft'),
				rating: 5,
				avatar: '',
			},
		];
		setAttributes({ testimonials: newTestimonials });
	};

	const removeTestimonial = (index) => {
		const newTestimonials = testimonials.filter((_, i) => i !== index);
		setAttributes({ testimonials: newTestimonials });
	};

	const moveTestimonial = (fromIndex, toIndex) => {
		const newTestimonials = [...testimonials];
		const [movedTestimonial] = newTestimonials.splice(fromIndex, 1);
		newTestimonials.splice(toIndex, 0, movedTestimonial);
		setAttributes({ testimonials: newTestimonials });
	};

	const renderStars = (rating) => {
		const stars = [];
		for (let i = 1; i <= 5; i++) {
			stars.push(
				<i
					key={i}
					className={`fas fa-star ${i <= rating ? 'text-yellow-400' : 'text-gray-300'}`}
				></i>
			);
		}
		return stars;
	};

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={__('Settings', 'wp-easysoft')}
					initialOpen={true}
				>
					<SelectControl
						label={__('Layout', 'wp-easysoft')}
						value={layout}
						options={[
							{ label: __('Grid', 'wp-easysoft'), value: 'grid' },
							{
								label: __('Carousel', 'wp-easysoft'),
								value: 'carousel',
							},
							{
								label: __('Masonry', 'wp-easysoft'),
								value: 'masonry',
							},
						]}
						onChange={(value) => setAttributes({ layout: value })}
					/>

					<SelectControl
						label={__('Background Color', 'wp-easysoft')}
						value={backgroundColor}
						options={[
							{
								label: __('White', 'wp-easysoft'),
								value: 'bg-white',
							},
							{
								label: __('Gray', 'wp-easysoft'),
								value: 'bg-gray-50',
							},
							{
								label: __('Primary', 'wp-easysoft'),
								value: 'bg-primary-50',
							},
						]}
						onChange={(value) =>
							setAttributes({ backgroundColor: value })
						}
					/>
				</PanelBody>

				<PanelBody
					title={__('Testimonials', 'wp-easysoft')}
					initialOpen={false}
				>
					<div className="block-editor-testimonials-controls">
						{testimonials.map((testimonial, index) => (
							<div
								key={index}
								className="testimonial-control"
								style={{
									marginBottom: '20px',
									padding: '15px',
									border: '1px solid #e0e0e0',
									borderRadius: '4px',
								}}
							>
								<div className="mb-3 flex items-center justify-between">
									<strong>
										{__('Testimonial', 'wp-easysoft')}{' '}
										{index + 1}
									</strong>
									<div className="flex gap-1">
										{index > 0 && (
											<Button
												isSmall
												onClick={() =>
													moveTestimonial(
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
										{index < testimonials.length - 1 && (
											<Button
												isSmall
												onClick={() =>
													moveTestimonial(
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
										{testimonials.length > 1 && (
											<Button
												isDestructive
												isSmall
												onClick={() =>
													removeTestimonial(index)
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
									label={__('Name', 'wp-easysoft')}
									value={testimonial.name}
									onChange={(value) =>
										updateTestimonial(index, 'name', value)
									}
								/>

								<TextControl
									label={__('Role', 'wp-easysoft')}
									value={testimonial.role}
									onChange={(value) =>
										updateTestimonial(index, 'role', value)
									}
								/>

								<TextControl
									label={__('Company', 'wp-easysoft')}
									value={testimonial.company}
									onChange={(value) =>
										updateTestimonial(
											index,
											'company',
											value
										)
									}
								/>

								<TextControl
									label={__('Avatar URL', 'wp-easysoft')}
									value={testimonial.avatar}
									onChange={(value) =>
										updateTestimonial(
											index,
											'avatar',
											value
										)
									}
									help={__(
										'Optional: URL for customer avatar image',
										'wp-easysoft'
									)}
								/>

								<div className="components-base-control">
									<label className="components-base-control__label">
										{__('Rating', 'wp-easysoft')}
									</label>
									<RangeControl
										value={testimonial.rating}
										onChange={(value) =>
											updateTestimonial(
												index,
												'rating',
												value
											)
										}
										min={1}
										max={5}
									/>
									<div className="mt-1 flex gap-1">
										{renderStars(testimonial.rating)}
									</div>
								</div>

								<TextControl
									label={__(
										'Testimonial Content',
										'wp-easysoft'
									)}
									value={testimonial.content}
									onChange={(value) =>
										updateTestimonial(
											index,
											'content',
											value
										)
									}
									multiline
									rows={3}
								/>
							</div>
						))}

						<Button
							isPrimary
							onClick={addTestimonial}
							className="testimonials-add-button"
							style={{ width: '100%' }}
						>
							{__('Add Testimonial', 'wp-easysoft')}
						</Button>
					</div>
				</PanelBody>
			</InspectorControls>

			<section {...blockProps}>
				<div className="container mx-auto px-4">
					{/* Header */}
					<div className="mb-12 text-center">
						<RichText
							tagName="h2"
							className="mb-4 text-3xl font-bold md:text-4xl"
							value={title}
							onChange={(value) =>
								setAttributes({ title: value })
							}
							placeholder={__(
								'What Our Customers Say',
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
								'Join thousands of satisfied WordPress users...',
								'wp-easysoft'
							)}
							allowedFormats={[]}
						/>
					</div>

					{/* Testimonials Grid */}
					<div
						className={`testimonials-grid ${
							layout === 'grid'
								? 'grid gap-8 md:grid-cols-2 lg:grid-cols-3'
								: layout === 'masonry'
									? 'columns-1 gap-8 space-y-8 md:columns-2 lg:columns-3'
									: 'flex gap-6 overflow-x-auto pb-6'
						}`}
					>
						{testimonials.map((testimonial, index) => (
							<div
								key={index}
								className={`rounded-xl border border-gray-100 bg-white p-6 shadow-lg ${layout === 'carousel' ? 'min-w-[350px] flex-shrink-0' : ''} transition-all duration-300 hover:shadow-xl`}
							>
								{/* Rating */}
								<div className="mb-4 flex gap-1">
									{renderStars(testimonial.rating)}
								</div>

								{/* Content */}
								<RichText
									tagName="blockquote"
									className="mb-6 text-lg leading-relaxed text-gray-700 italic"
									value={testimonial.content}
									onChange={(value) =>
										updateTestimonial(
											index,
											'content',
											value
										)
									}
									placeholder={__(
										'Customer testimonial content...',
										'wp-easysoft'
									)}
									allowedFormats={[]}
								/>

								{/* Author */}
								<div className="flex items-center gap-4">
									<div className="flex-shrink-0">
										{testimonial.avatar ? (
											<img
												src={testimonial.avatar}
												alt={testimonial.name}
												className="h-12 w-12 rounded-full object-cover"
											/>
										) : (
											<div className="from-primary-500 to-secondary-500 flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-r font-bold text-white">
												{testimonial.name.charAt(0)}
											</div>
										)}
									</div>
									<div>
										<RichText
											tagName="div"
											className="font-bold text-gray-900"
											value={testimonial.name}
											onChange={(value) =>
												updateTestimonial(
													index,
													'name',
													value
												)
											}
											placeholder={__(
												'Customer name',
												'wp-easysoft'
											)}
											allowedFormats={[]}
										/>
										<div className="text-sm text-gray-600">
											<RichText
												tagName="span"
												value={testimonial.role}
												onChange={(value) =>
													updateTestimonial(
														index,
														'role',
														value
													)
												}
												placeholder={__(
													'Role',
													'wp-easysoft'
												)}
												allowedFormats={[]}
											/>
											{testimonial.company && (
												<>
													<span> • </span>
													<RichText
														tagName="span"
														value={
															testimonial.company
														}
														onChange={(value) =>
															updateTestimonial(
																index,
																'company',
																value
															)
														}
														placeholder={__(
															'Company',
															'wp-easysoft'
														)}
														allowedFormats={[]}
													/>
												</>
											)}
										</div>
									</div>
								</div>
							</div>
						))}
					</div>

					{/* Layout Notice */}
					{layout === 'carousel' && (
						<div className="mt-6 text-center text-sm text-gray-500">
							{__(
								'← Scroll to see more testimonials →',
								'wp-easysoft'
							)}
						</div>
					)}
				</div>
			</section>
		</>
	);
}
