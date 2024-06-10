@if ($id)
    <button type="button" href="#" class="btn btn-link btn-sm" data-coreui-toggle="modal"
        data-coreui-target="#supportModal-{{ str_replace('.pdf', '', $id) }}">
        View
    </button>

    <div class="modal modal-xl fade" id="supportModal-{{ str_replace('.pdf', '', $id) }}" tabindex="-1"
        aria-labelledby="supportModalLabel-{{ str_replace('.pdf', '', $id) }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="supportModalLabel-{{ str_replace('.pdf', '', $id) }}">Support</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe src="{{ 'storage/supports/' . $id }}" width="100%" height="600px"></iframe>
                </div>
            </div>
        </div>
    </div>
@else
    <span>
        -
    </span>
@endif
