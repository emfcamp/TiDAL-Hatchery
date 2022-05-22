const cacheName = 'hatchery::20220522';

self.addEventListener('install', e => {
	e.waitUntil(
		caches.open(cacheName).then(cache => {
                // '/0.js',
                // '/2.js',
                '/css/app.css',
                '/fonts/vendor/bootstrap-sass/bootstrap/glyphicons-halflings-regular.eot',
                '/fonts/vendor/bootstrap-sass/bootstrap/glyphicons-halflings-regular.svg',
                '/fonts/vendor/bootstrap-sass/bootstrap/glyphicons-halflings-regular.ttf',
                '/fonts/vendor/bootstrap-sass/bootstrap/glyphicons-halflings-regular.woff',
                '/fonts/vendor/bootstrap-sass/bootstrap/glyphicons-halflings-regular.woff2',
                // '/icons/back.gif',
                // '/icons/blank.gif',
                // '/icons/compressed.gif',
                // '/icons/tar.gif',
                '/img/alert.gif',
                '/img/bs.png',
                '/img/collab.svg',
                '/img/emf-b-logo-circular.png',
                '/img/emf-w-logo-circular.png',
                '/img/git.svg',
                '/img/isok.gif',
                '/img/rulez.gif',
                '/img/sucks.gif',
                // '/js/app.js',
                // '/mix-manifest.json',
                '/svg/403.svg',
                '/svg/404.svg',
                '/svg/500.svg',
                '/svg/503.svg',
                '/vendor/horizon/app-dark.css',
                '/vendor/horizon/app.css',
                '/vendor/horizon/app.js',
                '/vendor/horizon/img/favicon.png',
                '/vendor/horizon/img/horizon.svg',
                '/vendor/horizon/img/sprite.svg',
                '/vendor/horizon/mix-manifest.json',
                '/vendor/webauthn/webauthn.js',
            return cache.addAll([
			]).then(() => self.skipWaiting());
		})
	);
});

self.addEventListener('fetch', event => {
	event.respondWith(
		caches.open(cacheName).then(cache => {
			return cache.match(event.request).then(res => {
				return res || fetch(event.request);
			});
		})
	);
});
