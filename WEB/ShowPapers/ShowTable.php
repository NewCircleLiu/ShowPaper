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
                        <li>
                            <a href="Index.php">查询</a>
                        </li>
                        <li class="active">
                            <a href="ShowTable.php" >统计</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="main" style="height:400px;width: 600px"></div>
        </div>
    </div>
</div>
    <div class="row clearfix">
        <div class="col-md-12 column">
          <center>
              <div id="main" style="height:400px;width: 600px"></div>
          </center>
        </div>
    </div>

<script src="http://echarts.baidu.com/build/dist/echarts-all.js"></script>

<script type="text/javascript">
    // 基于准备好的dom，初始化echarts图表
    var myChart = echarts.init(document.getElementById("main"));
    var y=[];
    function arrTest(){
        $.ajax({
            type:"post",
            async:false,
            url:"getData.php",
            data:{},
            dataType:"json",
            success:function(result){
                if (result) {
                    for (var i = 0; i < result.length; i++) {
                        y.push(result[i]);
                    }
                }
            }
        })
        return y;
    }
    arrTest();
    var option = {
        title : {
            text: '2010-2017论文发表数量',
            subtext: 'Dr. Xiaofei WANG'
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['论文发表数量']
        },
        //右上角工具条
        toolbox: {
            show : true,
            feature : {
                mark : {show: true},
                dataView : {show: true, readOnly: false},
                magicType : {show: true, type: ['line', 'bar']},
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        calculable : true,
        xAxis : [
            {
                type : 'category',
                boundaryGap : false,
                data : ['2010','2011','2012','2013','2014','2015','2016','2017']
            }
        ],
        yAxis : [
            {
                type : 'value',
                axisLabel : {
                    formatter: '{value} 篇'
                }
            }
        ],
        series : [
            {
                name:'2010-2017年论文发表情况',
                type:'line',
                data:y,
                markPoint : {
                    data : [
                        {type : 'max', name: '最大值'},
                        {type : 'min', name: '最小值'}
                    ]
                },
                markLine : {
                    data : [
                        {type : 'average', name: '平均值'}
                    ]
                }
            }
        ]
    };

    // 为echarts对象加载数据
    myChart.setOption(option);

</script>
</body>
</html>