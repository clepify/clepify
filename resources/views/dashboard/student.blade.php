@role('student')
  <div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Welcome</h4>
    <p>
      This is your dashboard. You can send a letter to your lecturer from here.
    </p>
    <hr>
    <div class="d-grid col-sm-4 col-xl-3">
      <a href="{{ route('letters') }}" class="btn btn-primary">
        <i class="bi bi-file-earmark-arrow-up"></i>
        Upload Letter
      </a>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <span class="fs-5">My Letters</span>
    </div>
    <div class="card-body">
      <livewire:letter-table />
    </div>
  </div>
@endrole
