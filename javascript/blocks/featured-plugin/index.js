import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit.js';

registerBlockType('wp-easysoft/featured-plugin', {
	edit: Edit,
	save: () => null, // dynamic block
});
