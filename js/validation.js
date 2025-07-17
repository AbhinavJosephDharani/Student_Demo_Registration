// Client-side validation for the student registration form
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registrationForm');
    if (!form) return;

    // Validation patterns
    const patterns = {
        studentId: /^\d{8}$/,
        name: /^[a-zA-Z\s]+$/,
        email: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
        phone: /^\d{3}-\d{3}-\d{4}$/,
        projectTitle: /^.+$/
    };

    // Validation messages
    const messages = {
        studentId: 'Student ID must be exactly 8 digits',
        firstName: 'First name must contain only letters and cannot be empty',
        lastName: 'Last name must contain only letters and cannot be empty',
        email: 'Please enter a valid email address',
        phone: 'Phone number must be in format: 999-999-9999',
        projectTitle: 'Project title cannot be empty',
        timeSlot: 'Please select a time slot'
    };

    // Get form elements
    const studentIdInput = document.getElementById('studentId');
    const firstNameInput = document.getElementById('firstName');
    const lastNameInput = document.getElementById('lastName');
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');
    const projectTitleInput = document.getElementById('projectTitle');
    const timeSlotInputs = document.querySelectorAll('input[name="timeSlot"]');

    // Real-time validation functions
    function validateField(input, pattern, message) {
        const value = input.value.trim();
        const errorElement = input.parentNode.querySelector('.error-message');
        
        if (!value) {
            showError(input, 'This field is required');
            return false;
        }
        
        if (!pattern.test(value)) {
            showError(input, message);
            return false;
        }
        
        hideError(input);
        return true;
    }

    function showError(input, message) {
        input.classList.remove('success');
        input.classList.add('error');
        const errorElement = input.parentNode.querySelector('.error-message');
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.classList.add('show');
        }
    }

    function hideError(input) {
        input.classList.remove('error');
        input.classList.add('success');
        const errorElement = input.parentNode.querySelector('.error-message');
        if (errorElement) {
            errorElement.classList.remove('show');
        }
    }

    // Email validation with domain restrictions
    function validateEmail(email) {
        const basicPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!basicPattern.test(email)) {
            return false;
        }
        
        const parts = email.split('@');
        if (parts.length !== 2) {
            return false;
        }
        
        const domain = parts[1];
        const labels = domain.split('.');
        
        // Check total domain length (max 80 characters including dots)
        if (domain.length > 80) {
            return false;
        }
        
        // Check each label (1-20 alphanumeric characters)
        for (let label of labels) {
            if (label.length < 1 || label.length > 20 || !/^[a-zA-Z0-9]+$/.test(label)) {
                return false;
            }
        }
        
        return true;
    }

    // Time slot selection
    function handleTimeSlotSelection() {
        timeSlotInputs.forEach(input => {
            input.addEventListener('change', function() {
                // Remove selected class from all time slots
                document.querySelectorAll('.time-slot').forEach(slot => {
                    slot.classList.remove('selected');
                });
                
                // Add selected class to chosen time slot
                if (this.checked) {
                    const timeSlotId = this.value;
                    const timeSlotElement = document.querySelector(`[data-time-slot-id="${timeSlotId}"]`);
                    if (timeSlotElement) {
                        timeSlotElement.classList.add('selected');
                    }
                }
            });
        });
    }

    // Real-time validation event listeners
    if (studentIdInput) {
        studentIdInput.addEventListener('input', function() {
            validateField(this, patterns.studentId, messages.studentId);
        });
    }

    if (firstNameInput) {
        firstNameInput.addEventListener('input', function() {
            validateField(this, patterns.name, messages.firstName);
        });
    }

    if (lastNameInput) {
        lastNameInput.addEventListener('input', function() {
            validateField(this, patterns.name, messages.lastName);
        });
    }

    if (emailInput) {
        emailInput.addEventListener('input', function() {
            const isValid = validateEmail(this.value.trim());
            if (isValid) {
                hideError(this);
            } else {
                showError(this, messages.email);
            }
        });
    }

    if (phoneInput) {
        phoneInput.addEventListener('input', function() {
            validateField(this, patterns.phone, messages.phone);
        });
    }

    if (projectTitleInput) {
        projectTitleInput.addEventListener('input', function() {
            validateField(this, patterns.projectTitle, messages.projectTitle);
        });
    }

    // Initialize time slot selection
    handleTimeSlotSelection();

    // Form submission validation
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        let isValid = true;
        
        // Validate all fields
        if (studentIdInput && !validateField(studentIdInput, patterns.studentId, messages.studentId)) {
            isValid = false;
        }
        
        if (firstNameInput && !validateField(firstNameInput, patterns.name, messages.firstName)) {
            isValid = false;
        }
        
        if (lastNameInput && !validateField(lastNameInput, patterns.name, messages.lastName)) {
            isValid = false;
        }
        
        if (emailInput) {
            const emailValid = validateEmail(emailInput.value.trim());
            if (!emailValid) {
                showError(emailInput, messages.email);
                isValid = false;
            }
        }
        
        if (phoneInput && !validateField(phoneInput, patterns.phone, messages.phone)) {
            isValid = false;
        }
        
        if (projectTitleInput && !validateField(projectTitleInput, patterns.projectTitle, messages.projectTitle)) {
            isValid = false;
        }
        
        // Check if time slot is selected
        const selectedTimeSlot = document.querySelector('input[name="timeSlot"]:checked');
        if (!selectedTimeSlot) {
            const timeSlotError = document.getElementById('timeSlotError');
            if (timeSlotError) {
                timeSlotError.textContent = messages.timeSlot;
                timeSlotError.classList.add('show');
            }
            isValid = false;
        } else {
            const timeSlotError = document.getElementById('timeSlotError');
            if (timeSlotError) {
                timeSlotError.classList.remove('show');
            }
        }
        
        if (isValid) {
            // Show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="loading"></span> Submitting...';
            submitBtn.disabled = true;
            
            // Submit form
            form.submit();
        } else {
            // Scroll to first error
            const firstError = form.querySelector('.error');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });

    // Auto-format phone number
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 3) {
                value = value.slice(0, 3) + '-' + value.slice(3);
            }
            if (value.length >= 7) {
                value = value.slice(0, 7) + '-' + value.slice(7, 11);
            }
            e.target.value = value;
        });
    }
});

// Utility function to show alerts
function showAlert(message, type = 'info') {
    const alertContainer = document.createElement('div');
    alertContainer.className = `alert alert-${type}`;
    alertContainer.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'}"></i>
        <span>${message}</span>
    `;
    
    const container = document.querySelector('.container');
    if (container) {
        container.insertBefore(alertContainer, container.firstChild);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            alertContainer.remove();
        }, 5000);
    }
}

// Utility function to update time slot availability
function updateTimeSlotAvailability() {
    fetch('get_availability.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(slot => {
                const timeSlotElement = document.querySelector(`[data-time-slot-id="${slot.id}"]`);
                if (timeSlotElement) {
                    const seatsElement = timeSlotElement.querySelector('.time-slot-seats');
                    if (seatsElement) {
                        seatsElement.textContent = `${slot.available_seats} seats remaining`;
                        seatsElement.className = `time-slot-seats ${slot.available_seats > 0 ? 'seats-available' : 'seats-full'}`;
                    }
                    
                    if (slot.available_seats === 0) {
                        timeSlotElement.classList.add('full');
                        const radioInput = timeSlotElement.querySelector('input[type="radio"]');
                        if (radioInput) {
                            radioInput.disabled = true;
                        }
                    } else {
                        timeSlotElement.classList.remove('full');
                        const radioInput = timeSlotElement.querySelector('input[type="radio"]');
                        if (radioInput) {
                            radioInput.disabled = false;
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error updating availability:', error);
        });
}

// Update availability every 30 seconds
setInterval(updateTimeSlotAvailability, 30000); 