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
  <title>Dashboard System Antrian</title>
  
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
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}"/>
  
  <!-- Helpers -->
  <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
  <script src="{{ asset('assets/js/config.js') }}"></script>
</head>
<body>
<div class="layout-wrapper">
  <div class="layout-container">
    <div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('/queues') }}">Queues</a> /</span> No.Antrian {!! $queue->number !!}</h4>
        <div class="row">
          <!-- FormValidation -->
          <div class="col-12">
            <div class="card">
              <h5 class="card-header">Form SKCK</h5>
              <div class="card-body">
                <form id="formValidationExamples" action="{{ route('queues.update',$queue->id) }}" class="row g-3" method="POST">
                  @csrf
                  @method('PUT')
                  <!-- Account Details -->
                  <div class="col-12">
                    <h6>1. Account Details</h6>
                    <hr class="mt-0"/>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label" for="formValidationKeperluan">Keperluan</label>
                    <input class="form-control" type="text" id="formValidationKeperluan" name="formValidationKeperluan" value="{{ $queue->request }}" readonly/>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label" for="formValidationName">Nama Lengkap</label>
                    <input type="text" id="formValidationName" class="form-control" placeholder="John Doe" name="formValidationName"/>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label" for="formValidationAlamat">Alamat</label>
                    <input class="form-control" type="email" id="formValidationAlamat" name="formValidationAlamat" placeholder="john.doe"/>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label" for="formValidationEmail">DLL</label>
                    </div>
                  <div class="col-12">
                    <button type="submit" name="submitButton" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- /FormValidation -->
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
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/app-queues-show.js') }}"></script>
</html>
