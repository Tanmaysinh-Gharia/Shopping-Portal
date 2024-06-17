<?php
session_start();
require '../connection.php';
require 'ship_man_header.php';
require '../func/funcstions.php';
if (!isset($_SESSION['email'])) {
    exit; 
}
$sm_id = $_SESSION['id'];
$currentPage = basename($_SERVER['PHP_SELF']);
check_notifications();

$lots_map = [];

function disp_assigns($con,$lots_map)
{
    //Decrement in Slot
    // function assignment($con,$lots_map,$pin,$del)
    // {
    //     $todays_date = date('Y-m-d');
        
    // }

    $i = 1;
    $sm_id = $_SESSION['id'];

    $qry_sel_order = "SELECT oi.item_id,o.order_id,u.pincode
                        FROM order_items oi
                        INNER JOIN orders o ON oi.order_id=o.order_id 
                        INNER JOIN users u ON u.id = o.user_id
                        LEFT JOIN sm_to_del_entry sd ON oi.order_id = sd.order_id AND oi.item_id = sd.item_id AND DATE(sd.DandT) = CURRENT_DATE
                        WHERE (oi.status = 5 OR oi.status=6) and o.sm_id = $sm_id and sd.order_id IS NULL;";

    $res = mysqli_query($con, $qry_sel_order);
    
    //Pincode wise slot creation
    while ($row = mysqli_fetch_assoc($res)) {
        $pin = $row['pincode'];
        $order_id = $row['order_id'];
        $item_id = $row['item_id'];
        if (array_key_exists($pin,$lots_map)) 
            array_push($lots_map[$pin],[$order_id,$item_id]);
        else
            $lots_map[$pin] = [[$order_id,$item_id]]; 
    }

    //Display pincode wise slot
    foreach ($lots_map as $pincode => $order_ids) {
        $pincode_slot_size = count($order_ids);
        echo "<tr>
                <th>$i</th>   
                <td>$pincode</td>
                <td><button class=\"btn btn-link\" type=\"button\" data-toggle=\"collapse\" 
                    data-target=\"#$pincode\" aria-expanded=\"false\" aria-controls=\"$pincode\">
                    $pincode_slot_size &nbsp;
                    <span class=\"arrow\"> ▼</span>&nbsp&nbsp;     
                    </button>
                </td>
                <td><input type=\"number\" class=\"form-control\" name=\"$pincode\" placeholder=\"Enter Delivery Agent Id\"></td>
            </tr>";
        $i++;
        //Internal Tabels 
        $j = 1;
        echo "<tr class=\"collapse\" id=\"$pincode\" >
                <td colspan=\"4\">";
        echo "<table class=\"table\" style=\"font-size: 12px;\">
                <thead class=\"thead-light\">
                    <tr>
                        <th scope=\"col 2\">#</th>
                        <th scope=\"col 5\">Order ID</th>
                        <th scope=\"col 5\">Item ID</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($order_ids as $arr) {
            $order_id = $arr[0];
            $item_id = $arr[1];
                echo "<tr>";
            echo "<th>$j</th>";
            echo "<td>Order Id: <b>$order_id </b>   </td>";
            echo "<td>Item_ID: <b>$item_id</b>     </td>";
            echo "</tr>";
            $j++;
        }
        echo "</tbody>
            </table>";            
        echo "</td></tr>";
    }
    $_SESSION['lots_map'] = $lots_map;
}

function disp_delivery_agents($con)
{
    $agent_ass_map = [];
    $sm_id = $_SESSION['id'];
    $query = "SELECT pincode FROM users WHERE id = $sm_id";
    $res_sm_pin =mysqli_query($con,$query);
    $sm_pin_arr = mysqli_fetch_assoc($res_sm_pin);
    $sm_pin = $sm_pin_arr['pincode']; 
    $pin_start = substr($sm_pin,0,3);
    $qry_sel_all_agents = "SELECT id FROM users 
        WHERE type=4 AND CAST(pincode AS CHAR) LIKE '$pin_start%' ;";

    $res_all_agents = mysqli_query($con,$qry_sel_all_agents);   

    while ($row = mysqli_fetch_assoc($res_all_agents)) {
        $del_id = $row['id'];
        $qry_assd = "SELECT * FROM sm_to_del_entry WHERE DATE(DandT) = CURDATE() AND del_id=$del_id;";
        $res_assd = mysqli_query($con,$qry_assd);
        $count_assigned = mysqli_num_rows($res_assd);
        $give_cnt = (int)($count_assigned * 100 /14);
        $agent_ass_map[$del_id] = $count_assigned;
        
        echo "<div class='row'>";
        echo "<h3><b>Agent ID (<span onclick='copyText(this)' class='glyphicon glyphicon-copy'>):$del_id</span>";
        echo "</b></h3>";
        echo "</div>";
        echo "<div class='row'>";
        echo "<div class='progress'>
                <div class='progress-bar' role='progressbar' 
                aria-valuenow='$give_cnt' aria-valuemin='0' aria-valuemax='100' style='color:black; width: $give_cnt%;'><b style='margin-top:5px;'>$count_assigned/14</b></div>
                </div>";
        echo "</div>";
    }
    $_SESSION['agent_ass_map'] = $agent_ass_map;
}
?>
<script>

function copyText(element) {
    const textToCopy = element.textContent;
    console.log(textToCopy);

    // Create a temporary textarea element
    const tempTextarea = document.createElement('textarea');
    tempTextarea.value = textToCopy;
    document.body.appendChild(tempTextarea);

    // Select the text
    tempTextarea.select();
    tempTextarea.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text
    document.execCommand('copy');

    // Remove the temporary textarea element
    document.body.removeChild(tempTextarea);

    // Alert the user (optional)
    alert('Text copied to clipboard!');
}

$(document).ready(function() {
    $(".btn-link").click(function() {
        $(this).find(".arrow").toggleClass("rotated");
    });
});
</script>

<!DOCTYPE html>
<html>
<body>
    <a></a>

    <div class='row '>
        <div class="col-md-8" style="padding-left:30px;">
            <div class="container " style="width: 100%; padding-left:20px;">
                <form style="width: 100%;" method='post' action='sm_assign_action.php'>
                    <h2><u>Assign Orders to Delivery Agents </u></h2>
                    <h3>NOTE: <br> 1) No Notifications will be displayed for invalid id or empty field.
                        <br>2) For Correct Ids assignment will be done directly.
                        <br>3) Next Assignment can be done by next day.
                    </h3>
                    <br>
                    <h3 style="text-align: right;">
                        <button type="submit" class="btn-success" style="padding: 15px;" name='btn' value='assign'>Assignment</button>
                    </h3>
                    <table class="table" style="font-size: 20px;" id="disp_apr">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col 1">#</th>
                                <th scope="col 4">Pincode</th>
                                <th scope="col 5"> Number of Orders.</th>
                                <th scope="col 2">Agent ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php disp_assigns($con,$lots_map); ?>
                        </tbody>
                    </table>
                </form>
            </div>

        </div>
        <div class="col-md-4">
            <div class='container'>
                <?php disp_delivery_agents($con); ?>
            </div>
        </div>
    </div>




</body>

</html>