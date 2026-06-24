@extends('admin.layouts.master')
@section('title', 'Job Seeker List')
<style>

.info-box {
    background: #f8f9fa;
    padding: 10px 15px;
    border-radius: 8px;
    height: 100%;
}

.info-box label {
    font-size: 13px;
    color: #6c757d;
    margin-bottom: 2px;
    display: block;
}

.info-box p {
    font-weight: 500;
    margin: 0;
    color: #212529;
}

#view_photo img {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #0d6efd;
}
</style>
@section('content')

    <main class="main" id="main">

        <div class="row g-4 mb-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Job Seeker List</h2>
            </div>

            <div class="card">
                <div class="card-body table-responsive">

                    <table class="table table-bordered table-striped align-middle w-100" id="jobseeker-table">

                        <thead class="table-dark text-nowrap">

                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Qualification</th>
                                <th>Status</th>
                                <th width="180">Action</th>
                            </tr>

                        </thead>

                        <tbody></tbody>

                    </table>

                </div>
            </div>

        </div>

        <div class="modal fade" id="viewUserModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content shadow-lg border-0">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fa fa-user me-2"></i> Job Seeker Details
                </h5>
                <button type="button" class="btn-close btn-close-white"
                    data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="text-center mb-4">
                    <div id="view_photo" class="mb-2"></div>
                    <h4 id="view_name"></h4>
                    <small id="view_email" class="text-muted"></small>
                </div>

                <hr>

                <div class="row g-3">

                    <div class="col-md-4">
                        <label class="fw-bold">Mobile</label>
                        <p id="view_mobile"></p>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold">DOB</label>
                        <p id="view_dob"></p>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold">Gender</label>
                        <p id="view_gender"></p>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold">State</label>
                        <p id="view_state"></p>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold">District</label>
                        <p id="view_district"></p>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold">City</label>
                        <p id="view_city"></p>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold">Qualification</label>
                        <p id="view_qualification"></p>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold">Experience Type</label>
                        <p id="view_experience"></p>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold">Experience Years</label>
                        <p id="view_ex_years"></p>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold">Last Salary</label>
                        <p id="view_salary"></p>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold">Previous Company</label>
                        <p id="view_company"></p>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold">Previous Designation</label>
                        <p id="view_designation"></p>
                    </div>
{{-- 
                    <div class="col-md-4">
                        <label class="fw-bold">Institution</label>
                        <p id="view_institution"></p>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold">Degree</label>
                        <p id="view_degree"></p>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold">Specialization</label>
                        <p id="view_specialization"></p>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold">Year Of Passing</label>
                        <p id="view_yop"></p>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold">Percentage</label>
                        <p id="view_percentage"></p>
                    </div> --}}

                    <div class="col-md-12">
                        <label class="fw-bold">Skills</label>
                        <p id="view_skills"></p>
                    </div>

                    {{-- <div class="col-md-12">
                        <label class="fw-bold">Bio</label>
                        <p id="view_bio"></p>
                    </div> --}}

                    <div class="col-md-4">
                        <label class="fw-bold">Status</label>
                        <p id="view_status"></p>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold">Created At</label>
                        <p id="view_created_at"></p>
                    </div>

                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center">

                    <div id="view_resume"></div>

                    <div>
                        <button class="btn btn-success me-2" id="approveBtn">
                            <i class="fa fa-check"></i> Approve
                        </button>

                        <button class="btn btn-danger" id="rejectBtn">
                            <i class="fa fa-times"></i> Reject
                        </button>
                    </div>

                </div>

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

            $('#jobseeker-table').DataTable({

                processing: true,
                serverSide: false,

                ajax: '{{ route('admin.jobseekers.index') }}',
                order: [[0, 'asc']],
                columns: [

                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },

                    { data: 'name', name: 'name' },

                    { data: 'email', name: 'email' },

                    { data: 'mobile', name: 'mobile' },

                    { data: 'qualification', name: 'qualification' },

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
        const imageUrl = "{{ asset('public/uploads/photos') }}";
        const resumeUrl = "{{ asset('public/uploads/resumes') }}";
        $(document).on('click', '.viewUser', function () {

    let id = $(this).data('id');

    $('#approveBtn').data('id', id);
    $('#rejectBtn').data('id', id);

    $.ajax({

        url: "{{ url('admin/jobseekers') }}/" + id,
        type: "GET",

        success: function (res) {

            let d = res.details || {};

            $('#view_name').text(res.name ?? '-');
            $('#view_email').text(res.email ?? '-');

            $('#view_mobile').text(d.mobile ?? '-');
            $('#view_dob').text(d.dob ?? '-');
            $('#view_gender').text(d.gender ?? '-');

            $('#view_state').text(d.state ?? '-');
            $('#view_district').text(d.district ?? '-');
            $('#view_city').text(d.city ?? '-');

            $('#view_qualification').text(d.qualification ?? '-');
            $('#view_experience').text(d.exp ?? '-');
            $('#view_ex_years').text(d.ex_years ?? '-');

            $('#view_salary').text(d.last_salary ?? '-');

            $('#view_company').text(d.previous_company ?? '-');
            $('#view_designation').text(d.previous_designation ?? '-');

            $('#view_institution').text(d.institution_name ?? '-');
            $('#view_degree').text(d.course_degree ?? '-');
            $('#view_specialization').text(d.specialization ?? '-');

            $('#view_yop').text(d.year_of_passing ?? '-');
            $('#view_percentage').text(d.percentage ?? '-');

            $('#view_bio').text(d.bio ?? '-');

            $('#view_skills').text(
                d.skill_names && d.skill_names.length
                    ? d.skill_names.join(', ')
                    : '-'
            );

            $('#view_photo').html(
                d.profile_photo
                    ? `<img src="${imageUrl}/${d.profile_photo}"
                            class="rounded-circle border"
                            width="120"
                            height="120"
                            style="object-fit:cover;">`
                    : `<img src="https://via.placeholder.com/120"
                            class="rounded-circle">`
            );

            $('#view_resume').html(
                d.resume
                    ? `<a href="${resumeUrl}/${d.resume}"
                            target="_blank"
                            class="btn btn-primary">
                            <i class="fa fa-file-pdf me-1"></i>
                            View Resume
                       </a>`
                    : `<span class="text-danger">No Resume Uploaded</span>`
            );

            let status = parseInt(res.is_active ?? 0);

            let badge = '';

            if (status == 1) {
                badge = '<span class="badge bg-success">Active</span>';
            } else {
                badge = '<span class="badge bg-danger">Inactive</span>';
            }

            $('#view_status').html(badge);

            $('#view_created_at').text(
                res.created_at_formatted ?? '-'
            );

            $('#viewUserModal').modal('show');

        }

    });

});
        $('#rejectBtn').click(function () {
            let id = $(this).data('id');
            Swal.fire({
                target: document.getElementById('viewUserModal'), 
                title: 'Reject User',
                input: 'textarea',
                inputLabel: 'Reject Reason',
                inputPlaceholder: 'Enter reason for rejection...',
                showCancelButton: true,
                confirmButtonText: 'Reject',
                confirmButtonColor: '#d33',
                backdrop: false, // 🔥 important (avoid overlay conflict)
                focusConfirm: false,
                didOpen: () => {
                    document.querySelector('.swal2-textarea').focus();
                },
                inputValidator: (value) => {
                    if (!value || value.trim() === '') {
                        return 'Reject reason is required!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    updateStatus(id,3, result.value);
                }
            });

        });
        $('#approveBtn').click(function () {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to approve this user?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Approve',
                confirmButtonColor: '#28a745'
            }).then((result) => {
                if (result.isConfirmed) {
                    updateStatus(id,1);
                }
            });
        });

        function updateStatus(id,status, reason = '') {
            $.ajax({
                url: "{{ route('admin.jobseekers.approve', ':id') }}".replace(':id', id),
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    is_active: status,
                    reject_reason: reason
                },
                success: function (res) {
                    if (res.status) {
                        toastr.success(res.message); // ✅ success toast
                        $('#viewUserModal').modal('hide');
                        $('#jobseeker-table').DataTable().ajax.reload();
                    } else {
                        toastr.error(res.message || 'Something went wrong'); // ✅ error toast
                    }
                },
                error: function (xhr) {
                    let msg = 'Something went wrong';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }

                    toastr.error(msg); // ✅ error toast
                }
            });
        }
       
    </script>

@endpush