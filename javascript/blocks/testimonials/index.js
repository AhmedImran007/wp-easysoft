import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit.js';

registerBlockType('wp-easysoft/testimonials', {
	edit: Edit,
	save: () => null, // dynamic block
});
