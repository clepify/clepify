@role('student')
  <div class="container">
    <div class="row gx-2 align-items-center">
      <div class="col-12 col-lg-7">
        <h1 class="fw-bold">CLEPify - </h1>
        <h2 class="h1 fw-normal mb-4">Campus Letter Efficiency Practicum</h2>
        <p class="lead mb-5">Our cutting-edge solution in managing campus letters swiftly and efficiently. With a focus on
          simplicity and effectiveness, our service enables educational institutions to deliver their messages with
          unparalleled timeliness and accuracy</p>
        <a href="{{ route('letters.create') }}" class="btn btn-primary">Send Letter</a>
      </div>
      <div class="col-12 col-lg-5 d-none d-lg-block">
        <div class="d-flex text-white">
          <div class="col-10">
            <img src="{{ asset('/images/dashboard-illustration.svg') }}" alt="" width="600" height="600">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row gx-2 align-items-center">
      <div class="col-12 col-lg-7">
        <h1>{{ config('app.name', 'CLEPify') }}</h1>
        <hr class="border-primary-subtle mb-5">
        <h2 class="h1 mb-4">Campus Letter Efficiency Practicum</h2>
        <p class="lead mb-5">Sistem Informasi Manajemen Persuratan Mahasiswa Berbasis Web Di
          Jurusan Teknologi Informasi Politeknik Negeri Malang.</p>
        <a href="{{ route('letters.create') }}" class="btn btn-primary">Send Letter</a>
      </div>
      <div class="col-12 col-lg-5 d-none d-lg-block">
        <div class="d-flex text-white">
          <div class="col-10">
            <img src="{{ asset('/images/dashboard-illustration.svg') }}" alt="" width="600" height="600">
          </div>
        </div>
      </div>
    </div>
  </div>
@endrole
