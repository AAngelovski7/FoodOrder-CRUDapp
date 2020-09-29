<?php
include 'templates/connectDB.php';

if(isset($_GET['id'])){
$id = mysqli_real_escape_string($conn,$_GET['id']);

$sql = "SELECT * FROM foods WHERE id = $id";

$result = mysqli_query($conn,$sql);

$food = mysqli_fetch_assoc($result);

if($food['delivery'] =='on'){
  $delivery = 'yes';
}else{
  $delivery = "no";
}
mysqli_free_result($result);

mysqli_close($conn);

} 


 ?>

<html>

  <?php include 'templates/header.php' ?>

<div class = "container" style = "width:25%; margin-top:30px;">
  
  <div class="orders col s4 md3">
    <div class="card center">
      <img src="images/food.png" style="width:320px; height:200px;">
        <div>
          <span class="card-title red-text text-lighten-2 center"><b><?php echo htmlspecialchars($food['title']); ?></b></span> <br />
        </div>
        <div class="card-content">
          <ul>
            <h6> <b>ingredients:</b></h6>
            <?php foreach (explode(',',$food['ingredients']) as $ingredient ) { ?>
              <li><?php echo  htmlspecialchars($ingredient); ?></li>
          <?php  } ?>
          </ul>
          <p><b>Delivery: </b><?php echo $delivery; ?></p> <br/>
          <p><b>Address: </b><?php echo htmlspecialchars($food['address']);     ?>   </p>
        </div>
      </div>
    </div>

      </div>
  
</div>

  <?php include 'templates/footer.php' ?>
</html>