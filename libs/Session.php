<?php

class Session{
    public static function init()
    {
        @session_start(); //starts a new session unless a session is already started (I think). //Whatever it does, it fixes the header.php error on line 14
    }
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    public static function get($key)
    {
        if(isset( $_SESSION[$key]))
        return $_SESSION[$key];
    }
    public static function destroy()
    {
        // unset($_SESSION); //He will leave this alone for now, but something like this should be done.
        session_destroy();
    }
} 