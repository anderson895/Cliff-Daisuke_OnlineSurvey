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
?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-black">Citizen Charter Response</h1>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Citizen Charter Question</h3>
                    <div class="card-tools">
                        <a href="printcc" class="btn btn-sm btn-info">Print Result</a>
                      <button type="button" class="btn btn-outline-danger btn-sm" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                </div>
                <div class="card-body">
                        <table class="table table-hover table-bordered table-stripped">
                            <thead>
                                <th>External Service</th>
                                <th>Responses</th>
                                <th>Percentage</th>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT questioncc.*,choicecc.*,choicecc.ID as cid,questioncc.ID as qid FROM questioncc INNER JOIN choicecc ON questioncc.ID = choicecc.ccid  ORDER BY questioncc.ID ASC ";
                                $result = mysqli_query($conn,$sql);
                                if(mysqli_num_rows($result)>0){
                                    foreach($result as $row){
                                        ?>
                                        <tr>
                                            <td><?php echo $row['TITLE'].' '.$row['CHOICE']?></td>
                                            <?php
                                            $choiceid = $row['cid'];
                                            $questionid = $row['qid'];
                                            $ccsql ="SELECT COUNT(*) as cv FROM ccanswer WHERE CHOICEANSWER='$choiceid'";
                                            $ccresult = mysqli_query($conn,$ccsql);
                                            $ccrow = mysqli_fetch_assoc($ccresult);
                                            $cccount = $ccrow['cv'];
                                            //get the percentage of every choice it should be equal to 100
                                            $ccsql2 ="SELECT COUNT(*) as cv2 FROM ccanswer WHERE QUE='$questionid'";
                                            $ccresult2 = mysqli_query($conn,$ccsql2);
                                            $ccrow2 = mysqli_fetch_assoc($ccresult2);
                                            $cccount2 = $ccrow2['cv2'];
                                            if($cccount2==0){
                                                $percentage = 0;
                                            }else{
                                                $percentage = round(($cccount/$cccount2)*100);
                                            }
                                            

                                            ?>
                                            <td><?php echo $cccount;?></td>
                                            <td><?php echo $percentage.'%';?></td>
                                        </tr>
                                        <?php
                                    }
                                }else{
                                    ?>
                                    <tr>
                                        <td colspan="3" class="text-center">No Data Available</td>
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



<?php include 'partials/attachjs.php';?>
</body>
</html>