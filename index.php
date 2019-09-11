<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search</title>
</head>
<body>

    <form method="post">
        <input type="text" name="text" placeholder="Search here..">
        <button type="submit" name="search">Search</button>
    </form>
    <br>
    <table>
        <tr>
            <th>Employee ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Department</th>
            <th>Team</th>
            <th>Designation</th>
        </tr>
        <?php
            include "DB.php";
            $query = "SELECT * FROM `employees`";
            $params = [];

            if(isset($_POST['search']) && !empty($_POST['text'])){
                $columnsToMatch = ['employeeID','firstName','lastName','department','team','designation']; //list of columns to match in the database
                $where = [];
                $text = $_POST['text'];
                foreach($columnsToMatch as $col){
                    $where[] = "$col LIKE ?";
                    $params[] = "%$text%"; //wildcard percents find data in the database with any position
                }
                $query .= "WHERE ".implode(" OR ",$where);
            }

            foreach(DB::getEm($query,$params) as $row){
                ?>
                <tr>
                    <td><?php echo $row['employeeID'] ?></td>
                    <td><?php echo $row['firstName'] ?></td>
                    <td><?php echo $row['lastName'] ?></td>
                    <td><?php echo $row['department'] ?></td>
                    <td><?php echo $row['team'] ?></td>
                    <td><?php echo $row['designation'] ?></td>
                </tr>
                <?php
            }
        ?>
    </table>
</body>
</html>