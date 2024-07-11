<h1>Testing to see if request is from HTMX</h1>
<h2>The URL to be checked is <?= anchor('http://localhost/trongate_mx/tasks/read_from_tmx', 'http://localhost/trongate_mx/tasks/read_from_tmx') ?></h2>
<div id="result"></div>



<button mx-get="http://localhost/trongate_mx/tasks/read_from_tmx" 
        mx-target="#result">
    Fetch Content
</button>