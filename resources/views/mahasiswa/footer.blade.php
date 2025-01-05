<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl">
      <div
        class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column"
      >
        <div>
          ©
          <script>
            document.write(new Date().getFullYear());
          </script>
          {{-- , made with ❤️ by <a href="https://pixinvent.com" target="_blank" class="fw-semibold"></a> --}}
          , made with by <a href="#" target="_blank" class="fw-semibold">Jabar Saber Hoax</a>
        </div>
      </div>
    </div>
</footer>

</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>

<!-- Drag Target Area To SlideIn Menu On Small Screens -->
<div class="drag-target"></div>
</div>
<!-- / Layout wrapper -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{url('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{url('assets/vendor/libs/popper/popper.js')}}"></script>
<script src="{{url('assets/vendor/js/bootstrap.js')}}"></script>
<script src="{{url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{url('assets/vendor/libs/node-waves/node-waves.js')}}"></script>

<script src="{{url('assets/vendor/libs/hammer/hammer.js')}}"></script>
<script src="{{url('assets/vendor/libs/i18n/i18n.js')}}"></script>
<script src="{{url('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>

<script src="{{url('assets/vendor/js/menu.js')}}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{url('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{url('assets/vendor/libs/swiper/swiper.js')}}"></script>
<script src="{{url('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>

<!-- Main JS -->
<script src="{{url('assets/js/main.js')}}"></script>
<script src="{{url('js/content.js')}}"></script>
{{-- <script src="{{ asset('js/content.js') }}"></script> --}}
<!-- Page JS -->
<script src="{{url('assets/js/dashboards-analytics.js')}}"></script>
<script src="{{ asset('assets/js/form-wizard-numbered.js') }}"></script>
<script src="{{ asset('assets/js/form-wizard-validation.js') }}"></script>
@yield('page_script')
</body>
</html>
