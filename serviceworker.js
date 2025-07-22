const CACHE_NAME = "ntagil-pwa-v1";
const urlsToCache = [
    '/',
    '/index.html',
    '/vesta.html',
    '/niva-sport.html',
    '/iskra.html',
    '/granta.html',
    '/aura.html',
    '/css/style.css',
    '/img/aura.jpeg',
    '/img/emblema.jpeg',
	'/img/granta.jpeg'
	'/img/iskra.jpeg'
	'/img/niva-sport.jpeg'
	'/img/vesta.jpeg'
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
