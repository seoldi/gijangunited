(function () {
  function inject(id, file) {
    var el = document.getElementById(id);
    if (!el) return;
    fetch(file)
      .then(function (r) { return r.text(); })
      .then(function (html) {
        el.outerHTML = html;
      });
  }
  inject('_gnb', '_header.html');
  inject('_ftr', '_footer.html');
})();
