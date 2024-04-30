@if ($status == 'Pending')
  <span class="badge warning-badge">
    {{ $status }}
  </span>
@elseif ($status == 'Approved')
  <span class="badge success-badge">
    {{ $status }}
  </span>
@elseif ($status == 'Rejected')
  <span class="badge danger-badge">
    {{ $status }}
  </span>
@else
  @role('student')
  @if (end($letter_status) == 'Approved')
    <span class="badge success-badge">
      {{ end($letter_status) }}
    </span>
  @elseif (end($letter_status) == 'Rejected')
    <span class="badge danger-badge">
      {{ end($letter_status) }}
    </span>
  @endif
  </span>
  @endrole
  @role('admin', 'lecturer')
  <span class="badge secondary-badge">
    {{ $status }}
  </span>
  @endrole
@endif
