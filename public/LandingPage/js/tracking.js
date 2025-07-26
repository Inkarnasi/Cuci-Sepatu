$(document).ready(function () {
    $('#trackingForm').on('submit', function (e) {
        e.preventDefault(); // Prevent form submission
        const trackingCode1 = $('#trackingCode').val();
        // Check if the input is empty
        if (!trackingCode1) {
            // Show SweetAlert for empty input
            Swal.fire({
                title: 'Error',
                text: 'Kode pesanan tidak boleh kosong! Silakan masukkan kode pesanan Anda.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return; // Exit the function
        }

        // Tampilkan konfirmasi SweetAlert
        Swal.fire({
            title: 'Konfirmasi',
            text: `Apakah Anda yakin ingin melacak pesanan dengan kode ${trackingCode1}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Lacak!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi, lakukan pengiriman AJAX

                // Reset and hide error message, tracking code, and timeline
                $('#errorMessage').hide();
                $('#timelineContent').empty(); // Clear previous timeline content
                $('#trackingCodeInfo').hide(); // Hide tracking code info

                // Get the tracking code
                const trackingCode = $('#trackingCode').val();

                // Perform AJAX request to the server
                $.ajax({
                    url: '/track-order',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        trackingCode: trackingCode,
                        _token: $('meta[name="csrf-token"]').attr('content') // Ambil CSRF token dari meta tag
                    },
                    success: function (response) {
                        // Clear input after success
                        $('#trackingCode').val(''); // Clear input field

                        // Show the tracking code at the top of the timeline
                        $('#trackingCodeDisplay').text(trackingCode); // Set the tracking code text
                        $('#trackingCodeInfo').fadeIn(); // Show the tracking code info

                        // On success, build the timeline dynamically
                        if (response.statuses && response.statuses.length > 0) {
                            response.statuses.forEach(function (status) {
                                $('#timelineContent').append(`
                                    <div class="timeline-item">
                                        <div class="timeline-icon">
                                            <i class="${getIconForStatus(status.status_name)}"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h4>Status: ${status.status_name}</h4>
                                            <p>${status.description}</p>
                                            <span><i class="fas fa-calendar-alt"></i> ${status.date} <i class="fas fa-clock"></i> ${status.time}</span>
                                        </div>
                                    </div>
                                `);
                            });
                            // Show the timeline section
                            $('#timelineSection').fadeIn();
                        }
                    },
                    error: function (xhr) {
                        // Jika terjadi error, backend akan mengirimkan pesan error
                        if (xhr.status === 404) {
                            const response = xhr.responseJSON;
                            $('#errorMessage').html(response.error); // Tampilkan pesan error dari backend
                        } else {
                            // Handle error lain jika ada
                            $('#errorMessage').html('Terjadi kesalahan. Silakan coba lagi nanti.');
                        }
                        // On error, show the error message
                        $('#trackingCode').val('');
                        $('#errorMessage').fadeIn();

                        setTimeout(() => {
                            $('#errorMessage').fadeOut();
                        }, 5000);
                    }
                });
            }
        });
    });

    // Event handler for the "Tutup Timeline" button
    $('#closeTimeline').on('click', function () {
        $('#timelineSection').fadeOut(); // Hide the timeline when the button is clicked
        $('#trackingCodeInfo').fadeOut(); // Hide the tracking code info as well
    });

    // Function to get appropriate icons based on the status
    function getIconForStatus(statusName) {
        if (statusName === 'Pesanan Diterima') {
            return 'fas fa-check-circle';
        } else if (statusName === 'Pengerjaan Sedang Berlangsung') {
            return 'fas fa-spinner';
        } else if (statusName === 'Pesanan Selesai') {
            return 'fas fa-check-double';
        } else {
            return 'fas fa-info-circle'; // Default icon
        }
    }
});
