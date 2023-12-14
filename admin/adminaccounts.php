<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
      .content-wrapper {
 
  background-image: url('bg.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  position: relative;
}
    </style>

    <?php
    include 'partials/attachcss.php';
    ?>

</head>
<body>
<?php require 'partials/nav.php';require 'partials/sidebar.php';?>
<?php
if(isset( $_SESSION['addadmin'])){
    echo '<script>Swal.fire("Success","Administrator Account Added","success")</script>';
  unset( $_SESSION['addadmin']);
}
if(isset($_SESSION['addadmind'])){
    echo '<script>Swal.fire("Success","Administrator Account Deleted","success")</script>';
  unset($_SESSION['addadmind']);
}

?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-black">Administrator Accounts</h1>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <div class="card-tools">
                        <button id="addChoice" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addchoices">Add Accounts</button>
                      
                    </div>
                </div>
                <div class="card-body">
                    <table class=" table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                
                                <th>Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // $session_id=$_SESSION['admin'];
                            // $asqk = "SELECT * FROM adminaccount where ID ='$session_id'";
                             $asqk = "SELECT * FROM adminaccount";
                            $asqkr = mysqli_query($conn,$asqk);
                            while($asqkrr = mysqli_fetch_assoc($asqkr)){
                                echo '<tr>
                                <td>'.$asqkrr['NAME'].'</td>
                                <td>'.$asqkrr['EMAIL'].'</td>
                                
                                <td>
                                  <a href="admincontrol?deleteadmin='.$asqkrr['ID'].'" class="btn btn-sm btn-danger">Delete</a>
                                  <a data-toggle="modal" 
                                  data-target="#updateAccount"
                                  data-id="'.$asqkrr['ID'].'"
                                  data-name="'.$asqkrr['NAME'].'"
                                  data-email="'.$asqkrr['EMAIL'].'"
                                  
                                  
                                  class="btn btn-sm btn-danger editAccountTogler">Edit</a>
                                </td>
                                </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </section>
</div>
</div>


<div class="modal fade" id="updateAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Administrator Accounts</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="controllers/admincontrol.php" method="post">

        <div class="mb-2" hidden>
                <label for="name" class="form-label">Account ID</label>
                <input type="text" name="UpdateID" class="form-control" id="UpdateID" required>
           </div>

           <div class="mb-2">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="UpdateName" class="form-control" id="UpdateName" required>
           </div>
        <div class="mb-2">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="UpdateEmail" class="form-control" id="UpdateEmail" required>
        </div>

       

        <div class="mb-2">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="UpdatePassword" class="form-control" id="UpdatePassword" required>
        </div>
        
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="UpdateAdmin" class="btn btn-primary">Save changes</button></form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addchoices" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Administrator Accounts</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="controllers/admincontrol.php" method="post">
           <div class="mb-2">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
           </div>
        <div class="mb-2">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" class="form-control" id="email" required>
        </div>
        
       

        <div class="mb-2">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="AddAdmin" class="btn btn-primary">Save changes</button></form>
      </div>
    </div>
  </div>
</div>


<script>
   $(document).ready(function(){

    $(".editAccountTogler").on('click',function(){
      var updateAccountID = $(this).data('id');
      var updateAccountNAME = $(this).data('name');
      var updateAccountEMAIL = $(this).data('email');
    

      
      $("#UpdateID").val(updateAccountID);
      $("#UpdateName").val(updateAccountNAME);
      $("#UpdateEmail").val(updateAccountEMAIL);
    

      
      console.log(updateAccountID);
      console.log(updateAccountNAME);
      console.log(updateAccountEMAIL);
   
     
    });
  });
</script>

<?php include 'partials/attachjs.php';?>


</body>
</html>