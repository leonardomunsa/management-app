// Import Bootstrap (optional, if you're using it)
// import 'bootstrap';

// Import your CSS
import '../css/app.css';

// Example: Basic JavaScript functionality
document.addEventListener('DOMContentLoaded', () => {
    console.log('App.js loaded successfully!');

    // Example: Add simple interactivity (optional)
    const toggleButton = document.querySelector('#toggleButton');
    const messageDiv = document.querySelector('#messageDiv');

    if (toggleButton && messageDiv) {
        toggleButton.addEventListener('click', () => {
            messageDiv.classList.toggle('hidden');
        });
    }
});
