<html>
    
    <head>
        
    </head>
    <body>
        <p id="days"></p>
         <p id="hours"></p>
          <p id="min"></p>
           <p id="sec"></p>
        <button onclick="TimeSet()">Open</button>
        <script>
        
//          function fetchtimer(){
  
//   var msg = "yes";
//   $.ajax({
//     url:'fetchtimer.php',
//     type:'post',
//     data:{
//       msg:msg,
//     },
//     success:function(data){
//       var user = JSON.parse(data);
//       $('.title').html(user.timer_title);
//       $('.subtitle').html(user.subtitle);
     
//       var countDownDate = new Date(user.date).getTime();

//       var x = setInterval(function() {
//         // Get today's date and time
//         var now = new Date().getTime();
//         // Find the distance between now and the count down date
//         var distance = countDownDate - now;
//         // Time calculations for days, hours, minutes and seconds
//         var days = Math.floor(distance / (1000 * 60 * 60 * 24));
//         var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//         var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//         var seconds = Math.floor((distance % (1000 * 60)) / 1000);
//         // Display the result in the element with id="demo"
//         document.getElementById("days").innerHTML = days+ " D";
//         document.getElementById("hours").innerHTML = hours+ " H";
//         document.getElementById("min").innerHTML = minutes+ " M" ;
//         document.getElementById("sec").innerHTML = seconds + " S";
//         // If the count down is finished, write some text
//         if (distance < 0) {
//           clearInterval(x);
//           document.getElementById("days").innerHTML = "EXPIRED";
//         }
//       }, 1000);
//     }
//   })
// }
    function TimeSet(){
      var countDownDate = new Date("2021-01-09 09:50:00").getTime();
      alert(countDownDate);

      var x = setInterval(function() {
        // Get today's date and time
        var now = new Date().getTime();
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
        // alert(distance);
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        // Display the result in the element with id="demo"
        document.getElementById("days").innerHTML = days+ " D";
        document.getElementById("hours").innerHTML = hours+ " H";
        document.getElementById("min").innerHTML = minutes+ " M" ;
        document.getElementById("sec").innerHTML = seconds + " S";
        // If the count down is finished, write some text
        if (distance < 0) {
          clearInterval(x);
          document.getElementById("days").innerHTML = "EXPIRED";
        }
},1000);
}
            
            
        </script>
        
    </body>
    
   

</html>





