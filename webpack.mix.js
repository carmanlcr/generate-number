const mix = require('laravel-mix');

mix.js([
		'resources/js/app.js',
		'resources/js/numbers/calls.js',
		'resources/js/numbers/generateNumbers.js',
		'resources/js/profiles/index.js',
		'resources/js/facebook/user-post.js',
		'resources/js/facebook/user-block.js',
		'resources/js/facebook/users.js',
		'resources/js/instagram/users.js',
		'resources/js/twitter/users.js'
	], 'public/js/app.js')
   .sass('resources/sass/app.scss', 'public/css');

const server = require('http').createServer();
const io = require('socket.io')(server);