
<!DOCTYPE html>
<html>
    <head>
        <title>FRC STATS - EaStEr EgG!</title>

        <link rel="stylesheet" type="text/css" href="styles.css" />
        <link rel="stylesheet" type="text/css" href="gamestyles.css" />
        <script type="text/javascript">
            var score;
            var px, py;
            var ppx, ppy;
            var xcoords, ycoords;
            var pxcoords, pycoords;
            var color;
            var cxt;
            var map;
            var interval;
            var intervalid;
            function popup(){
                document.getElementById("blanket" ).style.display = 'block';
                document.getElementById("popUpDiv").style.display = 'block';
            }
            function popdown(){
                document.getElementById("blanket" ).style.display = 'none';
                document.getElementById("popUpDiv").style.display = 'none';
            }
            function gameOver(){
                document.getElementById("popscore").innerHTML = score;
                popup();
            }
            function setup(){
                cxt = document.getElementById("maincanvas").getContext("2d");
                pycoords = new Array();
                pxcoords = new Array();
                newPiece();
                clearMap();
                step();
                intervalid = setInterval('step()', interval=1000 );
                score = 0;
            }
            function clearMap(){
                map = new Array();
                for(var x = 0; x < 10; x++){
                    map[x] = new Array();
                    for(var y = 0; y < 20; y++){
                        map[x][y] = 0;
                    }
                }
            }
            function checkAbsorb(){
                for(var y = 0; y < 20; y++){
                    var absorb = true;
                    for(var x = 0; x < 10; x++){
                        if(map[x][y] == 0){
                            absorb = false;
                            break;
                        }
                    }
                    if(absorb){
                        score += 10;
                        clearInterval(intervalid);
                        intervalid = setInterval('step()', (interval = interval*0.8) );
                        document.getElementById("score").innerHTML = "Score=" + score + "    Speed=" + (1000.0/interval);
                        //remove line
                        //clear line -- and clear top line
                        for(var x = 0; x < 10; x++){
                            map[x][y] = map[x][0] = 0;
                        }
                        //shift down
                        while(y > 0){
                            y--;
                            for(var x = 0; x < 10; x++){
                                map[x][y+1] = map[x][y];
                            }
                        }
                    }
                }
            }
            //game end with one willed block in top row
            function checkGameEnd(){
                for(var x = 0; x < 10; x++){
                    if(map[x][0] == 1){
                        gameOver();
                        return true;
                    }
                }
                return false;
            }
            function step(){
                checkGameEnd();
                checkAbsorb();
                saveState();
                py++;
                checkPlace();
                draw();
            }
            function checkCollision(){
                for(var i=0; i<4; i++){
                    if((map[xcoords[i] + px][ycoords[i] + py] == 1) || (py >= 20)){
                        return true;
                    }
                }
                return false;
            }
            function checkCollisionSides(){
                for(var i=0; i<4; i++){
                    if( ((xcoords[i] + px) >= 10) || ((xcoords[i] + px) < 0)){
                        return true;
                    }
                }
                return false;
            }
            function checkPlace(){
                if(checkCollision()){
                    for(var i = 0; i < 4; i++){
                        map[pxcoords[i] + ppx][pycoords[i] + ppy] = 1;
                    }
                    newPiece();
                    return true;
                }
                else{
                    return false;
                }
            }
            function rotate(){
                var maxy = -9;
                for(var i=0; i < 4; i++){
                    var temp = ycoords[i];
                    ycoords[i] = -xcoords[i];
                    xcoords[i] = temp;
                    if(ycoords[i] > maxy){
                        maxy = ycoords[i];
                    }
                }
                //move up above curser
                if(maxy != 0){
                    for(var i=0; i < 4; i++){
                        ycoords[i] -= maxy;
                    }
                }
                //center
            }
            function saveState(){
                ppx = px;
                ppy = py;
                for(var i = 0; i < 4; i++){
                    pycoords[i] = ycoords[i];
                    pxcoords[i] = xcoords[i];
                }
            }
            function restoreState(){
                px = ppx;
                py = ppy;
                for(var i = 0; i < 4; i++){
                    ycoords[i] = pycoords[i];
                    xcoords[i] = pxcoords[i];
                }
            }
            function draw(){
                //background grid
                for(var x=0; x<10; x++){
                    for(var y=0; y<20; y++){
                        if(map[x][y]){
                            cxt.fillStyle=  "#888888";
                        }else{
                            cxt.fillStyle=  "#ffffff";
                        }
                        cxt.fillRect  (x*10, y*10, 10, 10);
                        cxt.strokeStyle="#888888";
                        cxt.strokeRect(x*10, y*10, 10, 10);
                    }
                }
                //current piece
                for(var i = 0; i < 4; i++){
                    cxt.fillStyle=getColor(color);
                    cxt.fillRect(  (px + xcoords[i])*10, (py + ycoords[i])*10, 10, 10);
                    cxt.strokeStyle="#000000";
                    cxt.strokeRect((px + xcoords[i])*10, (py + ycoords[i])*10, 10, 10);
                }
            }
            function getColor(color){
                switch(color){
                    case 0:
                        return "cyan"
                        break;
                    case 1:
                        return "blue"
                        break;
                    case 2:
                        return "orange"
                        break;
                    case 3:
                        return "yellow"
                        break;
                    case 4:
                        return "green"
                        break;
                    case 5:
                        return "purple"
                        break;
                    case 6:
                        return "red"
                        break;
                }
            }
            function newPiece(){
                px = 4;
                py = 1;
                r = Math.floor(Math.random() * 7);
                switch(r){
                    case 0://I
                        xcoords = [-2, -1, 0, 1];
                        ycoords = [0, 0, 0, 0];
                        color = 0;
                        break;
                    case 1://J
                        xcoords = [-1, 0, 1, 1];
                        ycoords = [0, 0, 0, -1];
                        color = 1;
                        break;
                    case 2://L
                        xcoords = [-1, 0, 1, 1];
                        ycoords = [-1, -1, -1, 0];
                        color = 2;
                        break;
                    case 3://O
                        xcoords = [0, -1, -1, 0];
                        ycoords = [0, 0, -1, -1];
                        color = 3;
                        break;
                    case 4://S
                        xcoords = [-1, 0, 0, 1];
                        ycoords = [0, 0, -1, -1];
                        color = 4;
                        break;
                    case 5://T
                        xcoords = [-1, 0, 0, 1];
                        ycoords = [0, 0, -1, 0];
                        color = 5;
                        break;
                    case 6://Z
                        xcoords = [-1, 0, 0, 1];
                        ycoords = [-1, -1, 0, 0];
                        color = 6;
                        break;
                }
            }
            //   38
            //37 40 39   A=65 B=66
            function keyDown(event){
                if      (event.keyCode == 37){//left
                    saveState()
                    px--;
                    if(checkCollisionSides()){
                        restoreState();
                    } else if(checkCollision()){
                        restoreState();
                    }
                    draw();
                }
                else if (event.keyCode == 38){//up
                    saveState();
                    rotate();
                    if(checkCollisionSides()){
                        restoreState();
                    } else if(checkCollision()){
                        restoreState();
                    }
                    draw();
                }
                else if (event.keyCode == 39){//right
                    saveState()
                    px++;
                    if(checkCollisionSides()){
                        restoreState();
                    } else if(checkCollision()){
                        restoreState();
                    }
                    draw();
                }
                else if (event.keyCode == 40){//down
                    step();
                }
            }
        </script>
    </head>
    <body onload="setup();" onKeyDown="keyDown(event);" border="1px">
        <span id="score">Easter Egg Under Development.</span><br/><br/>
        <canvas id="maincanvas" width="100px" height="200px">
            Sorry, I guess your browser just isn't modern enough for this.
        </canvas>
        <br/><br/>
        <div id="blanket" style="display:none;"></div>
        <div id="container">
            <div id="popUpDiv" class="rounded" style="display:none;">
                <a onclick="popdown();setup();">RESTART</a>
                <a style="float:right;" href="/">BACK TO SITE</a>
                <br/><br/>
                <p id="yourscore">YOUR SCORE:</p>
                <span id="popscore"></span>
            </div>
        </div>
    </body>
</html>