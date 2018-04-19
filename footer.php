</div> <!-- end of container -->

<!-- bootstrap JavaScript -->
<script src="public/js/jquery.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<script src="public/lib/bootbox/bootbox.min.js"></script>
<script src="public/lib/toastr/toastr.min.js"></script>

<!-- uhmp inline js here -->
<script type="text/javascript">

	// gritter notification
	const notify = function(message, type, timeOut = "3000") {
		message = (typeof message !== "object") ? [message] : message;
		type = type.toLowerCase();

		const title = (type == "success") ? "Success" : (type == "error") ? "Error" : "Message";

		toastr.options = {
			"closeButton": true,
			"debug": false,
			"newestOnTop": false,
			"progressBar": false,
			"positionClass": "toast-top-right",
			"preventDuplicates": false,
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": timeOut,
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		}

		$(message).each(function (index, value) {
			toastr[type]((typeof value == "undefined") ? "Server Error" : value, title);
		});

	};

	$(document).ready(function () {

		const endpointUrl = 'transact.php';
		
		$(document).on("submit", "#form-new", function (event) {
			event.preventDefault();

			const formData = $(this).serializeArray();
			const data = {};

			$(formData).each(function (index, obj) {
				data[obj.name] = obj.value;
			});

			data['transType'] = 'create';

			$.ajax({
				type: "POST",
				url: endpointUrl,
				data: data,
				success: function (response) {
					console.log(response)
					response = jQuery.parseJSON(response);

					if (response.status != 201) {
						return notify(response.message, "error");
					}

					notify(response.message, "success");
					$("#form-new")[0].reset();
				}
			});
		});

		$(document).on("submit", "#form-edit", function (event) {
			event.preventDefault();

			const formData = $(this).serializeArray();
			const data = {};

			$(formData).each(function (index, obj) {
				data[obj.name] = obj.value;
			});

			data['transType'] = 'update';

			$.ajax({
				type: "POST",
				url: endpointUrl,
				data: data,
				success: function (response) {
					response = jQuery.parseJSON(response);

					if (response.status != 200) {
						return notify(response.message, "error");
					}

					notify(response.message, "success");
				}
			});
		});

		$(document).on("click", ".btn-delete", function () {
			const id = $(this).attr("data-id");
			const number = $(this).attr("data-number");

			bootbox.confirm({
				title: "Delete Resource Item " +  number,
				message: "Are you sure you want to delete the selected item?",
				buttons: {
					confirm: {
						label: "Yes",
						className: "btn-success"
					},
					cancel: {
						label: "No",
						className: "btn-danger"
					}
				},
				callback: function (confirm) {
					if (confirm == true) {

						$.ajax({
							type: "POST",
							url: endpointUrl,
							data: { 
								id: id,
								transType: 'destroy'
							},
							success: function (response) {
								response = jQuery.parseJSON(response);

								if (response.status != 200) {
									return notify(response.message, "error");
								}

								notify(response.message, "success");
								$('#students tr[id=item' + id + ']').remove();
							}
						});
					}
				}
			});
		});

	});
</script>

</body>
</html>