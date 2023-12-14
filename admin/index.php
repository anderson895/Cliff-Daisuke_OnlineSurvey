<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/csspa.css">
    
 
</head>
<body>

<div class='box'>
  <div class='box-form'>
    <div class='box-login-tab'></div>
    <div class='box-login-title'>
      <div class='i i-login'></div><h2>ADMIN LOGIN</h2>
    </div>
    <div class='box-login'>
      <div class='fieldset-body' id='login_form'>
       <form action="controllers/admincontrol" method="post" autocomplete="OFF">
        	<p class='field'>
          <label for='user'>E-MAIL</label>
          <input type='text' id='user' name='email' title='Email' required/>
          <span id='valida' class='i i-warning'></span>
        </p>
      	  <p class='field'>
          <label for='pass'>PASSWORD</label>
          <input type='password' id='pass' name='pass' title='Password' required/>
          <span id='valida' class='i i-close'></span>
        </p>
        <?php
        session_start();
        if(!isset($_SESSION['entry'])){
          $_SESSION['entry'] = '';
        }
        if($_SESSION['entry'] == 'email'){
          ?>
          <p class='field'>
          <label for='pass'>EMAIL NOT FOUND</label>
          <span id='valida' class='i i-close'></span>
        </p>
          <?php
          $_SESSION['entry'] = '';
        }else if($_SESSION['entry'] == 'password'){
          ?>
          <p class='field'>
          <label for='pass'>WRONG PASSWORD</label>
          <span id='valida' class='i i-close'></span>
        </p>
          <?php
          $_SESSION['entry'] = '';
        }else if($_SESSION['entry'] == 'out'){
          ?>
          <p class='field'>
          <label for='pass'>Logut Success</label>
          <span id='valida' class='i i-close'></span>
        </p>
          <?php
          $_SESSION['entry'] = '';
        }
        ?>

        

        	<input type='submit' id='do_login' name="loginadmin" value='LOG IN' title='Login' /></form>
      </div>
    </div>
  </div>
</div>


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
  <!-- <script src="script.js" ></script> -->
</body>
</html>