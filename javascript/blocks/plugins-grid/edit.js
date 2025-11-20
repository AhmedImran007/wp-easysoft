import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	SelectControl,
	RangeControl,
	Spinner,
} from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';

export default function Edit({ attributes, setAttributes }) {
	const { title, description, numberOfPosts, orderBy, order } = attributes;

	const blockProps = useBlockProps({
		className: 'py-16 bg-white',
	});

	// Query plugins from custom post type
	const plugins = useSelect(
		(select) => {
			return select(coreStore).getEntityRecords('postType', 'wp_plugin', {
				per_page: numberOfPosts,
				orderby: orderBy,
				order: order,
				_embed: true,
			});
		},
		[numberOfPosts, orderBy, order]
	);

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={__('Settings', 'wp-easysoft')}
					initialOpen={true}
				>
					<TextControl
						label={__('Title', 'wp-easysoft')}
						value={title}
						onChange={(value) => setAttributes({ title: value })}
					/>
					<TextControl
						label={__('Description', 'wp-easysoft')}
						value={description}
						onChange={(value) =>
							setAttributes({ description: value })
						}
					/>
					<RangeControl
						label={__('Number of Plugins', 'wp-easysoft')}
						value={numberOfPosts}
						onChange={(value) =>
							setAttributes({ numberOfPosts: value })
						}
						min={1}
						max={12}
					/>
					<SelectControl
						label={__('Order By', 'wp-easysoft')}
						value={orderBy}
						options={[
							{ label: __('Date', 'wp-easysoft'), value: 'date' },
							{
								label: __('Title', 'wp-easysoft'),
								value: 'title',
							},
							{
								label: __('Menu Order', 'wp-easysoft'),
								value: 'menu_order',
							},
						]}
						onChange={(value) => setAttributes({ orderBy: value })}
					/>
					<SelectControl
						label={__('Order', 'wp-easysoft')}
						value={order}
						options={[
							{
								label: __('Descending', 'wp-easysoft'),
								value: 'desc',
							},
							{
								label: __('Ascending', 'wp-easysoft'),
								value: 'asc',
							},
						]}
						onChange={(value) => setAttributes({ order: value })}
					/>
				</PanelBody>
			</InspectorControls>

			<section {...blockProps}>
				<div className="container mx-auto px-4">
					{/* Header */}
					<RichText
						tagName="h2"
						className="mb-4 text-center text-3xl font-bold md:text-4xl"
						value={title}
						onChange={(value) => setAttributes({ title: value })}
						placeholder={__('Our WordPress Plugins', 'wp-easysoft')}
						allowedFormats={[]}
					/>
					<RichText
						tagName="p"
						className="mx-auto mb-12 max-w-2xl text-center text-xl text-gray-600"
						value={description}
						onChange={(value) =>
							setAttributes({ description: value })
						}
						placeholder={__(
							'Enhance your site with lightweight, high-performance tools.',
							'wp-easysoft'
						)}
						allowedFormats={[]}
					/>

					{/* Plugins Grid */}
					{!plugins && (
						<div className="flex items-center justify-center py-8">
							<Spinner />
							<span className="ml-2">
								{__('Loading plugins...', 'wp-easysoft')}
							</span>
						</div>
					)}

					{plugins && plugins.length === 0 && (
						<div className="py-8 text-center">
							<p className="text-gray-500">
								{__(
									'No plugins found. Add some plugins in the admin area.',
									'wp-easysoft'
								)}
							</p>
						</div>
					)}

					{plugins && plugins.length > 0 && (
						<div className="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
							{plugins.map((plugin) => (
								<div
									key={plugin.id}
									className="plugin-card overflow-hidden rounded-xl border border-gray-100 bg-white shadow-md"
								>
									<div className="p-6">
										<div className="mb-4 flex items-start justify-between">
											<div className="bg-primary-light rounded-lg p-3">
												{plugin.featured_media ? (
													<img
														src={
															plugin._embedded?.[
																'wp:featuredmedia'
															]?.[0]?.source_url
														}
														alt={
															plugin.title
																.rendered
														}
														className="h-8 w-8 object-contain"
													/>
												) : (
													<i className="fas fa-plug text-primary text-2xl"></i>
												)}
											</div>
											{plugin.meta?.has_pro && (
												<span className="accent-light-bg accent-color rounded-full px-2 py-1 text-xs font-medium">
													{__(
														'PRO Available',
														'wp-easysoft'
													)}
												</span>
											)}
										</div>

										<h3 className="mb-2 text-xl font-bold">
											{plugin.title.rendered}
										</h3>

										<div className="mb-3 flex items-center text-sm text-gray-500">
											<i className="fas fa-download mr-1"></i>
											<span>
												{plugin.meta?.active_installs ||
													'0'}{' '}
												{__(
													'Active Installs',
													'wp-easysoft'
												)}
											</span>
										</div>

										<div
											className="mb-6 text-gray-600"
											dangerouslySetInnerHTML={{
												__html: plugin.excerpt.rendered,
											}}
										/>

										<div className="flex gap-3">
											<a
												href={plugin.link}
												className="text-primary hover:text-primary-light font-medium transition"
											>
												{__(
													'Learn More',
													'wp-easysoft'
												)}
											</a>
											{plugin.meta?.free_version_url && (
												<a
													href={
														plugin.meta
															.free_version_url
													}
													className="font-medium text-gray-600 transition hover:text-gray-700"
												>
													{__(
														'Free Version',
														'wp-easysoft'
													)}
												</a>
											)}
										</div>
									</div>
								</div>
							))}
						</div>
					)}
				</div>
			</section>
		</>
	);
}
