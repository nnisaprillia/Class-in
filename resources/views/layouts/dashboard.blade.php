<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            background: #f8fafc;
        }
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 280px;
            background: #1e293b;
            color: white;
            padding: 20px;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
        .sidebar-brand {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 30px;
            color: #f1f5f9;
        }
        .sidebar-menu {
            list-style: none;
            flex: 1;
        }
        .sidebar-menu li {
            margin-bottom: 10px;
        }
        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .sidebar-menu a:hover {
            background: #334155;
            color: white;
        }
        .sidebar-menu a.active {
            background: #3b82f6;
            color: white;
        }
        .sidebar-menu a .icon {
            font-size: 20px;
        }
        .main-content {
            margin-left: 280px;
            flex: 1;
            padding: 30px;
        }
        .page-header {
            margin-bottom: 30px;
        }
        .page-header h1 {
            font-size: 32px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }
        .page-header p {
            color: #64748b;
            font-size: 14px;
        }
        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .card h3 {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
            margin-bottom: 12px;
        }
        .card .value {
            font-size: 32px;
            font-weight: 700;
            color: #1e293b;
        }
        .card form {
            display: flex;
            flex-direction: column;
        }
        .card form div {
            margin-bottom: 16px;
        }
        .card form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        .card form input {
            width: 100%;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
        }
        .card form input:disabled {
            background: #f8fafc;
        }
        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .course-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .course-card-image {
            height: 140px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .course-card-body {
            padding: 20px;
        }
        .course-card-body h4 {
            font-size: 16px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
        }
        .course-card-body p {
            font-size: 13px;
            color: #94a3b8;
            margin-bottom: 12px;
        }
        .data-table {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .data-table table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table th {
            background: #f1f5f9;
            padding: 16px;
            text-align: left;
            font-weight: 600;
            color: #475569;
            font-size: 14px;
            border-bottom: 1px solid #e2e8f0;
        }
        .data-table td {
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
            color: #1e293b;
        }
        .data-table tbody tr:hover {
            background: #f8fafc;
        }
        .search-box {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
        }
        .search-box input {
            flex: 1;
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
        }
        .btn {
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn-primary {
            background: #3b82f6;
            color: white;
        }
        .btn-primary:hover {
            background: #2563eb;
        }
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        .btn-danger:hover {
            background: #dc2626;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-badge.active {
            background: #dbeafe;
            color: #1e40af;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('partials.sidebar')

        <!-- Main Content -->
        <main class="main-content">
            @yield('content')
        </main>
    </div>
</body>
</html>
