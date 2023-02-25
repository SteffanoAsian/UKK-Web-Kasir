<script type="text/javascript">
	$(() => {
		HELPER.set_role_access(<?= $rules ?>)
		// console.log(HELPER.get_role_access('dashboard-Table'));
	});

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
</script>