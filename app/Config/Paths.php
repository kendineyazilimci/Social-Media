<?php

namespace Config;

/**
 * Paths
 *
 * Holds the paths that are used by the system to
 * locate the main directories: app, system, writable, etc.
 *
 * Modifying these allows you to restructure your application,
 * share a system folder between multiple applications, and more.
 *
 * All paths are relative to the project's root folder.
 */
class Paths
{
    /**
     * ---------------------------------------------------------------
     * SYSTEM FOLDER NAME
     * ---------------------------------------------------------------
     *
     * This must contain the name of your "system" folder. Include
     * the path if the folder is not in the same directory as this file.
     */
    public string $systemDirectory = __DIR__ . '/../../vendor/codeigniter4/framework/system';

    /**
     * ---------------------------------------------------------------
     * APPLICATION FOLDER NAME
     * ---------------------------------------------------------------
     *
     * If you want this front controller to use a different "app"
     * folder than the default one you can set its name here. The folder
     * can also be renamed or relocated anywhere on your server. If
     * you do, use a full server path.
     */
    public string $appDirectory = __DIR__ . '/..'; // Adjust this if your app directory is different

    /**
     * ---------------------------------------------------------------
     * WRITABLE DIRECTORY NAME
     * ---------------------------------------------------------------
     *
     * This variable must contain the name of your "writable" directory.
     * The writable directory allows you to group all directories that
     * need write permission to a single place that can be tucked away
     * for maximum security.
     */
    public string $writableDirectory = __DIR__ . '/../../writable'; // Make sure this directory exists

    /**
     * ---------------------------------------------------------------
     * TESTS DIRECTORY NAME
     * ---------------------------------------------------------------
     *
     * This variable must contain the name of your "tests" directory.
     */
    public string $testsDirectory = __DIR__ . '/../../tests'; // Ensure this directory is present if using tests

    /**
     * ---------------------------------------------------------------
     * VIEW DIRECTORY NAME
     * ---------------------------------------------------------------
     *
     * This variable must contain the name of the directory that
     * contains the view files used by your application.
     */
    public string $viewDirectory = __DIR__ . '/../Views'; // Adjust this if your views directory is different
}