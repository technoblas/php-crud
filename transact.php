<?php

include 'config/core.php';
include 'models/Student.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('location: index.php');
}

$transType = filter_var($_POST['transType'], FILTER_SANITIZE_STRING);

switch ($transType) {
	case 'create':

		// get post data and sanitize and validate here
		$studentNumber = $_POST['studentNumber'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$sectionId = $_POST['sectionId'];

		$student = new Student();

		// check duplicates here
		$isUnique = $student->isUnique('student_number', $studentNumber);
		if (!$isUnique) {
			sendJsonResponse('Duplicate Student Number', 400);
		}

		$student->student_number = $studentNumber;
		$student->first_name = $firstName;
		$student->last_name = $lastName;
		$student->section_id = $sectionId;
		$result = $student->create();

		if ((int)$result <= 0) {
			sendJsonResponse('The request could not be completed', 400);
		}

		sendJsonResponse('New resource has been created', 201);

		break;

	case 'update':

		// get post data and sanitize and validate here
		$id = $_POST['id'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$sectionId = $_POST['sectionId'];

		$student = new Student();
		$exist = $student->find($id);

		if (!$exist) {
			sendJsonResponse('The requested resource could not be found', 404);
		}

		$student->id = $id;
		$student->first_name = $firstName;
		$student->last_name = $lastName;
		$student->section_id = $sectionId;
		$result = $student->update();

		if (!$result) {
			sendJsonResponse('The request could not be completed', 400);
		}

		sendJsonResponse('Resource has been updated');

		break;

	case 'destroy':
	
		$id = $_POST['id'];
		
		$student = new Student();
		$exist = $student->find($id);
		if (!$exist) {
			sendJsonResponse('The requested resource could not be found', 404);
		}

		$result = $student->destroy($id);

		if (!$result) {
			sendJsonResponse('The request could not be completed', 400);
		}

		sendJsonResponse('Resource has been deleted');

		break;
	
	default:
		header('location: index.php');
		break;
}