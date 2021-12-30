<?php
//The include (or require) statement takes all the text/code/markup that exists in the specified file and copies it into the file that uses the include statement.


require('connection_inc.php');
require('function_inc.php');
//i didn't this msg variable blank here so i was getting error whenever i open it as 
//ther was nothing to show in msg as now it is blank ..problem is solved
$msg='';

if (isset($_POST['submit'])) {

    //get_safe_value is a function made by myself and mysqli_real_scape_string()
    // is used in that function .So if we need to change something more we can 
    //change it from there 
    //imp!! use square brackets with the $_POST
    echo $password = get_safe_value($con, $_POST['password']);
    echo $username = get_safe_value($con, $_POST['username']);

    //Now executing the sql query to select the admin_user table

    //error!!!-->don't use 'admin_users',use `admin_users` that is this `` thing
    $sql="SELECT * FROM `admin_users` WHERE username='$username' AND password='$password'";
    $res=mysqli_query($con,$sql);
    //this is used to see if there is any data in the query
    $count=mysqli_num_rows($res);
    echo $count;
    if($count>0)
    {

       
        //A session is a way to store information (in variables) to be used across multiple pages.
        //Unlike a cookie, the information is not stored on the users computer.


        //these session is used at top_inc.php such that any now cannot goto cagtegories with 
        //just url http://localhost/yt_ecommerce/admin/categories.php  it will redirect to login page
        $_SESSION['ADMIN_LOGIN']="yes";
        $_SESSION['ADMIN_USERNAME']=$username;
        header('location:categories.php');
        //The die() is an inbuilt function in PHP. It is used to print message
        // and exit from the current php script. It is equivalent to exit() function in PHP.
        die();
    }
    else{
        $msg='please enter correct information!!!!';
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <title>Login 04</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="login-form-14/css/style.css">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Login #04</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url(login-form-14/images/bg-1.jpg);">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Sign In</h3>
                                </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                                    </p>
                                </div>
                            </div>
                            <form action="#" class="signin-form" method="POST">
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="form-control btn btn-primary rounded submit px-3" required>Sign In</button>
                                </div>
                                <!--  -->
                               
                                 <div class="sign_in_error">
                                <?php echo $msg ?>
                            </div>
                                
                               
                             
                                <!--  -->
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="w-50 text-md-right">
                                        <a href="#">Forgot Password</a>
                                    </div>
                                </div>
                            </form>
                            <p class="text-center">Not a member? <a data-toggle="tab" href="#signup">Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="login-form-14/js/jquery.min.js"></script>
    <script src="login-form-14/js/popper.js"></script>
    <script src="login-form-14/js/bootstrap.min.js"></script>
    <script src="login-form-14/js/main.js"></script>

</body>

</html>