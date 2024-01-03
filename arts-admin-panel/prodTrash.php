<?php
include('admin/includes/header.php');
include('admin/includes/sidebar.php');
include('admin/includes/topbar.php');
require('config.php');


?>


    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <h2 id="" >Trash Products</h2>
                <hr>
 
            <table id="trashTables" class="table table-striped" style="width:100%" >
                <thead id="trashtableHead" class="bg-warning p-2 text-dark bg-opacity-10" style="opacity: 75%;">
                <tr>
            <th scope="col">#</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Warrenty</th>
            <th scope="col">Image</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>


                </thead>
                <tbody id="trashcatTableBody">
 
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