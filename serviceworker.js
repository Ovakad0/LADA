const CACHE_NAME = "lada-pwa-v1";
const urlsToCache = [
    '/',
    '/index.html',
    '/vesta.html',
    '/niva-sport.html',
    '/iskra.html',
    '/granta.html',
    '/aura.html',
    '/css/style.css',
    '/img/aura.jpg',
    '/img/emblema.jpg',
	'/img/granta.jpg'
	'/img/iskra.jpg'
	'/img/niva-sport.jpg'
	'/img/vesta.jpg'
    '/manifest.json'
  ];
  

self.addEventListener("install", (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      return cache.addAll(urlsToCache);
    })
  );
});

self.addEventListener("fetch", (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => {
      return response || fetch(event.request);
    })
  );
});
