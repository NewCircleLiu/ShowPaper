<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"></script>
    <script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>论文查询与展示</title>
</head>
<body>


<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <div class="page-header">
                <h1>
                    论文查询
                </h1>
            </div>
            <nav class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="index.php">首页</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="Index.php">查询</a>
                        </li>
                        <li>
                            <a href="showTable.php">统计</a>
                        </li>
                    </ul>
                </div>

            </nav>
            <table class="table">
                <thead>
                <tr>
                    <th>
                        Id
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Authors
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Publisher
                    </th>
                    <th>
                        Conference
                    </th>
                    <th>
                        Type
                    </th>
                </tr>
                </thead>
                <tbody>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'paper');
if (mysqli_connect_errno($conn))
{
    echo "连接 MySQL 失败: " . mysqli_connect_error();
}
if(is_array($_GET)&&count($_GET)>0)
{
    $pageId=$_GET["pageId"];
}
else{
    $pageId=1;
}
$result=mysqli_query($conn,"select * from paper");
$size=mysqli_num_rows($result)/30+1;
$i=1;
    while($row = mysqli_fetch_array($result))
    {
        if($i <= 1+$pageId*30 && $i>= 1+($pageId-1)*30)
        {
            if($i%5==0)
            {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['author'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['publisher'] . "</td>";
                echo "<td>" . $row['conference'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "</tr>";
            }
            else if($i%4==0)
            {
                echo "<tr class='error'>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['author'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['publisher'] . "</td>";
                echo "<td>" . $row['conference'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "</tr>";
            }
            else if($i%3==0)
            {
                echo "<tr class='info'>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['author'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['publisher'] . "</td>";
                echo "<td>" . $row['conference'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "</tr>";
            }
            else if($i%2==0)
            {
                echo "<tr class='success'>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['author'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['publisher'] . "</td>";
                echo "<td>" . $row['conference'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "</tr>";
            }
            else
            {
                echo "<tr class='warning'>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['author'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['publisher'] . "</td>";
                echo "<td>" . $row['conference'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "</tr>";
            }
        }
        $i=$i+1;
    }
    //mysqli_close($conn);
?></tbody></table>
            <ul class="pagination">
                <li>
                    <a href="?pageId=1">首页</a>
                </li>
                <?php
                    for($i=1;$i<=$size;$i++)
                    {
                        echo "<li>";
                        echo "<a href='?pageId=".$i."'>".$i."</a>";
                    }
                ?>
                <li>
                    <a href="?pageId=<?php echo $size?>">最后一页</a>
                </li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>