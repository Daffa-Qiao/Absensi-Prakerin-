// theme.js
document.addEventListener('DOMContentLoaded', function() {
    var themeToggle = document.getElementById('themeToggle');
    var themeColors = document.querySelector('.theme-colors');
    var chevronUp = document.querySelector('.theme-selector .up');
    var chevronDown = document.querySelector('.theme-selector .down');

    // Toggle the display of the theme colors
    themeToggle.addEventListener('click', function() {
        if (themeColors.style.display === 'none' || themeColors.style.display === '') {
            themeColors.style.display = 'flex';
            chevronUp.style.display = 'none';
            chevronDown.style.display = 'block';
        } else {
            themeColors.style.display = 'none';
            chevronUp.style.display = 'block';
            chevronDown.style.display = 'none';
        }
    });

    // Function to set the theme
    const setTheme = theme => {
        const themeColors = {
            blue: 'linear-gradient(181deg, #00a2e9 85%, rgba(255, 255, 255, 0.63) 100%)',
            green: 'linear-gradient(181deg, #81A263 85%, rgba(48, 142, 115, 1) 100%)',
            orange: 'linear-gradient(181deg, #ECB159 85%, #B77452 100%)',
            pink: 'linear-gradient(181deg, #FA7070 85%, #D9D9D9 100%)'
        };

        if (themeColors[theme]) {
            document.documentElement.style.setProperty('--bs-body-bg', themeColors[theme]);
            document.body.style.backgroundColor = themeColors[theme];
        } else {
            document.body.style.backgroundColor = '#fff'; // fallback
        }
    };

    // Functions to handle localStorage for theme
    const getStoredTheme = () => localStorage.getItem('theme');
    const setStoredTheme = theme => localStorage.setItem('theme', theme);

    // Get the user's preferred theme
    const getPreferredTheme = () => {
        const storedTheme = getStoredTheme();
        return storedTheme || 'blue'; // Default theme
    };

    // Show active theme on the UI
    const showActiveTheme = theme => {
        const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`);
        document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
            element.classList.remove('active');
            element.setAttribute('aria-pressed', 'false');
        });
        if (btnToActive) {
            btnToActive.classList.add('active');
            btnToActive.setAttribute('aria-pressed', 'true');
        }
    };

    // Initialize theme on load
    const initializeTheme = () => {
        const preferredTheme = getPreferredTheme();
        setTheme(preferredTheme);
        showActiveTheme(preferredTheme);
    };

    // Initialize the theme when the document is ready
    initializeTheme();

    // Add event listeners to the color divs
    var colors = document.querySelectorAll('.theme-colors .color');
    colors.forEach(function(colorDiv) {
        colorDiv.addEventListener('click', function() {
            var selectedColor = colorDiv.getAttribute('data-bs-theme-value');
            setTheme(selectedColor);
            setStoredTheme(selectedColor);
            showActiveTheme(selectedColor);
        });
    });
});
