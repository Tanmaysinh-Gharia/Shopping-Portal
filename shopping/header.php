<nav class="navbar navbar-inverse navabar-fixed-top">
               <div style="padding-top:25px;padding-bottom:10px;margin-bottom:0px;">
                   <div class="navbar-header" >
                       
                       <a href="index.php" class="navbar-brand" 
                       style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;;color:azure;font-size: 25px;margin-left:10px;margin-top:-10px; display:flex;"  >
                       <img src="img/smart_selects.png" alt="logo" style="height:40px; width:40px;margin:-10px 30px 0 0; " > 
                       Smart Selects</a>
                   </div>
                   
                   <div class="collapse navbar-collapse" id="myNavbar">
                       <ul class="nav navbar-nav navbar-right">
                           <?php
                           if(isset($_SESSION['email'])){
                           ?>
                           <li><a href="cart.php" style="font-size: 18px;margin-top:-10px;"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                           <li><a href="settings.php" style="font-size: 18px;margin-top:-10px;"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                           <li><a href="orders.php" style="font-size: 18px;margin-top:-10px;"><span class="glyphicon glyphicon-inbox"></span> Orders</a></li>
                           <li><a href="logout.php" style="font-size: 18px;margin-top:-10px;"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                           <?php
                           }else{
                            ?>
                            <li><a href="signup.php" style="font-size: 18px;margin-top:-10px;"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                           <li><a href="login.php" style="font-size: 18px;margin-top:-10px;"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                           <?php
                           }
                           ?>
                       </ul>
                   </div>
               </div>
</nav>