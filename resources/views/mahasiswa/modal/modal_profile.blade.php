<!-- Modal Edit Informasi Pribadi -->
<div class="modal fade" id="modal-profile-mhs" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header d-block">
          <h5 class="modal-title" id="modal-title">Edit Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Account -->
    
        <form class="default-form" action="{{ url('mahasiswa/profile/update/'. Auth::user()->nim)}}" method="POST">
          @csrf
        <div class="modal-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
              @if ($mahasiswa?->foto)
                  <img src="{{ Storage::url($mahasiswa->foto) }}" alt="user-avatar"
                      class="img-fluid rounded-circle mb-3 pt-1 mt-4" name="foto" id="imgPreview" width="150" height="150">
              @else
                  <img src="{{ url('assets/img/avatars/14.png') }}" alt="user-avatar"
                      class="img-fluid rounded-circle mb-3 pt-1 mt-4" id="imgPreview" width="150" height="150">
              @endif

              <div class="button-wrapper form-input">
                  <label for="changePicture" class="btn btn-primary me-2 mb-3" tabindex="0">
                      <span class="d-none d-sm-block">Upload new photo</span>
                      <i class="ti ti-upload d-block d-sm-none"></i>
                      <input type="file" id="changePicture" name="foto" class="account-file-input" hidden accept="image/png, image/jpeg" />
                  </label>
                  <div class="invalid-feedback"></div>
                  <div class="text-muted">Allowed JPG, GIF, or PNG. Max size of 800K</div>
              </div>
            </div>
            <div class="border-top">
              <div class="row mt-4">
                <div class="mb-3 col-md-6 form-input">
                  <label for="division" class="form-label">Division</label>
                  <input class="form-control" type="text" id="posisi" name="posisi" />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 col-md-6 form-input">
                  <label for="supervisor" class="form-label">Supervisor</label>
                  <select class="form-select select2" id="id_pegawai" name="id_pegawai"                  data-placeholder="Pilih Supervisor">
                  <option disabled selected>Pilih Supervisor</option>
                    @foreach ($pegawai as $p)
                        <option value="{{ $p->id_pegawai }}">{{ $p->nama }}</option>
                    @endforeach
              </select>
                  <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 col-md-6 form-input">
                  <label for="religion" class="form-label">Religion </label>
                  <input class="form-control" type="text" id="agama" name="agama" />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 col-md-6 form-input">
                  <label for="place" class="form-label">Place Of Birth</label>
                  <input class="form-control" type="text" id="tempatlahirmhs" name="tempatlahirmhs"   />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 col-md-6 form-input">
                  <label for="birth" class="form-label">Date Of Birth</label>
                  <input class="form-control" type="date" id="tanggallahirmhs" name="tanggallahirmhs" />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 col-md-6 form-input">
                  <label class="form-label" for="phoneNumber">Phone Number</label>
                  <input  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" type="text" id="nohpmhs" name="nohpmhs" class="form-control" />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 col-md-4 form-input">
                  <label for="address" class="form-label">Address </label>
                  <input class="form-control" type="text" id="alamatmhs" name="alamatmhs" placeholder="Bandung" />
                    <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 col-md-6 form-input">
                  <label for="gender" id="gender" class="form-label">Gender</label>
                  <div class="form-check">
                      <div class="row">
                          <div class="col-3">
                              <input name="jeniskelamin" class="form-check-input" type="radio" value="Laki-Laki" id="laki-laki">
                              <label class="form-check-label" for="laki-laki">Laki-Laki</label>
                          </div>
                          <div class="col-3 ms-2">
                              <input name="jeniskelamin" class="form-check-input" type="radio" value="Perempuan" id="perempuan">
                              <label class="form-check-label" for="perempuan">Perempuan</label>
                          </div>
                      </div>
                      <div class="invalid-feedback"></div>
                  </div>
                </div>
              </div>
              <div class="modal-footer p-0">
                <button id="modal-button"  type="submit" class="btn btn-success m-0">Simpan Data</button>
              </div>
            </div>
          </div>
        </form>
        <!-- /Account -->
      </div>
    </div>
</div>