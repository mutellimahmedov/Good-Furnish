<?php require_once './header.php' ;
  $message = "";
  if(isset($_POST['product_add_btn'])){
      $insert = $db->prepare('INSERT INTO products (categori_id ,name, quantity, minimum_quantity, price, discount_rate) VALUES (?,?,?,?,?,?)')->execute(array($_POST['category'],$_POST['name'],$_POST['quantity'],$_POST['min_quantity'],$_POST['price'],$_POST['discount_rate']));

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
      Add Product
    </div>
    <div class="card-body">
      <?php
        if(!empty($message)){
          echo $message;
        }
      ?>

      <form action="" method="POST">
        <div class="form-group">
          <label for="category">Category</label>
          <select class="custom-select form-control" id="category" name="category">
            <option selected>Select Category</option>
            <?php
              $categories = $db->query('SELECT * FROM categories')->fetchAll();
              foreach($categories as $key => $category){ ?>
              <option value="<?=$category['id']?>"><?=$category['name']?></option>
           <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" aria-describedby="name" placeholder="Enter name">
        </div>
        <div class="form-group">
          <label for="quantity">Quantity</label>
          <input type="number" class="form-control" id="quantity" name="quantity" aria-describedby="quantity" placeholder="Enter quantity">
        </div>
        <div class="form-group">
          <label for="min_quantity">Minumum Quantity</label>
          <input type="number" class="form-control" id="min_quantity" name="min_quantity" aria-describedby="min_quantity" placeholder="Enter minumum quantity">
        </div>
        <div class="form-group">
          <label for="price">Price</label>
          <input type="text" class="form-control" id="price" name="price" aria-describedby="price" placeholder="Enter price">
        </div>
        <div class="form-group">
          <label for="discount_rate">Discount Rate</label>
          <input type="number" class="form-control" id="discount_rate" name="discount_rate" aria-describedby="discount_rate" placeholder="Enter discount rate">
        </div>
        <div style="text-align: end;" class="mt-2">
          <button name="product_add_btn" class="btn btn-primary">New Add</button>
        </div>
      </form>


    </div>
  </div>
</div>


<?php require_once './footer.php' ?>