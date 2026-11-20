<?php

// Prepare writable SQLite database in /tmp for Vercel Serverless environment
$targetDb = '/tmp/database.sqlite';
$sourceDb = __DIR__ . '/../database/database.sqlite';

if (!file_exists($targetDb) && file_exists($sourceDb)) {
    copy($sourceDb, $targetDb);
}

// Forward Vercel requests to normal Laravel public/index.php
require __DIR__ . '/../public/index.php';
