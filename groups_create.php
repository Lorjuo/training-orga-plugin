<?php

function top_groups_create() {
    //insert
    $group = Group());

    if (isset($_POST['insert'])) {    
        $group::fill( $_POST );
        $message="Group inserted";
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/<?php echo PLUGIN_NAME; ?>/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Add New School</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <p>Three capital letters for the ID</p>
            <table class='wp-list-table widefat fixed'>
                <tr>
                    <th class="ss-th-width">ID</th>
                    <td><input type="text" name="id" value="<?php echo $group->id; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">School</th>
                    <td><input type="text" name="name" value="<?php echo $group->name; ?>" class="ss-field-width" /></td>
                </tr>
            </table>
            <input type='submit' name="insert" value='Save' class='button'>
        </form>
    </div>
    <?php
}

?>