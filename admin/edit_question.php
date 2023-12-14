<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <?php
    include 'partials/attachcss.php';
    ?>

</head>
<body>
<?php require 'partials/nav.php';require 'partials/sidebar.php';?>
<?php
if(isset($_SESSION['sq'])){
    if($_SESSION['sq']){
        ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Question Added Successfully'
            })
        </script>
        <?php
        unset($_SESSION['sq']);
    }else{
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Failed',
                text: 'Question Adding Failed'
            })
        </script>
        <?php
        unset($_SESSION['sq']);
    }
}
$qid = $_GET['id'];
$sql = "SELECT * FROM questioncc WHERE ID = '$qid'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Questionnaire</h1>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Citizen Charter Question</h3>
                    <div class="card-tools">
                        <button id="addChoice" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addchoices">Add Choices</button>
                      <button type="button" class="btn btn-outline-danger btn-sm" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                </div>
                <div class="card-body">
                    <span>
                        <h3><?php echo $row['TITLE']?></h3>
                        <p><?php echo $row['DESCRIPTION']?></p>
                    </span>
                    <table class=" table table-hover table-bordered table-stripped">
                        <thead>
                            <th>Choices</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            $csql = "SELECT * FROM choicecc WHERE CCID = '$qid'";
                            $cres = mysqli_query($conn,$csql);
                            if(mysqli_num_rows($cres)>0){
                                foreach($cres as $crow){
                                    ?>
                                    <tr>
                                        <td><?php echo $crow['CHOICE']?></td>
                                        <td><button class="btn btn-sm btn-danger deletechoice" data-id="<?php echo $crow['ID']?>"><i class="fas fa-trash"></i></button></td>
                                    </tr>
                                    <?php
                                }
                            }else{
                                ?>
                                <tr>
                                    <td colspan="2">No Choices Yet</td>
                                </tr>
                                <?php
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
<div class="modal fade" id="addchoices" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add CC Choices</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="controllers/admincontrol.php" method="post">
            <input type="hidden" name="qid" value="<?php echo $qid?>" class="form-control">
            <div class="mb-2">
                <label for="" class="form-label">Choice</label>
                <input type="text" name="choice" id="" class="form-control">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="add_cc_choices" class="btn btn-primary">Save changes</button></form>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        $(".deletechoice").on('click',function(){
            var choice = $(this).data('id');
           // confirmation alert
              Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this choice?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
              }).then((result)=>{
                if(result.isConfirmed){
                     $.ajax({
                          url: 'controllers/admincontrol.php',
                          type: 'post',
                          data: {choice:choice},
                          success:function(data){
                            Swal.fire({
                                 icon: 'success',
                                 title: 'Success',
                                 text: 'Choice Deleted Successfully'
                            }).then((result)=>{
                                 location.reload();
                            })
                          }
                     })
                }
              })
        });
    })
</script>
<?php include 'partials/attachjs.php';?>
</body>
</html>