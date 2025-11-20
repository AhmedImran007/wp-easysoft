import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit.js';

registerBlockType('wp-easysoft/cta-section', {
	edit: Edit,
	save: () => null, // dynamic block
});
