
$(document).ready(function () {
    //approve
    $(document).on('click', '.btn-approve', function (event) {
        var form = $(this).closest("form");
        event.preventDefault();

        Swal.fire({
            title: "Do you want to ApproveThis Record?",
            icon: "question",
            // showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Approve"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit()
                Swal.fire({
                    title: 'Approved',
                    icon: 'success',
                    text: 'Your recorded successfully Approved'
                })
            }
        })
    });
    //  deactivate
    $(document).on('click', '.btn-deactive', function (event) {
        var form = $(this).closest("form");
        event.preventDefault();
        Swal.fire({
            title: "Do you want to De-Approve This Record?",
            icon: "question",
            // showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Un-approve"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit()
                Swal.fire({
                    title: 'De-Approved',
                    icon: 'success',
                    text: 'Your recorded successfully Un-approved'
                })
            }
        })
    });

    //  archive
    $(document).on('click', '.btn-softdelete', function (event) {
        var form = $(this).closest("form");
        event.preventDefault();
        Swal.fire({
            title: "Do you want to Archive This Record?",
            icon: "warning",
            // showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Archive"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit()
                Swal.fire({
                    title: 'Archived',
                    icon: 'success',
                    text: 'Your recorded successfully Archived'
                })
            }
        })
    });
    // delete
    $(document).on('click', '.btn-delete', function (event) {
        var form = $(this).closest("form");
        event.preventDefault();
         Swal.fire({
            title: "Do you want to Delete This Record?",
            icon: "warning",
            // showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Delete"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit()
                Swal.fire({
                    title: 'Delete',
                    icon: 'error',
                    text: 'Your recorded successfully Deleted'
                })
            }
        })
    });

    // restore
    $(document).on('click', '.btn-restore', function (event) {
        var form = $(this).closest("form");
        event.preventDefault();
         Swal.fire({
            title: "Do you want to Restore This Record?",
            icon: "warning",
            // showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Restore"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit()
                Swal.fire({
                    title: 'Restore',
                    icon: 'success',
                    text: 'Your recorded successfully Restored'
                })
            }
        })
    });
});



