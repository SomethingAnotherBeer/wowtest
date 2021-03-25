<?php 
namespace App\Model;

class Writer extends Model
{
	public function write(array $data){
		$rock_position = $data['rock_position'];
		$time = $data['time'];
		$jump_position = $data['jump_position'];
		$rock_size = $data['rock_size'];
		$is_win = $data['isWin'];

		$query_string = "INSERT INTO results (rock_position,running_time,jump_position,rock_size,is_win) VALUES ($rock_position,$time,$jump_position,$rock_size,$is_win)";
		
		try{
			$this->connection->exec($query_string);
		}
		catch(\PDOException $e){
			throw new \Exception($e->getMessage());
		}

	}
}





 ?>