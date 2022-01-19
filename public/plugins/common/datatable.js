$(function () {
    /**
     * Add the data-method="delete" forms to all delete links
     */
    addDeleteForms();

    /**
     * This is for delete buttons that are loaded via AJAX in datatables, they will not work right
     * without this block of code
     */
    $(document).ajaxComplete(function () {
        addDeleteForms();
    });

    /**
     * Generic confirm form delete using Sweet Alert
     */
    $('body').on('submit', 'form[name=delete_item]', function (e) {
        e.preventDefault();
        var form = this;
        var link = $('a[data-method="delete"]');
        var cancel = (link.attr('data-trans-button-cancel')) ? link.attr('data-trans-button-cancel') : "Cancel";
        var confirm = (link.attr('data-trans-button-confirm')) ? link.attr('data-trans-button-confirm') : "Yes, delete";
        var title = (link.attr('data-trans-title')) ? link.attr('data-trans-title') : "Warning";
        var text = (link.attr('data-trans-text')) ? link.attr('data-trans-text') : "Are you sure you want to delete this item?";


        Swal.fire({
            title: title,
            type: "warning",
            showCancelButton: true,
            cancelButtonText: cancel,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: confirm,
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        })
    });

    //Users Management page
    var usersTable = $('#users_table');
    var usersTableUrl = usersTable.data('url');

    $('#users_table').DataTable({
        deferRender: true,
        select: {
            style: 'multi'
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: usersTableUrl,
            type: 'post',
            data: function (request) {
            }
        },
        columns: [
            {data: 'id', name: 'id', visible: true},
            {data: 'first_name', name: 'first_name', visible: true},
            {data: 'last_name', name: 'last_name', visible: true},
            {data: 'email', name: 'email', visible: true},
            {
                name: 'status',
                data: 'status',
                sortable: true,
                searchable: false,
                render: function (data) {
                    if (data == 1) {
                        return 'Active';
                    } else{
                        return 'Inactive';
                    }
                },
                visible: true
            },
            {
                name: 'type',
                data: 'type',
                sortable: true,
                searchable: false,
                render: function (data) {
                    if (data == 1) {
                        return 'Individual';
                    } else{
                        return 'Organisation';
                    }
                },
                visible: true
            },
            {data: 'roles', name: 'role.name', visible: true, searchable: false},
            {
                data: 'last_login',
                name: 'last_login',
                render: function (data) {
                    return  moment(data, "YYYY-MM-DD hh:mm A").format("YYYY-MM-DD hh:mm A");
                },
                visible: true},
            {
                data: 'created_at',
                name: 'created_at',
                render: function (data) {
                    return  moment(data, "YYYY-MM-DD hh:mm A").format("YYYY-MM-DD hh:mm A");
                },
                visible: true},
            {data: 'signup_source', name: 'signup_source', visible: true},
            {data: 'actions', name: 'actions', searchable: false, sortable: false}
        ],
        order: [
            [0, "desc"]
        ],
        searchDelay: 500,
        initComplete: function () {
        }
    });


    //Role Management Page
    var roleTable = $('#roles_table');
    var roleTableTableUrl = roleTable.data('url');

    roleTable.DataTable({
        deferRender: true,
        select: {
            style: 'multi'
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: roleTableTableUrl,
            type: 'post',
            data: function (request) {

            }
        },
        columns: [
            {data: 'name', name: 'name'},
            {data: 'permissions', name: 'permissions.display_name', sortable: false},
            {data: 'users', name: 'users', searchable: false, sortable: false},
            {data: 'sort', name: 'sort', sortable: false},
            {data: 'actions', name: 'actions', searchable: false, sortable: false}
        ],
        order: [
            [0, "desc"]
        ],
        searchDelay: 500,
        initComplete: function () {
        }
    });


     //Limit Reservation
    var limitReservationTable = $('#limit_reservation_table');
    var limitReservationTableUrl = limitReservationTable.data('url');

    limitReservationTable.DataTable({
        deferRender: true,
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: limitReservationTableUrl,
            type: 'post',
            data: function (request) {
                request.status = 1;
                request.trashed = false;

            }
        },
        columns: [
            {data: 'id', name: 'id', visible: true},
            {data: 'date', name: 'date',
                sortable: true,
                searchable: false,
                render: function (data, type, row) {
                    return moment(data, "YYYY-MM-DD").format("YYYY-MM-DD");
                },
                visible: true},
            {data: 'count', name: 'count', visible: true},
            {data: 'action', name: 'action', searchable: false, sortable: false, visible: true},
        ],
        order: [
            [0, "desc"]
        ],
        searchDelay: 500,
        rowCallback: function (row, data, index) {

        },
        initComplete: function () {
        }
    });
})

function addDeleteForms() {
    $('[data-method]').append(function () {
        if (!$(this).find('form').length > 0)
            return "\n" +
                "<form action='" + $(this).attr('href') + "' method='POST' name='delete_item' style='display:none'>\n" +
                "   <input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n" +
                "   <input type='hidden' name='_token' value='" + $('meta[name="csrf-token"]').attr('content') + "'>\n" +
                "</form>\n";
        else
            return "";
    })
        .removeAttr('href')
        .attr('style', 'cursor:pointer;')
        .attr('onclick', '$(this).find("form").submit();');
}
