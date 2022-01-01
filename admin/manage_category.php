<?php
require('top_inc.php');
$categories = '';
$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "SELECT * FROM CATEGORIES WHERE id='$id'");

    // if the num will be greater than 0 then only the data will change 1:07:18 lec-1()progeming with vishal
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $categories = $row['categories'];
    } else {
        header('location:categories.php');
        die();
    }
}
if (isset($_POST['submit'])) {
    $categories = get_safe_value($con, $_POST['categories']);
    $res = mysqli_query($con, "SELECT * FROM CATEGORIES WHERE categories='$categories'");
    $check = mysqli_num_rows($res);
    //this is for not to duplicate data 
    if ($check > 0) {

        //this condition is for such that if the admin  press edit and then submit eith same dat for the 
        //same id than it will not show error 
        if (isset($_GET['id']) && $_GET['id'] != '') {
                $getdata=mysqli_fetch_assoc($res);
                if($id==$getdata['id'])
                {

                }
                else{
                    $msg = 'Category already exist!!!';
                }

        }
        else{
             $msg = 'Category already exist!!!';
        }
       
    } 
    if($msg=='')
    {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $sql = "UPDATE categories SET categories='$categories' WHERE id='$id'  ";
        } else {
            $sql = "INSERT INTO categories(categories,status) values('$categories','1') ";
        }

        mysqli_query($con, $sql);
        header('location:categories.php');
    }
}


?>

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Category</strong><small> Form</small></div>
                    <form action="" method="POST">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="categories" class=" form-control-label">Category</label>
                                <input type="text" id="category_id" placeholder="Enter your category name" class="form-control" name="categories" required value=<?php echo $categories ?>>
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