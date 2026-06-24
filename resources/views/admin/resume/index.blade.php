@extends('admin.layouts.master')
@section('title', 'Resume Details')
@section('content')
    <main class="main" id="main">

        <div class="row g-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Resume Details</h2>
                <div>
                    <a href="javascript:void(0);" 
                       data-title="Upload Resume"
                       data-size="modal-lg"
                       data-route="{{ route('admin.resumes.create') }}"
                       class="btn btn-primary common_model">
                        + Upload Resume
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped align-middle" id="resume-table">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>File Name</th>
                                <th>Title</th>
                                <th>File Type</th>
                                <th>File Size</th>
                                <th>Uploaded Date</th>
                                <th>Status</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>
@endsection

@push('scripts')
<script>
    $(function () {

        $('#resume-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.resumes.index') }}',
            order: [[0, 'desc']],
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
                {
                    data: 'file_name',
                    name: 'file_name'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'file_type',
                    name: 'file_type'
                },
                {
                    data: 'file_size',
                    name: 'file_size'
                },
                {
                    data: 'uploaded_at',
                    name: 'uploaded_at'
                },
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
</script>
@endpush