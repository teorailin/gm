<?php

namespace teorailin\gm;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\Plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

use pocketmine\utils\TextFormat;

use pocketmine\item\Item;

use pocketmine\utils\TextFormat as TE;

class Main extends PluginBase implements Listener {
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
		
		switch($cmd->getName()){
			case "gm":
			   if($sender instanceof Player){
				   if($sender->hasPermission("gm.command")){
					   $this->GForm($sender); 
				   }
			   }
			break;
		}
		
		return true;
		
	}		

		
		public function GForm($player){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, int $data = null){
            $result = $data;
		    if($result === null){
                return true;
            }             
            switch($result){
			case 0:
			$this->getServer()->dispatchCommand($player, "gamemode c");
			$player->sendMessage("§o§6Cambiaste tu modo de juego a creativo");
			break;
			case 1:
            $this->getServer()->dispatchCommand($player, "gamemode s");
			$player->sendMessage("§o§6Cambiaste tu modo de juego a supervivencia");
			break;
			case 2:
			$this->getServer()->dispatchCommand($player, "gamemode 3");
			$player->sendMessage("§o§6Cambiaste tu modo de juego a espectador");
			break;
            }
        });
		$form->setTitle("§l§bModos de juego");
        $form->setContent("§cSelecciona un modo de juego");
		$form->addButton("§e§lCreativo");
		$form->addButton("§b§lSupervivencia");
		$form->addButton("§d§lEspectador");
		$form->sendToPlayer($player);
        return $form;
		}
	}
				