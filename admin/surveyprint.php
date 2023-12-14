<?php
require 'controllers/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Question</title>
    <style>
        @media print{
            .table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    margin-bottom: 20px; /* Adjust as needed */
}



.table-bordered {
    border: 1px solid #ddd; /* Border color */
}

.table-striped tbody tr:nth-child(odd) {
    background-color: #f2f2f2; /* Stripe color */
}

.table-hover tbody tr:hover {
    background-color: #e0e0e0; /* Hover color */
}

.table-bordered tbody {
    border: 2px solid #000; /* Border color for tbody */
}
th, td {
    border: 1px solid #000;
    padding: 8px;
    
}
.text-center{
    text-align: center;

}
.bg-primary{
    background-color: #007bff;
}
        }
    </style>
</head>
<body>
<table class="table table-bordered table-striped table-hover">
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
<script>
    window.print();

window.onafterprint = function() {
    window.history.back();
}
</script>
</body>
</html>