<?php
require('top_inc.php');
$categories_id = '';
$name = '';
$mrp = '';
$price = '';
$qty = '';
$image = '';
$short_descp = '';
$descp = '';
$meta_title = '';
$meta_descp = '';
$meta_keyword = '';
$status = '';

$msg = '';

//this script is for such if a person change the id from the url and that id does not exist than it should redirect to the it manage page
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "SELECT * FROM PRODUCT WHERE id='$id'");

    // if the num will be greater than 0 then only the data will change 1:07:18 lec-1()progeming with vishal
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $name = $row['name'];
        $mrp = $row['mrp'];
        $price = $row['price'];
        $qty = $row['qty'];
        $image = $row['image'];
        $short_descp = $row['short_descp'];
        $descp = $row['descp'];
        $meta_title = $row['meta_title'];
        $meta_keyword = $row['meta_keyword'];
        $status = $row['status'];
     
    } else {
        header('location:product.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $categories_id = get_safe_value($con, $_POST['categories_id']);
    $name = get_safe_value($con, $_POST['name']);
    $mrp = get_safe_value($con, $_POST['mrp']);
    $price = get_safe_value($con, $_POST['price']);
    $qty = get_safe_value($con, $_POST['qty']);
    $image = get_safe_value($con, $_POST['image']);
    $short_descp = get_safe_value($con, $_POST['short_descp']);
    $descp = get_safe_value($con, $_POST['descp']);
    $meta_title = get_safe_value($con, $_POST['meta_title']);
    $meta_descp = get_safe_value($con, $_POST['meta_descp']);
    $meta_keyword = get_safe_value($con, $_POST['meta_keyword']);
    $status = get_safe_value($con, $_POST['status']);
    $res = mysqli_query($con, "SELECT * FROM PRODUCT WHERE name='$name'");
    $check = mysqli_num_rows($res);
    //this is for not to duplicate product 
    if ($check > 0) {

        //this condition is for such that if the admin  press edit and then submit eith same dat for the 
        //same id than it will not show error 
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getdata = mysqli_fetch_assoc($res);
            //if user click on edit and does not edit that product name than afer submiting
            // their will be no error other wise it will give an error
            if ($id == $getdata['id']) {
            } else {
                $msg = 'product already exist!!!';
            }
        } else {
            $msg = 'product already exist!!!';
        }
    }
    if ($msg == '') {

        if (isset($_GET['id']) && $_GET['id'] != '') {
            $sql = "UPDATE product SET categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',image='$image',short_descp='$short_descp',
            descp='$descp',meta_title='$meta_title',meta_descp='$meta_descp',meta_descp='$meta_descp',status='$status' WHERE id='$id'  ";
        } else {
            $sql = "INSERT INTO product(categories_id,name,mrp,price,qty,image,short_descp,descp,meta_title,meta_descp,meta_keyword,status) values
            ('$categories_id','$name','$mrp','$price','$qty','$image','$short_descp','$descp','$meta_title','$meta_descp','$meta_keyword','1') ";
        }

        mysqli_query($con, $sql);
        header('location:product.php');
    }
}


?>

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Product</strong><small> Form</small></div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="card-body card-block">
                            <div class="form-group" >
                                <label for="categories" class=" form-control-label">Category</label>
                                <select name="categories_id" id="" class=" form-control">

                                    <?php
                                    $res = mysqli_query($con, "SELECT id,categories FROM categories ORDER BY categories desc");
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        echo " <option value=" . $row['id'] . ">" . $row['categories'] . "</option> ";
                                    };

                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="categories" class=" form-control-label">Product Name</label>
                                <input type="text" id="name" placeholder="Enter your product name" class="form-control" name="name" required value=<?php echo $name ?>>
                            </div>
                            <div class="form-group">
                                <label for="mrp" class=" form-control-label">MRP</label>
                                <input type="text" id="mrp" placeholder="Enter your product's mrp" class="form-control" name="mrp" required value=<?php echo $mrp ?>>
                            </div>
                            <div class="form-group">
                                <label for="mrp" class=" form-control-label">Price</label>
                                <input type="text" id="price" placeholder="Enter your product's price" class="form-control" name="price" required value=<?php echo $price ?>>
                            </div>
                            <div class="form-group">
                                <label for="mrp" class=" form-control-label">Quantity</label>
                                <input type="text" id="qty" placeholder="Enter your product's quantity" class="form-control" name="qty" required value=<?php echo $qty ?>>
                            </div>
                            <div class="form-group">
                                <label for="mrp" class=" form-control-label">Image</label>
                                <input type="file" id="image" class="form-control" name="image" >
                            </div>
                            <div class="form-group">
                                <label for="mrp" class=" form-control-label">Short description</label>
                                <input type="text" id="short_descp" placeholder="Enter Short description" class="form-control" name="short_descp" required value=<?php echo $short_descp ?>>
                            </div>
                            <div class="form-group">
                                <label for="mrp" class=" form-control-label">Description</label>
                                <textarea type="text" id="descp" placeholder="Enter  description" class="form-control" name="descp" required><?php echo $descp ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="mrp" class=" form-control-label">Meta title</label>
                                <input type="text" id="meta_title" placeholder="Enter  meta title" class="form-control" name="meta_title" value=<?php echo $meta_title ?>>
                            </div>
                            <div class="form-group">
                                <label for="mrp" class=" form-control-label">Meta Description</label>
                                <input type="text" id="meta_descp" placeholder="Enter meta  description" class="form-control" name="meta_descp" value=<?php echo $meta_descp ?>>
                            </div>
                            <div class="form-group">
                                <label for="mrp" class=" form-control-label">Meta keyword</label>
                                <input type="text" id="meta_keyword" placeholder="Enter  meta keyword" class="form-control" name="meta_keyword" value=<?php echo $meta_keyword ?>>
                            </div>
                            <div class="form-group">
                                <label for="mrp" class=" form-control-label">Status</label>
                                <input type="text" id="status" placeholder="Enter status" class="form-control" name="status" required value=<?php echo $status ?>>
                            </div>

                            <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>
                            <div class="edit_in_error">
                                <?php echo $msg ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('footer_inc.php')
?>