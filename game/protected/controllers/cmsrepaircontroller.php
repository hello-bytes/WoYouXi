<?php

require_once "cmscontroller.php";
class CmsRepairController extends CmsController
{
	//设置所有没有游戏的游戏状态为下线
	public function actionRepairGameStatus()
	{
		$ids = $_POST['ids'];
		$idsArr = $this->getConditionArray($ids);
		
		foreach($idsArr as $id){
			$game = new Game();
			$gameMeta = new GameMeta();
			
			if($gameMeta->isGameDataExist($id)){
				$game->setGameStatus(array($id), 1);
			}else{
				$game->setGameStatus(array($id), 0);
			}
		}
		
		echo GeneralSuccessJsonResult(array());
	}
}