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

// Function to establish the trigger event based on element type and mx-trigger attribute
function establishTriggerEvent(tagName, triggerEventStr) {
    if (triggerEventStr) {
        return triggerEventStr; // Return mx-trigger attribute value if provided
    }

    // Determine natural trigger event based on HTMX conventions
    switch (tagName.toLowerCase()) {
        case 'form':
            return 'submit';
        case 'button':
            return 'click';
        case 'input':
            return (tagName === 'input' && element.type === 'submit') ? 'click' : 'change';
        case 'textarea':
        case 'select':
            return 'change';
        default:
            return 'click'; // Default to click for other elements
    }
}

// Function to perform HTTP request
function performHttpRequest(httpRequestArgs) {
    // Destructure properties from httpRequestArgs
    const { url, method, formData, indicatorSelector, targetElement } = httpRequestArgs;

    const options = {
        method: method.toUpperCase(),
        body: formData
    };

    // Optional: Activate loader if indicatorSelector is provided
    if (indicatorSelector) {
        activateLoader(document.querySelector(indicatorSelector));
    }

    return fetch(url, options)
        .then(response => {
            // Optional: Hide loader if indicatorSelector is provided
            if (indicatorSelector) {
                hideLoader(document.querySelector(indicatorSelector));
            }

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            return response.text();
        })
        .then(data => {
            // Update targetElement with response data
            if (targetElement) {
                targetElement.innerHTML = data;
            } else {
                console.error('Target element not found:', targetElement);
            }
        })
        .catch(error => {
            console.error('Error performing HTTP request:', error);
            // Handle errors as needed
            throw error; // Re-throw error to propagate to caller
        });
}

// Function to handle standard DOM events based on HTMX attributes
function handleStandardEvents(element, attribute, url, triggerEvent) {
    element.addEventListener(triggerEvent, event => {
        event.preventDefault(); // Prevent default behavior
        
        const formData = new FormData(element);
        const indicatorSelector = element.getAttribute('mx-indicator');
        const targetElement = document.querySelector(element.getAttribute('mx-target'));
        
        const httpRequestArgs = {
            url,
            method: attribute.replace('mx-', ''),
            formData,
            indicatorSelector,
            targetElement
        };

        performHttpRequest(httpRequestArgs)
            .catch(error => {
                console.error('Error handling standard event:', error);
                // Handle errors as needed
            });
    });
}

function listenForSubmit(formEl) {
    formEl.addEventListener('submit', async event => {
        event.preventDefault(); // Prevent default form submission
        console.log('submit was invoked but I have prevented the default submit behaviour');

        const formData = new FormData(formEl);
        const url = formEl.getAttribute('mx-post');
        const targetSelector = formEl.getAttribute('mx-target');
        const indicatorSelector = formEl.getAttribute('mx-indicator');
        const indicatorEl = indicatorSelector ? document.querySelector(indicatorSelector) : null;
        const targetElement = targetSelector ? document.querySelector(targetSelector) : null;
        const submitButton = formEl.querySelector('button[type="submit"]');

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

// Function to handle 'load' events based on HTMX attributes
function handleLoadEvents(element, attribute, url) {

    const tagName = element.tagName.toLowerCase();
    if (tagName === 'form') {
        listenForSubmit(element);
        console.log('cool');
        const submitButton = element.querySelector('button[type="submit"]');

        if (submitButton) {
            submitButton.click();
        } else {
            console.log("Submit button not found");
        }
    }
    

return;

    window.addEventListener('load', () => {
        const tagName = element.tagName.toLowerCase();
        const targetElement = document.querySelector(element.getAttribute('mx-target'));
        
        if (tagName === 'form') {
            // For form elements, force form submission
            element.submit();
        } else {
            // For non-form elements, perform HTTP request
            const httpRequestArgs = {
                url,
                method: attribute.replace('mx-', ''),
                formData: null, // No form data for 'load' event
                indicatorSelector: null,
                targetElement
            };

            performHttpRequest(httpRequestArgs)
                .catch(error => {
                    console.error('Error handling load event:', error);
                    // Handle errors as needed
                });
        }
    });
}

// Function to handle 'load' events based on HTMX attributes
function handleLoadEventsDUFF(element, attribute, url) {

    window.addEventListener('load', () => {
        const tagName = element.tagName.toLowerCase();
        const targetElement = document.querySelector(element.getAttribute('mx-target'));
        
        if (tagName === 'form') {
            // For form elements, force form submission
            element.submit();
        } else {
            // For non-form elements, perform HTTP request
            const httpRequestArgs = {
                url,
                method: attribute.replace('mx-', ''),
                formData: null, // No form data for 'load' event
                indicatorSelector: null,
                targetElement
            };

            performHttpRequest(httpRequestArgs)
                .catch(error => {
                    console.error('Error handling load event:', error);
                    // Handle errors as needed
                });
        }
    });
}

// Function to handle MX triggers based on HTMX attributes
function handleMxTrigger(element) {
    const methodAttributes = ['mx-get', 'mx-post', 'mx-put', 'mx-delete', 'mx-patch'];

    // Array of standard DOM events
    const standardEvents = ['click', 'dblclick', 'change', 'submit', 'keyup', 'keydown', 'focus', 'blur'];

    methodAttributes.forEach(attribute => {
        if (element.hasAttribute(attribute)) {
            const url = element.getAttribute(attribute);
            const triggerEventStr = element.getAttribute('mx-trigger');
            const triggerEvent = establishTriggerEvent(element.tagName, triggerEventStr);

            if (standardEvents.includes(triggerEvent)) {
                handleStandardEvents(element, attribute, url, triggerEvent);
            } else if (triggerEvent === 'load') {
                handleLoadEvents(element, attribute, url);
            }
        }
    });
}

// Wait for the document to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Find all elements with the mx-indicator class
    document.querySelectorAll('.mx-indicator').forEach(element => {
        element.classList.remove('mx-indicator');
        element.classList.add('mx-indicator-hidden');
        element.style.display = ''; // Remove inline style "display: none;"
    });

    // Find all forms and elements with mx-get, mx-post, mx-put, mx-delete, mx-patch attributes
    document.querySelectorAll('[mx-get], [mx-post], [mx-put], [mx-delete], [mx-patch]').forEach(element => {
        handleMxTrigger(element);
    });
});
