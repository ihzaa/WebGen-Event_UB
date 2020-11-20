<div id="modal_detail" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1 " role="dialog"
    aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Detail Event</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img class="img-fluid" id="event_poster" src="{{asset('images/default/picture.svg')}}"
                            alt="Poster Event">
                    </div>
                    <div class="col-md-8">
                        <h3 class="mb-1" id="event_title"></h3>
                        <p class="text-muted mb-1">
                            <i class="far fa-calendar-alt"></i> <span id="event_date"></span>
                        </p>
                        <p class="text-muted mb-1">
                            Kategori : <span id="event_cat"></span>
                        </p>
                        <div id="event_desc"></div>
                    </div>
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div> --}}
        </div>
    </div>
</div>
