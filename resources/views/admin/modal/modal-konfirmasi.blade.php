<div class="modal fade" id="modalreject" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title">Alasan Penolakan</h5>
            </div>
            <div class="modal-body">
                <label for="alasan" class="form-label">Alasan Penolakan</label>
                <textarea class="form-control" id="alasan" required placeholder="Alasan Penolakan"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" id="rejected-confirm-button" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalapprove" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <p>Apakah Anda yakin?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" id="approve-confirm-button" class="btn btn-success">Iya, Yakin</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
