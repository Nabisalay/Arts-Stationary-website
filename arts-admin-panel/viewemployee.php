<?php
include('admin/includes/header.php');
include('admin/includes/sidebar.php');
include('admin/includes/topbar.php');
require('config.php');


?>

<style>

</style>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <h2>Registerd Employees</h2>
                <hr>
            <table id="example" class="table table-striped" style="width:100%" >
                <thead id="employeehead" class="bg-warning p-2 text-dark bg-opacity-10" style="opacity: 75%;">

                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                    </tr>

                </thead>
                <tbody id="employeetable">
 
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