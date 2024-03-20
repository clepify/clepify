@if ($status == 'Pending')
  <span class="badge warning-badge">
    {{ $status }}
  </span>
@elseif ($status == 'Approved')
  <span class="badge success-badge">
    {{ $status }}
  </span>
@else
  <span class="badge secondary-badge">
    {{ $status }}
  </span>
@endif
