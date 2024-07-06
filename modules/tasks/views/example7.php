<div id="page-title">
    <h1>Example 7: Auto-loading Task List</h1>
</div>

<p>This example demonstrates auto-loading content using Trongate MX. The current list of tasks will be fetched from http://localhost/trongate_mx/tasks/list upon page load and displayed in the result div below.</p>

<div class="spinner mx-indicator" style="display: none;"></div>
<div id="result" mx-load="http://localhost/trongate_mx/tasks/list" mx-select="table" mx-indicator=".spinner"></div>