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