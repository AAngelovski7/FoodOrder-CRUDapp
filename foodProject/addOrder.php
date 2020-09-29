<?php
include 'templates/connectDB.php';

$title=$ingredients=$email=$address=$delivery='';
$errors =array('title' =>'' ,'email'=>'','ingredients'=>'','address'=>'','delivery'=>'' );

if(isset($_POST['submit'])){

  //check email
  if(isset($_POST['email'])){
    if(empty($_POST['email'])){
      $errors['email'] = 'email address is required';
    }else {
      $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $errors['email'] = "Invalid email format";
        }
    }
  }
  //check Title
  if(isset($_POST['title'])){
    if(empty($_POST['title'])){
      $errors['title'] = 'Title is required';
    }else {
      $title = $_POST['title'];
      if (!preg_match("/^[a-zA-Z ]*$/",$title)) {
          $errors['title'] = "Invalid title format (only leters and spaces)";
        }
    }
  }
  //check ingredients
  if(isset($_POST['ingredients'])){
    if(empty($_POST['ingredients'])){
      $errors['ingredients'] = 'At least one ingredient is required';
    }else {
      $ingredients = $_POST['ingredients'];
    if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/', $ingredients)){
          $errors['ingredients'] = "Invalid ingredients format (only leters and spaces and commas)";
        }
    }
  }
//check address and checkbox
if(isset($_POST['address'])){

}
//check delivery
if(isset($_POST['checkbox'])){
    if(empty($_POST['address'])){
      $errors['address'] = "Adress is required for delivery";
    }else{
      $address= $_POST['address'];
    if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $address)){
          $errors['address'] = "Invalid addres format (only leters and spaces numbers)";
        }
    }
}else {
  if(!empty($_POST['address'])){
    $errors['address'] = "You do not need to addres when do not need delivery";
  }
}

  //check if errors array is empty
  if(array_filter($errors)){
    //errors
  }else{
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $ingredients =  mysqli_real_escape_string($conn,$_POST['ingredients']);
    $address =  mysqli_real_escape_string($conn,$_POST['address']);
    $delivery = mysqli_real_escape_string($conn,$_POST['checkbox']);

     $sql = "INSERT INTO foods (title,email,ingredients,address,delivery) VALUES ('$title','$email','$ingredients','$address','$delivery')";

     if(mysqli_query($conn,$sql)){
       header('Location:index.php');
     }else{
       echo 'Connection error' .mysqli_error($conn);
      }
  }
}



 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <?php include 'templates/header.php' ?>
    <h5 class="center">Make Order</h5>

  <div class="container center formContainer " style="width:30%;">
          <form class="" action="addOrder.php" method="POST">
            <input type="text" name="title" placeholder="Title" value="<?php echo  htmlspecialchars($title); ?>">
            <div class="red-text"> <?php echo $errors['title']; ?> </div>
            <input type="text" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
            <div class="red-text"> <?php echo $errors['email']; ?> </div>
            <input type="text" name="ingredients" placeholder="ingredients" value="<?php echo htmlspecialchars($ingredients); ?>">
            <div class="red-text"> <?php echo $errors['ingredients']; ?> </div>
            <input type="text" name="address"  placeholder="addres" value="<?php echo htmlspecialchars($address); ?>">
            <div class="red-text"> <?php echo $errors['address']; ?> </div>
            <p>
              <label> <input type="checkbox" name="checkbox"  /> <span>Delivery</span> </label>
            </p>
            <div class="container center">
              <input type="submit" name="submit" value="submit" class="btn red lighten-2">

            </div>

          </form>
  </div>

  <?php include 'templates/footer.php' ?>
</html>
