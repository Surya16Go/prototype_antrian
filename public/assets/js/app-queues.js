/**
 * Queues
 */

'use strict';
$(function () {
  var dt_basic_table = $('.datatables-basic'),
    dt_basic;
  if (dt_basic_table.length) {
    dt_basic = dt_basic_table.DataTable({
      processing: true,
      serverSide: true,
      ajax: 'http://127.0.0.1:8000/' + 'queues',
      columns: [
        {data: 'id'},
        {data: 'number'},
        {data: 'request'},
        {data: 'status'},
        {data: 'action'},
      ],
      columnDefs: [
        {
          targets: 0,
          searchable: false,
          orderable: false,
          visible: false,
        },
        {
          targets: 1,
        },
        {
          targets: 3,
        },
        {
          searchable: false,
          orderable: false,
          targets: 4,
        },
      ],
      order: [[1, 'asc']],
      dom: '<"card-header flex-column flex-md-row"<"head-label text-center">><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 10,
      lengthMenu: [10, 25, 50, 75, 100],
    });
    $('div.head-label').html('<h5 class="card-title mb-0">DataTable with Buttons</h5>');
  }
});