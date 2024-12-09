<div id="choice-modal" class="modal">
    <div class="modal-header">
        <h1>Create new choice</h1>
    </div>
    <div class="modal-body">
        <form method="POST" class="create-choice-form">
            @csrf
            <input type="hidden" name="question_id" id="question_id" value="{{$question->id}}">
            <input type="hidden" name="choice_id" id="choice_id">
            <div class="form-group">
                <label class="form-label" for="label">Choice</label>
                <input type="text" class="form-input" name="label" id="label">
            </div>
            <div class="form-group">
                <label class="form-label mr-1" for="correct">isCorrect?</label>
                <input type="checkbox" class="checkbox-input" name="correct" id="correct">
            </div>
            <div class="form-footer">
                <button id="submit-button" class="button w-2 text-center" type="button">Save</button>
            </div>
        </form>
    </div>
</div>