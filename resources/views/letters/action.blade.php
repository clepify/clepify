@role('admin', 'lecturer')
    <div class="btn-group dropleft">
        <button type="button" class="btn btn-ghost-primary dropdown rounded" data-coreui-toggle="dropdown"
            aria-expanded="false">
            <i class="bi bi-three-dots-vertical"></i>
        </button>
        <div class="dropdown-menu" style="padding: 0.25rem 0;">
            @if ($status == 'Pending')
                <button type="button" href="#" class="dropdown-item" data-coreui-toggle="modal"
                    data-coreui-target="#approveModal-{{ $id }}">
                    <i class="bi bi-check2-circle text-primary mr-2" style="line-height: 1;"></i> Approve
                </button>
                <button type="button" href="#" class="dropdown-item" data-coreui-toggle="modal"
                    data-coreui-target="#rejectModal">
                    <i class="bi bi-x-circle text-danger mr-2" style="line-height: 1;"></i> Reject
                </button>
            @elseif ($status == 'Approved' || $status == 'Rejected')
                <button type="button" href="#" class="dropdown-item" data-coreui-toggle="modal"
                    data-coreui-target="#archiveModal-{{ $id }}">
                    <i class="bi bi-archive text-primary mr-2" style="line-height: 1;"></i> Archive
                </button>
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
                <button type="button" href="#" class="dropdown-item" data-coreui-toggle="modal"
                    data-coreui-target="#detailModal-{{ $id }}">
                    <i class="bi bi-eye text-primary mr-2" style="line-height: 1;"></i>
                    Detail
                </button>
            @elseif (now()->diffInMinutes($date) < 10 && $status == 'Pending')
                <a href="{{ route('letters.edit', $id) }}" class="dropdown-item">
                    <i class="bi bi-pencil text-warning mr-2" style="line-height: 1;"></i> Edit
                </a>
                <button type="button" href="#" class="dropdown-item" data-coreui-toggle="modal"
                    data-coreui-target="#deleteModal-{{ $id }}">
                    <i class="bi bi-trash text-danger mr-2" style="line-height: 1;"></i> Delete
                </button>
            @else
                <button type="button" href="#" class="dropdown-item" data-coreui-toggle="modal"
                    data-coreui-target="#detailModal-{{ $id }}">
                    <i class="bi bi-eye text-primary mr-2" style="line-height: 1;"></i>
                    Detail
                </button>
            @endif
        </div>
    </div>
@endrole

<div class="modal fade" id="approveModal-{{ $id }}" tabindex="-1"
    aria-labelledby="approveModalLabel-{{ $id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalLabel-{{ $id }}">Approve Letter</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="approve-{{ $id }}" action="{{ route('letters.approve', $id) }}" method="POST">
                @csrf
                @method('patch')
                @if ($type == 'Request')
                    <div class="modal-body text-start">
                        <div class="">
                            <label for="feedback_message" class="form-label">Feedback Message</label>
                            <textarea class="form-control" name="feedback_message" id="feedback_message"></textarea>
                        </div>
                    </div>
                @elseif ($type == 'Absence')
                    <div class="modal-body text-start">
                        <p>
                            Sign your initial below to approve this letter
                        </p>
                        <canvas id="signature-{{ $id }}" class="border" width="350"></canvas>
                    </div>
                @endif
                <div class="modal-footer">
                    <button id="clear-canvas-{{ $id }}" type="button" class="btn btn-dark">Reset</button>
                    <button id="save-signature-{{ $id }}" type="submit" class="btn btn-primary"
                        autofocus>Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModal">Reject Letter</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="reject-{{ $id }}" action="{{ route('letters.reject', $id) }}" method="POST">
                @csrf
                @method('patch')
                <div class="modal-body text-start">
                    <div class="mb-3">
                        <label for="feedback_message" class="form-label">Feedback Message</label>
                        <textarea class="form-control" name="feedback_message" id="feedback_message"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" autofocus>Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="archiveModal-{{ $id }}" tabindex="-1"
    aria-labelledby="archiveModalLabel-{{ $id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="archiveModalLabel-{{ $id }}">Archive Letter</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="archive-{{ $id }}" action="{{ route('letters.archive', $id) }}" method="POST">
                @csrf
                @method('patch')
                <div class="modal-body text-start">
                    <p>Are you sure to archive this letter?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" autofocus>Archive</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal-{{ $id }}" tabindex="-1"
    aria-labelledby="deleteModalLabel-{{ $id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel-{{ $id }}">Delete Letter</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="delete-{{ $id }}" action="{{ route('letters.destroy', $id) }}" method="POST">
                @csrf
                @method('delete')
                <div class="modal-body text-start">
                    <p>Are you sure to delete this letter?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" autofocus>Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal modal-lg fade" id="detailModal-{{ $id }}" tabindex="-1"
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
                @elseif ($status == 'Archived')
                    @php
                        $letter_archive = \App\Models\User::find(end($letter_status))->name;
                        $last_status = \App\Models\LetterStatus::where('letter_id', $id)->latest()->first()
                            ->status_before;
                    @endphp
                    <div class="alert alert-{{ $last_status == 'Approved' ? 'success' : 'danger' }}" role="alert">
                        <i
                            class="bi bi-{{ $last_status == 'Approved' ? 'check' : 'x' }}-circle-fill text-{{ $last_status == 'Approved' ? 'success' : 'danger' }}"></i>
                        Your letter has been {{ strtolower($last_status) }} by {{ $letter_archive }}
                    </div>
                    @if ($last_status == 'Rejected')
                        <div class="alert alert-info text-start" role="alert">
                            {{ $feedback_message }}
                        </div>
                    @endif
                @elseif ($status == 'Approved')
                    @php
                        $letter_approve = \App\Models\User::find(end($letter_status))->name;
                    @endphp
                    <div class="alert alert-success" role="alert">
                        <i class="bi bi-check-circle-fill text-success"></i>
                        Your letter has been approved by {{ $letter_approve }}
                    </div>
                    @if (isset($signature[0]))
                        <a href="{{ 'storage/signatures/' . $signature[0] }}" class="btn btn-primary"
                            download>Download Signature</a>
                    @endif
                    @if ($type == 'Request')
                        <div class="alert alert-info text-start" role="alert">
                            {{ $feedback_message }}
                        </div>
                    @endif
                @elseif ($status == 'Rejected')
                    @php
                        $letter_reject = \App\Models\User::find(end($letter_status))->name;
                    @endphp
                    <div class="alert alert-danger" role="alert">
                        <i class="bi bi-x-circle-fill text-danger"></i>
                        Your letter has been rejected by {{ $letter_reject }}
                    </div>
                    <div class="alert alert-info text-start" role="alert">
                        {{ $feedback_message }}
                    </div>
                @endif
            </div>
            @if ($status == 'Rejected')
                <div class="modal-footer">
                    <a href="{{ route('letters.create') }}" class="btn btn-primary">Send letter again</a>
                </div>
            @endif
        </div>
    </div>
</div>
