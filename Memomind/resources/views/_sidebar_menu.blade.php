<button id="open-menu-btn" class="hamburger-btn" onclick="toggleMenu()">
    &#9776;
</button>

<div id="sidebar-menu" class="sidebar-menu">
    <div class="menu-header">
        <span class="menu-title">≡</span>
        <button id="close-menu-btn" class="menu-toggle-btn" onclick="toggleMenu()">
            &times; 
        </button>
    </div>
    
    <nav class="menu-nav">
        <a href="{{ route('main') }}" class="menu-item home-item" onclick="toggleMenu()">Início</a>
        <a href="{{ route('ranking') }}" class="menu-item ranking-item" onclick="toggleMenu()">Ranking</a>
        <a href="{{ route('doc') }}" class="menu-item doc-item" onclick="toggleMenu()">Documentação</a>
        <a href="{{ route('settings') }}" class="menu-item settings-item" onclick="toggleMenu()">Configurações</a>
    </nav>

    <div class="menu-footer">
        <form id="logout-menu-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        
        <a href="#" class="menu-item logout-item" onclick="event.preventDefault(); document.getElementById('logout-menu-form').submit();">
            Sair
        </a>
    </div>
</div>

<script>

    function toggleMenu() {
        const sidebar = document.getElementById('sidebar-menu');
        const openBtn = document.getElementById('open-menu-btn');
        
        const isOpen = sidebar.classList.toggle('open');
        
        openBtn.style.display = isOpen ? 'none' : 'block';
    }
</script>