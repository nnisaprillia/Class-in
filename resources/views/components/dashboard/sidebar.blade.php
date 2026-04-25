@props(['role' => 'student', 'menuItems' => []])

@php
$roleColors = [
    'admin' => '#3b82f6',
    'instructor' => '#10b981',
    'student' => '#f59e0b',
];

$roleAvatars = [
    'admin' => 'A',
    'instructor' => 'I',
    'student' => 'S',
];

$color = $roleColors[$role] ?? '#3b82f6';
$avatar = $roleAvatars[$role] ?? 'U';
$roleLabel = ucfirst($role);
@endphp

<style>
    .dsidebar {
        --sidebar-bg: #1e293b;
        --sidebar-color: #94a3b8;
        --sidebar-active: {{ $color }};
        --sidebar-width: 260px;
    }
    
    .dsidebar * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    .dsidebar body {
        font-family: system-ui, -apple-system, sans-serif;
        background-color: #f3f4f6;
        min-height: 100vh;
    }
    
    /* Sidebar Styles */
    .dsidebar .sidebar { 
        position: fixed; 
        left: 0; 
        top: 0; 
        height: 100vh; 
        width: var(--sidebar-width); 
        background: var(--sidebar-bg); 
        color: white; 
        transition: transform 0.3s ease; 
        z-index: 1000; 
        overflow-y: auto; 
    }
    .dsidebar .sidebar.closed { 
        transform: translateX(-100%); 
    }
    .dsidebar .sidebar-header { 
        padding: 20px; 
        border-bottom: 1px solid #334155; 
    }
    .dsidebar .sidebar-header h2 { 
        font-size: 20px; 
        font-weight: 600; 
    }
    .dsidebar .sidebar-header .role-badge { 
        display: inline-block; 
        padding: 4px 12px; 
        background: var(--sidebar-active); 
        border-radius: 20px; 
        font-size: 12px; 
        margin-top: 8px; 
    }
    .dsidebar .sidebar-menu { 
        padding: 16px 0; 
    }
    .dsidebar .menu-item { 
        display: block; 
        padding: 12px 20px; 
        color: var(--sidebar-color); 
        text-decoration: none; 
        transition: all 0.2s; 
        cursor: pointer; 
    }
    .dsidebar .menu-item:hover { 
        background: #334155; 
        color: white; 
    }
    .dsidebar .menu-item.active { 
        background: var(--sidebar-active); 
        color: white; 
    }
    .dsidebar .sidebar-footer { 
        position: absolute; 
        bottom: 0; 
        left: 0; 
        right: 0; 
        padding: 16px 20px; 
        border-top: 1px solid #334155; 
    }
    .dsidebar .user-info { 
        display: flex; 
        align-items: center; 
        gap: 12px; 
    }
    .dsidebar .user-avatar { 
        width: 40px; 
        height: 40px; 
        border-radius: 50%; 
        background: var(--sidebar-active); 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-weight: 600; 
        flex-shrink: 0; 
    }
    .dsidebar .user-details { 
        flex: 1; 
        min-width: 0; 
    }
    .dsidebar .user-name { 
        font-weight: 500; 
        font-size: 14px; 
        white-space: nowrap; 
        overflow: hidden; 
        text-overflow: ellipsis; 
    }
    .dsidebar .user-email { 
        font-size: 12px; 
        color: var(--sidebar-color); 
        white-space: nowrap; 
        overflow: hidden; 
        text-overflow: ellipsis; 
    }
    
    /* Toggle Button - Fixed position */
    .dsidebar .sidebar-toggle { 
        position: fixed; 
        left: 20px; 
        top: 20px; 
        z-index: 1001; 
        background: var(--sidebar-bg); 
        color: white; 
        border: none; 
        padding: 12px 14px; 
        border-radius: 8px; 
        cursor: pointer; 
        transition: left 0.3s ease, transform 0.3s ease; 
    }
    .dsidebar .sidebar-toggle:hover { 
        background: #334155; 
    }
    .dsidebar .sidebar-toggle.shifted { 
        left: 280px; 
    }
    
    /* Main Content Wrapper */
    .dsidebar .content-wrapper { 
        padding: 30px; 
        padding-top: 80px; 
    }
    
    /* Page Header */
    .dsidebar .page-header { 
        background: white; 
        padding: 24px; 
        border-radius: 8px; 
        margin-bottom: 24px; 
        box-shadow: 0 1px 3px rgba(0,0,0,0.1); 
    }
    .dsidebar .page-header h1 { 
        font-size: 24px; 
        font-weight: 600; 
        color: #1e293b; 
    }
    .dsidebar .page-header p { 
        color: #64748b; 
        margin-top: 4px; 
    }
    
    .dsidebar .content-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); 
        gap: 20px; 
        margin-bottom: 24px; 
    }
    .dsidebar .card { 
        background: white; 
        padding: 24px; 
        border-radius: 8px; 
        box-shadow: 0 1px 3px rgba(0,0,0,0.1); 
    }
    .dsidebar .card h3 { 
        font-size: 14px; 
        color: #64748b; 
        font-weight: 500; 
        margin-bottom: 8px; 
    }
    .dsidebar .card .value { 
        font-size: 32px; 
        font-weight: 700; 
        color: #1e293b; 
    }
    
    .dsidebar .data-table { 
        background: white; 
        border-radius: 8px; 
        box-shadow: 0 1px 3px rgba(0,0,0,0.1); 
        overflow: hidden; 
    }
    .dsidebar .data-table table { 
        width: 100%; 
        border-collapse: collapse; 
    }
    .dsidebar .data-table th, 
    .dsidebar .data-table td { 
        padding: 16px 20px; 
        text-align: left; 
        border-bottom: 1px solid #e2e8f0; 
    }
    .dsidebar .data-table th { 
        background: #f8fafc; 
        font-weight: 600; 
        font-size: 14px; 
        color: #475569; 
    }
    .dsidebar .data-table td { 
        font-size: 14px; 
    }
    .dsidebar .status-badge { 
        display: inline-block; 
        padding: 4px 12px; 
        border-radius: 20px; 
        font-size: 12px; 
        font-weight: 500; 
    }
    .dsidebar .status-badge.active { 
        background: #dcfce7; 
        color: #166534; 
    }
    
    .dsidebar .btn { 
        display: inline-block; 
        padding: 8px 16px; 
        border-radius: 6px; 
        font-size: 14px; 
        font-weight: 500; 
        cursor: pointer; 
        border: none; 
        text-decoration: none; 
    }
    .dsidebar .btn-primary { 
        background: var(--sidebar-active); 
        color: white; 
    }
    .dsidebar .btn-danger { 
        background: #dc2626; 
        color: white; 
    }
    .dsidebar .logout-form { 
        margin-top: 12px; 
    }
    
    /* Responsive - Mobile */
    @media (max-width: 768px) {
        .dsidebar .sidebar { 
            width: 280px; 
        }
        .dsidebar .sidebar.closed { 
            transform: translateX(-100%); 
        }
        .dsidebar .sidebar-toggle.shifted { 
            left: 290px; 
        }
        .dsidebar .content-wrapper { 
            padding: 20px; 
            padding-top: 80px; 
        }
        .dsidebar .page-header { 
            padding: 20px; 
        }
        .dsidebar .page-header h1 { 
            font-size: 20px; 
        }
        .dsidebar .content-grid { 
            grid-template-columns: 1fr; 
        }
        .dsidebar .data-table { 
            overflow-x: auto; 
        }
        .dsidebar .data-table table { 
            min-width: 600px; 
        }
    }
    
    /* Overlay for mobile */
    .dsidebar .sidebar-overlay { 
        display: none; 
        position: fixed; 
        top: 0; 
        left: 0; 
        right: 0; 
        bottom: 0; 
        background: rgba(0,0,0,0.5); 
        z-index: 999; 
    }
    .dsidebar .sidebar-overlay.show { 
        display: block; 
    }
</style>

<div class="dsidebar">
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
    <button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">☰</button>
    <aside class="sidebar closed" id="sidebar">
        <div class="sidebar-header">
            <h2>Class-in</h2>
            <span class="role-badge">{{ $roleLabel }}</span>
        </div>
        <nav class="sidebar-menu">
            @foreach($menuItems as $item)
                <a class="menu-item {{ $loop->first ? 'active' : '' }}" 
                   data-page="{{ $item['id'] }}" 
                   onclick="showPage('{{ $item['id'] }}')">
                    {!! $item['icon'] !!} {{ $item['label'] }}
                </a>
            @endforeach
        </nav>
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">{{ $avatar }}</div>
                <div class="user-details">
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-email">{{ auth()->user()->email }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="btn btn-danger" style="width: 100%; margin-top: 12px;">Logout</button>
            </form>
        </div>
    </aside>

    <div class="content-wrapper" id="contentWrapper">
        {{ $slot }}
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarToggle');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.toggle('closed');
            toggle.classList.toggle('shifted');
            overlay.classList.toggle('show');
        }
        
        function showPage(pageId) {
            // Hide all pages
            const pages = document.querySelectorAll('[id^="page-"]');
            pages.forEach(p => {
                p.style.display = 'none';
            });
            
            // Show selected page
            const selected = document.getElementById('page-' + pageId);
            if (selected) {
                selected.style.display = 'block';
            }
            
            // Update active menu
            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('active');
            });
            
            const clickedItem = document.querySelector(`.menu-item[data-page="${pageId}"]`);
            if (clickedItem) {
                clickedItem.classList.add('active');
            }
        }
    </script>
</div>