<?php require_once './header.php' ?>

<?php
$message = '';

$products  = $db->query('SELECT * FROM products')->fetchAll();
$customers = $db->query('SELECT * FROM customers')->fetchAll();

$data = $db->query('SELECT 
  orders.quantity   as qty,
  orders.order_time as order_time,
  products.name     as product_name,
  customers.first_name as user_name,
  orders.order_id as _id,
  products.product_id as p_id,
  customers.customer_id as c_id


  FROM orders
  INNER JOIN products on products.product_id = orders.product_id 
  INNER JOIN customers on customers.customer_id = orders.customer_id
  WHERE orders.order_id = '.$_GET['id'].'
 ')->fetch();
//  $sql = "UPDATE comments SET publicationDate=FROM_UNIXTIME(:publicationDate), title=:title, 
//  summary=:summary, content=:content, articleid=:articleid,imageExtension=:imageExtension WHERE id = :id";

if (isset($_POST['category_add_btn'])) {
  $product_id  = $_POST['product_id'];
  $customer_id = $_POST['customer_id'];
  $quantity    = $_POST['quantity'];

  $insert = $db->prepare('UPDATE orders SET product_id = ? ,customer_id = ? ,quantity = ? ,order_time = ?, cancelled = ? WHERE order_id = '.$_GET['id'].' ') 
    ->execute(array(
      $product_id,
      $customer_id,
      $quantity,
      date('Y-m-d'),
      0
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

header('location: '.$_SERVER['HTTP_REFERER'].' ');
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
          <select name="product_id" required class="form-control" id="">
            <option value="">Select Product</option>
            <?php
            foreach ($products as $key => $product) {

              if($data['p_id'] == $product['id']) {
                ?>
                   <option selected value="<?= $product['id'] ?>"><?= $product['name'] ?></option>
                <?php
              } else {
                ?>
                <option  value="<?= $product['product_id'] ?>"><?= $product['name'] ?></option>
             <?php
              }
            ?>
           
            <?php
            }
            ?>
          </select>
        </div>

        <div class="form-group mt-3">
          <label for="first_name">Customers</label>
          <select name="customer_id" required class="form-control" id="">
            <option value="">Select Customer</option>
            <?php
            foreach ($customers as $key => $customer) {
              if($customer['id'] == $data['c_id']) {
                ?>
                 <option selected value="<?= $customer['id'] ?>"><?= $customer['first_name'] ?></option>
                <?php
              } else {
                ?>
              <option value="<?= $customer['customer_id'] ?>"><?= $customer['first_name'] ?></option>

                <?php
              }
            }
            ?>
          </select>
        </div>

        <div class="form-group mt-3">
          <label for="telephone">Quantity</label>
          <input type="text" class="form-control" value="<?=$data['qty']?>" required id="quantity" name="quantity" placeholder="Enter Quantity">
        </div>

        <div style="text-align: end;" class="mt-2">
          <button type="submit" name="category_add_btn" class="btn btn-primary">Update</button>
        </div>

      </form>


    </div>
  </div>
</div>


<?php require_once './footer.php' ?>