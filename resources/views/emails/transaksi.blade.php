<!DOCTYPE html>
<html>

<head>
    <title>Cleds</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #4facfe;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            font-size: 24px;
        }

        .email-body {
            padding: 20px;
            color: #333333;
        }

        .email-body p {
            margin: 0 0 10px;
            line-height: 1.6;
        }

        .email-body strong {
            color: #000000;
        }

        .email-footer {
            text-align: center;
            color: #888888;
            font-size: 12px;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #dddddd;
        }

        .email-footer p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            Nota Transaksi Cleds
        </div>
        <div class="email-body">
            <p><strong>Nama Pelangan:</strong> {{ $transaksi->nama_customer }}</p>
            <p><strong>No telepon:</strong> {{ $transaksi->notelp_customer }}</p>
            <p><strong>Alamat Pelanggan:</strong> {{ $transaksi->alamat_customer }}</p>
        </div>
        <div class="email-footer">
            <p>Terima kasih telah menggunakan layanan kami.</p>
        </div>
    </div>
</body>

</html>