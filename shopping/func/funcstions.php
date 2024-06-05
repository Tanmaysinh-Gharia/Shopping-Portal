<?php

function disp_errors($arr)
{
    $msg = implode("<br>",$arr);
    echo "<a style='color:red'>".$msg."</a>";
}
function disp_errors_as_alert($arr)
{
    $msg = implode("<br>",$arr);
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
function state_options($stctcode)
{
    $states = array_keys($stctcode);
    $str = "";
    foreach ($states as $state) {
        $str .= "<option value='$state'>$state</option>";
    }
    return $str;
}
function check_notifications()
{
    if (isset($_SESSION["notify"])){
        ?>
        <script>
            alert("<?php echo $_SESSION['notify']; ?>");
        </script>
        <?php
        unset($_SESSION['notify']);
    }
}
?>