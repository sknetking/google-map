<?php

class Google_Map_Settings {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_custom_tools_submenu_page'));
        add_filter("plugin_action_links", array($this, 'add_settings_link'));
    }

    // Add the top-level menu item to the Tools submenu
    public function add_custom_tools_submenu_page() {
        add_submenu_page(
            'tools.php',               // Parent menu slug (Tools)
            'Custom Tools Page',       // Page title
            'Custom Tools',            // Menu title
            'manage_options',          // Capability required to access the page
            'custom-tools-page',       // Menu slug
            array($this, 'render_custom_tools_page') // Callback function to render the page
        );
    }

    // Callback function to render the custom tools page
    public function render_custom_tools_page() {
       ?>
    <div class="wrap">
        <h1>Map Settings</h1>
        <p>Welcome to the Advance Google Map!</p>
       <form method="post" >
        <label for="api_key">Set Your API Key - <input type="text" name="api_key" value="<?php echo get_option("api_key");?>"></label> <input type="submit" name="set_api" value="Submit" class="btn button submit">
        </form>
        <hr style="margin:30px;">
        <h3>Our Other JS Tools and Tutorials</h3>
        <iframe src="https://sknetking9.blogspot.com/p/tools-by-sk-netking.html" frameborder="0" style="height: 500px;width: 83vw;"></iframe>
    </div>

        <?php
        //submit value database 
        if(isset($_POST["set_api"])){
            update_option("api_key",$_POST['api_key']);
        }
    }

    // Add the settings link near the plugin's active button
    function add_settings_link($links) {
       
        $settings_link = '<a href="' . esc_url(admin_url('admin.php?page=custom-tools-page')) . '">Settings</a>';
            array_push($links, $settings_link);
           return $links;
    }
    
    
    
}

// Initialize the Google_Map_Settings class
new Google_Map_Settings();
