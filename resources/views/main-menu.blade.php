<ul class="navbar-nav ml-auto flex-nowrap">
    @foreach($items as $menu_item)
        @if(count($menu_item->children) > 0)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{$menu_item->title}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                @foreach($menu_item->children as $item)
                        <a class="dropdown-item" href="{{$item->url}}">{{$item->title}}</a>
                @endforeach
                </div>
            </li>
        @else
            <li class="nav-item"><a class="nav-link" href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a></li>
        @endif
    @endforeach
</ul>
