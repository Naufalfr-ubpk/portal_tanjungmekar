<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; background-color: #f4f8f4; padding: 20px;">
    <div style="max-w: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 10px; border-top: 5px solid #0E4D2B;">
        <h2 style="color: #0E4D2B;">Halo {{ $faq->nama_penanya }},</h2>
        
        @if($faq->status == 'dipublikasi')
            <p>Pertanyaan yang Anda ajukan telah <strong>dijawab dan dipublikasikan</strong> di Pusat FAQ kami.</p>
        @elseif($faq->status == 'ditolak')
            <p>Mohon maaf, pertanyaan yang Anda ajukan <strong>ditolak/tidak dapat dipublikasikan</strong> pada saat ini.</p>
        @endif

        <div style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid #FBC02D; margin: 20px 0;">
            <p style="margin: 0 0 10px 0;"><strong>Pertanyaan Anda:</strong> {{ $faq->pertanyaan }}</p>
            <p style="margin: 0;"><strong>Tanggapan Kami:</strong><br> {{ $faq->jawaban }}</p>
        </div>

        <p>Terima kasih telah berpartisipasi di Portal Tanjungmekar!</p>
        <br>
        <a href="{{ url('/faq') }}" style="background-color: #0E4D2B; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">Lihat Halaman FAQ</a>
    </div>
</body>
</html>