jQuery(document).ready(function($){
    $('li.TPostMv').each(function(index,el){
        var timer_el=$(el).find('span.mli-timeschedule');
        var myVar=setInterval(function(){
            var sec=timer_el.data('timer_second');
            if(sec>0){
                timer_el.text(lcp_second_to_fucking_str(sec));
                timer_el.data('timer_second',(sec-1));
            }else{
                clearInterval(myVar);
            }
        },1000);
    });
});
function lcp_second_to_fucking_str($second)
{
    var $d=0;
    var $h=0;
    var $i=0;
    var $s=0;
    $d=Math.floor($second/86400);
    var $left=$second%86400;
    if($left>0){
        $h=Math.floor($left/3600);
        $left=$left%3600;
        if($left>0){
            $i=Math.floor($left/60);
            $left=$left%60;
            if($left>0){
                $s=$left;
            }
        }
    }
    return $d+'d '+$h+'h '+$i+'m '+$s+'s';
}