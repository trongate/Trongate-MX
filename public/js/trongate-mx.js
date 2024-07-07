const methodAttributes = ['mx-get', 'mx-post', 'mx-put', 'mx-delete', 'mx-patch'];

function invokeFormPost(containingForm, triggerEvent, httpMethodAttribute) {
    console.log('look at me.. I am posting a form');

    // Establish the target URL.
    const targetUrl = containingForm.getAttribute(httpMethodAttribute);

    // Establish the request type.
    const requestType = httpMethodAttribute.replace('mx-', '').toUpperCase();

    // Attempt to display 'loading' element (indicator).
    attemptActivateLoader(containingForm);

    const formData = new FormData(containingForm);

    const http = new XMLHttpRequest();
    http.open('POST', targetUrl);

    // No need to set Content-Type header when sending FormData
    http.send(formData);

    http.onload = function() {
        attemptHideLoader(containingForm);
        
        // Only reset the form if the request was successful
        if (http.status >= 200 && http.status < 300) {
            containingForm.reset();
        }

        handleHttpResponse(http, containingForm);
    };
}

function mxSubmitForm(element, triggerEvent, httpMethodAttribute) {
    const containingForm = element.closest('form');
    if (!containingForm) {
        console.error('No containing form found');
        return;
    }

    const submitButton = containingForm.querySelector('button[type="submit"]');
    if (submitButton) {
        // Clear existing validation errors
        clearExistingValidationErrors(containingForm);

        submitButton.disabled = true; // Disable submit button

        // The following three attribute types require an attempt to collect form data.
        const requiresDataAttributes = ['mx-post', 'mx-put', 'mx-patch'];

        if (requiresDataAttributes.includes(httpMethodAttribute)) {
            invokeFormPost(containingForm, triggerEvent, httpMethodAttribute);
        } else {
            invokeHttpRequest(containingForm, httpMethodAttribute);
        }
    } else {
        console.log('no submit button found');
    }
}

function clearExistingValidationErrors(containingForm) {
    // Remove elements with class 'validation-error-report'
    containingForm.querySelectorAll('.validation-error-report')
        .forEach(el => el.remove());

    // Remove the 'form-field-validation-error' class from form fields
    containingForm.querySelectorAll('.form-field-validation-error')
        .forEach(el => el.classList.remove('form-field-validation-error'));
}

function invokeHttpRequest(element, httpMethodAttribute) {
    // Establish the target URL.
    const targetUrl = element.getAttribute(httpMethodAttribute);
    // Establish the request type.
    const requestType = httpMethodAttribute.replace('mx-', '').toUpperCase();
    // Attempt to display 'loading' element (indicator).
    attemptActivateLoader(element);

    const http = new XMLHttpRequest();
    http.open(requestType, targetUrl);
    http.setRequestHeader('Accept', 'text/html');
    http.timeout = 10000; // 10 seconds timeout

    http.onload = function() {
        attemptHideLoader(element);
        handleHttpResponse(http, element);
    };

    http.onerror = function() {
        attemptHideLoader(element);
        console.error('Request failed');
        // Handle error (e.g., show error message to user)
    };

    http.ontimeout = function() {
        attemptHideLoader(element);
        console.error('Request timed out');
        // Handle timeout (e.g., show timeout message to user)
    };

    try {
        http.send();
    } catch (error) {
        attemptHideLoader(element);
        console.error('Error sending request:', error);
        // Handle error (e.g., show error message to user)
    }
}









function populateTargetEl(targetEl, http, element) {

console.log(element.outerHTML);

    //const selectStr = getAttributeValue(element, 'mx-select');
    //const selectStr = 'blabla';
    const selectStr = element.getAttribute('mx-select');
    if(!selectStr) {
        console.log('we have no select string')
    }


console.log('selectStr is ' + selectStr);

    const mxSwapStr = establishSwapStr(element);
    //const selectOobStr = getAttributeValue(element, 'mx-select-oob');
    const selectOobStr = element.getAttribute('mx-select-oob');

    // Create a document fragment to hold the response
    const tempFragment = document.createDocumentFragment();
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = http.responseText;

console.log('********************************************')
console.log(http.responseText)
console.log('********************************************')


    tempFragment.appendChild(tempDiv);

    try {
        // Handle out-of-band swaps first
        handleOobSwaps(tempFragment, selectOobStr);

        // Handle the main target swap(s)
        handleMainSwaps(targetEl, tempFragment, selectStr, mxSwapStr);
    } catch (error) {
        console.error('Error in populateTargetEl:', error);
    } finally {
        // Clean up
        tempDiv.innerHTML = '';
        tempFragment.textContent = '';
    }
}

function handleOobSwaps(tempFragment, selectOobStr) {
    if (!selectOobStr) {
        return;
    }

    console.log(selectOobStr)

    // Evaluate the 'mx-select-oob' value to determine what technique to use for handling oob swaps.
    const methodology = determineOobMethodology(selectOobStr);

    if (!methodology) {
        return;
    }

    const oobDataObjs = [];

    if (methodology === 1) {
        console.log('using methodology 1...');
        oobDataObjs.push(executeOobMethodology1(selectOobStr));
    } else if (methodology === 2) {
        console.log('using methodology 2...');
        oobDataObjs.push(executeOobMethodology2(selectOobStr));
    } else if (methodology === 3) {
        console.log('using methodology 3...');
        oobDataObjs.push(...executeOobMethodology3(selectOobStr));
    }

    // Loop through the oobDataObjs array and perform the swaps
    oobDataObjs.forEach(obj => {
        //swapElements(obj.select, obj.target, obj.swap);

        let oobSelected;
        oobSelected = tempFragment.querySelector(obj.select);

        if(!oobSelected) {
            oobSelected = tempFragment.firstChild;
        }

        const oobTarget = document.querySelector(obj.target);
        swapContent(oobTarget, oobSelected.cloneNode(true), obj.swap);
    });
}

function executeOobMethodology1(selectOobStr) {
    /*
    Example use case:
    For an attribute like:
    mx-select-oob="#source-element:#destination-element"
    
    This function will return:
    {
        select: '#source-element',
        target: '#destination-element',
        swap: 'innerHTML'
    }

    This could be used in any scenario where content needs to be moved or copied:
    - '#source-element' is the ID of the element containing the original content
    - '#destination-element' is the ID of the element where content should be placed
    - 'innerHTML' specifies that the entire content should be swapped
    */

    const [select, target] = selectOobStr.split(':');

    const oobDataObj = {
        select,
        target,
        swap: "innerHTML"
    }
    return oobDataObj;
}

function executeOobMethodology2(selectOobStr) {
    /*
    Example use case:
    For an attribute like:
    mx-select-oob="select:#source-element,target:#destination-element,swap:innerHTML"
    
    This function will return:
    {
        select: '#source-element',
        target: '#destination-element',
        swap: 'innerHTML'
    }

    This could be used in any scenario where content needs to be moved or copied:
    - '#source-element' is the ID of the element containing the original content
    - '#destination-element' is the ID of the element where content should be placed
    - 'innerHTML' specifies that the entire content should be swapped

    If 'swap' is omitted, it defaults to 'innerHTML'
    */

    // Split the string into key-value pairs
    const pairs = selectOobStr.split(',');
    
    // Initialize the oobDataObj with default swap value
    const oobDataObj = {
        select: '',
        target: '',
        swap: 'innerHTML'  // Default value
    };

    // Process each key-value pair
    pairs.forEach(pair => {
        const [key, value] = pair.split(':').map(item => item.trim());
        
        // Assign values to oobDataObj based on the key
        switch(key) {
            case 'select':
                oobDataObj.select = value;
                break;
            case 'target':
                oobDataObj.target = value;
                break;
            case 'swap':
                oobDataObj.swap = value;
                break;
            // Ignore any other keys
        }
    });

    // Validate that we have at least select and target
    if (!oobDataObj.select || !oobDataObj.target) {
        throw new Error('Invalid mx-select-oob syntax. Both "select" and "target" must be specified.');
    }

    return oobDataObj;
}

function executeOobMethodology3(selectOobStr) {

    /*
    Example use case:
    For an attribute like:
    mx-select-oob="[{select:#source-element1,target:#destination-element1,swap:outerHTML},{select:#source-element2,target:#destination-element2,swap:innerText}]"
    
    This function will return:
    [
        {
            select: '#source-element1',
            target: '#destination-element1',
            swap: 'outerHTML'
        },
        {
            select: '#source-element2',
            target: '#destination-element2',
            swap: 'innerText'
        }
    ]

    This could be used in any scenario where multiple content swaps need to be performed:
    - '#source-element1' and '#source-element2' are the IDs of the elements containing the original content
    - '#destination-element1' and '#destination-element2' are the IDs of the elements where content should be placed
    - 'outerHTML' and 'innerText' specify how the content should be swapped
    */

    try {
        // Use makeValidJsonString to fix the input string
        const fixedJsonStr = makeValidJsonString(selectOobStr);

        // Parse the fixed JSON string
        const oobDataObjs = JSON.parse(fixedJsonStr);

        // Validate that the input is an array
        if (!Array.isArray(oobDataObjs)) {
            throw new Error('Invalid mx-select-oob syntax. Expected an array of objects.');
        }

        // Process each object in the array
        return oobDataObjs.map(obj => {
            // Ensure that the required properties are present
            if (!obj.select || !obj.target) {
                throw new Error('Invalid mx-select-oob syntax. Both "select" and "target" must be specified.');
            }

            // Set a default swap value if not provided
            obj.swap = obj.swap || 'innerHTML';

            return obj;
        });
    } catch (e) {
        // Handle any errors
        console.error('Error processing mx-select-oob:', e);
        return [];
    }
}

function makeValidJsonString(inputString) {
    // Helper function to check if a string is a valid JSON
    function isValidJson(str) {
        try {
            JSON.parse(str);
            return true;
        } catch (e) {
            return false;
        }
    }

    // If the input string is already a valid JSON, return it unmodified
    if (isValidJson(inputString)) {
        return inputString;
    }

    // Attempt to modify the string to make it a valid JSON
    try {
        // Use a regular expression to find keys and values that are not quoted and quote them
        const fixedString = inputString.replace(/([{,]\s*)([^:{}\[\],\s"']+)(\s*:)/g, '$1"$2"$3')
                                       .replace(/(:\s*)([^,\[\]{}"\s]+)(\s*[}\],])/g, '$1"$2"$3');

        // Check if the fixed string is a valid JSON
        if (isValidJson(fixedString)) {
            return fixedString;
        } else {
            throw new Error('Unable to fix the string to a valid JSON format.');
        }
    } catch (e) {
        throw new Error('Failed to process the input string. Please ensure it is in a proper format.');
    }
}

function determineOobMethodology(attributeValue) {
    // Trim the attribute value to remove any leading or trailing whitespace
    attributeValue = attributeValue.trim();

    // Check for Methodology 3 (JSON array)
    if (attributeValue.startsWith('[') && attributeValue.endsWith(']')) {
        console.log(attributeValue)
        try {
            return 3;
        } catch (e) {
            // If it's not valid JSON, it's not methodology 3
        }
    }

    // Check for Methodology 2 (key-value pairs)
    if (attributeValue.includes(',') && attributeValue.includes(':')) {
        const parts = attributeValue.split(',');
        const hasAllRequiredKeys = parts.some(part => part.includes('select:')) &&
                                   parts.some(part => part.includes('target:')) &&
                                   parts.some(part => part.includes('swap:'));
        if (hasAllRequiredKeys) {
            return 2;
        }
    }

    // Check for Methodology 1 (basic syntax)
    if (attributeValue.includes(':') && attributeValue.split(':').length === 2) {
        return 1;
    }

    // If none of the above conditions are met, return null or throw an error
    return null; // or throw new Error('Invalid mx-select-oob syntax');
}

function handleOobSwapsORIG(tempFragment, selectOobStr, defaultSwapStr) {
    if (selectOobStr) {
        const oobSelectors = selectOobStr.split(',');
        oobSelectors.forEach(selector => {
            const [oobSelectStr, oobTargetStr] = selector.trim().split(':').map(s => s.trim());
            if (oobTargetStr && oobSelectStr) {
                const oobTargets = document.querySelectorAll(oobTargetStr);
                const oobSelected = tempFragment.querySelector(oobSelectStr);
                if (oobTargets.length && oobSelected) {
                    oobTargets.forEach(oobTarget => {
                        swapContent(oobTarget, oobSelected.cloneNode(true), defaultSwapStr);
                    });
                }
            } else {
                console.log('cannot run handleOobSwaps perfectly since we dont have...');
                const oobSelected = tempFragment.firstChild;
                
                // Take the entire response body and populate the oob element with that (.innerHTML)
                const oobTarget = document.querySelector(oobSelectStr)
                swapContent(oobTarget, oobSelected.cloneNode(true), defaultSwapStr);
            }
        });
    }
}

function handleMainSwaps(targetEl, tempFragment, selectStr, mxSwapStr) {
    let contents = selectStr ? tempFragment.querySelectorAll(selectStr) : [tempFragment.firstChild];
    contents.forEach(content => {
        if (content) {
            swapContent(targetEl, content, mxSwapStr);
        }
    });
}

function swapContent(target, source, swapMethod) {
    switch (swapMethod) {
        case 'outerHTML':
            target.outerHTML = source.outerHTML;
            break;
        case 'textContent':
            target.textContent = source.textContent;
            break;
        case 'beforebegin':
            target.insertAdjacentHTML('beforebegin', source.outerHTML);
            break;
        case 'afterbegin':
            target.insertAdjacentHTML('afterbegin', source.outerHTML);
            break;
        case 'beforeend':
            target.insertAdjacentHTML('beforeend', source.outerHTML);
            break;
        case 'afterend':
            target.insertAdjacentHTML('afterend', source.outerHTML);
            break;
        case 'delete':
            target.remove();
            break;
        case 'none':
            // Do nothing
            break;
        default: // 'innerHTML' is the default
            target.innerHTML = source.outerHTML || source.innerHTML;
    }
}

function handleHttpResponse(http, element) {

    const containingForm = element.closest('form');

    if (containingForm) {
        const submitButton = containingForm.querySelector('button[type="submit"]');
        if (submitButton) {
            submitButton.removeAttribute('disabled');
        }
    }

    element.classList.remove('blink');

    if (http.status >= 200 && http.status < 300) {

        if (http.getResponseHeader('Content-Type').includes('text/html')) {
            const mxTargetStr = getAttributeValue(element, 'mx-target');

            let targetEl;

            if (mxTargetStr) {
                targetEl = document.querySelector(mxTargetStr);
            } else {
                // If no mx-target is specified, use the invoking element as the target
                targetEl = element;
            }

            if (targetEl) {
                console.log('populate target element');
                populateTargetEl(targetEl, http, element);
            }

            // Perform actions based on the response
            // For example, update the DOM, show a success message, etc.
        } else {
            console.log('Response is not HTML. Handle accordingly.');
            // Handle non-HTML responses (e.g., JSON)
        }
    } else {
        console.error('Request failed with status:', http.status);
        // Handle different types of errors
        switch(http.status) {
            case 404:
                console.error('Resource not found');
                break;
            case 500:
                console.error('Server error');
                break;
            default:
                console.error('An error occurred');
        }

        if (containingForm) {
            console.log('now attempting to display');
            attemptDisplayValidationErrors(http, element, containingForm);
        }
    }

    // Remove the loader if present
    attemptHideLoader(element);
}

function handleValidationErrors(containingForm, validationErrors) {
    // First, remove any existing validation error classes
    containingForm.querySelectorAll('.form-field-validation-error')
        .forEach(field => field.classList.remove('form-field-validation-error'));

    // Loop through the validation errors
    validationErrors.forEach(error => {
        // Find the form field with the name matching the error field
        const field = containingForm.querySelector(`[name="${error.field}"]`);
        if (field) {
            // Add the validation error class to the field
            field.classList.add('form-field-validation-error');

            // Optionally, you can also display the error message
            // This assumes there's a container for error messages next to each field
            const errorContainer = field.nextElementSibling;
            if (errorContainer && errorContainer.classList.contains('error-message')) {
                errorContainer.textContent = error.messages.join(' ');
            }
        }
    });
}

function attemptDisplayValidationErrors(http, element, containingForm) {
    if (http.status >= 400 && http.status <= 499) {
        try {
            // Create a temporary DOM element to parse the response
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = http.responseText;

            // Look for the validation-errors div
            const validationErrorsDiv = tempDiv.querySelector('#validation-errors');

            if (!validationErrorsDiv) {
                // If the validation-errors div doesn't exist, exit the function
                return;
            }

            // Parse the content of the validation-errors div
            const validationErrors = JSON.parse(validationErrorsDiv.textContent);

            // Clear existing validation errors
            clearExistingValidationErrors(containingForm);

            // Loop through the validation errors
            validationErrors.forEach(error => {
                const field = containingForm.querySelector(`[name="${error.field}"]`);
                if (field) {
                    field.classList.add('form-field-validation-error');

                    // Create error container
                    const errorContainer = document.createElement('div');
                    errorContainer.classList.add('validation-error-report');
                    errorContainer.innerHTML = error.messages.map(msg => `<div>&#9679; ${msg}</div>`).join('');

                    // Find the appropriate place to insert the error message
                    let insertBeforeElement = field;
                    let label = field.previousElementSibling;
                    if (label && label.tagName.toLowerCase() === 'label') {
                        insertBeforeElement = field;
                    } else {
                        // If there's no label, insert at the start of the parent container
                        insertBeforeElement = field.parentNode.firstChild;
                    }

                    // Insert the error message
                    insertBeforeElement.parentNode.insertBefore(errorContainer, insertBeforeElement);

                    // Special handling for checkboxes and radios
                    if (field.type === "checkbox" || field.type === "radio") {
                        let parentContainer = field.closest("div");
                        if (parentContainer) {
                            parentContainer.classList.add("form-field-validation-error");
                            parentContainer.style.textIndent = "7px";
                        }
                    }
                }
            });

            // Scroll to the first error
            const firstError = containingForm.querySelector('.validation-error-report');
            if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });

        } catch (e) {
            console.error('Error parsing validation errors:', e);
        }
    }
}

function attemptDisplayValidationErrors(http, element, containingForm) {
    if (http.status >= 400 && http.status <= 499) {
        try {
            // Create a temporary DOM element to parse the response
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = http.responseText;

            // Look for the validation-errors div
            const validationErrorsDiv = tempDiv.querySelector('#validation-errors');

            if (!validationErrorsDiv) {
                // If the validation-errors div doesn't exist, exit the function
                return;
            }

            // Parse the content of the validation-errors div
            const validationErrors = JSON.parse(validationErrorsDiv.textContent);

            // Remove any existing validation error classes and reports
            containingForm.querySelectorAll('.form-field-validation-error, .validation-error-report')
                .forEach(el => el.remove());

            // Remove the call to drawValidationErrorsAlert
            // drawValidationErrorsAlert(containingForm); // This line is now removed

            // Loop through the validation errors
            validationErrors.forEach(error => {
                const field = containingForm.querySelector(`[name="${error.field}"]`);
                if (field) {
                    field.classList.add('form-field-validation-error');

                    // Create error container
                    const errorContainer = document.createElement('div');
                    errorContainer.classList.add('validation-error-report');
                    errorContainer.innerHTML = error.messages.map(msg => `<div>&#9679; ${msg}</div>`).join('');

                    // Find the appropriate place to insert the error message
                    let insertBeforeElement = field;
                    let label = field.previousElementSibling;
                    if (label && label.tagName.toLowerCase() === 'label') {
                        insertBeforeElement = field;
                    } else {
                        // If there's no label, insert at the start of the parent container
                        insertBeforeElement = field.parentNode.firstChild;
                    }

                    // Insert the error message
                    insertBeforeElement.parentNode.insertBefore(errorContainer, insertBeforeElement);

                    // Special handling for checkboxes and radios
                    if (field.type === "checkbox" || field.type === "radio") {
                        let parentContainer = field.closest("div");
                        if (parentContainer) {
                            parentContainer.classList.add("form-field-validation-error");
                            parentContainer.style.textIndent = "7px";
                        }
                    }
                }
            });

            // Scroll to the first error
            const firstError = containingForm.querySelector('.validation-error-report');
            if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });

        } catch (e) {
            console.error('Error parsing validation errors:', e);
        }
    }
}



function drawValidationErrorsAlert(targetForm) {
    let alertDiv = document.createElement("div");
    alertDiv.classList.add("validation-error-alert");
    alertDiv.classList.add("form-field-validation-error");
    let alertHeadline = document.createElement("h3");
    let gotFontAwesome = findCss("font-awesome");
    let iconCode = '<i class="fa fa-warning" style="font-size: 1.4em; margin-right: 0.2em;"></i> ';
    alertHeadline.innerHTML = gotFontAwesome ? iconCode : "";
    alertHeadline.innerHTML += "Oops! There was a problem.";

    let infoPara = document.createElement("p");
    infoPara.textContent = "You'll find more details highlighted below.";

    alertDiv.appendChild(alertHeadline);
    alertDiv.appendChild(infoPara);
    targetForm.prepend(alertDiv);
}

function addErrorClasses(key, allFormFields) {
    for (let i = 0; i < allFormFields.length; i++) {
        if (allFormFields[i].name === key) {
            let formFieldType = allFormFields[i].type;
            if (formFieldType === "checkbox" || formFieldType === "radio") {
                let parentContainer = allFormFields[i].closest("div");
                parentContainer.classList.add("form-field-validation-error");
                parentContainer.style.textIndent = "7px";

                let previousSibling = parentContainer.previousElementSibling;
                if (previousSibling && previousSibling.classList.contains("validation-error-report")) {
                    previousSibling.style.marginTop = "21px";
                }
            } else {
                allFormFields[i].classList.add("form-field-validation-error");
            }
        }
    }
}

function findCss(fileName) {
    var finderRe = new RegExp(fileName + ".*?.css", "i");
    var linkElems = document.getElementsByTagName("link");
    for (var i = 0, il = linkElems.length; i < il; i++) {
        if (linkElems[i].href && finderRe.test(linkElems[i].href)) {
            return true;
        }
    }
    return false;
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
        	invokeHttpRequest(element, httpMethodAttribute);
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

function establishSwapStr(element) {
    const swapStr = getAttributeValue(element, 'mx-swap');
    return swapStr || 'innerHTML'; // Default to 'innerHTML' if not specified
}

function getAttributeValue(element, attributeName) {
    let current = element;
    while (current) {
        if (current.hasAttribute(attributeName)) {
            return current.getAttribute(attributeName);
        }
        current = current.parentElement;
    }
    return null;
}





function attemptActivateLoader(element) {
    const indicatorSelector = getAttributeValue(element, 'mx-indicator');
    if (indicatorSelector) {
        const loaderEl = document.querySelector(indicatorSelector);
        if (loaderEl) {
            loaderEl.style.removeProperty('display');  // Removes any inline display property
            loaderEl.classList.remove('mx-indicator-hidden');
            loaderEl.classList.add('mx-indicator');
        }
    }
}

function attemptHideLoader(element) {
    const indicatorSelector = getAttributeValue(element, 'mx-indicator');
    if (indicatorSelector) {
        const loaderEl = document.querySelector(indicatorSelector);
        if (loaderEl) {
            hideLoader(loaderEl);  // Pass loaderEl instead of element
        }
    }
}

// Function to hide loader on a specified element
function hideLoader(element) {
    if (element && element.classList.contains('mx-indicator')) {
        element.classList.remove('mx-indicator');
        element.classList.add('mx-indicator-hidden');
    }
}





















































function handlePageLoadedEvents(element) {
    // Immediately invoke the HTTP request for (page) 'load' events

    console.log('now handling load event');

    console.log(element.outerHTML);

    // Find which out which kind of HTTP request should be invoked
    const attribute = methodAttributes.find(attr => element.hasAttribute(attr));

    event.preventDefault(); // Prevent default behavior

    console.log('we have ' + attribute)

    invokeHttpRequest(element, attribute);
}

function handleTrongateMXEvent(event) {
    
    const element = event.target.closest('[' + methodAttributes.join('],[') + ']');

    if (!element) return; // If no matching element found, exit the function

    const triggerEvent = establishTriggerEvent(element);
    console.log('the trigger event is ' + triggerEvent)

    if (triggerEvent !== event.type) return; // If the event doesn't match the trigger, exit the function

    // Find which out which kind of HTTP request should be invoked
    const attribute = methodAttributes.find(attr => element.hasAttribute(attr));

    event.preventDefault(); // Prevent default behavior

    if (element.tagName.toLowerCase() === 'form' || element.closest('form')) {
        mxSubmitForm(element, triggerEvent, attribute);
    } else {
        invokeHttpRequest(element, attribute);
    }
}

function initializeTrongateMX() {
    // Hide all loader elements
    document.querySelectorAll('.mx-indicator').forEach(element => {
        hideLoader(element);
        element.style.display = ''; // Remove inline style "display: none;"
    });

    // Add the central event listeners
    const events = ['click', 'dblclick', 'change', 'submit', 'keyup', 'keydown', 'focus', 'blur'];
    events.forEach(eventType => {
        document.body.addEventListener(eventType, handleTrongateMXEvent);
    });

    // Handle load events (mx-trigger="load")
    console.log('page loaded')
    const loadTriggerElements = document.querySelectorAll('[mx-trigger*="load"]');

    console.log(loadTriggerElements.length);

    loadTriggerElements.forEach(element => {
        // Handle elements with 'load' in their mx-trigger attribute
        handlePageLoadedEvents(element);
    });

/*
    // Handle 'mx-load' elements
    const loadEls = document.querySelectorAll('[mx-load]');

    document.querySelectorAll('[mx-load]').forEach(element => {
        handlePageLoadedEvents(element, 'mx-load');
    });
*/

}

// Call this function when the DOM is loaded
document.addEventListener('DOMContentLoaded', initializeTrongateMX);