@include("admin::form._header")
    <a href="/admin/lessonEditor" class="btn btn-primary" id="{{$id}}-button">Edit Content</a>
    <!-- <textarea class="form-control {{$class}}" id="{{$id}}" name="{{$name}}" placeholder="{{ $placeholder }}" {!! $attributes !!} >{{ old($column, $value) }}</textarea> -->
@include("admin::form._footer")


<!-- <div class="{{$viewClass['form-group']}}">
        <label for="{{$id}}" class="{{$viewClass['label']}} control-label">{{$label}}
            </label><br> -->
<!-- </div> -->
