@role('student')
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <span class="fs-5">My Letters</span>
      <a href="{{ route('letters.create') }}" class="btn btn-primary">
        <i class="bi bi-file-earmark-arrow-up"></i>
        Upload Letter
      </a>
    </div>
    <div class="card-body">
      <livewire:letter-table />
    </div>
  </div>
@endrole
