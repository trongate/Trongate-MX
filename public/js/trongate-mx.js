function invokeFormPost(element, triggerEvent, httpMethodAttribute) {
	console.log('look at me..  I am posting a form');

	// Establish the target URL.
	const targetUrl = element.getAttribute(httpMethodAttribute);

	// Establish the request type.
	const requestType = httpMethodAttribute.replace('mx-', '').toUpperCase();

	// Attempt to displaying 'loading' element (indicator).
	attemptActivateLoader(element);

	const containingForm = element.closest('form');
    const formData = new FormData(containingForm);

	const http = new XMLHttpRequest();
	http.open('POST', targetUrl);
	// No need to set Content-Type header when sending FormData
	http.send(formData);
	http.onload = function() {
	    console.log(http.status);
	    console.log(http.responseText);
		attemptHideLoader(element);
		containingForm.reset();
		handleHttpResponse(http, element);

	};


}

function mxSubmitForm(element, triggerEvent, httpMethodAttribute) {
    
    const containingForm = element.closest('form');
	const submitButton = element.querySelector('button[type="submit"]');

	if (submitButton) {
		// No need to click since has (probably?) already been clicked!
	    submitButton.disabled = true; // Disable submit button

        // The following three attribute types require an attempt to collect form data.
        const requiresDataAttributes = ['mx-post', 'mx-put', 'mx-patch'];

        if (requiresDataAttributes.includes(httpMethodAttribute)) {
        	invokeFormPost(element, triggerEvent, httpMethodAttribute);
        } else {
        	invokeHttpRequest(element, triggerEvent, httpMethodAttribute);
        }
    
	} else {
		console.log('no submit button found');
	}

}

function invokeHttpRequest(element, triggerEvent, httpMethodAttribute) {

	// Establish the target URL.
	const targetUrl = element.getAttribute(httpMethodAttribute);

	// Establish the request type.
	const requestType = httpMethodAttribute.replace('mx-', '').toUpperCase();

	// Attempt to displaying 'loading' element (indicator).
	attemptActivateLoader(element);

	const http = new XMLHttpRequest();
	http.open(requestType, targetUrl);
	http.setRequestHeader('Accept', 'text/html');
	http.send();
	http.onload = function() {
		attemptHideLoader(element);
		handleHttpResponse(http, element);
	}
}

function populateTargetEl(targetEl, http, element) {
    const selectStr = getAttributeValue(element, 'mx-select');
    if (selectStr) {
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = http.responseText;

        const selectedEl = tempDiv.querySelector(selectStr);

        targetEl.innerHTML = '';
        if (selectedEl) {
            targetEl.appendChild(selectedEl.cloneNode(true));
        }

        // Optional: explicitly clear the reference
        tempDiv.innerHTML = '';
        tempDiv = null;
    } else {
        targetEl.innerHTML = http.responseText;
    }
}

function handleHttpResponse(http, element) {

    // Check if the request was successful
    if (http.status >= 200 && http.status < 300) {
        const mxTargetStr = getAttributeValue(element, 'mx-target');

        if (mxTargetStr) {
        	const targetEl = document.querySelector(mxTargetStr);
        	if(targetEl) {
        		populateTargetEl(targetEl, http, element);
        	}
        }

        const containingForm = element.closest('form');

        if (containingForm) {
			const submitButton = element.querySelector('button[type="submit"]');
			if (submitButton) {
				submitButton.removeAttribute('disabled');
			}
        }

        // Perform actions based on the response
        // For example, update the DOM, show a success message, etc.
    } else {
        console.error('Request failed with status:', http.status);
        // Handle the error
        // For example, show an error message, log the error, etc.
    }

    // Remove the loader if present
    const indicatorSelector = getAttributeValue(element, 'mx-indicator');
    if (indicatorSelector) {
        const indicatorElement = document.querySelector(indicatorSelector);
        if (indicatorElement) {
            hideLoader(indicatorElement);
        }
    }
}


































// Function to handle standard DOM events based on MX attributes
function handleStandardEvents(element, triggerEvent, httpMethodAttribute) {

    element.addEventListener(triggerEvent, event => {
        event.preventDefault(); // Prevent default behavior

        // Is the element either a 'form' tag or an element within a form?
        const containingForm = element.closest('form');
        if (containingForm) {

        	if (triggerEvent === 'submit') {
        		mxSubmitForm(element, triggerEvent, httpMethodAttribute);
        	}

        } else {
        	// This does not belong to a form!
        	invokeHttpRequest(element, triggerEvent, httpMethodAttribute);
        }

    });
}

function handleMxTrigger(element) {

    const methodAttributes = ['mx-get', 'mx-post', 'mx-put', 'mx-delete', 'mx-patch'];

    // Array of standard DOM events
    const standardEvents = ['click', 'dblclick', 'change', 'submit', 'keyup', 'keydown', 'focus', 'blur'];

    methodAttributes.forEach(attribute => {
        if (element.hasAttribute(attribute)) {
            
            // Establish what the trigger event is that will invoke the HTTP request for this element.
            const triggerEvent = establishTriggerEvent(element);

            if (standardEvents.includes(triggerEvent)) {
                handleStandardEvents(element, triggerEvent, attribute);
            } else if (triggerEvent === 'load') {
                handleLoadEvents(element, attribute);
            }
        }
    });

}

// Function to establish the trigger event based on element type and mx-trigger attribute
function establishTriggerEvent(element) {

	const tagName = element.tagName;
	const triggerEventStr = element.getAttribute('mx-trigger');

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

function getAttributeValue(element, attributeName) {
    if (element && element.hasAttribute(attributeName)) {
        return element.getAttribute(attributeName);
    }
    return false;
}

function attemptActivateLoader(element) {
	const indicatorSelector = getAttributeValue(element, 'mx-indicator');
	if (indicatorSelector) {
	    const loaderEl = document.querySelector(indicatorSelector);
	    activateLoader(loaderEl);
	}
}

// Function to activate loader on a specified element
function activateLoader(element) {
    if (element && element.classList.contains('mx-indicator-hidden')) {
        element.classList.remove('mx-indicator-hidden');
        element.classList.add('mx-indicator');
    }
}

function attemptHideLoader(element) {
	const indicatorSelector = getAttributeValue(element, 'mx-indicator');
	if (indicatorSelector) {
	    const loaderEl = document.querySelector(indicatorSelector);
	    hideLoader(loaderEl);
	}
}

// Function to hide loader on a specified element
function hideLoader(element) {
    if (element && element.classList.contains('mx-indicator')) {
        element.classList.remove('mx-indicator');
        element.classList.add('mx-indicator-hidden');
    }
}

// Wait for the document to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Find all elements with the mx-indicator class
    document.querySelectorAll('.mx-indicator').forEach(element => {
    	hideLoader(element);
        element.style.display = ''; // Remove inline style "display: none;"
    });

    // Find all forms and elements with mx-get, mx-post, mx-put, mx-delete, mx-patch attributes
    document.querySelectorAll('[mx-get], [mx-post], [mx-put], [mx-delete], [mx-patch]').forEach(element => {
        handleMxTrigger(element);
    });

});