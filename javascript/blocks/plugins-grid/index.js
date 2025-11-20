import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit.js';

registerBlockType('wp-easysoft/plugins-grid', {
	edit: Edit,
	save: () => null, // dynamic block
});
