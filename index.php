<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.1.0/pure-min.css">
</head>
<body>
	<!-- TODO: move styles to own file. -->
<div class="pure-g" style="margin: 0 auto; width: 640px;">
	<div class="pure-u-1">
<?php 
include('lib/database.php');
include('lib/form.php');

$form_input = new Form('post', '','Testing form', true);
$form_input->input('name');
$form_input->input('date_age', 'Date Age');
echo $form_input->generate();
 ?>
	 </div>
 </div>

</body>
</html>