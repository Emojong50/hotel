$(document).ready(function(){
    $(".coffee").owlCarousel({
        loop:false,
        margin:10,
        nav:true,
        // autoplay: true,
        // autoplayTimeout: 1000,
        // autoplayHoverPause:true,


        //dots:true,
        responsive:{
          0:{
            items:1
          },
          600:{
            items:3
          },
          1000:{
            items:3
          }
        }
    });
    $(".tea").owlCarousel({
        loop:false,
        margin:10,
        nav:true,
        autoplay: false,
        // autoplayTimeout: 1000,
        // autoplayHoverPause:true,


        //dots:true,
        responsive:{
          0:{
            items:1
          },
          600:{
            items:3
          },
          1000:{
            items:3
          }
        }
    });
    $(".snacks").owlCarousel({
      loop:false,
      margin:10,
      nav:true,
      autoplay: false,
      // autoplayTimeout: 1000,
      // autoplayHoverPause:true,


      //dots:true,
      responsive:{
        0:{
          items:1
        },
        600:{
          items:3
        },
        1000:{
          items:3
        }
      }
  });
});
$('.orderbtn').on('click' ,function(){
        
  retrievetable();

  //order()

});
function order(id, user){
  $.ajax({
      url:'./handler.php',
      method: 'GET',
      data:{id:id,user_id:user},
      success: function(response){
          //alert(response);
          //$('#order').html(response);
      }
      

  });
  retrievetable();
}
function retrievetable(){
  $.ajax({
      url:'./handler.php',
      method: 'GET',
      data:{retrieve:1},
      success: function(response){
          //alert(response);
          $('#order').html(response);
      }
      

  });

}
function deleteitem(delete_id){
  $.ajax({
    url: './handler.php',
    method: 'GET',
    data:{delete_id:delete_id},
    /*success: function(response){
      alert(response);

    }*/
  });
  retrievetable();
}