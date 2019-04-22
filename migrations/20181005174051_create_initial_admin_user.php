<?php
use Phinx\Migration\AbstractMigration;

class CreateInitialAdminUser extends AbstractMigration
{
    public function change()
    {
        $adminUsername = getenv("ADMIN_USERNAME");
        $adminEmail = getenv("ADMIN_EMAIL");
        $adminPassword = getenv("ADMIN_PASSWORD");

        $user = [
            "username" => $adminUsername,
            "email" => $adminEmail,
            "password" => password_hash($adminPassword, PASSWORD_BCRYPT),
            "is_expired" => 0,
            "is_deleted" => 0
        ];

        $table = $this->table("admin_users");
        $table->insert($user);
        $table->saveData();
    }
}
