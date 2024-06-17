<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        switch ($_POST["opt"]) {
            case 2:
                header("location: vendor_add_item.php");
                break;
            case 3:
                header("location: vendor_del_item.php");
                break;
            case 4:
                header("location: vendor_upd_stk.php");
                break;
            case 5:
                header("location: vendor_show.php");
                break;
            case 6:
                header("location: vendor_mod_item.php");
                break;
            case 7:
                header("location: vendor_accept.php");
                break;
            case 8:
                header("location: vendor_dispatch.php");
                break;
            case 9:
                header("location: vendor_damaged.php");
                break;
            default:    
                header("location: vendor_dashboard.php");
                break;
        }
    }
?>