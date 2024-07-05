<div id="main-content">
    <h1>Main Content</h1>
    <p>This is the main content area.</p>

    <!-- Button to trigger the AJAX request -->
    <button id="update-button"
            mx-trigger="click"
            mx-post="<?= $endpoint_url ?>"
            mx-target="#result"
            mx-select="#new-main-content"
            mx-select-oob="#sidebar-content:#sidebar, #notification-content:#notification-area">
        Update Content
    </button>

<div id="result">
	<p>First</p>
	<p>Second</p>
	<p>Third</p>
</div>


    <!-- Sidebar area -->
    <div id="sidebar">
        <h2>Sidebar</h2>
        <p>This is the current sidebar content.</p>
    </div>

    <!-- Notification area -->
    <div id="notification-area">
        <p>No new notifications.</p>
    </div>
</div>



<style>
#result {
	background-color: cyan;
	border: 3px red dashed;
	min-height: 300px;
	padding: 24px;
}
</style>