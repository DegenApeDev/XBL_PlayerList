<?php
namespace TheRealLinuzo;
use pocketmine\Server;
use pocketmine\scheduler\PluginTask;
use pocketmine\network\mcpe\protocol\PlayerListPacket;
use pocketmine\network\mcpe\protocol\types\PlayerListEntry;
use pocketmine\Player;
use TheRealLinuzo\Main;
class Task extends PluginTask{
		 private $plugin;
     private $player;
	public function __construct(Main $plugin, Player $player){
		parent::__construct($plugin, $player);

		$this->plugin = $plugin;
		$this->player = $player;

	}
  public function onRun(int $ct){
    $pk = new PlayerListPacket();
    $pk->type = PlayerListPacket::TYPE_ADD;
    $pk->entries[] = PlayerListEntry::createAdditionEntry($this->player->getUniqueId(), $this->player->getId(), $this->player->getName(),$this->player->getSkin(), $this->player->getXuid());
        foreach($this->plugin->getServer()->getOnlinePlayers() as $players){
          $players->dataPacket($pk);
    }
  }
}
