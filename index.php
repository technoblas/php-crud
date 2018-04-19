<?php 

include 'header.php'; 
include 'models/Student.php';

$studentModel = new Student();
$students = $studentModel->all();
?>

<ul class="breadcrumb">
	<li><a href="index.php">Students</a></li>
	<li><a href="#">List</a></li>
</ul>

<div id="students" class="table-responsive">
	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th>Id</th>
				<th>Student Number</th> 
				<th>First Name</th>
				<th>Last Name</th>
				<th>Section</th>
				<th>Created At</th>
				<th>Updated At</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($students as $student) { ?>
			<tr id="item<?php echo $student->id; ?>">
				<td><?php echo $student->id; ?></td>
				<td><?php echo strtoupper($student->student_number); ?></td> 
				<td><?php echo ucfirst($student->first_name); ?></td>
				<td><?php echo ucfirst($student->last_name); ?></td>
				<td><?php echo ucfirst($student->section_name); ?></td>
				<td><?php echo $student->created_at; ?></td>
				<td><?php echo $student->updated_at; ?></td>
				<td>
					<a href="show.php?id=<?php echo $student->id; ?>" class="btn btn-default btn-xs">Show</a>
					<a href="edit.php?id=<?php echo $student->id; ?>" class="btn btn-success btn-xs">Edit</a>
					<button type="button" class="btn btn-danger btn-xs btn-delete" data-id="<?php echo $student->id; ?>" data-number="<?php echo strtoupper($student->student_number); ?>">Delete</button>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>

<?php include 'footer.php';