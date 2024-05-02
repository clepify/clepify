@extends('layouts.app')

@section('title', 'Letters')

@section('breadcrumb')
    <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><span>Dashboard</span></a></li>
        <li class="breadcrumb-item active"><span>Letters</span></li>
    </ol>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <span class="fs-5">All Letters</span>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <livewire:letter-table />
        </div>
    </div>
@endsection

@push('scripts')
    @foreach ($letters as $letter)
        <script>
            window.setTimeout(function() {
                setupSignaturePad{{ $letter->id }}();
                document.querySelector("#clear-canvas-{{ $letter->id }}").addEventListener("click",
                    clearSignaturePad{{ $letter->id }});

                document.querySelector("#save-signature-{{ $letter->id }}").addEventListener("click",
                    saveSignature{{ $letter->id }});
            }, 1000);

            let signaturePad{{ $letter->id }};
            let canvas{{ $letter->id }};

            function setupSignaturePad{{ $letter->id }}() {
                canvas{{ $letter->id }} = document.querySelector("#signature-{{ $letter->id }}");

                signaturePad{{ $letter->id }} = new SignaturePad(canvas{{ $letter->id }}, {
                    maxWidth: 3,
                });
            }

            function clearSignaturePad{{ $letter->id }}() {
                signaturePad{{ $letter->id }}.clear();
            }

            function saveSignature{{ $letter->id }}() {
                const form = document.querySelector("#approve-{{ $letter->id }}");
                if (signaturePad{{ $letter->id }}.isEmpty()) {
                    console.log("Please provide a signature first.");
                } else {
                    const signature{{ $letter->id }} = signaturePad{{ $letter->id }}.toDataURL();

                    const input = document.createElement("input");
                    input.setAttribute("type", "hidden");
                    input.setAttribute("name", "signature");
                    input.setAttribute("value", signature{{ $letter->id }});

                    form.appendChild(input);
                }
            }
        </script>
    @endforeach
@endpush
