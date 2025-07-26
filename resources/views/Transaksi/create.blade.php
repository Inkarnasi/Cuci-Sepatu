<style>
    .alert {
        position: relative;
    }

    .btn-close {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
    }

    .subcategory-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        padding: 1rem;
    }

    .subcategory-item {
        flex: 1 1 300px;
        padding: 10px;
        background-color: #f9f9f9;
        border-radius: 5px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .subcategory-item .price {
        font-weight: bold;
        color: #007bff;
        margin-right: 10px;
    }

    .subcategory-item .form-check-input {
        margin-right: 5px;
    }
</style>

<?php $__env->startSection('breadcrumbs'); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('transaksi.index')); ?>">Daftar Transaksi</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Transaksi</li>
    </ol>
</nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section id="horizontal-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header text-black">
                    <h4 class="card-title">Tambah Transaksi</h4>
                </div>
                <?php if (session('error')): ?>
                <div class="alert alert-light-danger alert-dismissible fade show" role="alert">
                    <?php    echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
                <div class="card-body">
                    <?php if ($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php    $__currentLoopData = $errors->all();
    $__env->addLoop($__currentLoopData);
    foreach ($__currentLoopData as $error):
        $__env->incrementLoopIndices();
        $loop = $__env->getLastLoop(); ?>
                            <li><?php        echo e($error); ?></li>
                            <?php    endforeach;
    $__env->popLoop();
    $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <!-- Form Transaksi -->
                    <form method="POST" action="<?php echo e(route('transaksi.store')); ?>"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row g-3">
                            <!-- Nama Customer -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_customer" class="form-label">Nama Customer</label>
                                    <input type="text" id="nama_customer" class="form-control" name="nama_customer"
                                        placeholder="Nama Customer">
                                </div>
                            </div>

                            <!-- No Telepon -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="notelp_customer" class="form-label">No. Telepon</label>
                                    <input type="number" id="notelp_customer" class="form-control"
                                        name="notelp_customer" placeholder="No. Telepon Customer">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="note" class="form-label">Catatan</label>
                                    <input type="text" id="note" class="form-control" name="note"
                                        placeholder="Isi Untuk Catatan" value="Tidak Ada">
                                </div>
                            </div>
                            @foreach ($kategori_sepatu as $sepatu)
                                <!-- Subkategori Sepatu -->
                                <div class="col-md-12 subkategori-sepatu-section" id="subkategori_{{ $sepatu->id }}"
                                    style="background-color: white; padding: 10px; border-radius: 5px;">

                                    @if ($categories->isNotEmpty())
                                        <div class="border p-3 rounded">
                                            @foreach ($categories as $category)
                                                @if ($category->category->isNotEmpty())
                                                    <div class="service-category">
                                                        <h3>{{ $category->treatment_type }}</h3>
                                                        <div class="subcategory-container">
                                                            @foreach ($category->category as $subcategory)
                                                                <div class="subcategory-item d-flex align-items-center">
                                                                    <div>
                                                                        <input type="checkbox" class="form-check-input kategori-checkbox"
                                                                            name="category_sepatu[{{ $sepatu->id }}][category_hargas][{{ $subcategory->id }}][id]"
                                                                            value="{{ $subcategory->id }}"
                                                                            data-price="{{ $subcategory->price }}">
                                                                        <strong>{{ $subcategory->nama_kategori }}</strong>
                                                                    </div>
                                                                    <span
                                                                        class="price">Rp{{ number_format($subcategory->price, 0, ',', '.') }}</span>
                                                                    <div>
                                                                        <input type="number"
                                                                            id="qty_{{ $sepatu->id }}_{{ $subcategory->id }}"
                                                                            name="category_sepatu[{{ $sepatu->id }}][category_hargas][{{ $subcategory->id }}][qty]"
                                                                            class="form-control" placeholder="Qty" style="max-width: 80px;"
                                                                            disabled>

                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <!-- Layanan Tambahan -->
                                <div class="col-md-12 plus-services-section" id="plus_services_{{ $sepatu->id }}"
                                    style="background-color: white; padding: 10px; border-radius: 5px;">
                                    <div class="form-group">
                                        <label for="plus_services" class="form-label">Layanan Tambahan</label>
                                        <div class="border p-3 rounded">
                                            @foreach ($plus_services as $index => $service)
                                                <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                                    <div>
                                                        <input class="form-check-input me-2 plus-service-checkbox"
                                                            type="checkbox" data-price="{{ $service->price }}"
                                                            name="category_sepatu[{{ $sepatu->id }}][plus_services][{{ $index }}][id]"
                                                            value="{{ $service->id }}"
                                                            id="plus_service_{{ $sepatu->id }}_{{ $service->id }}">
                                                        <!-- Hidden input for category_sepatu_id -->
                                                        <input type="hidden"
                                                            name="category_sepatu[{{ $sepatu->id }}][plus_services][{{ $index }}][category_sepatu_id]"
                                                            value="{{ $sepatu->id }}">

                                                        <label class="form-check-label"
                                                            for="plus_service_{{ $sepatu->id }}_{{ $service->id }}">
                                                            {{ $service->name }} -
                                                            Rp{{ number_format($service->price, 0, ',', '.') }}
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <input type="number" id="qty_plus_{{ $sepatu->id }}_{{ $service->id }}"
                                                            name="category_sepatu[{{ $sepatu->id }}][plus_services][{{ $index }}][qty]"
                                                            class="form-control" placeholder="Qty" style="max-width: 80px;"
                                                            disabled>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            @endforeach


                            <!-- Total Harga -->
                            <div class="row">
                                <!-- Total Harga -->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="total_harga" class="col-lg-3 col-form-label">Total
                                            Harga</label>
                                        <div class="col-lg-9">
                                            <input type="text" id="total_harga" class="form-control" name="total_harga"
                                                readonly>
                                        </div>
                                    </div>
                                </div>

                                <!-- Input untuk Kode Promosi -->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="promosi_kode" class="col-lg-3 col-form-label">Kode
                                            Promosi</label>
                                        <div class="col-lg-9 d-flex">
                                            <input type="text" id="promosi_kode" class="form-control me-2"
                                                name="promosi_kode" placeholder="Masukkan Kode Promosi">
                                            <button type="button" id="apply_promo_btn"
                                                class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Diskon Promosi -->
                            <div class="col-md-6" id="promosi-section" style="display: none;">
                                <div class="form-group">
                                    <label for="nama_promosi" class="form-label">Nama Promosi</label>
                                    <input type="text" id="nama_promosi" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-6" id="discount-section" style="display: none;">
                                <div class="form-group">
                                    <label for="discount" class="form-label">Diskon Promosi</label>
                                    <input type="text" id="discount" class="form-control" readonly>
                                </div>
                            </div>
                            <!-- Status Pembayaran -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="form-label">Status Pembayaran</label>
                                    <select id="status" class="form-select" name="status">
                                        <option value="">Pilih
                                        </option>
                                        <option value="downpayment">Downpayment</option>
                                        <option value="paid">Paid
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Downpayment Amount -->
                            <div class="col-md-6" id="downpayment-section" style="display: none;">
                                <div class="form-group">
                                    <label for="downpayment_amount" class="form-label">Jumlah DP</label>
                                    <div class="input-group">
                                        <input type="text" id="downpayment_amount" class="form-control numeric-only"
                                            name="downpayment_amount" placeholder="Jumlah DP" inputmode="numeric"
                                            style="max-width: 300px;">
                                        <button type="button" id="confirm_dp_btn" class="btn btn-primary btn-sm ms-2"
                                            style="display: none;">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </button>
                                        <button type="button" id="edit_dp_btn" class="btn btn-secondary btn-sm ms-2"
                                            style="display: none;">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <small id="minimal-dp-text" class="text-muted"></small>

                                </div>
                            </div>

                            <!-- Remaining Payment -->
                            <div class="col-md-6" id="remaining-payment-section" style="display: none;">
                                <div class="form-group">
                                    <label for="remaining_payment" class="form-label">Sisa Pembayaran</label>
                                    <input type="text" id="remaining_payment" class="form-control"
                                        name="remaining_payment" placeholder="Sisa Pembayaran" readonly>
                                </div>
                            </div>


                            <!-- Diskon Membership -->
                            <div class="col-md-6" id="memberships-section" style="display: none;">
                                <div class="form-group">
                                    <label for="kelas_membership" class="form-label">Kelas Membership</label>
                                    <input type="text" id="kelas_membership" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-6" id="discountMemberships-section" style="display: none;">
                                <div class="form-group">
                                    <label for="discountMembership" class="form-label">Diskon Membership</label>
                                    <input type="text" id="discountMembership" class="form-control" readonly>
                                </div>
                            </div>




                            <!-- Submit & Reset Buttons -->
                            <div class="col-12 d-flex justify-content-end mt-3">
                                <a href="<?php echo e(route('transaksi.index')); ?>"
                                    class="btn btn-secondary me-2 rounded-pill">Batal</a>
                                <button type="submit" class="btn btn-success me-2 rounded-pill">Submit</button>
                                <button type="reset" class="btn btn-warning rounded-pill"
                                    onclick="resetForm()">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if ($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <ul class="mb-0">
            <?php    $__currentLoopData = $errors->all();
    $__env->addLoop($__currentLoopData);
    foreach ($__currentLoopData as $error):
        $__env->incrementLoopIndices();
        $loop = $__env->getLastLoop(); ?>
            <li><?php        echo e($error); ?></li>
            <?php    endforeach;
    $__env->popLoop();
    $loop = $__env->getLastLoop(); ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize elements and functions
        const numericInputs = document.querySelectorAll('.numeric-only');
        const confirmDpBtn = document.getElementById('confirm_dp_btn');
        const editDpBtn = document.getElementById('edit_dp_btn');
        const applyPromoBtn = document.getElementById('apply_promo_btn');
        const validateMembershipBtn = document.getElementById('validate_membership_btn');
        const statusSelect = document.getElementById('status');
        const downpaymentSection = document.getElementById('downpayment-section');
        const remainingPaymentSection = document.getElementById('remaining-payment-section');
        const downpaymentAmountInput = document.getElementById('downpayment_amount');
        const remainingPaymentInput = document.getElementById('remaining_payment');
        const totalHargaInput = document.getElementById('total_harga');
        const discountMembershipInput = document.getElementById('discountMembership');
        const discountInput = document.getElementById('discount');
        const sepatuCheckboxes = document.querySelectorAll('.sepatu-checkbox');
        const form = document.querySelector('form');
        let totalHarga = 0;

        // Reset Form
        function resetForm() {
            document.querySelectorAll('input[type="text"],input[type="number"]').forEach(
                input => {
                    input.value = '';
                    input.disabled = true;
                });
            document.querySelectorAll('.form-check-input').forEach(checkbox => checkbox.checked = false);
            document.getElementById('status').selectedIndex = 0;
            document.getElementById('promosi-section').style.display = 'none';
            document.getElementById('discount-section').style.display = 'none';
            document.getElementById('memberships-section').style.display = 'none';
            document.getElementById('discountMemberships-section').style.display = 'none';
            document.getElementById('total_harga').value = '';
            toggleDownpaymentSection();
        }
        document.querySelectorAll('.kategori-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const qtyInput = this.closest('.subcategory-item').querySelector('input[type="number"]');
                if (this.checked) {
                    qtyInput.disabled = false;
                } else {
                    qtyInput.disabled = true;
                    qtyInput.value = ''; // Kosongkan kalau tidak dicentang
                }
                calculateTotal();
            });
        });


        // Numeric Input Restriction
        numericInputs.forEach(input => {
            input.addEventListener('input', function () {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });

        // Fungsi untuk menghitung total harga
        function calculateTotal() {
            let totalHarga = 0;

            document.querySelectorAll('.subcategory-item .form-check-input:checked').forEach(subCheckbox => {
                const qtyInput = subCheckbox.closest('.subcategory-item').querySelector(
                    'input[type="number"]');
                const qty = parseInt(qtyInput.value);
                const price = parseFloat(subCheckbox.getAttribute('data-price')) || 0;
                if (!isNaN(qty) && qty > 0) {
                    totalHarga += price * qty;
                }

                console.log(`Qty: ${qty}, Price: ${price}, Total: ${totalHarga}`);
            });
            // Menambahkan event listener untuk setiap input qty layanan tambahan
            document.querySelectorAll('.plus-service-checkbox').forEach(checkbox => {
                const qtyInput = checkbox.closest('.form-check')?.querySelector('input[type="number"]');
                if (qtyInput) {
                    qtyInput.addEventListener('input', calculateTotal);
                }
            });


            document.querySelectorAll('.plus-service-checkbox:checked').forEach(service => {
                const qtyInput = service.closest('.form-check')?.querySelector('input[type="number"]');
                const qty = parseInt(qtyInput?.value);

                // Abaikan jika qty kosong, nol, atau bukan angka
                if (!qty || isNaN(qty)) return;

                const price = parseFloat(service.getAttribute('data-price')) || 0;
                totalHarga += price * qty;

                console.log(`Plus Service - Qty: ${qty}, Price: ${price}, Subtotal: ${price * qty}`);
            });


            const membershipDiscount = parseFloat(discountMembershipInput.value || 0) / 100;
            if (membershipDiscount > 0) totalHarga -= totalHarga * membershipDiscount;

            const promoDiscount = parseFloat(discountInput.value || 0) / 100;
            if (promoDiscount > 0) totalHarga -= totalHarga * promoDiscount;

            totalHargaInput.value = formatPrice(totalHarga);

            if (statusSelect.value === 'downpayment') {
                remainingPaymentInput.value = formatPrice(totalHarga - parseFloat(downpaymentAmountInput
                    .value || 0));
            }
        }

        function formatPrice(value) {
            return value.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });
        }

        // Toggle Downpayment Section
function toggleDownpaymentSection() {
    if (statusSelect.value === 'downpayment') {
        downpaymentSection.style.display = 'block';
        remainingPaymentSection.style.display = 'block';
        confirmDpBtn.style.display = 'inline-block';

        // Tambahan: tampilkan teks minimal DP saat status dipilih
        const totalHarga = parseRupiahToNumber(totalHargaInput.value || '0');
        const minimalDownpayment = totalHarga * 0.4;
        document.getElementById('minimal-dp-text').textContent =
            `Minimal DP Rp${minimalDownpayment.toLocaleString('id-ID')}`;
    } else {
        downpaymentSection.style.display = 'none';
        remainingPaymentSection.style.display = 'none';
        confirmDpBtn.style.display = 'none';

        // Sembunyikan atau kosongkan teks DP jika bukan downpayment
        document.getElementById('minimal-dp-text').textContent = '';
    }
}


        sepatuCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const sepatuId = checkbox.getAttribute('data-sepatu-id');
                const subKategoriSection = document.getElementById(`subkategori_${sepatuId}`);
                const plusServiceSection = document.getElementById(`plus_services_${sepatuId}`);

                if (checkbox.checked) {
                    subKategoriSection.style.display = 'block';
                    plusServiceSection.style.display = 'block';

                    subKategoriSection.querySelectorAll('.form-check-input').forEach(
                        subCheckbox => {
                            const subcategoryId = subCheckbox.value;
                            const qtyInput = document.getElementById(
                                `qty_${sepatuId}_${subcategoryId}`);

                            subCheckbox.disabled = false;
                            qtyInput.disabled = !subCheckbox.checked;

                            if (!subCheckbox.checked) qtyInput.value = '';

                            subCheckbox.addEventListener('change', function () {
                                qtyInput.disabled = !subCheckbox.checked;
                                if (!subCheckbox.checked) qtyInput.value = '';
                                calculateTotal();
                            });
                        });
                    plusServiceSection.querySelectorAll('.plus-service-checkbox').forEach(
                        plusCheckbox => {
                            plusCheckbox.disabled = false;
                        });
                } else {
                    subKategoriSection.style.display = 'none';
                    plusServiceSection.style.display = 'none';

                    subKategoriSection.querySelectorAll('.form-check-input').forEach(
                        subCheckbox => {
                            subCheckbox.checked = false;
                            subCheckbox.disabled = true;
                        });
                    subKategoriSection.querySelectorAll('input[type="number"]').forEach(
                        qtyInput => {
                            qtyInput.value = '';
                            qtyInput.disabled = true;
                        });
                    plusServiceSection.querySelectorAll('.plus-service-checkbox').forEach(
                        plusCheckbox => {
                            plusCheckbox.checked = false;
                            plusCheckbox.disabled = true;
                        });
                    calculateTotal();
                }
            });
        });

        // form.addEventListener('submit', function(event) {
        //     document.querySelectorAll('.subcategory-item .form-check-input').forEach(subCheckbox => {
        //         const sepatuId = subCheckbox.closest('.sepatu-checkbox').getAttribute(
        //             'data-sepatu-id');
        //         const subcategoryId = subCheckbox.value;
        //         const qtyInput = document.getElementById(`qty_${sepatuId}_${subcategoryId}`);

        //         if (!subCheckbox.checked) {
        //             subCheckbox.remove();
        //             if (qtyInput) qtyInput.remove();
        //         }
        //     });

        //     document.querySelectorAll('.plus-service-checkbox').forEach(checkbox => {
        //         if (!checkbox.checked) {
        //             formData.delete(checkbox.name); // Hapus dari FormData
        //         }
        //     });
        // });
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Mencegah submit default

            // Buat objek FormData dari form terlebih dahulu
            const formData = new FormData(form);

            // Hapus subkategori yang tidak dicentang dari FormData
            document.querySelectorAll('.subcategory-item .form-check-input').forEach(subCheckbox => {
                const sepatuId = subCheckbox.closest('.sepatu-checkbox').getAttribute(
                    'data-sepatu-id');
                const subcategoryId = subCheckbox.value;
                const qtyInput = document.getElementById(`qty_${sepatuId}_${subcategoryId}`);

                if (!subCheckbox.checked) {
                    formData.delete(subCheckbox
                        .name); // Hapus checkbox subkategori dari FormData
                    if (qtyInput) formData.delete(qtyInput.name); // Hapus qty terkait jika ada
                }
            });

            // Hapus layanan tambahan (plus-services) yang tidak dicentang dari FormData
            document.querySelectorAll('.plus-service-checkbox').forEach(checkbox => {
                const serviceId = checkbox.value;
                if (!checkbox.checked) {
                    formData.delete(checkbox
                        .name); // Hapus checkbox layanan tambahan dari FormData
                    const categorySepatuIdInput = checkbox.closest('.form-check').querySelector(
                        '[name*="category_sepatu_id"]');
                    if (categorySepatuIdInput) formData.delete(categorySepatuIdInput
                        .name); // Hapus id terkait jika ada
                }
            });

            // Kirim FormData yang sudah difilter dengan fetch
            fetch(form.action, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Tampilkan respons dari server
                    // Tambahkan logika penanganan sukses atau error di sini
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });


        // Event listeners
        statusSelect.addEventListener('change', () => {
            toggleDownpaymentSection();
            calculateTotal();
        });
        downpaymentAmountInput.addEventListener('input', calculateTotal);
        document.querySelectorAll('.plus-service-checkbox').forEach(checkbox => checkbox.addEventListener(
            'change', calculateTotal));

        // Tambahkan event listener pada input qty
        document.querySelectorAll('.subcategory-item input[type="number"]').forEach(qtyInput => {
            qtyInput.addEventListener('input', calculateTotal);
        });

        // Apply Promo
applyPromoBtn.addEventListener('click', function () {
    const kodePromosi = document.getElementById('promosi_kode').value;
    if (!kodePromosi) {
        Swal.fire({
            title: 'Kode Promosi Kosong',
            text: 'Silakan masukkan kode promosi terlebih dahulu.',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
        return;
    }

    fetch(`/dashboard/validate-promosi?kode=${kodePromosi}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then(response => response.json())
        .then(data => {
            const totalHarga = parseRupiahToNumber(document.getElementById('total_harga').value || '0');

            if (!data.success) {
                Swal.fire({
                    title: 'Kode Promosi Tidak Valid',
                    text: data.message,
                    icon: 'error',
                    confirmButtonText: 'Coba Lagi'
                });
                document.getElementById('promosi-section').style.display = 'none';
                document.getElementById('discount-section').style.display = 'none';
                calculateTotal(0);
                return;
            }

            // Validasi minimum_payment
            if (totalHarga < data.minimum_payment) {
                Swal.fire({
                    title: 'Total Harga Tidak Cukup',
                    text: `Minimal total harga untuk menggunakan promosi ini adalah Rp${data.minimum_payment.toLocaleString('id-ID')}`,
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Jika lolos semua validasi
            Swal.fire({
                title: 'Kode Promosi Valid!',
                text: `Nama Promosi: ${data.nama_promosi}\nDiskon: ${(data.discount * 100)}%`,
                icon: 'success',
                confirmButtonText: 'OK'
            });
            document.getElementById('promosi-section').style.display = 'block';
            document.getElementById('discount-section').style.display = 'block';
            document.getElementById('nama_promosi').value = data.nama_promosi;
            discountInput.value = (data.discount * 100) + '%';
            calculateTotal(data.discount);
        })
        .catch(() => Swal.fire({
            title: 'Error!',
            text: 'Terjadi kesalahan dalam validasi promosi.',
            icon: 'error',
            confirmButtonText: 'OK'
        }));
});


        function parseRupiahToNumber(rupiahStr) {
            if (!rupiahStr) return 0;
            return parseFloat(rupiahStr
                .replace(/[^0-9,]/g, '')   // Buang "Rp", titik, dan spasi, sisakan angka dan koma
                .replace(',', '.')        // Ubah koma menjadi titik desimal
            ) || 0;
        }

        // Fungsi untuk konfirmasi downpayment
        confirmDpBtn.addEventListener('click', function () {
            const downpayment = parseRupiahToNumber(downpaymentAmountInput.value);
            const totalHarga = parseRupiahToNumber(totalHargaInput.value);
            const minimalDownpayment = totalHarga * 0.4;

            if (downpayment < minimalDownpayment) {
                Swal.fire({
                    title: 'Error!',
                    text: `Minimal downpayment adalah 40% dari total harga. Minimal DP: Rp${minimalDownpayment.toLocaleString('id-ID')}`,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    title: 'Konfirmasi Downpayment',
                    text: `Anda yakin ingin mengunci downpayment sebesar Rp${downpayment}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Kunci!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kunci input downpayment
                        downpaymentAmountInput.readOnly = true;
                        confirmDpBtn.style.display = 'none'; // Sembunyikan tombol konfirmasi
                        editDpBtn.style.display =
                            'block'; // Tampilkan tombol untuk ubah downpayment
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Downpayment telah dikunci.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });

        // Fungsi untuk mengedit downpayment
        editDpBtn.addEventListener('click', function () {
            Swal.fire({
                title: 'Ubah Downpayment',
                text: 'Apakah Anda yakin ingin mengubah downpayment?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Ubah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Buka kembali input downpayment
                    downpaymentAmountInput.readOnly = false;
                    confirmDpBtn.style.display = 'block'; // Tampilkan kembali tombol konfirmasi
                    editDpBtn.style.display = 'none'; // Sembunyikan tombol ubah
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Sekarang Anda dapat mengubah downpayment.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
        // Initialize
        toggleDownpaymentSection();
        calculateTotal();
    });
    document.querySelectorAll('.plus-service-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const qtyInput = this.closest('.form-check').querySelector('input[type="number"]');
            if (this.checked) {
                qtyInput.disabled = false;
            } else {
                qtyInput.value = '';
                qtyInput.disabled = true;
            }
            calculateTotal();
        });
    });
    document.querySelectorAll('.plus-service-checkbox:checked').forEach(service => {
        const qtyInput = service.closest('.form-check').querySelector('input[type="number"]');
        const qty = parseInt(qtyInput?.value) || 1;
        const price = parseFloat(service.getAttribute('data-price')) || 0;
        totalHarga += price * qty;
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts_new.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\tracansoe-main\resources\views/transaksi/create.blade.php ENDPATH**/ ?>