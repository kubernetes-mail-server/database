<?php
use Phinx\Migration\AbstractMigration;

class SimplifyAliases extends AbstractMigration
{
	public function change()
	{
		$table = $this->table("virtual_aliases");

        $table->addColumn("dst_email", "string", ["limit" => 255, "null" => false])->save();

		$table->dropForeignKey("user_id")->save();
		$table->removeColumn("user_id")->save();

		$table->renameColumn("email", "src_email")->save();
		$table->changeColumn("src_email", "string", ["limit" => 255, "null" => false])->save();
	}
}