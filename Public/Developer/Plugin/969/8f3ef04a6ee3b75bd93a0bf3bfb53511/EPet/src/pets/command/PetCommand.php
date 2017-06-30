<?php

namespace pets\command;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pets\main;
use pocketmine\utils\TextFormat;

class PetCommand extends PluginCommand {

	public function __construct(main $main, $name) {
		parent::__construct(
				$name, $main
		);
		$this->main = $main;
		$this->setPermission("epet.command");
		$this->setAliases(array("epet"));
	}

	public function execute(CommandSender $sender, $currentAlias, array $args) {
		  
                         if (!isset($args[0])) {
                          if($sender->hasPermission('epet.command')){
			$this->main->togglePet($sender);
                         return true;
                          }else{
                           $sender->sendMessage(TextFormat::RED."You do not have permission to use this command");
			
                    return true;
                }
                         }
		 if($args[0] == "help"){
				if($sender->hasPermission('epet.command.help')){
				$sender->sendMessage("§e======EPetHelp======");
				$sender->sendMessage("§b用/epet召唤宠物");
				$sender->sendMessage("§b/pets type 种类");
				$sender->sendMessage("§b种类: blaze(烈焰人), pig(猪), chicken(鸡), wolf(狼), rabbit(末影龙), magma(岩浆史莱姆), bat(蝙蝠), silverfish(蠢虫), spider(蜘蛛), cow(牛), creeper(苦力怕), irongolem(铁傀儡), husk(凋零), enderman(末影人), sheep(羊), witch(巫婆), block(南瓜灯)");
                                return true;
				}else{$sender->sendMessage(TextFormat::RED."You do not have permission to use this command");
					    }
				return true;
                 }
               if($args[0] == "name"){
               	 if($sender->hasPermission("epet.command.name")){
               	 if (isset($args[1])){
               	  $petname = $args[1];
               	  $pet = $this->main->getPet($sender->getName());
               	  $pet->setNameTag($petname);
               	  $sender->sendMessage(TextFormat::BLUE."§a你的宠物名字变成了".$petname."");
               	 }
               	 }else{
               	 	$sender->sendMessage(TextFormat::RED."You do not have permission to use this command");
               	 }
               }
               	
			if($args[0] == "type"){
				if (isset($args[1])){
					if($args[1] == "wolf"){
							if ($sender->hasPermission("pets.type.wolf")){
								$this->main->changePet($sender, "WolfPet");
								$sender->sendMessage("§7§l你召唤了一只狼");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for dog pet!");
								return true;
							}
                                        }
						if($args[1] == "chicken"){
							if ($sender->hasPermission("pets.type.chicken")){
								$this->main->changePet($sender, "ChickenPet");
								$sender->sendMessage("§3§l你召唤了一只鸡");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for chicken pet!");
								return true;
							}
                                                }
						if($args[1] == "pig"){
							if ($sender->hasPermission("pets.type.pig")){
								$this->main->changePet($sender, "PigPet");
								$sender->sendMessage("§e§l你召唤了一只猪");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for pig pet!");
								return true;
							}
                                                }
						if($args[1] == "blaze"){
							if ($sender->hasPermission("pets.type.blaze")){
								$this->main->changePet($sender, "BlazePet");
								$sender->sendMessage("Your pet has changed to Blaze!");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for blaze pet!");
								return true;
							}
                                                }
						if($args[1] == "magma"){
							if ($sender->hasPermission("pets.type.magma")){
								$this->main->changePet($sender, "MagmaPet");
								$sender->sendMessage("Your pet has changed to Magma!");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for blaze pet!");
								return true;
							}
                                                }
						if($args[1] == "rabbit"){
							if ($sender->hasPermission("pets.type.rabbit")){
								$this->main->changePet($sender, "RabbitPet");
								$sender->sendMessage("§f§l你召唤了一只凋零");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for rabbit pet!");
								return true;
							}
                                                }
						if($args[1] == "bat"){
							if ($sender->hasPermission("pets.type.bat")){
								$this->main->changePet($sender, "BatPet");
								$sender->sendMessage("§b§l你召唤了一只北极熊");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for bat pet!");
								return true;
							}
                                                }
						if($args[1] == "silverfish"){
							if ($sender->hasPermission("pets.type.silverfish")){
								$this->main->changePet($sender, "SilverfishPet");
								$sender->sendMessage("§f§l你召唤了一只蠢虫");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for Silverfish pet!");
								return true;
							}
						
							}
								if($args[1] == "spider"){
							if ($sender->hasPermission("pets.type.spider")){
								$this->main->changePet($sender, "SpiderPet");
								$sender->sendMessage("§c§l你召唤了一只蜘蛛");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for spider pet!");
								return true;
							}
                                                }
                                		if($args[1] == "cow"){
							if ($sender->hasPermission("pets.type.cow")){
								$this->main->changePet($sender, "CowPet");
								$sender->sendMessage("§9§l你召唤了一只牛");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for cow pet!");
								return true;
							}
                                                }
						if($args[1] == "creeper"){
							if ($sender->hasPermission("pets.type.creeper")){
								$this->main->changePet($sender, "CreeperPet");
								$sender->sendMessage("§a§l你召唤了一只苦力怕");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for creeper pet!");
								return true;
							}
                                                }
					                 if($args[1] == "irongolem"){
							if ($sender->hasPermission("pets.type.irongolem")){
								$this->main->changePet($sender, "IronGolemPet");
								$sender->sendMessage("§7§l你召唤了一只铁傀儡");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for Iron Golem pet!");
								return true;
							}
                                                }
			                    if($args[1] == "husk"){
							if ($sender->hasPermission("pets.type.husk")){
								$this->main->changePet($sender, "HuskPet");
								$sender->sendMessage("§a§l你召唤了一只末影龙");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for Husk pet!");
								return true;
							}
                                                }
                                           if($args[1] == "enderman"){
							if ($sender->hasPermission("pets.type.enderman")){
								$this->main->changePet($sender, "EndermanPet");
								$sender->sendMessage("§d§l你召唤了一只末影人");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for Enderman pet!");
								return true;
							}
                                                }
                                                 if($args[1] == "sheep"){
							if ($sender->hasPermission("pets.type.sheep")){
								$this->main->changePet($sender, "SheepPet");
								$sender->sendMessage("§f§l你召唤了一只一只羊");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for Sheep pet!");
								return true;
							}
                                                }
                                                 if($args[1] == "witch"){
							if ($sender->hasPermission("pets.type.witch")){
								$this->main->changePet($sender, "WitchPet");
								$sender->sendMessage("§5§l你召唤了一个女巫");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for Witch pet!");
								return true;
							}
                                                }
                                                if($args[1] == "block"){
							if ($sender->hasPermission("pets.type.block")){
								$this->main->changePet($sender, "BlockPet");
								$sender->sendMessage("§6§l你召唤了一个方块");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for Block pet!");
								return true;
							}
                                                }
	}
                                                
                                                
                        }                            
        }
}
                        

                         
        
