/* global require */
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
	window.$ = window.jQuery = require('jquery');

	require('bootstrap');
} catch (e) {
	alert(e);
}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

// window.io = require('socket.io-client');

// window.Echo = new Echo({
// 	broadcaster: 'socket.io',
// 	host: window.location.hostname == 'localhost' ? 'localhost:6001' : window.location.hostname
// });

window.Pusher = require('pusher-js');

let laravelEcho = new Echo({
	broadcaster: 'pusher',
	key: process.env.MIX_PUSHER_APP_KEY ? process.env.MIX_PUSHER_APP_KEY : 'soketi',
	wsHost: window.location.hostname == 'localhost' ? 'localhost' : window.location.hostname,
	wsPort: window.location.hostname == 'localhost' ? 6001 : 80,
	wssPort: window.location.hostname == 'localhost' ? 6001 : 443,
	forceTLS: false,
	encrypted: true,
	disableStats: true,
	enabledTransports: ['ws', 'wss'],
});
