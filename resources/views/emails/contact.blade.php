<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Message</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            border-bottom: 2px solid #00aeae;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #00aeae;
            margin: 0;
        }
        .contact-info {
            background-color: #e6f7f7;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .message-content {
            border-left: 3px solid #0891b2;
            padding-left: 15px;
            margin-top: 20px;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>New Contact Form Submission</h1>
    </div>
    
    <div class="contact-info">
        <p><strong>From:</strong> {{ $data['name'] }}</p>
        <p><strong>Email:</strong> {{ $data['email'] }}</p>
        <p><strong>Subject:</strong> {{ $data['subject'] }}</p>
    </div>
    
    <div class="message-content">
        <h3>Message:</h3>
        <p>{{ $data['message'] }}</p>
    </div>
    
    <div class="footer">
        <p>This email was sent from the contact form on HealthSync website.</p>
        <p>© {{ date('Y') }} HealthSync. All rights reserved.</p>
    </div>
</body>
</html> 