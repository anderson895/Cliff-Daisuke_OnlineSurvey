<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashbaord</title>
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

<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-white">Comments/Suggestion/Recommmendations</h1>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-success">
                <div class="card-body">
                    <table class=" table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $asqk = "SELECT * FROM comments";
                            $asqkr = mysqli_query($conn,$asqk);
                            while($asqkrr = mysqli_fetch_assoc($asqkr)){
                                echo '<tr>
                                <td>'.$asqkrr['COMMENT'].'</td>
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


<?php include 'partials/attachjs.php';?>
</body>
</html>