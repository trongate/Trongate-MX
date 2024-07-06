<div id="page-title">
    <h1>Example 5: Advanced Form Submission with OOB Swap</h1>
</div>

<p>This example demonstrates a form submission with out-of-band (OOB) swapping and selective content insertion using Trongate MX. When you fill out the form and submit it, it will send a POST request to http://localhost/trongate_mx/tasks/submit_alt2. The response will update the headline and display the JSON data in the result div.</p>

<form mx-post="http://localhost/trongate_mx/tasks/submit_alt2"
      mx-target="#result"
      mx-select="#posted-data"
      mx-select-oob="h1:#page-title"
      mx-indicator=".spinner">
    <label>First Name:</label>
    <input type="text" name="first_name" required>
    
    <label>Last Name:</label>
    <input type="text" name="last_name" required>
    
    <label>Email Address:</label>
    <input type="email" name="email_address" required>
    
    <button type="submit">Submit</button>
</form>

<div class="spinner mx-indicator" style="display: none;"></div>

<div id="result" class="mt-3"></div>