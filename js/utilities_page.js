document.addEventListener('DOMContentLoaded', () => {
    // Handle image clicks
    const images = document.querySelectorAll('.clickable');
    images.forEach(image => {
        image.addEventListener('click', () => {
            window.location.href = '../php/utility.php';
        });
    });

    // Handle dropdown menu
    const dropdown = document.querySelector('.dropdown');
    const dropdownBtn = document.querySelector('.dropdown-btn');
    const dropdownContent = document.querySelector('.dropdown-content');

    dropdownBtn.addEventListener('click', () => {
        dropdown.classList.toggle('open');
    });

    // Close dropdown if clicking outside
    document.addEventListener('click', (event) => {
        if (!dropdown.contains(event.target)) {
            dropdown.classList.remove('open');
        }
    });
});