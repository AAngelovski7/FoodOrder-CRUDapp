<?php
include 'templates/connectDB.php';

$sql = "SELECT * FROM foods ORDER BY created_at";

$result = mysqli_query($conn,$sql);

$foods = mysqli_fetch_all($result,MYSQLI_ASSOC);

if(isset($_POST['delete'])){
  $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
  $sql = "DELETE FROM foods WHERE id = $id_to_delete";
if(mysqli_query($conn,$sql)){
  header('Location:index.php');
}else{
  echo "query error".mysqli_error($conn);
}
}




mysqli_free_result($result);
mysqli_close($conn);

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php include 'templates/header.php' ?>

<div class="container center" style="margin-top:40px;">

  <div class="row center">

        <?php foreach ($foods as $food) { ?>
          <div class="orders col s4 md3" style="height:500px;">
            <div class="card center">
              <img src="images/food.png" style="width:300px; height:200px;">
                <div>
                  <span class="card-title red-text text-lighten-2 center"><b><?php echo htmlspecialchars($food['title']); ?></b></span> <br />
                </div>
                <div class="card-content">
                  <ul>
                    <h6> <b>ingredients</b></h6>
                    <?php foreach (explode(',',$food['ingredients']) as $ingredient ) { ?>
                      <li><?php echo  htmlspecialchars($ingredient); ?></li>
                  <?php  } ?>
                  <form class="" action="index.php" method="post">
                    <input type="hidden" name="id_to_delete" value="<?php echo $food['id']; ?>" >
                    <button class="left btn-small waves-effect waves-teal red lighten-2 " type="submit" name="delete"><i class="fas fa-trash"></i></button>
                  </form>

                  </ul>

                  <a class="right " href="details.php?id=<?php echo $food['id']; ?>">more details</a>
                </div>
            </div>
          </div>
         <?php } ?>
    </div>
</div>

<?php include 'templates/footer.php' ?>

</html>
