<div class="card">
    <div class="card-body">
        <h1 class="mb-3">| Add New Task</h1>

        <?php if(isset($validation)): ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>    

        <form action="<?= base_url('/task/store') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="<?= set_value('title')?>" required>
            </div>
             <div class="mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description"><?= set_value('description')?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Task</button>
            <a href="<?= base_url('/') ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>