// Refactored function to activate a specified element after a delay
function activateElementAfterDelay(selector) {
    setTimeout(function() {
        fetch('http://localhost/trongate_mx/tasks/list')
            .then(response => response.text())
            .then(data => {
                var targetElement = document.querySelector(selector);
                if (targetElement) {
                    targetElement.innerHTML = data;
                } else {
                    console.error('Element not found with selector:', selector);
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }, 3000); // 3000 milliseconds = 3 seconds
}



// Function to activate loader on a specified element
function activateLoader(element) {
    if (element) {
        element.classList.remove('mx-indicator-hidden');
        element.classList.add('mx-indicator');
    }
}

// Function to hide loader on a specified element
function hideLoader(element) {
    if (element) {
        element.classList.remove('mx-indicator');
        element.classList.add('mx-indicator-hidden');
    }
}

function listenForSubmission(form) {
    form.addEventListener('submit', event => {
        event.preventDefault(); // Prevent default form submission
        
        const formData = new FormData(form);
        const url = form.getAttribute('mx-post');
        const indicatorSelector = form.querySelector('[mx-indicator]').getAttribute('mx-indicator');
        const indicatorEl = indicatorSelector ? document.querySelector(indicatorSelector) : null;
        const submitButton = form.querySelector('button[type="submit"]');
        
        if (submitButton) {
            submitButton.disabled = true; // Disable submit button
        }
        
        if (indicatorEl && indicatorEl.classList.contains('mx-indicator-hidden')) {
            activateLoader(indicatorEl);
        }
        
        console.log('API URL:', url);
        console.log('Form Data:', formData);
        
        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (indicatorEl) {
                hideLoader(indicatorEl);
            }
            
            console.log('HTTP Status:', response.status);
            
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            
            return response.text();
        })
        .then(data => {
            const targetSelector = form.getAttribute('mx-target');
            const targetElement = document.querySelector(targetSelector);
            
            if (targetElement) {
                targetElement.innerHTML = data; // Update target element with response data
            } else {
                console.error('Target element not found:', targetSelector);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle errors as needed
        })
        .finally(() => {
            if (submitButton) {
                submitButton.disabled = false; // Enable submit button after request completes
            }
        });
    });
}

// Wait for the document to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Find all elements with the mx-indicator class
    var elementsWithIndicator = document.querySelectorAll('.mx-indicator');

    // Loop through each element and ensure it starts hidden
    elementsWithIndicator.forEach(function(element) {
        element.classList.remove('mx-indicator');
        element.classList.add('mx-indicator-hidden');
        element.style.display = ''; // Remove inline style "display: none;"
    });

    // Find all forms with mx-post attribute
    var forms = document.querySelectorAll('form[mx-post]');

    // Attach form submission listener to each form
    forms.forEach(function(form) {
        listenForSubmission(form);
    });
});


