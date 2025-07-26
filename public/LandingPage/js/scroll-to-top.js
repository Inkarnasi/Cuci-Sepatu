// Ketika pengguna menggulir ke bawah 100px dari bagian atas dokumen, tampilkan tombol
window.onscroll = function () {
    scrollFunction();
};

function scrollFunction() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        document.getElementById("backToTop").style.display = "block";
    } else {
        document.getElementById("backToTop").style.display = "none";
    }
}

// Ketika pengguna mengklik tombol, gulir kembali ke bagian atas halaman
document.getElementById("backToTop").addEventListener("click", function () {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' // Animasi smooth saat kembali ke atas
    });
});