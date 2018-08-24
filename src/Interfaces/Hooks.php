<?php

namespace AgroEgw;

interface Hooks
{
    /**
     * Hook called by link-class to include test in the appregistry of the linkage.
     *
     * @param array/string $location location and other parameters (not used)
     *
     * @return array with method-names
     */
    public static function search_link($location);

    // To register all hooks for the app. on the proper location
    public static function all_hooks($args);
}
