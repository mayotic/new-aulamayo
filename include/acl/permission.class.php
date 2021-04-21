<?php
/**
 * The permission class itself
 * An instance of this class refers to a currently existing permission
 */
class Permission {
    protected $id;
    protected $name;
    protected $userlist;

    /**
     * Usual constructor. Allows several kinds of param, triggers other
     * methods accordingly
     * If the Permission is referred to by id, and no permission by that id
     * exist, the Permission instance will essentially be empty
     * If the Permission is referred to by name, and no permission by that name
     * exists, will attempt to create it and set $this->name and $this->id,
     * by calling Permission::create()
     * @param perm int|string something representing the permission, either
            its id or its name
     */
    public function __construct( $perm ) {
        if ( ( is_int( $perm ) || ctype_digit( $perm ) ) && $perm > 0 ) {
            return $this->fetchById( $perm );
        }
        if ( is_string( $perm ) ) {
            return $this->fetchByName( $perm );
        }
    }

    /**
     * Fallback function to create permissions on the go. Will be called by the
     * constructor (or more accurately Permission::fetchByName()) when provided
     * with an unrecognized permission name.
     * Once the permission is in the DB, will set $this->id and $this->name
     * to conclude __construct functionality
     * @param name string the new permission name
     */
    private function create( $name ) {
        if ( ( DBMaster::getInstance()
                    ->prepare( 'INSERT INTO permissions (permission_id, permission_name)
                                VALUES (NULL, :newperm)' )
                    ->execute( array( 'newperm' => $name ) ) )
                && ( $id = DBMaster::getInstance()->lastInsertId() ) ) {
            $this->name = $name;
            $this->id = $id;
            return true;
        }
        else {
            unset( $this->name );
            return false;
        }
    }

    /**
     * Deletes all records regarding the current permission in the database,
     * including all links to the users in the users_permissions table.
     * @return bool true on success, false on failure (database not writable)
     */
    public function delete() {
        if ( ! isset( $this->id ) ) {
            return true;
        }
        $a = DBMaster::getInstance()
                    ->prepare( 'DELETE FROM permissions
                        WHERE permission_id = :deleteperm' )
                    ->execute( array( ':deleteperm' => $this->id ) );
        unset( $this->id, $this->name );
        return $a;
    }

    /**
     * Fetches a permission using its permission id
     * If a permission with this id doesn't exist, will return false
     * @param id int
     * @return mixed an object representing the permission, or false on failure
     */
    private function fetchById( $id ) {
        $this->id = $id;
        $namestatement = DBSlave::getInstance()
                    ->prepare( 'SELECT permission_name
                                FROM permissions
                                WHERE permission_id = :permid' );
        $namestatement->execute( array( ':permid' => $id ) );
        if ( $namerow = $namestatement->fetch() ) {
            $this->name = $namerow['permission_name'];
            return true;
        }
        unset( $this->id, $this->name );
        return false;
    }

    /**
     * Fetches a permission using its permission name
     * If a permission by this name doesn't exist, will attempt to create one
     * @param name string the name of the permission
     * @return object an instance of Permission representing the permission by
            that name
     */
    private function fetchByName( $name ) {
        $this->name = $name;
        $namestatement = DBSlave::getInstance()
                    ->prepare( 'SELECT permission_id
                                FROM permissions
                                WHERE permission_name = :permname' );
        $namestatement->execute( array( ':permname' => $name ) );
        if ( $namerow = $namestatement->fetch() ) {
            $this->id = $namerow['permission_id'];
            return true;
        }
        return $this->create( $name );
    }

    /**
     * Gets the id of the permission
     * @return int the id of the permission
     */
    public function getId() {
        if ( ! isset( $this->id ) ) {
            return false;
        }
        return $this->id;
    }

    /**
     * Gets the name of the permission
     * @return string the name of the permission
     */
    public function getName() {
        if ( ! isset( $this->name ) ) {
            return false;
        }
        return $this->name;
    }

    /**
     * Lists all users who currently are granted that permission
     * @param refresh bool whether or not to refresh the cache for the list
            of users having that permission
     * @return array an array with user ids as keys, usernames as values
     */
    public function listUsers( $refresh = false ) {
        if ( ! isset( $this->id ) ) {
            return array();
        }
        if ( ! isset( $this->userList ) || $refresh ) {
            $userlist = DBMaster::getInstance()
                                ->prepare( 'SELECT users_permissions.user_id, users.user_name
                                            FROM users, users_permissions
                                            WHERE users_permissions.permission_id = :permid
                                                AND users.user_id = users_permissions.user_id' );
            $userlist->execute( array( ':permid' => $this->id ) );
            $this->userList = $userlist->fetchAll( PDO::FETCH_COLUMN | PDO::FETCH_GROUP | PDO::FETCH_UNIQUE );
        }
        return $this->userList;
    }

    /**
     * Normalizes a permission represented by its name, id, or object
     * and returns its id.
     * @param mixed perm a permission represented by its name, id, or object
     * @return mixed a permission id, or false on failure
     */
    public static function normalizeToID( $perm ) {
        if ( is_object( $perm ) && is_a( $perm, 'Permission' ) ) {
            return $perm->getId();
        }
        if ( is_string( $perm ) || is_int( $perm ) ) {
            $perm = new Permission( $perm );
            return $perm->getId();
        }
        return false;
    }

    /**
     * Normalizes a permission represented by its name, id, or object
     * and returns its name
     * @param mixed perm a permission represented by its name, id, or object
     * @return mixed a permission name, or false on failure
     */
    public static function normalizeToName( $perm ) {
        if ( is_object( $perm ) && is_a( $perm, 'Permission' ) ) {
            return $perm->getName();
        }
        if ( is_string( $perm ) || is_int( $perm ) ) {
            $perm = new Permission( $perm );
            return $perm->getName();
        }
        return false;
    }

    /**
     * Renames a permission in the database
     * @param newname string the new name of the permission
     * @return bool true on success, false on failure
     */
    public function rename( $newname ) {
        if ( ! isset( $this->id ) ) {
            return true;
        }
        return DBMaster::getInstance()
                    ->prepare( 'UPDATE permissions
                                SET permission_name = :newname
                                WHERE permission_id = :permid' )
                    ->execute( array( ':newname' => $newname, ':permid' => $this->id ) );
    }
}
