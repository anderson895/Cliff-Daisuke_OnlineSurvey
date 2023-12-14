<?php
require 'admin/controllers/connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Survey</title>

    <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <style>
    body{
      font-size: 14px;
      background-image: url('dist/img/bg.jpg');
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      background-attachment: fixed;
      

    }
  </style>
</head>
<body>

 <!-- ======= Header ======= -->
 <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="landingpage.php">Csucarig</a></h1>
    

     

    </div>
  </header>
  <!-- End Header -->

  <br>
  <?php
  if(isset($_SESSION['success'])){
    if($_SESSION['success']=='success'){
      ?>
      <script>
        //swalfire
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Your answer has been submitted',
          showConfirmButton: false,
          timer: 1500
        })
      </script>
      <?php
      unset($_SESSION['success']);
    }
  }
  ?>
    <div class="container mt-5">
        <div class="card card-outline card-warning">
        <div class="card-header">
            <h3 class="card-title"> Information</h3>
            <div class="card-tools">
                <button type="button" class="btn-outline-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="col-4">
                <div class="mb-2">
                    <label for="service" class="form-label"> Service </label>
                    <select name="service" id="" class="form-control" required>
                        <option value="" selected disabled>select service</option>
                        <?php 
                        $view_query = mysqli_query($conn,"SELECT * from adminaccount "); 
                        while($row = mysqli_fetch_assoc($view_query)){ 
                            $ID = $row["ID"];
                            $Services = $row["Services"];
                            echo "<option value='$ID'>$Services</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>


            
            
            
          


            <div class="card-header">
              <h3 class="card-title">Personal Information</h3>
                <div class="card-tools">
                      
              </div>
            </div>
            <div class="card-body">
              
            <form action="answer" method="post">
                <div class="row">
                  <div class="col-4">
                    <div class="mb-2">
                      <label for="type" class="form-label">Client Type</label>
                      <select name="type" id="type" class="form-control" required>
                        <option value="Citizen">Citizen</option>
                        <option value="Business">Business</option>
                        <option value="Goverment">Goverment</option>
                      </select>
                    </div>
                    <div class="mb-2">
                      <label for="" class="form-label">Region of Residence</label>
                      <input type="text" name="region" id="region" class="form-control" required>
                    </div>
                  </div>

                  <div class="col-4">
                    <div class="mb-2">
                      <label for="gender" class="form-label">
                        Gender
                      </label>
                      <select name="gender" id="" class="form-control" required>
                          <option value="" selected disabled>Choose Gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                    </div>


                    <div class="mb-2">
                      <label for="service" class="form-label">Service Availed</label>
                      <input type="text" class="form-control" name="service" required>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="mb-2">
                      <label for="age" class="form-label">
                        Age
                      </label>
                      <input type="number" name="age" id="" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="name" class="form-label">Name <span class="text-danger">(Optional)</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter your Name">
                    </div>
                  </div>
                </div>
             
            </div>
            
        </div>
        <div class="card card-outline card-warning">
          <div class="card-header">
            <h3 class="card-title">
             Citizen Charter Survey
            </h3>
            <div class="card-tools">
              <button type="button" class=" btn-outline-info btn-sm" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <label for="" class="form-label"> Instructions: Check your answer to answer Citizen Charter(CC) questions. The Citizen Charter
              is an official document that contains the agency's mandate and functions, the services it offers</label><hr>
              <?php
            $sql = "SELECT * FROM questioncc";
                $result = mysqli_query($conn, $sql);
                foreach($result as $ccrow){
                    $ccid = $ccrow['ID'];
                    ?>
                    <label for="question" class="form-label"><?php echo '<strong>'.$ccrow['TITLE'].'</strong>'.' - '.$ccrow['DESCRIPTION']?></label><br>
                    <?php
                    $choicesql = "SELECT * FROM choicecc WHERE ccid = '$ccid'";
                    $choiceresult = mysqli_query($conn, $choicesql);
                    foreach($choiceresult as $choicerow){
                        ?>
                        <input type="radio" name="answers[<?php echo $ccid; ?>]" id="<?php echo $choicerow['ccid'].''.$choicerow['ID']?>" value="<?php echo $choicerow['ID']?>">&nbsp;&nbsp;&nbsp;<label for=""><?php echo $choicerow['CHOICE']?></label><br>
                        <?php
                    }
                ?>
                <hr>
                <?php
                }
            ?>
          </div>

           

        </div>
        <div class="card card-outline card-warning">
          <div class="card-header">
            <h3 class="card-title">
             Survey Question
            </h3>
            <div class="card-tools">
              <button type="button" class=" btn-outline-info btn-sm" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body" style="overflow-x: scroll;">
            <label for="" class="form-label"> Instructions: For SQD 0-5,  Please Choose on the column that best correspond to your answer</label>
            <table class="table table-stripped table-bordered">
              <thead>
                <tr>
                  <th>Question</th>
                  <th class="text-center">Strong Disagree (1)</th>
                  <th class="text-center">Disagree (2)</th>
                  <th class="text-center">Neither Agree nor Disagree (3)</th>
                  <th class="text-center">Agree (4)</th>
                  <th class="text-center">Strongly Agree (5)</th>
                  <th class="text-center">Not Applicable (0)</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sqdsql = "SELECT * FROM surveyquestion";
                $sqdres = mysqli_query($conn, $sqdsql);
                
                foreach($sqdres as $sqdrow){
                    ?>
                    <tr>
                        <td><?php echo '<strong>'.$sqdrow['TITLE'].'</strong>'.' - '.$sqdrow['QUESTION']?></td>
                        <td>
                            <input type="radio" name="question_<?php echo $sqdrow['ID']?>" id="SD<?php echo $sqdrow['ID']?>" class="form-control survey-input" value="1">
                        </td>
                        <td>
                            <input type="radio" name="question_<?php echo $sqdrow['ID']?>" id="D<?php echo $sqdrow['ID']?>" class="form-control survey-input" value="2">
                        </td>
                        <td>
                            <input type="radio" name="question_<?php echo $sqdrow['ID']?>" id="NE<?php echo $sqdrow['ID']?>" class="form-control survey-input" value="3">
                        </td>
                        <td>
                            <input type="radio" name="question_<?php echo $sqdrow['ID']?>" id="A<?php echo $sqdrow['ID']?>" class="form-control survey-input" value="4">
                        </td>
                        <td>
                            <input type="radio" name="question_<?php echo $sqdrow['ID']?>" id="SA<?php echo $sqdrow['ID']?>" class="form-control survey-input" value="5">
                        </td>
                        <td>
                            <input type="radio" name="question_<?php echo $sqdrow['ID']?>" id="NA<?php echo $sqdrow['ID']?>" class="form-control survey-input" value="0">
                        </td>
                        <input type="hidden" name="questionId[]" value="<?php echo $sqdrow['ID']; ?>">
                    </tr>
                    <?php
                }
                ?>
              
              </tbody>

            </table>
          </div>
          </div>
          <div class="card card-outline card-warning">
            <div class="card-header">
              Comments/Suggestion/Recommendation
            </div>
            <div class="card-body">
              <textarea name="comment" id="" cols="30" rows="3" class="form-control"></textarea>
            </div>
          <div class="card-footer">
            <button disabled type="submit" name="submitanswer" class="btn btn-sm btn-primary">Submit</button>
            <button type="reset" class="btn btn-sm btn-danger">Reset</button>
          </div>

          </div>
         
        

    </div> 
  
  </form>
  
    <!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<!-- <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<script src="dist/js/validation.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- <script>
    // jQuery script to calculate average score
    $(document).ready(function(){
        $(".survey-input").on("change", function(){
            calculateAverage();
        });
    });

    function calculateAverage() {
        var totalScore = 0;
        var count = 0;

        $(".survey-input:checked").each(function(){
            totalScore += parseInt($(this).val());
            count++;
        });

        var averageScore = count > 0 ? totalScore / count : 0;
        $("#ave").html("<strong>" + averageScore.toFixed(2) + "</strong>");
    }
</script> -->
</body>
</html>