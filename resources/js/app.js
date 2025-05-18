// resources/js/app.js

import './bootstrap';

// Alpine.js initialization
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// Bootstrap initialization
import * as bootstrap from 'bootstrap';

// Initialize Bootstrap components globally
document.addEventListener('DOMContentLoaded', function() {
    // Initialize جميع المكونات التي تحتاجها
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    
    // مثال: تفعيل dropdowns
    var dropdowns = document.querySelectorAll('.dropdown-toggle')
    dropdowns.forEach(function(dropdown) {
        new bootstrap.Dropdown(dropdown)
    })
})