@if ($id)
  <a href="{{ 'storage/supports/' . $id }}" target="_blank" class="btn btn-primary btn-sm">
    <i class="bi bi-eye"></i>
    View
  </a>
@else
  <span>
    -
  </span>
@endif
