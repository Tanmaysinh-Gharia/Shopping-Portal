<?php
session_start();
require '../connection.php';
require 'admin_header.php';
require '../func/funcstions.php';
if (!isset($_SESSION['email'])) {
    exit; 
}
$currentPage = basename($_SERVER['PHP_SELF']);
check_notifications();
if(!isset($_SESSION['apr']) || isset($_POST['apr']))
$_SESSION['apr']= $_POST['apr'];

$selected_val  = $_SESSION['apr'];
$type_o_user= $_SESSION['types'][$selected_val];
$view_apr_qry = "SELECT * FROM users WHERE type=$selected_val and status=0;";
$res_view = mysqli_query($con,$view_apr_qry);
$numb_apr = mysqli_num_rows($res_view); 

function disp_apr($res_view)
    {
        $i = 1;
        while ($row = mysqli_fetch_assoc($res_view) ) {
            $uid = $row['id'];
            $name =$row ['name'];
            $contact = $row['contact'];
            $email = $row['email'];
            $city = $row['city'];
            $state = $row['state'];
            $pin = $row['pincode'];
            $type = $_SESSION['types'][$_POST["apr"]];
            echo "<tr>";
            echo "<th>$i</th>";
            echo "<td>Name: <b>$name </b><br>
                      User_ID: <b>$uid</b><br>  
                      Type: <b>$type</b><br>  
                      E-mail: <b>$email</b><br>  
                      Contact: <b>$contact</b>
                    </td>";
            echo "<td>State: <b>$state </b><br>
                      District: <b>$city</b><br>  
                      Pin-code: <b>$pin</b><br>
                    </td>";
            echo "<td>
                    <button style='padding:20px;font-size:20px;' type='submit' class='btn btn-success' name='btn' value='$uid a' >Approve</button>
                    <button style='padding:20px;font-size:20px;item-align:right;margin-right:-150px;' type='submit'  class='btn btn-danger' name='btn' value='$uid d'>Discard</button>
                    </td>";
            echo "</tr>";
        }
    }
?>
<!DOCTYPE html>
<html>

<body>
    <form style="width: 100%;" method='post' action='admin_approvals_action.php'>
    <div class="container">
        <h3>
            <?php echo $type_o_user;?> Approvals...<span class="badge badge-light"><?php echo $numb_apr;?></span>
        </h3>

        <br><br>
        <table class="table" style="font-size: 20px;" id="disp_apr">
            <thead class="thead-light">
                <tr>
                    <th scope='col 1'>#</th>
                    <th scope="col 6">Identification</th>
                    <th scope="col 4">Address</th>
                    <th scope="col 2">Approval</th>
                </tr>
            </thead>
            <tbody id='disp_apr_body'>
                <?php disp_apr($res_view); ?>
            </tbody>
        </table>
    </div>
</form>





</body>

</html>

<?php
    
?>
