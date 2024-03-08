<div class="text-white">
  <a href="{{ route('letters.edit', $id) }}" class="btn btn-info">
    <i class="bi bi-pencil"></i>
  </a>
  <a href="{{ route('letters.show', $id) }}" class="btn btn-primary">
    <i class="bi bi-eye"></i>
  </a>
  <button id="delete" class="btn btn-danger" data-confirm-delete="true"
    onclick="
  event.preventDefault();
  if (confirm('Are you sure? It will delete the data permanently!')) {
      document.getElementById('destroy{{ $id }}').submit()
  }
  ">
    <i class="bi bi-trash"></i>
    <form id="destroy{{ $id }}" class="d-none" action="{{ route('letters.destroy', $id) }}" method="POST">
      @csrf
      @method('delete')
    </form>
  </button>
</div>
