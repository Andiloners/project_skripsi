// FTI Unibba Theme JS

document.addEventListener('DOMContentLoaded', function() {
    // Highlight menu aktif
    var links = document.querySelectorAll('.sidebar ul li a');
    var url = window.location.href;
    links.forEach(function(link) {
        if (url.indexOf(link.getAttribute('href')) !== -1) {
            link.classList.add('active');
        }
    });

    // Konfirmasi hapus
    var hapusLinks = document.querySelectorAll('a[onclick*="Yakin hapus"], a[onclick*="Yakin hapus?"]');
    hapusLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            if (!confirm('Yakin hapus data ini?')) {
                e.preventDefault();
            }
        });
    });
});

// --- Animasi Fade In ---
function fadeIn(el, duration = 800) {
  el.style.opacity = 0;
  el.style.display = '';
  let last = +new Date();
  let tick = function() {
    el.style.opacity = +el.style.opacity + (new Date() - last) / duration;
    last = +new Date();
    if (+el.style.opacity < 1) {
      (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16);
    }
  };
  tick();
}
// --- Animasi Fade Out ---
function fadeOut(el, duration = 800) {
  el.style.opacity = 1;
  let last = +new Date();
  let tick = function() {
    el.style.opacity = +el.style.opacity - (new Date() - last) / duration;
    last = +new Date();
    if (+el.style.opacity > 0) {
      (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16);
    } else {
      el.style.display = 'none';
    }
  };
  tick();
}
// --- Animasi Slide In dari Kiri ---
function slideInLeft(el) {
  el.classList.remove('slide-out-left');
  el.classList.add('slide-in-left');
  el.style.display = '';
}
// --- Animasi Slide Out ke Kiri ---
function slideOutLeft(el) {
  el.classList.remove('slide-in-left');
  el.classList.add('slide-out-left');
  setTimeout(() => { el.style.display = 'none'; }, 700);
}
// --- Tampilkan Loading Spinner ---
function showSpinner(target) {
  let spinner = document.createElement('div');
  spinner.className = 'spinner';
  spinner.id = 'global-spinner';
  target.appendChild(spinner);
}
function hideSpinner() {
  let spinner = document.getElementById('global-spinner');
  if (spinner) spinner.remove();
} 