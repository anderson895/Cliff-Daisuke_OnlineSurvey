<?php
require 'controllers/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
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
    <h2 class="text-center">Citizen Charter Response</h2>
    <table class="table table-bordered table-striped table-hover">
        <thead class="bg-primary">
            <tr>
                <th>External Service</th>
                <th>Response</th>
                <th>Percentage</th>
            </tr>
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
                                            <td class="text-center"><?php echo $cccount;?></td>
                                            <td class="text-center"><?php echo $percentage.'%';?></td>
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
</body>
<script>
    window.print();

window.onafterprint = function() {
    window.history.back();
}
</script>
</html>