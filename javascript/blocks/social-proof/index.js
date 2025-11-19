import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit.js';

registerBlockType('wp-easysoft/social-proof', {
	edit: Edit,
	save: () => null, // dynamic block
});
