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
            <h1 class="m-0 text-white">Survey Questionnaire Breakdown</h1>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Survey Question</h3>
                    <div class="card-tools">
                    <a href="surveyprint" class="btn btn-sm btn-info">Print Result</a>
                      <button type="button" class="btn btn-outline-danger btn-sm" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered table-stripped">
                            <thead>
                                <th>Title</th>
                                <th>Question</th>
                                <th>Strongly Disagree</th>
                                <th>Disagree</th>
                                <th>Niether</th>
                                <th>Agree</th>
                                <th>Strongly Agree</th>
                                <th>Responses</th>
                                <th>Rating</th>
                            </thead>
                            <tbody>
                                <?php
                                $sqsql = "SELECT * FROM surveyquestion";
                                $sqresult = mysqli_query($conn,$sqsql);
                                if(mysqli_num_rows($sqresult)>0){
                                    foreach($sqresult as $sqrow){
                                        ?>
                                        <tr>
                                        <td><?php echo $sqrow['TITLE']?></td>
                                        <td><?php echo $sqrow['QUESTION']?></td>
                                           <?php
                                        $qid = $sqrow['ID'];
                                        //count the number of strongly disagree
                                        $sdsql = "SELECT COUNT(*) as SD FROM surveyanswer WHERE QUESTION = '$qid' AND CHOICESCORE = '1'";
                                        $sdresult = mysqli_query($conn,$sdsql);
                                        $sdrow = mysqli_fetch_assoc($sdresult);
                                        //count the number of  disagree
                                        $dsql = "SELECT COUNT(*) as D FROM surveyanswer WHERE QUESTION = '$qid' AND CHOICESCORE = '2'";
                                        $dresult = mysqli_query($conn,$dsql);
                                        $drow = mysqli_fetch_assoc($dresult);
                                        //count the number of niether
                                        $nsql = "SELECT COUNT(*) as N FROM surveyanswer WHERE QUESTION = '$qid' AND CHOICESCORE = '3'";
                                        $nresult = mysqli_query($conn,$nsql);
                                        $nrow = mysqli_fetch_assoc($nresult);
                                        //count the number of agree
                                        $asql = "SELECT COUNT(*) as A FROM surveyanswer WHERE QUESTION = '$qid' AND CHOICESCORE = '4'";
                                        $aresult = mysqli_query($conn,$asql);
                                        $arow = mysqli_fetch_assoc($aresult);
                                        //count the number of strongly agree
                                        $sasql = "SELECT COUNT(*) as SA FROM surveyanswer WHERE QUESTION = '$qid' AND CHOICESCORE = '5'";
                                        $saresult = mysqli_query($conn,$sasql);
                                        $sarow = mysqli_fetch_assoc($saresult);
                                            
                                           ?>
                                           <td><?php echo $sdrow['SD'];?></td>
                                             <td><?php echo $drow['D'];?></td>
                                                <td><?php echo $nrow['N'];?></td>
                                                    <td><?php echo $arow['A'];?></td>
                                                        <td><?php echo $sarow['SA'];?></td>
                                                        <?php
                                                        $total = $sdrow['SD']+$drow['D']+$nrow['N']+$arow['A']+$sarow['SA'];
                                                        ?>
                                                        <td><?php echo $total;?></td>
                                                        <?php
                                                        $rating = ($sdrow['SD']*1)+($drow['D']*2)+($nrow['N']*3)+($arow['A']*4)+($sarow['SA']*5);
                                                        if($total == 0){
                                                            $rating = 0;
                                                        }else{
                                                            $rating = $rating/$total;
                                                        }
                                                        ?>
                                                        <td><?php echo ROUND($rating,2);?></td>


                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr class="bg-dark">
                                    <td colspan="2" class="text-center">Overall</td>
                                    <td>
                                        <?php
                                        $sdsql = "SELECT COUNT(*) as SD FROM surveyanswer WHERE CHOICESCORE = '1'";
                                        $sdresult = mysqli_query($conn,$sdsql);
                                        $sdrow = mysqli_fetch_assoc($sdresult);
                                        echo $sdrow['SD'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $dsql = "SELECT COUNT(*) as DD FROM surveyanswer WHERE CHOICESCORE = '2'";
                                        $dresult = mysqli_query($conn,$dsql);
                                        $drow = mysqli_fetch_assoc($dresult);
                                        echo $drow['DD'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $nsql = "SELECT COUNT(*) as NN FROM surveyanswer WHERE CHOICESCORE = '3'";
                                        $nresult = mysqli_query($conn,$nsql);
                                        $nrow = mysqli_fetch_assoc($nresult);
                                        echo $nrow['NN'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $asql = "SELECT COUNT(*) as AA FROM surveyanswer WHERE CHOICESCORE = '4'";
                                        $aresult = mysqli_query($conn,$asql);
                                        $arow = mysqli_fetch_assoc($aresult);
                                        echo $arow['AA'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $sasql = "SELECT COUNT(*) as SAA FROM surveyanswer WHERE CHOICESCORE = '5'";
                                        $saresult = mysqli_query($conn,$sasql);
                                        $sarow = mysqli_fetch_assoc($saresult);
                                        echo $sarow['SAA'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $sdrow['SD']+$drow['DD']+$nrow['NN']+$arow['AA']+$sarow['SAA'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $vgsql = "SELECT AVG(CHOICESCORE) as AVG FROM surveyanswer";
                                        $vgresult = mysqli_query($conn,$vgsql);
                                        $vgrow = mysqli_fetch_assoc($vgresult);
                                        echo ROUND($vgrow['AVG'],2);
                                        ?>
                                    </td>

                                </tr>
                                    <?php
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