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
		    <td class="text-center">
		    	<button mx-delete="<?= BASE_URL ?>tasks/delete_task/<?= $row->id ?>" mx-target="#task-list">Delete</button>
		    </td>
	    </tr>	
	    <?php
	    }
	    ?>	
	</tbody>
</table>