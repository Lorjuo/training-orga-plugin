<?php
  global $wpdb;

  class Group {
    public $id = -1;
    public $name = '';
    public $department_id = -1;
    public $age_begin = -1;
    public $age_end = -1;
    public $ancient = false;

    $table_name

    function __construct()
    {
      $table_name = $wpdb->prefix . GROUPS_TABLE;
    }

    public static function with_id( $id ) {
      $instance = new self();
      $instance->load_by_id( $id );
      return $instance;
    }

    public static function with_hash( $hash ) {
      $instance = new self();
      $instance->fill( $hash );
      return $instance;
    }

    function db_insert()
    {

      $wpdb->insert(
        $table_name, //table
        array('name' => $name,
              'department_id' => $department_id,
              'age_begin', => $age_begin,
              'age_end', => $age_end,
              'ancient', => $ancient,
              ), //data
        array('%s', '%s', '%i', '%i', '%i', '%i') //data format
        );
      $message="Group inserted";
    }

    function db_update()
    {
      $wpdb->update(
              $table_name, //table
              array('name' => $name,
                    'department_id' => $department_id,
                    'age_begin', => $age_begin,
                    'age_end', => $age_end,
                    'ancient', => $ancient,), //data
              array('ID' => $id), //where
              array('%s', '%s', '%i', '%i', '%i', '%i'), //data format
              array('%s') //where format
      );
    }

    function db_delete()
    {
      $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %s", $id));
    }

    // Protected functions
    protected function load_by_id( $id ) {
      // do query
      $row = $wpdb->get_row($wpdb->prepare("SELECT * from $table_name where id=%s", $id));
      $this->fill( $row );
    }

    protected function fill( array $row ) {
      $this->id            = $row[id];
      $this->name          = $row[name];
      $this->department_id = $row[department_id];
      $this->age_begin     = $row[age_begin];
      $this->age_end       = $row[age_end];
      $this->ancient       = $row[ancient];
    }
  }
?>
