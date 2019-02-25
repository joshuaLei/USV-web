<?php
function usv($usv, $route){
	if ($usv == "1"){
		$_frame1 = 0;
		$_frame2 = 1;
		$_frame3 = 2;
		$_frame4 = 2;
	}else if ($usv == "2"){
		$_frame1 = 1;
		$_frame2 = 2;
		$_frame3 = 0;
		$_frame4 = 0;
	}else if ($usv == "3"){
		$_frame1 = 2;
		$_frame2 = 2;
		$_frame3 = 1;
		$_frame4 = 0;
	}else if ($usv == "4"){
		$_frame1 = 2;
		$_frame2 = 2;
		$_frame3 = 0;
		$_frame4 = 1;
	}

?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--css stylesheet-->
    <link rel="stylesheet" href="css/materialize.min.css">
    
    
    <!--font stylesheet-->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC:300" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="css/auto.css">
    
    
    <!--icon stylesheet-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!--JS-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="js_button/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js_button/underscore-min.js"></script>
    <script type="text/javascript" src="js_button/backbone-min.js"></script>
    <script type="text/javascript" src="js_button/joystick_view.js"></script>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
	<a href="auto.php" class="title">USV_0<?= $usv ?></a>
	<ul class="nav_L">
		<a href="index.html">主頁</a>
		<a href="bigmap.html">船隻匯總圖</a>
	</ul>
	<ul class="nav_R">
		<a href="index.html">
			<i class="fa fa-cog w3-xlarge" style="line-height:42px;"></i>
		</a>
		<a href="index.html">
			<i class="fa fa-pencil-square-o w3-xlarge" style="line-height:42px;"></i>
		</a>
	</ul>
</div>



<!--Side Navbar-->
<ul class="sidenav sidenav-fixed">
    <a href="select.html" class="a">
		手動
    </a>
    <a href="select.html" class="a">
		自動
    </a>    
    <a href="select.html" class="a">
		數據
    </a>
</ul>

<div class="container">

<!--map-->
<div id="map" class="map"></div>

<!--sensor image-->
<div class="USV_img">
	<img src="img/USV.png" id="boatpic" width="150" height="80">
	<div id="lefttop"></div>
	<div id="righttop"></div>
	<div id="leftdown"></div>
	<div id="rightdown"></div>		
</div>


<!--USV images-->
<div class="hugeimage">
	<div id="frame1">
		<img id="camera1" src="images/frame0.jpg" alt="Please check your connection"/>
	</div>
</div>
<div class="images">
	<div id="frame2">
		<img id="camera2" src="images/frame1.jpg" alt="Please check your connection"/>
	</div>
	<div id="frame3">
		<img id="camera3" src="images/frame2.jpg" alt="Please check your connection"/>
	</div>
	<div id="frame4">
		<img id="camera4" src="images/frame0.jpg" alt="Please check your connection"/>
	</div>
</div>


<div class="control_panel">
	<div class="sensor_value">
		<div class="sensor">
			<i class="fa fa-tachometer w3-large""></i><span class="value" id="sensor1" style="margin-left:5px">Speed: 10.5km/h</span>
		</div>
		<div class="sensor">
			<i class="fa fa-cog w3-large""></i><span class="value" id="sensor2" style="margin-left:5px">?????: 19cm</span>
		</div>
		<div class="sensor">
			<i class="fa fa-cog w3-large""></i><span class="value" id="sensor3" style="margin-left:5px">????? 80.9cm</span>
		</div>
		<div class="sensor">
			<i class="fa fa-cog w3-large""></i><span class="value" id="sensor4" style="margin-left:5px">????: 98cm</span>
		</div>
		<div class="sensor">
			<i class="fa fa-compass w3-large""></i><span class="value" id="gpsX" style="margin-left:5px">X1: 105.98</span>
		</div>
		<div class="sensor">
			<i class="fa fa-compass w3-large""></i><span class="value" id="gpsY" style="margin-left:5px">Y1: 190.96</span>
		</div>
	</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
var light = false;
var alarm = false;
var speaker = false;
var start = false;
var stop = false;
var _frame1 = document.getElementById("camera1");
var _frame2 = document.getElementById("camera2");
var _frame3 = document.getElementById("camera3");
var _frame4 = document.getElementById("camera4");
var _usv = "<?= $usv ?>";
var _route = "<?= $route ?>";

function refresh(){
	_frame1.src = "images/frame<?= $_frame1 ?>.jpg?r=" + Math.random();
	_frame2.src = "images/frame<?= $_frame2 ?>.jpg?r=" + Math.random();
	_frame3.src = "images/frame<?= $_frame3 ?>.jpg?r=" + Math.random();
	_frame3.src = "images/frame<?= $_frame4 ?>.jpg?r=" + Math.random();
}
setInterval(refresh(), 10000);
</script>
<!--
function onclick_light(event) {
	light = !light;
	$.ajax(
    {
    url: 'USV_UI_update.php',
    method: 'GET',
    data: {light: light, alarm: alarm, speaker: speaker, start: start, stop: stop},
    async: false,
    complete: function (response) 
        {
        console.log('light:', light, 'alarm:', alarm, 'speaker:', speaker, 'start:', start, 'stop:', stop);
        console.log(response);
        }
    });
}
function onclick_alarm(event) {
	alarm = !alarm;
	$.ajax(
    {
    url: 'USV_UI_update.php',
    method: 'GET',
    data: {light: light, alarm: alarm, speaker: speaker, start: start, stop: stop},
    async: false,
    complete: function (response) 
        {
        console.log('light:', light, 'alarm:', alarm, 'speaker:', speaker, 'start:', start, 'stop:', stop);
        console.log(response);
        }
    });
}
function onclick_speaker(event) {
	spaeker = !speaker;
	$.ajax(
    {
    url: 'USV_UI_update.php',
    method: 'GET',
    data: {light: light, alarm: alarm, speaker: speaker, start: start, stop: stop},
    async: false,
    complete: function (response) 
        {
        console.log('light:', light, 'alarm:', alarm, 'speaker:', speaker, 'start:', start, 'stop:', stop);
        console.log(response);
        }
    });
}
function onclick_start(event) {
	start = !start;
	$.ajax(
    {
    url: 'USV_UI_update.php',
    method: 'GET',
    data: {light: light, alarm: alarm, speaker: speaker, start: start, stop: stop},
    async: false,
    complete: function (response) 
        {
        console.log('light:', light, 'alarm:', alarm, 'speaker:', speaker, 'start:', start, 'stop:', stop);
        console.log(response);
        }
    });
}
function onclick_stop(event) {
	stop = !stop;
	$.ajax(
    {
    url: 'USV_UI_update.php',
    method: 'GET',
    data: {light: light, alarm: alarm, speaker: speaker, start: start, stop: stop},
    async: false,
    complete: function (response) 
        {
        console.log('light:', light, 'alarm:', alarm, 'speaker:', speaker, 'start:', start, 'stop:', stop);
        console.log(response);
        }
    });
}
-->






<!--Map JS-->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhbAmq1dAL56A7dQZOyGWa9ceM_3XrzMM&callback=initMap"></script>
<script>
	var _ultra1 = 0;
	var _ultra2 = 0;
	var _ultra3 = 0;
	var _ultra4 = 0;
	var _ultra5 = 0;
	var _ultra6 = 0;

	var _map = null;
	var _defaultZoom = 17;
	
	var _serverCenter = {lat: 22.202, lng: 113.559};
	var _serverPoint = null;
	var _clientCenter = {lat: 22.202, lng: 113.559};
	var _clientPoint = {lat: 22.202, lng: 113.559};
	var _currentTarget = 0;
	
	var _serverPointColor = '#0000FF';
	var _clientPointColor = '#00FFFF';
	var _normalPointColor = '#FF6666';
	var _targetPointColor = '#FF0000';
	var _finishedPointColor = '#666666';
	
	var _pointList = [];
	var _lineList = [];
	
	var infowindow = null; 
	var displayIndex = 0;
	var _groupIndex = 0;
	var _from = '<?= $from ?>';
	var _to = '<?= $to ?>';
	function initMap() {
		var styledMapType = new google.maps.StyledMapType(
		[
			{
			"elementType": "geometry",
			"stylers": [
			  {
				"color": "#ebe3cd"
			  }
			]
			},
			{
			"elementType": "labels.text.fill",
			"stylers": [
			  {
				"color": "#523735"
			  }
			]
			},
			{
			"elementType": "labels.text.stroke",
			"stylers": [
			  {
				"color": "#f5f1e6"
			  }
			]
			},
			{
			"featureType": "administrative",
			"elementType": "geometry.stroke",
			"stylers": [
			  {
				"color": "#c9b2a6"
			  }
			]
			},
			{
			"featureType": "administrative.land_parcel",
			"elementType": "geometry.stroke",
			"stylers": [
			  {
				"color": "#dcd2be"
			  }
			]
			},
			{
			"featureType": "administrative.land_parcel",
			"elementType": "labels.text.fill",
			"stylers": [
			  {
				"color": "#ae9e90"
			  }
			]
			},
			{
			"featureType": "landscape.natural",
			"elementType": "geometry",
			"stylers": [
			  {
				"color": "#dfd2ae"
			  }
			]
			},
			{
			"featureType": "poi",
			"stylers": [
			  {
				"visibility": "off"
			  }
			]
			},
			{
			"featureType": "poi",
			"elementType": "geometry",
			"stylers": [
			  {
				"color": "#dfd2ae"
			  }
			]
			},
			{
			"featureType": "poi",
			"elementType": "labels.text.fill",
			"stylers": [
			  {
				"color": "#93817c"
			  }
			]
			},
			{
			"featureType": "poi.park",
			"stylers": [
			  {
				"visibility": "off"
			  }
			]
			},
			{
			"featureType": "poi.park",
			"elementType": "geometry.fill",
			"stylers": [
			  {
				"color": "#a5b076"
			  }
			]
			},
			{
			"featureType": "poi.park",
			"elementType": "labels.text.fill",
			"stylers": [
			  {
				"color": "#447530"
			  }
			]
			},
			{
			"featureType": "road",
			"elementType": "geometry",
			"stylers": [
			  {
				"color": "#f5f1e6"
			  }
			]
			},
			{
			"featureType": "road.arterial",
			"elementType": "geometry",
			"stylers": [
			  {
				"color": "#fdfcf8"
			  }
			]
			},
			{
			"featureType": "road.highway",
			"elementType": "geometry",
			"stylers": [
			  {
				"color": "#f8c967"
			  }
			]
			},
			{
			"featureType": "road.highway",
			"elementType": "geometry.stroke",
			"stylers": [
			  {
				"color": "#e9bc62"
			  }
			]
			},
			{
			"featureType": "road.highway.controlled_access",
			"elementType": "geometry",
			"stylers": [
			  {
				"color": "#e98d58"
			  }
			]
			},
			{
			"featureType": "road.highway.controlled_access",
			"elementType": "geometry.stroke",
			"stylers": [
			  {
				"color": "#db8555"
			  }
			]
			},
			{
			"featureType": "road.local",
			"elementType": "labels.text.fill",
			"stylers": [
			  {
				"color": "#806b63"
			  }
			]
			},
			{
			"featureType": "transit",
			"stylers": [
			  {
				"visibility": "off"
			  }
			]
			},
			{
			"featureType": "transit.line",
			"elementType": "geometry",
			"stylers": [
			  {
				"color": "#dfd2ae"
			  }
			]
			},
			{
			"featureType": "transit.line",
			"elementType": "labels.text.fill",
			"stylers": [
			  {
				"color": "#8f7d77"
			  }
			]
			},
			{
			"featureType": "transit.line",
			"elementType": "labels.text.stroke",
			"stylers": [
			  {
				"color": "#ebe3cd"
			  }
			]
			},
			{
			"featureType": "transit.station",
			"elementType": "geometry",
			"stylers": [
			  {
				"color": "#dfd2ae"
			  }
			]
			},
			{
			"featureType": "water",
			"elementType": "geometry.fill",
			"stylers": [
			  {
				"color": "#b9d3c2"
			  }
			]
			},
			{
			"featureType": "water",
			"elementType": "labels.text.fill",
			"stylers": [
			  {
				"color": "#92998d"
			  }
			]
			}
		],
		{name: 'Styled Map'});

        _map = new google.maps.Map(document.getElementById('map'), {
			center: _serverCenter,
			zoom: _defaultZoom,
			mapTypeControlOptions: {mapTypeIds: []},
			disableDefaultUI: true,
			zoomControl: true,
			mapTypeControl: false,
			scaleControl: true,
			streetViewControl: false,
			rotateControl: true,
			fullscreenControl: true
        });
		_map.mapTypes.set('styled_map', styledMapType);
		_map.setMapTypeId('styled_map');
		
		console.log(_clientCenter);
		//drawCircle(_map, _clientCenter, 10, _clientPointColor, _clientPointColor);
		setTimeout(refresh, 1000);
	}
	function refresh() {
		return;
		$.ajax(
		{
			url: 'USV_GPS_get.php',
			method: 'GET',
			data: {},
			complete: function (response) 
			{
				var X = response.responseJSON[6]['value'];
				var Y = response.responseJSON[7]['value'];
				_clientCenter = {lat: parseFloat(X), lng: parseFloat(Y)};
				_clientPoint = {lat: parseFloat(X), lng: parseFloat(Y)};
				document.getElementById("gpsX").innerHTML = 'GpsX: '+ X;
				document.getElementById("gpsY").innerHTML = 'GpsY: '+ Y;
				console.log(_clientCenter);
				drawCircle(_map, _clientCenter, 40, _clientPointColor, _clientPointColor);
				setTimeout(refresh, 1000);
			}
		});
	}
	function removeAllPoints() {
		for (var i = 0; i < _pointList.length; i++) {
			_pointList[i].setMap(null);
		}
		_pointList = [];
	}
	
	function drawCircle(map, center, radius, strokeColor, fillColor, isSearchPoint = false) {
		var circle = new google.maps.Circle({
			strokeColor: strokeColor,
			strokeOpacity: 0.8,
			strokeWeight: 1,
			fillColor: fillColor,
			fillOpacity: 0.5,
			map: map,
			center: center,
			radius: radius,
			draggable: isSearchPoint,
			zIndex: 100
		});
		
		if (isSearchPoint) {
			circle.addListener('drag', function(e) {
				_serverCenter = {lat: e.latLng.lat(), lng: e.latLng.lng()};
				redrawLines(map, _lineList, _pointList);
			});
			
			circle.addListener('rightclick', function(e) {
				for (var i = 1; i < _pointList.length; i++) {
					if (_pointList[i] == this) {
						_pointList.splice(i, 1);
						this.setMap(null);
						redrawLines(map);
						break;
					}
				}
			});
		}
		
		circle.addListener('click', function(e) {
			console.log('click');
			infowindow.setPosition(e.latLng);
			infowindow.open(map);
			console.log(circle.data);
			html = '';
			if (displayIndex == 0 || displayIndex == 1)
				html += '<p>temp: ' + circle.data.temp + '</p>';
			if (displayIndex == 0 || displayIndex == 2)
			html += '<p>pH: ' + circle.data.pH + '</p>';
			if (displayIndex == 0 || displayIndex == 3)
				html += '<p>DO: ' + circle.data.do + '</p>';
			if (displayIndex == 0 || displayIndex == 4)
				html += '<p>Conduct: ' + circle.data.conduct + '</p>';
			infowindow.setContent(html);
		});
		
		return circle;
	}
	
	function drawLine(map, p1, p2) {
		var line = new google.maps.Polyline({
			path: [p1, p2],
			geodesic: true,
			strokeColor: _normalPointColor,
			strokeOpacity: 1.0,
			strokeWeight: 1
		});
		
		line.addListener('rightclick', function(e) {
			console.log(e);
			for (var i = 0; i < _lineList.length; i++) {
				if (_lineList[i] == this) {
					newPoint = {lat: e.latLng.lat(), lng: e.latLng.lng()};
					radius = 10;
					color = _normalPointColor;

					var circle = drawCircle(map, newPoint, radius, color, color, true);
					_pointList.splice(i + 1, 0, circle);
					break;
				}
			}
		});

		line.setMap(map);
		return line;
	}
	
	function redrawLines(map) {
		for (var i = 0; i < _lineList.length; i++) {
			_lineList[i].setMap(null);
		}
		_lineList = [];
		
		for (var i = 0; i < _pointList.length - 1; i++) {
			var line = drawLine(map, _pointList[i].center, _pointList[i + 1].center);
			_lineList.push(line);
		}
	}
	
	function renewTargetPointColor() {
		isFound = false;
		for (var i = 0; i < _pointList.length; i++) {
			if (i == _currentTarget) {
				_pointList[i].setOptions({
					fillColor: _targetPointColor,
					strokeColor: _targetPointColor
				});
				isFound = true;
				
				for (var j = 0; j < _lineList.length; j++) {
					var color = _normalPointColor;
					if (j < i) {
						color = _finishedPointColor;
					}
					_lineList[j].setOptions({
						strokeColor: color,
					});
				}
			} else {
				if (isFound) {
					_pointList[i].setOptions({
						fillColor: _normalPointColor,
						strokeColor: _normalPointColor
					});
				} else {
					_pointList[i].setOptions({
						fillColor: _finishedPointColor,
						strokeColor: _finishedPointColor
					});
				}
				
			}
		}
	}
</script>





<!--joystick JS-->
<script type="text/html" id="joystick-view">
<canvas id="joystickCanvas" width="<%= squareSize %>" height="<%= squareSize %>" style="width: <%= squareSize %>px; height: <%= squareSize %>px;">
</canvas>
</script>



<script type="text/javascript">
var _x = 0;
var _y = 0;
var _L = 0;
var _R = 0;
var stat = true;
$(document).ready(function(){
    var joystickView = new JoystickView(150, function(callbackView){
        $("#joystickContent").append(callbackView.render().el);
        setTimeout(function(){
            callbackView.renderSprite();
        }, 0);
    });
    joystickView.bind("verticalMove", function(y){
        $("#yVal").html(y);
        _y = y
        
    });
    joystickView.bind("horizontalMove", function(x){
        $("#xVal").html(x);
        _x = x
    });

});

</script>

</body>
</html>
<?php } ?>



