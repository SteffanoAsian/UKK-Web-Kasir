<script type="text/javascript">
	$(() => {
		onLogin = () => {
			var formData = new FormData($('#form-Login')[0]);
			$.ajax({
				url: BASE_URL + "/app-login/doLogin",
				data: formData,
				type: "POST",
				processData: false,
				contentType: false,
				complete: function(response) {
					var response = $.parseJSON(response.responseText);
					if (response.success) {
						console.log(response);
						window.location.reload();
					} else {
						// HELPER.unblock()
						Swal.fire({
	                        title: "Failed",
	                        html: response.message,
	                        icon: "error",
	                        allowOutsideClick: false,
	                    })
					}
				}
			})
		}
	});
</script>