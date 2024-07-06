<h1>Example 4: Multiple Field Form Submission</h1>
<p>This example demonstrates a form submission with multiple fields using Trongate MX. When you fill out the form and submit it, it will send a POST request to http://localhost/trongate_mx/tasks/submit_alt. The JSON response will be displayed in the result div.</p>

<form mx-post="http://localhost/trongate_mx/tasks/submit_alt"
      mx-target="#result"
      mx-indicator=".spinner">
    <label>First Name:</label>
    <input type="text" name="first_name" required>
    
    <label>Last Name:</label>
    <input type="text" name="last_name" required>
    
    <label>Email Address:</label>
    <input type="email" name="email_address" required>
    
    <button type="submit">Submit</button>
</form>

<div class="spinner mx-indicator" style="display: none"></div>

<div id="result" class="mt-3"></div>