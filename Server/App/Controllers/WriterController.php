<?php 
namespace App\Controllers;
use App\Model;

class WriterController extends MainController
{
	public function write(){
		$writer = new Model\Writer();

		if($this->request->getRequestMethod()!== 'POST') return 0;
		$data = $this->request->getRequestData('POST');
		$this->checkInnerParams($data,['rock_position','time','jump_position','rock_size','isWin']);
		$writer->write($data);

	}
}





 ?>
