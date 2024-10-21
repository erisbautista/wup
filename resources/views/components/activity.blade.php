<div class="violation-create">
    <div class="violation-create-header">
        <h1 class="text-uppercase">Create new Activity</h1>
    </div>
    <div class="violation-create-body">
        <form action="{{ route('create_activity') }}" method="POST" id="history-form" class="violation-create-form">
            @csrf
            <div class="form-group">
                <label for="username" class="form-label">Start Date</label>
                <input class="form-input" type="date" name="start_date" id="start_date" placeholder="Select Start Date">
            </div>
            <div class="form-group" id="date_picker">
                <label for="" class="form-label">End Date</label>
                <input class="form-input" type="date" name="end_date" id="end_date" placeholder="Select End Date">
            </div>
            <div class="form-group">
                <label for="category_no" class="form-label">Description</label>
                <textarea class="textarea-input" id="description" name="description" cols="30" rows="10"></textarea>
            </div>
            <div class="violation-create-form-footer">
                <button onclick="submitForm()" type="button" id='activity-submit' class="button w-3 text-center">Submit</button>
            </div>
        </form>
    </div>
</div>