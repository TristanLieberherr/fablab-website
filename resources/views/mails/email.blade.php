<!DOCTYPE html>
<html>
<head>
	<title>Laravel Mail Queue Tutorial</title>
</head>
<body>
<p>Hello! This is a test email.</p>
<p>I was sent at {{ \Carbon\Carbon::now('+02:00') }}</p>
<ul>
  @foreach ($jobs as $job)
  <li>Demande de {{ $job->job_type }} du {{ $job->created_at }}</li>
  @endforeach
</ul>
</body>
</html>