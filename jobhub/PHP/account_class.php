<?php

class Account
{
    /* Class properties (variables) */

    /* The ID of the logged in account (or NULL if there is no logged in account) */
    private $id;

    /* The name of the logged in account (or NULL if there is no logged in account) */
    private $name;

    /* TRUE if the user is authenticated, FALSE otherwise */
    private $authenticated;


    /* Public class methods (functions) */

    /* Constructor */
    public function __construct()
    {
        /* Initialize the $id and $name variables to NULL */
        $this->id = NULL;
        $this->name = NULL;
        $this->authenticated = FALSE;
    }

    /* Destructor */
    public function __destruct()
    {

    }
}
?>