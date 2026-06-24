@extends('admin.layouts.master')
@section('title', 'Education List')
<style>
#employers-table thead th {
    white-space: nowrap;
}
</style>
@section('content')

    <main class="main" id="main">

        <div class="row g-4 mb-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Employer List</h2>

                {{-- <div>
                    <a href="javascript:void(0);" data-title="Add Education" data-size="modal-lg"
                        data-route="{{ route('admin.educations.create') }}" class="btn btn-primary common_model">

                        + Add Education

                    </a>
                </div> --}}
            </div>

            <div class="card">
                <div class="card-body table-responsive">

                    <table class="table table-bordered table-striped align-middle w-100" id="employers-table">

                        <thead class="table-dark text-nowrap">

                            <tr>
                                <th>#</th>
                                <th>Company Name</th>
                                <th>Owner Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>GST</th>
                                <th>PAN</th>
                                <th>Status</th>
                                <th width="180">Action</th>
                            </tr>

                        </thead>

                        <tbody></tbody>

                    </table>

                </div>
            </div>

        </div>

        <div class="modal fade" id="viewEmployerModal" tabindex="-1">

            <div class="modal-dialog modal-lg">

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Employer Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <table class="table table-bordered">

                            <tr>
                                <th>Company Name</th>
                                <td id="company_name"></td>
                            </tr>

                            <tr>
                                <th>Owner Name</th>
                                <td id="owner_name"></td>
                            </tr>

                            <tr>
                                <th>Owner Mobile</th>
                                <td id="owner_mobile"></td>
                            </tr>

                            <tr>
                                <th>HR Name</th>
                                <td id="hr_name"></td>
                            </tr>

                            <tr>
                                <th>HR Mobile</th>
                                <td id="hr_mobile"></td>
                            </tr>

                            <tr>
                                <th>Email</th>
                                <td id="email"></td>
                            </tr>

                            <tr>
                                <th>Address</th>
                                <td id="company_address"></td>
                            </tr>

                            <tr>
                                <th>State</th>
                                <td id="state"></td>
                            </tr>

                            <tr>
                                <th>District</th>
                                <td id="district"></td>
                            </tr>

                            <tr>
                                <th>City</th>
                                <td id="city"></td>
                            </tr>

                            <tr>
                                <th>Pincode</th>
                                <td id="pincode"></td>
                            </tr>

                            <tr>
                                <th>GST Number</th>
                                <td id="gst_number"></td>
                            </tr>

                            <tr>
                                <th>PAN Number</th>
                                <td id="pan_number"></td>
                            </tr>

                            <tr>
                                <th>MSME Number</th>
                                <td id="msme_number"></td>
                            </tr>

                            <tr>
                                <th>GST Certificate</th>
                                <td id="gst_certificate"></td>
                            </tr>

                            <tr>
                                <th>PAN Document</th>
                                <td id="pan_document"></td>
                            </tr>

                            <tr>
                                <th>MSME Certificate</th>
                                <td id="msme_certificate"></td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td id="status"></td>
                            </tr>

                            <tr>
                                <th>Created At</th>
                                <td id="created_at"></td>
                            </tr>

                        </table>

                    </div>

                </div>
            </div>
        </div>

    </main>

@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        $(function () {

            $('#employers-table').DataTable({

                processing: true,
                serverSide: true,

                ajax: '{{ route('admin.employers.index') }}',
                order: [[1, 'asc']],
                columns: [

                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },

                    { data: 'company_name', name: 'company_name' },
                    { data: 'owner_name', name: 'owner_name' },                    

                    { data: 'email', name: 'email' },

                    { data: 'mobile', name: 'mobile' },

                    { data: 'gst', name: 'gst' },

                    { data: 'pan', name: 'pan' },

                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }

                ]

            });

        });

        $(document).on('click', '.viewEmployer', function () {

    let id = $(this).data('id');

    $.ajax({
        url: "{{ url('admin/employers') }}/" + id,
        type: "GET",

        success: function (res) {

            console.log(res);

            let details = res.employerDetails || res.employer_details || {};

            $('#company_name').text(details.company_name || '-');

            $('#owner_name').text(details.owner_name || '-');
            $('#owner_mobile').text(details.owner_mobile || '-');

            $('#hr_name').text(details.hr_name || '-');
            $('#hr_mobile').text(details.hr_mobile || '-');

            $('#email').text(res.email || details.email || '-');

            $('#company_address').text(details.company_address || '-');

            $('#state').text(details.state || '-');
            $('#district').text(details.district || '-');
            $('#city').text(details.city || '-');
            $('#pincode').text(details.pincode || '-');

            $('#gst_number').text(details.gst_number || '-');
            $('#pan_number').text(details.pan_number || '-');
            $('#msme_number').text(details.msme_number || '-');

            let documentUrl = "{{ asset('public/uploads/employers') }}";

            $('#gst_certificate').html(
                details.gst_certificate
                    ? `<a href="${documentUrl}/${details.gst_certificate}" target="_blank" class="btn btn-sm btn-primary">View GST</a>`
                    : '-'
            );

            $('#pan_document').html(
                details.pan_document
                    ? `<a href="${documentUrl}/${details.pan_document}" target="_blank" class="btn btn-sm btn-success">View PAN</a>`
                    : '-'
            );

            $('#msme_certificate').html(
                details.msme_certificate
                    ? `<a href="${documentUrl}/${details.msme_certificate}" target="_blank" class="btn btn-sm btn-info">View MSME</a>`
                    : '-'
            );

            let statusHtml = '';

            switch (parseInt(res.is_active)) {

                case 0:
                    statusHtml = '<span class="badge bg-warning">Pending</span>';
                    break;

                case 1:
                    statusHtml = '<span class="badge bg-success">Approved</span>';
                    break;

                case 3:
                    statusHtml = '<span class="badge bg-danger">Rejected</span>';
                    break;

                default:
                    statusHtml = '<span class="badge bg-secondary">Unknown</span>';
            }

            $('#status').html(statusHtml);

            $('#created_at').text(res.created_at_formatted || '-');

            $('#viewEmployerModal').modal('show');
        },

        error: function (xhr) {

            console.log(xhr.responseText);

        }
    });

});

        let previousStatus;

        $(document).on('focus', '.changeStatus', function () {
            previousStatus = $(this).val();
        });

        $(document).on('change', '.changeStatus', function () {

            let select = $(this);
            let id = select.data('id');
            let status = select.val();

            // Reject → ask reason using Swal textarea
            if (status == 3) {

                Swal.fire({
                    title: 'Reject Employer',
                    input: 'textarea',
                    inputLabel: 'Enter rejection reason',
                    inputPlaceholder: 'Write rejection reason here...',
                    inputAttributes: {
                        'aria-label': 'Type your message here'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    cancelButtonText: 'Cancel',
                    preConfirm: (message) => {
                        if (!message) {
                            Swal.showValidationMessage('Rejection reason is required');
                        }
                        return message;
                    }
                }).then((result) => {

                    if (result.isConfirmed) {

                        sendStatus(id, status, result.value, select);

                    } else {
                        select.val(previousStatus);
                    }

                });

            } else {

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to change employer status!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, change it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {

                    if (result.isConfirmed) {
                        sendStatus(id, status, '', select);
                    } else {
                        select.val(previousStatus);
                    }

                });

            }

        });

        function sendStatus(id, status, message, select)
        {
            $.ajax({
                url: "{{ route('admin.employers.approve', ':id') }}".replace(':id', id),
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    status: status,
                    message: message
                },
                success: function (res) {

                    if (res.status) {

                        toastr.success(res.message);
                        $('#employers-table').DataTable().ajax.reload();

                    } else {

                        toastr.error(res.message);
                        select.val(previousStatus);

                    }

                },
                error: function () {

                    toastr.error("Something went wrong");
                    select.val(previousStatus);

                }
            });
        }
    </script>

@endpush