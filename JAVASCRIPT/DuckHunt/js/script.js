var score=0;

function move(){
  $(document).keydown(function(e){
    switch (e.which){
    case 37:    //left arrow key
        $("#bird").finish().animate({
            left: "-=50"
        });
        break;
    case 38:    //up arrow key
        $("#bird").finish().animate({
            top: "-=50"
        });
        break;
    case 39:    //right arrow key
        $("#bird").finish().animate({
            left: "+=50"
        });
        break;
    case 40:    //bottom arrow key
        $("#bird").finish().animate({
            top: "+=50"
        });
        break;

        
    
    }});

    
}

function birdshoot(){

$('#bird').click(function(){
    $(this).attr('src', 'img/expl.gif');
    
    setTimeout(function(){
        $('#bird').attr('src', 'img/cigogne.gif');
    },1000);

  

// $(this).animate({width : '350px', height: '350px'}).animate({width : '150px', height: '150px'});
    score++;
    $("#output").html(score);
});



}

//collisions
// let posTop = 0; // position en haut

// let posLeft = 0; // position en bas

// let speed = 3; // vitesse 







//         $(bird).css({  

//             top: posTop + '%',

//             left: posLeft + '%'

//         })



//         if(posLeft < 0) posLeft = 100;

//         if(posTop < 0) posTop = 100;

//         if(posLeft > 100 ) posLeft = 0;

//         if(posTop > 100 ) posTop = 0;



//mode multi-joueurs


move();
birdshoot();


// $(document).ready(function(){
//     $("p").bind("click", function(){
//       alert("Le joueur au clavier a gagné !");
//     });
//   });