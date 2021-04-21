<?php
function dir_tree($dir_path) {
    $rdi = new \RecursiveDirectoryIterator($dir_path);
    $rii = new \RecursiveIteratorIterator($rdi);
    $tree = [];
    foreach ($rii as $splFileInfo) {
        $file_name = $splFileInfo->getFilename();
        // Skip hidden files and directories.
        if ($file_name[0] === '.') {
            continue;
        }
        $path = $splFileInfo->isDir() ? array($file_name => array()) : array($file_name);
        for ($depth = $rii->getDepth() - 1; $depth >= 0; $depth--) {
            $path = array($rii->getSubIterator($depth)->current()->getFilename() => $path);
        }
        $tree = array_merge_recursive($tree, $path);
    }
    return $tree;
}

//  Another
//
 function recursive_read($directory, $entries_array = array()) {
    if(is_dir($directory)) {
        $handle = opendir($directory);
        while(FALSE !== ($entry = readdir($handle))) {
            if($entry == '.' || $entry == '..') {
                continue;
            }
            $Entry = $directory . DS . $entry;
            if(is_dir($Entry)) {
                $entries_array = recursive_read($Entry, $entries_array);
            } else {
                $entries_array[] = $Entry;
            }
        }
        closedir($handle);
    }
    return $entries_array;
}