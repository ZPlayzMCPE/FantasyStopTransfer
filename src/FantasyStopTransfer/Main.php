<?php

namespace FantasyStopTransfer;

use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\plugin\PluginBase;
use pocketmine\{Server, Player};

class Main extends PluginBase implements Listener{
    
    public function onEnable(){
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getLogger()->notice("FantasyStopTransfer by Enrick3344 Enabled!");
        if($this->getConfig()->get("Transfer") == false){
            $this->getServer()->getLogger()->notice("Transfer is set to false in config. Players won't be transfered on server stop.");
            $this->getServer()->getLogger()->notice("Make sure to set your IP-Adress and Port in the configuration file");
        }else{
            $cfg = $this->getConfig();
            $this->getServer()->getLogger()->notice("Transfer is set to true! Players will be transfered to ".$cfg->get("IP-Adress").";".$cfg->get("Port"). " on server stop.");
        }
    }
    
    public function transferPlayers(Player $players){
        $ipadress = $this->getConfig()->get("IP-Adress");
        $port = $this->getConfig()->get("Port");
        if($this->getConfig()->get("Transfer") == true){
                return true;   
            }else{
                    $players->transfer($ipadress, $port);
            }
        }
    public function onDisable(){
        $players = $this->getServer()->getOnlinePlayers();
        $this->transferPlayers($players);
    }
}
