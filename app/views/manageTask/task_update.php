<div class="update-page-container">
    <h1>Cập nhật công việc</h1>
    <form class="update-task-form" action="/ManageTask/doUpdate/<?php echo $task_detail['id'] ?>" method="POST">
        <input type="hidden" name="task_id" value="<?php echo $task_detail['id'] ?>">
        <div class="form-group">
            <label for="name">Tên công việc</label>
            <input type="text" name="name" class="form-control" value="<?php echo $task_detail['name'] ?>">
        </div>
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" class="form-control"><?php echo $task_detail['description'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="category">Danh mục</label>
            <select name="category_id" class="form-control">
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id'] ?>" <?php echo ($category['id'] == $task_detail['category_id']) ? 'selected' : '' ?>><?php echo $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="start_date">Ngày bắt đầu</label>
            <input type="date" name="start_date" class="form-control" value="<?php echo date('Y-m-d', strtotime($task_detail['start_date'])) ?>">
        </div>
        <div class="form-group">
            <label for="due_date">Ngày kết thúc</label>
            <input type="date" name="due_date" class="form-control" value="<?php echo date('Y-m-d', strtotime($task_detail['due_date'])) ?>">
        </div>
        <div class="form-group">
            <label for="finished_date">Ngày hoàn thành</label>
            <input type="date" name="finished_date" class="form-control" value="<?php echo date('Y-m-d', strtotime($task_detail['finished_date'])) ?>">
        </div>
        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="0" <?php echo ($task_detail['status'] == 0) ? 'selected' : '' ?>>TODO</option>
                <option value="1" <?php echo ($task_detail['status'] == 1) ? 'selected' : '' ?>> IN PROGRESS</option>
                <option value="2" <?php echo ($task_detail['status'] == 2) ? 'selected' : '' ?>>FINISHED</option>
            </select>
        </div>
        <div class="btn-group">
				<!-- <input class="input-submit" type="submit" name="submit" value="Thêm mới"> -->
                <button type="submit" class="input-submit">Cập nhật</button>
                <a class="back-btn" href="/">Trở về</a>
			</div>
    </form>
</div>