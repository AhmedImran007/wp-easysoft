import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, TextControl, Button } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
	const { title, description, stats } = attributes;

	const blockProps = useBlockProps({
		className: 'gradient-bg text-white py-20',
	});

	const updateStat = (index, field, value) => {
		const newStats = [...stats];
		newStats[index][field] = value;
		setAttributes({ stats: newStats });
	};

	const addStat = () => {
		const newStats = [
			...stats,
			{
				value: __('New', 'wp-easysoft'),
				label: __('Statistic Label', 'wp-easysoft'),
			},
		];
		setAttributes({ stats: newStats });
	};

	const removeStat = (index) => {
		const newStats = stats.filter((_, i) => i !== index);
		setAttributes({ stats: newStats });
	};

	const moveStat = (fromIndex, toIndex) => {
		const newStats = [...stats];
		const [movedStat] = newStats.splice(fromIndex, 1);
		newStats.splice(toIndex, 0, movedStat);
		setAttributes({ stats: newStats });
	};

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={__('Statistics', 'wp-easysoft')}
					initialOpen={true}
				>
					<div className="block-editor-contact-stats-controls">
						{stats.map((stat, index) => (
							<div
								key={index}
								className="contact-stat-control"
								style={{
									marginBottom: '20px',
									padding: '15px',
									border: '1px solid #e0e0e0',
									borderRadius: '4px',
								}}
							>
								<div className="mb-3 flex items-center justify-between">
									<strong>
										{__('Stat', 'wp-easysoft')} {index + 1}
									</strong>
									<div className="flex gap-1">
										{index > 0 && (
											<Button
												isSmall
												onClick={() =>
													moveStat(index, index - 1)
												}
												icon="arrow-up"
												label={__(
													'Move up',
													'wp-easysoft'
												)}
											/>
										)}
										{index < stats.length - 1 && (
											<Button
												isSmall
												onClick={() =>
													moveStat(index, index + 1)
												}
												icon="arrow-down"
												label={__(
													'Move down',
													'wp-easysoft'
												)}
											/>
										)}
										{stats.length > 1 && (
											<Button
												isDestructive
												isSmall
												onClick={() =>
													removeStat(index)
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
									label={__('Stat Value', 'wp-easysoft')}
									value={stat.value}
									onChange={(value) =>
										updateStat(index, 'value', value)
									}
									placeholder={__(
										'e.g., 24h, 98%',
										'wp-easysoft'
									)}
								/>

								<TextControl
									label={__('Stat Label', 'wp-easysoft')}
									value={stat.label}
									onChange={(value) =>
										updateStat(index, 'label', value)
									}
									placeholder={__(
										'e.g., Average Response Time',
										'wp-easysoft'
									)}
								/>
							</div>
						))}

						<Button
							isPrimary
							onClick={addStat}
							className="contact-add-stat-button"
							style={{ width: '100%' }}
						>
							{__('Add Statistic', 'wp-easysoft')}
						</Button>
					</div>
				</PanelBody>
			</InspectorControls>

			<section {...blockProps}>
				<div className="mx-auto max-w-7xl px-4">
					<div className="text-center">
						{/* Title */}
						<RichText
							tagName="h2"
							className="mb-6 text-4xl font-bold md:text-5xl"
							value={title}
							onChange={(value) =>
								setAttributes({ title: value })
							}
							placeholder={__(
								'How Can We Help You?',
								'wp-easysoft'
							)}
							allowedFormats={[]}
						/>

						{/* Description */}
						<RichText
							tagName="p"
							className="mx-auto mb-8 max-w-3xl text-xl opacity-90"
							value={description}
							onChange={(value) =>
								setAttributes({ description: value })
							}
							placeholder={__(
								'Our dedicated support team is here to help...',
								'wp-easysoft'
							)}
							allowedFormats={[]}
						/>

						{/* Quick Stats */}
						<div className="mx-auto grid max-w-3xl grid-cols-1 gap-8 md:grid-cols-3">
							{stats.map((stat, index) => (
								<div key={index} className="text-center">
									<div className="mb-2 text-4xl font-bold">
										<RichText
											tagName="div"
											value={stat.value}
											onChange={(value) =>
												updateStat(
													index,
													'value',
													value
												)
											}
											placeholder={__(
												'Stat value',
												'wp-easysoft'
											)}
											allowedFormats={[]}
										/>
									</div>
									<p className="opacity-90">
										<RichText
											tagName="span"
											value={stat.label}
											onChange={(value) =>
												updateStat(
													index,
													'label',
													value
												)
											}
											placeholder={__(
												'Stat label',
												'wp-easysoft'
											)}
											allowedFormats={[]}
										/>
									</p>
								</div>
							))}
						</div>
					</div>
				</div>
			</section>
		</>
	);
}
