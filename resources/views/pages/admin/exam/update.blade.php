@extends('../../../layouts.admin')

@section('title','Exam Details')

@section('admin-content')
    <div class="exam">
        <div class="exam-header">
            <h1 class="text-uppercase">Update Exam</h1>
        </div>
        <div class="exam-body">
            <form action="{{route('update_exam', $data['exam']->id)}}" method="POST" class="exam-form">
                @csrf
                @method('PUT')
                <div class="inline-group mr-2 self-center">
                    <div class="form-group self-end">
                        <label for="name">Exam Name</label>
                        <input type="text" name="name" id="name" value="{{$data['exam']->name}}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="strand_id">Strand</label>
                        <select name="strand_id" id="strand_id" value="{{$data['exam']->strand_id}}" class="input-select">
                            <option value="">Select strand</option>
                            @foreach($data['strands'] as $strand)
                                <option value="{!!$strand->id!!}">{{ $strand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="exam-form-footer content-center">
                    <button class="button w-2 text-center" type="submit">Save</button>
                </div>
            </form>
            <div class="exam-questions">
                <div class="exam-questions-header">
                    <a href="{{ route('question', $data['exam']->id)}}" class="button w-4 text-center button-new">New Question</a>
                </div>
                <div class="exam-questions-body">
                    <div class="exam-table-wrapper">
                        <table class="display" id="admin-table">
                            @csrf
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>question</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <a class="button w-5 text-center" href="{{ route('admin_exam') }}">
        back
    </a>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
        $('#exam-menu-item').css('background-color', '#62B485');
        $('#strand_id').select2();
        $('#strand_id').val({!! json_encode($data['exam']['strand_id']) !!}); // Select the option with a value of '1'
        $('#strand_id').trigger('change');
        $('.exam-form').submit(function(event) {
            var errors = 0;
            $(".exam-form input, .exam-form select").map(function(){
                $(this).val($(this).val().trim());
                if( !$(this).val() || $(this).val() === null) {
                    $(this).addClass('warning');
                    errors++;
                } else if ($(this).val()) {
                    $(this).removeClass('warning');
                }
            });
            if(errors > 0){
                swal('All fields is required', '', 'error');
                event.preventDefault();
            }
        })
        var url = "{{ route('get_exam', ':id')}}";
        url = url.replace(':id', {!! json_encode($data['exam']['id']) !!});
        
        $("#admin-table").DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            scrollY: '30rem',
            ajax: url,
            columns: [
                { data: 'DT_RowIndex', "searchable":false },
                { data: "question", name: "question" },
                { data: "created_at", name: "created_at" },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            
        });

        $('#admin-table').on('click', '#updateQuestion', function () {
            let id = $(this).data('id');
            window.location.href = "/exam/question/" + id
        });
    });
    
    function deleteQuestion(id)
        {
            var url = "{{ route('delete_question', 'id') }}";
            var token = document.getElementsByName("_token")[0].value;
            url = url.replace('id', id);
            $.ajax({
                url: url,
                method: 'DELETE',
                data: {
                        "id": id,
                        "_method": 'DELETE',
                        "_token": token,
                },
                dataType: 'JSON',
                success: function ()
                {
                    swal('Success', 'Successfully deleted', 'sucess')
                    window.location.reload()
                }
            });
        }
    </script>
@endsection
