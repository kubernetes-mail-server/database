<?php
use Phinx\Migration\AbstractMigration;

class SimplifyAliases extends AbstractMigration
{
	public function change()
	{
		$table = $this->table("virtual_aliases");
		$table
			->dropForeignKey("user_id")
			->removeColumn("user_id")
			->changeColumn("email", "string", ["limit" => 255, "null" => false])
			->renameColumn("email", "src_email")
			->addColumn("dst_email", "string", ["limit" => 255, "null" => false])
			->save();
	}
}