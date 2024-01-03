</div>
<?php
if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    echo "<script> window.location.href='../login.php'; </script>";
}
?>
<!-- End of Main Content -->
<!-- Footer -->

<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website <?php echo date("Y")?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" Method="POST">
            <input type="submit" name="logout" class="btn btn-success" value="Logout">
            </form>
        </div>
    </div>
</div>
</div>


<!-- update modal -->
<div class="modal fade" id="updatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div  class="modal-body">
        <!-- form for updating data  -->
        <form class="user">
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="hidden" id="eid" name="id" value="">
                <input type="text" id="upd-fname" class="form-control form-control-user" id="exampleFirstName"
                placeholder="First Name" name="FName" value="" required>
            </div>
            <div class="col-sm-6">
                <input type="text" id="upd-lname" class="form-control form-control-user" id="exampleLastName"
                placeholder="Last Name" name="LName" value="" required>
            </div>
        </div>
        <div class="form-group">
            <input type="email" id="upd-email" class="form-control form-control-user" id="exampleInputEmail"
            placeholder="Email Address" name="email" value="" required>
        </div>
        <input type="button" id="updEmployee" value="Update" class="btn btn-primary btn-user btn-block" name="updEmployee" >                                
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>
</div>
</div>


<!-- update modal for products-->
<div class="modal fade" id="updateProdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div id="background-color" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div  class="modal-body">
        <!-- form for updating product data  -->
        <form class="user" >
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="hidden" id="upid">
                    <input type="text" class="form-control form-control-user" id="updes"
                        placeholder="Enter Product Description" name="Description" required>
                 </div>
                 <div class="col-sm-6 ">
                    <input type="text" class="form-control form-control-user" id="upprice"
                        placeholder="Enter Price" name="Price" required>
                </div>
            </div>
            <div class="form-group row">

                    <input type="text" class="form-control form-control-user" id="upwarrenty"
                        placeholder="Enter Warranty" name="Warranty" required>
            </div>            

            <!-- <a class="btn btn-primary btn-user btn-block" name="register">
                Register Account
            </a> -->
            <input type="button" id="updProduct" class="btn btn-primary btn-user btn-block" value="Update" >                                
        </form>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>
</div>
</div>


<!-- update modal for Category-->
<div class="modal fade" id="updateCatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div id="background-color" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div  class="modal-body">
        <!-- form for updating product data  -->
        <form class="user" >

            <div class="form-group row">
                <input type="hidden" id="catid">
                    <input type="text" class="form-control form-control-user" id="catName"
                        placeholder="Enter Warranty" name="Warranty" required>
            </div>            

            <!-- <a class="btn btn-primary btn-user btn-block" name="register">
                Register Account
            </a> -->
            <input type="button" id="updCategory" class="btn btn-primary btn-user btn-block" value="Update" >                                
        </form>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>
</div>
</div>



<!-- jquery  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Bootstrap core JavaScript-->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- datatables links  -->
<script src= "https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<!-- Core plugin JavaScript-->
<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<script src="js/admin-panel.js"></script>
<!-- Page level plugins -->
<!-- Page level custom scripts -->
</body>
</html>