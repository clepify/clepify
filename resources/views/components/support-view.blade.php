@if ($id)
  <a href="{{ route('letters.show', $id) }}" class="btn btn-primary btn-sm">
    <i class="bi bi-eye"></i>
    View
  </a>
@else
  <span>
    -
  </span>
@endif
