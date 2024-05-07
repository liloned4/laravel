@php
    $configData = Helper::appClasses();
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <!-- ! Hide app brand if navbar-full -->
    @if (!isset($navbarFull))
        <div class="app-brand demo">
            <a href="{{ url('si-dandang/dashboard') }}" class="app-brand-link">
                <span class="app-brand-logo demo"
                    style="background: url('/assets/img/si-dandang/datu.png') no-repeat center center; background-size: cover; display: inline-block; width: 40 px; height: 40 px;">
                </span>
                <span class="app-brand-text demo menu-text fw-bold">{{ config('variables.dandangName') }}</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
        </div>
    @endif


    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @foreach ($menuData[0]->menu as $menu)
            {{-- adding active and open class if child is active --}}
            {{-- menu headers --}}
            @if (isset($menu->menuHeader))
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">{{ __($menu->menuHeader) }}</span>
                </li>
            @else
                {{-- active menu method --}}
                @php
                    $activeClass = null;
                    $currentRoute = url()->current();
                    $menuUrl = isset($menu->url) ? url($menu->url) : '';

                    // Check if current URL matches the menu URL
                    if ($menuUrl === $currentRoute) {
                        $activeClass = 'active';
                    }
                    // Check if current URL contains "/edit/73" and the menu is not Dashboard
                    if (strpos($currentRoute, '/edit/') !== false && $menu->slug !== 'dandang-dashboard') {
                        $activeClass = 'active';
                    }
                @endphp
                {{-- main menu --}}
                <li class="menu-item {{ $activeClass }}">
                    <a href="{{ $menuUrl }}"
                        class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}"
                        @if (isset($menu->target) and !empty($menu->target)) target="_blank" @endif>
                        @isset($menu->icon)
                            <i class="{{ $menu->icon }}"></i>
                        @endisset
                        <div>{{ isset($menu->name) ? __($menu->name) : '' }}</div>
                        @isset($menu->badge)
                            <div class="badge bg-{{ $menu->badge[0] }} rounded-pill ms-auto">{{ $menu->badge[1] }}</div>
                        @endisset
                    </a>
                    {{-- submenu --}}
                    @isset($menu->submenu)
                        @include('layouts.sections.menu.submenu', ['menu' => $menu->submenu])
                    @endisset
                </li>
            @endif
        @endforeach
    </ul>
</aside>
