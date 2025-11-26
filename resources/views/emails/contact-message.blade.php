<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #8B4513; color: white; padding: 20px; text-align: center; }
        .content { background: #f9f9f9; padding: 20px; }
        .info-row { margin: 10px 0; padding: 10px; background: white; border-left: 3px solid #8B4513; }
        .label { font-weight: bold; color: #8B4513; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Pesan Kontak Baru</h2>
        </div>
        <div class="content">
            <p>Anda menerima pesan baru dari formulir kontak website:</p>
            
            <div class="info-row">
                <span class="label">Nama:</span> {{ $contactData['name'] }}
            </div>
            
            <div class="info-row">
                <span class="label">Email:</span> {{ $contactData['email'] }}
            </div>
            
            @if(!empty($contactData['phone']))
            <div class="info-row">
                <span class="label">Telepon:</span> {{ $contactData['phone'] }}
            </div>
            @endif
            
            @if(!empty($contactData['subject']))
            <div class="info-row">
                <span class="label">Subjek:</span> {{ $contactData['subject'] }}
            </div>
            @endif
            
            <div class="info-row">
                <span class="label">Pesan:</span><br>
                {{ $contactData['message'] }}
            </div>
        </div>
    </div>
</body>
</html>
