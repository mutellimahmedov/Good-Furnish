
<?php require_once './header.php';

  if(isset($_GET['id'])){
    $delete = $db->prepare('DELETE FROM products WHERE id = ?')->execute(array($_GET['id']));
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
    Product List
  </div>
  <div class="card-body">
  <?php
      if(!empty($message)){
        echo $message;
      }
    ?>
    
  <div  style="text-align: end;">
  <a href="./product-add.php" class="btn btn-primary">New Add</a>
</div>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Category</th>
      <th scope="col">Quantity</th>
      <th scope="col">Min. Quantity</th>
      <th scope="col">Price</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $products = $db->query('SELECT * FROM products')->fetchAll();
      foreach($products as $key => $product){ ?>
        <tr>
          <td scope="row"><?=$product['product_id']?></td>
          <td><?=$product['name']?></td>
          <td>
            <?php
              $category = $db->query('SELECT * FROM categories WHERE category_id = '.$product['category_id'])->fetch();
              echo $category['name'];
            ?>
          </td>
          <td><?=$product['quantity']?></td>
          <td><?=$product['minimum_quantity']?></td>
          <td><?=$product['price']?></td>
          <td>
            <a href="./product.php?id=<?=$product['product_id']?>" class="btn btn-danger">Delete</a>
            <a href="./product-update.php?id=<?=$product['product_id']?>" class="btn btn-primary">Update</a>
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