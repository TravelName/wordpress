import initializeRepeater from './repeater.js';

wp.customize.bind( 'ready', function () {
	initializeRepeater();
} );
