<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function get_easymenu($group_id, $attr = '')
{

    $ci = &get_instance();
    $ci->data = array();
    $ci->db->select('*');
    $ci->db->from('menu');
    $ci->db->where('group_id', $group_id);
    $query = $ci->db->get();
    $menu = $query->result();
    foreach ($menu as $row) {
        $label = '<a href="' . $row->url . '">';
        $label .= $row->title;
        $label .= '</a>';

        $li_attr = '';
        if ($row->class) {
            $li_attr = ' class=""';
        }
        $ci->add_row($row->id, $row->parent_id, $li_attr, $label);
    }
    $menu = $ci->generate_list($attr);
    return $menu;
}

function get_menu($group_id, $attr = '')
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
                $object->main_menu[$i]->ok[]=$parent;
            };
        };
    };



    return $object;
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