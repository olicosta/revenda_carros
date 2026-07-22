(function () {
  "use strict";

  if ("serviceWorker" in navigator) {
    window.addEventListener("load", function () {
      navigator.serviceWorker.register("/service-worker.js").catch(function () {
        return undefined;
      });
    });
  }

  window.primePwaNotifications = {
    supported: function () {
      return "Notification" in window;
    },
    permission: function () {
      return this.supported() ? Notification.permission : "unsupported";
    },
    request: function () {
      if (!this.supported()) {
        return Promise.resolve("unsupported");
      }

      return Notification.requestPermission();
    },
    notify: function (title, options) {
      if (!this.supported() || Notification.permission !== "granted") {
        return;
      }

      const payload = Object.assign(
        {
          body: "Você tem pendências para acompanhar no painel.",
          icon: "/img/app-icon-192.png",
          badge: "/img/app-icon-192.png",
          tag: "3m-veiculos-alertas",
        },
        options || {}
      );

      if (navigator.serviceWorker && navigator.serviceWorker.ready) {
        navigator.serviceWorker.ready.then(function (registration) {
          registration.showNotification(title, payload);
        });
        return;
      }

      new Notification(title, payload);
    },
  };
})();
