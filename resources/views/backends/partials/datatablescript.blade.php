<style>
.dt-button-collection a.buttons-columnVisibility:before,
.dt-button-collection a.buttons-columnVisibility.active span:before {
	display:block;
	position:absolute;
	top:1.2em;
    left:0;
	width:15px;
	height:15px;
	box-sizing:border-box;
}

.dt-button-collection a.buttons-columnVisibility:before {
	content:' ';
	margin-top:-6px;
	margin-left:10px;
	/* border:1px solid black; */
    border:2px solid #546686;
	border-radius:3px;
}

.dt-button-collection a.buttons-columnVisibility.active span:before {
	content:'\2714';
	margin-top:-11px;
	margin-left:12px;
	text-align:center;
	text-shadow:1px 1px #DDD, -1px -1px #DDD, 1px -1px #DDD, -1px 1px #DDD;
}

.dt-button-collection a.buttons-columnVisibility span {
    margin-left:20px;
}
</style>
<script type="text/javascript">

$(document).ready(function() {
    var table = $('.basic-datatable');
    var title  = table.closest('.card').find('.table-card-header').find('h5').text();
    $('.basic-datatable').DataTable({
        responsive: true,
        dom : "<'row'<'col-sm-4'l><'col-sm-5 d-flex justify-content-center'B><'col-sm-3'f>>" +
                "<'row'tr>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        // buttons: ['colvis', 'csv', 'excel', 'pdf', 'print'],
        buttons: [
            {
                extend: 'colvis',
                text: '<i class="fa fa-eye"></i> Visible',
                className: 'btn btn-sm btn-inverse',
                exportOptions: {
                    columns: ':visible',
                },
                footer: true,
                autoPrint: true,
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> Print',
                header: 'false',
                title: '',
                className: 'btn btn-sm btn-inverse',
                exportOptions: {
                    stripHtml : false,
                    columns: ':visible',
                },
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '12pt' )
                        .prepend(
                            // '<div><img src="{{asset('/images/defaults/report_header_logo.jpg')}}" height="70px" width="80%"></div>' +
                            //     '<hr style="margin-top: 5px">'+
                            '<div style="text-align: left;"><h3> '+title+' </h3></div>'
                        );
                },

            },
            // {
            //     extend: 'pdf',
            //     text: '<i class="fa fa-file-pdf-o"></i> Pdf',
            //     className: 'btn btn-xs btn-outline btn-danger',
            //     title: $('h1').text(),
            //     exportOptions: {
            //         stripHtml : false,
            //         columns: ':visible',
            //     },
            //     customize: function ( win ) {
            //         $(win.document)
            //             .css( 'font-size', '12pt' )
            //             .prepend(
            //                 '<div><img src="{{asset('/images/defaults/report_header_logo.jpg')}}" height="70px" width="80%"></div>' +
            //                     '<hr style="margin-top: 5px">'+
            //                 '<div style="text-align: left;"><h3> '+title+' </h3></div>'
            //             );
            //     },
            //     footer: true
            // },
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel-o"></i> Excel',
                className: 'btn btn-sm btn-inverse',
                title: title,
                decodeEntities: true,
                exportOptions: {
                    stripHtml : false,
                    columns: ':visible(:not(.not-excel-export-col))'
                },
                footer: true
            },
            // {
            //     extend: 'csv',
            //     text: '<i class="fa fa-file"></i> Csv',
            //     className: 'btn btn-xs btn-outline btn-info',
            //     title: $('h1').text(),
            //     exportOptions: {
            //         stripHtml : false,
            //         columns: ':visible',
            //     },
            //     footer: true
            // },

        ],
        colReorder: {
            realtime: true
        },
        stateSave: true,
        fixedHeader: true
    });
})

function adjustWidth() {
    $('input.filter-datatable').each(function (index, obj) {
        tdIndex = $(this).closest('th').index()+1;
        var $th = $('table tr:nth-child(1)').find('th:nth-child(' + tdIndex + ')');
        $(this).width($th.width());
    })
}

function loadDatatableWithColumns(table,columns){
    var source_data  = table.data('source');
    // alert(source_data);
    var title  = table.closest('.card').find('.table-card-header').find('h5').text();
    let thisTable = table.DataTable({
        "dom" : "<'row'<'col-sm-4'l><'col-sm-5'B><'col-sm-3'f>>" +
                "<'row'tr>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        // buttons: ['colvis', 'csv', 'excel', 'pdf', 'print'],
        buttons: [
            {
                extend: 'colvis',
                text: '<i class="fa fa-eye"></i> Visible',
                className: 'btn btn-xs btn-outline btn-primary',
                exportOptions: {
                    columns: ':visible',
                },
                footer: true,
                autoPrint: true,
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> Print',
                header: 'false',
                title: '',
                className: 'btn btn-xs btn-outline btn-success',
                exportOptions: {
                    stripHtml : false,
                    columns: ':visible',
                },
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '12pt' )
                        .prepend(
                            '<div><img src="{{asset('/images/defaults/report_header_logo.jpg')}}" height="70px" width="80%"></div>' +
                                '<hr style="margin-top: 5px">'+
                            '<div style="text-align: left;"><h3> '+title+' </h3></div>'
                        );
                },

            },
            // {
            //     extend: 'pdf',
            //     text: '<i class="fa fa-file-pdf-o"></i> Pdf',
            //     className: 'btn btn-xs btn-outline btn-danger',
            //     title: $('h1').text(),
            //     exportOptions: {
            //         stripHtml : false,
            //         columns: ':visible',
            //     },
            //     customize: function ( win ) {
            //         $(win.document)
            //             .css( 'font-size', '12pt' )
            //             .prepend(
            //                 '<div><img src="{{asset('/images/defaults/report_header_logo.jpg')}}" height="70px" width="80%"></div>' +
            //                     '<hr style="margin-top: 5px">'+
            //                 '<div style="text-align: left;"><h3> '+title+' </h3></div>'
            //             );
            //     },
            //     footer: true
            // },
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel-o"></i> Excel',
                className: 'btn btn-xs btn-outline btn-info',
                title: title,
                decodeEntities: true,
                exportOptions: {
                    columns: ':visible(:not(.not-excel-export-col))'
                },
                footer: true
            },
            // {
            //     extend: 'csv',
            //     text: '<i class="fa fa-file"></i> Csv',
            //     className: 'btn btn-xs btn-outline btn-info',
            //     title: $('h1').text(),
            //     exportOptions: {
            //         stripHtml : false,
            //         columns: ':visible',
            //     },
            //     footer: true
            // },

        ],
        bAutoWidth: false,
        // bSortCellsTop: false,
        orderCellsTop: true,
        fixedHeader: true,
        processing: true,
        serverSide: true,
        ajax: source_data,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        columns: columns,
        "footerCallback": function(row, data, start, end, display) {
            var api = this.api();

            api.columns('.datatableSum', { page: 'all' }).every(function () {
                var sum = api
                    .cells( null, this.index(), { page: 'all'} )
                    .render('display')
                    .reduce(function (a, b) {
                        var x = parseFloat(a) || 0;
                        var y = parseFloat(b) || 0;
                        return x + y;
                    }, 0);
                $(this.footer()).html(sum);
            });
        }
    });

    table.find('thead tr:eq(1) th').each( function (i) {
        $( 'input, select', this ).on( 'keyup change', function () {
            if ( thisTable.column(i).search() !== this.value ) {
                thisTable.column(i).search( this.value ).draw();
            }
        } );
    } );
}

$(document).ready(function(){
    $('.common-datatable').each(function(){
        loadDatatable($(this));
    });

    function loadDatatable(table){
        var source_data  = table.data('source');
        var title  = table.closest('.panel').find('.panel-title').find('a.accordion-toggle').text();
        let thisTable = table.DataTable({
            "dom": "<'row'<'col-sm-3'l><'col-sm-6'B><'col-sm-3'f>>" +
                "<'row'tr>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                {
                    extend: 'colvis',
                    text: '<i class="fa fa-eye"></i> Visible',
                    className: 'btn btn-xs btn-outline btn-primary',
                    exportOptions: {
                        columns: ':visible',
                    },
                    footer: true,
                    autoPrint: true,
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i> Print',
                    header: 'false',
                    title: '',
                    className: 'btn btn-xs btn-outline btn-success',
                    exportOptions: {
                        stripHtml : false,
                        columns: ':visible',
                    },
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '12pt' )
                            .prepend(
                                '<div><img src="{{asset('/images/defaults/report_header_logo.jpg')}}" height="70px" width="80%"></div>' +
                                    '<hr style="margin-top: 5px">'+
                                '<div style="text-align: left;"><h3> '+title+' </h3></div>'
                            );
                    },

                },
                // {
                //     extend: 'pdf',
                //     text: '<i class="fa fa-file-pdf-o"></i> Pdf',
                //     className: 'btn btn-xs btn-outline btn-danger',
                //     title: $('h1').text(),
                //     exportOptions: {
                //         stripHtml : false,
                //         columns: ':visible',
                //     },
                //     customize: function ( win ) {
                //         $(win.document)
                //             .css( 'font-size', '12pt' )
                //             .prepend(
                //                 '<div><img src="{{asset('/images/defaults/report_header_logo.jpg')}}" height="70px" width="80%"></div>' +
                //                     '<hr style="margin-top: 5px">'+
                //                 '<div style="text-align: left;"><h3> '+title+' </h3></div>'
                //             );
                //     },
                //     footer: true
                // },
                {
                    extend: 'excel',
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    className: 'btn btn-xs btn-outline btn-info',
                    title: title,
                    decodeEntities: true,
                    exportOptions: {
                        stripHtml : false,
                        // columns: ':visible',
                        columns: ':visible(:not(.not-excel-export-col))'
                    },
                    footer: true
                },
                // {
                //     extend: 'csv',
                //     text: '<i class="fa fa-file"></i> Csv',
                //     className: 'btn btn-xs btn-outline btn-info',
                //     title: $('h1').text(),
                //     exportOptions: {
                //         stripHtml : false,
                //         columns: ':visible',
                //     },
                //     footer: true
                // },

            ],
            bAutoWidth: false,
            orderCellsTop: true,
            fixedHeader: true,
            processing: true,
            serverSide: true,
            ajax: source_data,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            columns: columns,
        });
        // datatableButtons(thisTable,table.closest('.panel-body'));
        table.find('thead tr:eq(1) th').each( function (i) {
            $( 'input, select', this ).on( 'keyup change', function () {
                if ( thisTable.column(i).search() !== this.value ) {
                    thisTable.column(i).search( this.value ).draw();
                }
            } );
        } );
    }

})
</script>

