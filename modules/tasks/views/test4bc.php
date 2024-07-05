<h1>Test 5: Attribute Inheritance and Out-of-Band Swaps</h1>

<div mx-select-oob="#notification-area" mx-swap="innerHTML">
    <p>This div has mx-select-oob and mx-swap attributes that should be inherited by its children.</p>

    <button mx-get="<?= $endpoint_url ?>" 
            mx-select="#main-content" 
            mx-target="#result">
        Update Content
    </button>

    <button mx-get="<?= $endpoint_url ?>" 
            mx-select="#extra-content" 
            mx-target="#result" 
            mx-select-oob="#sidebar-content:#sidebar">
        Update Content and Sidebar
    </button>
</div>

<div class="row mt-3">
    <div class="col-md-8">
        <h3>Main Content Area</h3>
        <div id="result" class="border p-3 mb-3">
            <p>This is the initial content of the result div.</p>
        </div>
    </div>
    <div class="col-md-4">
        <h3>Sidebar</h3>
        <div id="sidebar" class="border p-3 mb-3">
            <p>This is the initial content of the sidebar.</p>
        </div>
    </div>
</div>

<div id="notification-area" class="alert alert-info mt-3" style="display: none;">
    <!-- Notifications will appear here -->
</div>

<style>
#result, #sidebar {
    min-height: 150px;
    background-color: #f8f9fa;
}
</style>