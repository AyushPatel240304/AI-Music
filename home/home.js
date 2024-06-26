(function() {
    var $body = document.body,
        $menu_trigger = $body.getElementsByClassName('menu-trigger')[0];

    if (typeof $menu_trigger !== 'undefined') {
        $menu_trigger.addEventListener('click', function() {
            $body.className = ($body.className == 'menu-active') ? '' : 'menu-active';
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const navLinks = document.querySelectorAll('#slide-menu ul li a');
        
        // Function to set active class
        function setActiveClass(element) {
            navLinks.forEach(link => link.classList.remove('active'));
            element.classList.add('active');
            localStorage.setItem('activeNav', element.id);
        }
    
        // Add event listeners to nav links
        navLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                setActiveClass(event.target);
            });
        });
    });
}).call(this);
