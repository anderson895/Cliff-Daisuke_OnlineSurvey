<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- <style>
      .content-wrapper {
 
  background-image: url('bg.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  position: relative;
}
    </style> -->

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
            <h1 class="m-0 text-black">Questionnaire</h1>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Citizens Charter Question</h3>
                    <div class="card-tools">
                    <button class="btn-sm btn-primary"data-toggle="modal" data-target="#addcc">Add Question</button>
                      <button type="button" class="btn btn-outline-danger btn-sm" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                </div>
                <div class="card-body">
                        <table class="table table-hover table-bordered table-stripped">
                            <thead>
                                <th>Question Title</th>
                                <th>Question</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM questioncc";
                                $result = mysqli_query($conn,$sql);
                                if(mysqli_num_rows($result)>0){
                                    foreach($result as $row){
                                        ?>
                                        <tr>
                                            <td><?php echo $row['TITLE']?></td>
                                            <td><?php echo $row['DESCRIPTION']?></td>
                                            <td>
                                              <a href="edit_question?id=<?php echo $row['ID']?>" class="btn-sm btn-warning"><i class="fas fa-eye"></i></a>
                                              <a class="btn-sm btn-danger deletecc" style="cursor:pointer;"  data-id="<?php echo $row['ID']?>"><i class="fas fa-trash"></i></a>
                                              <a class="btn-sm btn-danger editquestionTogler" data-toggle="modal" data-target="#editCC" style="cursor:pointer;" data-description="<?php echo $row['DESCRIPTION']?>" data-title="<?php echo $row['TITLE']?>" data-id="<?= $row['ID'] ?>">
                                                  <i class="fas fa-edit"></i>
                                              </a>

                                            </td>
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
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Survey Question</h3>
                    <div class="card-tools">
                    <button class="btn-sm btn-primary" data-toggle="modal" data-target="#addsq">Add Question</button>
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
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                 if(isset($_GET['page_no']) && $_GET['page_no']!=""){
                                  $page_no = $_GET['page_no'];
                                  }else{
                                      $page_no = 1;
                                  }
                                //total record per page
                                $total_records_per_page = 3;
      
                                //get the page ofsset for the limit query
                                $offset = ($page_no-1) * $total_records_per_page;
      
                                //previous page  
                                $previous_page = $page_no - 1;
                                //next page
                                $next_page = $page_no + 1;
      
      
      
                                //total count of record
                                $result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM surveyquestion");
                                $records = mysqli_fetch_array($result_count);
                                $total_records = $records['total_records'];
                                $total_no_of_pages = ceil($total_records / $total_records_per_page);

                                $sqsql = "SELECT * FROM surveyquestion LIMIT $offset, $total_records_per_page";
                                $sqresult = mysqli_query($conn,$sqsql);
                                if(mysqli_num_rows($sqresult)>0){
                                    foreach($sqresult as $sqrow){
                                        ?>
                                        <tr>
                                          <td><?php echo $sqrow['TITLE']?></td>
                                            <td><?php echo $sqrow['QUESTION']?></td>
                                            <td>
                                              <button class="btn btn-sm btn-danger deletesq" data-id="<?php echo $sqrow['ID']?>"><i class="fas fa-trash"></i></button>
                                              <button class="btn btn-sm btn-danger editsqtogler"
                                               data-toggle="modal" data-target="#editSQ" style="cursor:pointer;" 
                                               data-id="<?= $sqrow['ID']?>"
                                               data-title="<?= $sqrow['TITLE']?>"
                                               data-question="<?= $sqrow['QUESTION']?>"
                                               >
                                               
                                               <i class="fas fa-edit"></i></button>
                                            </td>
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
                <div class="dataTables_paginate paging_simple_numbers mt-3 float-right" id="paganations" style="display:block;">
                <ul class="pagination">

                    <li class="page-item <?php if($page_no <= 1){ echo 'disabled';} ?>">
                        <a class="page-link " <?php if($page_no>=1){ echo 'href=?page_no='.$previous_page.'';}?>  aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php
                    for($counter = 1;$counter <= $total_no_of_pages;$counter++){
                        ?>
                        <li class="page-item"><a class="page-link" href="?page_no=<?php echo $counter?>"><?php echo $counter?></a></li>
                        <?php
                    }
                    ?>


                    <li class="page-item <?php if($page_no >= $total_no_of_pages){echo 'disabled';}?>">
                    <a class="page-link" href="?page_no=<?php echo $next_page?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                    </li>
                </ul>
                </div>
            </div>
        </div>
    </section>
</div>
</div>


<div class="modal fade" id="editSQ" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Survey Question</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="controllers/admincontrol.php" method="post">
        <div class="container" hidden>
          <label for="editSQID">EDIT QUESTION SQ ID</label>
          <input type="text" id="editSQID" name="editSQID">
        </div>
        <div class="mb-2">
        <label for="" class="form-label">Title</label>
        <input type="text" name="editSQTitleField" id="editSQTitleField" class="form-control">
        </div>
        <div class="mb-2">
        <label for="" class="form-label">Question</label>
        <input type="text" name="editSQQuestionField" id="editSQQuestionField" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="updateSQ" class="btn btn-primary">Save changes</button></form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editCC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Citizen Charter Question</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="controllers/admincontrol.php" method="post">
        <div class="container" hidden>
          <label for="editCCID">EDIT QUESTION CC ID</label>
          <input type="text" id="editCCID" name="editCCID">
        </div>
        <div class="mb-2">
        <label for="" class="form-label">Title</label>
        <input type="text" name="editCCTitleField" id="editCCTitleField" class="form-control">
        </div>
        <div class="mb-2">
        <label for="" class="form-label">Question</label>
        <input type="text" name="editCCQuestionField" id="editCCQuestionField" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="updatecc" class="btn btn-primary">Save changes</button></form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addcc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Citizen Charter Question</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="controllers/admincontrol.php" method="post">
        <div class="mb-2">
        <label for="" class="form-label">Title</label>
        <input type="text" name="title" id="" class="form-control">
        </div>
        <div class="mb-2">
        <label for="" class="form-label">Question</label>
        <input type="text" name="question" id="" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="addcc" class="btn btn-primary">Save changes</button></form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addsq" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Survey Question</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="controllers/admincontrol.php" method="post">
          <div class="mb-2">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="" class="form-control">
          </div>
           <div class="mb-2">
           <label for="question" class="form-label">Question</label>
            <input type="text" name="question" id="" class="form-control">
           </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="addsq" class="btn btn-primary">Save changes</button></form>
      </div>
    </div>
  </div>
</div>



<script>
  $(document).ready(function(){
    //editsqtogler

    $(".editsqtogler").on('click',function(){
      var updatesq = $(this).data('id');
      var titlesq = $(this).data('title');
      var descriptionsq = $(this).data('question');

      $("#editSQID").val(updatesq);
      $("#editSQTitleField").val(titlesq);
      $("#editSQQuestionField").val(descriptionsq);
      console.log(updatesq);
      console.log(titlesq);
      console.log(descriptionsq);
     
    });


    $(".editquestionTogler").on('click',function(){
      var updatecc = $(this).data('id');
      var titlecc = $(this).data('title');
      var descriptioncc = $(this).data('description');

      $("#editCCID").val(updatecc);
      $("#editCCTitleField").val(titlecc);
      $("#editCCQuestionField").val(descriptioncc);
      console.log(updatecc);
      console.log(titlecc);
      console.log(descriptioncc);
     
    });


    $(".deletecc").on('click',function(){
      var deletecc = $(this).data('id');
      
      //confirmation alert
      Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this CC Question?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
              }).then((result)=>{
                if(result.isConfirmed){
                     $.ajax({
                          url: 'controllers/admincontrol.php',
                          type: 'post',
                          data: {deletecc:deletecc},
                          success:function(data){
                            Swal.fire({
                                 icon: 'success',
                                 title: 'Success',
                                 text: 'CC Question Deleted Successfully'
                            }).then((result)=>{
                                 location.reload();
                            })
                          }
                     })
                }
              })

    });
    $(".deletesq").on('click',function(){
      var deletesq = $(this).data('id');
      
      //confirmation alert
      Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this Survey Question?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
              }).then((result)=>{
                if(result.isConfirmed){
                     $.ajax({
                          url: 'controllers/admincontrol.php',
                          type: 'post',
                          data: {deletesq:deletesq},
                          success:function(data){
                            Swal.fire({
                                 icon: 'success',
                                 title: 'Success',
                                 text: 'Survey Question Deleted Successfully'
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