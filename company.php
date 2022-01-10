<?php require_once './header.php' ?>
<?php
$companyes = $db->query('SELECT * FROM company')->fetchAll();


if(isset($_GET['id'])) {
 $delete = $db->exec('DELETE FROM company WHERE id = '.$_GET['id'].' ');

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
      Company List
    </div>
    <?php
        if(!empty($message)){
          echo $message;
        }
      ?>
    <div class="card-body">

      <div style="text-align: end;">
        <a href="./company-add.php" class="btn btn-primary">New Add</a>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Telephone</th>
            <th scope="col">Fax</th>
            <th scope="col">Vat Number</th>
            <th scope="col">Address</th>
            <th scope="col">Actions</ths>
          </tr>
        </thead>
        <tbody>

          <?php
          foreach ($companyes as $key => $company) {
          ?>
            <tr>
              <th scope="row"><?=$company['company_id']?></th>
              <td><?=$company['name']?></td>
              <td><?=$company['telephone']?></td>
              <td><?=$company['fax']?></td>
              <td><?=$company['Vat_number']?></td>
              <td><?=$company['address']?></td>
              <td>
                <a href="./company.php?id=<?=$company['company_id']?>" class="btn btn-danger">Delete</a>
                <a href="./company-update.php?id=<?=$company['company_id']?>" class="btn btn-primary">Update</a>
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