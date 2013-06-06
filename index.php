<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.1.0/pure-min.css">
</head>
<body>
	<!-- TODO: move styles to own file. -->
<div class="pure-g" style="margin: 0 auto; width: 960px;">
	<div class="pure-u-1">
<?php 
include('lib/database.php');
include('lib/form.php');

$form_input = new Form('post', '','Testing form', false, true);
$form_input->input('name');
$form_input->input('date_of_birth', 'Date of Birth');
$form_input->input_password('password');
$form_input->input_password('password_again');
$form_input->checkbox('terms', 'Do you agree with the terms?');
$form_input->button('Sign in', 'submit');
echo $form_input->generate(false);

$recept_form = new Form('post', $_SERVER['PHP_SELF'], 'Pridaj novy recept', false, true);
$recept_form->input('recept');
$recept_form->input('time', 'Cas pripravy');
$recept_form->button('Pridaj recept', 'submit');
echo $recept_form->generate(false);

$db = new Database('localhost', 'varime', '', 'varime');
$db->connect();

if (isset($_POST['recept'])) {
	$data = array('id' => null, 'recept' => $_POST['recept'], 'time' => $_POST['time']);
	unset($_POST['recept']);
	if ($db->insert('test', $data)) {
	}
	header("Location: ".$_SERVER['PHP_SELF']);
}

echo "<table class='pure-table'>";
echo "<thead><tr><td>id</td><td>recept</td><td>time</td></tr><thead><tbody>";
foreach ($db->all('test') as $row) {
	echo "<tr>";
		echo "<td>".$row['id']."</td><td>".$row['recept']."</td><td>".$row['time']." min</td>";
	echo "</tr>";
}
echo "</tbody></table>";

unset($db);
 ?>
	 </div>
 </div>
</body>
</html>