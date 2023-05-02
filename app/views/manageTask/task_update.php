<form action="/ManageTask/doUpdate/<?php echo $task_detail['id'] ?>" method="POST">
    <input type="hidden" name="task_id" value="<?php echo $task_detail['id'] ?>">
    <div class="form-group">
        <label for="name">Task Name:</label>
        <input type="text" name="name" class="form-control" value="<?php echo $task_detail['name'] ?>">
    </div>
    <div class="form-group">
        <label for="description">Task Description:</label>
        <textarea name="description" class="form-control"><?php echo $task_detail['description'] ?></textarea>
    </div>
    <div class="form-group">
        <label for="category">Task Category:</label>
        <select name="category_id" class="form-control">
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id'] ?>" <?php echo ($category['id'] == $task_detail['category_id']) ? 'selected' : '' ?>><?php echo $category['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" class="form-control" value="<?php echo date('Y-m-d', strtotime($task_detail['start_date'])) ?>">
    </div>
    <div class="form-group">
        <label for="due_date">Due Date:</label>
        <input type="date" name="due_date" class="form-control" value="<?php echo date('Y-m-d', strtotime($task_detail['due_date'])) ?>">
    </div>
    <div class="form-group">
        <label for="finished_date">Finished Date:</label>
        <input type="date" name="finished_date" class="form-control" value="<?php echo date('Y-m-d', strtotime($task_detail['finished_date'])) ?>">
    </div>
    <div class="form-group">
        <label for="status">Status:</label>
        <select name="status" class="form-control">
            <option value="0" <?php echo ($task_detail['status'] == 0) ? 'selected' : '' ?>>TODO</option>
            <option value="1" <?php echo ($task_detail['status'] == 1) ? 'selected' : '' ?>> IN PROGRESS</option>
            <option value="2" <?php echo ($task_detail['status'] == 2) ? 'selected' : '' ?>>FINISHED</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update Task</button>
</form>