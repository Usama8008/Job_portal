<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Notification Email</title>
</head>
<body>
    <h1>New Job Application for {{ $maildata['job']->title }}</h1>

    <p>Dear {{ $maildata['employer']->name }},</p>

    <p>{{ $maildata['user']->name }} has applied for the job <strong>{{ $maildata['job']->title }}</strong> at {{ $maildata['job']->company_name }}.</p>

    <p>Here are the details of the job:</p>
    <ul>
        <li><strong>Job Title:</strong> {{ $maildata['job']->title }}</li>
        <li><strong>Location:</strong> {{ $maildata['job']->location }}</li>
        <li><strong>Salary:</strong> {{ $maildata['job']->salary }}</li>
    </ul>

    <p>Please find the applicant's resume attached.</p>

    <p>Best regards,</p>
    <p>The Job Portal Team</p>
</body>
</html>
