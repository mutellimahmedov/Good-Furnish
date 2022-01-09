
<?php require_once './header.php';?>

<div class="container mt-5">
<div class="card">
  <div class="card-header">
    Daily Product Sales
  </div>
  <div class="card-body">
  <div  style="float:left; margin-right:15px;">
    <a href="./product-sales.php" class="btn btn-primary">Daily Product Sales</a>
  </div>
  <div  style="float:left;margin-right:15px;">
    <a href="./product-sales-weekly.php" class="btn btn-primary">Weekly Product Sales</a>
  </div>
  <div  style="float:left;">
    <a href="./product-sales-monthly.php" class="btn btn-primary">Monthly Product Sales</a>
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
      <th scope="col">Discount Rate</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $date = date('Y-m-d'); 
      $daily = $db->query('SELECT * FROM orders WHERE cancelled = 0 AND order_time >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)')->fetchAll();
      foreach($daily as $key => $value){
        $product = $db->query('SELECT * FROM products WHERE id = '.$value['product_id'])->fetch(); ?>
        <tr>
          <td scope="row"><?=++$key?></td>
          <td><?=$product['name']?></td>
          <td>
            <?php
              $category = $db->query('SELECT * FROM categories WHERE id = '.$product['categori_id'])->fetch();
              echo $category['name'];
            ?>
          </td>
          <td><?=$product['quantity']?></td>
          <td><?=$product['minimum_quantity']?></td>
          <td><?=$product['price']?></td>
          <td><?=$product['discount_rate']?></td>
        </tr>
      <?php } ?>
  </tbody>
</table>
  </div>
</div>
</div>


<?php require_once './footer.php' ?>