<?php
switch ($_POST['opt']) {
    case '1':
        header("location: admin_rm.php");
        break;
    case '2':
        header("location: options/add_rm_vend.php");
        break;
    case '3':
        header("location: admin_approvals_rdr.php");
        break;
    case '4':
        header("location: options/admin_analysis.php");
        break;
    default:
        break;
}
?>