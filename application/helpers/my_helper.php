<?php

defined('BASEPATH') OR exit('No direct script access allowed');


function get_main_menu($group_id, $attr = '')
{
    $object = new stdClass();
    $main_menu = [];
    $parent_menu = [];
    $ci = &get_instance();
    $ci->data = array();
    $ci->db->select('*');
    $ci->db->from('menu');
    $ci->db->where('group_id', $group_id);
    $query = $ci->db->get();
    $menu = $query->result();

    for ($i = 0; $i <= count($menu) - 1; $i++) {
        if ($menu[$i]->parent_id == 0) {
            $main_menu[] = $menu[$i];

        };
        if ($menu[$i]->parent_id != 0) {
            $parent_menu[] = $menu[$i];
        };
    };

    $object->main_menu = $main_menu;
    for ($i = 0; $i <= count($menu) - 1; $i++) {
        foreach ($parent_menu as $parent) {
            if ($parent->parent_id == $menu[$i]->id) {
                $object->main_menu[$i]->submenu[] = $parent;
                $subParent[] = $parent;
            };


        };

    };
    for ($i = 0; $i <= count($menu) - 1; $i++) {
        if (@is_array($object->main_menu[$i]->submenu)) {
            foreach ($object->main_menu[$i]->submenu as $sub) {
                $query = $ci->db->query("select * from menu where parent_id = $sub->id");
                $res = $query->result();
                $ar[] = $res;
                $sub->sub = $ar;
            }
        }
    }

    $object->count = count($main_menu) - 1;

    return $object;
}

function get_menu($group_id, $style = '')
{

    $ci = &get_instance();
    $data = [
        'group_id' => $group_id,
        'style'=>$style
    ];
    $ci->load->view('menus/vertical-menu-default',$data);
}

/**
 * Add an item
 *
 * @param int $id ID of the item
 * @param int $parent parent ID of the item
 * @param string $li_attr attributes for <li>
 * @param string $label text inside <li></li>
 */
function add_row($id, $parent, $li_attr, $label)
{
    $this->data[$parent][] = array('id' => $id, 'li_attr' => $li_attr, 'label' => $label);
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
    $this->data = array();
}

/**
 * Clear the temporary data
 *
 */
function clear()
{
    $this->data = array();
}

function is_array_check(array $test_var)
{
    foreach ($test_var as $key => $el) {
        if (is_array($el)) {
            return true;
        }
    }
    return false;
}