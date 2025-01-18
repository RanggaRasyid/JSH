<div class="modal fade" id="modal-loogbook" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modal-title">Tambah Aktifitas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" enctype="multipart/form-data" action="{{ route('store.loogbook') }}">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="nama" class="form-label">Judul Aktifitas</label>
                            <input type="text" id="nama" onkeyup="this.value = this.value.replace(/[^a-zA-Z\s]+/gi, '');" name="nama" class="form-control" placeholder="Editing Konten" />
                            <div class="invalid-feedback"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Membuat Konen Instagram"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="file" class="form-label">masukkan gambar</label>
                            <input class="form-control" name="picture" type="file" id="picture">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" data-bs-toggle="first" id="modal-button" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>