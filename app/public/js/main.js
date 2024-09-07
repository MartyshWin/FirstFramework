document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('theme').onclick = function() {
        ChangeTheme();
    };

    function ChangeTheme() {
        let element = document.documentElement;
        let theme = document.getElementById('theme');

        if (element.getAttribute('data-bs-theme') == 'light') {
            element.setAttribute('data-bs-theme', 'dark');
            theme.innerHTML = '<i class="bi bi-brightness-high"></i>';
        }else {
            element.setAttribute('data-bs-theme', 'light');
            theme.innerHTML = '<i class="bi bi-moon"></i>';
        }
    }

    function InsertMyIP(field_id, ip) {
        let field = document.getElementById(field_id);
        field.value = ip;
    }
});
