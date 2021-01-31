<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
<link href="/css/style.css" rel="stylesheet" media="all">

</head>

<body>
<div class="wrap">
<div class="battlefield">
<div class="goodies">
<img class="dragon" src="/images/dragon.png">
<div class="soldier character"><img src="/images/sprite.gif"  ></div>
<div class="mage character"><img src="/images/sprite-mage.gif"  width="100" height="120"></div>
<div class="thief character"><img src="/images/sprite.gif"  width="100" height="120"></div>
</div>
<div class="baddies">
<img src="/images/enemy.gif" class="enemy" width="100" height="200">
</div>
</div>
<div class="menu" id="menu">
    <ul>
      <li class="active">Soldier
        <ul class="soldier__menu option-menu">
          <li><a href="#" class="attack">Attack</a></li>
          <li><a href="#" class="magic">Magic</a></li>
          <li><a href="#" class="summon">Summon</a></li>
          <li><a href="#" class="item">Item</a></li>
        </ul>
      </li>
      <li>Mage
        <ul class="mage__menu wait-turn option-menu">
          <li><a href="#" class="attack">Attack</a></li>
          <li><a href="#" class="magic">Magic</a></li>
          <li><a href="#" class="summon">Summon</a></li>
          <li><a href="#" class="item">Item</a></li>
        </ul>
      </li>
      <li>Thief
        <ul class="thief__menu wait-turn option-menu">
          <li><a href="#" class="attack">Attack</a></li>
          <li><a href="#" class="steal">Steal</a></li>
          <li><a href="#" class="summon">Summon</a></li>
          <li><a href="#" class="item">Item</a></li>
        </ul>
      </li>
    </ul>
    <ul class="menu__item">
        <li><a href="#" class="potion">Potion</a>
        <li><a href="#" class="elixer">Elixer</a>
        <li><a href="#" class="barrier">Barrier</a>
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
	<script type="text/javascript">
		

 var soldier = {
  name: "Soldier",
  health: 100,
  magic: 100,
  menu: ".soldier__menu",
  idleSprite: "/images/sprite.gif",
  attackSprite: "/images/sprite-hit.gif",
  magicSprite: "",
  itemSprite: "",
  deathSprite: "",
}
 var mage = {
  name: "Mage",
  health: 100,
  magic: 100,
  menu: ".mage__menu",
  idleSprite: "/images/sprite-mage.gif",
  attackSprite: "/images/sprite-hit.gif",
  magicSprite: "",
  itemSprite: "",
  deathSprite: "",
}
 var thief = {
  name: "Thief",
  health: 100,
  magic: 100,
  menu: ".thief__menu",
  idleSprite: "/images/sprite.gif",
  attackSprite: "/images/sprite-hit.gif",
  magicSprite: "",
  itemSprite: "",
  deathSprite: "",
 }
 var enemy = {
  name: "Enemy",
  health: 100,
  magic: 100,
  idleSprite: "/images/enemy.gif",
  attackSprite: "/images/sprite-hit.gif",
  magicSprite: "",
  itemSprite: "",
  deathSprite: "",
 }


var elements = document.getElementsByClassName("option-menu");	
		
	
/*function modifyText() {
alert('clicked');
}		
		
for (var i = 0; i < elements.length; i++) {
	
    console.log(player[i].name.toLowerCase());
    console.log(elements[i]);
	
	const elem = document.querySelectorAll("a");
	elem.addEventListener("click", modifyText, false);
	
	
	}*/
		
		
function menuOption(clicked, characterName, nextCharacter, currentCharacter){
	
	let attackPoints = Math.floor(Math.random() * (10) + 10); // generate random number between 10 and 20	
	
	
	if(clicked === "attack") {
        var thisCharacter = document.querySelector('.' + characterName);
        var fire = "<img src='/images/fireball.gif' class='fireball'>"
		
		thisCharacter.children[0].src=eval(characterName).attackSprite
        setTimeout(function(){  
		thisCharacter.insertAdjacentHTML('beforeend', fire);
        thisCharacter.children[0].src=eval(characterName).idleSprite
        }, 600);
		
		
	setTimeout(function() {	
		document.querySelector('.battlefield').insertAdjacentHTML('beforeend', "<div class='hitpoints'>" + attackPoints + "</div>");
        setTimeout(function() {
            document.querySelector('.hitpoints').remove();
			eval(enemy).health = eval(enemy).health - attackPoints
			document.querySelector('.enemyhp .health-indicator').innerHTML = eval(enemy).health;
        }, 800);
	}, 2000);
        
		
		currentCharacter.classList.add("wait-turn"); 
        setTimeout(function(){  
        nextCharacter.classList.remove("wait-turn");
        }, 1000);
		
	} else if(clicked === "magic") {
			  
    } else if(clicked === "summon") {
			  
    } else if(clicked === "item") {
		
		document.querySelector('.menu__item').style.display = "block";
		
	}
}

		
const wrapper = document.getElementById('menu');

wrapper.addEventListener('click', (event) => {
	
  const isButton = event.target.nodeName === 'A';
  const thisMenuName = event.target.closest('ul').parentElement;
  const thisMenu = event.target.closest('ul');
  const defaultMenu = event.target.closest('div').getElementsByTagName('ul')[1];

	
	
	
  // check its a button thats been clicked
  if (!isButton) { 
    return;
  }
  //check if we are on the last menu
  if (thisMenu.closest('li').nextElementSibling == null) { 
	nextMenu = defaultMenu;
	thisMenuName.classList.remove("active");
	defaultMenu.closest('li').classList.add("active");
  } else {
	nextMenu = thisMenu.closest('li').nextElementSibling.firstElementChild;
	thisMenuName.classList.remove("active");
	thisMenu.closest('li').nextElementSibling.classList.add("active");
  }

	

  menuOption(event.target.className, thisMenuName.firstChild.nodeValue.toLowerCase(), nextMenu, thisMenu);	
	
})	

		

	


		
	

</script>
</html>