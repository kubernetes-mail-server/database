<?php
use Phinx\Migration\AbstractMigration;

class MysqlUsers extends AbstractMigration
{
    public function up()
    {
        $readUsername = getenv("MYSQL_READ_USERNAME");
        $readPassword = getenv("MYSQL_READ_PASSWORD");

        $writeUsername = getenv("MYSQL_WRITE_USERNAME");
        $writePassword = getenv("MYSQL_WRITE_PASSWORD");

        $database = getenv("PHINX_DATABASE");

        $this->execute("CREATE USER IF NOT EXISTS '$readUsername'@'%' IDENTIFIED BY '$readPassword'}");
        $this->execute("GRANT SELECT ON $database.* TO '$readUsername'@'%");

        $this->execute("CREATE USER IF NOT EXISTS '$writeUsername'@'%' IDENTIFIED BY '$writePassword'}");
        $this->execute("GRANT SELECT ON $database.* TO '$writeUsername'@'%");
    }

    public function down()
    {
        /* You can't go back */
    }
}
