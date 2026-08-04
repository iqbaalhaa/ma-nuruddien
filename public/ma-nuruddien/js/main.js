/* ============================================================
   MA Nuruddien, Skrip antarmuka
   ============================================================ */
(function () {
  "use strict";

  var kurangiGerak = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  /* ---------- Header melayang di atas hero ----------
     Di puncak halaman header dibiarkan tembus pandang. Begitu halaman
     digulir melewati ambang, atau saat menu ponsel dibuka, header
     dipadatkan kembali menjadi putih. */
  var header = document.querySelector(".header--melayang");
  var AMBANG_GULIR = 40;

  function selaraskanHeader() {
    if (!header) return;
    var nav = document.querySelector(".nav");
    var menuTerbuka = nav ? nav.classList.contains("buka") : false;
    header.classList.toggle("header--pekat", window.scrollY > AMBANG_GULIR || menuTerbuka);
  }

  function headerMelayang() {
    if (!header) return;

    var menunggu = false;
    window.addEventListener("scroll", function () {
      if (menunggu) return;
      menunggu = true;
      window.requestAnimationFrame(function () {
        selaraskanHeader();
        menunggu = false;
      });
    }, { passive: true });

    selaraskanHeader();   // posisi awal, misalnya saat halaman dimuat ulang di tengah
  }

  /* ---------- Menu seluler ---------- */
  function menuSeluler() {
    var tombol = document.querySelector(".tombol-menu");
    var nav = document.querySelector(".nav");
    if (!tombol || !nav) return;

    tombol.addEventListener("click", function () {
      var terbuka = tombol.getAttribute("aria-expanded") === "true";
      tombol.setAttribute("aria-expanded", String(!terbuka));
      nav.classList.toggle("buka", !terbuka);
      // Panel menu berlatar putih, jadi header ikut dipadatkan supaya
      // keduanya tidak terlihat terpisah saat menu dibuka di atas hero.
      selaraskanHeader();
    });

    nav.addEventListener("click", function (e) {
      if (e.target.closest("a")) {
        tombol.setAttribute("aria-expanded", "false");
        nav.classList.remove("buka");
        selaraskanHeader();
      }
    });

    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && nav.classList.contains("buka")) {
        tombol.setAttribute("aria-expanded", "false");
        nav.classList.remove("buka");
        selaraskanHeader();
        tombol.focus();
      }
    });
  }

  /* ---------- Animasi muncul saat digulir ---------- */
  function animasiGulir() {
    var elemen = document.querySelectorAll(".muncul");
    if (!elemen.length) return;

    if (kurangiGerak || !("IntersectionObserver" in window)) {
      elemen.forEach(function (el) { el.classList.add("tampil"); });
      return;
    }

    var pengamat = new IntersectionObserver(function (entri) {
      entri.forEach(function (e) {
        if (e.isIntersecting) {
          e.target.classList.add("tampil");
          pengamat.unobserve(e.target);
        }
      });
    }, { threshold: 0.12, rootMargin: "0px 0px -40px 0px" });

    elemen.forEach(function (el, i) {
      el.style.transitionDelay = (i % 4) * 90 + "ms";
      pengamat.observe(el);
    });
  }

  /* ---------- Hitung angka statistik ---------- */
  function angkaStatistik() {
    var angka = document.querySelectorAll("[data-hitung]");
    if (!angka.length) return;

    function jalankan(el) {
      var tujuan = parseInt(el.getAttribute("data-hitung"), 10) || 0;
      var akhiran = el.getAttribute("data-akhiran") || "";
      if (kurangiGerak) { el.textContent = tujuan + akhiran; return; }

      var mulai = null;
      var durasi = 1400;
      function langkah(waktu) {
        if (!mulai) mulai = waktu;
        var maju = Math.min((waktu - mulai) / durasi, 1);
        var halus = 1 - Math.pow(1 - maju, 3);
        el.textContent = Math.round(tujuan * halus) + akhiran;
        if (maju < 1) requestAnimationFrame(langkah);
      }
      requestAnimationFrame(langkah);
    }

    if (!("IntersectionObserver" in window)) {
      angka.forEach(jalankan);
      return;
    }
    var pengamat = new IntersectionObserver(function (entri) {
      entri.forEach(function (e) {
        if (e.isIntersecting) { jalankan(e.target); pengamat.unobserve(e.target); }
      });
    }, { threshold: 0.4 });
    angka.forEach(function (el) { pengamat.observe(el); });
  }

  /* ---------- Saring & cari berita ---------- */
  function saringBerita() {
    var wadah = document.querySelector("[data-daftar-berita]");
    if (!wadah) return;

    var item = Array.prototype.slice.call(wadah.querySelectorAll("[data-kategori]"));
    var tombol = Array.prototype.slice.call(document.querySelectorAll(".saring__tbl"));
    var kotakCari = document.querySelector("[data-cari]");
    var pesanKosong = document.querySelector(".kosong");
    var kategoriAktif = "semua";

    function perbarui() {
      var kata = kotakCari ? kotakCari.value.trim().toLowerCase() : "";
      var terlihat = 0;

      item.forEach(function (el) {
        var cocokKategori = kategoriAktif === "semua" || el.dataset.kategori === kategoriAktif;
        var cocokKata = kata === "" || el.textContent.toLowerCase().indexOf(kata) !== -1;
        var tampil = cocokKategori && cocokKata;
        el.style.display = tampil ? "" : "none";
        if (tampil) terlihat++;
      });

      if (pesanKosong) pesanKosong.classList.toggle("tampil", terlihat === 0);
    }

    tombol.forEach(function (t) {
      t.addEventListener("click", function () {
        tombol.forEach(function (x) { x.setAttribute("aria-pressed", "false"); });
        t.setAttribute("aria-pressed", "true");
        kategoriAktif = t.dataset.saring;
        perbarui();
      });
    });

    if (kotakCari) kotakCari.addEventListener("input", perbarui);
  }

  /* ---------- Lightbox galeri ---------- */
  function galeri() {
    var pemicu = document.querySelectorAll("[data-galeri]");
    if (!pemicu.length) return;

    var lampu = document.createElement("div");
    lampu.className = "lampu";
    lampu.setAttribute("role", "dialog");
    lampu.setAttribute("aria-modal", "true");
    lampu.setAttribute("aria-label", "Pratinjau galeri");
    lampu.innerHTML =
      '<button class="lampu__tutup" type="button" aria-label="Tutup pratinjau">&times;</button>' +
      '<div class="lampu__kotak">' +
      '<div class="lampu__gambar"></div>' +
      '<div class="lampu__teks"><h3></h3><p></p></div>' +
      "</div>";
    document.body.appendChild(lampu);

    var kotakGambar = lampu.querySelector(".lampu__gambar");
    var judul = lampu.querySelector(".lampu__teks h3");
    var teks = lampu.querySelector(".lampu__teks p");
    var tombolTutup = lampu.querySelector(".lampu__tutup");
    var pemicuTerakhir = null;

    function buka(el) {
      var gambar = el.querySelector(".lengkung__gambar");
      kotakGambar.className = "lampu__gambar";
      if (gambar) {
        kotakGambar.innerHTML = gambar.innerHTML;
        ["emas", "tanah", "pucuk"].forEach(function (n) {
          if (gambar.classList.contains("lengkung__gambar--" + n)) {
            kotakGambar.classList.add("lengkung__gambar--" + n);
          }
        });
      }
      judul.textContent = el.dataset.galeri || "";
      teks.textContent = el.dataset.keterangan || "";
      lampu.classList.add("buka");
      pemicuTerakhir = el;
      tombolTutup.focus();
    }

    function tutup() {
      lampu.classList.remove("buka");
      if (pemicuTerakhir) pemicuTerakhir.focus();
    }

    pemicu.forEach(function (el) {
      el.addEventListener("click", function () { buka(el); });
    });
    tombolTutup.addEventListener("click", tutup);
    lampu.addEventListener("click", function (e) { if (e.target === lampu) tutup(); });
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && lampu.classList.contains("buka")) tutup();
    });
  }

  /* ---------- Validasi formulir kontak ---------- */
  function formKontak() {
    var form = document.querySelector("[data-form-kontak]");
    if (!form) return;

    var sukses = form.querySelector(".pesan-sukses");

    function tandai(medan, pesan) {
      medan.classList.add("salah");
      var galat = medan.querySelector(".galat");
      if (galat) galat.textContent = pesan;
    }

    function bersihkan(medan) {
      medan.classList.remove("salah");
    }

    form.addEventListener("submit", function (e) {
      e.preventDefault();
      var valid = true;
      var pertamaSalah = null;

      form.querySelectorAll(".medan").forEach(function (medan) {
        var isian = medan.querySelector("input, textarea, select");
        if (!isian || !isian.required) { bersihkan(medan); return; }

        var nilai = isian.value.trim();
        if (nilai === "") {
          tandai(medan, "Bagian ini perlu diisi.");
          valid = false;
          if (!pertamaSalah) pertamaSalah = isian;
        } else if (isian.type === "email" && !/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(nilai)) {
          tandai(medan, "Tulis alamat email yang lengkap, contoh: nama@email.com");
          valid = false;
          if (!pertamaSalah) pertamaSalah = isian;
        } else {
          bersihkan(medan);
        }
      });

      if (!valid) {
        if (sukses) sukses.classList.remove("tampil");
        if (pertamaSalah) pertamaSalah.focus();
        return;
      }

      form.reset();
      if (sukses) {
        sukses.classList.add("tampil");
        sukses.setAttribute("tabindex", "-1");
        sukses.focus();
      }
    });

    form.addEventListener("input", function (e) {
      var medan = e.target.closest(".medan");
      if (medan && medan.classList.contains("salah")) bersihkan(medan);
    });
  }

  /* ---------- Tahun berjalan di footer ---------- */
  function tahunFooter() {
    document.querySelectorAll("[data-tahun]").forEach(function (el) {
      el.textContent = new Date().getFullYear();
    });
  }

  /* ---------- Jalankan ---------- */
  document.addEventListener("DOMContentLoaded", function () {
    headerMelayang();
    menuSeluler();
    animasiGulir();
    angkaStatistik();
    saringBerita();
    galeri();
    formKontak();
    tahunFooter();
  });
})();
