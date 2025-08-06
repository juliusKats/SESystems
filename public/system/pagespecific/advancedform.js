$(function () {
    // Summernote
    $('#summernote').summernote()
    $('#summernote2').summernote()
    $('#summernote3').summernote("disable")
    $('#summernote4').summernote("disable")
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

    //Date range as a button
    var seldate =""
    $('#daterange-btn').daterangepicker(

        {
            locale: { format: 'DD/MM/YYYY' },
            drops: 'down',
            opens: 'right',
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'This Year': [moment().startOf('year'), moment()],
            },
            startDate: moment().subtract(29, 'days'),
            endDate: moment()
        },
        function (start, end) {
            $('#reportrange span').html(start.format('DD/MM/YYY') + ' - ' + end.format('DD/MM/YYY'))
        }

    )


})

