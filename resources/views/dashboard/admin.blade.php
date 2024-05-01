@role('admin')
    <nav class="nav nav-fill">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            @foreach ($study_programs as $study_program)
                <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="nav-{{ $loop->index }}-tab"
                    data-coreui-toggle="tab" data-coreui-target="#nav-{{ $loop->index }}" type="button" role="tab"
                    aria-controls="nav-{{ $loop->index }}"
                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $study_program->level . ' ' . $study_program->name }}</button>
            @endforeach
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        @foreach ($study_programs as $study_program)
            @if ($study_program->classes->isEmpty())
                <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }} bg-white pb-1 pt-4"
                    id="nav-{{ $loop->index }}" role="tabpanel" aria-labelledby="nav-{{ $loop->index }}-tab"
                    tabindex="0">
                    <div class="container-fluid">
                        <div class="alert alert-info" role="alert">
                            There are no classes available for this study program.
                        </div>
                    </div>
                </div>
            @else
                <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }} bg-white pt-2"
                    id="nav-{{ $loop->index }}" role="tabpanel" aria-labelledby="nav-{{ $loop->index }}-tab"
                    tabindex="0">
                    <div class="container-fluid">
                        @foreach ($study_program->classes->groupBy('level')->sortKeys() as $level => $classes)
                            <div class="callout callout-primary">
                                Tingkat {{ $level }}
                            </div>
                            <div class="row">
                                @foreach ($classes as $class)
                                    <div class="col-sm-4 col-lg-2">
                                        <a href="#" class="text-decoration-none">
                                            <div class="card bg-primary mb-4 text-white">
                                                <div class="card-body">
                                                    <div class="fs-4 fw-semibold">{{ $class->name }}</div>
                                                    <div>Letter count: {{ $class->students->count() }}</div>
                                                    <div>Student count: {{ $class->students->count() }}</div>
                                                    <small
                                                        class="text-medium-emphasis-inverse">{{ $class->dpa_name }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endrole
