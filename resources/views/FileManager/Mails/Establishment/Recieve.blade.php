<!DOCTYPE html>
<html>

<head>
    <title>New Establishment</title>
</head>

<body>
    <h1>New Establishment with Reference Number <strong>{{$ticket}}</strong>Uploaded</h1>
    <p>Hello System Admin, Establishment with Reference Number <strong>{{ $ticket }} </strong> has been Uploaded By
       <span style="color: blue;">{{ $sname }} {{ $fname }}.</span>
        on {{ $created_at}}.</p>
    </p>
    Click the here to <a href="{{ $url }}">Activate</a> or <a href="">Reject</a> the file.
    <p>Thank you.</p>
    <p>Regards,</p>
    <p>MINISTRY OF PUBLIC SERVICE</p>
</body>

</html>
