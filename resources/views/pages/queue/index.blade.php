<!DOCTYPE html>
<html
    lang="en"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="{{asset('')}}"
    data-template="vertical-menu-template-no-customizer">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>System Antrian</title>
  
  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}"/>
  
  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}"/>
  
  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}"/>
  
  <!-- Helpers -->
  <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
  <script src="{{ asset('assets/js/config.js') }}"></script>
</head>
<body>
<div class="layout-wrapper">
  <div class="layout-container">
    <div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-4">
          <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="card">
              <div class="card-body text-center">
                <div class="role-heading">
                  <h4 class="mb-1">Jumlah Antrian</h4>
                  <h1 class="m-2" id="pendingCount">{!! $pendingCount !!}</h1>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="card">
              <div class="card-body text-center">
                <div class="role-heading">
                  <h4 class="mb-1">Antrian terakhir</h4>
                  <h1 class="m-2" id="lastQueueNumber">{!! $queue->number ?? 'N/A' !!}</h1>
                </div>
              </div>
            </div>
          </div>
          <hr class="my-5"/>
          <h4 class="mb-4 text-center">Buat Antrian</h4>
          <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="card shadow-sm">
              <button type="button" class="w-100 btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#createSKCK">Pembuatakan SKCK
              </button>
            </div>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="card shadow-sm">
              <button type="button" class="w-100 btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#createSKCK">Pembuatakan SKCK
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="createSKCK" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div id="wizard-validation" class="bs-stepper mt-2">
        <div class="modal-body">
          <div class="bs-stepper-header">
            <div class="step" data-target="#account-details-validation">
              <button type="button" class="step-trigger">
                <span class="bs-stepper-circle">1</span>
                <span class="bs-stepper-label mt-1">
                  <span class="bs-stepper-title">Cek Perlengkapan</span>
                  <span class="bs-stepper-subtitle">Persaratan SKCK</span>
                </span>
              </button>
            </div>
            <div class="line">
              <i class="ti ti-chevron-right"></i>
            </div>
            <div class="step" data-target="#personal-info-validation">
              <button type="button" class="step-trigger">
                <span class="bs-stepper-circle">2</span>
                <span class="bs-stepper-label">
                  <span class="bs-stepper-title">Pengisian Keperluan</span>
                  <span class="bs-stepper-subtitle">Keperluan pembuatan SKCK</span>
                </span>
              </button>
            </div>
          </div>
          <form id="wizard-validation-form" onSubmit="return false">
            @csrf
            <!-- Account Details -->
            <div id="account-details-validation" class="content">
              <div class="content-header mb-3">
                <h6 class="mb-0">Cek Perlengkapan</h6>
                <small>Cek perlengkapan yang sudah dibawa</small>
              </div>
              <div class="row g-3">
                <div class="col-12">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="passFoto" name="passFoto"/>
                    <label class="form-check-label" for="passFoto">passFoto 4x6 (2 Lembar)</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="fcKTP" name="fcKTP"/>
                    <label class="form-check-label" for="fcKTP">Foto Copy KTP</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="fcKK" name="fcKK"/>
                    <label class="form-check-label" for="fcKK">Foto Copy KK</label>
                  </div>
                </div>
                <div class="col-12 d-flex justify-content-between">
                  <button class="btn btn-label-secondary btn-prev" disabled>
                    <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                  </button>
                  <button class="btn btn-primary btn-next">
                    <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                    <i class="ti ti-arrow-right"></i>
                  </button>
                </div>
              </div>
            </div>
            <!-- Personal Info -->
            <div id="personal-info-validation" class="content">
              <div class="content-header mb-3">
                <h6 class="mb-0">Cek Perlengkapan</h6>
                <small>Mohon isi keperluan pembuatn SKCK.</small>
              </div>
              <div class="row g-3">
                <div class="col-12">
                  <label class="form-label" for="keperluan">Keperluan</label>
                  <input type="text" id="keperluan" name="keperluan" class="form-control" placeholder="Pendaftaran CPNS Kemenkumham 2018"/>
                </div>
                <div class="col-12 d-flex justify-content-between">
                  <button class="btn btn-label-secondary btn-prev">
                    <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                  </button>
                  <button class="btn btn-success btn-next btn-submit">Submit</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
<!-- Core JS -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/app-queue.js') }}"></script>
<script src="{{ asset('assets/js/form-add-queue.js') }}"></script>
</html>
