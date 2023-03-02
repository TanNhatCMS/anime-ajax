    <div id="sidebar_menu_bg"></div>
    <div id="wrapper" data-page="page_home">
    
	<div id="sidebar_menu">
        <button class="btn btn-radius btn-sm btn-secondary toggle-sidebar"><i class="fas fa-angle-left mr-2"></i>Close menu</button>
        <div class="sb-setting">
            <div class="header-setting">
            </div>
        </div>
        <ul class="nav sidebar_menu-list">
            <ul>
                @foreach ($menu as $item)
                    @if (count($item['children']))
                        <li
                            class="nav-item">
                            <div class="nav-link" title="{{ $item['name'] }}">
                                <a href="{{ $item['link'] }}">{{ $item['name'] }}</a>
                            </div>
                            <div class="sidebar_menu-sub show" id="sidebar_subs_types">
                                <ul class="nav sub-menu color-list">
                                    @foreach ($item['children'] as $children)
                                        <li class="nav-item"><a class="nav-link" title="{{ $children['name'] }}"
                                            href="{{ $children['link'] }}">{{ $children['name'] }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link"  href="{{ $item['link'] }}">{{ $item['name'] }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        <div class="clearfix"></div>
    </div>