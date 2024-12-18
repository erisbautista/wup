@extends('../../../../layouts.admin')

@section('title','Update Question')

@section('admin-content')
    <div class="question">
        <div class="question-header">
            <h1 class="text-uppercase">Update Question</h1>
        </div>
        <div class="question-body">
            <form action="{{route('update_question', $question->id)}}" method="POST" class="question-form">
                @csrf
                @method('PUT')
                <label for="question">Question</label>
                <textarea name="question" id="question" class="textarea-input">{{$question->question}}</textarea>
                <div class="question-form-footer content-center">
                    <button class="button w-2 text-center" type="submit">Save</button>
                </div>
            </form>
            <div class="choices">
                <div class="choices-header">
                    <a onclick="openModal()" class="button w-4 text-center mb-2">New choices</a>
                </div>
                <div class="choices-body">
                    <div class="choices-table-wrapper">
                        <table class="display" id="admin-table">
                            @csrf
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>isCorrectAnswer</th>
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
    <a class="button w-5 text-center" href="{{ route('get_exam', $question->exam_id) }}">
        back
    </a>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#exam-menu-item').css('background-color', '#62B485');
            var url = "{{ route('get_question', ':id')}}";
            url = url.replace(':id', {!! json_encode($question['id']) !!});
            
            $("#admin-table").DataTable({
                processing: true,
                serverSide: true,
                scrollCollapse: true,
                scrollY: '20rem',
                ajax: url,
                columns: [
                    { data: 'DT_RowIndex', "searchable":false },
                    { data: "label", name: "label" },
                    { data: "correct", name: "correct" },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                
            });

            $('.question-form').submit(function(event) {
                if($('#question').val() === ''|| $('#question').val() === null){
                    $('#question').addClass('warning');
                    swal('Question field is required', '', 'error');
                    event.preventDefault();
                } else {
                    $('#question').removeClass('warning');
                }
            })

            $('#submit-button').on('click', function() {
                let type = $(this).data('type');
                submitForm(type);
            })
        });

        function deleteChoice(id) {
            var url = "{{ route('delete_choices', 'id') }}";
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

        function openModal() {
            $('#submit-button').data('type', 'create');
            $('.modal-header').html('<h1>Create new choice</h1>');
            $('#correct').prop('checked', false);
            $('#label').val('');
            $('#choice_id').val('');
            $('#choice-modal').modal({
                fadeDuration: 100,
                escapeClose: false,
                clickClose: false,
            })
        }

        function submitForm(type) {
            if($('#label').val() === ''|| $('#label').val() === null){
                $('#label').addClass('warning');
                swal('Choice field is required', '', 'error');
                event.preventDefault();
            } else {
                $('#label').removeClass('warning');
            }
            var url = "{{ route('create_choices') }}";
            var token = document.getElementsByName("_token")[0].value;
            var id = $('#question_id').val();
            var method = 'POST';
            if ( type === 'update') {
                id = $('#choice_id').val();
                url = "{{ route('update_choices', ':id') }}"
                url = url.replace(':id', id);
                method = 'PUT'
            }
            $.ajax({
                url: url,
                method: method,
                data: {
                        "label": $('#label').val(),
                        "question_id": $('#question_id').val(),
                        "correct": $('#correct').is(":checked"),
                        "_token": token,
                },
                dataType: 'JSON',
                success: function ()
                {
                    swal('Success', 'Successfully processed!', 'sucess')
                    window.location.reload()
                }
            });
        }

        $('#admin-table').on('click', '#updateChoice', function () {
            let id = $(this).data('id');
            var url = "{{ route('get_choice', 'id') }}";
            var token = document.getElementsByName("_token")[0].value;
            url = url.replace('id', id);
            $.ajax({
                url: url,
                method: 'get',
                data: {
                        "id": id,
                        "_token": token,
                },
                dataType: 'JSON',
                success: function (data)
                {
                    $('#submit-button').data('type', 'update');
                    $('#correct').prop('checked', data.correct);
                    $('#choice_id').val(data.id);
                    $('#label').val(data.label);
                    $('.modal-header').html('<h1>Update choice</h1>');
                    $('#choice-modal').modal({
                        fadeDuration: 100,
                        escapeClose: false,
                        clickClose: false,
                    })
                }
            });
        });
    </script>
@endsection

@section('modal')
    @include('../../../../components.createChoiceModal')
@endsection
