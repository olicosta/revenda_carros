const CACHE_NAME = "3m-veiculos-pwa-v22-mobile-hero-offset";
const APP_SHELL = [
  "/",
  "/veiculos",
  "/financiamento",
  "/css/style.css",
  "/css/admin-dashboard.css",
  "/css/admin-menu.css",
  "/css/site-menu.css",
  "/js/pwa.js",
  "/img/app-icon-192.png",
  "/img/app-icon-512.png",
  "/img/apple-touch-icon.png",
  "/img/favicon-32.png",
  "/img/logo-3m-veiculos.jpg"
];

const CACHEABLE_PATHS = [
  "/",
  "/index.html",
  "/veiculos",
  "/carros.html",
  "/sobre",
  "/sobre.html",
  "/depoimentos",
  "/depoimentos.html",
  "/financiamento",
  "/financiamento.html",
  "/detalhes",
  "/detalhes.html"
];

const CACHEABLE_PREFIXES = [
  "/css/",
  "/js/",
  "/img/"
];

const PRIVATE_PREFIXES = [
  "/admin",
  "/admin.html",
  "/api/",
  "/cliente",
  "/login",
  "/logout",
  "/esqueci-senha",
  "/redefinir-senha",
  "/financiamento-dados",
  "/financiamento-dados.html",
  "/storage/financing",
  "/storage/framework"
];

function shouldCache(request) {
  if (request.method !== "GET") return false;

  const url = new URL(request.url);

  if (url.origin !== self.location.origin) return false;
  if (PRIVATE_PREFIXES.some(function (prefix) { return url.pathname.startsWith(prefix); })) {
    return false;
  }

  return CACHEABLE_PATHS.includes(url.pathname) ||
    CACHEABLE_PREFIXES.some(function (prefix) { return url.pathname.startsWith(prefix); });
}

self.addEventListener("install", function (event) {
  event.waitUntil(
    caches.open(CACHE_NAME).then(function (cache) {
      return cache.addAll(APP_SHELL).catch(function () {
        return undefined;
      });
    })
  );
  self.skipWaiting();
});

self.addEventListener("activate", function (event) {
  event.waitUntil(
    caches.keys().then(function (keys) {
      return Promise.all(
        keys
          .filter(function (key) {
            return key !== CACHE_NAME;
          })
          .map(function (key) {
            return caches.delete(key);
          })
      );
    })
  );
  self.clients.claim();
});

self.addEventListener("fetch", function (event) {
  if (!shouldCache(event.request)) return;

  event.respondWith(
    fetch(event.request)
      .then(function (response) {
        const clone = response.clone();
        caches.open(CACHE_NAME).then(function (cache) {
          cache.put(event.request, clone);
        });
        return response;
      })
      .catch(function () {
        return caches.match(event.request).then(function (cached) {
          return cached || caches.match("/");
        });
      })
  );
});

self.addEventListener("notificationclick", function (event) {
  event.notification.close();
  event.waitUntil(
    self.clients.matchAll({ type: "window", includeUncontrolled: true }).then(function (clients) {
      for (const client of clients) {
        if ("focus" in client) return client.focus();
      }

      if (self.clients.openWindow) {
        return self.clients.openWindow("/admin");
      }

      return undefined;
    })
  );
});
