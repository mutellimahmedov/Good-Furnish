
<?php require_once './header.php' ?>
<?php 
$message = '';
if(isset($_POST['category_add_btn'])) {
  $address = $_POST['address'];
  $telephone = $_POST['telephone'];
  $fax = $_POST['fax'];
  $Vat_number = $_POST['Vat_number'];
  $name = $_POST['name'];
  

  $insert = $db->prepare('INSERT INTO company (name,address,telephone,fax,Vat_number) VALUES (?,?,?,?,?)')
  ->execute(array(
    $name,
    $address,
    $telephone,
    $fax,
    $Vat_number
  ));


  if($insert){
    $message = '<div class="alert alert-success" role="alert">
    Successfully added
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
    Add Company
  </div>
    <?php
        if(!empty($message)){
          echo $message;
        }
      ?>
  <div class="card-body">
  <form action="" method="POST">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" required id="name" name="name" placeholder="Enter Name">
  </div>

  <div class="form-group mt-3">
    <label for="address">Address</label>
  <textarea  class="form-control" id="address" required name="address" cols="30" placeholder="Enter Address" rows="3"></textarea>
  </div>

  <div class="form-group mt-3">
    <label for="telephone">Telephone</label>
    <input type="text" class="form-control" required id="telephone" name="telephone" placeholder="Enter Telephone">
  </div>

  <div class="form-group mt-3">
    <label for="telephone">Fax</label>
    <input type="text" class="form-control" required id="fax" name="fax" placeholder="Enter Fax">
  </div>

  <div class="form-group mt-3">
    <label for="telephone">Vat Number</label>
    <input type="text" class="form-control" required id="Vat_number" name="Vat_number" placeholder="Vat Number">
  </div>

  <div  style="text-align: end;" class="mt-2">
  <button type="submit" name="category_add_btn" class="btn btn-primary">New Add</button>
  </div>

</form>

   
  </div>
</div>
</div>


<?php require_once './footer.php' ?>