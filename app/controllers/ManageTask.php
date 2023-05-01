<?php 
class ManageTask extends Controller {

    public $model_task;

    public function __construct(){
        $this->model_task = $this->model('TaskModel');
    }

    public function manageTask() {
        $per_page = 5; // số bản ghi hiển thị trên mỗi trang
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // lấy số trang hiện tại từ URL
        $total_records = $this->model_task->getTotalRecords();
        $total_pages = ceil($total_records / $per_page); // tổng số trang

        // lấy dữ liệu của trang hiện tại
        $data = $this->model_task->getList($current_page, $per_page);
    
        // truyền dữ liệu vào view
        $this->data['sub_content']['task_list'] = $data;
        $this->data['sub_content']['page_title'] = 'Quản lý task';
        $this->data['content'] = 'manageTask/manage_task';
    
        // truyền các tham số liên quan đến phân trang vào view
        $this->data['sub_content']['current_page'] = $current_page;
        $this->data['sub_content']['total_pages'] = $total_pages;
        $this->render('layouts/client_layout', $this->data);
    }


    public function deleteTask() {
        // Lấy id công việc cần xóa từ request
        $task_id = $_POST['task_id'];
    
        // Gọi đến hàm delete của Model để xóa công việc
        $task_model = new TaskModel();
        $task_model->deleteTask($task_id);
    
        // Gán giá trị true cho biến $success để thông báo khi xóa công việc thành công
        $success = true;
    
        // Truyền biến $success qua View
        include('danh_sach_cong_viec_view.php');
    }
}