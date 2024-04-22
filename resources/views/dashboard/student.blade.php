@role('student')
  <div class="container mb-5">
    <div class="row gx-2 align-items-center">
      <div class="col-12 col-lg-7">
        <h1 class="fw-bold">CLEPify - </h1>
        <h2 class="h1 fw-normal mb-4">Campus Letter Efficiency Practicum</h2>
        <p class="lead mb-5">Our cutting-edge solution in managing campus letters swiftly and efficiently. With a focus
          on
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
  <div class="container mb-5 mt-5">
    <div class="text-center">
      <h1>Our Services</h1>
      <p>Through our flagship services, we are committed to simplify and enhance efficiency in the documentation process
        within educational institutions.</p>
    </div>
    <div class="row mt-5">
      <div class="col-12 col-md-4">
        <div class="card mb-5 pb-4">
          <div class="card-body text-center">
            <i class="bi bi-hdd-stack-fill" style="font-size: 6rem;"></i>
            <h5 class="card-title">Data Storage Security</h5>
            <p class="card-text">Data security is our top priority, achieved by providing secure and encrypted data
              storage.</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="card mb-5 pb-4">
          <div class="card-body text-center">
            <i class="bi bi-envelope-fill" style="font-size: 6rem;"></i>
            <h5 class="card-title">Electronic Signature</h5>
            <p class="card-text">With our electronic signature feature, you can sign documents digitally quickly and
              securely.</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="card mb-5 pb-4">
          <div class="card-body text-center">
            <i class="bi bi-chat-left-text" style="font-size: 6rem;"></i>
            <h5 class="card-title">Digital Letter Management</h5>
            <p class="card-text">We provide a comprehensive platform for managing incoming and outgoing letters digitally.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endrole
