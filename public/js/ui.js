// ============================================================
// UI.JS - Logic UI Sidebar dan Fullscreen
// ============================================================

// --- LOGIC UI SIDEBAR ---
const sidebar = document.getElementById('filter-sidebar');
const toggleBtn = document.getElementById('toggle-btn');

function toggleSidebar() {
    sidebar.classList.toggle('hidden');
    if (sidebar.classList.contains('hidden')) {
        toggleBtn.style.display = 'block'; 
    } else {
        toggleBtn.style.display = 'none'; 
    }
}

// ============================================================
// FULLSCREEN FUNCTIONALITY
// ============================================================
function toggleFullscreen() {
    const petaCard = document.querySelector('.peta-card');
    const body = document.body;
    const icon = document.getElementById('fullscreen-icon');
    
    if (!petaCard.classList.contains('fullscreen')) {
        petaCard.classList.add('fullscreen');
        body.classList.add('fullscreen-active');
        icon.classList.remove('bi-arrows-fullscreen');
        icon.classList.add('bi-fullscreen-exit');
        
        setTimeout(() => {
            map.invalidateSize();
        }, 100);
        
    } else {
        petaCard.classList.remove('fullscreen');
        body.classList.remove('fullscreen-active');
        icon.classList.remove('bi-fullscreen-exit');
        icon.classList.add('bi-arrows-fullscreen');
        
        setTimeout(() => {
            map.invalidateSize();
        }, 100);
    }
}

// Event listener untuk Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        const petaCard = document.querySelector('.peta-card');
        if (petaCard.classList.contains('fullscreen')) {
            toggleFullscreen();
        }
    }
});