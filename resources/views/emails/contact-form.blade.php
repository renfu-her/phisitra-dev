<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>新的聯絡表單訊息</title>
</head>
<body>
    <h2>新的聯絡表單訊息</h2>
    
    <p><strong>姓名：</strong> {{ $data['name'] }}</p>
    <p><strong>電子郵件：</strong> {{ $data['email'] }}</p>
    <p><strong>主旨：</strong> {{ $data['subject'] }}</p>
    <p><strong>訊息內容：</strong></p>
    <p>{{ $data['message'] }}</p>
</body>
</html> 