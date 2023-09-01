@include("admin::form._header")
    <a href="/admin/htmlEditor?id={{ $customData['id'] }}&queryParam={{ $customData['queryParam'] }}" class="btn btn-primary" id="{{$id}}-button" target="_blank">Edit Content</a>
@include("admin::form._footer")
