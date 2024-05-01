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
                    <button href="{{ route('letters.approve', $id) }}" class="dropdown-item"
                        onclick="
      event.preventDefault();
      if (confirm('Letter will be approved, are you sure?')) {
      document.getElementById('approve-{{ $id }}').submit()
      }">
                        <i class="bi bi-check2-circle text-primary mr-2" style="line-height: 1;"></i> Approve
                    </button>
                </form>
                <form id="reject-{{ $id }}" action="#" method="POST">
                    @csrf
                    @method('patch')
                    <button type="button" href="#" class="dropdown-item" data-coreui-toggle="modal"
                        data-coreui-target="#rejectModal">
                        <i class="bi bi-x-circle text-danger mr-2" style="line-height: 1;"></i> Reject
                    </button>
                </form>
            @elseif ($status == 'Approved' || $status == 'Rejected')
                <form id="archive-{{ $id }}" action="{{ route('letters.archive', $id) }}" method="POST">
                    @csrf
                    @method('patch')
                    <button href="{{ route('letters.archive', $id) }}" class="dropdown-item"
                        onclick="
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
            @if ($status == 'Rejected')
                <form id="detail-{{ $id }}" action="#" method="POST">
                    @csrf
                    @method('patch')
                    <button type="button" href="#" class="dropdown-item" data-coreui-toggle="modal"
                        data-coreui-target="#detailModal">
                        <i class="bi bi-eye text-primary mr-2" style="line-height: 1;"></i> Detail
                    </button>
                </form>
            @endif
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
            @else
                <form id="detail-{{ $id }}" action="#" method="POST">
                    @csrf
                    @method('patch')
                    <button type="button" href="#" class="dropdown-item" data-coreui-toggle="modal"
                        data-coreui-target="#detailModal-{{ $id }}">
                        <i class="bi bi-eye text-primary mr-2" style="line-height: 1;"></i>
                        Detail
                    </button>
                </form>
                </form>
            @endif
        </div>
    </div>
@endrole

<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModal">Feedback Message</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="reject-{{ $id }}" action="{{ route('letters.reject', $id) }}" method="POST">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="feedback_message" class="col-form-label">Message:</label>
                        <textarea class="form-control" name="feedback_message" id="feedback_message"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send message</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="detailModal-{{ $id }}" tabindex="-1"
    aria-labelledby="detailModalLabel-{{ $id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel-{{ $id }}">Letter Detail</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($status == 'Pending')
                    <div class="alert alert-warning" role="alert">
                        <i class="bi bi-exclamation-triangle-fill text-warning"></i> Your letter is still pending
                    </div>
                @elseif ($status == 'Approved')
                    @php
                        $letter_approve = \App\Models\User::find(end($letter_status))->name;
                    @endphp
                    <div class="alert alert-success" role="alert">
                        <i class="bi bi-check-circle-fill text-success"></i>
                        Your letter has been approved by {{ $letter_approve }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
