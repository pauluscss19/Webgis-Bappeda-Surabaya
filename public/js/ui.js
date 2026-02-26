// ============================================================
// UI.JS - Logic UI Sidebar
//
// PENTING: toggleFullscreen() DIKELOLA SEPENUHNYA oleh map-init.js
// menggunakan Fullscreen API browser.
// Definisi lama (pakai CSS class) di sini DIHAPUS agar tidak
// konflik/override dengan definisi di map-init.js.
// ============================================================

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