<div id="page-title">
    <h1>Full CRUD Application</h1>
</div>

<section class="upper-content">
    <button mx-get="http://localhost/trongate_mx/tasks/create" 
            mx-target=".upper-content"
            mx-select="form" 
            mx-swap="innerHTML"
            mx-select-oob="h1:#page-title"
            mx-indicator=".spinner">Create New Task</button>
</section>

<section class="lower-content">
    <h2>Current Tasks</h2>
    <div class="spinner mx-indicator"></div>
    <div id="result" mx-load="http://localhost/trongate_mx/tasks/list" mx-select="table" mx-indicator=".spinner"></div>
</section>