</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
<div class="container my-auto">
  <div class="copyright text-center my-auto">
    <span>Copyright &copy; Murat Duman {{date('Y')}}</span>
  </div>
</div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="{{ asset('back/') }}/#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bir saniye?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Çıkmak istediğine emin misin?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Vazgeç</button>
          <a class="btn btn-primary" href="{{ route('admin.logout') }}">Çıkış</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Modal-->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bir saniye?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Bunu gerçekten silmek istiyor musun?</div>
        <div class="modal-footer">
          <input type="hidden" name="deleteId" id="deleteId" value="0">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Vazgeç</button>
          <button type="button" class="btn btn-danger" onclick="deletion_confirmation()">Sil</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('back/') }}/vendor/jquery/jquery.min.js"></script>
  <script src="{{ asset('back/') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('back/') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('back/') }}/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('back/') }}/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('back/') }}/js/demo/chart-area-demo.js"></script>
  <script src="{{ asset('back/') }}/js/demo/chart-pie-demo.js"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('back/') }}/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="{{ asset('back/') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('back/') }}/js/demo/datatables-demo.js"></script>
  <script src="{{ asset('back/') }}/js/demo/canvasjs.min.js"></script>
  @yield('js')
  @toastr_js
  @toastr_render
</body>

</html>
