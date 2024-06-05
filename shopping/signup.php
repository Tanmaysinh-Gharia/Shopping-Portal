<script src="pincode/pincode_fetch.js"></script>
<?php
    session_start();
    require 'connection.php';
    require "pincode/pincode_fetch.php";
    require 'func/funcstions.php';
    if(isset($_SESSION['email'])){
        header('location: products.php');
    }
    $regex_email="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
    
    //Notification on error or Update
    check_notifications();
?>

<!DOCTYPE html>
<html>
    
<script>
//Associative list functions
function update_cities()
{
    const selected_state = document.getElementById('state').value;
    const city_elem =document.getElementById('city');
    city_elem.innerHTML=  '<option value="" selected disabled hidden>Select City</option>';
    let cities = st_ct_pin[selected_state];
    
    for(const city in cities){
        const option = document.createElement('option');
        option.value = city;
        option.textContent = city;
        city_elem.appendChild(option);
    }
}
function update_pins()
{
    const selected_state = document.getElementById('state').value;
    const selected_city =document.getElementById('city').value;
    const pin_elem = document.getElementById('pins');
    pin_elem.innerHTML=  '<option value="" selected disabled hidden>Select Pin-code</option>';
    let pins = st_ct_pin[selected_state][selected_city];
    
    for(const pin in pins){
        const option = document.createElement('option');
        option.value = pins[pin];
        option.textContent = pins[pin];
        pin_elem.appendChild(option);
    }
}
</script>


<head>
    <title>Smart Selects</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- latest compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- jquery library -->
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <!-- Latest compiled and minified javascript -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <!-- External CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <script src='func/functions.js' type="text/javascript"> </script>
    <script type= "text/javascript" src="func/functions.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>
    
</head>

<body>
    <div>
        
        <?php
        //Importing Header
            require 'header.php';
        ?>
        <br><br>
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3>Sign Up</h3>
                        </div>
                        <div class="panel-body">
                            <p style="font-size: 25px;">Creating An account.</p>
                            <form method="post" action="sign_up_submit.php">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input required type="email" class="form-control" name="email" id="email"
                                        placeholder="Email"
                                        pattern="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/">
                                </div>
                                <div class="form-group">
                                    <label for="name">Username</label>
                                    <input required type="name" class="form-control" name="name" id="name"
                                        placeholder="Name"
                                        pattern="/^[a-Z][a-Z ]*{1,}$/">
                                </div>
                                <div class="form-group">
                                    <label for="pass">Password</label>
                                    <input required id="pass" type="password" class="form-control" name="pass"
                                        placeholder="Password(min. 6 characters)" pattern=".{6,}">
                                </div>
                                <div class="form-group">
                                    <label for="contact"> Contact Number</label><br>
                                    <input class="form-control" value="+91" readonly><br>
                                    <input  required type="tel" id="contact"
                                        class="form-control" name="contact" placeholder="Contact" pattern="[0-9]{10,}">
                                </div>
                                <div class="form-group">
                                    <label for="contact"> Country </label>
                                    <input readonly type="text" class="form-control" placeholder="INDIA">
                                </div>
                                <div class="form-group">
                                    <label for="state"> State </label>
                                    <select class="form-control form-select form-select-lg mb-3" id="state"
                                        aria-label=".form-select-lg example" required name='state'
                                        onchange='update_cities()'>
                                        <option value="" selected disabled hidden>Select state</option>
                                        <?php echo state_options($st_ct_pin);?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="city"> City </label>
                                    <select class="form-control form-select form-select-lg mb-3" id="city"
                                        aria-label=".form-select-lg example" required name='city'
                                        onchange='update_pins()'>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pins"> Pin-code </label>
                                    <select class="form-control form-select form-select-lg mb-3" id="pins"
                                        aria-label=".form-select-lg example" required name='pins'>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="address"> Street Address </label>
                                    <input class="form-control" id="address" required 
                                    name='address'>
                                </div>
                                <div class="form-group">
                                    <label for="tou"> Type of User </label>
                                    <select class="form-control form-select form-select-lg mb-3" id="tou"
                                        aria-label=".form-select-lg example" required name='type_o_user'>
                                        <option value="1" selected>Customer</option>
                                        <option value="2">Vendor</option>
                                        <option value="3">Shipping Manager</option>
                                        <option value="4">Delivery Agent</option>
                                    </select>
                                </div>

                                <div class="col-xs-6 form-group">
                                    <label for="captcha">Captcha</label>
                                    <input required id="captcha" type="text" class="form-control" name="captcha_code"
                                        placeholder="All alphabets are in uppercase" pattern=".{6,}"
                                        style="text-transform:uppercase;">

                                    <?php if (isset($_SESSION["captcha_inv"]) and $_SESSION["captcha_inv"]) :?>
                                    <a style="font-size: 14px; color:red">* Invalid Captcha.</a>
                                    <?php else:?>
                                    <a style="font-size: 14px; color:red">* All alphabets are in uppercase.</a>
                                    <?php endif; ?>

                                </div>

                                <div class="col-xs-6 form-group">
                                    <label>Captcha Code</label><br>
                                    <!--Captcha Generation method:1 Generated with php randome number but we can see through it by inspact mode even if we set select-use:none.. -->
                                    <!-- <div class="captcha" style="-webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select:none; width: 50%; background: yellow; text-align: center; font-size: 24px; font-weight: 700;"><s><?php //echo $rand; ?></s></div>   -->
                                    <img src="captcha/captcha_gen.php" width="50%">
                                    <!-- <a style="font-size: 14px; color:red"><?php //echo $_SESSION["captcha_code"]; ?> </a> -->
                                </div>
                                <div class="col-xs-6 form-group">
                                    <div class="form-check">
                                        <input required class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            I agree to Terms & conditions.
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <input type="submit" style="font-size:20px;" value="Register"
                                        class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br><br><br>
        <footer class="footer">
            <div class="container">
                <center>
                    <p>&copy; 2024 Smart Selects. All Rights Reserved.</p>
                    <p>This website is developed Vaibhav, Kirtan, Tanmay.</p>
                </center>
            </div>
        </footer>

    </div>
</body>

</html>