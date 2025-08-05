<!DOCTYPE html>
<html>

<head>
    <title>New Establishment</title>
</head>

<body>
    <h1>New Establishment Uploaded</h1>
    <p>Hello {{ $establishment->sname }} {{ $establishment->fname }}, Your File with ticket {{ $establishment->ticket}}.
        Has been Uploaded and pending approval.
        Track the progress of your uploads with
        your Reference Number {{ $establishment->ticket }}
    </p>
    <p>Thank you.</p>
    <p>Regards,</p>
    <p>MINISTRY OF PUBLIC SERVICE</p>
</body>

</html>
