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
                        button += `<a href="javascript:void(0);" class="text-hover-success dropdown-item" onclick="onEdit('` + full['master_menu_id'] + `')"><i class="nav-icon fa fa-pen"></i><span class="nav-text text-hover-primary">Edit</span></a>`
                        button += `<a href="javascript:void(0);" class="text-hover-danger dropdown-item" onclick="onDelete('` + full['master_menu_id'] + `')"><i class="nav-icon fa fa-trash"></i><span class="nav-text text-hover-danger">Delete</span></a>`
                        dropdown += `
                                        <a class="btn btn-sm btn-info btn-circle btn-icon" href="javascript:void(0)" onclick="alert('p')">
                                            <i class="fa fa-cog"></i>
                                        </a>`
                                        
                        return dropdown
                    },
                },
            ],
        });
    }
</script>