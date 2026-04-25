@php
    use App\Helpers\MenuHelper;
    $menuItems = MenuHelper::getMenuItems(auth()->user());
    $currentRole = auth()->user()->role;
@endphp

<aside class="sidebar">
    <div class="sidebar-brand">Class-in</div>
    
    <!-- User Info -->
    <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 13px;">
        <div style="color: #cbd5e1; margin-bottom: 4px;">Logged in as</div>
        <div style="color: white; font-weight: 600; margin-bottom: 4px;">{{ auth()->user()->name }}</div>
        <div style="color: #94a3b8; text-transform: capitalize;">{{ $currentRole }}</div>
    </div>

    <ul class="sidebar-menu">
        @foreach($menuItems as $item)
            <li>
                <a href="{{ route($item['route']) }}" 
                   class="@if(request()->routeIs($item['route'])) active @endif">
                    <span class="icon">{{ $item['icon'] }}</span>
                    <span>{{ $item['label'] }}</span>
                </a>
            </li>
        @endforeach
    </ul>

    <!-- Logout Button -->
    <div style="margin-top: auto; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1);">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn" style="width: 100%; padding: 12px 16px; background: #ef4444; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 500; display: flex; align-items: center; gap: 12px; justify-content: center; transition: all 0.3s;">
                <span style="font-size: 18px;">🚪</span>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>

<style>
    .sidebar {
        display: flex;
        flex-direction: column;
    }
    
    .logout-btn:hover {
        background: #dc2626;
    }
</style>