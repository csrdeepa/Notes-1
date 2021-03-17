<?php
class person{
    private $name;

    public function setname($name1){
        $this->name=$name1;
    }
    public function getname(){
        echo $this->name;
    }
}

$object=new person();
$object->setname("Deepa");
$object->getname();

?>

<?php
//Singleton example
class Database{
    public static $instance;

    public function __construct(){
        //private
    }

    public static function getinstance(){
        if(!isset(Database::$instance)){
            Databse::$instance=new Database();
        }
        return Database::$instance;
    }
    public function getquery(){
        return "select * from tbl";
    }
}

$db1=Database::getinstance();
$db2=Database::getinstance();
$db3=Database::getinstance();

var_dump($db1);
var_dump($db2);
var_dump($db3);

?>


<?php
//https://carlalexander.ca/designing-class-wordpress-hooks/

// 1. separate method
class MyPlugin
{
    public function __construct()
    {
        $this->init();
    }
 
    public function init()
    {
        add_action('wp_loaded', array($this, 'on_loaded'));
    }
 
    public function on_loaded()
    {        /* ... */    }
}
class MyPlugin
{
    public function init()
    {
        add_action('wp_loaded', array($this, 'on_loaded'));
    }
 
    public function on_loaded()
    {        /* ... */    }
}
 
$my_plugin = new MyPlugin();
$my_plugin->init();

/////***********/////
// 2.custom constructor

class MyPlugin
{
    public static function init()
    {
        $self = new self();
        add_action('wp_loaded', array($self, 'on_loaded'));
    }
 
    public function on_loaded()
    {        /* ... */   }
}
 
MyPlugin::init();

class MyPlugin
{
    public static function init()
    {
        $self = new self();
        add_action('wp_loaded', array($self, 'on_loaded'));
    }
 
    public function on_loaded()
    {        /* ... */   }
}
 
add_action('plugins_loaded', array('MyPlugin', 'init'));

//3. external function

class MyPlugin
{
    public function on_loaded()
    {        /* ... */   }
}
 
function load_my_plugin()
{
    $my_plugin = new MyPlugin();
    add_action('wp_loaded', array($my_plugin, 'on_loaded'));
}
add_action('plugins_loaded', 'load_my_plugin');

class MyPlugin
{
    public function on_loaded()
    {        /* ... */   }
}
 
$my_plugin = new MyPlugin();
add_action('wp_loaded', array($my_plugin, 'on_loaded'));


?>

<?php

//Factory Design
//Strategy Design
//Adapter Design
//Facade Design
//Decorator Design
//Command Design
//Observer Design

?>

<?php
//https://code.tutsplus.com/articles/design-patterns-in-wordpress-the-singleton-pattern--wp-31621
//You don’t have to declare the constructor public, just the action hook function.
/*
Plugin Name: Singleton Action
*/

class Singleton_Demo
{
    /**
     * @static $instance Objekt
     * @access private;
     */
    private static $_instance   = NULL;

    protected function __construct() {}
    private final function __clone() {}

    public static function getInstance()
    {
        if ( self::$_instance === NULL )
        {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    public function hook_test()
    {
        print '<p>Works!</p>';
    }
}

add_action( 'wp_footer', array ( Singleton_Demo::getInstance(), 'hook_test' ) );

?>

<?php
class Foo {
 
    /*--------------------------------------------*
     * Attributes
     *--------------------------------------------*/
 
    /** Refers to a single instance of this class. */
    private static $instance = null;
 
    /*--------------------------------------------*
     * Constructor
     *--------------------------------------------*/
 
    /**
     * Creates or returns an instance of this class.
     *
     * @return  Foo A single instance of this class.
     */
    public static function get_instance() {
 
        if ( null == self::$instance ) {
            self::$instance = new self;
            //Foo::$instance=new Foo();
        }
 
        return self::$instance;
 
    } // end get_instance;
 
    /**
     * Initializes the plugin by setting localization, filters, and administration functions.
     */
    private function __construct() {
 
    } // end constructor
 
    /*--------------------------------------------*
     * Functions
     *--------------------------------------------*/
    
    public function bar(){

    }
} // end class
 
//********** Foo::get_instance();
$foo = Foo::get_instance();
$foo->bar();

/********************************************************************/
//https://code.tutsplus.com/articles/design-patterns-in-wordpress-the-simple-factory-pattern--wp-31652

//The Simple Factory Pattern

