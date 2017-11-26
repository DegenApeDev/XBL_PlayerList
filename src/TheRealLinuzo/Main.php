<?php
namespace TheRealLinuzo;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\scheduler\PluginTask;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\network\mcpe\protocol\PlayerListPacket;
use pocketmine\network\mcpe\protocol\types\PlayerListEntry;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener {

const VERSION = "1.0";

   public function onLoad() {
     $this->getLogger()->info(TF::YELLOW . "Loading XBL_PlayerList" . Main::VERSION . "By TheRealLinuzo");
   }
   public function onEnable() {
     $this->getServer()->getPluginManager()->registerEvents($this, $this);
     $this->getLogger()->info(TF::GREEN . "XBL_PlayerList is now ENABLED!");
   }
   public function onJoin(PlayerJoinEvent $event) {
       $player = $event->getPlayer();
       $pk = new PlayerListPacket();
       $pk->type = PlayerListPacket::TYPE_ADD;
       $pk->entries[] = PlayerListEntry::createAdditionEntry($player->getUniqueId(), $player->getId(), $player->getName(),$player->getSkin(), $player->getXuid());
           foreach($this->getServer()->getOnlinePlayers() as $players){
             $players->dataPacket($pk);
         }
       }
     }
