
<?php require_once './header.php';
$daily_price = 0;
$weekly_price = 0;
$monthly_price = 0;
$date = date('Y-m-d'); 
$daily = $db->query('SELECT * FROM orders WHERE cancelled = 0 AND  order_time = "'.$date.'"')->fetchAll();
foreach($daily as $value){
  $product = $db->query('SELECT * FROM products WHERE product_id = '.$value['product_id'])->fetch();
  $daily_price += $value['quantity'] * $product['price'];
}

$weekly = $db->query('SELECT * FROM orders WHERE cancelled = 0 AND YEARWEEK(order_time) = YEARWEEK(CURRENT_DATE)')->fetchAll();
foreach($weekly as $value){
  $product = $db->query('SELECT * FROM products WHERE product_id = '.$value['product_id'])->fetch();
  $weekly_price += $value['quantity'] * $product['price'];
}

$monthly = $db->query('SELECT * FROM orders WHERE cancelled = 0 AND order_time >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)')->fetchAll();
foreach($monthly as $value){
  $product = $db->query('SELECT * FROM products WHERE product_id = '.$value['product_id'])->fetch();
  $monthly_price += $value['quantity'] * $product['price'];
}
?>

<div class="container mt-5">
<div class="card">
  <div class="card-header">
    Sales Amount
  </div>
  <div class="card-body">
      <p>Daily Sales : <?=$daily_price?></p>
      <p>Weekly Sales : <?=$weekly_price?></p>
      <p>Monthly Sales : <?=$monthly_price?></p>
  </div>
</div>
</div>


<?php require_once './footer.php' ?>