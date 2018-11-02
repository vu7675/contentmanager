<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{url('/admin')}}">Dashboard</a>
    </li>
    @if (strpos(\Request::route()->getName(), 'index') !== false)
        <li class="breadcrumb-item active">
            {{ucwords(explode('.', \Request::route()->getName())[0])}}
        </li>
    @else
        <li class="breadcrumb-item">
            <a href="{{url('/admin/'.explode('.', \Request::route()->getName())[0])}}">{{ucwords(explode('.', \Request::route()->getName())[0])}}</a>
        </li>
        <li class="breadcrumb-item active">
            {{ucwords(explode('.', \Request::route()->getName())[1])}}
        </li>
    @endif
    <li class="breadcrumb-menu d-md-down-none">
        <div class="btn-group" role="group" aria-label="Button group">
            @if(explode('.', \Request::route()->getName())[0]!='admin')
                @if(strpos(\Request::route()->getName(), 'index') !== false)
                    <a href="{{route(explode('.', \Request::route()->getName())[0].'.create')}}" class="btn btn-primary">Create</a>
                @endif
            @endif
        </div>
    </li>
</ol>
