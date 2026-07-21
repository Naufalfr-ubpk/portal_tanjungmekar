<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan FAQ Baru</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f8f4; padding: 20px;">
    <div style="max-w: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 10px; border-top: 5px solid #0E4D2B;">
        <h2 style="color: #0E4D2B;">Pengajuan Pertanyaan (FAQ) Baru</h2>
        <p>Halo {{ $roleName }},</p>
        <p>Ada pengajuan pertanyaan baru dari warga di Portal Tanjungmekar yang butuh divalidasi dan dijawab:</p>
        
        <div style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid #FBC02D; margin: 20px 0;">
            <p style="margin: 0 0 10px 0;"><strong>Nama Warga:</strong> {{ $faq->nama_penanya }}</p>
            <p style="margin: 0 0 10px 0;"><strong>Pertanyaan:</strong> {{ $faq->pertanyaan }}</p>
            <p style="margin: 0;"><strong>Detail Keluhan:</strong> {{ $faq->detail_pertanyaan ?? 'Tidak ada detail' }}</p>
        </div>

        <p>Silakan login ke Panel Admin untuk menjawab dan mempublikasikan FAQ ini agar bisa dilihat oleh warga.</p>
        <br>
        <a href="{{ url('/admin/dashboard') }}" style="background-color: #0E4D2B; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">Ke Dashboard Admin</a>
    </div>
</body>
</html>