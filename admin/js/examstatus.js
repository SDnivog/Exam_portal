
$(document).ready(function(){
    setInterval(()=>{
        examstatus();
    }),5000
})
examstatus();
function examstatus(){
    $.ajax({
        url:'../ajax/exams.php',
        type:'POST',
        success:function(data){
            $('.content').html(data);
        }
    })
}