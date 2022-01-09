<?php require_once './header.php';

if (isset($_GET['delete'])) {
  $delete = $db->prepare('DELETE FROM sales WHERE id = ?')->execute(array($_GET['id']));
  if ($delete) {
    $message = '<div class="alert alert-success" role="alert">
      Successfully deleted
    </div>';
  } else {
    $message = '<div class="alert alert-danger" role="alert">
      An error occurred
    </div>';
  }
}

if (isset($_GET['cancelled'])) {
  $cancelled = $db->prepare('UPDATE sales SET canceled = 1 WHERE id = ?')->execute(array($_GET['id']));
  if ($cancelled) {
    $message = '<div class="alert alert-success" role="alert">
      Successfully cancelled
    </div>';
  } else {
    $message = '<div class="alert alert-danger" role="alert">
      An error occurred
    </div>';
  }
}

?>

<div class="container mt-5">
  <div class="card">
    <div class="card-header">
      Sales List
    </div>
    <div class="card-body">
      <?php
      if (!empty($message)) {
        echo $message;
      }
      ?>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Product Name</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Sales Time</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sales = $db->query('SELECT * FROM sales')->fetchAll();
          foreach ($sales as $key => $sale) { 
              $order = $db->query('SELECT * FROM orders WHERE id = '.$sale['order_id'])->fetch();
            ?>
            <tr>
              <td scope="row"><?= ++$key ?></td>
              <td>
                <?php
                    $product = $db->query('SELECT * FROM products WHERE id = ' . $order['product_id'])->fetch();
                    echo $product['name'];
                ?>
              </td>
              <td>
              <?php
                    $customer = $db->query('SELECT * FROM customers WHERE id = ' . $order['customer_id'])->fetch();
                    echo $customer['first_name']." ".$customer['lastname'];
                ?>
              </td>
              <td><?= $order['quantity'] ?></td>
              <td><?= $sale['Sale_time'] ?></td>
              <td>
                <?php
                  if($sale['canceled'] == 1){
                    echo "Cancelled";
                  }
                ?>
              </td>
              <td>
                  <a href="./sales.php?id=<?= $sale['id'] ?>&delete=1" class="btn btn-danger">Delete</a>
                  <?php
                  if($sale['canceled'] == 0){ ?>
                    <a href="./sales.php?id=<?= $sale['id'] ?>&cancelled=1" class="btn btn-warning">Cancelled</a>
                <?php  }
                ?>
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