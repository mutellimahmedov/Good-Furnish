<?php require_once './header.php' ;
  $message = "";
  if(isset($_POST['category_add_btn'])){
      $insert = $db->prepare('INSERT INTO categories (name) VALUES (?)')->execute(array($_POST['category_name']));

      if($insert){
        $message = '<div class="alert alert-success" role="alert">
        Successfully added
      </div>';
      }else{
        $message = '<div class="alert alert-danger" role="alert">
        An error occurred
      </div>';
      }
  }

?>

<div class="container mt-5">
  <div class="card">
    <div class="card-header">
      Add Category
    </div>
    <div class="card-body">
      <?php
        if(!empty($message)){
          echo $message;
        }
      ?>

      <form action="" method="POST">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="category_name" aria-describedby="name" placeholder="Enter name">
        </div>
        <div style="text-align: end;" class="mt-2">
          <button name="category_add_btn" class="btn btn-primary">New Add</button>
        </div>
      </form>


    </div>
  </div>
</div>


<?php require_once './footer.php' ?>