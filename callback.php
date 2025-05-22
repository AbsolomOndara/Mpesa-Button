<?php
// Optional logging
$data = file_get_contents("php://input");
file_put_contents("mpesa_callback.json", $data); // For logging purpose
