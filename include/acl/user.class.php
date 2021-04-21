<?php

/**
 * A bogus class representing a user.
 * All methods listed here pertain to and only to the access control system
 */
class User {
    public $id;
    public $nombre;
    public $apellido_1;
    public $apellido_2;
    public $email;
    public $tipo_usuario;
    protected $dba;
    protected $md;
    public $users_table;
    public $userid_field;
    public $useremail_field;
    public $field_name;

    /**
     * An id => name array of permissions currently granted to the user
     */
    public $permissions;

    public function __construct( $user ) {

        // Editable values. Make this values match with the ones of users table.
        $this->user_table = 'usuarios';
        $this->userid_field = 'id_usuario';
        $this->usersname_field = 'nombre';
        $this->usersurname_field = 'apellido_1';
        $this->usersurname2_field = 'apellido_2';
        $this->useremail_field = 'email';
        // End of editable values

        $config = [
          'driver'	    => 'mysql',
          'host'		    => _HOST,
          'database'	  => _DB,
          'username'	  => _USER,
          'password'	  => _PASS,
          'charset'	    => 'utf8',
          'collation'	  => 'utf8_general_ci',
          'prefix'	    => ''
        ];
        $this->dbx = new \Buki\Pdox($config);

        if ( ( is_int( $user ) || ctype_digit( $user ) ) && $user > 0 ) {
            if ( $userinfo = $this->dbx
                                  ->query( "SELECT * FROM " . $this->user_table. " WHERE " . $this->userid_field . " = $user")
                                  ->fetch('array') ) {
                $this->id = $user;
                $this->nombre = $userinfo[$this->usersname_field];
                $this->apellido_1 = $userinfo[$this->usersurname_field];
                $this->apellido_2 = $userinfo[$this->usersurname2_field];
                $this->email = $userinfo[$this->useremail_field];
                $this->tipo_usuario = $userinfo['id_tipo_usuario'];
                $this->_userinfo = $userinfo;
            }
            else return;
        }
        else return;
    }

    /**
     * returns true if the user represented by the object can do the action(s)
     * given as a param.
     * @param permission mixed a string holding a single permission name, or
            an array of strings, each holding a permission name
     * @param and_or bool if true all permissions must be granted to the user
            if false, any of them is sufficient
     * @return boolean true if the user can, false if he can't
     */
    public function can( $permission, $and_or = true ) {
        /*
          if an empty string or array is given, it may well be that an
          abstraction method was used to check for permission, and we're in the
          case where no permission is required to perform the subsequent action
          */
        if ( empty( $permission ) ) {
            return true;
        }

        /* if $this->permissions isn't set, this method has not been called yet
          for that script */
        if ( empty( $this->permissions ) ) {
            $this->fetchPerms();
        }

        /*
          If a single permission is requested, as a string, just check whether
          or not it's a key of the User::permissions array
          All keys in User::permissions have been granted to the user, and have
          1 as an attached value
          All ungranted permissions do not appear as keys of User::permissions
          */
        if ( is_string( $permission ) ) {
            return in_array( $permission, $this->permissions );
        }

        /*
          If not, we'll have to check for all of them, and AND/OR them,
          depending on the value of the second parameter.
          First, we'll need an array with requested permissions as keys, and 0s
          as values, in which we will set 1s for every granted permission
          Easy way to do so is to use array_intersect_key, getting the value of
          each key of User::$permissions that is present in $permission, then
          simply adding an array_fill_keys version of $permission
          */

        $checked_permissions = array_intersect_key(
                                    array_fill_keys( $this->permissions, 1 ),
                                    array_fill_keys( $permission, 1 )
                        ) + array_fill_keys( $permission, 0 );

        /*
          Now we will need array_sum if any of the requested permissions is
          sufficient (giving a non-null sum if one of them at least is granted)
          or array_product if all of them are needed (giving a null product if
          one of them at least is null)
          */
          // var_dump($permission); exit;
          // var_dump($and_or ? (bool) array_product( $checked_permissions ) : (bool) array_sum( $checked_permissions )); exit;
        return $and_or ? (bool) array_product( $checked_permissions ) : (bool) array_sum( $checked_permissions );
    }

    /**
     * Fetch permissions for this user from the database, and set the
     * User::$permissions property, to allow caching.
     * User::$permissions will be an array with permission names as keys.
     * @return bool true on success, false on failure
     */
    public function fetchPerms() {
        $this->permissions = $this->dbx->pdo
                        ->query( "SELECT users_permissions.permission_id, permissions.permission_name
                                    FROM permissions, users_permissions
                                    WHERE users_permissions.user_id = {$this->id}
                                        AND users_permissions.permission_id = permissions.permission_id" )
                        ->fetchAll( PDO::FETCH_COLUMN | PDO::FETCH_GROUP | PDO::FETCH_UNIQUE );
        return is_array( $this->permissions );
    }

    /**
     * Essentially a god mode, gives all currently extant permissions to the
     * current user.
     * @return bool true on success, false on failure
     */
    public function grantAllPerms() {
        $allPerms = $this->dba->pdo
                        ->query( 'SELECT permission_id FROM permissions' )->fetchAll(PDO::FETCH_COLUMN, 0)->fetchAll( );
        $grantPerm = $this->dba->dbo
                        ->prepare( 'INSERT INTO users_permissions (user_id, permission_id)
                                    VALUES (:userid, :permid )
                                    ON DUPLICATE KEY UPDATE permission_id = permission_id');
        $grantPerm->bindParam( ':userid', $this->id );
        $grantPerm->bindParam( ':permid', $perm );
        foreach ( $allPerms as $perm ) {
            if ( ! $grantPerm->execute() ) {
                return false;
            }
        }
        $this->fetchPerms();
        return true;
    }

    /**
     * Grants the current user with a given permission
     * @param perm mixed a permission represented by name, id, or object
     * @return mixed true on success, false on failure
     */
    public function grantPerm( $perm ) {
        if ( ! $perm = Permission::normalizeToID( $perm ) ) {
            return false;
        }
        return $this->dba->pdo
                        ->prepare( 'INSERT INTO users_permissions (user_id, permission_id)
                                    VALUES (:userid, :permid)' )
                        ->execute( array( ':userid' => $this->id, ':permid' => $perm ) );
    }

    /**
     * Lists permissions granted to the current user
     * @refresh bool true to refresh the permission cache for this user
     * @return array an id=>name array of all permissions of the current user
     */
    public function listPerms( $refresh = false ) {
        if ( empty( $this->permissions ) || $refresh ) {
            $this->fetchPerms();
        }
        return $this->permissions;
    }

    /**
     * Sets multiple permissions for the current user.
     * Can effectively grant or ungrant permissions, but is more efficient
     * when setting multiple permissions than User::grantPerm() and
     * User::ungrantPerm()
     * @param perms array an array of permissions names, ids, or objects
     * @return bool true on success, false on failure
     */
    public function setPerms ( $setperms = null ) {
        if ( ! is_array( $setperms ) ) {
            return false;
        }
        if ( empty( $setperms ) ) {
            return $this->ungrantAllPerms();
        }
        $this->fetchPerms();
        $setperms = array_filter( array_map( array( 'Permission', 'normalizeToID' ), $setperms ) );
        $allperms = array_keys( PermissionsList::listAllPerms() );
        $adduserperm = array();
        $deluserperm = array();
        foreach ( $allperms as $perm ) {
            if ( ! in_array( $perm, array_keys( $this->permissions ) ) && in_array( $perm, $setperms ) ) {
                $adduserperm[] = $perm;
            }
        }
        foreach ( array_keys( $this->permissions ) as $perm ) {
            if ( ! in_array( $perm, $setperms ) ) {
                $deluserperm[] = $perm;
            }
        }
        if ( ! empty( $adduserperm ) ) {
            $permaddstmt = $this->dba->pdo
                            ->prepare( 'INSERT INTO users_permissions
                                        VALUES ( :userid, :permid )' );
            $permaddstmt->bindParam( ':userid', $this->id );
            $permaddstmt->bindParam( ':permid', $addperm );
            foreach ( $adduserperm as $addperm ) {
                $permaddstmt->execute();
            }
        }
        if ( ! empty( $deluserperm ) ) {
            $permdelstmt = $this->dba->pdo
                            ->prepare( 'DELETE FROM users_permissions
                                        WHERE user_id = :userid
                                            AND permission_id = :permid' );
            $permdelstmt->bindParam( ':userid', $this->id );
            $permdelstmt->bindParam( ':permid', $delperm );
            foreach ( $deluserperm as $delperm ) {
                $permdelstmt->execute();
            }
        }
        $this->fetchPerms();
    }

    /**
     * Essentially a ban, removes all permissions the current user is currently
     * granted with
     * @return bool true on success, false on failure
     */
    public function ungrantAllPerms() {
        $this->permissions = array();
        return $this->dba->pdo
                    ->prepare( 'DELETE FROM users_permissions
                                WHERE user_id = :userid' )
                    ->execute( array( ':userid' => $this->id ) );
    }

    /**
     * Ungrants the current user a given permission
     * @param perm mixed a permission represented by name, id, or object
     * @return mixed true on success, false on failure
     */
    public function ungrantPerm( $perm ) {
        if ( ! $perm = Permission::normalizeToID( $perm ) ) {
            return false;
        }
        return $this->dba->pdo
                        ->prepare( 'DELETE FROM users_permissions
                                    WHERE user_id = :userid
                                        AND permission_id = :permid' )
                        ->execute( array( ':userid' => $this->id, ':permid' => $perm ) );
    }
    public function getUserInfo() {
      return $this->_userinfo;
    }
}
