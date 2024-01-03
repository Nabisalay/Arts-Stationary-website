<?php
include('admin/includes/header.php');
include('admin/includes/sidebar.php');
include('admin/includes/topbar.php');
include('config.php');



if(isset($_POST['addProduct'])) {
$category = strtolower($_POST['category']);
$stmt = $conn->prepare('SELECT * FROM `category` WHERE cname = ?');
if($stmt) {
    $stmt->bind_param('s', $category);
    if($stmt->execute()) {
        $stmt->store_result();
        // this is to add a new category in the table 
        if($stmt->num_rows > 0) {
            $stmt->bind_result($cCode, $cName, $isActive);
            $stmt->fetch();
        }else {
            $getCId = $conn->query('SELECT MAX(cid) FROM `category`');
            $maxCId = $getCId->fetch_assoc()['MAX(cid)'];
            $nextCId = str_pad($maxCId + 1, 2, '0', STR_PAD_LEFT);
            $insertCat = $conn->prepare('INSERT INTO `category` (cid, cname) Values (?, ?)');
            if($insertCat) {
                $insertCat->bind_param('ss', $nextCId, $category);
                $insertCat->execute();
                $insertCat->close();
            }else {
                echo "<script> alert ('Error adding category. Try again.'); </script>";
            }
        }
            $pDescription = $_POST['Description'];
            $pPrice = $_POST['Price'];
            $pWarranty = $_POST['Warranty'];
            $WarrantyType = $_POST['WarrantyType'];
            $warrantyDur = ($pWarranty == 0) ? 'no warrenty' : $pWarranty .' '. $WarrantyType;
            $pImage = $_FILES['image']['name'];
            $pimgTemName = $_FILES['image']['tmp_name'];
            $imgSize = $_FILES['image']['size'];
            move_uploaded_file($pimgTemName , 'images/'.$pImage);
            // Generate a unique product number (5 digits)
            $prodCode = $cCode ?? $nextCId;
            $getPid = $conn->query("SELECT MAX(prodNumb) FROM `products` WHERE prodCode = '$prodCode';");
            $maxPId = $getPid->fetch_assoc()['MAX(prodNumb)'];
            $nextPId = str_pad($maxPId + 1, 5, '0', STR_PAD_LEFT);
            $prodID = $prodCode . $nextPId;
            $insertProd = $conn->prepare("INSERT INTO `products` (
                `description`, `price`, `warranty`, `prodImg`, `prodNumb`,
                 `prodCode`, `prodID`) VALUES (?, ?, ?, ?, ?, ?, ?);");
            if($insertProd) {
                $insertProd->bind_param('sisssss', $pDescription, $pPrice, $warrantyDur, $pImage, $nextPId,
                $prodCode, $prodID);
                if($insertProd->execute()) {
                    echo "<script> alert ('product has been inserted successfully'); </script>";
                }else {
                    echo "<script> alert ('sorry could not insert the product'); </script>";
                }
            }else {
                echo "<script> alert ('could not prepare the statement for products'); </script>";
            }
        }else {
            echo "<script> alert ('sorry failed to execute the prepare statement'); </script>";
        }
}else {
    echo "<script> alert ('could not prepare the statement for category'); </script>";
}
}



?>


    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <h2>Add Category</h2>
                <hr>
        <form class="user" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="">Category</label>
                    <input type="text" class="form-control form-control-user" id="exampleFirstName"
                        placeholder="Enter Category" name="category" required>
                </div>
                <div class="col-sm-6">
                <label for="">Product Description</label>
                    <input type="text" class="form-control form-control-user" id="exampleLastName"
                        placeholder="Enter Product Description" name="Description" required>
                 </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="">Price</label>
                    <input type="text" class="form-control form-control-user" id="exampleFirstName"
                        placeholder="Enter Price" name="Price" required>
                </div>
                <div class="col-sm-6">
                <label for="">Warranty</label>
                    <input type="text" class="form-control form-control-user" id="exampleLastName"
                        placeholder="Enter Warranty" name="Warranty" required>
                        
                 </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="">Warranty Duration</label>
                    <select class="form-select" aria-label="Default select example"
                     name="WarrantyType" required>
                        <option selected disabled value="">Select Time Period</option>
                        <option value="Day">Day</option>
                        <option value="Month">Month</option>
                        <option value="Year">Year</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="">Add Image</label>
                    <input type="file" class="" id="imageFIle"
                        placeholder="" name="image" required>
                </div>
                <div  class="col-sm-6">
                <label id="Imglab" for="">Image</label>
                <div class="" >
                    <img id='selectedImg' src="" alt="" height='70px' width='70px'>
                </div>
            </div>
            </div>
            <!-- <a class="btn btn-primary btn-user btn-block" name="register">
                Register Account
            </a> -->
            <input type="submit" class="btn btn-primary btn-user btn-block" name="addProduct" >                                
        </form>

            </div>

        </div>

    </div>

    <script>
    // this code is use to hide and show image when uplaoding data to database 
    let imgFile = document.getElementById('imageFIle');
    let img = document.getElementById('selectedImg');
    let imglab = document.getElementById('Imglab');
    if(!img.src == ''){
        img.style.display = 'none';
        imglab.style.display = 'none';
    
    }else {
        img.style.display = 'block';
        imglab.style.display = 'block';
    }
    // console.log(imgFile.files[0]);
    imgFile.onchange = () => {
      const selectedFile = imgFile.files[0];
      console.log(selectedFile)
      if(selectedFile) {
        img.src = ''
        img.src = `images/${selectedFile['name']}`;
        img.style.display = 'block';
      }
      
    }



</script>
</body>

</html>










<?php
include('admin/includes/footer.php');


?>
