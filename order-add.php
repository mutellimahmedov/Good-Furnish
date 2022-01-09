<?php require_once './header.php' ?>
<?php
$message = '';

$products  = $db->query('SELECT * FROM products')->fetchAll();
$customers = $db->query('SELECT * FROM customers')->fetchAll();

if (isset($_POST['category_add_btn'])) {
  $product_id  = $_POST['product_id'];
  $customer_id = $_POST['customer_id'];
  $quantity    = $_POST['quantity'];

  $insert = $db->prepare('INSERT INTO orders (product_id,customer_id,quantity	,order_time, cancelled) 
  VALUES (?,?,?,?,?)')
    ->execute(array(
      $product_id,
      $customer_id,
      $quantity,
      date('Y-m-d'),
      0
    ));

  $lastId = $db->lastInsertId();

  $sales = $db->prepare('INSERT INTO sales SET order_id =?, Sale_time =?, canceled = ?')
  ->execute(
    [
      $lastId,
      date('Y-m-d'),
      0
    ]
);


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

?>
<div class="container mt-5">
  <div class="card">
    <div class="card-header">
      Add Customer
    </div>
    <?php
    if (!empty($message)) {
      echo $message;
    }
    ?>
    <div class="card-body">
      <form action="" method="POST">
        <div class="form-group">
          <label for="first_name">Products</label>
          <select name="product_id" class="form-control" id="">
            <option value="">Select Product</option>
            <?php
            foreach ($products as $key => $product) {
            ?>
              <option value="<?= $product['id'] ?>"><?= $product['name'] ?></option>
            <?php
            }
            ?>
          </select>
        </div>

        <div class="form-group mt-3">
          <label for="first_name">Customers</label>
          <select name="customer_id" class="form-control" id="">
            <option value="">Select Customer</option>
            <?php
            foreach ($customers as $key => $customer) {
            ?>
              <option value="<?= $customer['id'] ?>"><?= $customer['first_name'] ?></option>
            <?php
            }
            ?>
          </select>
        </div>

        <div class="form-group mt-3">
          <label for="telephone">Quantity</label>
          <input type="text" class="form-control" required id="quantity" name="quantity" placeholder="Enter Quantity">
        </div>

        <div style="text-align: end;" class="mt-2">
          <button type="submit" name="category_add_btn" class="btn btn-primary">New Add</button>
        </div>

      </form>


    </div>
  </div>
</div>


<?php require_once './footer.php' ?>