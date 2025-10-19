<div>
    <div>
        <div>
            <h1>| Dashboard</h1>
        </div>
        <div class="mb-3 mt-3"><a class="btn btn-primary" href="<?= base_url('/task/create/') ?>">Add New Task</a></></div>
    </div>
    <div>
        <?php if(session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif;?>

        <table class="table table-bordered bg-white">
            <thead clas="table-ligth">
                <tr>
                    <th>Task ID</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Mark</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($task)) : ?>
                <?php foreach($task as $item) : ?>
                <?php 
                $is_completed = "On Progress";
                if($item['is_completed'] == 1){
                        $is_completed = "Completed";
                    }
                ?>
                <tr>
                    <td><?= esc($item['id']) ?></td>
                    <td><?= esc($item['title']) ?></td>
                    <td><?= esc($item['description']) ?></td> 
                    <td class="text-center">
                        <?= $item['is_completed'] ? "<span class='badge bg-success'>Completed</span>" : "<span class='badge bg-warning text-dark'>Pending</span>" ?>
                    </td>
                    <td class="align-center">
                      <div class="form-check form-switch center">
                        <input 
                          class="form-check-input" 
                          type="checkbox" 
                          role="switch" 
                          id="task_<?= esc($item['id']) ?>" 
                           
                          oninput="isCompleted(this.id)"
                          <?= $item['is_completed'] ? 'checked' : '' ?>
                        >
                        <label class="form-check-label" for="task_<?= esc($item['id']) ?>">
                          Completed
                        </label>
                      </div>
                    </td>

                    <td class="text-center">
                        <a class="btn btn-secondary" href="<?= base_url('/task/edit/'.esc($item['id'])) ?>">Edit</a>
                        <a class="btn btn-danger" href="<?= base_url('/task/delete/'.esc($item['id'])) ?>"
                            onclick="return confirm('Are you sure you want to delete this task?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-center text-muted">No task Found</td></tr>
                <?php endif; ?>    
            </tbody>
        </table>
    </div>
</div>
<script>
         function isCompleted(id) {
            const taskId = id.split('_');

            if (taskId.length > 1) {
               $.ajax({
                  type: 'get',
                    url: "<?= base_url('/task/complete/')?>" + taskId[1],
                  success: function(response) { 
                     try {
                        const data = JSON.parse(response);
                        if (data.success) {
                           alert(data.success);
                           location.reload();
                        }
                     } catch (e) {
                        console.error('Error parsing JSON response:', e);
                     }
                  },
                  error: function(xhr, status, error) {
                     console.error("AJAX Error:", status, error);
                     alert("An error occurred during the request.");
                  }
               });
            } else {
               console.error("Invalid ID format for complete() function.");
            }
         }
</script>    


