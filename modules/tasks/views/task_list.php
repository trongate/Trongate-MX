<h1>Current Task List</h1>
<table>
	<thead>
	    <tr>
		    <th>ID</th>
		    <th>Task Title</th>
	    </tr>		
	</thead>
	<tbody>
		<?php
		foreach($rows as $row) { ?>
	    <tr>
		    <td><?= $row->id ?></td>
		    <td><?= out($row->task_title) ?></td>
	    </tr>	
	    <?php
	    }
	    ?>	
	</tbody>
</table>