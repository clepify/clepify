@role('admin')
  <nav class="nav nav-fill">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <button class="nav-link active" id="nav-0-tab" data-coreui-toggle="tab" data-coreui-target="#nav-0" type="button"
        role="tab" aria-controls="nav-0" aria-selected="true">D4 Teknik Informatika</button>
      <button class="nav-link" id="nav-1-tab" data-coreui-toggle="tab" data-coreui-target="#nav-1" type="button"
        role="tab" aria-controls="nav-1" aria-selected="false">D4 Sistem Informasi
        Bisnis</button>
      <button class="nav-link" id="nav-2-tab" data-coreui-toggle="tab" data-coreui-target="#nav-2" type="button"
        role="tab" aria-controls="nav-2" aria-selected="false">D2 Rekayasa Perangkat
        Lunak</button>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active bg-white pt-2" id="nav-0" role="tabpanel" aria-labelledby="nav-0-tab"
      tabindex="0">
      @include('dashboard.grid-0')
    </div>
    <div class="tab-pane fade bg-white pt-2" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab" tabindex="0">
      @include('dashboard.grid-1')
    </div>
    <div class="tab-pane fade bg-white pt-2" id="nav-2" role="tabpanel" aria-labelledby="nav-2-tab" tabindex="0">
      @include('dashboard.grid-2')
    </div>
  </div>
@endrole
