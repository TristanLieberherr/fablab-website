<!DOCTYPE html>
<html>
<head>
	<title>Laravel Mail Queue Tutorial</title>
</head>
<body>
<p>Hello! This is a test email.</p>
<p>I was sent at {{ \Carbon\Carbon::now('+02:00') }}</p>
<p>User ID : {{ $userID }}</p>
@foreach ($jobs as $job)
  <p>Demande de {{ $job->job_type }} (id#{{ $job->id }}) du {{ $job->created_at }}</p>
  <ul>
    @if ($job->new_status_event)
      <li>Nouveau statut : {{ $job->new_status_event->data }}</li>
    @endif
    @if ($job->new_messages_count)
      <li>{{ $job->new_messages_count }} Nouveau-x messages</li>
    @endif
    @if (count($job->new_files_event) > 0)
      <li>Nouveaux fichiers :</li>
      <ul>
        @foreach ($job->new_files_event as $file_event)
          <li>{{ $file_event->data }}</li>
        @endforeach
      </ul>
    @endif
  </ul>
@endforeach
</body>
</html>