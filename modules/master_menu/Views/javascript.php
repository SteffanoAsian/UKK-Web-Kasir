<script type="text/javascript">
    $(() => {
        loadTable()
    })

    loadTable = () => {
        HELPER.initTable({
            el: "table-menu",
            url: BASE_URL + '/master_menu',
            searchAble: true,
            destroyAble: true,
            responsive: true,
            autoWidth: true,
            index: 1,
            sorting: 'asc',
            columnDefs: [{
                    targets: 1,
                    orderable: true,
                    render: function(data, type, full, meta) {
                        return full['master_menu_nama'];
                    },
                },
                {
                    targets: 2,
                    orderable: true,
                    render: function(data, type, full, meta) {
                        return full['master_jenis_nama'];
                    },
                },
                {
                    targets: 3,
                    orderable: true,
                    render: function(data, type, full, meta) {
                        return full['master_jenis_harga'];
                    },
                },
                {
                    targets: 4,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var button = ''
                        var dropdown = ''
                        button += `<li class="nav-item"><a href="javascript:void(0);" class="nav-link text-hover-success" onclick="onEdit('` + full['master_menu_id'] + `')"><i class="nav-icon fa fa-pen"></i><span class="nav-text text-hover-primary">Edit</span></a></li>`
                        button += `<li class="nav-item"><a href="javascript:void(0);" class="nav-link text-hover-danger" onclick="onDelete('` + full['master_menu_id'] + `')"><i class="nav-icon fa fa-trash"></i><span class="nav-text text-hover-danger">Delete</span></a></li>`
                        dropdown = `<div class="dropdown dropdown-inline">
											<a href="javascript:void(0);" class="btn btn-sm btn-info btn-circle btn-icon" data-toggle="dropdown">
													<i class="fa fa-cog"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
												<ul class="nav nav-hoverable flex-column">
													` + button + `
												</ul>
											</div>
										</div>`
                        return dropdown
                    },
                },
            ],
        });
    }
</script>