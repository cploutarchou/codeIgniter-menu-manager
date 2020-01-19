<?php

declare( strict_types=1 );


class Photos extends DBObject
{


    /**
     * var string
     */
    protected static $db_table = "photos";
    /**
     * var array
     */
    protected static $db_table_fields = ['id', 'title', 'description', 'filename', 'type', 'size', 'alt', 'caption'];


    /**
     * var string
     */
    public $id, $title, $description, $filename, $tmp_name, $caption, $type, $size, $alt, $uploaded_on, $tmp_path,
        $upload_directory
        = "images", $message = "";

    /**
     * @var array
     */
    public $errors = [];

    /**
     * @var array
     */
    public $upload_errors_array = [
        0 => "There is no error, the file uploaded with success",
        1 => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
        2 => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
        3 => "The uploaded file was only partially uploaded",
        4 => "No file was uploaded",
        6 => "Missing a temporary folder"];

    /**
     * This method passing $_file['uploaded_file'] as an argument
     *
     * @param $file
     *
     * @return mixed
     */
    public function set_file($file)
    {
        if (!file_exists($file['tmp_name']) && !is_uploaded_file($file['name'])) {

            $this->errors[] = $this->upload_errors_array[4];
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->size = $file['size'];
            $this->type = $file['type'];
            return true;
        }
    }


    /**
     * @return string
     */
    public function picture_path()
    {
        return $this->upload_directory . DS . $this->filename;
    }

    /**
     * @return bool|mysqli_result|string
     */
    public function save_photo()
    {


        if ($this->id) {
            $this->update();
        } else {
            if (!empty($this->errors)) {
                return false;
            }
            if (empty($this->filename || empty($this->tmp_path))) {
                $this->errors[] = "The file is not available";
                return false;
            }
        }

        $target_path = UPLOAD_FOLDER . "{$this->filename}";
        if (file_exists($target_path)) {

            $this->errors[] = "The File {$this->filename} already exists";
            return false;
        }
        if (move_uploaded_file($this->tmp_path, $target_path)) {
            if ($this->create()) {
                unset($this->tmp_path);
                return true;
            }
        } else {
            $this->errors[] = "Check Folder Permissions";
            return false;
        }
        return '';
    }

    public function delete_image()
    {

        if ($this->delete()) {
            $target_path = UPLOAD_FOLDER . "{$this->filename}";

            if (unlink($target_path) ? true : false) {
                echo json_encode(array('status' => 1, 'msg' => "Image successfully deleted"));
                redirect('/admin/photos.php');
            } else {
                echo json_encode(array('status' => 0, 'msg' => "Something went wrong,please try again."));
                return false;
            }
        } else {
            return false;
        }

    }

    public function get_all_images()
    {
        global $database;
        $query = "SELECT  * FROM photos";
        $res = $database->find_any_query_oop($query);
        return $res;
    }


}

$photo = new Photos();
