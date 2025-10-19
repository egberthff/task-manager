<div class="card">
    <div class="card-body">
        <h1 class="mb-3">| Edit New Task</h1>

        <?php if(isset($validation)): ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>    

        <form action="<?= base_url('/task/update/'. $task['id']) ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" value="<?= $task['id'] ?>">
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="<?= $task['title']?>" required>
            </div>
             <div class="mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description"><?= $task['description']?></textarea>
            </div>
            <div class="mb-3">
                <label for="is_completed">Task Status</label>
                <select name="is_completed" id="is_completed" class="form-select" required>
                    <option value="">Select Status</option>
                    <option value="1"<?php if($task['is_completed'] == 1){echo 'selected';} ?>>Completed</option>
                    <option value="0"<?php if($task['is_completed'] == 0){echo 'selected';} ?>>Pending</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save Task</button>
            <a href="<?= base_url('/') ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>