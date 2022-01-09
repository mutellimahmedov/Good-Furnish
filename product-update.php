<?php require_once './header.php' ;
  $message = "";
  if(isset($_POST['product_update_btn'])){
      $update = $db->prepare('UPDATE products SET categori_id=? ,name=?, quantity=?, minimum_quantity=?, price=?, discount_rate=? WHERE id = ?')->execute(array($_POST['category'],$_POST['name'],$_POST['quantity'],$_POST['min_quantity'],$_POST['price'],$_POST['discount_rate'],$_GET['id']));

      if($update){
        $message = '<div class="alert alert-success" role="alert">
        Successfully updated
      </div>';
      }else{
        $message = '<div class="alert alert-danger" role="alert">
        An error occurred
      </div>';
      }
  }

  $data = $db->query("SELECT * FROM products WHERE id =".$_GET['id'])->fetch();

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
              <option <?php if($data['categori_id'] == $category['id']){ echo "selected"; } ?> value="<?=$category['id']?>"><?=$category['name']?></option>
           <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" aria-describedby="name" value="<?=$data['name']?>">
        </div>
        <div class="form-group">
          <label for="quantity">Quantity</label>
          <input type="number" class="form-control" id="quantity" name="quantity" aria-describedby="quantity" value="<?=$data['quantity']?>">
        </div>
        <div class="form-group">
          <label for="min_quantity">Minumum Quantity</label>
          <input type="number" class="form-control" id="min_quantity" name="min_quantity" aria-describedby="min_quantity" value="<?=$data['minimum_quantity']?>">
        </div>
        <div class="form-group">
          <label for="price">Price</label>
          <input type="text" class="form-control" id="price" name="price" aria-describedby="price" value="<?=$data['price']?>">
        </div>
        <div class="form-group">
          <label for="discount_rate">Discount Rate</label>
          <input type="number" class="form-control" id="discount_rate" name="discount_rate" aria-describedby="discount_rate" value="<?=$data['discount_rate']?>">
        </div>
        <div style="text-align: end;" class="mt-2">
          <button name="product_update_btn" class="btn btn-primary">Update</button>
        </div>
      </form>


    </div>
  </div>
</div>


<?php require_once './footer.php' ?>