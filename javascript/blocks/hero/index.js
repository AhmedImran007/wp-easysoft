import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit.js';

registerBlockType('wp-easysoft/hero', {
	edit: Edit,
	save: () => null, // dynamic block
});
