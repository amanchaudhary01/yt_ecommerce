<?php
include('top_inc.php');
$sql = "SELECT * FROM CATEGORIES ORDER BY id asc  ";
$res = mysqli_query($con, $sql);
//PHP $_GET is a PHP super global variable which is used to collect form data after
// submitting an HTML form with method="get".

//$_GET can also collect data sent in the URL.


//imp! this script will help bkc.com in adding and removing the book from like dislike 
//save etc the logic behind these will look same as it is
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);
    if ($type == 'status') {
        $operation = get_safe_value($con, $_GET['operation']);
        $id = get_safe_value($con, $_GET['id']);
        if ($operation == 'active') {
            $status = '1';
        } else {
            $status = '0';
        }
        $udate_status_sql = "UPDATE product SET STATUS='$status' WHERE id='$id' ";
        mysqli_query($con, $udate_status_sql);
    }

    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "DELETE FROM product  WHERE id='$id' ";
        mysqli_query($con, $delete_sql);
    }
}
$sql = "SELECT  product.*,categories.categories from product,categories where product.categories_id=categories.id ORDER BY product.id DESC";
$res = mysqli_query($con, $sql);
?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="catg_title">Product </h4>
                        <div class="add_btn btn btn-primary "><a class="add_btn_a" href="manage_product.php">Add Product</a> </div>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>Image</th>
                                        <th>ID</th>
                                        <th>Categories</th>
                                        <th>Name</th>

                                        <th>MRP</th>    
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                        <tr class="tabel_row">
                                            <td class="serial"><?php echo $i++ ?></td>
                                            <!-- //this  PRODUCT_SITE_SERVER_PATH is a defined path define in connection.php as we can make another filefor these purpose -->
                                            <td> <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'] ?>" alt=""></td>
                                            <td> <?php echo $row['id'] ?> </td>
                                            <td> <?php echo $row['categories'] ?> </td>  
                                            <td> <?php echo $row['name'] ?></td>

                                            <td> <?php echo $row['mrp'] ?></td>
                                            <td> <?php echo $row['price'] ?></td>
                                            <td> <?php echo $row['qty'] ?> </td>
                                            <td>
                                                <?php
                                                if ($row['status'] == 1) {
                                                    //this how we are going to toggle the status in the database
                                                    echo "<div class='curd_btn_main badge  badge-primary'>
                                                    <a class='active_btn curd_btn' href='?type=status&operation=deactive&id=" . $row['id'] . "'>Active
                                                    </a>
                                                    </div>";
                                                } 
                                                else {
                                                    echo "<div class='curd_btn_main badge  badge-secondary'><a class='deactive_btn curd_btn' href='?type=status&operation=active&id=" . $row['id'] . "'> Deactive</a>&nbsp;</div>";
                                                }

                                                ?>


                                                <?php
                                                echo "<div class='curd_btn_main badge  badge-danger'><a class='delete_btn curd_btn' href='?type=delete&id=" . $row['id'] . "'>Delete</a>&nbsp;</div>";
                                                ?>


                                                <?php
                                                echo "<div class='curd_btn_main badge  badge-warning'><a class='edit_btn ' href='manage_product.php?type=edit&id=" . $row['id'] . "'>Edit</a>&nbsp;</div>";
                                                ?>

                                            </td>
                                        </tr>




                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php
        include('footer_inc.php')
        ?>