<?php
$filename = time() . '_' . $_FILES['file']['name'];
move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $filename);
echo 'uploads/' . $filename;
die;