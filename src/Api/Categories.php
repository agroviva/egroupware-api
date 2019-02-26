<?php

namespace AgroEgw\Api;

use EGroupware\Api;

class Categories
{
    public static $Categories;

    public static function init_static(string $app = 'phpgw')
    {
        self::$Categories = new Api\Categories(0, $app);
    }

    /**
     * Read category.
     *
     * @param int $id [description]
     */
    public static function Read($id)
    {
        if (!is_numeric($id)) {
            return;
        }

        return self::$Categories->read($id);
    }

    /**
     * Returns all Categories.
     *
     * @param string $app [If app given it will read only the categories of the app]
     */
    public static function ReadAll($app = 'phpgw')
    {
        $Categories = new Api\Categories(0, $app);

        return $Categories->return_array('all', 0, true, '', 'ASC', '', true, null, -1, '', null);
    }

    /**
     * Get the name of the category.
     *
     * @param int $id [Id of the category]
     *
     * @return [Name of the category]
     */
    public static function getName(int $id)
    {
        return Api\Categories::id2name($id);
    }

    /**
     * Get Color.
     *
     * @param int $id [description]
     *
     * @return [type] [description]
     */
    public static function getColor(int $id)
    {
        return Api\Categories::cats2color($id);
    }

    /**
     * Get Category by giving its name.
     *
     * @param  $name
     *
     * @return Category data
     */
    public static function getByName($name)
    {
        return self::Read(Api\Categories::name2id($name));
    }

    /**
     * Create a new Category.
     *
     * @param  $name
     * @param string $description
     * @param string $data        Special Category data like icon or color given in json format {"color":"#aaffaa","icon":""}
     * @param int    $parent      [0] if greater than 0 the category created will be a child
     */
    public static function New($name, $description = '', $data = '', $parent = 0)
    {
        $args = [
            'name'        => $name,
            'description' => $description,
            'data'        => $data,
            'parent'      => $parent,
        ];

        return self::$Categories->add($args);
    }

    /**
     * [Delete Category].
     *
     * @param  $id            ID of the Category
     * @param bool $drop_children [false] If true it will delete the children too
     */
    public static function Delete(int $id, $drop_children = false)
    {
        return self::$Categories->delete($id, $drop_children);
    }
}
Categories::init_static();
