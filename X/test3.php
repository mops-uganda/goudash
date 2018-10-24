<!DOCTYPE html>
<html>
<head>
    <title>Initialization from table</title>
    <meta charset="utf-8">
    <link href="../content/shared/styles/examples-offline.css" rel="stylesheet">
    <link href="../../styles/kendo.common.min.css" rel="stylesheet">
    <link href="../../styles/kendo.rtl.min.css" rel="stylesheet">
    <link href="../../styles/kendo.default.min.css" rel="stylesheet">
    <link href="../../styles/kendo.default.mobile.min.css" rel="stylesheet">
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/jszip.min.js"></script>
    <script src="../../js/kendo.all.min.js"></script>
    <script src="../content/shared/js/console.js"></script>
    <script>

    </script>


</head>
<body>

<a class="offline-button" href="../index.html">Back</a>


<div id="example">
    <table id="grid">
        <colgroup>
            <col />
            <col />
            <col style="width:110px" />
            <col style="width:120px" />
            <col style="width:130px" />
        </colgroup>
        <thead>
        <tr>
            <th data-field="make">Player</th>
            <th data-field="model">Score1</th>
            <th data-field="year">Score2</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $con=mysqli_connect("localhost","root","","dash");
        $sql="SELECT * FROM `employees`";
        $query1=mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($query1))
        {
            ?>
            <tr>
                <td><?php echo $row['lastName'];?></td>
                <td><?php echo $row['officeCode'];?></td>
                <td><?php echo $row['reportsTo'];?></td>

            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $("#grid").kendoGrid({
                height: 550,
                sortable: true
            });
        });
    </script>
</div>


</body>
</html>
