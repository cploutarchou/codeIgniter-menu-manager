<?php
declare( strict_types=1 );

class User extends Db_object
{
    /**
     * var string
     */
    protected static $db_table = "users";
    /**
     * var array
     */
    protected static $db_table_fields = ['username', 'password', 'first_name', 'last_name', 'email', 'image'];
    /**
     * @var string
     */
    public $username, $first_name, $last_name, $password, $email, $register_date, $status, $tmpName,
        $profile_image_file, $image, $id;
    /**
     * @var array
     */
    public $message = [];

    public function find_all_users()
    {
        global $database;
        $array = $database->query("SELECT * FROM " . self::$db_table . "");
        $result = [];
        while ($record = $array->fetch_assoc()) {
            $result[] = $record;
        }

        return $result;
    }

    /**
     * @param $query
     *  With that Function we just pass our query and to get all query results need to
     *  create a foreach loop
     *
     * @return bool|mysqli_result
     */
    public function find_any_query($query)
    {
        global $database;
        $query_results = $database->query($query);

        return $query_results;
    }

    /**
     * @param $query
     *              With that function we pass our query then function get all value using while method for each result
     *              and get data using fetch_object php method then return or the results and get all data using
     *              foreach loop
     *
     * @return array
     */
    public function find_any_query_oop($query)
    {
        $result = [];
        global $database;
        $query_results = $database->query($query);
        while ($res = $query_results->fetch_object()) {
            $result[] = $res;
        }

        return $result;
    }

    public function find_user_by_id($user_id)
    {
        global $database;
        /** @noinspection SqlResolve */
        $result = $database->query("SELECT * FROM " . self::$db_table . " WHERE id= {$user_id} LIMIT 1");
        $found_user = $result->fetch_array();

        return $found_user;
    }

    /**
     *
     */
    public function create_new_user()
    {
        if ($this->upload_profile_image() == true) {
            if ($this->create()) {
                unset($this->tmp_path);
                return true;
            }

        }

    }

    /**
     * @return bool
     */
    public function upload_profile_image()
    {
        if (!empty($this->image)) {
            $target_path = UPLOAD_PROFILE_IMAGE_FOLDER . "{$this->image}";
            if (file_exists($target_path)) {
                $this->message = [
                    'status' => 3,
                    'msg' => "The File {$this->image} already exists"
                ];
                return false;
            } else {
                if (move_uploaded_file($this->tmpName, $target_path)) {
                    return true;
                } else {
                    $this->message = [
                        'status' => 0,
                        'msg' => "This Image cannot be uploaded"
                    ];
                    return false;
                }
            }

        }
    }

    public function update_user_info()
    {
        if ($_FILES['profile_image']['error'] == 4) {
            if ($this->update() != false) {
                $this->message =
                    [
                        'status' => 1,
                        'msg' => 'User Updated Successfully '
                    ];

            } else {
                $this->message =
                    [
                        'status' => 0,
                        'msg' => 'Unable to Update user'
                    ];
                redirect('/admin/users.php');
            }

        } else {
            if ($this->upload_profile_image() == true) {
                if ($this->update()) {
                    unset($this->tmp_path);
                    $this->message = [
                        'status' => 1,
                        'msg' => "Image {$this->image} Successfully uploaded"
                    ];
                    return true;
                }

            }

        }
    }

    public function delete_user()
    {
        $this->message = $_SESSION['message'];
        if (!empty($this->id)) {
            if ($this->delete() == true) {

                if ($this->image != null) {
                    $target_path = UPLOAD_PROFILE_IMAGE_FOLDER . "{$this->image}";
                    if (file_exists($target_path)) {
                        if (unlink($target_path)) {
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        return true;
                    }
                } else {
                    return true;
                }

            }
        }
    }

    public function find_user_by_id_oop($user_id)
    {
        global $database;
        /** @noinspection SqlResolve */
        $result = $database->query("SELECT * FROM " . self::$db_table . " WHERE id= {$user_id} LIMIT 1");
        return $result->fetch_object(User::class);

    }


    /**
     * With that method we check if user exist return true and user info
     * else return false
     *
     * @param $username
     * @param $password
     *
     * @return bool|mysqli_result
     */
    public function verify_user($username, $password)
    {
        global $database;
        $user_name = $database->escape_string($username);
        $pass = $database->escape_string($password);
        /** @noinspection SqlResolve */
        $query = "SELECT * FROM " . self::$db_table . " WHERE username = '{$user_name}' and password = '{$pass}' limit 1";
        $res = $database->query($query);
        if ($res->num_rows >= 1) {
            return $res;
        } else {
            return FALSE;
        }

    }

    public function check_if_username_exist($username)
    {
        global $database;
        $username = $database->escape_string($username);
        /** @noinspection SqlResolve */
        $sql = "SELECT username FROM " . self::$db_table . " WHERE username = '{$username}'";

        $res = $database->query($sql);

        if ($res->num_rows >= 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    public function ajax_save_user_profile_image($data)
    {
        global $database;
        $this->image = $database->escape_string($data['image']);
        $this->id = $database->escape_string($data['user_id']);
        $sql = "UPDATE " . self::$db_table . " SET image = '{$this->image}' where id = '{$this->id}'";
        $res = $database->query($sql);
        if ($res) {
            echo json_encode(['status' => 1, 'msg' => "User image Successfully updated", 'img' => $this->image]);
        } else {
            echo json_encode(['status' => 0, "msg" => "Unable to update Profile image"]);
        }

    }


}

$user = new User();




















