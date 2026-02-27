<!DOCTYPE html>
<html>
<head>
    <title>Invitation to join {{ $colocation->name }}</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px; color: #333;">

    <h2>Hello! </h2>

    <p>You have been invited to join the colocation: <strong>{{ $colocation->name }}</strong> on EasyColoc.</p>

    <p>If you accept, you will be able to share expenses and manage the colocation together.</p>

    <div style="margin-top: 30px; margin-bottom: 30px;">
        <a href="{{ $acceptUrl }}" style="background-color: #10b981; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold;">
            Accept the Invitation
        </a>
    </div>

    <p style="font-size: 12px; color: #777;">
        If the button doesn't work, copy and paste this link into your browser:<br>
        {{ $acceptUrl }}
    </p>

</body>
</html>
