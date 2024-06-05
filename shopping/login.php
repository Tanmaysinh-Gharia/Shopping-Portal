<?php
    require 'connection.php';
    require 'func/funcstions.php';
    session_start();
    if (! isset($_SESSION["captcha_inv"]))
        $_SESSION["captcha_inv"] = false;
        // $_SESSION["captcha_inv"] = false;
    $_SESSION['types'] = [1=>"Customer",2=>"Vendor",3=>"Shipping Manager" , 4=>"Delivery Agent", 5=>"Admin"];
    check_notifications();
?>  
<!DOCTYPE html>
<html>

<head>
    <title>Smart Selects</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- latest compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- External CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
        require("header.php");
        ?>
    <div>
        <br><br><br>
        <div class="container">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3>LOGIN</h3>
                    </div>
                    <div class="panel-body">
                        <p style="font-size: 25px;">Login to make a purchase.</p>
                        <form method="post" action="login_submit.php">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input required type="email" class="form-control" name="email" id="email"
                                    placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input required id="passoword" type="password" class="form-control" name="password"
                                    placeholder="Password(min. 6 characters)" pattern=".{6,}">
                            </div>
                            <div class="col-xs-6 form-group">
                                <label for="captcha">Captcha</label>
                                <input required id="captcha" type="text" class="form-control" name="captcha_code"
                                    placeholder="All alphabets are in uppercase" pattern=".{6,}"
                                    style="text-transform:uppercase;">

                                <?php if ($_SESSION["captcha_inv"]) :?>
                                <a style="font-size: 14px; color:red">* Invalid Captcha.</a>
                                <?php else:?>
                                <a style="font-size: 14px; color:red">* All alphabets are in uppercase.</a>
                                <?php endif; ?>

                            </div>

                            <div class="col-xs-6 form-group">
                                <label>Captcha Code</label>
                                <!--Captcha Generation method:1 Generated with php randome number but we can see through it by inspact mode even if we set select-use:none.. -->
                                <!-- <div class="captcha" style="-webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select:none; width: 50%; background: yellow; text-align: center; font-size: 24px; font-weight: 700;"><s><?php echo $rand; ?></s></div>   -->
                                <img src="captcha/captcha_gen.php" width="50%">
                                <!-- <a style="font-size: 14px; color:red">
                                <?php echo $_SESSION["captcha_code"]; ?> </a> -->
                            </div>
                            <br>
                            <div class="form-group text-right">
                                <input type="submit" style="font-size:20px" value="Login" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer" style="font-size: 15px;">Don't have an account yet? <a
                            href="signup.php">Register</a></div>
                </div>
            </div>
        </div>
        <br><br><br><br><br>
        <footer class="footer">
            <div class="container">
                <div class="text-center">
                    <p>&copy; 2024 Smart Selects. All Rights Reserved.</p>
                    <p>This website is developed by Tanmay.</p>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>