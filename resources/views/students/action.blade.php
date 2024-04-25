<a class="btn btn-sm btn-warning dropdown rounded" href="{{ route('students.edit', $id) }}">
    <i class="bi bi-pencil mr-2" style="line-height: 1;"></i>
    Edit
</a>
<button class="btn btn-sm btn-danger dropdown rounded text-white"
    onclick="
                event.preventDefault();
                if (confirm('Class will be deleted, are you sure?')) {
                document.getElementById('delete-{{ $id }}').submit()
                }">
    <i class="bi bi-trash mr-2" style="line-height: 1;"></i>
    Delete
</button>
<form id="delete-{{ $id }}" class="d-none" action="{{ route('students.destroy', $id) }}" method="POST">
    @csrf
    @method('DELETE')
</form>
