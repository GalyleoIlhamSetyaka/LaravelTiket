<!-- resources/views/pemesanan/ticket-pdf.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>E-Tiket {{ $ticket->order_code }}</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .ticket {
            border: 2px solid #000;
            border-radius: 8px;
            padding: 30px;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
        }
        .header h1 {
            margin: 0 0 10px;
            font-size: 24px;
            color: #111827;
        }
        .header h2 {
            margin: 0;
            font-size: 18px;
            color: #6b7280;
        }
        .details {
            margin-bottom: 40px;
        }
        .detail-row {
            margin-bottom: 15px;
        }
        .detail-label {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 4px;
        }
        .detail-value {
            font-size: 16px;
            color: #111827;
            font-weight: 500;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 12px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="ticket">
            <div class="header">
                <h1>Hutan Pinusan Kalilo</h1>
                <h2>E-Tiket</h2>
            </div>

            <div class="details">
                <div class="detail-row">
                    <div class="detail-label">Kode Pemesanan</div>
                    <div class="detail-value">{{ $ticket->order_code }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Nama Pengunjung</div>
                    <div class="detail-value">{{ $ticket->pengunjung->name }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Tanggal Kunjungan</div>
                    <div class="detail-value">{{ $ticket->order_date->format('d F Y') }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Jumlah Orang</div>
                    <div class="detail-value">{{ $ticket->num_people }} orang</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Total Harga</div>
                    <div class="detail-value">Rp {{ number_format($ticket->price, 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="footer">
                <p>Tiket ini adalah dokumen sah dan hanya berlaku untuk tanggal kunjungan yang tertera</p>
                <p>Lokasi: Desa Tlogoguwo, Kecamatan Kaligesing, Kabupaten Purworejo, Jawa Tengah</p>
                <p>Silakan tunjukkan tiket ini kepada petugas saat memasuki area wisata</p>
            </div>
        </div>
    </div>
</body>
</html>