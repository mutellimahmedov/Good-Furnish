
<?php require_once './header.php' ?>
<?php 
$message = '';
if(isset($_POST['category_add_btn'])) {
  $first_name = $_POST['first_name'];
  $lastname = $_POST['lastname'];
  $telephone = $_POST['telephone'];
  $address = $_POST['address'];
  

  $insert = $db->prepare('INSERT INTO customers (first_name,lastname,telephone,address) VALUES (?,?,?,?)')
  ->execute(array(
    $first_name,
    $lastname,
    $telephone,
    $address
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
    Add Customer
  </div>
    <?php
        if(!empty($message)){
          echo $message;
        }
      ?>
  <div class="card-body">
  <form action="" method="POST">
  <div class="form-group">
    <label for="first_name">First Name</label>
    <input type="text" class="form-control" required id="first_name" name="first_name" placeholder="Enter Firstname">
  </div>
  <div class="form-group mt-3">
    <label for="lastname">Lastname</label>
    <input type="text" class="form-control" required id="lastname" name="lastname" placeholder="Enter Lastname">
  </div>

  <div class="form-group mt-3">
    <label for="telephone">Telephone</label>
    <input type="text" class="form-control" required id="telephone" name="telephone" placeholder="Enter Telephone">
  </div>


  <div class="form-group mt-3">
    <label for="address">Address</label>
  <textarea  class="form-control" id="address" required name="address" cols="30" placeholder="Enter Address" rows="3"></textarea>
  </div>

  <div  style="text-align: end;" class="mt-2">
  <button type="submit" name="category_add_btn" class="btn btn-primary">New Add</button>
  </div>

</form>

   
  </div>
</div>
</div>


<?php require_once './footer.php' ?>