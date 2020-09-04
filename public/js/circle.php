
<script>
var myTotal = 0;
var myColor = ['#39CCCC', '#001f3f', '#C57042','#95D861','#CC8A3E','#292A24','#767867','#848298','#166BBB','#7A3D2E','#D76932','#999FAF','#8CB3D3','#D5B234','#A54B4B','#7B817F','#6ED136']; // Colors of each slice


var arcs = [];

function draw() {
    arcs = [];
    myTotal = 0;

    // calculate the total value we have
    entries.forEach(function (val, idx) {

        myTotal += val[1][1] / 1;

    });
    // get the <ul> to put <li> in it that have the name and input to change the color
    document.getElementById("dvLegend").innerHTML = "";
    var beginAngle = 0;
    var endAngle = 0;
    entries.forEach(function (val, idx) {
        ctx.fillStyle = myColor[idx % myColor.length]; // choosing color
        ctx.beginPath(); // start drawing
        ctx.moveTo(canvas.width / 2, canvas.height / 2); // move the cursor to start position
        // Arc Parameters: x, y, radius, startingAngle (radians), endingAngle (radians), antiClockwise (boolean)
        ctx.arc(canvas.width / 2, canvas.height / 2, canvas.height / 2, lastend, lastend + (Math.PI * 2 * (val[1][1] / myTotal)), false);
        ctx.lineTo(canvas.width / 2, canvas.height / 2); // رسم القطاع الدائري و اغلاقه
        ctx.fill();
        // store the value of each circle start angle and end angle to use it again in arcs array
        arcs.push([lastend, lastend + (Math.PI * 2 * (val[1][1] / myTotal))]);
        var atag = document.createElement("a");

        var x = document.createElement("LI"); // create li element to put it in the ul
        x.id = idx; // assign id value

        var t = document.createTextNode(val[1][0]); // create text inside the li
        var tt = document.createElement("input"); // create change color input
        tt.style.float = "right"; // put the input on the right side

        tt.type = "color"; // make the type of input color
        // put the elements inside each other
        atag.href = "<?= route('vendor.product')  ?>?id=" + val[1][0];
        x.appendChild(t);

        x.appendChild(tt);
        atag.appendChild(x);
        x.style.background = myColor[idx % myColor.length]; // give a background color to the li same as the color of its arc
        x.className = "list-group-item";

        atag.title = "Click to view this product";
        document.getElementById("dvLegend").append(atag);
        // put the value in the middle of the arc and this is the equation to make that
        beginAngle = endAngle; //begin angle
        endAngle = endAngle + ((Math.PI * 2) * (val[1][1] / myTotal)); //end angle
        var pieRadius = Math.min(canvas.width / 2, canvas.height / 2);
        var labelX = canvas.width / 2 + (pieRadius / 2) * Math.cos(beginAngle + (endAngle - beginAngle) / 2);
        var labelY = canvas.height / 2 + (pieRadius / 2) * Math.sin(beginAngle + (endAngle - beginAngle) / 2);
        ctx.fillStyle = "white";
        ctx.font = "bold 10px Arial";
        ctx.fillText("" + val[1][0], labelX, labelY);


        // when mouse move on the li element
        x.onmouseover = function () {
            hover(this.id); // call hover function that will draw again
            this.style.fontSize = "20px"; // make the font bigger
            this.style.cursor = "pointer";
        };

        // when moving mouse out of the li
        x.onmouseout = function () {
            //hover(this.id);
            this.style.fontSize = "18px"; // just make the font as default
        };


        tt.onchange = function () {
            edit(idx, this.value); // when the color change call edit to change it on circle
        };

        // move cursor to the end of arc to draw the next arc
        lastend += Math.PI * 2 * (val[1][1] / myTotal);
    });
}

function edit(idx, col) {

    myColor[idx] = col; // change the color as requested
    reset(); // clear canvas
    draw(); // draw again with the new color
}

function reset() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function hover(id) {
    // this function to draw again when mouse over li element
    // and we use arcs array to draw
    var i = 0, r;
    var beginAngle = 0;
    var endAngle = 0;
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    var j = 0;
    while (r = arcs[i]) {
        ctx.beginPath();
        ctx.moveTo(canvas.width / 2, canvas.height / 2);
        ctx.arc(canvas.width / 2, canvas.height / 2, canvas.height / 2, arcs[i][0], arcs[i][1], false);
        ctx.lineTo(canvas.width / 2, canvas.height / 2);
        ctx.fillStyle = myColor[j % myColor.length];

        // the only difference from draw function
        // we have the id of li element the mouse over it
        // we make the arc bigger if we are drawing it and its id equal to the index
        if (id == i) {
            ctx.lineWidth = 8;
            ctx.strokeStyle = myColor[j % myColor.length];
            ctx.stroke();
        }
        ctx.fill();

        beginAngle = arcs[i][0]; //begin angle
        endAngle = arcs[i][1]; //end angle
        var pieRadius = Math.min(canvas.width / 2, canvas.height / 2);
        var labelX = canvas.width / 2 + (pieRadius / 2) * Math.cos(beginAngle + (endAngle - beginAngle) / 2);
        var labelY = canvas.height / 2 + (pieRadius / 2) * Math.sin(beginAngle + (endAngle - beginAngle) / 2);
        ctx.fillStyle = "white";
        ctx.font = "bold 10px Arial";
        ctx.fillText("" + values[i][0], labelX, labelY);

        j++;
        i++;
    }

}



// when mouse out of canvas resize the font to its default value
canvas.onmouseout = function (e) {
    for (var i = 0; i < entries.length; i++) {
        document.getElementById(i).style.fontSize = "18px";
    }
};

function saveit() {

    var dataUrl = canvas.toDataURL();
    document.getElementById("image").src = dataUrl;
    document.getElementById("download").href = dataUrl;
}


draw();
// ============================================================================
//---------------------------- Bar -------------------------------------------

// colors we will use
var colors = ['#39CCCC', '#001f3f', '#C57042','#95D861','#D5B234','#292A24','#767867','#848298','#166BBB','#7A3D2E'];

function drawBar() {

    var width = 40; //bar width
    var X = 60; // first bar position
    // looping on the values to draw each rectangle
    for (var i =0; i<Math.min(5,values.length); i++) {
        barCtx.fillStyle = colors[i%colors.length]; // choose color for rectangle
        var h = Math.min(250,values[i][1]*30); // get the height of rectangle
        // draw the rectangle (position on x,position on y,width of rectangle,height of rectangle)
        barCtx.fillRect(X,barCan.height - h,width,h);

        X +=  width+15; //increase the position on x to draw the next rectangle
        /* text to display Bar number */
        barCtx.fillStyle = '#4da6ff';
        barCtx.fillText(values[i][0],X-50,barCan.height - h -20); // text on top of the rectangle
        barCtx.fillText("qty = "+values[i][1],X-50,barCan.height - h -10);
    }
    /* Text to display scale */
    barCtx.fillStyle = '#000000';
    barCtx.fillText('Scale X : '+barCan.width+' Y : '+barCan.height,800,10);


}

// to make action on mouse move
barCan.onmousemove = function (e) {

    var rect = this.getBoundingClientRect(),
        x = e.clientX - rect.left, //get the x position
        y = e.clientY - rect.top; //get the y position

    // clear the exist rectangle
    barCtx.clearRect(0, 0, barCan.width, barCan.height);

    var width = 40; //bar width
    var X = 60; // first bar position

    //start drawing again
    for (var i =0; i<Math.min(5,values.length); i++) {

        var h = Math.min(250,values[i][1]*30);
        barCtx.beginPath();
        barCtx.rect(X,barCan.height - h,width,h);

        // here is the difference : we change the bar color if mouse move above it
        barCtx.fillStyle = barCtx.isPointInPath(x, y) ? "#008080" : colors[i%colors.length];
        barCtx.fill();
        X +=  width+15;
        /* text to display Bar number */
        barCtx.fillStyle = '#4da6ff';
        barCtx.fillText(values[i][0],X-50,barCan.height - h -20);
        barCtx.fillText("qty = "+values[i][1],X-50,barCan.height - h -10);
    }
    /* Text to display scale */
    barCtx.fillStyle = '#000000';
    barCtx.fillText('Scale X : '+barCan.width+' Y : '+barCan.height,800,10);




};
drawBar();
// ============================================================================
//---------------------------- Coordinate -------------------------------------------

function drawGrids() {
    // draw the background grids
    var xGrid = 10;
    var yGrid = 10;
    var cellSize = 10;
    Cctx.beginPath();

    // draw until we xGrid smaller than canvas height
    while(xGrid < Ccanvas.height){
        Cctx.moveTo(0,xGrid); // move to the start position (0,xGrid) on the y axis
        Cctx.lineTo(Ccanvas.width,xGrid); // draw line to the end  of the canvas
        xGrid+=cellSize;
    }

    // draw until we yGrid smaller than canvas width
    while(yGrid < Ccanvas.width){
        Cctx.moveTo(yGrid,0);// move to the start position (yGrid,0) on the x axis
        Cctx.lineTo(yGrid,Ccanvas.height); // draw line to the end  of the canvas
        yGrid+=cellSize;
    }
    Cctx.strokeStyle = "gray";
    Cctx.stroke();
}

function blocks(count){
    return count*10;
}

function drawAxis(){
    // draw the primary axis
    var yPlot = 28;
    var pop = 0;

    Cctx.beginPath();
    Cctx.strokeStyle = "black"; //give it color black
    Cctx.moveTo(blocks(5),blocks(5)); // move 5 blocks on the x and 5 on the y
    Cctx.lineTo(blocks(5),blocks(28)); // Y axis: draw line to position (5 blocks on x, 40 block on y)
    Cctx.lineTo(blocks(80),blocks(28)); // X axis: draw line to position (80 blocks , 40 blocks)

    Cctx.moveTo(blocks(5),blocks(28)); // move to position ( 5 blocks, 40 blocks)

    // draw the numbers on the Y axis
    for(var i=1;i<=10;i++){
        // pop is the number we want to draw it start with 0 and increase 500 every time
        Cctx.strokeText(pop,blocks(2),blocks(yPlot)); // draw text (pop) in position (2 block,yPlot)
        yPlot-=2;
        pop+=10;
    }

    Cctx.stroke();

}

function drawChart() {

    // draw the chart
    Cctx.beginPath();
    //ctx.strokeStyle = "red";
    Cctx.moveTo(blocks(5),blocks(28)); // move to position (0,0) on our axis

    var xPlot = 10;

    entries.forEach(function (val,idx){

        var populationBlocks = ((val[1][1])/5); //get the value
        Cctx.strokeStyle = "black";
        Cctx.lineWidth   = 2;
        Cctx.font="15pt Calibri";
        Cctx.strokeText(val[1][0],blocks(xPlot),blocks(28-populationBlocks-2)); //draw the text on its position
        Cctx.strokeStyle = color; // change the color to draw the line
        Cctx.lineWidth   = 3;
        Cctx.lineTo(blocks(xPlot),blocks(28-populationBlocks)); // draw line to the position of this point
        Cctx.arc(blocks(xPlot),blocks(28-populationBlocks),2,0,Math.PI*2,true); // draw small arc in the point
        xPlot+=5;
    });
    Cctx.stroke();
}

function reset(){
    Cctx.clearRect(0, 0, Ccanvas.width, Ccanvas.height);
    Cctx.font='10px Arial';
    Cctx.lineWidth   = 1;
}
function edit(col) {
    // when changing the color
    color = col;
    reset();
    drawGrids();
    drawAxis();
    drawChart();
}
function saveit() {

    var dataUrl = Ccanvas.toDataURL();
    document.getElementById("image").src = dataUrl;
    document.getElementById("download").href = dataUrl;
}


drawGrids();
drawAxis();
drawChart();
</script>
