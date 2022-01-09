
<?php require_once './header.php';?>

<div class="container mt-5">
<div class="card">
  <div class="card-header">
    Out of Stock of Products
  </div>
  <div class="card-body">
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
      $products = $db->query('SELECT * FROM products WHERE quantity = 0')->fetchAll();
      foreach($products as $key => $product){ ?>
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
    <?php  }
    ?>
  </tbody>
</table>
  </div>
</div>
</div>


<?php require_once './footer.php' ?>