<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Sistema') - Procesamiento de Datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }

        #sidebar {
            min-height: 100vh;
            background-color: #1e2a38;
            width: 250px;
            position: fixed;
            top: 0; left: 0;
            transition: width 0.3s ease, opacity 0.3s ease;
            overflow: hidden;
            z-index: 100;
        }

        #sidebar.oculto { width: 0 !important; opacity: 0; }

        #sidebar .nav-link {
            color: #cfd8dc;
            padding: .6rem 1rem;
            border-radius: .375rem;
            margin: 2px 8px;
            transition: background 0.2s;
            white-space: nowrap;
            position: relative;
            overflow: hidden;
        }

        #sidebar .nav-link::before {
            content: '';
            position: absolute;
            left: -100%;
            top: 0;
            width: 3px;
            height: 100%;
            background: #4a90d9;
            transition: left 0.3s ease;
            border-radius: 0 3px 3px 0;
        }

        #sidebar .nav-link:hover::before,
        #sidebar .nav-link.active::before { left: 0; }

        #sidebar .nav-link:hover,
        #sidebar .nav-link.active { background: #2e3d4f; color: #fff; }

        #sidebar .nav-link i {
            transition: transform 0.3s ease, color 0.3s ease;
        }

        #sidebar .nav-link:hover i {
            transform: translateX(4px) scale(1.2);
            color: #4a90d9;
        }

        #sidebar .nav-link.active i { color: #4a90d9; }

        #content {
            margin-left: 250px;
            padding: 2rem;
            transition: margin-left 0.3s ease;
        }

        #content.expandido { margin-left: 0 !important; }

        #toggleBtn {
            position: fixed;
            top: 50px;
            left: 238px;
            z-index: 999;
            background: #fff;
            color: #1e2a38;
            border: 1px solid #dee2e6;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
            font-size: .8rem;
        }

        #toggleBtn:hover { background: #1e2a38; color: #fff; transform: scale(1.1); }
        #toggleBtn.sidebar-oculto { left: 1rem; }

        .card { border: none; border-radius: .75rem; }
        .table-hover tbody tr:hover { background-color: #eef2ff; }

        .stat-card {
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
        }

        .col-md-3:nth-child(1) .stat-card { animation-delay: 0.1s; }
        .col-md-3:nth-child(2) .stat-card { animation-delay: 0.2s; }
        .col-md-3:nth-child(3) .stat-card { animation-delay: 0.3s; }
        .col-md-3:nth-child(4) .stat-card { animation-delay: 0.4s; }

        @keyframes fadeInUp {
            from { transform: translateY(20px); opacity: 0; }
            to   { transform: translateY(0);    opacity: 1; }
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,.15);
        }
    </style>
    @yield('estilos')
</head>
<body>

    <button id="toggleBtn" onclick="toggleSidebar()" title="Ocultar/Mostrar menú">
        <i class="bi bi-chevron-left" id="toggleIcon"></i>
    </button>

    <div id="sidebar" class="d-flex flex-column py-3">
        <div class="px-3 mb-4 d-flex align-items-center">
            <img src="/img/logo.png" style="width:40px;" class="me-2">
            <span class="text-white fw-bold">Procesamiento de Datos</span>
        </div>
        <nav class="nav flex-column">
            <a href="/dashboard"    class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
            <a href="/funcionarios" class="nav-link {{ request()->is('funcionarios*') ? 'active' : '' }}"><i class="bi bi-people me-2"></i>Funcionarios</a>
            <a href="/permisos"     class="nav-link {{ request()->is('permisos*') ? 'active' : '' }}"><i class="bi bi-calendar-check me-2"></i>Permisos</a>
            <a href="/asistencias"  class="nav-link {{ request()->is('asistencias*') ? 'active' : '' }}"><i class="bi bi-clock me-2"></i>Asistencias</a>
            <a href="/inventario"   class="nav-link {{ request()->is('inventario*') ? 'active' : '' }}"><i class="bi bi-box-seam me-2"></i>Inventario</a>
            <a href="/usuarios"     class="nav-link {{ request()->is('usuarios*') ? 'active' : '' }}"><i class="bi bi-person-gear me-2"></i>Usuarios</a>
            <a href="/reportes"     class="nav-link {{ request()->is('reportes*') ? 'active' : '' }}"><i class="bi bi-bar-chart me-2"></i>Reportes</a>
        </nav>
        <div class="mt-auto px-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm w-100">
                    <i class="bi bi-box-arrow-left me-1"></i>Cerrar sesión
                </button>
            </form>
        </div>
    </div>

    <div id="content">
        @yield('contenido')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            const icon    = document.getElementById('toggleIcon');
            const btn     = document.getElementById('toggleBtn');

            sidebar.classList.toggle('oculto');
            content.classList.toggle('expandido');
            btn.classList.toggle('sidebar-oculto');

            icon.className = sidebar.classList.contains('oculto')
                ? 'bi bi-chevron-right'
                : 'bi bi-chevron-left';
        }
    </script>
    @yield('scripts')
</body>
</html>
