<?php

defined('BASEPATH') OR exit('No direct script access allowed');


function get_main_menu($group_id, $attr = '')
{
    $object = new stdClass();
    $main_menu = [];
    $ci = &get_instance();
    $ci->data = array();
    $ci->db->select('*');
    $ci->db->from('menu');
    $ci->db->where('group_id', $group_id);
    $ci->db->order_by('position');
    $query = $ci->db->get();
    $menu = $query->result();;

    for ($i = 0; $i <= count($menu) - 1; $i++) {
        if ($menu[$i]->parent_id == 0) {
            $main_menu[] = $menu[$i];
        };
    };

    for ($x = 0; $x < count($main_menu, true); $x++) {
        $parent_menu = [];
        for ($q = 0; $q < count($menu, true); $q++) {
            if ($menu[$q]->parent_id == $main_menu[$x]->id) {
                $parent_menu[] = $menu[$q];
            };
        };
        $main_menu[$x]->parent_menu = $parent_menu;
    };


//    var_dump($main_menu);

    for ($i = 0; $i < count($main_menu, true); $i++) {
        for ($x = 0; $x < count($main_menu[$i]->parent_menu, true); $x++) {
            for ($e = 0; $e < count($menu, true); $e++) {
                if ($main_menu[$i]->parent_menu[$x]->id == $menu[$e]->parent_id) {
                    $parent_submenu[] = $menu[$e];
                    $uniqueArray = array_unique($parent_submenu, SORT_REGULAR);
                    $main_menu[$i]->parent_menu[$x]->parent_submenu = $uniqueArray;
                };
            };
        };
    }

    $object->main_menu = $main_menu;
    return $object;
}

function get_menu($group_id, $style = '')
{
    $ci = &get_instance();
    $data = [
        'group_id' => $group_id,
        'style' => $style
    ];
    $ci->load->view('menus/vertical-menu-default', $data);
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
