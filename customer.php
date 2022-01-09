<?php require_once './header.php' ?>
<?php
$customers = $db->query('SELECT * FROM customers')->fetchAll();


if(isset($_GET['id'])) {
 $delete = $db->exec('DELETE FROM customers WHERE id = '.$_GET['id'].' ');

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
      Customer List
    </div>
    <?php
        if(!empty($message)){
          echo $message;
        }
      ?>
    <div class="card-body">

      <div style="text-align: end;">
        <a href="./customer-add.php" class="btn btn-primary">New Add</a>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Firstname</th>
            <th scope="col">Lastname</th>
            <th scope="col">Telephone</th>
            <th scope="col">Adress</th>
            <th scope="col">Actions</ths>
          </tr>
        </thead>
        <tbody>

          <?php
          foreach ($customers as $key => $customer) {
          ?>
            <tr>
              <th scope="row"><?=++$key?></th>
              <td><?=$customer['first_name']?></td>
              <td><?=$customer['lastname']?></td>
              <td><?=$customer['telephone']?></td>
              <td><?=$customer['address']?></td>
              <td>
                <a href="./customer.php?id=<?=$customer['id']?>" class="btn btn-danger">Delete</a>
                <a href="./customer-update.php?id=<?=$customer['id']?>" class="btn btn-primary">Update</a>
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