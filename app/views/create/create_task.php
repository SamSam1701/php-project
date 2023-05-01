<h1>Thêm mới công việc</h1>
	<form method="post">
		<label for="name">Tên công việc:</label>
		<input type="text" id="name" name="name" required>

		<label for="description">Mô tả công việc:</label>
		<textarea id="description" name="description" required></textarea>

		<label for="start_date">Ngày bắt đầu:</label>
		<input type="date" id="start_date" name="start_date" required>

		<label for="due_date">Ngày kết thúc:</label>
		<input type="date" id="due_date" name="due_date" required>

		<label for="category_id">Loại công việc:</label>
		<select id="category_id" name="category_id" required>
			<option value="">Chọn loại công việc</option>
			<option value="1">Công việc</option>
			<option value="2">Cá nhân</option>
		</select>

		<input type="submit" name="submit" value="Thêm mới">
	</form>
<?php
	$db = new Database();

if(isset($_POST['submit'])){
    $data = array(
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'start_date' => $_POST['start_date'],
        'due_date' => $_POST['due_date'],
        'category_id' => $_POST['category_id']
    );

    $result = $db->insert('TASK', $data);

    if($result){
        echo "Thêm mới công việc thành công!";
    }else{
        echo "Thêm mới công việc thất bại!";
    }
}
?>