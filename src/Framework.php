<?php

namespace AgroEgw;

class Framework
{
    /**
     * function Header
     * this is creating the header for our non e-template approach.
     */
    public function Header()
    {
        common::egw_header();
        echo parse_navbar();
    }

    /**
     * function Footer
     * this is creating the footer for our non e-template approach.
     */
    public function Footer()
    {
        common::egw_footer();
    }
}
