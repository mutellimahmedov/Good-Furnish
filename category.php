
<?php require_once './header.php';

  if(isset($_GET['id'])){
    $delete = $db->prepare('DELETE FROM categories WHERE id = ?')->execute(array($_GET['id']));
    if($delete){
      $message = '<div class="alert alert-success" role="alert">
      Successfully deleted
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
    Category List
  </div>
  <div class="card-body">
  <?php
      if(!empty($message)){
        echo $message;
      }
    ?>
    
  <div  style="text-align: end;">
  <a href="./category-add.php" class="btn btn-primary">New Add</a>
</div>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $categories = $db->query('SELECT * FROM categories')->fetchAll();
      foreach($categories as $key => $category){ ?>
        <tr>
          <td scope="row"><?=$category['category_id']?></td>
          <td><?=$category['name']?></td>
          <td>
            <a href="./category.php?id=<?=$category['category_id']?>" class="btn btn-danger">Delete</a>
            <a href="./category-update.php?id=<?=$category['category_id']?>" class="btn btn-primary">Update</a>
          </td>
        </tr>
    <?php  }
    ?>
  </tbody>
</table>
  </div>
</div>
</div>


<?php require_once './footer.php' ?>