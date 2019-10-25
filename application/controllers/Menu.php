<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Menu_model', 'manager');
        $this->load->helper('my_helper');
    }

    /**
     * Show menu manager
     */
    public function index()
    {
        $group_id = 1;
        $menu = $this->manager->get_menu($group_id);
        $data['menu_ul'] = '<ul id="easymm"></ul>';
        if ($menu) {
            foreach ($menu as $row) {
                $this->add_row(
                    $row->id, $row->parent_id, ' id="menu-' . $row->id . '" class="sortable "', $this->get_label($row)
                );
            }

            $data['menu_ul'] = $this->generate_list('id="easymm"');
        }
        $data['group_id'] = $group_id;
        $data['group_title'] = $this->manager->get_menu_group_title($group_id);
        $data['menu_groups'] = $this->manager->get_menu_groups();
        $this->load->view('menu', $data);
    }

    /**
     * Show menu pages
     */
    public function menu($group_id)
    {
        $menu = $this->manager->get_menu($group_id);
//        echo "<pre>".print_r($menu,true);die();
        $data['menu_ul'] = '<ul id="easymm"></ul>';
        if ($menu) {
            foreach ($menu as $row) {
                $this->add_row(
                    $row->id, $row->parent_id, ' id="menu-' . $row->id . '" class="sortable"', $this->get_label($row)
                );
            }

            $data['menu_ul'] = $this->generate_list('id="easymm"');
        }
        $data['group_id'] = $group_id;
        $data['group_title'] = $this->manager->get_menu_group_title($group_id);
        $data['menu_groups'] = $this->manager->get_menu_groups();
        $this->load->view('menu', $data);
    }

    /**
     * Generates nested lists
     *
     * @param string $ul_attr
     * @return string
     */
    function generate_list($ul_attr = '')
    {
        return $this->ul(0, $ul_attr);
    }

    /**
     * Recursive method for generating nested lists
     *
     * @param int $parent
     * @param string $attr
     * @return string
     */
    function ul($parent = 0, $attr = '')
    {
        static $i = 1;
        $indent = str_repeat("\t\t", $i);
        if (isset($this->data[$parent])) {
            if ($attr) {
                $attr = ' ' . $attr;
            }
            $html = "\n$indent";
            $html .= "<ul$attr>";
            $i++;
            foreach ($this->data[$parent] as $row) {
                $child = $this->ul($row['id']);
                $html .= "\n\t$indent";
                $html .= '<li' . $row['li_attr'] . '>';
                $html .= $row['label'];
                if ($child) {
                    $i--;
                    $html .= $child;
                    $html .= "\n\t$indent";
                }
                $html .= '</li>';
            }
            $html .= "\n$indent</ul>";
            return $html;
        } else {
            return false;
        }
    }

    function add_row($id, $parent, $li_attr, $label)
    {
        $this->data[$parent][] = array('id' => $id, 'li_attr' => $li_attr, 'label' => $label);
    }

    /**
     * Add menu item action
     * For use with ajax
     * Return json data
     */
    public function add()
    {
        $title = $this->input->post('title');
        if ($title) {
            $data['title'] = $this->input->post('title');
            if (!empty($data['title'])) {
                $data['url'] = $this->input->post('url');
                $data['class'] = $this->input->post('class');
                $data['group_id'] = $this->input->post('group_id');
                if ($this->db->insert('menu', $data)) {
                    $data['id'] = $this->db->Insert_ID();
                    $response['status'] = 1;
                    $li_id = 'menu-' . $data['id'];
                    $response['li'] = '<li id="' . $li_id . '" class="sortable">' . $this->get_labels($data) . '</li>';
                    $response['li_id'] = $li_id;
                } else {
                    $response['status'] = 2;
                    $response['msg'] = 'Add menu error.';
                }
            } else {
                $response['status'] = 3;
            }
            header('Content-type: application/json');
            echo json_encode($response);
        }
    }

    public function edit($id)
    {
        $data['row'] = $this->manager->get_row($id);
        $data['menu_groups'] = $this->manager->get_menu_groups();
        $this->load->view('menu_edit', $data);
    }

    public function save()
    {
        $title = $this->input->post('title');
        if ($title) {
            $data['title'] = trim($_POST['title']);
            if (!empty($data['title'])) {
                $data['id'] = $this->input->post('menu_id');
                $data['url'] = $this->input->post('url');
                $data['class'] = $this->input->post('class');

                $item_moved = false;
                $group_id = $this->input->post('group_id');
                if ($group_id) {
                    $group_id = $this->input->post('group_id');
                    $old_group_id = $this->input->post('old_group_id');

                    //if group changed
                    if ($group_id != $old_group_id) {
                        $data['group_id'] = $group_id;
                        $data['position'] = $this->manager->get_last_position($group_id);
                        $item_moved = true;
                    }
                }

                if ($this->db->update('menu', $data, 'id' . ' = ' . $data['id'])) {
                    if ($item_moved) {
                        //move sub items
                        $ids = $this->manager->get_descendants($data['id']);
                        if (!empty($ids)) {
                            $sql = sprintf('UPDATE %s SET %s = %s WHERE %s IN (%s)', 'menu', 'group_id', $group_id, 'id', $ids);
                            $update_sub = $this->db->Execute($sql);
                        }
                        $response['status'] = 4;
                    } else {
                        $response['status'] = 1;
                        $d['title'] = $data['title'];
                        $d['url'] = $data['url'];
                        $d['klass'] = $data['class']; //klass instead of class because of an error in js
                        $response['menu'] = $d;
                    }
                } else {
                    $response['status'] = 2;
                    $response['msg'] = 'Edit menu item error.';
                }
            } else {
                $response['status'] = 3;
            }
            header('Content-type: application/json');
            echo json_encode($response);
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        if ($id) {
            $this->manager->get_descendants($id);
            if (!empty($this->ids)) {
                $ids = implode(', ', $this->ids);
                $id = "$id, $ids";
            }

            $res = $this->manager->delete_menu($id);
            if ($res) {
                $response['success'] = true;
            } else {
                $response['success'] = false;
            }
            header('Content-type: application/json');
            echo json_encode($response);
        }
    }

    /**
     * new save position method
     */
    public function save_position()
    {
        $menu = $this->input->post('menu');
        if (!empty($menu)) {
            //adodb_pr($menu);
            $menu = $this->input->post('menu');
            foreach ($menu as $k => $v) {
                if ($v == 'null') {
                    $menu2[0][] = $k;
                } else {
                    $menu2[$v][] = $k;
                }
            }
            $success = 0;
            if (!empty($menu2)) {
                foreach ($menu2 as $k => $v) {
                    $i = 1;
                    foreach ($v as $v2) {
                        $data['parent_id'] = $k;
                        $data['position'] = $i;
                        if ($this->db->update('menu', $data, 'id' . ' = ' . $v2)) {
                            $success++;
                        }
                        $i++;
                    }
                }
            }
        }
    }

    public function old_save_position()
    {
        if (isset($_POST['easymm'])) {
            $easymm = $_POST['easymm'];
            $this->update_position(0, $easymm);
        }
    }

    private function update_position($parent, $children)
    {
        $i = 1;
        foreach ($children as $k => $v) {
            $id = (int)$children[$k]['id'];
            $data[MENU_PARENT] = $parent;
            $data[MENU_POSITION] = $i;
            $this->db->update(MENU_TABLE, $data, MENU_ID . ' = ' . $id);
            if (isset($children[$k]['children'][0])) {
                $this->update_position($id, $children[$k]['children']);
            }
            $i++;
        }
    }

    /**
     * Get label for list item in menu manager
     * this is the content inside each <li>
     *
     * @param array $row
     * @return string
     */
    private function get_label($row)
    {
        $label = '<div class="ns-row">' .
            '<div class="ns-title">' . $row->title . '</div>' .
            '<div class="ns-url">' . $row->url . '</div>' .
//            '<div class="ns-class">' . $row->class . '</div>' .
            '<div class="actions">' .
            '<a href="#" class="edit-menu" title="Edit">' .
            '<span class="glyphicon glyphicon-edit" style="color: #444"></span>' .
            '</a>' .
            '<a href="#" class="delete-menu" title="Delete">' .
            '<span class=" 	glyphicon glyphicon-remove" style="color: red"></span>' .
            '</a>' .
            '<input type="hidden" name="menu_id" value="' . $row->id . '">' .
            '</div>' .
            '</div>';
        return $label;
    }

    private function get_labels($row)
    {
        $label = '<div class="ns-row">' .
            '<div class="ns-title">' . $row['title'] . '</div>' .
            '<div class="ns-url">' . $row['url'] . '</div>' .
            '<div class="ns-class">' . $row['class'] . '</div>' .
            '<div class="actions">' .
            '<a href="#" class="edit-menu" title="Edit">' .
            '<img src="' . base_url() . 'assets/images/edit.png" alt="Edit">' .
            '</a>' .
            '<a href="#" class="delete-menu" title="Delete">' .
            '<img src="' . base_url() . 'assets/images/cross.png" alt="Delete">' .
            '</a>' .
            '<input type="hidden" name="menu_id" value="' . $row['id'] . '">' .
            '</div>' .
            '</div>';
        return $label;
    }

    public function sample()
    {
        $this->load->view('sample');
    }

    public function vertical_sample()
    {
        $this->load->view('vertical_menu_sample');
    }
}
