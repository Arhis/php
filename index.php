<form action = "index.php" method = "GET">
	Your text:<input type = "text" name = "string" >
	<input type = "submit" value = "Submit">
</form>

<?php

if (isset($_GET['string']) && !empty($_GET['string'])){
		$string = $_GET['string'];
}	else {
		echo 'String is empty';
	}

function find_string () {
	global $string;
	$offset = 0;
	$find = 'is';
	$find_length = strlen($find);
	while ($string_position = strpos($string, $find, $offset)){
		$positions[] = $string_position;
		$offset = $string_position + $find_length;
	}
	if ($positions)
		return $positions;
}

function replace_string ($positions) {
	global $string;
	if ($positions){
		foreach ($positions as $item)
			$string = substr_replace($string, 'as', $item, 2);
	}	else {
		echo 'Matching not found';
	}

	echo '</br></br>'.$string;
}

replace_string(find_string());

?>