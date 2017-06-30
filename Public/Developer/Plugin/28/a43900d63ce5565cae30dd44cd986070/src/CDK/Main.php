<?php
    namespace CDK;
    
    use pocketmine\Server;
    use pocketmine\plugin\PluginBase;
    use pocketmine\event\Listener;
    use pocketmine\utils\Config;
    use pocketmine\command\Command;
    use pocketmine\command\CommandSender;
    use pocketmine\command\ConsoleCommandSender;
    use pocketmine\event\server\ServerCommandEvent;
    use pocketmine\utils\TextFormat;
    
    class Main extends PluginBase implements Listener{
        
        private $cdklist;
        public function onEnable() {
            $this->getServer()->getPluginManager()->registerEvents($this,$this);
            $this->cdk = new Config($this->getDataFolder()."cdk.yml", Config::YAML);
            $this->getLogger()->info(TextFormat::GREEN."===========================================");
            $this->getLogger()->info(TextFormat::GREEN."[ICDK][卡密系统] 已载入完成！");
            $this->getLogger()->info(TextFormat::GREEN."版权所有 ©2017 制作人：HAO QQ：3295561068 Version 1.0.1 ");
            $this->getLogger()->info(TextFormat::GREEN."===========================================");
            $this->SetStatus=0;
            $this->cdknb = null;
            
        }
        
        public function Cmd(ServerCommandEvent $event) {
            if($this->SetStatus == 1){
                $message = $event->getCommand();
                $message1 = $this->cdknb;
                $this->cdk->set($message1,$message);
                $this->cdk->save();
                $this->SetStatus = 0;
                $event->setCancelled();
                $this->getServer()->getLogger()->info("[卡密系统] 设置成功");
            }
        }
        
        
        
        public function onCommand(CommandSender $sender, Command $command, $label, array $args){
            switch($command->getName()){
                case "卡密设置":
                    if($sender->isOP()){
                        if(isset($args[0])){
                            $sender->sendMessage("[卡密系统] 设置成功,兑换码: ".$args[0]."请直接输入命令");
                            $name=$sender->getName();
                            $this->SetStatus=1;
                            $this->cdknb = $args[0];
                        }else{
                            $sender->sendMessage("[卡密系统] 格式不正确,用法/卡密兑换 <兑换码>");
                        }
                    }else{
                        $sender->sendMessage("[卡密系统] 您不是OP, 不能设置卡密！");
                    }
                    break;
                case "卡密兑换":
                    if(isset($args[0])){
                        if ($this->cdk->exists($args[0])) {
                            $command = $this->cdk->get($args[0]);
                            $command = str_replace("{player}", $sender->getName(), $command);
                            $this->getServer()->dispatchCommand(new ConsoleCommandSender(), $command);
                            $sender->sendMessage("[卡密系统] 兑换成功");
                            $this->cdk->remove($args[0]);
                            $this->cdk->save();
                        }else{
                            $sender->sendMessage("[卡密系统] 您的兑换码输入错误");
                        }
                    }else{
                        $sender->sendMessage("[卡密系统] 您的兑换码输入错误");
                    }
            }
            return true;
        }
        
    }
