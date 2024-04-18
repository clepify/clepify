@role('admin', 'lecturer')
  @if ($status == 'Pending')
    <button id="approve" class="btn btn-sm btn-primary dropdown rounded"
      onclick="
                event.preventDefault();
                if (confirm('Letter will be approved, are you sure?')) {
                document.getElementById('approve-{{ $id }}').submit()
                }">
      Approve
      <form id="approve-{{ $id }}" class="d-none" action="{{ route('letters.approve', $id) }}" method="POST">
        @csrf
        @method('patch')
      </form>
    </button>
  @elseif ($status == 'Approved')
    <button id="archive" class="btn btn-sm btn-primary dropdown rounded"
      onclick="
                event.preventDefault();
                if (confirm('Letter will be archived, are you sure?')) {
                document.getElementById('archive-{{ $id }}').submit()
                }">
      Archive
      <form id="archive-{{ $id }}" class="d-none" action="{{ route('letters.archive', $id) }}" method="POST">
        @csrf
        @method('patch')
      </form>
    </button>
  @endif
@endrole
@role('student')
  <div class="btn-group dropleft">
    <button type="button" class="btn btn-ghost-primary dropdown rounded" data-coreui-toggle="dropdown"
      aria-expanded="false">
      <i class="bi bi-three-dots-vertical"></i>
    </button>
    <div class="dropdown-menu" style="padding: 0.25rem 0;">
      <a href="{{ route('letters.edit', $id) }}" class="dropdown-item">
        <i class="bi bi-eye text-primary mr-2" style="line-height: 1;"></i> Detail
      </a>
      @if (now()->diffInMinutes($date) < 10 && $status == 'Pending')
        <a href="{{ route('letters.edit', $id) }}" class="dropdown-item">
          <i class="bi bi-pencil text-warning mr-2" style="line-height: 1;"></i> Edit
        </a>
        <button id="delete" class="dropdown-item mt-1"
          onclick="
                event.preventDefault();
                if (confirm('Letter will be deleted, are you sure?')) {
                document.getElementById('destroy{{ $id }}').submit()
                }">
          <i class="bi bi-trash text-danger mr-2" style="line-height: 1;"></i> Delete
          <form id="destroy{{ $id }}" class="d-none" action="{{ route('letters.destroy', $id) }}"
            method="POST">
            @csrf
            @method('delete')
          </form>
        </button>
      @endif
    </div>
  </div>
@endrole
