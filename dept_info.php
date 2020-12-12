<?php
    $link = mysqli_connect('localhost', 'admin', 'admin', 'employees');

    if(mysqli_connect_errno()){
        echo "Failed to connect to MariaDB: " . mysqli_connect_error();
        exit();
    }

    $query = "
    select dept_name, count(*), first_name, last_name  
    from departments de 
    inner join dept_emp d on de.dept_no = d.dept_no 
    inner join employees e on e.emp_no = d.emp_no
    where to_date='9999-01-01' group by dept_name;
    ";

    $result = mysqli_query($link, $query);  
    
    $article = '';    
    while($row = mysqli_fetch_array($result)){
        $article .= '<tr><td>';
        $article .= $row["dept_name"];
        $article .= '</td><td>';
        $article .= $row["count(*)"];
        $article .= '</td><td>';
        $article .= $row["first_name"];
        $article .= '</td><td>';
        $article .= $row["last_name"];
        $article .= '</td></tr>';
    }
    
    mysqli_free_result($result);
    mysqli_close($link);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>부서 정보</title>
    <style>
        body {
            font-family: Consolas, monospace;
            font-family: 12px;
        }
        table {
            width: 100%;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #dadada;
        }
    </style>
</head>

<body>
    <h2><a href="index.php">직원 관리 시스템</a> | 부서 정보</h2>
    <table>
        <tr>
            <th>dept_name</th>
            <th>number</th>
            <th>manager first_name</th>
            <th>manager last_name</th>
        </tr>        
        <?= $article ?>
    </table>
</body>

</html>