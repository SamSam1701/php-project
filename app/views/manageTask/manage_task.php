<h1>Danh sách công việc</h1>

<!-- Form tìm kiếm -->
<form method="get" action="danh_sach_cong_viec.php">
  <label for="search">Tìm kiếm công việc:</label>
  <input type="text" id="search" name="search" placeholder="Nhập từ khóa...">
  <button type="submit">Tìm kiếm</button>
</form>

<!-- Form lọc công việc -->
<form method="get" action="danh_sach_cong_viec.php">
  <label for="filter_status">Lọc công việc:</label>
  <select name="filter_status" id="filter_status">
    <option value="">Tất cả</option>
    <option value="Đang thực hiện">Đang thực hiện</option>
    <option value="Sắp hết hạn">Sắp hết hạn</option>
    <option value="Hoàn thành">Hoàn thành</option>
  </select>
  <button type="submit">Lọc</button>
</form>

<!-- Bảng hiển thị công việc -->
<table>
<?php if ($success): ?>
    <p>Công việc đã được xóa thành công</p>
<?php endif; ?>
  <thead>
    <tr>
      <th>Tên công việc</th>
      <th>Mô tả</th>
      <th>Ngày bắt đầu</th>
      <th>Ngày kết thúc</th>
      <th>Ngày hoàn thành</th>
      <th>Trạng thái</th>
      <th>Danh mục</th>
      <th>Hành động</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($task_list as $task): ?>
      <tr>
        <td><?php echo $task['name']; ?></td>
        <td><?php echo $task['description']; ?></td>
        <td><?php echo $task['start_date']; ?></td>
        <td><?php echo $task['due_date']; ?></td>
        <td><?php echo $task['finished_date']; ?></td>
        <td><?php echo $task['status_task']; ?></td>
        <td><?php echo $task['category_id']; ?></td>
        <td>
          <!-- Form xoá công việc -->
          <form method="post" action="manageTask.php?action=deleteTask">
            <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
            <button 
            type="submit" 
            name="delete_task" 
            onclick="return 
            confirm('Bạn có chắc chắn muốn xoá công việc này không?')"
            >
            Xoá
            </button>
          </form>
          <a href="chi_tiet_cong_viec.php?id=<?php echo $task['id']; ?>">Xem</a>
          <a href="chi_tiet_cong_viec.php?id=<?php echo $task['id']; ?>">Update</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="pagination">
  <ul>
    <?php
      $url = basename($_SERVER['PHP_SELF']) . '?';
      $start_page = max($current_page - 2, 1);
      $end_page = min($current_page + 2, $total_pages);

      // Hiển thị trang đầu tiên và trang trước đó
      if ($current_page > 1) {  
        $prev_page = $current_page - 1;
        echo "<li><a href='{$url}page=1'>First</a></li>";
        echo "<li><a href='{$url}page={$prev_page}'>Prev</a></li>";
      }

      // Hiển thị các trang ở giữa
      for ($i = $start_page; $i <= $end_page; $i++) {
        if ($i == $current_page) {
          echo "<li class='active'><a href='  #'>{$i}</a></li>";
        } else {
          echo "<li><a href='{$url}page={$i}'>{$i}</a></li>";
        }
      }

      // Hiển thị trang tiếp theo và trang cuối cùng
      if ($current_page < $total_pages) {
        $next_page = $current_page + 1;
        echo "<li><a href='{$url}page={$next_page}'>Next</a></li>";
        echo "<li><a href='{$url}page={$total_pages}'>Last</a></li>";
      }
    ?>
  </ul>
</div>