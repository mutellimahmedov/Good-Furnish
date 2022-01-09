<?php require_once './header.php' ?>
<?php

$orders = $db->query('SELECT 
  orders.quantity   as quantity,
  orders.order_time as order_time,
  products.name     as product_name,
  customers.first_name as user_name,
  customers.last_name as user_surname,
  order_id as _id,
  orders.cancelled as cancelled

  FROM orders
  INNER JOIN products on products.product_id = orders.product_id 
  INNER JOIN customers on customers.customer_id = orders.customer_id
 ')->fetchAll();


if(isset($_GET['order_id'])) {
   $delete = $db->exec('DELETE FROM orders WHERE order_id = '.$_GET['order_id'].' ');

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

if(isset($_GET['cancelled'])) {
  $db->prepare('UPDATE orders SET cancelled = !cancelled WHERE id = ?')->execute(array($_GET['cancelled']));
  header('location: '.$_SERVER['HTTP_REFERER'].'');
}



?>




<?php 

// include "config.php";

// //SEARCH BAR ACTION
// $sql = " SELECT * FROM orders ";

// if(isset($_POST['search'])) {

//   $search_term = mysql_real_escape_string($_POST['search_box']);

//   $sql .= "WHERE order_id = '{$search_term}";

// }


?>

<div class="container mt-5">
  <div class="card">
    <div class="card-header">
      Order List
    </div>
    <?php
        if(!empty($message)){
          echo $message;
        }
      ?>
    <div class="card-body">

      <div style="text-align: end;">
        <a href="./order-add.php" class="btn btn-primary">New Add</a>
      </div>

      <!-- <form name="_form" method="POST" action="orders.php">  
        Search: <input type="text" name="search_box" value=""/>
        <input class="search btn-secondary" type="submit" name="search" value="Search the Table">
      </form> -->

      <table class="table">
        <thead>
          <tr>
            <th scope="col">Order</th>
            <th scope="col">Product Name</th>
            <th scope="col">Name</th>
            <th scope="col">Surname</th>
            <th scope="col">Quantity</th>
            <th scope="col">Order Date</th>
            <th scope="col">Status of Order</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>

          <?php
          foreach ($orders as $key => $order) {
          ?>
            <tr>
              <th scope="row"><?=$order['_id']?></th>
              <td><?=$order['product_name']?></td>
              <td><?=$order['user_name']?></td>
              <td><?=$order['user_surname']?></td>
              <td><?=$order['quantity']?></td>
              <td><?=$order['order_time']?></td>
              <td><?=$order['cancelled'] == 0 ?'': 'cancelled'; ?></td>
              <td>
                <a href="./orders.php?id=<?=$order['_id']?>" class="btn btn-danger">Delete</a>
                <a href="./order-update.php?id=<?=$order['_id']?>" class="btn btn-primary">Update</a>
                <a href="./orders.php?cancelled=<?=$order['_id']?>" class="btn btn-warning">Cancelled</a>
              </td>
            </tr>
          <?php
          }
          ?>

        </tbody>
      </table>
    </div>
  </div>
</div>


<?php require_once './footer.php' ?>
