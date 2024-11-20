<!-- Modal Edit Informasi Pribadi -->
<div class="modal fade" id="modalEditProfile" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header d-block">
          <h5 class="modal-title" id="modal-title">Informasi Pribadi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Account -->
    
        <form class="default-form" action="{{ url('mahasiswa/profile/update/'. Auth::user()->nim)}}" method="POST">
          @csrf
        <div class="modal-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4 mb-4 ">
              {{-- @if ($informasiprib?->profile_picture?? '')
                <img src="{{ asset('storage/' . $informasiprib?->profile_picture?? '') }}" alt="user-avatar"
                    class="img-fluid rounded mb-3 pt-1 mt-4" name="profile_picture" id="imgPreview"  width="150" height="auto">
              @else
                  <img src="{{ url("app-assets/img/avatars/14.png")}}" alt="user-avatar" 
                  class="img-fluid rounded mb-3 pt-1 mt-4" id="imgPreview" />
              @endif 
              <div class="button-wrapper form-input">
                <label for="changePicture" class="btn btn-white text-success me-2 mb-3 waves-effect waves-light"
                  tabindex="0">
                  <i class="ti ti-upload d-block pe-2"></i>
                  <span class="d-none d-sm-block">Upload</span>
                  <input type="file" id="changePicture" name="profile_picture" class="account-file-input" hidden
                      accept="image/png, image/jpeg">
                </label>
                <div class="invalid-feedback"></div>
                <button type="button" 
                class="btn btn-label-secondary account-image-reset mb-3" 
                onclick="removeImage()">
                  <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                  <span class="d-none d-sm-block">Reset</span>
                </button>
                <div class="text-muted">Format FIle JPG, GIF atau PNG. Ukuran Maksimal 800KB</div>
              </div>
              --}}
              <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img
                src="../../assets/img/avatars/14.png"
                alt="user-avatar"
                class="d-block w-px-100 h-px-100 rounded"
                id="uploadedAvatar"
                />
                <div class="button-wrapper">
                <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                    <span class="d-none d-sm-block">Upload new photo</span>
                    <i class="ti ti-upload d-block d-sm-none"></i>
                    <input
                    type="file"
                    id="upload"
                    class="account-file-input"
                    hidden
                    accept="image/png, image/jpeg"
                    />
                </label>
                <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                    <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Reset</span>
                </button>

                <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
                </div>
            </div>
            </div>
            <div class="border-top">
              <div class="row mt-4">
                <div class="mb-3 col-md-6">
                  <label for="division" class="form-label">Division<span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="division" name="division" placeholder="" />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="religion" class="form-label">Religion <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="religion" name="religion" autofocus />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="univ" class="form-label">University Origin <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="univ" name="univ" value="" autofocus />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="fakultas" class="form-label">Home faculty<span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="fakultas" name="fakultas" value="" autofocus />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="Prodi" class="form-label">Study Program<span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="prodi" name="prodi" value="" autofocus />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="place" class="form-label">Place Of Birth<span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="place" name="prodi" value="" autofocus />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="birth" class="form-label">Date Of Birth<span style="color: red;">*</span></label>
                  <input class="form-control" type="date" id="birth" name="birth" value="" autofocus />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="phoneNumber">Phone Number</label>
                  <input  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" type="text" id="phoneNumber" name="phoneNumber" class="form-control" value="" autofocus />
                </div>
                <div class="mb-3 col-md-4 form-input">
                  <label for="address" class="form-label">Address <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="address" name="address" placeholder="" value="" autofocus />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 col-md-6">
                  <label for="gender" id="gender" class="form-label">Gender <span style="color: red;">*</span></label>
                  <div class="form-check">
                    <div class="row">
                      <div class="col-3" >
                        <input name="gender" class="form-check-input" type="radio" value="Laki-Laki" id="gender1" checked="">
                        <label class="form-check-label" for="gender">Laki-Laki </label>
                      </div>
                      <div class="col-3 ms-2">
                        <input name="gender" class="form-check-input" type="radio" value="Perempuan" id="gender1" checked="">
                        <label class="form-check-label" for="gender">Perempuan </label>
                      </div>
                    </div>
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