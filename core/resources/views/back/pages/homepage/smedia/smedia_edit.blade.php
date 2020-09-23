<div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="{{ route('admin.sm.epost',$smedia->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Url</label>
                    <input type="url" name="url" class="form-control" required value="{{ $smedia->url }}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>