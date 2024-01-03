<?php
include('admin/includes/header.php');
include('admin/includes/sidebar.php');
include('admin/includes/topbar.php');
require('config.php');


?>

<style>
.form-check-input[type="radio"] {
  background-color: rgba(0, 0, 0, 0.3);
}
.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}
 </style>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <h2 id="mainHeading" >All Orders</h2>
                <hr>
                <div class="filter-btn">
                    <div class="form-check form-check-inline">
                        <input value="Order Details" class="form-check-input" type="radio" name="orderResult" id="filterResult1" >
                        <label class="form-check-label" for="filterResult1" >
                           Order Details
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input value="All Orders" class="form-check-input" type="radio" name="orderResult" id="filterResult2" checked>
                        <label class="form-check-label" for="filterResult2">
                            All Orders
                        </label>
                    </div>
                </div>

            <table id="orderTable" class="table table-striped" style="width:100%" >
                <thead id="orderHead" class="bg-warning p-2 text-dark bg-opacity-10" style="opacity: 75%;">



                </thead>
                <tbody id="orderBody">
 
                </tbody >
            </table>

            </div>

        </div>

    </div>


</body>
<script>


</script>
</html>










<?php
include('admin/includes/footer.php');


?>