<span
  class="btn {{ $status === 'Pending'
      ? 'btn-warning'
      : ($status === 'Approved'
          ? 'btn-success'
          : ($status === 'Rejected'
              ? 'btn-danger'
              : 'btn-secondary')) }} btn-sm rounded-pill">
  {{ $status }}
</span>
