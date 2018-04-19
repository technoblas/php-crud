<?php 

include 'header.php'; 
include 'models/Student.php';
include 'models/Section.php';

$id = $_GET['id'] ?? 0;

$studentModel = new Student();
$student = $studentModel->find($id);


if (!$student) {
	header('location: index.php');
}

$sectionModel = new Section();
$sections = $sectionModel->all();
?>

<ul class="breadcrumb">
	<li><a href="index.php">Students</a></li>
	<li><a href="#">Edit</a></li>
</ul>

<form id="form-edit">
	<input type="hidden" name="id" id="id" value="<?php echo $student->id; ?>">
	<div class="form-group">
		<label for="studentNumber">Student Number</label>
		<input type="text" id="studentNumber" name="studentNumber" class="form-control" value="<?php echo strtoupper($student->student_number); ?>" readonly>
	</div>
	<div class="form-group">
		<label for="firstName">First Name</label>
		<input type="text" id="firstName" name="firstName" class="form-control" value="<?php echo ucfirst($student->first_name); ?>" required>
	</div>
	<div class="form-group">
		<label for="lastName">Last Name</label>
		<input type="text" id="lastName" name="lastName" class="form-control" value="<?php echo ucfirst($student->last_name); ?>" required>
	</div>
	<div class="form-group">
		<label for="sectionId">Section</label>
		<select class="form-control" name="sectionId" id="sectionId">
			<?php foreach ($sections as $section) { ?>
			<option value="<?php echo $section->id ?>" <?php echo ($section->id == $student->section_id) ? 'selected' : '' ?>><?php echo ucfirst($section->name) ?></option>
			<?php } ?>
		</select>
	</div>
	<button type="submit" class="btn btn-success">Save</button>
</form>

<?php include 'footer.php';