<html>
    <head></head>
    <body>
        <ul>
  <li>
    <a><i class="fa fa-play" aria-hidden="true" id="playBtn">lksddfs</i></a>
  </li>
  <li>
    <a><i class="fa fa-pause" aria-hidden="true" id="pauseBtn">sdjnf</i></a>
  </li>
  <li>
    <a><i class="fa fa-stop" aria-hidden="true" id="stopBtn">djsnfjsd</i></a>
  </li>
</ul>
        <script>
            var source = "audio/burger.mp3"
        var audio = document.createElement("audio");
        audio.load()
        audio.addEventListener("load", function() {
          audio.play();
        }, true);
        audio.src = source;
        
        
        document.querySelector('#playBtn').addEventListener("click",()=>{
            audio.play();
        })
        
        $("#playBtn").click(function() {
          audio.play();
        });
        
        $("#pauseBtn").click(function() {
          audio.pause();
        });
        
        $("#stopBtn").click(function() {
          audio.pause();
          audio.currentTime = 0;
        });
            
            
            
        </script>
    </body>
</html>