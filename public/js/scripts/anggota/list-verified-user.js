/*=========================================================================================
    File Name: app-user-list.js
    Description: User List page
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent

==========================================================================================*/
$(function () {
    ('use strict');



    var dtUserTable = $('.user-list-table'),
      select = $('.select2'),
      statusObj = {
        0: { title: 'Unverified', class: 'badge-light-secondary' },
        1: { title: "Verified", class: 'badge-light-success' },
      };
    // Users List datatable
    if (dtUserTable.length) {
      dtUserTable.DataTable({
        processing: true,
        serverSide: true,
        ajax: '/bem-fti/list-verified-user', // JSON file to add data
        columns: [
          // columns according to JSON
          { data: 'id', name: 'id' },
          { data: 'name', name: 'name' },
          { data: 'role', name: 'role'  },
          { data: 'is_verified', name: 'is_verified'  },
          { data: '' }
        ],
        columnDefs: [
          {
            targets: 0,
            visible: false
          },
          {
            // User full name and username
            targets: 1,
            responsivePriority: 4,
            render: function (data, type, full, meta) {
              var $name = full['name'],
                $email = full['email']

              // Creates full output for row
              var $row_output =
                '<div class="d-flex justify-content-left align-items-center">' +
                '<div class="d-flex flex-column">' +
                '<a href="#" class="user_name text-truncate text-body"><span class="fw-bolder">' +
                $name +
                '</span></a>' +
                '<small class="emp_post text-muted">' +
                $email +
                '</small>' +
                '</div>' +
                '</div>';
              return $row_output;
            }
          },
          {
            // User Role
            targets: 2,
            render: function (data, type, full, meta) {
              var $role = full['role'];
              var roleBadgeObj = {
                anggota: feather.icons['user'].toSvg({ class: 'font-medium-3 text-primary me-50' }),
                Author: feather.icons['settings'].toSvg({ class: 'font-medium-3 text-warning me-50' }),
                Maintainer: feather.icons['database'].toSvg({ class: 'font-medium-3 text-success me-50' }),
                Editor: feather.icons['edit-2'].toSvg({ class: 'font-medium-3 text-info me-50' }),
                admin: feather.icons['slack'].toSvg({ class: 'font-medium-3 text-danger me-50' })
              };
              return "<span class='text-truncate align-middle'>" + roleBadgeObj[$role] + $role + '</span>';
            }
          },
          {
            // User Status
            targets: 3,
            render: function (data, type, full, meta) {
              var $status = full['is_verified'];
              return (
                '<span class="badge rounded-pill ' +
                statusObj[$status].class +
                '" text-capitalized>' +
                statusObj[$status].title +
                '</span>'
              );
            }
          },
          {
            // Actions
            targets: -1,
            title: 'Actions',
            orderable: false,
            render: function (data, type, full, meta) {
              let id = full['id'];
              return (
                '<div class="btn-group">' +
                '<a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                '</a>' +
                '<div class="dropdown-menu dropdown-menu-end">' +
                '<span ' +
                'class="dropdown-item text-success" onclick="VerifiedUserHandler('+
                id +
                ')">' +
                feather.icons['check'].toSvg({ class: 'font-small-4 me-50 text-success' }) +
                'Verified</span>' +
                '<span class="dropdown-item text-danger" onclick="UnverifiedUserHandler('+
                id +
                ')">' +
                feather.icons['x'].toSvg({ class: 'font-small-4 me-50 text-danger' }) +
                'Unverified</span></div>' +
                '</div>' +
                '</div>'
              );
            }
          }
        ],
        order: [[1, 'desc']],
        dom:
          '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"' +
          '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
          '<"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1"f>>>' +
          '>t' +
          '<"d-flex justify-content-between mx-2 row mb-1"' +
          '<"col-sm-12 col-md-6"i>' +
          '<"col-sm-12 col-md-6"p>' +
          '>',
        language: {
          sLengthMenu: 'Show _MENU_',
          search: 'Search',
          searchPlaceholder: 'Search..'
        },

        language: {
          paginate: {
            // remove previous & next text from pagination
            previous: '&nbsp;',
            next: '&nbsp;'
          }
        },
        initComplete: function () {
            // Adding role filter once table initialized
            this.api()
              .columns(3)
              .every(function () {
                var column = this;
                var label = $('<label class="form-label" for="UserVerified">Role</label>').appendTo('.user_verified');
                var select = $(
                  '<select id="UserVerified" class="form-select text-capitalize mb-md-0 mb-2"><option value=""> Select Status </option></select>'
                )
                  .appendTo('.user_verified')
                  .on('change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                  });

                column
                  .data()
                  .unique()
                  .sort()
                  .each(function (d, j) {
                    let title = d === 1 ? "Verified" : "Unverified";
                    select.append('<option value="' + d + '" class="text-capitalize">' + title + '</option>');
                  });
              });
        }
      });
    }

  });
