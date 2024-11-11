<?php

if (!defined('IN_APP')) {
    header("HTTP/1.0 404 Not Found");
    header("Location: /404.php");
    exit();
}

require_once __DIR__ . '/../globals.php';
require_once __DIR__ . '/../vendor/autoload.php';

// ---------------------------------

function BackupDB(): bool {
    try {
        $db = new SQLite3($GLOBALS['DatabaseName'], SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
        
        // clone the Data.db data to Backups/db/BackupDatabaseName.db
        $status = $db->backup($db, __DIR__ . "/../Backups/db" . $GLOBALS['BackupDatabaseName']); // returned bool

        if ($status) {
            error_log('Database was backed up successfully', 0);
        } else {
            error_log('Error backing up Database. Please correct any issues.', 0);
        }

        return $status; // since status returns a bool its self it would make sense to do this instead of manually handling it our selfs

    } catch (Exception $e) {
        
        return false;
    }

}

function DeleteRow(int $id, string $table, string $idName): bool
{
    try {
        $db = new SQLite3($GLOBALS['DatabaseName'], SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);

        $query = "DELETE FROM $table WHERE $idName = :id"; // find the row of data we want to delete and then delete it

        $stmt = $db->prepare($query);

        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

        $result = $stmt->execute();

        $row = $result->fetchArray(SQLITE3_ASSOC);

    if ($row) {
        return true;
    } else {
        return false;
    }

    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage() . "\nTrace: " . $e->getTraceAsString(), 0);
        return false; 
    }

}

function Resolve(string $key): array | string // may return an array or a string depending on the outcome/result 
{
    try {
        $db = new SQLite3($GLOBALS['DatabaseName'], SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);

        $query = "SELECT * FROM ShortStorage WHERE URLKey = :key"; // get all data related to that key for later processing

        $stmt = $db->prepare($query);

        $stmt->bindValue(':key', $key, SQLITE3_TEXT);

        $result = $stmt->execute();

        $row = $result->fetchArray(SQLITE3_ASSOC);

        // if the row data isnt null and actually has data then return it
        if ($row && !is_null($row)) {
            return json_encode($row); // encode it so we can decode and index array correctly
        } else {
            return "Error"; // we return this as the error code
        }
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage() . "\nTrace: " . $e->getTraceAsString(), 0);
        return "Error"; // returns "Error" which will be used to check if it had errored which is going to be used for handling
    }
}

function InsertNewKey(string $url): string
{
    // Establish SQLite3 database connection
    $db = new SQLite3($GLOBALS['DatabaseName'], SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);

    // Check if the URL already exists in the database
    $query = "SELECT URLKey FROM ShortStorage WHERE ResolvedURL = :resolvedURL LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':resolvedURL', $url, SQLITE3_TEXT);

    try {
        $result = $stmt->execute();

        // so since we do not want to bloat our database with dupe data we check if it already exists and return pre-existing data
        if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            return $row['URLKey'];
        }

        $urlKey = generateUniqueKey(); // Generate a new unique URL key

        $query = "INSERT INTO ShortStorage (ResolvedURL, URLKey) VALUES (:resolvedURL, :urlKey)";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':resolvedURL', $url, SQLITE3_TEXT);
        $stmt->bindValue(':urlKey', $urlKey, SQLITE3_TEXT);

        $stmt->execute();

        return $urlKey;
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage() . "\nTrace: " . $e->getTraceAsString(), 1);
        return "Error";
    }
}

function generateUniqueKey(): string
{
    // We will use the generated string to act as our key!
    return bin2hex(random_bytes(6)); // (12 hex chars = 6 bytes)
}
