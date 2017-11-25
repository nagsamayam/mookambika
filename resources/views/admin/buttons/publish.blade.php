{{ Form::open(['method' => 'POST', 'route' => $route]) }}
<a href="{{ route($route, ['footer_ids[]' => $model->id, 'action_type' => 'publish' ]) }}"
   title="Publish"
   class="btn btn-rounded btn-primary btn-sm">
    <i class="fa fa-check"></i>
</a>
{{ Form::close() }}