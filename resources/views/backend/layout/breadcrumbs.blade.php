@if(!empty($title[$currentRoute]['display_name']))
<h1>
    {{ trans($title[$currentRoute]['display_name']) }}
    <small>{{ trans($title[$currentRoute]['description']) }}</small>
</h1>
@endif
<!--渲染右侧栏视图-->
{!! $mainPresenter->renderBreadcrumbs($AllMenus,$currentRoute) !!}

