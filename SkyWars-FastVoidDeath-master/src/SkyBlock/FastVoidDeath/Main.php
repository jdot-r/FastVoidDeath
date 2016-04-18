<?php

//Origionally for SkyWars but you can use this for whatever

namespace SkyWars\FastVoidDeath;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\math\Vector3;
use pocketmine\level\sound\GhastShootSound;
use pocketmine\Player;
use pocketmine\Server;

class Main extends PluginBase implements Listener{
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
        $this->reloadConfig();
        $config = $this->getConfig();
        $this->startingHeight = $config->get("starting-height");
    }
    
    public function onVoidLoop(PlayerMoveEvent $event){
        if($event->getTo()->getFloorY() < $this->startingHeight){
            $event->setCancelled(true);
            $player = $event->getPlayer();
            $player->setHealth(0);
            $fizz = new GhastShootSound($player);
            $player->getLevel()->addSound($fizz);
        }
    }
}
            //$player->teleport($this->getServer()->getDefaultLevel()->getSpawn());
            //$player->sendMessage(TextFormat::AQUA . "You were saved from the deadly \"Void Loop\"");