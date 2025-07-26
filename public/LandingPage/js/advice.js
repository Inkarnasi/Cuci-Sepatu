$(document).ready(function () {
    // Hapus nilai input saat halaman dimuat atau di-refresh
    $('#adviceForm')[0].reset();

    // Tangkap event submit form
    $('#adviceForm').on('submit', function (e) {
        e.preventDefault(); // Mencegah form dari submit biasa

        // Ambil URL rute dari hidden input
        var routeUrl = $('#adviceRoute').val();

        // Ambil data dari form
        var formData = {
            nama: $('#nama').val(),
            email: $('#email').val(),
            advice: $('#advice').val(),
            tracking_number: $('#tracking_number').val(),
        };

        // Kirim form menggunakan AJAX
        $.ajax({
            url: routeUrl, // Gunakan URL rute dari hidden input
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Tambahkan CSRF token ke header
            },
            data: formData,
            success: function (response) {
                // Menampilkan pesan sukses dengan SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    showConfirmButton: true
                });

                // Reset form setelah sukses
                $('#adviceForm')[0].reset();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;

                    // Hapus pesan error sebelumnya
                    $('.help-block').remove();
                    $('.has-error').removeClass('has-error');

                    // Tampilkan error jika ada
                    if (errors.nama) {
                        $("#name-group").addClass("has-error");
                        $("#name-group").append('<div class="help-block">' + errors.nama + "</div>");
                    }
                    if (errors.email) {
                        $("#email-group").addClass("has-error");
                        $("#email-group").append('<div class="help-block">' + errors.email + "</div>");
                    }
                    if (errors.advice) {
                        $("#advice-group").addClass("has-error");
                        $("#advice-group").append('<div class="help-block">' + errors.advice + "</div>");
                    }
                    if (errors.tracking_number) {
                        $("#tracking_number-group").addClass("has-error");
                        $("#tracking_number-group").append('<div class="help-block">' + errors.tracking_number + "</div>");
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: xhr.responseJSON?.message || 'Silakan coba lagi.',
                        showConfirmButton: true
                    });
                }
            }
        });
    });

    $('#nama, #email, #advice,#tracking_number').on('input', function () {
        var fieldGroup = $(this).closest('.form-group');
        fieldGroup.removeClass('has-error');
        fieldGroup.find('.help-block').remove();
    });
});
