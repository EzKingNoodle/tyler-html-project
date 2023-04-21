<?php

session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        $link = "https";
        else $link = "http";
          
        // Here append the common URL characters.
        $link .= "://";
          
        // Append the host(domain name, ip) to the URL.
        $link .= $_SERVER['HTTP_HOST'];
          
        // Append the requested resource location to the URL
        $link .= $_SERVER['REQUEST_URI'];
        $url_components = parse_url($link);
 
        // Use parse_str() function to parse the
        // string passed via URL
        parse_str($url_components['query'], $params);
            
        // Display result
        $annmt = $params['aID'];

        $query = "select announcement from announcements where announceID = '$annmt'";
        $result = mysqli_query($con, $query);

        $row = mysqli_fetch_array($result, MYSQLI_NUM);
        printf ("%s (%s)\n", $row[0], $row[0]);


?>

<!DOCTYPE html>
<html>
<style>
	.header {
		color: darkcyan;
		text-align: center;
		background-color: gainsboro;
		margin: 0;
		/*this does not seem to do anythng to get rid of the black gap at the top...*/
	}

	body {
		background-color:black;
		color: white;
	}

	iframe {
		margin: auto;
		width: 100%;
		height: 700px;
		overflow: hidden;
		gap: 1000px;
		
		/*this gap does not work for some reason, needs further inspection*/
	}

	html {
		scroll-behavior: smooth;
	}

	.myButton {
		color: rgb(255, 255, 255);
		font-size: 16px;
		line-height: 16px;
		padding: 6px;
		border-radius: 10px;
		font-family: Georgia, serif;
		font-weight: normal;
		text-decoration: none;
		font-style: normal;
		font-variant: normal;
		text-transform: none;
		background-image: linear-gradient(to right, rgb(28, 110, 164) 0%, rgb(35, 136, 203) 50%, rgb(20, 78, 117) 100%);
		box-shadow: rgb(0, 0, 0) 5px 5px 15px 5px;
		border: 2px solid rgb(28, 110, 164);
		display: inline-block;
	}

	.myButton:hover {
		background: #1C6EA4;
	}

	.myButton:active {
		background: #144E75;
	}

	aside {
		text-align: right;
		color: white;

	}

	table {
		border: 1px solid;
		border-color: white;
		border-collapse: collapse;
		width: 50%;
		margin-bottom: 20px;
		
	}

	th {
		border: 1px solid;
		border-collapse: collapse;
		height: 25px;
		background: red;
		text-decoration-color: whitesmoke;
	}

	td {
		border: 1px solid;
		border-color: white;
		border-collapse: collapse;
		height: 25px;
		background-color: black;
	}
</style>

<script> 
	function myFunction() {
	  var d = new Date();
	  d = Date("Jun 23 2017 07:45:00 GMT+0100 (Tokyo Time)");
      /*var number = "123"; in case of a test*/
      document.getElementById("myText").innerHTML = d;
    }
</script>

<div class = header>
<head>
	<title>Tyler-epic-games</title>
	<h1>Tyler's Epic Games >:)</h1>
	<p1> This is a test...</p1>
</head>
</div>
<aside>
	
	
</aside>

<body onload = "myFunction()">
	<span id="myText"> </span>
	<div id=frame>
		<p><iframe src=game1.php width=5000 height=750 scrolling=yes></iframe></p>
		<table style="float: right">
			<tbody>
				<tr>
					<th>Leaderboards</th>
				</tr>
				<tr>
					<td>1. <? $count ?> </td> 
				</tr>
				<tr>
					<td>2.</td>
				</tr>
				<tr>
					<td>3.</td>
				</tr>
				<tr>
					<td>4.</td>
				</tr>
				<tr>
					<td>5.</td>
				</tr>
				<tr>
					<td>6.</td>
				</tr>
				<tr>
					<td>7.</td>
				</tr>
				<tr>
					<td>8.</td>
				</tr>
				<tr>
					<td>9.</td>
				</tr>
				<tr>
					<td>10.</td>
				</tr>
		</table>

		<p><iframe src=game2.php width=7500 height=750 scrolling=yes align = middle></iframe></p>
		
	</div>
	drip 

</body>

</html>