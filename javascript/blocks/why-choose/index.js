import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit.js';

registerBlockType('wp-easysoft/why-choose', {
	edit: Edit,
	save: () => null, // dynamic block
});
