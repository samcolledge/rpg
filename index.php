<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
<link href="/css/style.css" rel="stylesheet" media="all">
<script type='text/javascript' src='http://code.jquery.com/jquery-1.11.1.min.js'></script>
<script type="text/javascript">
	
var soldier = {
  health: 100,
  magic: 100,
  idleSprite: "/images/sprite.gif",
  attackSprite: "/images/sprite-hit.gif",
  magicSprite: "",
  itemSprite: "",
};
	
var mage = {
  health: 100,
  magic: 100,
  idleSprite: "/images/sprite-mage.gif",
  attackSprite: "/images/sprite-hit.gif",
  magicSprite: "",
  itemSprite: "",
};	
	
var thief = {
  health: 100,
  magic: 100,
  idleSprite: "/images/sprite.gif",
  attackSprite: "/images/sprite-hit.gif",
  magicSprite: "",
  itemSprite: "",
};
	
	
	

enemy=100;
hitPoint=Math.floor(Math.random() * (20 - 10) + 10); // generate random number between 10 and 20

$(document).ready(function() {

//Enemy chooses target
function enenmyChooses() {
	pickedPlayer=Math.floor(Math.random() * 3) + 1; // generate random number between 1 and 3
	

	if(pickedPlayer === 1) {
		enemyAttack(soldier.health,'soldier-points');
		soldier.health=updatedHealth
	} else if(pickedPlayer === 2) {
		enemyAttack(mage.health, 'mage-points');
		mage.health=updatedHealth
	} else if(pickedPlayer === 3) {
		enemyAttack(thief.health, 'thief-points');
		thief.health=updatedHealth
	}	
	
	
}

function damagePoints() {
	console.log('damagePoints');
	var pointBox = $("<div class='hitpoints'>" + hitPoint + "</div>");
	$(".battlefield").append(pointBox);
	console.log(hitPoint);
	setTimeout(function() {
        pointBox.remove();
    }, 2000);
}


function fireBall(ballTop) {
    var fire = $("<img src='/images/fireball.gif' class='fireball hide'>");
	setTimeout(function() {
	setTimeout(function() {
    $(".battlefield").append(fire);
	$(fire).css({
   'top' : ballTop,
   'opacity' : '0.7'
	});
    setTimeout(function() {
		
	$(fire).css({
   'opacity' : '1',
   'left' : '80%',
   'top' : ballTop
	});
		setTimeout(function() {
        fire.remove();
		damagePoints();
    }, 1100);
    }, 10);
	}, 10);
	}, 500);
}



//Enemy attack function
function enemyAttack(playerHealth,menuName) {
	if ( $('.enemy').hasClass( "hold-turn" ) ) {
		
	} else {
	hitPoint=Math.floor(Math.random() * (20 - 10) + 10); // generate random number between 10 and 20	
	updatedHealth=playerHealth - hitPoint;
	
	if(playerHealth < 0) { //If the players is dead
		 $('.battlefield').css( "background", "red" ); // Move character into battle
		 $('.' + menuName ).find('.health-indicator').empty(); //remove previous enemey health
		  $('.' + menuName ).find('.health-indicator').append('0');
	 }
	 else {
	
		 $('.' + menuName ).find('.health-indicator').empty(); //remove previous enemey health
		 $('.' + menuName ).find('.health-indicator').append(updatedHealth);
    $('.enemy').css( "margin-right", "100px" );
	setTimeout(function() {
	$('.enemy').css( "margin-right", "0px" ); //Move character back
}, 2000);
	
	 }
	return updatedHealth;
	}
};
setInterval(enenmyChooses, 3000);


//Summon Attack
function summonAttack() {
hitPoint=Math.floor(Math.random() * (20 - 10) + 10); // generate random number between 10 and 20
enemy=enemy - hitPoint; // Reduce attack damage from enemy HP
$('.character').css( "margin-left", "-100px" ); //step 1
setTimeout(function(){ //step 2
$('.dragon').css( "margin-left", "150px" ); 
setTimeout(function() { //step 3
$('.dragon').css( "margin-left", "250px" );
$('.enemyhp').find('.health-indicator').empty(); //remove previous enemey health
$('.enemyhp').find('.health-indicator').append(enemy);
setTimeout(function() { //step 4
damagePoints();
$('.dragon').css( "margin-left", "150px" ); //Move character back
setTimeout(function(){ //step 5
$('.dragon').css( "margin-left", "-300px" ); 
setTimeout(function(){ //step 6
$('.character').css( "margin-left", "0px" );
},2000);
},1000);
},1000);
},2000);
},2000);




}

//Show Player Menu
/*
function menuOptions() {
	if($('.mage__menu, .thief__menu').hasClass('wait-turn')) {
	$('.soldier__menu').css("display","block");
	$(".soldier__menu").removeClass('wait-turn');
	}
	else if($('.soldier__menu, .thief__menu').hasClass('wait-turn')){
	$('.mage__menu').css("display","block");
	$(".mage__menu").removeClass('wait-turn');
	}
	else if($('.soldier__menu, .mage__menu').hasClass('wait-turn')){
	$('.mage__menu').css("display","block");
	$(".mage__menu").removeClass('wait-turn');
	}
};
setInterval(menuOptions, 3000);
*/
// Summon Button
$(document).on('click', '.summon', function(){ 
$('.enemy').addClass('hold-turn');
summonAttack();
if ($(this).parents('.soldier__menu').length) {
	nextMenu=$('.mage__menu');
	}
	else if ($(this).parents('.mage__menu').length) {
	nextMenu=$('.thief__menu');
	}
	else{
	nextMenu=$('.soldier__menu');
	}
$(this).parent().parent().addClass('wait-turn');
setTimeout(function(){
	$(nextMenu).removeClass('wait-turn');
	$('.enemy').removeClass('hold-turn');
},9000);
});
// Attack Button
$(document).on('click', '.attack', function(){ 
	enemy=enemy - hitPoint; // Reduce attack damage from enemy HP
	player=""
	//Determine which player is attacking
	if ($(this).parents('.soldier__menu').length) {
	player=$('.soldier');
	menu=$('.soldier__menu');
	nextMenu=$('.mage__menu');
	timeBar=$('.soldier-points .time');
	playerhp=soldier.health
	ballTop="100px"
	}
	else if ($(this).parents('.mage__menu').length) {
	player=$('.mage');
	menu=$('.mage__menu');
	nextMenu=$('.thief__menu');
	timeBar=$('.mage-points .time');
	playerhp=mage.health
	ballTop="200px"
	}
	else{
	player=$('.thief');
	menu=$('.thief__menu');
	nextMenu=$('.soldier__menu');
	timeBar=$('.thief-points .time');
	playerhp=thief.health
	ballTop="300px"
	}
	playerhp=playerhp - hitPoint;
	$(player).css( "margin-left", "100px" ); // Move character into battle
	$(player).attr("src","/images/sprite-hit.gif");
	fireBall(ballTop);
	
	$('.enemyhp').find('.health-indicator').empty(); //remove previous enemey health
	$('.enemyhp').find('.health-indicator').append(enemy);

	$(this).parent().parent().addClass('wait-turn');
	
	$(timeBar).removeClass('active'); 
	setTimeout(function() {
		
	$(player).css( "margin-left", "0px" ); //Move character back
	$(player).attr("src","/images/sprite.gif");
	$(nextMenu).removeClass('wait-turn');
	$(timeBar).addClass('active'); 
}, 3000);
 });
 

 
 
});
</script>
</head>

<body>
<div class="wrap">
<div class="battlefield">
<div class="goodies">
<img class="dragon" src="/images/dragon.png">
<img src="/images/sprite.gif"  class="soldier character" >
<img src="/images/sprite-mage.gif"  class="mage character" width="100" height="120">
<img src="/images/sprite.gif"  class="thief character" width="100" height="120">
</div>
<div class="baddies">
<img src="/images/enemy.gif" class="enemy" width="100" height="200">
</div>
</div>
<div class="menu">
<ul>
<li>Soldier
<ul class="soldier__menu option-menu">
<li><a href="#" class="attack">Attack</a></li>
<li><a href="#" class="magic">Magic</a></li>
<li><a href="#" class="summon">Summon</a></li>
<li><a href="#" class="item">Item</a></li>
</ul></li>
<li>Mage
<ul class="mage__menu wait-turn option-menu">
<li><a href="#" class="attack">Attack</a></li>
<li><a href="#" class="magic">Magic</a></li>
<li><a href="#" class="summon">Summon</a></li>
<li><a href="#" class="item">Item</a></li>
</ul></li>
<li>Thief
<ul class="thief__menu wait-turn option-menu">
<li><a href="#" class="attack">Attack</a></li>
<li><a href="#" class="magic">Magic</a></li>
<li><a href="#" class="summon">Summon</a></li>
<li><a href="#" class="item">Item</a></li>
</ul></li>
</ul>
	<div class="points">
		<p class="soldier-points">Soldier HP: <span class="time-bar"><i class="time"></i></span><span class="health-indicator">100</span></p>
        <p class="mage-points">Mage HP: <span class="time-bar"><i class="time"></i></span><span class="health-indicator">100</span></p>
        <p class="thief-points">Thief HP: <span class="time-bar"><i class="time"></i></span><span class="health-indicator">100</span></p>
        <p class="enemyhp">Enemy HP: <span class="health-indicator">100</span></p>
    </div>
</div>
</div>
</body>
</html>