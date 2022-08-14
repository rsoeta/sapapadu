


// $( document ).ready(function() {
//     var arr = ['bg_1.jpg','bg_2.jpg','bg_3.jpg'];
    
//     var i = 0;
//     setInterval(function(){
//         if(i == arr.length - 1){
//             i = 0;
//         }else{
//             i++;
//         }
//         var img = 'url(../assets/images/'+arr[i]+')';
//         $(".full-bg").css('background-image',img); 
     
//     }, 4000)

// });

 function formatNumber(num) 
 {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
 }

 function formatangka(objek) {
   a = objek.value;
   b = a.replace(/[^\d]/g,"");
   c = "";
   panjang = b.length;
   j = 0;
   for (i = panjang; i > 0; i--) {
     j = j + 1;
     if (((j % 3) == 1) && (j != 1)) {
       c = b.substr(i-1,1) + "." + c;
     } else {
       c = b.substr(i-1,1) + c;
     }
   }
   objek.value = c;
}