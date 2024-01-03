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
    #prodTables{
        display: none;
    }
</style>
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">
            <h2 id="mainHeading">All Categoriess</h2>
            <hr>

            <table id="catTables" class="table table-striped" style="width:100%">
                <thead id="" class="bg-warning p-2 text-dark bg-opacity-10" style="opacity: 75%;">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category</th>
                        <th scope="col">Status</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody id="catTableBody">

                </tbody>
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