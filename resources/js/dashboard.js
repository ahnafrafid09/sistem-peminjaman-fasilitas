document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebarTexts = sidebar.querySelectorAll('.sidebar-text');
    const mainContainer = document.getElementById("main-container");

    toggleBtn.addEventListener('click', () => {
        const isCollapsed = sidebar.classList.contains('w-16');

        if (isCollapsed) {
            sidebar.classList.remove('w-16');
            sidebar.classList.add('w-64');
            sidebarTexts.forEach(el => {
                el.classList.remove('opacity-0', 'pointer-events-none', 'hidden');
            });

            mainContainer.classList.add('pl-66')
            mainContainer.classList.remove('pl-0')
        } else {
            sidebar.classList.remove('w-64');
            sidebar.classList.add('w-16');
            sidebarTexts.forEach(el => {
                el.classList.add('opacity-0', 'pointer-events-none', 'hidden');
            });
            mainContainer.classList.remove('pl-66')
            mainContainer.classList.add('pl-18')
        }
    });
});