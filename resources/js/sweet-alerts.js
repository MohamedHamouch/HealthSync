/**
 * SweetAlert Implementation for HealthSync
 * 
 * This file replaces standard browser alerts and confirmations with SweetAlert
 */

document.addEventListener('DOMContentLoaded', function() {
    // Replace standard confirmations with SweetAlert
    replaceConfirmations();
    
    // Show success messages with SweetAlert
    showSuccessMessages();
});

/**
 * Replace standard browser confirmations with SweetAlert
 */
function replaceConfirmations() {
    // Find all forms that use the onsubmit="return confirm()" pattern
    document.querySelectorAll('form[onsubmit*="return confirm"]').forEach(form => {
        // Extract the confirmation message
        const onsubmitAttr = form.getAttribute('onsubmit');
        const match = onsubmitAttr.match(/confirm\('([^']+)'\)/);
        
        if (match && match[1]) {
            const confirmMessage = match[1];
            const formId = 'sweetalert-form-' + Math.random().toString(36).substr(2, 9);
            
            // Set a unique ID for the form
            form.setAttribute('id', formId);
            
            // Remove the onsubmit attribute
            form.removeAttribute('onsubmit');
            
            // Find the submit button in the form
            const submitButton = form.querySelector('button[type="submit"]');
            
            if (submitButton) {
                // Change it to button type to prevent automatic form submission
                submitButton.setAttribute('type', 'button');
                
                // Add click event
                submitButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    Swal.fire({
                        title: 'Are you sure?',
                        text: confirmMessage,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Use form.submit() instead of relying on the ID which might not be present
                            form.submit();
                        }
                    });
                });
            }
        }
    });
    
    // Find all elements with onclick="return confirm()" pattern
    document.querySelectorAll('[onclick*="return confirm"]').forEach(element => {
        // Extract the confirmation message
        const onclickAttr = element.getAttribute('onclick');
        const match = onclickAttr.match(/confirm\('([^']+)'\)/);
        
        if (match && match[1]) {
            const confirmMessage = match[1];
            const originalCode = onclickAttr.replace(/return confirm\('[^']+'\)/, '');
            
            // Remove the onclick attribute
            element.removeAttribute('onclick');
            
            // Add click event
            element.addEventListener('click', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: confirmMessage,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed && originalCode.trim()) {
                        // If there's additional code after the confirmation, execute it
                        eval(originalCode);
                    } else if (result.isConfirmed) {
                        // If it's a simple link, continue with navigation
                        if (element.tagName === 'A') {
                            window.location.href = element.getAttribute('href');
                        } else if (element.closest('form')) {
                            // If the element is inside a form, submit the form
                            element.closest('form').submit();
                        }
                    }
                });
            });
        }
    });
}

/**
 * Show success messages with SweetAlert
 */
function showSuccessMessages() {
    // Find success message containers
    const successMessages = document.querySelectorAll('.bg-green-100.border-l-4.border-green-500');
    
    successMessages.forEach(container => {
        const message = container.textContent.trim();
        
        if (message) {
            // Show success message with SweetAlert
            Swal.fire({
                title: 'Success',
                text: message,
                icon: 'success',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
            
            // Hide the original message container
            container.style.display = 'none';
        }
    });
}

// Replace regular alert with SweetAlert
window.alert = function(message) {
    Swal.fire({
        title: 'Information',
        text: message,
        icon: 'info',
        confirmButtonColor: '#3085d6'
    });
}; 