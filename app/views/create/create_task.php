<div class="create-page-container">
	<h1 class="title-page-create">Thêm mới công việc</h1>
		<form class="form-create" method="post">
			<label class="label-create" for="name">Tên công việc:</label>
			<input class="input-text" type="text" id="name" name="name" required>
	
			<label class="label-create" for="description">Mô tả công việc:</label>
			<textarea class="input-text" id="description" name="description" required></textarea>
	
			<div class="date">
				<div class="date-start">
					<label class="label-create" for="start_date">Ngày bắt đầu:</label>
					<input type="date" id="start_date" name="start_date" required>
				</div>
				<div class=="date-end">
					<label class="label-create" for="due_date">Ngày kết thúc:</label>
					<input type="date" id="due_date" name="due_date" required>
				</div>
			</div>
	
			<label class="label-create" id="cate" for="category_id">Loại công việc:</label>
			<select class="input-text" id="category_id" name="category_id" required>
				<option value="">Chọn loại công việc</option>
				<option value="1">Công việc</option>
				<option value="2">Cá nhân</option>
			</select>
	
			<div class="btn-group">
				<input class="input-submit" type="submit" name="submit" value="Thêm mới">
				<a class="back-btn" href="/">Trở về</a>
			</div>
		</form>
</div>
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