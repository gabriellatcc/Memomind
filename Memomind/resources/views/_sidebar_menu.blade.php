<div id="menu-overlay" class="menu-overlay" onclick="toggleMenu()"></div>

<button id="open-menu-btn" class="tech-hamburger" onclick="toggleMenu()">
    <i class="fa-solid fa-bars"></i>
</button>

<aside id="sidebar-menu" class="tech-sidebar">
    <div class="sidebar-header">
        <button id="close-menu-btn" class="btn-close-tech" onclick="toggleMenu()">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div class="menu-group">
        <a href="{{ url('/main') }}" 
           class="btn-tech-menu {{ Request::is('main*') ? 'btn-active-red' : 'border-red' }}">
            <i class="fa-solid fa-house" style="margin-right: 10px;"></i> Início
        </a>

        <a href="{{ url('/documentacao') }}" 
           class="btn-tech-menu {{ Request::is('documentacao*') ? 'btn-active-green' : 'border-green' }}">
            <i class="fa-solid fa-book" style="margin-right: 10px;"></i> documentação
        </a>

        <a href="{{ url('/ranking') }}" 
           class="btn-tech-menu {{ Request::is('ranking') ? 'btn-active-yellow' : 'border-yellow' }}">
            <i class="fa-solid fa-trophy" style="margin-right: 10px;"></i> Ranking
        </a>
    </div>

    <div class="menu-bottom">
        <a href="{{ url('/configuracoes') }}" 
           class="btn-tech-menu {{ Request::is('configuracoes*') || Request::is('settings*') ? 'btn-active-green' : 'border-green' }}">
            <i class="fa-solid fa-gear" style="margin-right: 10px;"></i> Configurações
        </a>
        
        <form action="{{ route('logout') }}" method="POST" style="width: 100%;">
            @csrf
            <button type="submit" class="btn-tech-menu border-red" style="width: 100%; cursor: pointer;">
                 Sair
            </button>
        </form>
    </div>
</aside>

<script>
    function toggleMenu() {
        const sidebar = document.getElementById('sidebar-menu');
        const overlay = document.getElementById('menu-overlay');
        const openBtn = document.getElementById('open-menu-btn');
        
        const isOpen = sidebar.classList.toggle('open');
        overlay.classList.toggle('active');
        
        if (isOpen) {
            openBtn.style.opacity = '0';
            setTimeout(() => openBtn.style.display = 'none', 300);
        } else {
            openBtn.style.display = 'flex';
            setTimeout(() => openBtn.style.opacity = '1', 10);
        }
    }
</script>