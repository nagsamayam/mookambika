@if (count($errors) > 0)
    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            @include('admin.includes._errors', ['errors' => $errors])
        </div>
    </div>
@endif