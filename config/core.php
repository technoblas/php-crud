<?php

// show error reporting
error_reporting(E_ALL);

// set your default time-zone
date_default_timezone_set('Asia/Manila');

// send json
function sendJsonResponse($message, $status = 200)
{
	echo json_encode(['message' => $message, 'status' => $status]);
	exit;
}
