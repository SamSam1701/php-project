<h1 class="task-title">Chi tiết công việc</h1>

<table class="task-details">
  <tr>
    <td>Tên công việc</td>
    <td><?php echo $task_detail['name'] ?></td>
  </tr>
  <tr>
    <td>Mô tả</td>
    <td><?php echo $task_detail['description'] ?></td>
  </tr>
  <tr>
    <td>Ngày bắt đầu</td>
    <td><?php echo $task_detail['start_date'] ?></td>
  </tr>
  <tr>
    <td>Ngày kết thúc</td>
    <td><?php echo $task_detail['due_date'] ?></td>
  </tr>
  <tr>
    <td>Ngày hoàn thành</td>
    <td>
      <?php if ($task_detail['finished_date'] === null || $task_detail['finished_date']=== ''): ?>
        incomplete
      <?php else: ?>
        <?php echo $task_detail['finished_date']; ?>
      <?php endif; ?>
    </td>
  </tr>
  <tr>
    <td>Trạng thái</td>
    <td>  
      <?php if ($task_detail['status'] == 0): ?>
        TODO
      <?php elseif ($task_detail['status'] == 1): ?>
        IN PROGRESS
      <?php elseif ($task_detail['status'] == 2): ?>
        COMPLETE
      <?php endif; ?>
    </td>
  </tr>
  <tr>
    <td>Danh mục</td>
    <td><?php echo $task_detail['category_name'] ?></td>
  </tr>
</table>
<a class="back-btn detail-task-back-btn"href="/">Trở về</a>