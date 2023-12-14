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
  
<?php 
require 'partials/nav.php';
require 'partials/sidebar.php';
require 'controllers/connection.php';

$rsql = "SELECT COUNT(*) as tres FROM `answerby`";
$rquery = mysqli_query($conn,$rsql);
$rnum = mysqli_fetch_assoc($rquery);
$avesql = "SELECT ROUND(AVG(CHOICESCORE),2) as avescore FROM `surveyanswer`";
$averes = mysqli_query($conn,$avesql);
$averow = mysqli_fetch_assoc($averes);
if($averow['avescore'] == null){
  $averow['avescore'] = 0;
}else{
  $averow['avescore'] = $averow['avescore'];

}
//count the female 
$fsql = "SELECT COUNT(*) as f FROM `answerby` WHERE GENDER='Female'";
$fquery = mysqli_query($conn,$fsql);
$fnum = mysqli_fetch_assoc($fquery);

//count the male
$msql ="SELECT COUNT(*) as m FROM `answerby` WHERE GENDER='Male'";
$mquery = mysqli_query($conn,$msql);
$mnum = mysqli_fetch_assoc($mquery);



if(isset($_SESSION['sq'])){
  if($_SESSION['sq']=='ubos'){
    ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'All Response has been deleted'
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
                <h1 class="m-0 text-white">Dashboard</h1>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $rnum['tres']?></h3>

                <p>Total Respondents</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
           <!-- ./col -->
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $averow['avescore']?><sup style="font-size: 20px">%</sup></h3>

                <p>Average Score</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $mnum['m']?></h3>

                <p>Total Male Respondent</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
             
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $fnum['f']?></h3>

                <p>Total Female Respondent</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
            </div>

            <div class="row">
              <div class="col-lg-12 col-sm-12">
                <div class="card card-outline card-danger">
                  <div class="card-header">
                       <h3 class="card-title">Survey Overiew</h3> 
                      
                  </div>
                  <div class="card-body">
                    <canvas id="myChart"></canvas>
                  </div>
                </div>
              </div>
               
            </div>

        </div>
    </section>
</div>
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<script src="javascript/chart.js"></script>
<?php
$sqsql = "SELECT surveyquestion.*, surveyanswer.*,ROUND(AVG(surveyanswer.CHOICESCORE),2) as AVS FROM surveyquestion INNER JOIN surveyanswer ON surveyquestion.ID = surveyanswer.QUESTION GROUP BY surveyquestion.ID";
$sqquery = mysqli_query($conn,$sqsql);
$data[] = array();
foreach($sqquery as $row){
  $data[] = array(
    'question' => $row['TITLE'],
    'score' => $row['AVS']
  );

}
$sqdata = json_encode($data);

?>
<script>
  const ctx = document.getElementById('myChart');
  const survey = <?php echo $sqdata; ?>;

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: survey.map(item => item.question),
      datasets: [{
        label: 'Average Score',
        data: survey.map(item => item.score),backgroundColor:[
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(201, 203, 207, 0.2)' 
        ],
        borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)' 
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
    
  });
</script>

<?php include 'partials/attachjs.php';?>
</body>
</html>