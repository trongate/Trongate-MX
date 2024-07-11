<h1>Demo</h1>
<div id="page-upper"></div>
<p><button mx-get="<?= BASE_URL ?>tasks/create" mx-swap="outerHTML" mx-select="form" mx-indicator=".spinner">Click Me</button></p>
<div class="spinner mx-indicator"></div>

<div id="result" mx-get="<?= BASE_URL ?>tasks/list" mx-trigger="load" class="blink mt-3" mx-select="table">Loading...</div>

<p><?= anchor('tasks/resquence', 'Resequence IDs') ?></p>