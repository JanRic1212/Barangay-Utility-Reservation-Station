document.addEventListener('DOMContentLoaded', () => {
    const quantityValue = document.querySelector('.quantity-value');
    const incrementBtn = document.querySelector('.increment');
    const decrementBtn = document.querySelector('.decrement');
    const remainingAmount = parseInt(document.querySelector('.remaining').textContent);

    let quantity = 1;

    incrementBtn.addEventListener('click', () => {
        if (quantity < remainingAmount) {
            quantity++;
            quantityValue.textContent = quantity;
        }
    });

    decrementBtn.addEventListener('click', () => {
        if (quantity > 1) {
            quantity--;
            quantityValue.textContent = quantity;
        }
    });

    // Placeholder functionality for buttons
    document.querySelector('.add-to-list').addEventListener('click', () => {
        alert('Added to list!');
    });

    document.querySelector('.proceed').addEventListener('click', () => {
        alert('Proceeding...');
    });
});