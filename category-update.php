<?php require_once './header.php' ;
  $message = "";
  if(isset($_POST['category_update_btn'])){
      $insert = $db->prepare('UPDATE categories SET name = ? WHERE id =?')->execute(array($_POST['category_name'] , $_GET['id']));

      if($insert){
        $message = '<div class="alert alert-success" role="alert">
        Successfully updated
      </div>';
      }else{
        $message = '<div class="alert alert-danger" role="alert">
        An error occurred
      </div>';
      }
  }

  $data = $db->query('SELECT * FROM categories WHERE id ='.$_GET['id'])->fetch();

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
          <input type="text" class="form-control" id="name" name="category_name" aria-describedby="name" value="<?=$data['name']?>">
        </div>
        <div style="text-align: end;" class="mt-2">
          <button name="category_update_btn" class="btn btn-primary">Update</button>
        </div>
      </form>


    </div>
  </div>
</div>


<?php require_once './footer.php' ?>