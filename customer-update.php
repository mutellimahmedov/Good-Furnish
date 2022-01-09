
<?php require_once './header.php' ?>
<?php 
$message = '';

$data = $db->query('SELECT * FROM customers WHERE id = '.$_GET['id'].' ')->fetch();

if(isset($_POST['customer_update_btn'])) {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $telephone = $_POST['telephone'];
  $address = $_POST['address'];
  

  $insert = $db->prepare('UPDATE customers SET first_name =?,lastname=?,telephone=?,address=? WHERE id = '.$_GET['id'].' ')
  ->execute(array(
    $first_name,
    $lastname,
    $telephone,
    $address
  ));


  if($insert){
    $message = '<div class="alert alert-success" role="alert">
    Successfully updated
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
    <input type="text" class="form-control" value="<?=$data['first_name']?>" required id="first_name" name="first_name" placeholder="Enter Firstname">
  </div>
  <div class="form-group mt-3">
    <label for="lastname">Lastname</label>
    <input type="text" class="form-control"  value="<?=$data['lastname']?>" required id="lastname" name="lastname" placeholder="Enter Lastname">
  </div>

  <div class="form-group mt-3">
    <label for="telephone">Telephone</label>
    <input type="text" class="form-control"  value="<?=$data['telephone']?>"required id="telephone" name="telephone" placeholder="Enter Telephone">
  </div>


  <div class="form-group mt-3">
    <label for="address">Address</label>
  <textarea  class="form-control" id="address" required name="address" cols="30" placeholder="Enter Address" rows="3"><?=$data['address']?></textarea>
  </div>

  <div  style="text-align: end;" class="mt-2">
  <button type="submit" name="customer_update_btn" class="btn btn-primary">New Add</button>
  </div>

</form>

   
  </div>
</div>
</div>


<?php require_once './footer.php' ?>