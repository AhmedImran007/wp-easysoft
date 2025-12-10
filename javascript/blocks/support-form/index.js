import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit.js';

registerBlockType('wp-easysoft/support-form', {
	edit: Edit,
	save: () => null, // dynamic block
});
