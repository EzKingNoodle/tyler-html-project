<?php

session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);



?>


<!DOCTYPE html>
<html lang="en">
<head>

<title>Game1</title>
    Game1 

<canvas id="canvas"></canvas>
</head>
<body style="background-color:black;">
    <p>Runaway</p>

    <script> 
    
//credit to https://www.educative.io/answers/how-to-make-a-simple-platformer-using-javascript for the begginings of the below code (Thank you!)

// The attributes of the player.
var player = {
  x: 30,
  y: 50,
  x_v: 0,
  y_v: 0,
  jump : true,
  height: 20,
  width: 20,
  jetpack: false,
  };
// The status of the arrow keys
var keys = {
  right: false,
  left: false,
  up: false,
  };
// The friction and gravity to show realistic movements    
var gravity = .395;
var friction = 0.7;
// The number of platforms
var num = 9;
// The platforms
var platforms = [];
// Function to render the canvas
function rendercanvas(){
ctx.fillStyle = "#3d7819";
ctx.fillRect(0, 0, 1775, 500);

}

// Function to render the player
function renderplayer(){
  ctx.fillStyle = "#F08080";
  ctx.fillRect((player.x - 20), (player.y - 20), player.width, player.height);
  }
// Function to create platforms
function createplat(){
  for(i = 0; i < num; i++) {
    for(j = 1; j < 3; j++) {
    if(i == 3 && j == 1) {
        platforms.push(
            {
            x: (150 * i),
            y: (j*150) + (50 * i) - 150,
            width: 75,
            height: 15,
            }
        )
          } 
          
         else if(i == 2 && j == 2) {
          platforms.push(
              {
              x: (150 * i) + 75,
              y: (j*150) + (50 * i) - 50,
              width: 75,
              height: 15,})
         }
         else if(i == 3 && j == 2) {
          platforms.push(
             {
             x: 375,
             y: (j*150) + (50 * i) + 25 ,
             width: 75,
             height: 15,})

        } else if(j % 2 == 0) {
      platforms.push(
          {
          x: (150 * i) + 50,
          y: (j*150) + (50 * i) + 50,
          width: 75,
          height: 15,
          }
      );
    } else {
      platforms.push(
        {
        x: (150 * i),
        y: (j*150) + (50 * i),
        width: 75,
        height: 15,
        }
      )
    }
  }
  }
}
// Function to render platforms
function renderplat(){
  ctx.fillStyle = "#bd6819";
  ctx.fillRect(platforms[0].x, platforms[0].y, platforms[0].width - 20,platforms[0]. height);
  ctx.fillStyle = "#52390e";
  ctx.fillRect(platforms[1].x, platforms[1].y, platforms[1].width - 20,platforms[1]. height);
  ctx.fillStyle = "#bd6819";
  ctx.fillRect(platforms[2].x, platforms[2].y, platforms[2].width - 20,platforms[2]. height);
  ctx.fillStyle = "#52390e";
  ctx.fillRect(platforms[3].x, platforms[3].y, platforms[3].width - 20,platforms[3]. height);
  ctx.fillStyle = "#bd6819";
  ctx.fillRect(platforms[4].x, platforms[4].y, platforms[4].width - 20,platforms[4]. height);
  ctx.fillStyle = "#52390e";
  ctx.fillRect(platforms[5].x, platforms[5].y, platforms[5].width - 20,platforms[5]. height);
  ctx.fillStyle = "#bd6819";
  ctx.fillRect(platforms[6].x, platforms[6].y, platforms[6].width - 20,platforms[6]. height);
  ctx.fillStyle = "#000000"
  ctx.fillRect(platforms[7].x, platforms[7].y, platforms[7].width - 20,platforms[7]. height);
  

}

//for use below
//var coinpos_x;
//var coinpos_y;

function rendercoin(a){
  
  ctx.fillStyle = "#f2ef1b";
  ctx.fillRect(platforms[a].x + 25, platforms[a].y - 25, platforms[a].width -70,platforms[a]. height);
  //coinpos_x = platforms[a].x + 25;
  //coinpos_y = platforms[a].x -25;
}



// This function will be called when a key on the keyboard is pressed
function keydown(e) {
  // 37 is the code for the left arrow key
  if(e.keyCode == 37) {
      keys.left = true;
  }
  // 37 is the code for the up arrow key
  if(e.keyCode == 38) {
      if(player.jump == false) {
          player.y_v = -10;
      }
  }
  //32 is for space bar
  if(e.keyCode == 32) {
    if(player.jump == true) {
        player.jetpack = true;
    }
 }  
  // 39 is the code for the right arrow key
  if(e.keyCode == 39) {
      keys.right = true;
  }
}
// This function is called when the pressed key is released
function keyup(e) {
  if(e.keyCode == 37) {
      keys.left = false;
  }
  if(e.keyCode == 38) {
      if(player.y_v < -2) {
      player.y_v = -3;
      }
  if(e.keyCode == 32) {
    player.jetpack = false;
  }  
  }
  if(e.keyCode == 39) {
      keys.right = false;
  }
} 

var r = Math.floor(Math.random() * 8);

function fix_it_felix( x, y, r) {

if (player.x == platforms[r].x + 20 /*|| player.x >= platforms[r].x - 20)*/ && player.y <= platforms[r].y+ 2 || player.y >= platforms[r].y - 2) {
    r = Math.floor(Math.random() * 6); 
    count++;
    rendercoin(r);
  }

}

function loop() {
  // If the player is not jumping apply the effect of frictiom
  if(player.jump == false) {
      player.x_v *= friction;
  } else {
      // If the player is in the air then apply the effect of gravity
      player.y_v += gravity;
  }
  player.jump = true;

  if (player.y > (ctx.canvas.height -5)) {
    player.y_v = 1;
    player.x = 50;
    player.y = 74;
  }
  // If the left key is pressed increase the relevant horizontal velocity
  if(keys.left) {
      player.x_v = -2.5;
  }
  if(keys.right) {
      player.x_v = 2.5;
  }
  // Updating the y and x coordinates of the player
  player.y += player.y_v;
  player.x += player.x_v;
  // A simple code that checks for collions with the platform
  let i = -1;
  if(platforms[0].x < player.x && player.x < platforms[0].x + platforms[0].width &&
  platforms[0].y < player.y && player.y < platforms[0].y + platforms[0].height){
      i = 0;
  }
  if(platforms[1].x < player.x && player.x < platforms[1].x + platforms[1].width &&
  platforms[1].y < player.y && player.y < platforms[1].y + platforms[1].height){
      i = 1;
  }
  if(platforms[2].x < player.x && player.x < platforms[2].x + platforms[2].width &&
    platforms[2].y < player.y && player.y < platforms[2].y + platforms[2].height){
      i = 2;
  }
  if(platforms[3].x < player.x && player.x < platforms[3].x + platforms[3].width &&
    platforms[3].y < player.y && player.y < platforms[3].y + platforms[3].height){
      i = 3;
  }
  if(platforms[4].x < player.x && player.x < platforms[4].x + platforms[4].width &&
    platforms[4].y < player.y && player.y < platforms[4].y + platforms[4].height){
      i = 4;
  }
  if(platforms[5].x < player.x && player.x < platforms[5].x + platforms[5].width &&
    platforms[5].y < player.y && player.y < platforms[5].y + platforms[5].height){
      i = 5;
  }
  if(platforms[6].x < player.x && player.x < platforms[6].x + platforms[6].width &&
    platforms[6].y < player.y && player.y < platforms[6].y + platforms[6].height){
      i = 6;
  }
  if(platforms[7].x < player.x && player.x < platforms[7].x + platforms[7].width &&
    platforms[7].y < player.y && player.y < platforms[7].y + platforms[7].height){
      i = 7;
  }
  if (i > -1){
      player.jump = false;
      player.y = platforms[i].y;    
  }
  // Rendering the canvas, the player and the platforms
  rendercanvas();
  renderplayer();
  renderplat();
  rendercoin(r)

  platforms[0].x, platforms[0].y, platforms[0].width - 20,platforms[0]. height;
  
  platforms[1].x, platforms[1].y, platforms[1].width - 20,platforms[1]. height;
  
  platforms[2].x, platforms[2].y, platforms[2].width - 20,platforms[2]. height;
  
  platforms[3].x, platforms[3].y, platforms[3].width - 20,platforms[3]. height;
  
  platforms[4].x, platforms[4].y, platforms[4].width - 20,platforms[4]. height;
  
  platforms[5].x, platforms[5].y, platforms[5].width - 20,platforms[5]. height;
  
  platforms[6].x, platforms[6].y, platforms[6].width - 20,platforms[6]. height;
 
  platforms[7].x, platforms[7].y, platforms[7].width - 20,platforms[7]. height;

  
  if (player.x == platforms[r].x + 20 /*|| player.x >= platforms[r].x - 20)*/ && player.y <= platforms[r].y+ 2 || player.y >= platforms[r].y - 2) {
    r = Math.floor(Math.random() * 6); 
    count++;

  }
  rendercoin(r);

}
canvas=document.getElementById("canvas");
ctx=canvas.getContext("2d");
ctx.canvas.height = 500;
ctx.canvas.width = 1800;
createplat();
// Adding the event listeners
document.addEventListener("keydown",keydown);
document.addEventListener("keyup",keyup);
setInterval(loop,22);

fetch("https://jsonplaceholder.typicode.com/todos", {
  method: "POST",
  body: JSON.stringify({
    userId: 1,
    title: "Fix my bugs",
    completed: false
  }),
  headers: {
    "Content-type": "application/json; charset=UTF-8"
  }
})
  .then((response) => response.json())
  .then((json) => console.log(json));
    
    </script>
</body>
</html>