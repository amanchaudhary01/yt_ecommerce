<?php
include('top_inc.php');
$sql = "SELECT * FROM CATEGORIES ORDER BY id asc  ";
$res = mysqli_query($con, $sql);
//PHP $_GET is a PHP super global variable which is used to collect form data after
// submitting an HTML form with method="get".

//$_GET can also collect data sent in the URL.


//imp! this script will help bkc.com in adding and removing the book from like dislike 
//save etc the logic behind these will look same as it is
if(isset($_GET['type'])&&$_GET['type']!='')
{
    $type=get_safe_value($con,$_GET['type']);
    if($type='status')
    { 
        $operation=get_safe_value($con,$_GET['operation']);
        $id=get_safe_value($con,$_GET['id']);
        if($operation=='active')
        {echo  '$status' ;
            $status='1';
        }
        else{
            $status='0';
        }
        $udate_status="UPDATE CATEGORIES SET STATUS='$status' WHERE id='$id' ";
        mysqli_query($con,$udate_status);

    }
}
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Orders </h4>
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

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                        <tr>
                                            <td class="serial"><?php echo $i++ ?></td>

                                            <td> <?php echo $row['id'] ?> </td>
                                            <td> <?php echo $row['categories'] ?> </td>
                                            <td> <?php $row['status'] ?>

                                                <?php
                                                if ($row['status'] == 1) {
                                                    //this how we are going to toggle the status in the database
                                                    echo "<a href='?type=status&operation=deactive&id=" . $row['id'] . "'>Active</a>";
                                                } else {
                                                    echo "<a href='?type=status&operation=active&id=" . $row['id'] . "'> Deactive</a>";
                                                } ?>
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