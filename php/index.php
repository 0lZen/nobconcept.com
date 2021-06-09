<?php
error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');
$upload_handler = new UploadHandler(array(
	'max_file_size' => 12000000,
	'accept_file_types' => '/\.(doc|docx|txt|rtf|pdf|odt|xlsx|xls|ods|csv|rar|zip|7z|tar|tz|gz|ace|arj|r00|r01)$/i'
));
