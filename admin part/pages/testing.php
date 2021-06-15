<HTML>
<body>
<form method="get">
Red<input type="checkbox" name="color[]" id="color" value="red">
Green<input type="checkbox" name="color[]" id="color" value="green">
Blue<input type="checkbox" name="color[]" id="color" value="blue">
Cyan<input type="checkbox" name="color[]" id="color" value="cyan">
Magenta<input type="checkbox" name="color[]" id="color" value="Magenta">
Yellow<input type="checkbox" name="color[]" id="color" value="yellow">
Black<input type="checkbox" name="color[]" id="color" value="black">
<input type="submit" value="submit">
</form>
</body>
</html>

<?php

$name = $_GET['color'];

if(isset($_GET['color'])) {

echo "You chose the following color(s): <br>";

foreach ($name as $color){
echo $color."<br />";

}

} // end brace for if(isset

else {

echo "You did not choose a color.";

}

?>