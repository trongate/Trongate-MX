<h1>Dev</h1>

<div id="page-upper"></div>

<div class="box-grid">
	<div id="box1"></div>

	<div id="box2"></div>	
</div>


<div class="spinner mx-indicator mb-1" style="display: none"></div>
<div id="result" class="blink" mx-get="http://localhost/trongate_mx/tasks/list" 
     mx-trigger="load"
     mx-select="table">
    Loading content...
</div>


<style>
.box-grid {
	display: grid;
	grid-template-columns: repeat(2, 1fr);
	grid-gap: 1em;
}

.box-grid > div {
	min-height: 240px;
}

#box1 {
	background-color: cyan;
}

#box2 {
	background-color: lime;
}
</style>

