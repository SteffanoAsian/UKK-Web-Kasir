<script type="text/javascript">
	$(() => {
		logout = () => {
			$.ajax({
				url: BASE_URL + "/app-login/logout",
				type: "POST",
				processData: false,
				contentType: false,
				complete: function(response) {
					window.location.reload();
				}
			})
		}
	});
</script>