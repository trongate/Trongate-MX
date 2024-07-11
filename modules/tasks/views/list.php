<table>
	<thead style="font-size: 1.4em">
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
			<td class="text-center"><?= $row->id ?></td>
			<td><?= out($row->task_title) ?></td>
			<td class="text-center">
				<button class="mt-0" mx-get="<?= BASE_URL ?>tasks/create/<?= $row->id ?>" mx-build-modal='
{
	"id": "edit-task-modal",
	"modalHeading": "Edit Task"
}

					' mx-select="form">Edit</button>
				<button class="mt-0" mx-post="<?= BASE_URL ?>tasks/submit_delete/<?= $row->id ?>" mx-on-success="#result" mx-target="#page-upper">Delete</button>
			</td>
		</tr>	
		<?php
		}
		?>	
	</tbody>
</table>