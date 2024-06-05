<?php
session_start();


    
    if(isset($_POST["captcha_code"])){
        if($_POST["captcha_code"] === $_SESSION["captcha_code"]){
             $message ='<p class="text-success" id="msg">Message Submitted Successfully</p>';
        }
    }
    
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Captcha Generator</title>
        <meta name="description" content="captcha,captcha-generator">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <style>
         #cl{
            color:red;
            
         }
         #cl , a{
            text-decoration:none;
            margin:0 auto;
         }
         #show{
              margin:0 auto;
              font-weight:bold;
              text-align:center;
         }
         .text-success{
            margin:0 auto;
            text-align:center;
            margin:0.4rem 0;
            padding:0.3rem 0.2rem;
            font-size:1.9rem;
         }
         .text-danger{
            margin:0 auto;
            text-align:center;
            margin:0.4rem 0;
            padding:0.3rem 0.2rem;
            font-size:1.9rem;
         }
        </style>
    
    </head>
    <body style="background:#dfe6e9;">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <div class="container">
          <br/>
          <h3>Captcha Code Generation Using PHP</h3>
          <form class="form-horizontal" method="POST" action=" ">
           
            <table class="table table-bordered" style="width:40%;margin:0 auto;">
                <tr>
                 <td colspan="9" style="text-align:center;">CAPTCHA CODE GENERATOR</td>
                </tr>
                <div class="form-group">
                <tr>
                 <td colspan="2" style="width:10%;">
                    <p>Captch Code</p>   
                 </td>
                 <td colspan="3" style="width:10%;">
                  <img src="captcha_gen.php" />
                 </td>
                 <td colspan="3" style="width:10%;">
                 <input type="text" name="captcha_code" style="text-transform:uppercase;" class="form-control" autocomplete="off"/>
                 </td>
                </tr>
                 <tr>
                  <td colspan="11" style="text-align:center;"><a href="" id="cl">Click to refresh</a></td>
                 </tr>
                 <tr>
                  <td colspan="11" style="text-align:center;">
                  <input type="submit" name='submit' value="submit" id="st" class="btn btn-danger btn-block" />
                  </td>
                 </tr>
                </div>
            </table>    
          </form>
          <?php echo $message;?>  
          <p id="show" style="text-align:center;"><?php  if(isset($message)){
              echo $message;

              }session_unset();?></p>
            </div>
        <script>
          $(document).ready(function(){
               
            $("#st").on('click',function(){
                    $("#msg").css('display','block');
                });

                $("#cl").on('click',function(){
                    location.reload();
                });
          });
        </script>
    </body>
</html>