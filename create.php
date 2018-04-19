<?php 

include 'header.php'; 
include 'models/Student.php';
include 'models/Section.php';

$sectionModel = new Section();
$sections = $sectionModel->all();
?>

<ul class="breadcrumb">
	<li><a href="index.php">Students</a></li>
	<li><a href="#">Create</a></li>
</ul>

<form id="form-new">
	<div class="form-group">
		<label for="studentNumber">Student Number</label>
		<input type="text" id="studentNumber" name="studentNumber" class="form-control" value="" required>
	</div>
	<div class="form-group">
		<label for="firstName">First Name</label>
		<input type="text" id="firstName" name="firstName" class="form-control" value="" required>
	</div>
	<div class="form-group">
		<label for="lastName">Last Name</label>
		<input type="text" id="lastName" name="lastName" class="form-control" value="" required>
	</div>
	<div class="form-group">
		<label for="sectionId">Section</label>
		<select class="form-control" name="sectionId" id="sectionId">
			<?php foreach ($sections as $section) { ?>
			<option value="<?php echo $section->id ?>"><?php echo ucfirst($section->name) ?></option>
			<?php } ?>
		</select>
	</div>
	<button type="submit" class="btn btn-success">Save</button>
</form>

<?php include 'footer.php';