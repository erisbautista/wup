@extends('../../../layouts.admin')

@section('title','Create Exam')

@section('admin-content')
    <div class="exam">
        <div class="exam-header">
            <h1 class="text-uppercase">Create new Exam</h1>
        </div>
        <div class="exam-body">
            <form action="{{route('create_exam')}}" method="POST" class="exam-form">
                @csrf
                <div class="inline-group mr-2 self-center">
                    <div class="form-group self-end">
                        <label for="name">Exam Name</label>
                        <input type="text" name="name" id="name" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="strand_id">Strand</label>
                        <select name="strand_id" id="strand_id" class="input-select">
                            <option value="">Select strand</option>
                            @foreach($strands as $strand)
                                <option value="{!!$strand->id!!}">{{ $strand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="exam-form-footer content-center">
                    <button class="button w-2 text-center" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <a class="button w-5 text-center" href="{{ route('logout')}}">
        Log out
    </a>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
        $('#exam-menu-item').css('background-color', '#62B485');
        $('#strand_id').select2();
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
    });
    </script>
@endsection
