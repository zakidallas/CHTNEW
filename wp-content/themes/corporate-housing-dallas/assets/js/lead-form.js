/**
 * Lead Form Handler
 * Modern form submission with validation
 */

document.addEventListener('DOMContentLoaded', function() {
    const leadForm = document.getElementById('cht-lead-form');
    
    if (leadForm) {
        // Add floating label effect
        const formInputs = leadForm.querySelectorAll('.form-control');
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
            
            // Check on load for pre-filled values
            if (input.value) {
                input.parentElement.classList.add('focused');
            }
        });
        
        // Form submission
        leadForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('[type="submit"]');
            const originalText = submitBtn.textContent;
            
            // Disable button and show loading
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner"></span> Submitting...';
            
            // Get form data
            const formData = new FormData(this);
            formData.append('action', 'cht_submit_lead');
            formData.append('nonce', cht_ajax.nonce);
            formData.append('source_page', window.location.href);
            
            try {
                const response = await fetch(cht_ajax.ajax_url, {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Show success message
                    showNotification('success', data.data.message || 'Thank you! We\'ll contact you soon.');
                    
                    // Reset form
                    this.reset();
                    formInputs.forEach(input => {
                        input.parentElement.classList.remove('focused');
                    });
                    
                    // Track conversion
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'generate_lead', {
                            'event_category': 'engagement',
                            'event_label': 'Lead Form Submission'
                        });
                    }
                } else {
                    showNotification('error', data.data.message || 'Something went wrong. Please try again.');
                }
            } catch (error) {
                showNotification('error', 'Network error. Please check your connection and try again.');
                console.error('Form submission error:', error);
            } finally {
                // Re-enable button
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            }
        });
    }
    
    // Notification system
    function showNotification(type, message) {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type} fade-in`;
        notification.innerHTML = `
            <div class="notification-content">
                <span class="notification-icon">${type === 'success' ? '✓' : '✕'}</span>
                <span class="notification-message">${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Remove after 5 seconds
        setTimeout(() => {
            notification.classList.add('fade-out');
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }
    
    // Phone number formatting
    const phoneInputs = document.querySelectorAll('input[type="tel"]');
    phoneInputs.forEach(input => {
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.length <= 3) {
                    value = `(${value}`;
                } else if (value.length <= 6) {
                    value = `(${value.slice(0, 3)}) ${value.slice(3)}`;
                } else {
                    value = `(${value.slice(0, 3)}) ${value.slice(3, 6)}-${value.slice(6, 10)}`;
                }
            }
            e.target.value = value;
        });
    });
    
    // Date picker enhancement
    const dateInputs = document.querySelectorAll('input[type="date"]');
    dateInputs.forEach(input => {
        // Set min date to today
        const today = new Date().toISOString().split('T')[0];
        input.setAttribute('min', today);
    });
});