<?php 

include 'header.php'; 
include 'models/Student.php';

$id = $_GET['id'] ?? 0;

$studentModel = new Student();
$student = $studentModel->find($id);

if (!$student) {
	header('location: index.php');
}
?>

<ul class="breadcrumb">
	<li><a href="index.php">Students</a></li>
	<li><a href="#">Details</a></li>
</ul>

<table class="table table-hover table-striped">
	<tr>
		<th>Id</th>
		<td><?php echo $student->id; ?></td>
	</tr>
	<tr>
		<th>Student Number</th>
		<td><?php echo strtoupper($student->student_number); ?></td> 
	</tr>
	<tr>
		<th>First Name</th>
		<td><?php echo ucfirst($student->first_name); ?></td>
	</tr>
	<tr>
		<th>Last Name</th>
		<td><?php echo ucfirst($student->last_name); ?></td>
	</tr>
	<tr>
		<th>Section</th>
		<td><?php echo ucfirst($student->section_name); ?></td>
	</tr>
	<tr>
		<th>Created At</th>
		<td><?php echo $student->created_at; ?></td>
	</tr>
	<tr>
		<th>Updated At</th>
		<td><?php echo $student->updated_at; ?></td>
	</tr>
</table>
<a href="edit.php?id=<?php echo $student->id; ?>" class="btn btn-success">Edit</a>

<?php include 'footer.php';