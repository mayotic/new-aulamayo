<?php
class PermissionsList {
    protected static $allPerms;

    private function __construct() { }

    /**
     * Returns a list of all permissions currently in the permissions
     * table
     * @param refresh bool whether or not to refresh the list of permissions.
     * @return array an array, each element of which represents a single
     *     permission with its id as key and name as value
     */
    public static function listAllPerms( $refresh = false ) {
        if ( ! isset( self::$allPerms ) || $refresh ) {
            self::$allPerms = DBSlave::getInstance()
                        ->query( 'SELECT permission_id, permission_name
                                  FROM permissions')
                        ->fetchAll( PDO::FETCH_COLUMN | PDO::FETCH_GROUP | PDO::FETCH_UNIQUE );
        }
        return self::$allPerms;
    }
}
