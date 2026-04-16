<h2>Status Lamaran Diperbarui</h2>
<p>Halo {{ $application->user->name }},</p>
<p>Status lamaran Anda untuk posisi <strong>{{ $application->job->title }}</strong> telah diperbarui menjadi <strong>{{ strtoupper($application->status) }}</strong>.</p>
@if ($application->status_note)
<p>Catatan recruiter: {{ $application->status_note }}</p>
@endif
<p>Silakan cek dashboard Anda untuk detail lebih lanjut.</p>
