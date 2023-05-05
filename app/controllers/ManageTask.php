<?php 
class ManageTask extends Controller {

    public $model_task;

    public function __construct(){
        $this->model_task = $this->model('TaskModel');
        $this->model_category = $this->model('CategoryModel');
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'])) {
            $task_id = $_POST['task_id'];
            $task_model = $this->model('TaskModel');
            $task_model->deleteTask($task_id);
          }
          header('Location: /ManageTask/manageTask?page=1');
          exit();
    }

    public function getDetail($task_id) {
        $data = $this->model_task->getDetail($task_id);
        $this->data['sub_content']['task_detail'] = $data;
        $this->data['sub_content']['id'] = $task_id;
        $this->data['content'] = 'manageTask/task_detail';
        $this->render('layouts/client_layout', $this->data);
    }

    public function updateTask($task_id){
        $data = $this->model_task->getDetail($task_id);
        $categories = $this->model_category->getListCategories();
        $this->data['sub_content']['categories'] = $categories;
        $this->data['sub_content']['task_detail'] = $data;
        $this->data['content'] = 'manageTask/task_update';
    
        $this->render('layouts/client_layout', $this->data);
    }

    public function doUpdate($task_id){
             $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'start_date' => $_POST['start_date'],
            'due_date' => $_POST['due_date'],
            'finished_date' => $_POST['finished_date'],
            'status' => $_POST['status'],
            'category_id' => $_POST['category_id']
        ];
        
        // Gọi phương thức updateTask() của tầng model và truyền vào tham số $task_id và $data
        $taskModel = new TaskModel();
        $status = $taskModel->updateTask($task_id, $data);
    
        if($status){
            // Cập nhật thành công
            // Redirect đến trang danh sách task
            header('Location: /ManageTask/manageTask?page=1');
            exit();
        } else {
            // Cập nhật thất bại
            // Hiển thị thông báo lỗi
            echo 'Cập nhật thất bại!';
        }
    }

    public function search(){
        $keyword = isset($_GET['search']) ? $_GET['search'] : ''; // lấy từ khóa tìm kiếm từ URL
        $per_page = 5; // số bản ghi hiển thị trên mỗi trang
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // lấy số trang hiện tại từ URL
        $total_records = $this->model_task->getTotalSearchRecords($keyword); // lấy tổng số bản ghi dựa trên từ khóa tìm kiếm
        $total_pages = ceil($total_records / $per_page); // tổng số trang
    
        // lấy dữ liệu của trang hiện tại dựa trên từ khóa tìm kiếm
        $data = $this->model_task->search($keyword, $current_page, $per_page);
    
        // truyền dữ liệu vào view
        $this->data['sub_content']['task_list'] = $data;
        $this->data['sub_content']['page_title'] = 'Kết quả tìm kiếm';
        $this->data['content'] = 'manageTask/manage_task';
    
        // truyền các tham số liên quan đến phân trang vào view
        $this->data['sub_content']['current_page'] = $current_page;
        $this->data['sub_content']['total_pages'] = $total_pages;
        $this->render('layouts/client_layout', $this->data);
    }


    public function filter(){
        $status = $_GET['filter_status'];
        $keyword = '';
        if ($status === 'COMPLETE')
        {
            $keyword = 2;
        }else if ($status === 'TODO')
        {
            $keyword = 0;
        }else if ($status === 'IN PROGRESS')
        {
            $keyword = 1;
        } else {
            $keyword ='';
        }
        $per_page = 5; // số bản ghi hiển thị trên mỗi trang
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // lấy số trang hiện tại từ URL
        $total_records = $this->model_task->getTotalFilterRecords($keyword); // lấy tổng số bản ghi dựa trên từ khóa tìm kiếm
        $total_pages = ceil($total_records / $per_page); // tổng số trang
        $filtered_data = $this->model_task->filterStatusTask($keyword,$current_page, $per_page);
        $this->data['sub_content']['task_list'] = $filtered_data;
        $this->data['sub_content']['page_title'] = 'Kết quả tìm kiếm';
        $this->data['content'] = 'manageTask/manage_task';
    
        // truyền các tham số liên quan đến phân trang vào view
        $this->data['sub_content']['current_page'] = $current_page;
        $this->data['sub_content']['total_pages'] = $total_pages;
        $this->render('layouts/client_layout', $this->data);
    }

    public function deleteTasks()
    {
    if (isset($_POST['deleteTasks'])) {
        
        // get the IDs of the selected tasks
        $taskIds = $_POST['task_ids'];
        
        // loop through the task IDs and delete the tasks
        foreach ($taskIds as $taskId) {
            // delete the task with the given ID from the database
            $task_model->deleteTask($taskId);
        }
        
        // redirect the user to the task list page
        header("Location: /task-list.php, Content-Type: application/json");
        exit();
    }
    }

}