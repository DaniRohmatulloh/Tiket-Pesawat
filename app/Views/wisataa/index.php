<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php
function buatRp($angka)
{
    return "Rp" . number_format($angka, 2, ',', '.');
}

$payment_methods = [
    'DANA' => 'DANA',
    'OVO' => 'OVO',
    'GOPAY' => 'GOPAY',
    'Transfer Bank' => 'Transfer Bank'
];
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form id="ticket-form" action="<?= base_url('Wisata/proses'); ?>" method="post">
                        <?= csrf_field(); ?>

                        <!-- Lokasi dan Tanggal -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="asal" class="form-label">Asal</label>
                                <select name="asal" id="asal" class="form-select" required>
                                    <option value="">Pilih Kota Asal</option>
                                    <?php foreach ($wisata as $data): ?>
                                        <option value="<?= esc($data->asal); ?>" data-price="<?= esc($data->harga); ?>" <?= set_select('asal', $data->asal); ?>>
                                            <?= esc($data->asal); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">Silakan pilih kota asal.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="tujuan" class="form-label">Tujuan</label>
                                <select name="tujuan" id="tujuan" class="form-select" required>
                                    <option value="">Pilih Kota Tujuan</option>
                                    <?php foreach ($wisata as $data): ?>
                                        <option value="<?= esc($data->nama_wisata); ?>" data-price="<?= esc($data->harga); ?>" <?= set_select('tujuan', $data->nama_wisata); ?>>
                                            <?= esc($data->nama_wisata); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">Silakan pilih kota tujuan.</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tanggal_pergi" class="form-label">Tanggal Pergi</label>
                                <input type="date" name="tanggal_pergi" id="tanggal_pergi" class="form-control" value="<?= set_value('tanggal_pergi'); ?>" required>
                                <div class="invalid-feedback">Silakan pilih tanggal keberangkatan.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="tgl_pulang" class="form-label">Tanggal Pulang</label>
                                <input type="date" name="tgl_pulang" id="tgl_pulang" class="form-control" value="<?= set_value('tgl_pulang'); ?>" required>
                                <div class="invalid-feedback">Silakan pilih tanggal kepulangan.</div>
                            </div>
                        </div>

                        <!-- Tombol Cari Penerbangan -->
                        <div class="mb-3">
                            <button type="button" class="btn btn-primary w-100" onclick="searchFlights()">
                                <i class="bi bi-airplane-engines me-2"></i>Cari Penerbangan
                            </button>
                        </div>

                        <!-- Tabel Penerbangan dan Metode Pembayaran -->
                        <div id="flightResults" style="display: none;" class="mb-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Maskapai</th>
                                        <th scope="col">Detail Penerbangan</th>
                                        <th scope="col">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Economy Class -->
                                    <tr id="EconomyClass">
                                        <td>
                                            <input type="radio" name="selected_flight" value="economy" class="form-check-input" onchange="calculateTotal()">
                                        </td>
                                        <td>
                                            <strong>Lion Air</strong>
                                        </td>
                                        <td>
                                            <div class="text-muted small">
                                                <i class="bi bi-clock me-1"></i> Berangkat 08.00 - Tiba 09.50
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold" id="economyPrice"></div>
                                            <small class="text-muted">/orang</small>
                                        </td>
                                    </tr>

                                    <!-- Business Class -->
                                    <tr id="BusinessClass">
                                        <td>
                                            <input type="radio" name="selected_flight" value="business" class="form-check-input" onchange="calculateTotal()">
                                        </td>
                                        <td>
                                            <strong>Garuda Indonesia</strong>
                                        </td>
                                        <td>
                                            <div class="text-muted small">
                                                <i class="bi bi-clock me-1"></i> Berangkat 10.30 - Tiba 12.20
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold" id="businessPrice"></div>
                                            <small class="text-muted">/orang</small>
                                        </td>
                                    </tr>

                                    <!-- First Class -->
                                    <tr id="FirstClass">
                                        <td>
                                            <input type="radio" name="selected_flight" value="firstClass" class="form-check-input" onchange="calculateTotal()">
                                        </td>
                                        <td>
                                            <strong>Emirates</strong>
                                        </td>
                                        <td>
                                            <div class="text-muted small">
                                                <i class="bi bi-clock me-1"></i> Berangkat 14.15 - Tiba 16.05
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold" id="firstClassPrice"></div>
                                            <small class="text-muted">/orang</small>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Pilih Metode Pembayaran -->
                            <div class="mb-3">
                                <label for="paymentMethod" class="form-label">Pilih Metode Pembayaran</label>
                                <select id="paymentMethod" name="metode_pembayaran" class="form-select" required>
                                    <option value="">Pilih metode pembayaran</option>
                                    <?php foreach ($payment_methods as $key => $value): ?>
                                        <option value="<?= $key ?>"><?= $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div id="payment-method-error" class="invalid-feedback">
                                    Silakan pilih metode pembayaran.
                                </div>
                            </div>

                            <!-- Passenger Count -->
                            <div id="passengerSection" style="display: none;" class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-0">Jumlah Penumpang</h6>
                                        </div>
                                        <div class="input-group" style="width: 120px;">
                                            <button type="button" class="btn btn-outline-secondary" onclick="adjustPassengers(-1)">
                                                <i class="bi bi-dash"></i>
                                            </button>
                                            <input type="text" id="passenger_quantity" name="passenger_quantity" class="form-control text-center" value="1" readonly>
                                            <button type="button" class="btn btn-outline-secondary" onclick="adjustPassengers(1)">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Price -->
                            <div id="totalPriceSection" style="display: none;" class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">Total Harga</h6>
                                        <h5 class="mb-0 fw-bold text-primary" id="total_harga"></h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-ticket-perforated me-2"></i>Pesan Tiket
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Store flight prices for different routes
    const flightPrices = {};

    // Initialize flight prices from PHP data
    function initializeFlightPrices() {
        const asalSelect = document.getElementById('asal');
        const tujuanSelect = document.getElementById('tujuan');

        Array.from(asalSelect.options).forEach(asalOption => {
            if (asalOption.value) {
                Array.from(tujuanSelect.options).forEach(tujuanOption => {
                    if (tujuanOption.value) {
                        const routeKey = `${asalOption.value}-${tujuanOption.value}`;
                        const basePrice = (parseFloat(asalOption.dataset.price) +
                            parseFloat(tujuanOption.dataset.price)) / 2;

                        flightPrices[routeKey] = {
                            economy: basePrice,
                            business: basePrice * 1.5,
                            firstClass: basePrice * 2
                        };
                    }
                });
            }
        });
    }

    // Format currency in IDR
    function formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
    }

    function adjustPassengers(change) {
        const input = document.getElementById('passenger_quantity');
        let value = parseInt(input.value) + change;

        // Batasi nilai antara 1 dan 10
        value = Math.max(1, Math.min(10, value));

        // Update nilai input
        input.value = value.toString();

        // Hitung ulang total
        calculateTotal();
    }

    function updateFlightOptions() {
        const asal = document.getElementById('asal').value;
        const tujuan = document.getElementById('tujuan').value;

        if (asal && tujuan) {
            const routeKey = `${asal}-${tujuan}`;
            const prices = flightPrices[routeKey];

            if (prices) {
                document.getElementById('economyPrice').textContent = formatCurrency(prices.economy);
                document.getElementById('businessPrice').textContent = formatCurrency(prices.business);
                document.getElementById('firstClassPrice').textContent = formatCurrency(prices.firstClass);
            }
        }
    }

    function calculateTotal() {
        const selectedFlight = document.querySelector('input[name="selected_flight"]:checked');
        const passengerCount = parseInt(document.getElementById('passenger_quantity').value) || 1;

        if (selectedFlight) {
            const asal = document.getElementById('asal').value;
            const tujuan = document.getElementById('tujuan').value;
            const routeKey = `${asal}-${tujuan}`;
            const prices = flightPrices[routeKey];

            if (prices) {
                const price = prices[selectedFlight.value];
                const total = price * passengerCount;
                document.getElementById('total_harga').textContent = formatCurrency(total);

                // Tampilkan bagian total harga dan penumpang
                document.getElementById('totalPriceSection').style.display = 'block';
                document.getElementById('passengerSection').style.display = 'block';
            }
        }
    }

    function searchFlights() {
        const asalInput = document.getElementById('asal');
        const tujuanInput = document.getElementById('tujuan');
        const tanggalPergiInput = document.getElementById('tanggal_pergi');
        const tanggalPulangInput = document.getElementById('tgl_pulang');

        // Validasi input
        let isValid = true;

        if (!asalInput.value) {
            asalInput.classList.add('is-invalid');
            isValid = false;
        } else {
            asalInput.classList.remove('is-invalid');
        }

        if (!tujuanInput.value) {
            tujuanInput.classList.add('is-invalid');
            isValid = false;
        } else {
            tujuanInput.classList.remove('is-invalid');
        }

        if (!tanggalPergiInput.value) {
            tanggalPergiInput.classList.add('is-invalid');
            isValid = false;
        } else {
            tanggalPergiInput.classList.remove('is-invalid');
        }

        if (!tanggalPulangInput.value) {
            tanggalPulangInput.classList.add('is-invalid');
            isValid = false;
        } else {
            tanggalPulangInput.classList.remove('is-invalid');
        }

        if (new Date(tanggalPergiInput.value) > new Date(tanggalPulangInput.value)) {
            tanggalPulangInput.classList.add('is-invalid');
            isValid = false;
        }

        if (isValid) {
            // Update flight options dan tampilkan hasil
            updateFlightOptions();
            document.getElementById('flightResults').style.display = 'block';

            // $.ajax({
            //     url: '/searchFlights',
            //     method: 'GET',
            //     data: {
            //         asal: asalInput.value,
            //         tujuan: tujuanInput.value,
            //     },
            //     success: function(response) {
            // console.log(response);
            // var classFlight = response.class;
            // $('#EconomyClass').hide();
            // $('#BusinessClass').hide();
            // $('#FirstClass').hide();
            // $(`#${classFlight}Class`).show();
            //     }
            // })
        }
    }

    // Initialize when document is ready
    document.addEventListener('DOMContentLoaded', function() {
        initializeFlightPrices();
        // Hide results section initially
        document.getElementById('flightResults').style.display = 'none';

        // Add Bootstrap Icons CSS if not already included
        if (!document.querySelector('link[href*="bootstrap-icons"]')) {
            const link = document.createElement('link');
            link.href = 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css';
            link.rel = 'stylesheet';
            document.head.appendChild(link);
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<style>
    .input-group input[type="number"] {
        border-left: 0;
        border-right: 0;
    }

    .input-group input[type="number"]:focus {
        box-shadow: none;
        border-color: #dee2e6;
    }

    .input-group button {
        z-index: 0;
    }

    .small {
        font-size: 0.875rem;
    }
</style>

<?= $this->endSection(); ?>