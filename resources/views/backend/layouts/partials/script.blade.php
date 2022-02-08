 <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin-asset/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin-asset/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('admin-asset/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-asset/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin-asset/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Select2 JS -->
    <script src="{{ asset('admin-asset/js/select2.min.js') }}"></script>

    <!-- Summernote JS -->
    <script src="{{ asset('admin-asset/js/summernote.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin-asset/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('admin-asset/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('admin-asset/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('admin-asset/js/demo/chart-pie-demo.js') }}"></script>

    <script>
        $(document).ready( function () {
            $('#dataTable').DataTable();
            $('.select2').select2();
            $('#summernote').summernote();
        } );
    </script>