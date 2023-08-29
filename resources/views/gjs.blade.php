<div class="form-group {!! !$errors->has($errorKey) ?: 'has-error' !!}">

    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>

    <div class="col-sm-6">

        <a href="/admin/lessonEditor" class="btn btn-primary" id="{{$id}}-button">Edit Content</a>

    </div>
</div>
