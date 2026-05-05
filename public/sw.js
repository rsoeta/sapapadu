const CACHE_NAME = 'sapapadu-cache-v1';

// Daftar aset statis yang ingin disimpan di memori HP agar loading lebih cepat
const urlsToCache = [
  '/',
  '/manifest.json',
  '/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'
  // Kamu bisa menambahkan link CSS/JS font atau logo utama di sini
];

// Event Install: Menyimpan cache awal
self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        console.log('Opened cache');
        return cache.addAll(urlsToCache);
      })
  );
  self.skipWaiting();
});

// Event Activate: Membersihkan cache versi lama jika ada update sw.js
self.addEventListener('activate', event => {
  const cacheWhitelist = [CACHE_NAME];
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cacheName => {
          if (cacheWhitelist.indexOf(cacheName) === -1) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
  self.clients.claim();
});

// Event Fetch: Strategi Network-First (Utamakan Internet, fallback ke Cache)
self.addEventListener('fetch', event => {
  // Hanya proses request GET, abaikan POST (seperti saat simpan transaksi)
  if (event.request.method !== 'GET') return;

  event.respondWith(
    fetch(event.request)
      .then(response => {
        // Jika sukses ditarik dari internet, simpan salinannya ke cache
        if (!response || response.status !== 200 || response.type !== 'basic') {
          return response;
        }
        let responseToCache = response.clone();
        caches.open(CACHE_NAME)
          .then(cache => {
            cache.put(event.request, responseToCache);
          });
        return response;
      })
      .catch(() => {
        // Jika internet mati (Offline), ambil dari Cache
        return caches.match(event.request);
      })
  );
});