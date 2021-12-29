<!-- we make this becuse we can add some 
common function as a global function ehich
 we can include in our files -->

<!-- The <prev> tag doesn't exist, but it's probably the <pre> HTML tag to put around debug output, to improve readability. It's not a secret PHP hack. :) -->
<?php

function prx($arr)
{
    echo '<pre>';
    print_r($arr);
}
function pr($arr)
{
    echo '<pre>';
    print_r($arr);
    die();
}

function get_safe_value($con, $str)
{
    if ($str !='') {

        return mysqli_real_escape_string($con,$str);
    }
}


?>
<!-- The die() is an inbuilt function in PHP. It is used to print message and exit from the current php script. It is equivalent to exit() function in PHP. -->