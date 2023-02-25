<script type="text/javascript">
	$(() => {
		onLogin = () => {
			var formData = new FormData($('#form-Login')[0]);
			HELPER.block()
			$.ajax({
				url: BASE_URL + "/app-login/doLogin",
				data: formData,
				type: "POST",
				processData: false,
				contentType: false,
				complete: function(response) {
					var response = $.parseJSON(response.responseText);
					if (response.success) {
						HELPER.unblock(500)
						window.location.reload();
					} else {
						HELPER.unblock(500)
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