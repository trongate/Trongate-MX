<h1>Current Task List</h1>
<table>
	<thead>
	    <tr>
		    <th>ID</th>
		    <th>Task Title</th>
		    <th>Action</th>
	    </tr>		
	</thead>
	<tbody>
		<?php
		foreach($rows as $row) { ?>
	    <tr>
		    <td><?= $row->id ?></td>
		    <td><?= out($row->task_title) ?></td>
		    <td class="text-center"><button class="mt-0" 
		    	mx-get="http://localhost/trongate_mx/tasks/delete_task" 
		        mx-target="#box1"
		        mx-select="#happy"
		        mx-select-oob="[{select:#source-element1,target:#destination-element1,swap:outerHTML},{select:#source-element2,target:#destination-element2,swap:innerText}]"
		        mx-indicator=".spinner">Delete</button>
		    </td>
	    </tr>	
	    <?php
	    }
	    ?>	
	</tbody>
</table>