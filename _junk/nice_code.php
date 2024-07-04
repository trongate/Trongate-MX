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

// Function to listen for form submission and invoke POST request
function listenForInvokePost(element) {
    element.addEventListener('submit', async event => {
        event.preventDefault(); // Prevent default form submission

        const formData = new FormData(element);
        const url = element.getAttribute('mx-post');
        const targetSelector = element.getAttribute('mx-target');
        const indicatorSelector = element.getAttribute('mx-indicator');
        const indicatorEl = indicatorSelector ? document.querySelector(indicatorSelector) : null;
        const targetElement = targetSelector ? document.querySelector(targetSelector) : null;
        const submitButton = element.querySelector('button[type="submit"]');

        if (submitButton) {
            submitButton.disabled = true; // Disable submit button
        }

        if (indicatorEl && indicatorEl.classList.contains('mx-indicator-hidden')) {
            activateLoader(indicatorEl);
        }

        console.log('API URL:', url);
        console.log('Form Data:', formData);

        try {
            const response = await fetch(url, {
                method: 'POST',
                body: formData
            });

            if (indicatorEl) {
                hideLoader(indicatorEl);
            }

            console.log('HTTP Status:', response.status);

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.text();

            if (targetElement) {
                targetElement.innerHTML = data; // Update target element with response data
            } else {
                console.error('Target element not found:', targetSelector);
            }
        } catch (error) {
            console.error('Error:', error);
            // Handle errors as needed
            if (targetElement) {
                targetElement.innerHTML = '<p class="error">An error occurred. Please try again.</p>';
            }
        } finally {
            if (submitButton) {
                submitButton.disabled = false; // Enable submit button after request completes
            }
        }
    });
}

// Wait for the document to be fully loaded
document.addEventListener('DOMContentLoaded', async () => {
    // Find all elements with the mx-indicator class
    const elementsWithIndicator = document.querySelectorAll('.mx-indicator');

    // Loop through each element and ensure it starts hidden
    for (const element of elementsWithIndicator) {
        element.classList.remove('mx-indicator');
        element.classList.add('mx-indicator-hidden');
        element.style.display = ''; // Remove inline style "display: none;"
    }

    // Find all elements with mx-post attribute
    const elementsWithMxPost = document.querySelectorAll('[mx-post]');

    // Attach form submission listener to each element
    for (const element of elementsWithMxPost) {
        listenForInvokePost(element);
    }
});
