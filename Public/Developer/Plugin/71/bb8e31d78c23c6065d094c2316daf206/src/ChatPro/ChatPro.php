<?php
namespace ChatPro;

use pocketmine\plugin\Plugin;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\level\Level;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Plugin\PluginBase;
use pocketmine\scheduler\CallbackTask;

use MGamesAPI\MGamesAPI;

class ChatPro extends PluginBase implements Listener{
	
	private static $obj = null;
	private $mute;
	private $MGamesAPI = false;
	
	public static function getInstance(){
		return self::$obj;
	}
	public function onLoad(){
		if(!self::$obj instanceof ChatPro){
			self::$obj = $this;
	}}
	
	public function onEnable(){ 
		$this->path = $this->getDataFolder();
		@mkdir($this->path);
		$this->conf = new Config($this->path."Config.yml", Config::YAML,array("switch"=>"off"));
		if($plugin = $this->getServer()->getPluginManager()->getPlugin("MGamesAPI") instanceof Plugin){
			$this->MGamesAPI = true;
			$this->getLogger()->info(TextFormat::YELLOW."§a[MX娘]连接插件MGamesAPI成功 !");
		}
		$this->factionspro = $this->getServer()->getPluginManager()->getPlugin("FactionsPro");
		$this->SimpleMarry = $this->getServer()->getPluginManager()->getPlugin("SimpleMarry");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		//$this->getLogger()->info("§a[DL娘]插件加载成功 !");
	}

	public function onJoin(PlayerJoinEvent $event){
	    $user = $event->getPlayer()->getName();
		$id=strtolower($user);
		$ch=$this->conf->get($id);
		if($ch==null){
		$this->conf->set($id,"新人");
		$this->conf->save();
		$ch = "新人";}
		$this->setNameTag($event->getPlayer());		
		}
	
	public function onCmdandChat(PlayerChatEvent $event){
		$player = $event->getPlayer();
	    $user = $player->getName();
		$id=strtolower($user);
		if(isset($this->mute[$id])){
			$player->sendMessage("§a[MX娘] 你被管理员禁言了，无法发言-_-#");
		    return $event->setCancelled(true);
		}
		$m = $event->getMessage();
		$w = $player->getLevel()->getName();
		$ch=$this->conf->get($id);
		if($this->MGamesAPI == true){
		if(MGamesAPI::getInstance()->getMGameWorld($w) == true){//如果在游戏地图
		return $event->setCancelled(true);}}
		if($this->factionspro->getPlayerFaction($user) == null){
			$gh = "§4[未入会]";
		}else{
			$gh = "§4[公会>{$this->factionspro->getPlayerFaction($user)}]";
		}
		if($this->SimpleMarry->isMarry($id)){
			$sm = "§d[伴侣：{$this->SimpleMarry->YAMLR_Marry($user)}]";
		}else{
			$sm = "§d[未婚]";
		}
		$msg = $w.":{$gh}{$sm}§6[".$ch."＆".$user."> §7".$m;
		$this->getServer()->broadcastMessage($msg);
		$event->setCancelled(true);
		}
	
	public function setNameTag($player){
		if(!$player instanceof Player){
		$player = $this->getServer()->getPlayer($player);}
		$user = $player->getName();
		$id=strtolower($user);
		$ch=$this->conf->get($id);
		$player->setNameTag($user.TextFormat::YELLOW."[".$ch."]");	
	}
	
	public function onCommand(CommandSender $sender, Command $command, $label, array $args){
		$user = $sender->getName();
		switch($command->getName()){
			case "setch":
			    if(isset($args[1])){
				$user=$args[0];
				$id=strtolower($user);
				$ch=$args[1];
				$conf=$this->conf->get($id);
				if($conf==null){$sender->sendMessage("§a[MX娘]该玩家不存在"); return true;}
				$p = $this->getServer()->getPlayer($user);
				if($p instanceof Player){
				$this->setNameTag($p);		
				$p->sendMessage("§a[MX娘] 你的称号被修改为 $ch");}
				$this->conf->set($id,$ch);
				$this->conf->save();
				$sender->sendMessage("§a[MX娘] 成功修改玩家 $user 称号为 $ch");
				return true;
				}
			case "mute":
			    if(isset($args[0])){
				$id=strtolower($args[0]);
				$conf=$this->conf->get($id);
				if($conf==null){$sender->sendMessage("§a[MX娘]该玩家不存在"); return true;}
				$p = $this->getServer()->getPlayer($id);
				if(isset($this->mute[$id])){
					$pmsg="§a[MX娘]你被解除了禁言，以后说话要注意哦";
					$msg="§a[MX娘]成功解除玩家$id 的禁言";
					unset($this->mute[$id]);
				}else{
				    $pmsg="§a[MX娘]你被管理员禁言了";
					$msg="§a[MX娘]成功禁言玩家$id";
				    $this->mute[$id]=true;
				}					
				if($p instanceof Player){
				$p->sendMessage("[MX娘] ".$pmsg);}
				$sender->sendMessage("[MX娘] ".$msg);
				return true;
				}
				return false;
		}
	}
	
	}