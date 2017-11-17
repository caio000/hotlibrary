var CACHE_NAME = 'hotlibrary-v1';
var files = [
  '/hotlibrary',
  '/hotlibrary/css/style.css',
  '/hotlibrary/css/m_style.css',
  '/hotlibrary/index.php/template/view/mobile-user-login.html',
  '/hotlibrary/index.php/template/view/mobile-book-details.html',
];

self.addEventListener('install',function(event) {
  console.log("SW install");
  event.waitUntil(
    caches.open(CACHE_NAME).then(function (cache) {
      console.log('Opened cache');
      return cache.addAll(files);
    })
  );
});

self.addEventListener('fetch',function(event) {
  event.respondWith(
    caches.match(event.request).then(function(response) {
      if (response) {
        return response;
      }
      return fetch(event.request);
    })
  );
});

self.addEventListener('activate',function(event){
  event.waitUntil(
    caches.key().then(function(cacheName) {
      return Promise.all(
        cacheName.map(function(cacheName){
          if (cacheWhitelist.indexOf(cacheName) === -1) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});
