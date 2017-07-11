<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../plugin/chartist/chartist.min.css">
	<script src="../plugin/chartist/chartist.min.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<div class="ct-chart" style="height: 500px; font-family: arial"></div>
	<script type="text/javascript">
	<?php
		$exampleArr = ['lorem','ipsum','dolor','dolor','lorem','lorem'];
    $exampleArr = array_count_values($exampleArr);

    $labelArr = array();
    $valueArr = array();

    foreach($exampleArr as $key => $value) {
        array_push($labelArr, $key); 
        array_push($valueArr, $value);
    }
    ?>

    var data = {  
    	labels: <?php echo json_encode($labelArr) ?>,
    	series: [
    	<?php echo json_encode($valueArr); ?>
    	]
    };

    var options = {  
    	seriesBarDistance: 10
    };

    var responsiveOptions = [  
    ['screen and (max-width: 640px)', {
    	seriesBarDistance: 5,
    	axisX: {
    		labelInterpolationFnc: function (value) {
    			return value[0];
    		}
    	}
    }]
    ];

    new Chartist.Bar('.ct-chart', data, options, responsiveOptions);


</script>

</body>
</html>