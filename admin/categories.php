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
        
        $udate_status_sql = "UPDATE CATEGORIES SET STATUS='$status' WHERE id='$id' ";
        mysqli_query($con, $udate_status_sql);
    }

    //this is for deletion of the categories

    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "DELETE FROM CATEGORIES  WHERE id='$id' ";
        mysqli_query($con, $delete_sql);
    }
}
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="catg_title">Categories </h4>
                        <div class="add_catg_btn btn btn-primary "><a href="manage_category.php">Add category</a> </div>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Delete</th>
                                        <th>Edit</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                        <tr class="tabel_row">
                                            <td class="serial"><?php echo $i++ ?></td>

                                            <td> <?php echo $row['id'] ?> </td>
                                            <td> <?php echo $row['categories'] ?> </td>
                                            <td> <?php $row['status'] ?>

                                                <?php
                                                if ($row['status'] == 1) {
                                                    //this how we are going to toggle the status in the database
                                                    echo "<div class='curd_btn_main badge  badge-primary'>
                                                    <a class='active_btn curd_btn' href='?type=status&operation=deactive&id=" . $row['id'] . "'>Active
                                                    </a>
                                                    </div>";
                                                } else {
                                                    echo "<div class='curd_btn_main badge  badge-secondary'><a class='deactive_btn curd_btn' href='?type=status&operation=active&id=" . $row['id'] . "'> Deactive</a>&nbsp;</div>";
                                                }

                                                ?>
                                            </td>
                                            <td> 
                                                <?php
                                                echo "<div class='curd_btn_main badge  badge-danger'><a class='delete_btn curd_btn' href='?type=delete&id=" . $row['id'] . "'>Delete</a>&nbsp;</div>";
                                                ?>

                                            </td>
                                            <td>
                                                <?php
                                                echo "<div class='curd_btn_main badge  badge-warning'><a class='edit_btn ' href='manage_category.php?type=edit&id=" . $row['id'] . "'>Edit</a>&nbsp;</div>";
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