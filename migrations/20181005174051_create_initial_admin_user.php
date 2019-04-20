<?php
use Phinx\Migration\AbstractMigration;

class CreateInitialAdminUser extends AbstractMigration
{
    public function change()
    {
        $user = [
            "username" => "admin",
            "email" => "postmaster@beersandbusiness.com",
            "password" => password_hash("admin123", PASSWORD_BCRYPT),
            "is_expired" => 0,
            "is_deleted" => 0
        ];

        $table = $this->table("admin_users");
        $table->insert($user);
        $table->saveData();
    }
}
