@role('admin', 'lecturer')
<div class="btn-group dropleft">
  <button type="button" class="btn btn-ghost-primary dropdown rounded" data-coreui-toggle="dropdown"
    aria-expanded="false">
    <i class="bi bi-three-dots-vertical"></i>
  </button>
  <div class="dropdown-menu" style="padding: 0.25rem 0;">
    @if ($status == 'Pending')
    <form id="approve-{{ $id }}" action="{{ route('letters.approve', $id) }}" method="POST">
      @csrf
      @method('patch')
      <button href="{{ route('letters.approve', $id) }}" class="dropdown-item" onclick="
      event.preventDefault();
      if (confirm('Letter will be approved, are you sure?')) {
      document.getElementById('approve-{{ $id }}').submit()
      }">
        <i class="bi bi-check2-circle text-primary mr-2" style="line-height: 1;"></i> Approve
      </button>
    </form>
    <form id="reject-{{ $id }}" action="{{ route('letters.reject', $id) }}" method="POST">
      @csrf
      @method('patch')
      <button href="{{ route('letters.reject', $id) }}" class="dropdown-item" onclick="
      event.preventDefault();
      if (confirm('Letter will be rejected, are you sure?')) {
      document.getElementById('reject-{{ $id }}').submit()
      }">
        <i class="bi bi-x-circle text-primary mr-2" style="line-height: 1;"></i> Reject
      </button>
    </form>
    @elseif ($status == 'Approved')
    <form id="archive-{{ $id }}" action="{{ route('letters.archive', $id) }}" method="POST">
      @csrf
      @method('patch')
      <button href="{{ route('letters.archive', $id) }}" class="dropdown-item" onclick="
      event.preventDefault();
      if (confirm('Letter will be archived, are you sure?')) {
      document.getElementById('archive-{{ $id }}').submit()
      }">
        <i class="bi bi-archive text-primary mr-2" style="line-height: 1;"></i> Archive
      </button>
    </form>
    @endif
  </div>
</div>
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
