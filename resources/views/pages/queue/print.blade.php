<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Struk Antrian</title>
  <style>
      body {
          font-family: Arial, sans-serif;
          text-align: center;
          margin: -2mm;
          padding: 0;
      }

      .container {
          width: 58mm;
          border: 1px solid #ccc;
          padding: 5px;
          margin: 0 auto;
      }
  </style>
</head>
<body>
<div class="container" id="print-template">
  <h2>Struk Antrian</h2>
  <p><strong>Tanggal:</strong> {{ now()->format('d-m-Y H:i:s') }}</p>
  <p><strong>Nomor Antrian:</strong></p>
  <h1>{!! $queue->number !!}</h1>
  <p><strong>Sisa antrian:</strong>{!! $waitQueue !!}</p>
  <p>Terima kasih telah menggunakan layanan kami. Silakan tunggu giliran Anda.</p>
</div>
</body>
</html>