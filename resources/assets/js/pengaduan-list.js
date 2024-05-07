'use strict';

$(function () {
  var dt_pengaduan_table = $('.pengaduan-table');

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  if (dt_pengaduan_table.length) {
    var dt_pengaduan = dt_pengaduan_table.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: baseUrl + 'pengaduan-list-table'
      },
      columns: [
        { data: '' },
        { data: 'id' },
        { data: 'kode' },
        { data: 'nama' },
        { data: 'telepon_pelapor' },
        { data: 'nama_barang' },
        { data: 'keterangan_laporan' },
        { data: 'tanggal_laporan' },
        { data: 'status' },
        { data: 'action' }
      ],
      columnDefs: [
        {
          className: 'control',
          responsivePriority: 2,
          searchable: false,
          targets: 0,
          render: function (data, type, full, meta) {
            return '';
          }
        },
        {
          searchable: false,
          orderable: false,
          targets: 1,
          render: function (data, type, full, meta) {
            return '<span>' + full.fake_id + '</span>';
          }
        },
        {
          targets: 2,
          render: function (data, type, full, meta) {
            return '<span class="kode">' + full.kode + '</span>';
          }
        },
        {
          targets: 3,
          render: function (data, type, full, meta) {
            return '<span class="nama">' + full.nama + '</span>';
          }
        },
        {
          targets: 4,
          render: function (data, type, full, meta) {
            return '<span class="telepon_pelapor">' + full.telepon_pelapor + '</span>';
          }
        },
        {
          targets: 5,
          render: function (data, type, full, meta) {
            return '<span class="nama_barang">' + full.nama_barang + '</span>';
          }
        },
        {
          targets: 6,
          render: function (data, type, full, meta) {
            return '<span class="keterangan_laporan">' + full.keterangan_laporan + '</span>';
          }
        },
        {
          targets: 7,
          render: function (data, type, full, meta) {
            var originalDate = new Date(full.tanggal_laporan);

            // Format tanggal
            var options = { month: 'short', day: '2-digit', year: 'numeric' };
            var formattedDate = originalDate.toLocaleDateString('en-US', options);
            formattedDate = formattedDate.replace(/(\d{2})\/(\d{2})\/(\d{4})/, '$2-$1-$3');

            // Format waktu
            var hours = originalDate.getHours().toString().padStart(2, '0');
            var minutes = originalDate.getMinutes().toString().padStart(2, '0');
            var seconds = originalDate.getSeconds().toString().padStart(2, '0');
            var formattedTime = hours + ':' + minutes + ':' + seconds;

            return '<span class="tanggal_laporan">' + formattedDate + ' ' + formattedTime + '</span>';
          }
        },
        {
          targets: 8,
          render: function (data, type, full, meta) {
            var statusColor = '';
            if (full.status === 'Pending') {
              statusColor = 'dark';
            } else if (full.status === 'Proses') {
              statusColor = 'warning';
            } else if (full.status === 'Selesai') {
              statusColor = 'success';
            }
            return '<span class="badge bg-label-' + statusColor + '">' + full.status + '</span>';
          }
        },
        // {
        //   targets: 8,
        //   visible: false
        // },
        {
          targets: -1,
          title: 'Actions',
          searchable: false,
          orderable: false,
          render: function (data, type, full, meta) {
            var id = full.id; // Mengambil ID dari data set
            return (
              '<div class="d-flex align-items-center">' +
              '<a href="' +
              baseUrl +
              'si-dandang/pengaduan/edit/' +
              id +
              '" data-bs-toggle="tooltip" class="edit-record text-body" data-bs-placement="top" title="Edit"><i class="ti ti-eye mx-2 ti-sm"></i></a>' +
              '<div class="dropdown">' +
              '<a href="javascript:;" class="btn dropdown-toggle hide-arrow text-body p-0" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm"></i></a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
              '<a href="javascript:;" class="dropdown-item delete-record text-danger" data-id="' +
              id +
              '">Delete</a>'
            );
          }
        }
      ],
      order: [[1, 'desc']],
      dom:
        '<"row mx-1"' +
        '<"col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start gap-2"l<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3"B>>' +
        '<"col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3"f<"status mb-3 mb-md-0">>' +
        '>t' +
        '<"row mx-2"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      language: {
        sLengthMenu: 'Show _MENU_',
        search: '',
        searchPlaceholder: 'Search '
      },
      // Buttons with Dropdown
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-label-primary dropdown-toggle mx-3 waves-effect waves-light',
          text: '<i class="ti ti-logout rotate-n90 me-2"></i>Export',
          buttons: [
            {
              extend: 'print',
              title: 'Pengaduan',
              text: '<i class="ti ti-printer me-2" ></i>Print',
              className: 'dropdown-item',
              exportOptions: {
                columns: [2, 3, 4, 5, 6, 7, 8],
                // prevent avatar to be print
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('pengaduan-name')) {
                        result = result + item.lastChild.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              },
              customize: function (win) {
                //customize print view for dark
                $(win.document.body)
                  .css('color', config.colors.headingColor)
                  .css('border-color', config.colors.borderColor)
                  .css('background-color', config.colors.body);
                $(win.document.body)
                  .find('table')
                  .addClass('compact')
                  .css('color', 'inherit')
                  .css('border-color', 'inherit')
                  .css('background-color', 'inherit');
              }
            },
            {
              extend: 'csv',
              title: 'Pengaduan',
              text: '<i class="ti ti-file-text me-2" ></i>Csv',
              className: 'dropdown-item',
              exportOptions: {
                columns: [2, 3, 4, 5, 6, 7, 8],
                // prevent avatar to be print
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList.contains('user-name')) {
                        result = result + item.lastChild.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              }
            },
            {
              extend: 'excel',
              title: 'Pengaduan',
              text: '<i class="ti ti-file-spreadsheet me-2"></i>Excel',
              className: 'dropdown-item',
              exportOptions: {
                columns: [2, 3, 4, 5, 6, 7, 8],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList.contains('user-name')) {
                        result = result + item.lastChild.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              }
            },
            {
              extend: 'pdf',
              title: 'Users',
              text: '<i class="ti ti-file-text me-2"></i>Pdf',
              className: 'dropdown-item',
              exportOptions: {
                columns: [2, 3, 4, 5, 6, 7, 8],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList.contains('user-name')) {
                        result = result + item.lastChild.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              }
            },
            {
              extend: 'copy',
              title: 'Users',
              text: '<i class="ti ti-copy me-1" ></i>Copy',
              className: 'dropdown-item',
              exportOptions: {
                columns: [2, 3],
                // prevent avatar to be copy
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList.contains('user-name')) {
                        result = result + item.lastChild.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              }
            }
          ]
        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data.kode;
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== ''
                ? '<tr data-dt-row="' +
                    col.rowIndex +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '">' +
                    '<td>' +
                    col.title +
                    ':' +
                    '</td> ' +
                    '<td>' +
                    col.data +
                    '</td>' +
                    '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      },
      initComplete: function () {
        // Adding Status filter once table initialized
        this.api()
          .columns(8)
          .every(function () {
            var column = this;
            var select = $(
              '<select id="StatusFilter" class="form-select"><option value=""> Select Status </option></select>'
            )
              .appendTo('.status')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                console.log(val);
                column.search(val ? '^' + val + '$' : '', true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
              });
          });
        // Menangani peristiwa perubahan pada filter status
        $('.status select').on('change', function () {
          var status = $(this).val();
          dt_pengaduan.ajax.url(baseUrl + 'pengaduan-list-table?status=' + status).load();
        });
      }
    });
  }

  dt_pengaduan_table.on('draw.dt', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl, {
        boundary: document.body
      });
    });
  });

  $('.pengaduan-table tbody').on('click', '.delete-record', function () {
    dt_pengaduan.row($(this).parents('tr')).remove().draw();
  });

  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);

  $(document).on('click', '.delete-record', function () {
    var id = $(this).data('id');
    var url = baseUrl + 'si-dandang/pengaduan/destroy/' + id;

    $.ajax({
      url: url,
      type: 'DELETE',
      success: function (response) {
        // Handle success, misalnya hapus baris dari tabel atau refresh halaman
        location.reload(); // Memuat ulang halaman setelah penghapusan berhasil
      },
      error: function (xhr, status, error) {
        // Handle error
      }
    });
  });
});
