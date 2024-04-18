@if ($status == 'Pending')
  <button id="approve" class="btn btn-sm btn-primary dropdown rounded"
    onclick="
                event.preventDefault();
                if (confirm('Letter will be approved, are you sure?')) {
                document.getElementById('approve-{{ $id }}').submit()
                }">
    Approve
    <form id="approve-{{ $id }}" class="d-none" action="{{ route('letters.approve', $id) }}" method="POST">
      @csrf
      @method('patch')
    </form>
  </button>
@endif
{{-- <div class="btn-group dropleft">
  <button type="button" class="btn btn-ghost-primary dropdown rounded" data-toggle="dropdown" aria-expanded="false">
    <i class="bi bi-three-dots-vertical"></i>
  </button>
  <div class="dropdown-menu">
    <a target="_blank" href="{{ route('sales.pos.pdf', $data->reference) }}" class="dropdown-item">
      <i class="bi bi-file-earmark-pdf text-success mr-2" style="line-height: 1;"></i> Invoice
    </a>
    <a href="{{ route('sale-payments.index', $data->id) }}" class="dropdown-item">
      <i class="bi bi-cash-coin text-warning mr-2" style="line-height: 1;"></i> Pembayaran
    </a>
    <a href="{{ route('sales.edit', $data->id) }}" class="dropdown-item">
      <i class="bi bi-pencil text-primary mr-2" style="line-height: 1;"></i> Edit
    </a>
    <a href="{{ route('letters.index') }}" class="dropdown-item">
      <i class="bi bi-eye text-info mr-2" style="line-height: 1;"></i> Detail
    </a>
    <button id="delete" class="dropdown-item"
      onclick="
                event.preventDefault();
                if (confirm('Data akan dihapus secara permanen, apakah anda yakin?')) {
                document.getElementById('destroy{{ $data->id }}').submit()
                }">
      <i class="bi bi-trash text-danger mr-2" style="line-height: 1;"></i> Hapus
      <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('sales.destroy', $data->id) }}"
        method="POST">
        @csrf
        @method('delete')
      </form>
    </button>
  </div>
</div> --}}
