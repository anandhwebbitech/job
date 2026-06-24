<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<form id="ResumeForm" action="{{ route('admin.resumes.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="row">

                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">
                        Upload Resume(s)
                        <span class="text-danger">*</span>
                    </label>

                    <input type="file"
                           name="resumes[]"
                           id="resumes"
                           multiple
                           accept=".pdf,.doc,.docx"
                           class="form-control">

                    <small class="text-muted">
                        You can upload Single or Multiple Resume Files
                        (PDF, DOC, DOCX)
                    </small>

                    <span class="text-danger error-text resumes_error"></span>
                </div>

                <div class="col-md-12">
                    <div id="selected-files" class="mt-2"></div>
                </div>

            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-success rounded-pill px-4">
                    <i class="fa fa-upload me-2"></i>
                    Upload Resume
                </button>

                <a href="{{ route('admin.resumes.index') }}"
                   class="btn btn-secondary rounded-pill px-4">
                    Cancel
                </a>
            </div>

        </div>
    </div>

</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
$(document).ready(function(){

    $('#resumes').on('change', function(){

        let files = this.files;
        let html = '';

        if(files.length > 0){

            html += '<ul class="list-group">';

            for(let i=0; i<files.length; i++){

                html += `
                    <li class="list-group-item">
                        ${files[i].name}
                    </li>
                `;
            }

            html += '</ul>';
        }

        $('#selected-files').html(html);

    });

    $("#ResumeForm").submit(function(e){

        e.preventDefault();

        let formData = new FormData(this);

        $(".error-text").text('');

        $.ajax({

            url: "{{ route('admin.resumes.store') }}",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function(response){

                if(response.status){

                    toastr.success(response.message);

                    $("#ResumeForm")[0].reset();

                    $('#selected-files').html('');

                    setTimeout(function(){

                        window.location.href =
                            "{{ route('admin.resumes.index') }}";

                    }, 1000);
                }

            },

            error: function(xhr){

                if(xhr.status === 422){

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function(key, value){

                        if(key.includes('resumes')){
                            $(".resumes_error").text(value[0]);
                        }

                    });

                }else{

                    toastr.error('Something went wrong');

                }

            }

        });

    });

});
</script>