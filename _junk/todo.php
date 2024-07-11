TO DO....

1). CLEAN UP THE WAY THE JSON - TYPE VALUES ARE HANDLED (it's all over the place!)

2).  Build the 'mx-vals' attribute.

3). Prepare a demo.

4).  Add to Trongate Framework.

5).  LAUNCH 


function console_log($msg) {

$jsonString = $msg;
if (isJson($jsonString)) {
    echo "Valid JSON!";
} else {
    echo "Not valid JSON.";
}

    echo '<script>console.log("'.$msg.'")</script>';
}

<?php
console_log($msg);
?>





























1).   Modify the following attributes so that they can accept attribute values written in the following form:







<button hx-get="http://localhost/trongate_mx/tasks/read_headers"
        hx-target="#result"
        hx-indicator=".spinner"
        hx-headers='{"City": "London", "Country": "UK", "Language": "English"}'>
    Fetch Content
</button>







  
<button id="fetchDataBtn" hx-get="/api/data">Fetch Data</button>

<script>
    const fetchDataBtn = document.getElementById('fetchDataBtn');

    fetchDataBtn.addEventListener('click', function() {
        const token = 'token123';
        const customHeaders = {
            'Authorization': `Bearer ${token}`,
            'Custom-Header': 'value'
        };

        // Set headers using JavaScript
        fetchDataBtn.setAttribute('hx-headers', JSON.stringify(customHeaders));

        // Trigger the HTMX request
        htmx.trigger(fetchDataBtn, 'click');
    });
</script>




























3).  HANDLE / FINISH VALIDATION ERRORS


<button hx-get="http://localhost/trongate_mx/tasks/read_headers"
        hx-target="#result"
        hx-indicator=".spinner"
        hx-headers='{"City": "New York", "Country": "USA", "Language": "English"}'>
    Fetch Content
</button>












* mx-token
        $token = (isset($_SERVER['HTTP_TRONGATETOKEN']) ? $_SERVER['HTTP_TRONGATETOKEN'] : false);
        var_dump($token); die();

















































































<div id="message-area"></div>

<table id="items-table">
  <tbody>
    <tr>
      <td>Item 1</td>
      <td>
        <button mx-delete="/api/items/1" 
                mx-target="#message-area" 
                mx-on-success="#items-table">Delete</button>
      </td>
    </tr>
    <!-- More rows... -->
  </tbody>
</table>







Here are the notes for the two features you need to implement in Trongate MX:
Replace 'mx-load' with 'mx-trigger="load"'
Purpose:
To align Trongate MX more closely with HTMX syntax
To provide a consistent way of handling load events
Implementation:
Remove all handling of 'mx-load' attribute
Modify handleMxTrigger function to recognize 'load' as a special case
Update initializeTrongateMX to process elements with mx-trigger="load" on page load
Example usage:
<div mx-get="/api/data" mx-trigger="load"> <!-- Content will be loaded when page loads --> </div> Key points:
This should work with mx-get, mx-post, etc.
Ensure it's processed immediately on page load, not waiting for user interaction
Implement 'mx-on-success' attribute
Purpose:
To refresh content after a successful form submission or other HTTP request
To allow updating of multiple elements on the page after a successful operation
Implementation:
Add parsing for 'mx-on-success' attribute in handleHttpResponse function
Trigger a new HTTP request for the specified element(s) on successful response
Example usage:
<form mx-post="/api/create" mx-on-success="#task-list,#status-message"> <!-- Form fields --> </form> <div id="task-list" mx-get="/api/tasks"> <!-- Task list content --> </div> <div id="status-message"></div> Key points:
Should support multiple selectors (comma-separated)
Each selected element should have its own mx-get (or other HTTP method) attribute
Ensure proper error handling if specified elements don't exist
Additional considerations:
Test thoroughly with various HTTP methods (GET, POST, PUT, DELETE)
Consider adding a debounce mechanism to prevent rapid successive refreshes
Ensure compatibility with existing Trongate MX features like mx-select and mx-swap
Next steps:
Update the handleMxTrigger function to handle 'load' trigger
Modify initializeTrongateMX to process 'mx-trigger="load"' on page load
Implement parsing and handling of 'mx-on-success' attribute
Test both features extensively
Update documentation to reflect these new features and usage
Remember to maintain consistency with the existing Trongate MX syntax and behavior while implementing these new features.











































* GET VALIDATION ERRORS WORKING.

			The inline validation errors work.

			The next step would be to get mx-select-oob working to display a message, or whatever!

			After that, our goal to ONLY have the inline validation errors working if our form has a class of 'highlight-errors'

			IF the form does NOT have a class of highlight-errors, a normal validation report should be presented.



*.  get the delete feature working

* get mx-push working - so that we can push to the address bar.

* Build the hx-target feature as displayed at https://youtu.be/0UvA7zvwsmg?si=KuEe0Nt7XL33gHKV&t=966

*  Build the demo app from the Net Ninja tutorial at https://youtu.be/Yr-ubS0H7z4?si=KDVs4rvU9_JHKZdf&t=280

*. Get the validation errors feature working.