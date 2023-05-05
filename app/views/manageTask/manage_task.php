<div id="search-results">
  <h1>Danh sách công việc</h1>
  
  <div class="search-container">
    <!-- Form tìm kiếm -->
    <form method="get" action="#" id="search-form">
      <label for="search"></label>
      <input type="text" id="search" name="search" placeholder="Nhập từ khóa...">
      <button type="submit">Tìm kiếm</button>
    </form>
    
    <!-- Form lọc công việc -->
    <form method="get" action="#" id="filter-form">
      <label for="filter_status"></label>
      <select name="filter_status" id="filter_status">
        <option value="">Tất cả</option>
        <option value="IN PROGRESS">IN PROGRESS</option>
        <option value="TODO">TODO</option>
        <option value="COMPLETE">COMPLETE</option>
      </select>
      <button type="submit">Lọc</button>
    </form>
  </div>
  
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
          <td><?php echo date('d/m/Y', strtotime($task['start_date'])); ?></td>
<td><?php echo date('d/m/Y', strtotime($task['due_date'])); ?></td>
          <td>
    <?php if ($task['finished_date'] === null || $task['finished_date']=== ''): ?>
      incomplete
    <?php else: ?>
      <?php echo $task['finished_date']; ?>
    <?php endif; ?>
  </td>
          <td>
    <?php if ($task['status'] === 0 || $task['status'] === null): ?>
      TODO
    <?php elseif ($task['status'] === 1): ?>
      IN PROGRESS
    <?php elseif ($task['status'] === 2): ?>
      COMPLETE
    <?php endif; ?>
  </td>
          <td><?php echo $task['category_name']; ?></td>
          <td>
            <!-- Form xoá công việc -->
            <form method="post" action="/ManageTask/deleteTask">
              <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
              <button
              type="submit"
              name="deleteTask"
              onclick="return
              confirm('Bạn có chắc chắn muốn xoá công việc này không?')"
              >
              <i class="fas fa-trash">xóa</i>
              </button>
            </form>
            <a href="/ManageTask/getDetail/<?php echo $task['id']; ?>"><i class="fas fa-eye">Xem</i></a>
            <a href="/ManageTask/updateTask/<?php echo $task['id']; ?>"><i class="fas fa-edit">Cập nhật</i></a>
            <input type="checkbox" name="task_id[]" value="<?php echo $task['id']; ?>">
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
  <button class="delete-tasks" onclick="deleteTasks()">Xóa nhiều công việc</button>  
  <a class="back-btn manage-task-button-back" href="/">Trở về</a>
</div>
    
<script>
 $('#search-form').submit(function(event) {
  event.preventDefault();
  var searchTerm = $('#search').val();
  $.ajax({
    url: '/ManageTask/search',
    type: 'GET',
    data: {
      search: searchTerm
    },
    success: function(data) {
      $('#search-results').html(data);
    },
    error: function() {
      alert('Lỗi xảy ra!');
    }
  });
});

$('#filter-form').submit(function(event) {
  event.preventDefault();
  var status = $('#filter_status').val();
  console.log(status);
  $.ajax({
    url: '/ManageTask/filter',
    type: 'GET',
    data: {
      filter_status: status
    },
    success: function(data) {
      $('#search-results').html(data);
    },
    error: function() {
      alert('Lỗi xảy ra!');
    }
  });
});

function deleteTasks() {
    // lấy danh sách checkbox được chọn
    const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
    const taskIds = Array.from(checkboxes).map(cb => cb.value);
    // gửi yêu cầu xóa đến server
    fetch('/ManageTask/deleteTasks', {
  method: 'POST',
  body: JSON.stringify({ taskIds }),
  headers: { 'Content-Type': 'application/json' }
})
    .then(response => response.json())
    .then(data => {
      console.log(data.taskIds);
      if (data.success) {
        // xóa các bản ghi đã chọn khỏi bảng
        checkboxes.forEach(cb => cb.parentNode.parentNode.remove());
        alert('Xóa thành công!');
      } else {
        alert('Xóa không thành công!');
      }
    });
  }
</script>