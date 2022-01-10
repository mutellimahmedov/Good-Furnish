<?php require_once './header.php' ;
  $message = "";

  $categories  = $db->query('SELECT * FROM categories')->fetchAll();
  
  if (isset($_POST['category_add_btn'])) {
    $category_id  = $_POST['category_id'];
    $name = $_POST['name'];


    $insert = $db->prepare('INSERT INTO categories (category_id, name) 
    VALUES (?,?)')
      ->execute(array(
        $category_id,
        $name
      ));
  
  
    if ($insert) {
      $message =
        '<div class="alert alert-success" role="alert">
      Successfully added
    </div>';
    } else {
      $message =
        '<div class="alert alert-danger" role="alert">
      An error occurred
    </div>';
    }

  }



  // if(isset($_POST['category_add_btn'])){
  //     $insert = $db->prepare('INSERT INTO categories (name, category_id) VALUES (?,?)')
  //     ->execute(array(
  //         $category_name,
  //         $category_id
  //       ))

  //     if($insert){
  //       $message = '<div class="alert alert-success" role="alert">
  //       Successfully added
  //     </div>';
  //     }else{
  //       $message = '<div class="alert alert-danger" role="alert">
  //       An error occurred
  //     </div>';
  //     }
  // }

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
          <input type="text" class="form-control" id="name" name="name" aria-describedby="name" placeholder="Enter name">
          <input type="value" class="form-control" id="id" name="category_id" aria-describedby="id" placeholder="ID">
        </div>
        <div style="text-align: end;" class="mt-2">
          <button name="category_add_btn" class="btn btn-primary">New Add</button>
        </div>
      </form>


    </div>
  </div>
</div>


<?php require_once './footer.php' ?>