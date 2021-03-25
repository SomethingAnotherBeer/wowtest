
const finish_position = 1018;

window.addEventListener('load',()=>{
	

	const character_node = document.querySelector('.donut');
	let run_params = new CreateParams(window.terrain.rockPosition); 
	let controlRunning = null;
	
	window.character.run();
	controlRunning = setInterval(()=>Run(controlRunning),0)


	

	window.addEventListener('keyup',function(e){	

		clearInterval(controlRunning);

		/*Если пользователь нажал кнопку пробела, при условии, что не было взаимодействия с препятствием, то перезаписываем положение прыжка игрока и
		если игрок находиться в непосредственной близости от препятствия, то ставим флаг взаимодействия в true
		*/
		if(e.key = 'Backspace' && !run_params.rock_interaction){  
			run_params.current_jump_position = window.character.characterPosition;
			if(window.character.characterPosition>=run_params.position_for_jump) run_params.rock_interaction = true;
			
		}

		if(character_node.classList.contains('running')){
			controlRunning = setInterval(()=>{
				Run(controlRunning);
			},0);
		}	
	})	




function Run(current_runtime){
	

	run_params.character_positions.push(window.character.characterPosition); //Считываем текущее положение игрока в массив позиций

	/*
	Если игрок находиться в непосредственной близости от препятствия и если флаг взаимодействия с препятствием установлен в false,
	то даем команду прыгнуть и устанавливаем флаг взаимодействия в true
	*/
	if(window.character.characterPosition>=run_params.position_for_jump && !run_params.rock_interaction){ 
		window.character.jump();
		if(!run_params.current_jump_position) run_params.current_jump_position = run_params.position_for_jump;
		run_params.rock_interaction = true;
	}


	/*
		Если флаг взаимодействия установлен в true, и текущая позиция игрока равна 0, следовательно, предыдущий забег окончен.
		Если предыдущая позиция игрока  равна финишной прямой, то устанавливаем параметр isWin в true. Выполняем запрос на запись
		параметров
	*/
	if(run_params.rock_interaction == true && window.character.characterPosition === 0){
		clearInterval(current_runtime);

		run_params.isWin = ( run_params.character_positions[run_params.character_positions.length-2] === finish_position ) ? true : false;
		run_params.finish_time = (Date.now() - run_params.start_time)/1000; // Получаем время забега в секундах

		let prepared_data = {
			rock_position:window.terrain.rockPosition,
			time:run_params.finish_time,
			jump_position:run_params.current_jump_position,
			rock_size:window.terrain.rockSize,
			isWin:run_params.isWin,

		}

		sender(prepared_data);

		
	}

}


function CreateParams(rock_position){
	this.position_for_jump = rock_position - 120;
	this.current_jump_position;
	this.character_positions = [];
	this.rock_interaction = false;
	this.start_time = Date.now();
	this.finish_time = 0;
	this.isWin = false;

}



function sender(request_data){
	let request = new XMLHttpRequest();
	let url = 'http://game_server11/write';

	request.addEventListener('readystatechange',()=>{ //Начинаем следующий забег после того, как данные о предыдущем были успешно отправлены на сервер
		if(request.readyState === 4){
			run_params = new CreateParams(window.terrain.rockPosition);
			window.character.run();
			controlRunning = setInterval(()=>Run(controlRunning),0)
		}
	})

	request.open('POST',url);
	request.setRequestHeader('Content-Type','application/json');
	request.send(JSON.stringify(request_data));

}







})


