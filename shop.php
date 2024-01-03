<?php
include("includes/header.php");
require("arts-admin-panel/config.php");

?> 

        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Shop</h1>

        </div>
        <!-- Single Page Header End -->


        <!-- Fruits Shop Start-->
        <div class="container-fluid fruite py-5">
            <div class="container py-5">
                <h1 class="mb-4">Arts The Stationary Shop</h1>
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-4">
                            <div class="col-lg-3">
                                <div class="input-group w-100 mx-auto d-flex">
                                    <input type="search" id="searchInput" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                             <div class="col-6 check-div"></div>
                                   <!-- Category Dropdown -->

                           <div class="col-xl-3">
                                <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                    <label for="fruits">Select Category:</label>
                                    <select id="category" name="fruitlist" class="border-0 form-select-sm bg-light me-3" form="fruitform">
                                        <option selected value="All">All</option>
                                        <?php
                                        $fetchCat = $conn->prepare("SELECT * FROM `category`;");
                                        $fetchCat->execute();
                                        $catResult = $fetchCat->get_result();
                                        while($catData = $catResult->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $catData['cid'];?>"><?php echo $catData['cname'];?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="container pb-5 text-center">
                        <h1 class="text-primary">Our Products</h1>
                    </div>
                        <div class="row g-4">
                    <div class="col-lg-12">
                        <div id="product-conductor" class="row g-4">
                        
                        </div>
                    </div>
                </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fruits Shop End-->
<?php
include("includes/footer.php");
?>