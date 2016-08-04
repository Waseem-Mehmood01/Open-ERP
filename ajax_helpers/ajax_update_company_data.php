<?php
require('../functions.php');
$name = $_POST['name']; // $_POST['name'] catches the data-name value

$pk= $_POST['pk']; // the pk(primary key) that you assigned

$value= $_POST['value'];
if(!empty($value)) {
   DB::Update(DB_PREFIX."companies",array(
						$name => $value
						),
						"company_id =%s", $pk);
} else {
    echo "This field is required!";
}

?>