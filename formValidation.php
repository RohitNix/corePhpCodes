<?php 
  include('connection.php');
  // code for the validation for the form using php //
  $fnameError = "";
  $lnameError = "";
  $numberError = "";
  $emailError = "";
  $passError = "";
  $cpassError = "";
  $success = "";
  if(isset($_POST['submit'])){
  if($_POST['fname']==""){
     $fnameError = "Please fill the name **!";
  }elseif(preg_match("/^[a-zA-Z]([0-9a-zA-Z]){2,10}$/",$_POST['fname'])!=1){
       $fnameError= "First name is too short should be more then 2 characters **";
  }else{
     $fnameError = "";
  }
  
  if($_POST['lname']==""){
     $lnameError = "Please fill the last name **";
  }elseif(preg_match("/^[a-zA-Z]([0-9a-zA-Z]){2,10}$/",$_POST['lname'])!=1){
       $lnameError= "Last name is too short should be more then 2 characters **";
  }else{
     $lnameError = "";
  }

  if($_POST['phone']==""){
     $numberError = "Please Enter the Phone Number **";      
  }elseif(preg_match("/^([0-9]){10}$/",$_POST['phone'])!=1){
     $numberError = "The phone number should be 10 digits lon **";
  }else{
      $numberError = "";
  }

  if($_POST['email']==""){
       $emailError = "Please enter the email **";
  }elseif(preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/",$_POST['email'])!=1){
       $emailError = "Please enter the email in the proper format **";
  }else{
      $emailError = "";
  }

  if($_POST['password']==""){
      $passError = "Please enter the  password";
  }elseif(preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/",$_POST['password'])!=1){
      #Minimum eight characters, at least one uppercase letter, one lowercase letter and one number:
      $passError = "Minimum eight characters, at least one letter, one number and one special character**";
  }else{
      $passError = "";
}
 if($_POST['cpassword']==""){
      $cpassError = "Please enter the confirm Password ** ";
 }elseif($_POST['cpassword']!=$_POST['password']){
      $cpassError = "Confirm Password doesn't match the password **";
 }else{
    $cpassError = ""; 
 } 

 // final insertion after the validation of the data //
 if($fnameError=="" && $lnameError=="" && $numberError=="" && $emailError=="" && $passError=="" && $cpassError==""){
   $fname = $_POST['fname'];
   $lname = $_POST['lname'];
   $phone = $_POST['phone'];
   $email = $_POST['email'];
   $password = md5($_POST['password']);

   $query = mysqli_query($conn,"INSERT INTO formvalidation (firstname,lastname,phone,email,password) VALUES ('$fname','$lname','$phone','$email','$password')") or die(mysqli_error($conn));
   if($query){
       $success = "Insertion Successfull";
   }else{
       echo "somethong wrong!!";
   }
}else{
    echo "something wrong !!";
}
}else{

}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6  mt-4">
                <h2 class="text-center">User Registration</h2>
                <div class="text-center">
                <?php echo isset($success)?"<h3 class='text-center' style='color:green'>".$success."</h3>":'';?></div>
                <form action="" method="POST" name="submit" class="mt-4">
                    <input type="text" name="fname"  value="<?php echo isset($_POST['fname'])? $_POST['fname']:'';?>" id="" class="form-control" placeholder="First Name">
                    <?php echo isset($fnameError)? "<h6 class='my-2' style='color:red'>".$fnameError."</h6>" : '';?>
                    <input type="text" name="lname" value="<?php echo isset($_POST['lname'])? $_POST['lname']:'';?>" id="" class="form-control" placeholder="Last Name">
                    <?php echo isset($lnameError)? "<h6 class='my-2' style='color:red'>".$lnameError."</h6>" : '';?>
                    <input type="number" name="phone" value="<?php echo isset($_POST['phone'])? $_POST['phone']:'';?>" id="" class="form-control" placeholder="Phone Number">
                    <?php echo isset($numberError)? "<h6 class='my-2' style='color:red'>".$numberError."</h6>" : '';?>
                    <input type="email" name="email" value="<?php echo isset($_POST['email'])? $_POST['email']:'';?>" id="" class="form-control" placeholder="Enter Email">
                    <?php echo isset($emailError)?"<h6 class='my-2' style='color:red'>".$emailError."</h6>" : '';?>
                    <input type="password" name="password" value="<?php echo isset($_POST['password'])? $_POST['password']:'';?>" id="" class="form-control" placeholder="Password">
                    <?php echo isset($passError)? "<h6 class='my-2' style='color:red'>".$passError."</h6>" : ''; ?>
                    <input type="password" name="cpassword" value="<?php echo isset($_POST['cpassword'])? $_POST['cpassword']:'';?>" id="" class="form-control" placeholder="Confirm Password">
                    <?php echo isset($cpassError)? "<h6 class='my-2' style='color:red'>".$cpassError."</h6>": '';?>
                    <input type="submit" class="btn btn-success btn-block" name = "submit" value="Register">
                    

                </form>
            </div>
        </div>
    </div>
  </body>
</html>